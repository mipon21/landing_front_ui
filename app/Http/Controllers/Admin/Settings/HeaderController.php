<?php

namespace App\Http\Controllers\Admin\Settings;

use App\Http\Controllers\Controller;
use App\Models\HeaderMenu;
use App\Models\SiteSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class HeaderController extends Controller
{
    public function index()
    {
        // Get header logo
        $headerLogo = SiteSetting::getValue('header_logo', null);
        
        // Get header CTA button settings
        $ctaButton = [
            'text' => SiteSetting::getValue('header_cta_text', '7 Days Free Trial'),
            'url' => SiteSetting::getValue('header_cta_url', '#'),
        ];

        // Get all menus with their submenus
        $menus = HeaderMenu::topLevel()
            ->with('children')
            ->orderBy('sort_order')
            ->get();

        return view('admin.settings.header.index', compact('headerLogo', 'ctaButton', 'menus'));
    }

    public function updateLogo(Request $request)
    {
        $request->validate([
            'logo' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

        // Delete old logo if exists
        $oldLogo = SiteSetting::getValue('header_logo', null);
        if ($oldLogo) {
            Storage::disk('public')->delete($oldLogo);
        }

        // Upload new logo
        $logoPath = $request->file('logo')->store('header', 'public');
        SiteSetting::setValue('header_logo', $logoPath, 'string', 'Header logo image.');

        return redirect()->route('admin.settings.header.index')->with('success', 'Header logo updated successfully!');
    }

    public function deleteLogo(Request $request)
    {
        $logo = SiteSetting::getValue('header_logo', null);
        if ($logo) {
            Storage::disk('public')->delete($logo);
            SiteSetting::where('key', 'header_logo')->delete();
        }

        return redirect()->route('admin.settings.header.index')->with('success', 'Header logo deleted successfully!');
    }

    public function updateCtaButton(Request $request)
    {
        $request->validate([
            'cta_text' => 'required|string|max:255',
            'cta_url' => 'required|url|max:255',
        ]);

        SiteSetting::setValue('header_cta_text', $request->cta_text, 'string', 'Header CTA button text.');
        SiteSetting::setValue('header_cta_url', $request->cta_url, 'string', 'Header CTA button URL.');

        return redirect()->route('admin.settings.header.index')->with('success', 'CTA button updated successfully!');
    }

    public function storeMenu(Request $request)
    {
        $validated = $request->validate([
            'label' => 'required|string|max:255',
            'url' => 'nullable|string|max:255',
            'parent_id' => 'nullable|exists:header_menus,id',
            'sort_order' => 'nullable|integer|min:0',
            'is_active' => 'boolean',
        ]);

        if (!isset($validated['sort_order'])) {
            $maxOrder = HeaderMenu::where('parent_id', $validated['parent_id'] ?? null)
                ->max('sort_order') ?? 0;
            $validated['sort_order'] = $maxOrder + 1;
        }

        if (!isset($validated['is_active'])) {
            $validated['is_active'] = true;
        }

        HeaderMenu::create($validated);

        return redirect()->route('admin.settings.header.index')->with('success', 'Menu item created successfully!');
    }

    public function updateMenu(Request $request, $id)
    {
        $menu = HeaderMenu::findOrFail($id);

        $validated = $request->validate([
            'label' => 'required|string|max:255',
            'url' => 'nullable|string|max:255',
            'parent_id' => 'nullable|exists:header_menus,id',
            'sort_order' => 'nullable|integer|min:0',
            'is_active' => 'boolean',
        ]);

        // Prevent menu from being its own parent
        if ($validated['parent_id'] == $menu->id) {
            return redirect()->route('admin.settings.header.index')
                ->with('error', 'A menu cannot be its own parent.');
        }

        // Prevent circular references (menu cannot have a child as its parent)
        if ($validated['parent_id']) {
            $potentialParent = HeaderMenu::find($validated['parent_id']);
            if ($potentialParent && $potentialParent->parent_id == $menu->id) {
                return redirect()->route('admin.settings.header.index')
                    ->with('error', 'Circular reference detected. Cannot set this menu as parent.');
            }
        }

        $menu->update($validated);

        return redirect()->route('admin.settings.header.index')->with('success', 'Menu item updated successfully!');
    }

    public function destroyMenu($id)
    {
        $menu = HeaderMenu::findOrFail($id);

        // Check if menu has children
        if ($menu->children()->count() > 0) {
            return redirect()->route('admin.settings.header.index')
                ->with('error', 'Cannot delete menu item with submenus. Please delete submenus first.');
        }

        $menu->delete();

        return redirect()->route('admin.settings.header.index')->with('success', 'Menu item deleted successfully!');
    }
}

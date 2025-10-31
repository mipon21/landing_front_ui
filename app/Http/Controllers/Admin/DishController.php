<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Dish;
use App\Models\SiteSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DishController extends Controller
{
    public function index()
    {
        $dishes = Dish::orderBy('sort_order')->get();
        $buttonSettings = [
            'google_play_url' => SiteSetting::getValue('dishes_section_google_play_url', null),
            'app_store_url' => SiteSetting::getValue('dishes_section_app_store_url', null),
            'show_google_play' => (bool) SiteSetting::getValue('dishes_section_show_google_play', '1'),
            'show_app_store' => (bool) SiteSetting::getValue('dishes_section_show_app_store', '1'),
        ];
        return view('admin.dishes.index', compact('dishes', 'buttonSettings'));
    }

    public function create()
    {
        return view('admin.dishes.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'name' => 'nullable|string|max:255',
            'alt_text' => 'nullable|string|max:255',
            'sort_order' => 'nullable|integer',
            'is_active' => 'boolean',
        ]);

        $validated['image'] = $request->file('image')->store('dishes', 'public');
        Dish::create($validated);

        return redirect()->route('admin.dishes.index')->with('success', 'Dish added successfully!');
    }

    public function edit(Dish $dish)
    {
        return view('admin.dishes.edit', compact('dish'));
    }

    public function update(Request $request, Dish $dish)
    {
        $validated = $request->validate([
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'name' => 'nullable|string|max:255',
            'alt_text' => 'nullable|string|max:255',
            'sort_order' => 'nullable|integer',
            'is_active' => 'boolean',
        ]);

        if ($request->hasFile('image')) {
            if ($dish->image) {
                Storage::disk('public')->delete($dish->image);
            }
            $validated['image'] = $request->file('image')->store('dishes', 'public');
        }

        $dish->update($validated);

        return redirect()->route('admin.dishes.index')->with('success', 'Dish updated successfully!');
    }

    public function destroy(Dish $dish)
    {
        if ($dish->image) {
            Storage::disk('public')->delete($dish->image);
        }
        $dish->delete();

        return redirect()->route('admin.dishes.index')->with('success', 'Dish deleted successfully!');
    }

    public function updateButtonUrls(Request $request)
    {
        $validated = $request->validate([
            'google_play_url' => 'nullable|url|max:255',
            'app_store_url' => 'nullable|url|max:255',
            'show_google_play' => 'boolean',
            'show_app_store' => 'boolean',
        ]);

        SiteSetting::setValue('dishes_section_google_play_url', $validated['google_play_url'], 'url', 'Google Play Store URL for the Dishes section buttons.');
        SiteSetting::setValue('dishes_section_app_store_url', $validated['app_store_url'], 'url', 'App Store URL for the Dishes section buttons.');
        SiteSetting::setValue('dishes_section_show_google_play', $request->has('show_google_play') ? '1' : '0', 'boolean', 'Show/hide Google Play Store button in Dishes section.');
        SiteSetting::setValue('dishes_section_show_app_store', $request->has('show_app_store') ? '1' : '0', 'boolean', 'Show/hide App Store button in Dishes section.');

        return redirect()->route('admin.dishes.index')->with('success', 'Button settings updated successfully!');
    }
}


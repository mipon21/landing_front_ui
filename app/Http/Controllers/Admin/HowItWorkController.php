<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HowItWork;
use App\Models\SiteSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class HowItWorkController extends Controller
{
    public function index()
    {
        $steps = HowItWork::orderBy('sort_order')->get();
        
        // Get section-wide settings
        $sectionSettings = [
            'badge_text' => SiteSetting::getValue('how_it_works_badge_text', 'Easy Steps'),
            'heading' => SiteSetting::getValue('how_it_works_heading', 'How it Works'),
            'description' => SiteSetting::getValue('how_it_works_description', 'Lorem Ipsum is simply dummy text of the printing indus orem Ipsum has been the industrys standard dummy text ever since.'),
            'promotional_text' => SiteSetting::getValue('how_it_works_promotional_text', 'Get 50% off on your first order ! Grab it now.'),
            'bottom_image' => SiteSetting::getValue('how_it_works_bottom_image', null),
            'show_google_play' => (bool) SiteSetting::getValue('how_it_works_show_google_play', '1'),
            'show_app_store' => (bool) SiteSetting::getValue('how_it_works_show_app_store', '1'),
            'google_play_url' => SiteSetting::getValue('how_it_works_google_play_url', null),
            'app_store_url' => SiteSetting::getValue('how_it_works_app_store_url', null),
        ];
        
        return view('admin.how-it-works.index', compact('steps', 'sectionSettings'));
    }

    public function create()
    {
        return view('admin.how-it-works.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'step_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'step_title' => 'required|string|max:255',
            'step_description' => 'required|string',
            'step_number' => 'required|integer|min:1',
            'sort_order' => 'nullable|integer',
            'is_active' => 'boolean',
        ]);

        if ($request->hasFile('step_image')) {
            $validated['step_image'] = $request->file('step_image')->store('how-it-works', 'public');
        }

        HowItWork::create($validated);

        return redirect()->route('admin.how-it-works.index')->with('success', 'Step created successfully!');
    }

    public function edit($id)
    {
        $howItWork = HowItWork::findOrFail($id);
        return view('admin.how-it-works.edit', compact('howItWork'));
    }

    public function update(Request $request, $id)
    {
        $howItWork = HowItWork::findOrFail($id);
        
        $validated = $request->validate([
            'step_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'step_title' => 'required|string|max:255',
            'step_description' => 'required|string',
            'step_number' => 'required|integer|min:1',
            'sort_order' => 'nullable|integer',
            'is_active' => 'boolean',
        ]);

        if ($request->hasFile('step_image')) {
            if ($howItWork->step_image) {
                Storage::disk('public')->delete($howItWork->step_image);
            }
            $validated['step_image'] = $request->file('step_image')->store('how-it-works', 'public');
        }

        $howItWork->update($validated);

        return redirect()->route('admin.how-it-works.index')->with('success', 'Step updated successfully!');
    }

    public function destroy($id)
    {
        $howItWork = HowItWork::findOrFail($id);
        if ($howItWork->step_image) {
            Storage::disk('public')->delete($howItWork->step_image);
        }
        $howItWork->delete();

        return redirect()->route('admin.how-it-works.index')->with('success', 'Step deleted successfully!');
    }

    public function updateSectionSettings(Request $request)
    {
        $validated = $request->validate([
            'badge_text' => 'nullable|string|max:255',
            'heading' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'promotional_text' => 'nullable|string|max:255',
            'bottom_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'show_google_play' => 'boolean',
            'show_app_store' => 'boolean',
            'google_play_url' => 'nullable|url|max:255',
            'app_store_url' => 'nullable|url|max:255',
        ]);

        // Save section settings
        SiteSetting::setValue('how_it_works_badge_text', $validated['badge_text'] ?? '', 'string', 'Badge text for How It Works section.');
        SiteSetting::setValue('how_it_works_heading', $validated['heading'] ?? '', 'string', 'Heading for How It Works section.');
        SiteSetting::setValue('how_it_works_description', $validated['description'] ?? '', 'string', 'Description for How It Works section.');
        SiteSetting::setValue('how_it_works_promotional_text', $validated['promotional_text'] ?? '', 'string', 'Promotional text for How It Works section.');

        // Handle bottom image upload
        if ($request->hasFile('bottom_image')) {
            // Delete old image if exists
            $oldImage = SiteSetting::getValue('how_it_works_bottom_image', null);
            if ($oldImage) {
                Storage::disk('public')->delete($oldImage);
            }
            $imagePath = $request->file('bottom_image')->store('how-it-works', 'public');
            SiteSetting::setValue('how_it_works_bottom_image', $imagePath, 'string', 'Bottom image for How It Works section.');
        }

        // Save toggle and URL settings
        SiteSetting::setValue('how_it_works_show_google_play', $request->has('show_google_play') ? '1' : '0', 'boolean', 'Show/hide Google Play Store button in How It Works section.');
        SiteSetting::setValue('how_it_works_show_app_store', $request->has('show_app_store') ? '1' : '0', 'boolean', 'Show/hide App Store button in How It Works section.');
        SiteSetting::setValue('how_it_works_google_play_url', $validated['google_play_url'] ?? null, 'string', 'Google Play Store URL for How It Works section.');
        SiteSetting::setValue('how_it_works_app_store_url', $validated['app_store_url'] ?? null, 'string', 'App Store URL for How It Works section.');

        return redirect()->route('admin.how-it-works.index')->with('success', 'Section settings updated successfully!');
    }

    public function deleteBottomImage()
    {
        $oldImage = SiteSetting::getValue('how_it_works_bottom_image', null);
        if ($oldImage) {
            Storage::disk('public')->delete($oldImage);
            SiteSetting::setValue('how_it_works_bottom_image', null, 'string', 'Bottom image for How It Works section.');
        }

        return redirect()->route('admin.how-it-works.index')->with('success', 'Bottom image deleted successfully!');
    }
}


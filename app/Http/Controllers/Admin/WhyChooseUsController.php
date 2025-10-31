<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SiteSetting;
use App\Models\WhyChooseUs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class WhyChooseUsController extends Controller
{
    public function index()
    {
        $features = WhyChooseUs::orderBy('sort_order')->get();
        $featureImage = SiteSetting::getValue('why_choose_us_feature_image', null);
        $sectionSettings = [
            'badge_text' => SiteSetting::getValue('why_choose_us_badge_text', 'why use Appiq'),
            'heading' => SiteSetting::getValue('why_choose_us_heading', 'Why choose us'),
            'description' => SiteSetting::getValue('why_choose_us_description', 'Lorem Ipsum is simply dummy text of the printing and typese tting indus orem Ipsum has beenthe standard dummy.'),
        ];
        return view('admin.why-choose-us.index', compact('features', 'featureImage', 'sectionSettings'));
    }

    public function create()
    {
        return view('admin.why-choose-us.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'icon' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'sort_order' => 'nullable|integer',
            'is_active' => 'boolean',
        ]);

        if ($request->hasFile('icon')) {
            $validated['icon'] = $request->file('icon')->store('why-choose-us', 'public');
        }

        WhyChooseUs::create($validated);

        return redirect()->route('admin.why-choose-us.index')->with('success', 'Feature created successfully!');
    }

    public function edit($id)
    {
        $whyChooseUs = WhyChooseUs::findOrFail($id);
        return view('admin.why-choose-us.edit', compact('whyChooseUs'));
    }

    public function update(Request $request, $id)
    {
        $whyChooseUs = WhyChooseUs::findOrFail($id);
        
        $validated = $request->validate([
            'icon' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'sort_order' => 'nullable|integer',
            'is_active' => 'boolean',
        ]);

        if ($request->hasFile('icon')) {
            if ($whyChooseUs->icon) {
                Storage::disk('public')->delete($whyChooseUs->icon);
            }
            $validated['icon'] = $request->file('icon')->store('why-choose-us', 'public');
        }

        $whyChooseUs->update($validated);

        return redirect()->route('admin.why-choose-us.index')->with('success', 'Feature updated successfully!');
    }

    public function destroy($id)
    {
        $whyChooseUs = WhyChooseUs::findOrFail($id);
        if ($whyChooseUs->icon) {
            Storage::disk('public')->delete($whyChooseUs->icon);
        }
        $whyChooseUs->delete();

        return redirect()->route('admin.why-choose-us.index')->with('success', 'Feature deleted successfully!');
    }

    public function updateFeatureImage(Request $request)
    {
        $validated = $request->validate([
            'feature_image' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

        $oldImage = SiteSetting::getValue('why_choose_us_feature_image', null);
        if ($oldImage && Storage::disk('public')->exists($oldImage)) {
            Storage::disk('public')->delete($oldImage);
        }

        $imagePath = $request->file('feature_image')->store('why-choose-us', 'public');
        SiteSetting::setValue('why_choose_us_feature_image', $imagePath, 'file', 'Main feature image for the Why Choose Us section.');

        return redirect()->route('admin.why-choose-us.index')->with('success', 'Feature image updated successfully!');
    }

    public function deleteFeatureImage()
    {
        $oldImage = SiteSetting::getValue('why_choose_us_feature_image', null);
        if ($oldImage && Storage::disk('public')->exists($oldImage)) {
            Storage::disk('public')->delete($oldImage);
        }
        SiteSetting::where('key', 'why_choose_us_feature_image')->delete();

        return redirect()->route('admin.why-choose-us.index')->with('success', 'Feature image deleted successfully!');
    }

    public function updateSectionSettings(Request $request)
    {
        $validated = $request->validate([
            'badge_text' => 'nullable|string|max:255',
            'heading' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        SiteSetting::setValue('why_choose_us_badge_text', $validated['badge_text'], 'text', 'Badge text for the Why Choose Us section.');
        SiteSetting::setValue('why_choose_us_heading', $validated['heading'], 'text', 'Heading for the Why Choose Us section.');
        SiteSetting::setValue('why_choose_us_description', $validated['description'], 'text', 'Description for the Why Choose Us section.');

        return redirect()->route('admin.why-choose-us.index')->with('success', 'Section settings updated successfully!');
    }
}


<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\WhyChooseUs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class WhyChooseUsController extends Controller
{
    public function index()
    {
        $features = WhyChooseUs::orderBy('sort_order')->get();
        return view('admin.why-choose-us.index', compact('features'));
    }

    public function create()
    {
        return view('admin.why-choose-us.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'badge_text' => 'nullable|string|max:255',
            'heading' => 'required|string|max:255',
            'description' => 'nullable|string',
            'icon' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'feature_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'sort_order' => 'nullable|integer',
            'is_active' => 'boolean',
        ]);

        if ($request->hasFile('icon')) {
            $validated['icon'] = $request->file('icon')->store('why-choose-us', 'public');
        }

        if ($request->hasFile('feature_image')) {
            $validated['feature_image'] = $request->file('feature_image')->store('why-choose-us', 'public');
        }

        WhyChooseUs::create($validated);

        return redirect()->route('admin.why-choose-us.index')->with('success', 'Feature created successfully!');
    }

    public function edit(WhyChooseUs $whyChooseUs)
    {
        return view('admin.why-choose-us.edit', compact('whyChooseUs'));
    }

    public function update(Request $request, WhyChooseUs $whyChooseUs)
    {
        $validated = $request->validate([
            'badge_text' => 'nullable|string|max:255',
            'heading' => 'required|string|max:255',
            'description' => 'nullable|string',
            'icon' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'feature_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'sort_order' => 'nullable|integer',
            'is_active' => 'boolean',
        ]);

        if ($request->hasFile('icon')) {
            if ($whyChooseUs->icon) {
                Storage::disk('public')->delete($whyChooseUs->icon);
            }
            $validated['icon'] = $request->file('icon')->store('why-choose-us', 'public');
        }

        if ($request->hasFile('feature_image')) {
            if ($whyChooseUs->feature_image) {
                Storage::disk('public')->delete($whyChooseUs->feature_image);
            }
            $validated['feature_image'] = $request->file('feature_image')->store('why-choose-us', 'public');
        }

        $whyChooseUs->update($validated);

        return redirect()->route('admin.why-choose-us.index')->with('success', 'Feature updated successfully!');
    }

    public function destroy(WhyChooseUs $whyChooseUs)
    {
        if ($whyChooseUs->icon) {
            Storage::disk('public')->delete($whyChooseUs->icon);
        }
        if ($whyChooseUs->feature_image) {
            Storage::disk('public')->delete($whyChooseUs->feature_image);
        }
        $whyChooseUs->delete();

        return redirect()->route('admin.why-choose-us.index')->with('success', 'Feature deleted successfully!');
    }
}


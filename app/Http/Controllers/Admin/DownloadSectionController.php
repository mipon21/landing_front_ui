<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DownloadSection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DownloadSectionController extends Controller
{
    public function index()
    {
        $sections = DownloadSection::orderBy('section_type')->get();
        return view('admin.download-sections.index', compact('sections'));
    }

    public function create()
    {
        return view('admin.download-sections.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'badge_text' => 'nullable|string|max:255',
            'heading' => 'required|string|max:255',
            'description' => 'nullable|string',
            'promo_text' => 'nullable|string|max:255',
            'google_play_url' => 'nullable|url|max:255',
            'app_store_url' => 'nullable|url|max:255',
            'button_text' => 'nullable|string|max:255',
            'button_url' => 'nullable|url|max:255',
            'left_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'right_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'mobile_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'section_type' => 'required|in:download,register',
            'is_active' => 'boolean',
        ]);

        if ($request->hasFile('left_image')) {
            $validated['left_image'] = $request->file('left_image')->store('download-sections', 'public');
        }
        if ($request->hasFile('right_image')) {
            $validated['right_image'] = $request->file('right_image')->store('download-sections', 'public');
        }
        if ($request->hasFile('mobile_image')) {
            $validated['mobile_image'] = $request->file('mobile_image')->store('download-sections', 'public');
        }

        DownloadSection::create($validated);

        return redirect()->route('admin.download-sections.index')->with('success', 'Section created successfully!');
    }

    public function edit(DownloadSection $downloadSection)
    {
        return view('admin.download-sections.edit', compact('downloadSection'));
    }

    public function update(Request $request, DownloadSection $downloadSection)
    {
        $validated = $request->validate([
            'badge_text' => 'nullable|string|max:255',
            'heading' => 'required|string|max:255',
            'description' => 'nullable|string',
            'promo_text' => 'nullable|string|max:255',
            'google_play_url' => 'nullable|url|max:255',
            'app_store_url' => 'nullable|url|max:255',
            'button_text' => 'nullable|string|max:255',
            'button_url' => 'nullable|url|max:255',
            'left_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'right_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'mobile_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'section_type' => 'required|in:download,register',
            'is_active' => 'boolean',
        ]);

        if ($request->hasFile('left_image')) {
            if ($downloadSection->left_image) {
                Storage::disk('public')->delete($downloadSection->left_image);
            }
            $validated['left_image'] = $request->file('left_image')->store('download-sections', 'public');
        }
        if ($request->hasFile('right_image')) {
            if ($downloadSection->right_image) {
                Storage::disk('public')->delete($downloadSection->right_image);
            }
            $validated['right_image'] = $request->file('right_image')->store('download-sections', 'public');
        }
        if ($request->hasFile('mobile_image')) {
            if ($downloadSection->mobile_image) {
                Storage::disk('public')->delete($downloadSection->mobile_image);
            }
            $validated['mobile_image'] = $request->file('mobile_image')->store('download-sections', 'public');
        }

        $downloadSection->update($validated);

        return redirect()->route('admin.download-sections.index')->with('success', 'Section updated successfully!');
    }

    public function destroy(DownloadSection $downloadSection)
    {
        if ($downloadSection->left_image) {
            Storage::disk('public')->delete($downloadSection->left_image);
        }
        if ($downloadSection->right_image) {
            Storage::disk('public')->delete($downloadSection->right_image);
        }
        if ($downloadSection->mobile_image) {
            Storage::disk('public')->delete($downloadSection->mobile_image);
        }
        $downloadSection->delete();

        return redirect()->route('admin.download-sections.index')->with('success', 'Section deleted successfully!');
    }
}


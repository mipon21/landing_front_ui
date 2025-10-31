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
            'show_google_play' => 'boolean',
            'show_app_store' => 'boolean',
            'button_text' => 'nullable|string|max:255',
            'button_url' => 'nullable|url|max:255',
            'left_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'right_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'mobile_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'background_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'section_type' => 'required|in:download,register,deliveryman',
            'is_active' => 'boolean',
        ]);

        // Handle boolean fields for show toggles
        $validated['show_google_play'] = $request->has('show_google_play') ? true : false;
        $validated['show_app_store'] = $request->has('show_app_store') ? true : false;

        if ($request->hasFile('left_image')) {
            $validated['left_image'] = $request->file('left_image')->store('download-sections', 'public');
        }
        if ($request->hasFile('right_image')) {
            $validated['right_image'] = $request->file('right_image')->store('download-sections', 'public');
        }
        if ($request->hasFile('mobile_image')) {
            $validated['mobile_image'] = $request->file('mobile_image')->store('download-sections', 'public');
        }
        if ($request->hasFile('background_image')) {
            $validated['background_image'] = $request->file('background_image')->store('download-sections', 'public');
        }

        DownloadSection::create($validated);

        return redirect()->route('admin.download-sections.index')->with('success', 'Section created successfully!');
    }

    public function edit($id)
    {
        $downloadSection = DownloadSection::findOrFail($id);
        return view('admin.download-sections.edit', compact('downloadSection'));
    }

    public function update(Request $request, $id)
    {
        $downloadSection = DownloadSection::findOrFail($id);
        
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
            'background_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'section_type' => 'required|in:download,register,deliveryman',
            'is_active' => 'boolean',
        ]);

        // Handle boolean fields for show toggles
        if ($request->has('show_google_play')) {
            $validated['show_google_play'] = (bool) $request->show_google_play;
        } else {
            $validated['show_google_play'] = false;
        }
        if ($request->has('show_app_store')) {
            $validated['show_app_store'] = (bool) $request->show_app_store;
        } else {
            $validated['show_app_store'] = false;
        }

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
        if ($request->hasFile('background_image')) {
            if ($downloadSection->background_image) {
                Storage::disk('public')->delete($downloadSection->background_image);
            }
            $validated['background_image'] = $request->file('background_image')->store('download-sections', 'public');
        }

        $downloadSection->update($validated);

        return redirect()->route('admin.download-sections.index')->with('success', 'Section updated successfully!');
    }

    public function destroy($id)
    {
        $downloadSection = DownloadSection::findOrFail($id);
        if ($downloadSection->left_image) {
            Storage::disk('public')->delete($downloadSection->left_image);
        }
        if ($downloadSection->right_image) {
            Storage::disk('public')->delete($downloadSection->right_image);
        }
        if ($downloadSection->mobile_image) {
            Storage::disk('public')->delete($downloadSection->mobile_image);
        }
        if ($downloadSection->background_image) {
            Storage::disk('public')->delete($downloadSection->background_image);
        }
        $downloadSection->delete();

        return redirect()->route('admin.download-sections.index')->with('success', 'Section deleted successfully!');
    }
}


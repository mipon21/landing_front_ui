<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ServiceController extends Controller
{
    public function index()
    {
        $services = Service::orderBy('type')->get();
        return view('admin.services.index', compact('services'));
    }

    public function create()
    {
        return view('admin.services.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'type' => 'required|in:restaurant,customer',
            'badge_text' => 'nullable|string|max:255',
            'heading' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'button_text' => 'nullable|string|max:255',
            'button_url' => 'nullable|url|max:255',
            'is_active' => 'boolean',
        ]);

        $features = [];
        if ($request->has('feature_titles')) {
            foreach ($request->feature_titles as $index => $title) {
                if (!empty($title)) {
                    $features[] = [
                        'title' => $title,
                        'description' => $request->feature_descriptions[$index] ?? '',
                    ];
                }
            }
        }
        $validated['features'] = $features;

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('services', 'public');
        }

        Service::create($validated);

        return redirect()->route('admin.services.index')->with('success', 'Service created successfully!');
    }

    public function edit(Service $service)
    {
        return view('admin.services.edit', compact('service'));
    }

    public function update(Request $request, Service $service)
    {
        $validated = $request->validate([
            'type' => 'required|in:restaurant,customer',
            'badge_text' => 'nullable|string|max:255',
            'heading' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'button_text' => 'nullable|string|max:255',
            'button_url' => 'nullable|url|max:255',
            'is_active' => 'boolean',
        ]);

        $features = [];
        if ($request->has('feature_titles')) {
            foreach ($request->feature_titles as $index => $title) {
                if (!empty($title)) {
                    $features[] = [
                        'title' => $title,
                        'description' => $request->feature_descriptions[$index] ?? '',
                    ];
                }
            }
        }
        $validated['features'] = $features;

        if ($request->hasFile('image')) {
            if ($service->image) {
                Storage::disk('public')->delete($service->image);
            }
            $validated['image'] = $request->file('image')->store('services', 'public');
        }

        $service->update($validated);

        return redirect()->route('admin.services.index')->with('success', 'Service updated successfully!');
    }

    public function destroy(Service $service)
    {
        if ($service->image) {
            Storage::disk('public')->delete($service->image);
        }
        $service->delete();

        return redirect()->route('admin.services.index')->with('success', 'Service deleted successfully!');
    }
}


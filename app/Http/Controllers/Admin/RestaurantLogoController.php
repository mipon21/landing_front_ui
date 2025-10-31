<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\RestaurantLogo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class RestaurantLogoController extends Controller
{
    public function index()
    {
        $logos = RestaurantLogo::orderBy('sort_order')->get();
        return view('admin.restaurant-logos.index', compact('logos'));
    }

    public function create()
    {
        return view('admin.restaurant-logos.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'logo_image' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'alt_text' => 'nullable|string|max:255',
            'sort_order' => 'nullable|integer',
            'is_active' => 'boolean',
        ]);

        $validated['logo_image'] = $request->file('logo_image')->store('restaurant-logos', 'public');
        RestaurantLogo::create($validated);

        return redirect()->route('admin.restaurant-logos.index')->with('success', 'Restaurant logo added successfully!');
    }

    public function edit(RestaurantLogo $restaurantLogo)
    {
        return view('admin.restaurant-logos.edit', compact('restaurantLogo'));
    }

    public function update(Request $request, RestaurantLogo $restaurantLogo)
    {
        $validated = $request->validate([
            'logo_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'alt_text' => 'nullable|string|max:255',
            'sort_order' => 'nullable|integer',
            'is_active' => 'boolean',
        ]);

        if ($request->hasFile('logo_image')) {
            if ($restaurantLogo->logo_image) {
                Storage::disk('public')->delete($restaurantLogo->logo_image);
            }
            $validated['logo_image'] = $request->file('logo_image')->store('restaurant-logos', 'public');
        }

        $restaurantLogo->update($validated);

        return redirect()->route('admin.restaurant-logos.index')->with('success', 'Restaurant logo updated successfully!');
    }

    public function destroy(RestaurantLogo $restaurantLogo)
    {
        if ($restaurantLogo->logo_image) {
            Storage::disk('public')->delete($restaurantLogo->logo_image);
        }
        $restaurantLogo->delete();

        return redirect()->route('admin.restaurant-logos.index')->with('success', 'Restaurant logo deleted successfully!');
    }
}


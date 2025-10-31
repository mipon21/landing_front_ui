<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\RestaurantLogo;
use App\Models\SiteSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class RestaurantLogoController extends Controller
{
    public function index()
    {
        $logos = RestaurantLogo::orderBy('sort_order')->get();
        $registerButton = [
            'text' => SiteSetting::getValue('restaurant_section_button_text', 'Register Your Restaurant'),
            'url' => SiteSetting::getValue('restaurant_section_button_url', '#'),
        ];
        return view('admin.restaurant-logos.index', compact('logos', 'registerButton'));
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

    public function updateButton(Request $request)
    {
        $validated = $request->validate([
            'button_text' => 'required|string|max:255',
            'button_url' => 'required|url|max:255',
        ]);

        SiteSetting::setValue('restaurant_section_button_text', $validated['button_text'], 'text', 'Register button text below restaurant logos section');
        SiteSetting::setValue('restaurant_section_button_url', $validated['button_url'], 'url', 'Register button URL below restaurant logos section');

        return redirect()->route('admin.restaurant-logos.index')->with('success', 'Register button updated successfully!');
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Dish;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DishController extends Controller
{
    public function index()
    {
        $dishes = Dish::orderBy('sort_order')->get();
        return view('admin.dishes.index', compact('dishes'));
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
}


<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Testimonial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TestimonialController extends Controller
{
    public function index()
    {
        $testimonials = Testimonial::orderBy('sort_order')->get();
        return view('admin.testimonials.index', compact('testimonials'));
    }

    public function create()
    {
        return view('admin.testimonials.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'customer_image' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'customer_name' => 'required|string|max:255',
            'customer_location' => 'nullable|string|max:255',
            'customer_company' => 'nullable|string|max:255',
            'rating' => 'required|integer|min:1|max:5',
            'quote' => 'required|string',
            'full_review' => 'nullable|string',
            'sort_order' => 'nullable|integer',
            'is_active' => 'boolean',
        ]);

        $validated['customer_image'] = $request->file('customer_image')->store('testimonials', 'public');
        Testimonial::create($validated);

        return redirect()->route('admin.testimonials.index')->with('success', 'Testimonial added successfully!');
    }

    public function edit(Testimonial $testimonial)
    {
        return view('admin.testimonials.edit', compact('testimonial'));
    }

    public function update(Request $request, Testimonial $testimonial)
    {
        $validated = $request->validate([
            'customer_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'customer_name' => 'required|string|max:255',
            'customer_location' => 'nullable|string|max:255',
            'customer_company' => 'nullable|string|max:255',
            'rating' => 'required|integer|min:1|max:5',
            'quote' => 'required|string',
            'full_review' => 'nullable|string',
            'sort_order' => 'nullable|integer',
            'is_active' => 'boolean',
        ]);

        if ($request->hasFile('customer_image')) {
            if ($testimonial->customer_image) {
                Storage::disk('public')->delete($testimonial->customer_image);
            }
            $validated['customer_image'] = $request->file('customer_image')->store('testimonials', 'public');
        }

        $testimonial->update($validated);

        return redirect()->route('admin.testimonials.index')->with('success', 'Testimonial updated successfully!');
    }

    public function destroy(Testimonial $testimonial)
    {
        if ($testimonial->customer_image) {
            Storage::disk('public')->delete($testimonial->customer_image);
        }
        $testimonial->delete();

        return redirect()->route('admin.testimonials.index')->with('success', 'Testimonial deleted successfully!');
    }
}


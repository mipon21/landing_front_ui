<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HowItWork;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class HowItWorkController extends Controller
{
    public function index()
    {
        $steps = HowItWork::orderBy('sort_order')->get();
        return view('admin.how-it-works.index', compact('steps'));
    }

    public function create()
    {
        return view('admin.how-it-works.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'badge_text' => 'nullable|string|max:255',
            'heading' => 'required|string|max:255',
            'description' => 'nullable|string',
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

    public function edit(HowItWork $howItWork)
    {
        return view('admin.how-it-works.edit', compact('howItWork'));
    }

    public function update(Request $request, HowItWork $howItWork)
    {
        $validated = $request->validate([
            'badge_text' => 'nullable|string|max:255',
            'heading' => 'required|string|max:255',
            'description' => 'nullable|string',
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

    public function destroy(HowItWork $howItWork)
    {
        if ($howItWork->step_image) {
            Storage::disk('public')->delete($howItWork->step_image);
        }
        $howItWork->delete();

        return redirect()->route('admin.how-it-works.index')->with('success', 'Step deleted successfully!');
    }
}


<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Statistic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class StatisticController extends Controller
{
    public function index()
    {
        $statistics = Statistic::orderBy('sort_order')->get();
        return view('admin.statistics.index', compact('statistics'));
    }

    public function create()
    {
        return view('admin.statistics.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'icon' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'value' => 'required|string|max:255',
            'suffix' => 'nullable|string|max:10',
            'label' => 'required|string|max:255',
            'sort_order' => 'nullable|integer',
            'is_active' => 'boolean',
        ]);

        if ($request->hasFile('icon')) {
            $validated['icon'] = $request->file('icon')->store('statistics', 'public');
        }

        Statistic::create($validated);

        return redirect()->route('admin.statistics.index')->with('success', 'Statistic created successfully!');
    }

    public function edit(Statistic $statistic)
    {
        return view('admin.statistics.edit', compact('statistic'));
    }

    public function update(Request $request, Statistic $statistic)
    {
        $validated = $request->validate([
            'icon' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'value' => 'required|string|max:255',
            'suffix' => 'nullable|string|max:10',
            'label' => 'required|string|max:255',
            'sort_order' => 'nullable|integer',
            'is_active' => 'boolean',
        ]);

        if ($request->hasFile('icon')) {
            if ($statistic->icon) {
                Storage::disk('public')->delete($statistic->icon);
            }
            $validated['icon'] = $request->file('icon')->store('statistics', 'public');
        }

        $statistic->update($validated);

        return redirect()->route('admin.statistics.index')->with('success', 'Statistic updated successfully!');
    }

    public function destroy(Statistic $statistic)
    {
        if ($statistic->icon) {
            Storage::disk('public')->delete($statistic->icon);
        }
        $statistic->delete();

        return redirect()->route('admin.statistics.index')->with('success', 'Statistic deleted successfully!');
    }
}


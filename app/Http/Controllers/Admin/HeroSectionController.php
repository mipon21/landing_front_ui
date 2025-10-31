<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HeroSection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class HeroSectionController extends Controller
{
    public function edit()
    {
        $hero = HeroSection::first() ?? new HeroSection();
        return view('admin.hero.edit', compact('hero'));
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'typed_texts' => 'nullable|string',
            'heading' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'hero_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'background_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'google_play_url' => 'nullable|url',
            'app_store_url' => 'nullable|url',
            'google_play_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'app_store_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'video_url' => 'nullable|url',
            'active_users_text' => 'nullable|string',
            'rating_text' => 'nullable|string',
            'user_avatars' => 'nullable|string',
            'is_active' => 'boolean',
        ]);

        $hero = HeroSection::first() ?? new HeroSection();

        // Handle typed texts
        if ($request->has('typed_texts')) {
            $typedTexts = array_filter(explode("\n", $request->typed_texts));
            $validated['typed_texts'] = array_values($typedTexts);
        }

        // Handle user avatars
        if ($request->has('user_avatars')) {
            $avatars = array_filter(explode("\n", $request->user_avatars));
            $validated['user_avatars'] = array_values($avatars);
        }

        // Handle file uploads
        foreach (['hero_image', 'background_image', 'google_play_image', 'app_store_image'] as $field) {
            if ($request->hasFile($field)) {
                if ($hero->$field) {
                    Storage::disk('public')->delete($hero->$field);
                }
                $validated[$field] = $request->file($field)->store('hero', 'public');
            } elseif (!$hero->$field) {
                unset($validated[$field]);
            }
        }

        $hero->fill($validated);
        $hero->save();

        return redirect()->route('admin.hero.edit')->with('success', 'Hero section updated successfully!');
    }
}


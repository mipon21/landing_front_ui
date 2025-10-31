<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SiteSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AboutPageController extends Controller
{
    public function index()
    {
        // Overview Section
        $overview = [
            'badge_text' => SiteSetting::getValue('about_overview_badge', 'Overview'),
            'heading' => SiteSetting::getValue('about_overview_heading', 'How we serve best food on time to you in town.'),
            'description' => SiteSetting::getValue('about_overview_description', 'Lorem Ipsum is simply dummy text of the printing and typtting industry lorem Ipsum has been the industrys standard dummy text ever since.'),
            'features' => json_decode(SiteSetting::getValue('about_overview_features', '[]'), true),
            'button_text' => SiteSetting::getValue('about_overview_button_text', 'Start Free Trial'),
            'button_url' => SiteSetting::getValue('about_overview_button_url', '#'),
            'image' => SiteSetting::getValue('about_overview_image', null),
            'video_url' => SiteSetting::getValue('about_overview_video_url', null),
        ];

        // Statistics Section
        $statistics = [
            'badge_text' => SiteSetting::getValue('about_statistics_badge', 'Why choos us'),
            'heading' => SiteSetting::getValue('about_statistics_heading', 'Company statistics'),
            'description' => SiteSetting::getValue('about_statistics_description', 'Lorem Ipsum is simply dummy text of the printing indus orem Ipsum has been the industrys standard dummy text ever since.'),
            'stats' => json_decode(SiteSetting::getValue('about_statistics_data', '[]'), true),
        ];

        // About Us Section
        $aboutUs = [
            'badge_text' => SiteSetting::getValue('about_about_badge', 'Who we are'),
            'heading' => SiteSetting::getValue('about_about_heading', 'Fastest delivery in town: Enjoy tasty dishes at your place any time!'),
            'description' => SiteSetting::getValue('about_about_description', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry lorem Ipsum has been the industrys standard dummy text ever since the when an unknown printer took a galley of type and scrambled it to make a type specimen book.'),
            'slider_images' => json_decode(SiteSetting::getValue('about_about_slider_images', '[]'), true),
        ];

        // Facts Section
        $facts = [
            'badge_text' => SiteSetting::getValue('about_facts_badge', 'Some Fact'),
            'heading' => SiteSetting::getValue('about_facts_heading', 'Why we best for food delivery'),
            'description' => SiteSetting::getValue('about_facts_description', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry lorem Ipsum has been the industrys standard dummy.'),
            'features' => json_decode(SiteSetting::getValue('about_facts_features', '[]'), true),
            'button_text' => SiteSetting::getValue('about_facts_button_text', 'Start Free Trial'),
            'button_url' => SiteSetting::getValue('about_facts_button_url', '#'),
            'image' => SiteSetting::getValue('about_facts_image', null),
        ];

        // Text Flow Section
        $textFlow = json_decode(SiteSetting::getValue('about_text_flow', '[]'), true);

        // CTA Section
        $cta = [
            'heading' => SiteSetting::getValue('about_cta_heading', 'Need support?'),
            'description' => SiteSetting::getValue('about_cta_description', 'Lorem Ipsum is simply dummy text of the printing.'),
            'call_text' => SiteSetting::getValue('about_cta_call_text', 'Call us now'),
            'call_url' => SiteSetting::getValue('about_cta_call_url', 'tel:123-456-7890'),
            'email_text' => SiteSetting::getValue('about_cta_email_text', 'Email us'),
            'email_url' => SiteSetting::getValue('about_cta_email_url', 'mailto:someone@example.com'),
        ];

        return view('admin.about-pages.index', compact('overview', 'statistics', 'aboutUs', 'facts', 'textFlow', 'cta'));
    }

    public function updateOverview(Request $request)
    {
        $validated = $request->validate([
            'badge_text' => 'nullable|string|max:255',
            'heading' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'features' => 'nullable|array',
            'features.*' => 'string|max:500',
            'button_text' => 'nullable|string|max:255',
            'button_url' => 'nullable|url|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'video_url' => 'nullable|url|max:500',
        ]);

        SiteSetting::setValue('about_overview_badge', $validated['badge_text'] ?? '', 'string', 'About page overview section badge text.');
        SiteSetting::setValue('about_overview_heading', $validated['heading'] ?? '', 'string', 'About page overview section heading.');
        SiteSetting::setValue('about_overview_description', $validated['description'] ?? '', 'string', 'About page overview section description.');
        SiteSetting::setValue('about_overview_features', json_encode($validated['features'] ?? []), 'json', 'About page overview section features list.');
        SiteSetting::setValue('about_overview_button_text', $validated['button_text'] ?? '', 'string', 'About page overview section button text.');
        SiteSetting::setValue('about_overview_button_url', $validated['button_url'] ?? '#', 'string', 'About page overview section button URL.');
        SiteSetting::setValue('about_overview_video_url', $validated['video_url'] ?? '', 'string', 'About page overview section video URL.');

        if ($request->hasFile('image')) {
            $oldImage = SiteSetting::getValue('about_overview_image', null);
            if ($oldImage) {
                Storage::disk('public')->delete($oldImage);
            }
            $imagePath = $request->file('image')->store('about-pages', 'public');
            SiteSetting::setValue('about_overview_image', $imagePath, 'string', 'About page overview section image.');
        }

        return redirect()->route('admin.about-pages.index')->with('success', 'Overview section updated successfully!');
    }

    public function updateStatistics(Request $request)
    {
        $validated = $request->validate([
            'badge_text' => 'nullable|string|max:255',
            'heading' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'stats' => 'required|array|size:4',
            'stats.*.icon' => 'nullable|string|max:255',
            'stats.*.value' => 'nullable|string|max:50',
            'stats.*.label' => 'nullable|string|max:255',
        ]);

        SiteSetting::setValue('about_statistics_badge', $validated['badge_text'] ?? '', 'string', 'About page statistics section badge text.');
        SiteSetting::setValue('about_statistics_heading', $validated['heading'] ?? '', 'string', 'About page statistics section heading.');
        SiteSetting::setValue('about_statistics_description', $validated['description'] ?? '', 'string', 'About page statistics section description.');
        SiteSetting::setValue('about_statistics_data', json_encode($validated['stats'] ?? []), 'json', 'About page statistics data.');

        return redirect()->route('admin.about-pages.index')->with('success', 'Statistics section updated successfully!');
    }

    public function updateAboutUs(Request $request)
    {
        $validated = $request->validate([
            'badge_text' => 'nullable|string|max:255',
            'heading' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'slider_images' => 'nullable|array',
            'slider_images.*' => 'image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

        SiteSetting::setValue('about_about_badge', $validated['badge_text'] ?? '', 'string', 'About page about us section badge text.');
        SiteSetting::setValue('about_about_heading', $validated['heading'] ?? '', 'string', 'About page about us section heading.');
        SiteSetting::setValue('about_about_description', $validated['description'] ?? '', 'string', 'About page about us section description.');

        if ($request->hasFile('slider_images')) {
            $images = [];
            foreach ($request->file('slider_images') as $file) {
                $images[] = $file->store('about-pages/slider', 'public');
            }
            SiteSetting::setValue('about_about_slider_images', json_encode($images), 'json', 'About page slider images.');
        }

        return redirect()->route('admin.about-pages.index')->with('success', 'About Us section updated successfully!');
    }

    public function updateFacts(Request $request)
    {
        $validated = $request->validate([
            'badge_text' => 'nullable|string|max:255',
            'heading' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'features' => 'nullable|array',
            'features.*' => 'string|max:500',
            'button_text' => 'nullable|string|max:255',
            'button_url' => 'nullable|url|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

        SiteSetting::setValue('about_facts_badge', $validated['badge_text'] ?? '', 'string', 'About page facts section badge text.');
        SiteSetting::setValue('about_facts_heading', $validated['heading'] ?? '', 'string', 'About page facts section heading.');
        SiteSetting::setValue('about_facts_description', $validated['description'] ?? '', 'string', 'About page facts section description.');
        SiteSetting::setValue('about_facts_features', json_encode($validated['features'] ?? []), 'json', 'About page facts section features list.');
        SiteSetting::setValue('about_facts_button_text', $validated['button_text'] ?? '', 'string', 'About page facts section button text.');
        SiteSetting::setValue('about_facts_button_url', $validated['button_url'] ?? '#', 'string', 'About page facts section button URL.');

        if ($request->hasFile('image')) {
            $oldImage = SiteSetting::getValue('about_facts_image', null);
            if ($oldImage) {
                Storage::disk('public')->delete($oldImage);
            }
            $imagePath = $request->file('image')->store('about-pages', 'public');
            SiteSetting::setValue('about_facts_image', $imagePath, 'string', 'About page facts section image.');
        }

        return redirect()->route('admin.about-pages.index')->with('success', 'Facts section updated successfully!');
    }

    public function updateTextFlow(Request $request)
    {
        $validated = $request->validate([
            'items' => 'nullable|array',
            'items.*' => 'string|max:255',
        ]);

        SiteSetting::setValue('about_text_flow', json_encode($validated['items'] ?? []), 'json', 'About page text flow items.');

        return redirect()->route('admin.about-pages.index')->with('success', 'Text Flow section updated successfully!');
    }

    public function updateCta(Request $request)
    {
        $validated = $request->validate([
            'heading' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'call_text' => 'nullable|string|max:255',
            'call_url' => 'nullable|string|max:255',
            'email_text' => 'nullable|string|max:255',
            'email_url' => 'nullable|email|max:255',
        ]);

        SiteSetting::setValue('about_cta_heading', $validated['heading'] ?? '', 'string', 'About page CTA section heading.');
        SiteSetting::setValue('about_cta_description', $validated['description'] ?? '', 'string', 'About page CTA section description.');
        SiteSetting::setValue('about_cta_call_text', $validated['call_text'] ?? '', 'string', 'About page CTA call button text.');
        SiteSetting::setValue('about_cta_call_url', $validated['call_url'] ?? '', 'string', 'About page CTA call button URL.');
        SiteSetting::setValue('about_cta_email_text', $validated['email_text'] ?? '', 'string', 'About page CTA email button text.');
        SiteSetting::setValue('about_cta_email_url', $validated['email_url'] ?? '', 'string', 'About page CTA email button URL.');

        return redirect()->route('admin.about-pages.index')->with('success', 'CTA section updated successfully!');
    }
}

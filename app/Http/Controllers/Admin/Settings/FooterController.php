<?php

namespace App\Http\Controllers\Admin\Settings;

use App\Http\Controllers\Controller;
use App\Models\FooterMenu;
use App\Models\SiteSetting;
use App\Models\SocialLink;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FooterController extends Controller
{
    public function index()
    {
        // Get footer logo
        $footerLogo = SiteSetting::getValue('footer_logo', null);
        
        // Get footer details/description
        $footerDetails = SiteSetting::getValue('footer_details', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry lorem sum has been the industrys standard dummytext ever since the when an unknown printer took.');
        
        // Get pre-footer CTA section settings
        $preFooterCta = [
            'heading' => SiteSetting::getValue('pre_footer_cta_heading', 'Need support?'),
            'description' => SiteSetting::getValue('pre_footer_cta_description', 'Lorem Ipsum is simply dummy text of the printing.'),
            'call_text' => SiteSetting::getValue('pre_footer_cta_call_text', 'Call us now'),
            'call_url' => SiteSetting::getValue('pre_footer_cta_call_url', 'tel:123-456-7890'),
            'show_call_button' => (bool) SiteSetting::getValue('pre_footer_cta_show_call', '1'),
            'email_text' => SiteSetting::getValue('pre_footer_cta_email_text', 'Email us'),
            'email_url' => SiteSetting::getValue('pre_footer_cta_email_url', 'mailto:someone@example.com'),
            'show_email_button' => (bool) SiteSetting::getValue('pre_footer_cta_show_email', '1'),
        ];

        // Get footer menus by type
        $quickLinks = FooterMenu::ofType('quick_links')
            ->orderBy('sort_order')
            ->get();
        
        $supportMenus = FooterMenu::ofType('support')
            ->orderBy('sort_order')
            ->get();

        // Get app store button settings
        $appStoreButtons = [
            'app_store_url' => SiteSetting::getValue('footer_app_store_url', '#'),
            'google_play_url' => SiteSetting::getValue('footer_google_play_url', '#'),
            'show_app_store' => (bool) SiteSetting::getValue('footer_show_app_store', '1'),
            'show_google_play' => (bool) SiteSetting::getValue('footer_show_google_play', '1'),
        ];

        // Get social links
        $socialLinks = SocialLink::active()->orderBy('sort_order')->get();

        // Get copyright text
        $copyrightText = SiteSetting::getValue('footer_copyright_text', '© Copyrights %Y. All rights reserved.');

        // Get newsletter backend URL
        $newsletterBackendUrl = SiteSetting::getValue('newsletter_backend_url', 'https://tastyso.com/newsletter');

        return view('admin.settings.footer.index', compact(
            'footerLogo',
            'footerDetails',
            'preFooterCta',
            'quickLinks',
            'supportMenus',
            'appStoreButtons',
            'socialLinks',
            'copyrightText',
            'newsletterBackendUrl'
        ));
    }

    public function updateLogo(Request $request)
    {
        $request->validate([
            'logo' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

        // Delete old logo if exists
        $oldLogo = SiteSetting::getValue('footer_logo', null);
        if ($oldLogo) {
            Storage::disk('public')->delete($oldLogo);
        }

        // Upload new logo
        $logoPath = $request->file('logo')->store('footer', 'public');
        SiteSetting::setValue('footer_logo', $logoPath, 'string', 'Footer logo image.');

        return redirect()->route('admin.settings.footer.index')->with('success', 'Footer logo updated successfully!');
    }

    public function deleteLogo()
    {
        $logo = SiteSetting::getValue('footer_logo', null);
        if ($logo) {
            Storage::disk('public')->delete($logo);
            SiteSetting::where('key', 'footer_logo')->delete();
        }

        return redirect()->route('admin.settings.footer.index')->with('success', 'Footer logo deleted successfully!');
    }

    public function updateDetails(Request $request)
    {
        $request->validate([
            'details' => 'required|string|max:1000',
        ]);

        SiteSetting::setValue('footer_details', $request->details, 'text', 'Footer description/details text.');

        return redirect()->route('admin.settings.footer.index')->with('success', 'Footer details updated successfully!');
    }

    public function updatePreFooterCta(Request $request)
    {
        $validated = $request->validate([
            'heading' => 'required|string|max:255',
            'description' => 'required|string|max:500',
            'call_text' => 'required|string|max:255',
            'call_url' => 'required|string|max:255',
            'show_call_button' => 'boolean',
            'email_text' => 'required|string|max:255',
            'email_url' => 'required|string|max:255', // Changed from 'email' to 'string' to allow mailto: URLs
            'show_email_button' => 'boolean',
        ]);

        SiteSetting::setValue('pre_footer_cta_heading', $validated['heading'], 'string', 'Pre-footer CTA section heading.');
        SiteSetting::setValue('pre_footer_cta_description', $validated['description'], 'string', 'Pre-footer CTA section description.');
        SiteSetting::setValue('pre_footer_cta_call_text', $validated['call_text'], 'string', 'Pre-footer CTA call button text.');
        SiteSetting::setValue('pre_footer_cta_call_url', $validated['call_url'], 'string', 'Pre-footer CTA call button URL.');
        SiteSetting::setValue('pre_footer_cta_show_call', $validated['show_call_button'] ?? false ? '1' : '0', 'string', 'Pre-footer CTA call button visibility.');
        SiteSetting::setValue('pre_footer_cta_email_text', $validated['email_text'], 'string', 'Pre-footer CTA email button text.');
        SiteSetting::setValue('pre_footer_cta_email_url', $validated['email_url'], 'string', 'Pre-footer CTA email button URL.');
        SiteSetting::setValue('pre_footer_cta_show_email', $validated['show_email_button'] ?? false ? '1' : '0', 'string', 'Pre-footer CTA email button visibility.');

        return redirect()->route('admin.settings.footer.index')->with('success', 'Pre-footer CTA section updated successfully!');
    }

    public function storeMenu(Request $request)
    {
        $validated = $request->validate([
            'menu_type' => 'required|in:quick_links,support',
            'label' => 'required|string|max:255',
            'url' => 'nullable|string|max:255',
            'sort_order' => 'nullable|integer|min:0',
            'is_active' => 'boolean',
        ]);

        if (!isset($validated['sort_order'])) {
            $maxOrder = FooterMenu::ofType($validated['menu_type'])
                ->max('sort_order') ?? 0;
            $validated['sort_order'] = $maxOrder + 1;
        }

        if (!isset($validated['is_active'])) {
            $validated['is_active'] = true;
        }

        FooterMenu::create($validated);

        return redirect()->route('admin.settings.footer.index')->with('success', 'Footer menu item created successfully!');
    }

    public function updateMenu(Request $request, $id)
    {
        $menu = FooterMenu::findOrFail($id);

        $validated = $request->validate([
            'menu_type' => 'required|in:quick_links,support',
            'label' => 'required|string|max:255',
            'url' => 'nullable|string|max:255',
            'sort_order' => 'nullable|integer|min:0',
            'is_active' => 'boolean',
        ]);

        $menu->update($validated);

        return redirect()->route('admin.settings.footer.index')->with('success', 'Footer menu item updated successfully!');
    }

    public function destroyMenu($id)
    {
        $menu = FooterMenu::findOrFail($id);
        $menu->delete();

        return redirect()->route('admin.settings.footer.index')->with('success', 'Footer menu item deleted successfully!');
    }

    public function updateAppStoreButtons(Request $request)
    {
        $validated = $request->validate([
            'app_store_url' => 'nullable|url|max:255',
            'google_play_url' => 'nullable|url|max:255',
            'show_app_store' => 'boolean',
            'show_google_play' => 'boolean',
        ]);

        SiteSetting::setValue('footer_app_store_url', $validated['app_store_url'] ?? '#', 'string', 'Footer App Store button URL.');
        SiteSetting::setValue('footer_google_play_url', $validated['google_play_url'] ?? '#', 'string', 'Footer Google Play button URL.');
        SiteSetting::setValue('footer_show_app_store', $validated['show_app_store'] ?? false ? '1' : '0', 'string', 'Footer App Store button visibility.');
        SiteSetting::setValue('footer_show_google_play', $validated['show_google_play'] ?? false ? '1' : '0', 'string', 'Footer Google Play button visibility.');

        return redirect()->route('admin.settings.footer.index')->with('success', 'App Store buttons updated successfully!');
    }

    public function updateCopyrightText(Request $request)
    {
        $validated = $request->validate([
            'copyright_text' => 'required|string|max:500',
        ]);

        SiteSetting::setValue('footer_copyright_text', $validated['copyright_text'], 'string', 'Footer copyright text (%Y will be replaced with current year).');

        return redirect()->route('admin.settings.footer.index')->with('success', 'Copyright text updated successfully!');
    }

    public function updateNewsletterBackendUrl(Request $request)
    {
        $validated = $request->validate([
            'backend_url' => 'required|url|max:500',
        ]);

        SiteSetting::setValue('newsletter_backend_url', $validated['backend_url'], 'string', 'Newsletter subscription backend processing URL.');

        return redirect()->route('admin.settings.footer.index')->with('success', 'Newsletter backend URL updated successfully!');
    }

    public function storeSocialLink(Request $request)
    {
        $validated = $request->validate([
            'platform' => 'required|string|max:255',
            'icon_class' => 'nullable|string|max:255',
            'url' => 'required|url|max:255',
            'label' => 'nullable|string|max:255',
            'sort_order' => 'nullable|integer|min:0',
            'is_active' => 'boolean',
        ]);

        if (!isset($validated['sort_order'])) {
            $maxOrder = SocialLink::max('sort_order') ?? 0;
            $validated['sort_order'] = $maxOrder + 1;
        }

        if (!isset($validated['is_active'])) {
            $validated['is_active'] = true;
        }

        // Set default icon class based on platform if not provided
        if (empty($validated['icon_class'])) {
            $iconMap = [
                'facebook' => 'icofont-facebook',
                'twitter' => 'icofont-twitter',
                'instagram' => 'icofont-instagram',
                'pinterest' => 'icofont-pinterest',
                'linkedin' => 'icofont-linkedin',
                'youtube' => 'icofont-youtube',
            ];
            $validated['icon_class'] = $iconMap[strtolower($validated['platform'])] ?? 'icofont-link';
        }

        SocialLink::create($validated);

        return redirect()->route('admin.settings.footer.index')->with('success', 'Social link created successfully!');
    }

    public function updateSocialLink(Request $request, $id)
    {
        $socialLink = SocialLink::findOrFail($id);

        $validated = $request->validate([
            'platform' => 'required|string|max:255',
            'icon_class' => 'nullable|string|max:255',
            'url' => 'required|url|max:255',
            'label' => 'nullable|string|max:255',
            'sort_order' => 'nullable|integer|min:0',
            'is_active' => 'boolean',
        ]);

        $socialLink->update($validated);

        return redirect()->route('admin.settings.footer.index')->with('success', 'Social link updated successfully!');
    }

    public function destroySocialLink($id)
    {
        $socialLink = SocialLink::findOrFail($id);
        $socialLink->delete();

        return redirect()->route('admin.settings.footer.index')->with('success', 'Social link deleted successfully!');
    }
}
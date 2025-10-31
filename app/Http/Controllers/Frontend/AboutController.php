<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\FooterMenu;
use App\Models\HeaderMenu;
use App\Models\SocialLink;
use App\Models\SiteSetting;
use App\Models\Testimonial;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    public function index()
    {
        // Get header data (reusable)
        $headerLogo = SiteSetting::getValue('header_logo', null);
        $headerMenus = HeaderMenu::topLevel()->active()->with(['children' => function($query) {
            $query->active();
        }])->orderBy('sort_order')->get();
        $headerCta = [
            'text' => SiteSetting::getValue('header_cta_text', '7 Days Free Trial'),
            'url' => SiteSetting::getValue('header_cta_url', '#'),
        ];

        // General site settings
        $siteName = SiteSetting::getValue('site_name', 'Food Delivery Mobile App Landing Page');
        $siteDescription = SiteSetting::getValue('site_description', 'Order your favorite meals with ease using our Food Delivery mobile app.');
        $siteFavicon = SiteSetting::getValue('site_favicon', null);

        // About page sections
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

        $statistics = [
            'badge_text' => SiteSetting::getValue('about_statistics_badge', 'Why choos us'),
            'heading' => SiteSetting::getValue('about_statistics_heading', 'Company statistics'),
            'description' => SiteSetting::getValue('about_statistics_description', 'Lorem Ipsum is simply dummy text of the printing indus orem Ipsum has been the industrys standard dummy text ever since.'),
            'stats' => json_decode(SiteSetting::getValue('about_statistics_data', json_encode([
                ['icon' => 'uspa.webp', 'value' => '150', 'label' => 'Countries'],
                ['icon' => 'uspb.webp', 'value' => '2300', 'label' => 'Reviews'],
                ['icon' => 'uspc.webp', 'value' => '08', 'label' => 'Followers'],
                ['icon' => 'uspd.webp', 'value' => '17', 'label' => 'Download'],
            ])), true),
        ];

        $aboutUs = [
            'badge_text' => SiteSetting::getValue('about_about_badge', 'Who we are'),
            'heading' => SiteSetting::getValue('about_about_heading', 'Fastest delivery in town: Enjoy tasty dishes at your place any time!'),
            'description' => SiteSetting::getValue('about_about_description', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry lorem Ipsum has been the industrys standard dummy text ever since the when an unknown printer took a galley of type and scrambled it to make a type specimen book.'),
            'slider_images' => json_decode(SiteSetting::getValue('about_about_slider_images', '[]'), true),
        ];

        $facts = [
            'badge_text' => SiteSetting::getValue('about_facts_badge', 'Some Fact'),
            'heading' => SiteSetting::getValue('about_facts_heading', 'Why we best for food delivery'),
            'description' => SiteSetting::getValue('about_facts_description', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry lorem Ipsum has been the industrys standard dummy.'),
            'features' => json_decode(SiteSetting::getValue('about_facts_features', '[]'), true),
            'button_text' => SiteSetting::getValue('about_facts_button_text', 'Start Free Trial'),
            'button_url' => SiteSetting::getValue('about_facts_button_url', '#'),
            'image' => SiteSetting::getValue('about_facts_image', null),
        ];

        $textFlow = json_decode(SiteSetting::getValue('about_text_flow', json_encode([
            '30 Min Delivery',
            'Quality Food',
            '1000+ Dishes',
            'Live Map Track',
            '24/7 Support',
            '25k+ Happy Users',
            '4.9 Ratings',
            '500+ Restaurants',
        ])), true);

        $team = [
            'badge_text' => SiteSetting::getValue('about_team_badge', 'Experts'),
            'heading' => SiteSetting::getValue('about_team_heading', 'Meet our team'),
            'description' => SiteSetting::getValue('about_team_description', 'Lorem Ipsum is simply dummy text of the printing indus orem Ipsum has been the industrys standard dummy text ever since.'),
            'members' => json_decode(SiteSetting::getValue('about_team_members', '[]'), true),
        ];

        $faq = [
            'badge_text' => SiteSetting::getValue('about_faq_badge', 'Question & Answer'),
            'heading' => SiteSetting::getValue('about_faq_heading', 'FAQs - Frequently Asked Questions'),
            'items' => json_decode(SiteSetting::getValue('about_faq_items', '[]'), true),
        ];

        $cta = [
            'heading' => SiteSetting::getValue('about_cta_heading', 'Need support?'),
            'description' => SiteSetting::getValue('about_cta_description', 'Lorem Ipsum is simply dummy text of the printing.'),
            'call_text' => SiteSetting::getValue('about_cta_call_text', 'Call us now'),
            'call_url' => SiteSetting::getValue('about_cta_call_url', 'tel:123-456-7890'),
            'email_text' => SiteSetting::getValue('about_cta_email_text', 'Email us'),
            'email_url' => SiteSetting::getValue('about_cta_email_url', 'mailto:someone@example.com'),
        ];

        // Get testimonials for the testimonials section
        $testimonials = Testimonial::active()->get();

        // Footer settings
        $footerLogo = SiteSetting::getValue('footer_logo', null);
        $footerDetails = SiteSetting::getValue('footer_details', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry lorem sum has been the industrys standard dummytext ever since the when an unknown printer took.');
        $footerQuickLinks = FooterMenu::ofType('quick_links')->active()->orderBy('sort_order')->get();
        $footerSupportMenus = FooterMenu::ofType('support')->active()->orderBy('sort_order')->get();
        $footerAppStoreButtons = [
            'app_store_url' => SiteSetting::getValue('footer_app_store_url', '#'),
            'google_play_url' => SiteSetting::getValue('footer_google_play_url', '#'),
            'show_app_store' => (bool) SiteSetting::getValue('footer_show_app_store', '1'),
            'show_google_play' => (bool) SiteSetting::getValue('footer_show_google_play', '1'),
        ];
        $footerSocialLinks = SocialLink::active()->orderBy('sort_order')->get();
        $footerCopyrightText = SiteSetting::getValue('footer_copyright_text', '© Copyrights %Y. All rights reserved.');

        // Pre-footer CTA settings
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

        return view('frontend.about', compact(
            'headerLogo',
            'headerMenus',
            'headerCta',
            'siteName',
            'siteDescription',
            'siteFavicon',
            'overview',
            'statistics',
            'aboutUs',
            'facts',
            'textFlow',
            'team',
            'faq',
            'cta',
            'testimonials',
            'footerLogo',
            'footerDetails',
            'footerQuickLinks',
            'footerSupportMenus',
            'footerAppStoreButtons',
            'footerSocialLinks',
            'footerCopyrightText',
            'preFooterCta'
        ));
    }
}

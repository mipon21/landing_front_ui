<?php

namespace App\Http\Controllers\Admin\Settings;

use App\Http\Controllers\Controller;
use App\Models\SiteSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GeneralSettingsController extends Controller
{
    public function index()
    {
        // Get current settings
        $favicon = SiteSetting::getValue('site_favicon', null);
        $siteName = SiteSetting::getValue('site_name', 'Food Delivery Mobile App Landing Page');
        $siteDescription = SiteSetting::getValue('site_description', 'Order your favorite meals with ease using our Food Delivery mobile app. Browse local restaurants, customize your order, and enjoy fast, reliable delivery straight to your door. Download now for convenient, delicious dining at your fingertips.');

        return view('admin.settings.general.index', compact('favicon', 'siteName', 'siteDescription'));
    }

    public function updateFavicon(Request $request)
    {
        $request->validate([
            'favicon' => 'required|image|mimes:ico,png,jpg,jpeg,gif|max:512',
        ]);

        // Delete old favicon if exists
        $oldFavicon = SiteSetting::getValue('site_favicon', null);
        if ($oldFavicon) {
            Storage::disk('public')->delete($oldFavicon);
        }

        // Upload new favicon
        $faviconPath = $request->file('favicon')->store('settings', 'public');
        SiteSetting::setValue('site_favicon', $faviconPath, 'string', 'Site favicon image.');

        return redirect()->route('admin.settings.general.index')->with('success', 'Favicon updated successfully!');
    }

    public function deleteFavicon()
    {
        $favicon = SiteSetting::getValue('site_favicon', null);
        if ($favicon) {
            Storage::disk('public')->delete($favicon);
            SiteSetting::where('key', 'site_favicon')->delete();
        }

        return redirect()->route('admin.settings.general.index')->with('success', 'Favicon deleted successfully!');
    }

    public function updateSiteInfo(Request $request)
    {
        $request->validate([
            'site_name' => 'required|string|max:255',
            'site_description' => 'required|string|max:500',
        ]);

        SiteSetting::setValue('site_name', $request->site_name, 'string', 'Site name/title.');
        SiteSetting::setValue('site_description', $request->site_description, 'string', 'Site meta description.');

        return redirect()->route('admin.settings.general.index')->with('success', 'Site information updated successfully!');
    }
}

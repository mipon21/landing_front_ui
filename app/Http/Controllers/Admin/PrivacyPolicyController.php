<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SiteSetting;
use Illuminate\Http\Request;

class PrivacyPolicyController extends Controller
{
    public function index()
    {
        $content = SiteSetting::getValue('privacy_policy_content', '');
        
        return view('admin.privacy-policy.index', compact('content'));
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'content' => 'required|string',
        ]);

        SiteSetting::setValue('privacy_policy_content', $validated['content'], 'text', 'Privacy Policy page content.');

        return redirect()->route('admin.privacy-policy.index')->with('success', 'Privacy Policy updated successfully!');
    }
}

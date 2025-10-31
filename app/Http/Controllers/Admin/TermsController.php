<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SiteSetting;
use Illuminate\Http\Request;

class TermsController extends Controller
{
    public function index()
    {
        $content = SiteSetting::getValue('terms_conditions_content', '');
        
        return view('admin.terms.index', compact('content'));
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'content' => 'required|string',
        ]);

        SiteSetting::setValue('terms_conditions_content', $validated['content'], 'text', 'Terms & Conditions page content.');

        return redirect()->route('admin.terms.index')->with('success', 'Terms & Conditions updated successfully!');
    }
}

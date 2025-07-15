<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CompanyController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
    }

    /**
     * Display company information
     */
    public function index()
    {
        $company = Company::first();
        return view('admin.company.index', compact('company'));
    }

    /**
     * Show the form for editing company information
     */
    public function edit()
    {
        $company = Company::first();
        if (!$company) {
            $company = new Company();
        }
        return view('admin.company.edit', compact('company'));
    }

    /**
     * Update company information
     */
    public function update(Request $request)
    {
        $request->validate([
            'name_en' => 'required|string|max:255',
            'name_ar' => 'required|string|max:255',
            'about_en' => 'nullable|string',
            'about_ar' => 'nullable|string',
            'mission_en' => 'nullable|string',
            'mission_ar' => 'nullable|string',
            'vision_en' => 'nullable|string',
            'vision_ar' => 'nullable|string',
            'values_en' => 'nullable|string',
            'values_ar' => 'nullable|string',
            'email' => 'nullable|email|max:255',
            'phone' => 'nullable|string|max:255',
            'address' => 'nullable|string|max:500',
            'website' => 'nullable|url|max:255',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'favicon' => 'nullable|file|mimes:ico,png|max:1024',
        ]);

        $company = Company::first();
        if (!$company) {
            $company = new Company();
        }

        // Handle logo upload
        if ($request->hasFile('logo')) {
            // Delete old logo if exists
            if ($company->logo && Storage::disk('public')->exists($company->logo)) {
                Storage::disk('public')->delete($company->logo);
            }

            $logoPath = $request->file('logo')->store('company', 'public');
            $company->logo = $logoPath;
        }

        // Handle favicon upload
        if ($request->hasFile('favicon')) {
            // Delete old favicon if exists
            if ($company->favicon && Storage::disk('public')->exists($company->favicon)) {
                Storage::disk('public')->delete($company->favicon);
            }

            $faviconPath = $request->file('favicon')->store('company', 'public');
            $company->favicon = $faviconPath;
        }

        // Prepare multilingual data
        $company->name = [
            'en' => $request->name_en,
            'ar' => $request->name_ar,
        ];

        $company->about = [
            'en' => $this->cleanHtml($request->about_en),
            'ar' => $this->cleanHtml($request->about_ar),
        ];

        $company->mission = [
            'en' => $this->cleanHtml($request->mission_en),
            'ar' => $this->cleanHtml($request->mission_ar),
        ];

        $company->vision = [
            'en' => $this->cleanHtml($request->vision_en),
            'ar' => $this->cleanHtml($request->vision_ar),
        ];

        $company->values = [
            'en' => $this->cleanHtml($request->values_en),
            'ar' => $this->cleanHtml($request->values_ar),
        ];

        $company->email = $request->email;
        $company->phone = $request->phone;
        $company->address = $request->address;
        $company->website = $request->website;
        $company->is_active = true;

        $company->save();

        return redirect()->route('admin.company.index')
            ->with('success', __('admin.success_updated'));
    }

    /**
     * Clean HTML content - allow basic formatting tags
     */
    private function cleanHtml($content)
    {
        if (empty($content)) {
            return null;
        }

        // Allow basic HTML tags for formatting
        $allowedTags = '<p><br><strong><b><em><i><u><ul><ol><li><h1><h2><h3><h4><h5><h6><a><span><div>';

        // Strip unwanted tags but keep allowed ones
        $cleaned = strip_tags($content, $allowedTags);

        // Remove any potentially dangerous attributes
        $cleaned = preg_replace('/(<[^>]+) (on\w+|javascript:|vbscript:|data:)[^>]*>/i', '$1>', $cleaned);

        return trim($cleaned);
    }
}

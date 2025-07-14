<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ServiceController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
    }

    /**
     * Display a listing of services
     */
    public function index()
    {
        $services = Service::orderBy('sort_order')->get();
        return view('admin.services.index', compact('services'));
    }

    /**
     * Show the form for creating a new service
     */
    public function create()
    {
        return view('admin.services.create');
    }

    /**
     * Store a newly created service
     */
    public function store(Request $request)
    {
        $request->validate([
            'title_en' => 'required|string|max:255',
            'title_ar' => 'required|string|max:255',
            'description_en' => 'required|string',
            'description_ar' => 'required|string',
            'content_en' => 'nullable|string',
            'content_ar' => 'nullable|string',
            'icon' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'sort_order' => 'nullable|integer|min:0',
        ]);

        $service = new Service();

        // Handle icon upload
        if ($request->hasFile('icon')) {
            $iconPath = $request->file('icon')->store('services', 'public');
            $service->icon = $iconPath;
        }

        $service->title = [
            'en' => $request->title_en,
            'ar' => $request->title_ar,
        ];

        $service->description = [
            'en' => $request->description_en,
            'ar' => $request->description_ar,
        ];

        $service->content = [
            'en' => $request->content_en,
            'ar' => $request->content_ar,
        ];

        $service->sort_order = $request->sort_order ?? 0;
        $service->is_active = true;

        $service->save();

        return redirect()->route('admin.services.index')
            ->with('success', __('admin.success_created'));
    }

    /**
     * Show the form for editing a service
     */
    public function edit(Service $service)
    {
        return view('admin.services.edit', compact('service'));
    }

    /**
     * Update the specified service
     */
    public function update(Request $request, Service $service)
    {
        $request->validate([
            'title_en' => 'required|string|max:255',
            'title_ar' => 'required|string|max:255',
            'description_en' => 'required|string',
            'description_ar' => 'required|string',
            'content_en' => 'nullable|string',
            'content_ar' => 'nullable|string',
            'icon' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'sort_order' => 'nullable|integer|min:0',
            'is_active' => 'boolean',
        ]);

        // Handle icon upload
        if ($request->hasFile('icon')) {
            // Delete old icon if exists
            if ($service->icon && Storage::disk('public')->exists($service->icon)) {
                Storage::disk('public')->delete($service->icon);
            }

            $iconPath = $request->file('icon')->store('services', 'public');
            $service->icon = $iconPath;
        }

        $service->title = [
            'en' => $request->title_en,
            'ar' => $request->title_ar,
        ];

        $service->description = [
            'en' => $request->description_en,
            'ar' => $request->description_ar,
        ];

        $service->content = [
            'en' => $request->content_en,
            'ar' => $request->content_ar,
        ];

        $service->sort_order = $request->sort_order ?? 0;
        $service->is_active = $request->has('is_active');

        $service->save();

        return redirect()->route('admin.services.index')
            ->with('success', __('admin.success_updated'));
    }

    /**
     * Remove the specified service
     */
    public function destroy(Service $service)
    {
        // Delete icon if exists
        if ($service->icon && Storage::disk('public')->exists($service->icon)) {
            Storage::disk('public')->delete($service->icon);
        }

        $service->delete();

        return redirect()->route('admin.services.index')
            ->with('success', __('admin.success_deleted'));
    }
}

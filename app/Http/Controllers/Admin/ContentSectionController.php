<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContentSection;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Http\JsonResponse;

class ContentSectionController extends Controller
{
    /**
     * Display a listing of content sections
     */
    public function index(Request $request): View
    {

        $query = ContentSection::with(['creator', 'updater']);

        // Filter by page location
        if ($request->filled('page_location')) {
            $query->where('page_location', $request->page_location);
        }


        // Filter by status
        if ($request->filled('status')) {
            if ($request->status === 'active') {
                $query->where('is_active', true);
            } elseif ($request->status === 'inactive') {
                $query->where('is_active', false);
            }
        }


        // Search
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('title_ar', 'like', "%{$search}%")
                  ->orWhere('title_en', 'like', "%{$search}%")
                  ->orWhere('content_ar', 'like', "%{$search}%")
                  ->orWhere('content_en', 'like', "%{$search}%");
            });
        }


        $sections = $query->ordered()->get();

        return view('admin.content-sections.index', compact('sections'));
    }

    /**
     * Show the form for creating a new content section
     */
    public function create(): View
    {
        return view('admin.content-sections.create');
    }

    /**
     * Store a newly created content section
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'title_ar' => 'required|string|max:255',
            'title_en' => 'required|string|max:255',
            'content_ar' => 'required|string',
            'content_en' => 'required|string',
            'page_location' => 'required|in:home,about,contact,board-directors,news,investment-application',
            'display_order' => 'required|integer|min:0',
            'is_active' => 'boolean',
        ]);

        $validated['is_active'] = $request->has('is_active');

        ContentSection::create($validated);

        return redirect()->route('admin.content-sections.index')
            ->with('success', __('admin.content_section_created_successfully'));
    }

    /**
     * Display the specified content section
     */
    public function show(ContentSection $contentSection): View
    {
        $contentSection->load(['creator', 'updater']);
        return view('admin.content-sections.show', compact('contentSection'));
    }

    /**
     * Show the form for editing the specified content section
     */
    public function edit(ContentSection $contentSection): View
    {
        return view('admin.content-sections.edit', compact('contentSection'));
    }

    /**
     * Update the specified content section
     */
    public function update(Request $request, ContentSection $contentSection): RedirectResponse
    {
        $validated = $request->validate([
            'title_ar' => 'required|string|max:255',
            'title_en' => 'required|string|max:255',
            'content_ar' => 'required|string',
            'content_en' => 'required|string',
            'page_location' => 'required|in:home,about,contact,board-directors,news,investment-application',
            'display_order' => 'required|integer|min:0',
            'is_active' => 'boolean',
        ]);

        $validated['is_active'] = $request->has('is_active');

        $contentSection->update($validated);

        return redirect()->route('admin.content-sections.index')
            ->with('success', __('admin.content_section_updated_successfully'));
    }

    /**
     * Remove the specified content section
     */
    public function destroy(ContentSection $contentSection): RedirectResponse
    {
        $contentSection->delete();

        return redirect()->route('admin.content-sections.index')
            ->with('success', __('admin.content_section_deleted_successfully'));
    }

    /**
     * Toggle the active status of a content section
     */
    public function toggleStatus(ContentSection $contentSection): JsonResponse
    {
        $contentSection->update([
            'is_active' => !$contentSection->is_active
        ]);

        return response()->json([
            'success' => true,
            'message' => __('admin.status_updated_successfully'),
            'is_active' => $contentSection->is_active
        ]);
    }

    /**
     * Update display order via AJAX
     */
    public function updateOrder(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'sections' => 'required|array',
            'sections.*.id' => 'required|exists:content_sections,id',
            'sections.*.display_order' => 'required|integer|min:0',
        ]);

        foreach ($validated['sections'] as $sectionData) {
            ContentSection::where('id', $sectionData['id'])
                ->update(['display_order' => $sectionData['display_order']]);
        }

        return response()->json([
            'success' => true,
            'message' => __('admin.order_updated_successfully')
        ]);
    }

    /**
     * Bulk actions for content sections
     */
    public function bulkAction(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'action' => 'required|in:activate,deactivate,delete',
            'sections' => 'required|array',
            'sections.*' => 'exists:content_sections,id',
        ]);

        $sections = ContentSection::whereIn('id', $validated['sections']);

        switch ($validated['action']) {
            case 'activate':
                $sections->update(['is_active' => true]);
                $message = __('admin.sections_activated_successfully');
                break;
            case 'deactivate':
                $sections->update(['is_active' => false]);
                $message = __('admin.sections_deactivated_successfully');
                break;
            case 'delete':
                $sections->delete();
                $message = __('admin.sections_deleted_successfully');
                break;
        }

        return redirect()->route('admin.content-sections.index')
            ->with('success', $message);
    }
}

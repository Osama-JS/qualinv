<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Page;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class PageController extends Controller
{
    /**
     * Display a listing of pages
     */
    public function index(Request $request): View
    {
        $query = Page::orderBy('sort_order')->orderBy('created_at', 'desc');

        // Filter by status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Filter by position
        if ($request->filled('position')) {
            $query->where('position', $request->position);
        }

        // Search
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->whereRaw("JSON_EXTRACT(name, '$.en') LIKE ?", ["%{$search}%"])
                  ->orWhereRaw("JSON_EXTRACT(name, '$.ar') LIKE ?", ["%{$search}%"]);
            });
        }

        $pages = $query->paginate(15);
        $positions = Page::getPositions();
        $statuses = Page::getStatuses();

        return view('admin.pages.index', compact('pages', 'positions', 'statuses'));
    }

    /**
     * Show the form for creating a new page
     */
    public function create(): View
    {
        $positions = Page::getPositions();
        $statuses = Page::getStatuses();

        return view('admin.pages.create', compact('positions', 'statuses'));
    }

    /**
     * Store a newly created page
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name_en' => 'required|string|max:255',
            'name_ar' => 'required|string|max:255',
            'position' => 'required|in:navbar,footer',
            'description_en' => 'nullable|string|max:500',
            'description_ar' => 'nullable|string|max:500',
            'content_en' => 'nullable|string',
            'content_ar' => 'nullable|string',
            'js_functionality' => 'nullable|string',
            'status' => 'required|in:active,inactive',
            'sort_order' => 'nullable|integer|min:0',
            'meta_title_en' => 'nullable|string|max:60',
            'meta_title_ar' => 'nullable|string|max:60',
            'meta_description_en' => 'nullable|string|max:160',
            'meta_description_ar' => 'nullable|string|max:160',
            'meta_keywords_en' => 'nullable|string|max:255',
            'meta_keywords_ar' => 'nullable|string|max:255',
        ]);

        $data = [
            'name' => [
                'en' => $request->name_en,
                'ar' => $request->name_ar,
            ],
            'position' => $request->position,
            'description' => [
                'en' => $request->description_en,
                'ar' => $request->description_ar,
            ],
            'content_en' => $request->content_en,
            'content_ar' => $request->content_ar,
            'js_functionality' => $request->js_functionality,
            'status' => $request->status,
            'sort_order' => $request->sort_order ?? 0,
            'meta_title' => [
                'en' => $request->meta_title_en,
                'ar' => $request->meta_title_ar,
            ],
            'meta_description' => [
                'en' => $request->meta_description_en,
                'ar' => $request->meta_description_ar,
            ],
            'meta_keywords' => [
                'en' => $request->meta_keywords_en,
                'ar' => $request->meta_keywords_ar,
            ],
        ];

        Page::create($data);

        return redirect()->route('admin.pages.index')
            ->with('toast_success', __('admin.page_created_successfully'));
    }

    /**
     * Display the specified page
     */
    public function show(Page $page): View
    {
        return view('admin.pages.show', compact('page'));
    }

    /**
     * Show the form for editing the specified page
     */
    public function edit(Page $page): View
    {
        $positions = Page::getPositions();
        $statuses = Page::getStatuses();

        return view('admin.pages.edit', compact('page', 'positions', 'statuses'));
    }

    /**
     * Update the specified page
     */
    public function update(Request $request, Page $page): RedirectResponse
    {
        $request->validate([
            'name_en' => 'required|string|max:255',
            'name_ar' => 'required|string|max:255',
            'position' => 'required|in:navbar,footer',
            'description_en' => 'nullable|string|max:500',
            'description_ar' => 'nullable|string|max:500',
            'content_en' => 'nullable|string',
            'content_ar' => 'nullable|string',
            'js_functionality' => 'nullable|string',
            'status' => 'required|in:active,inactive',
            'sort_order' => 'nullable|integer|min:0',
            'meta_title_en' => 'nullable|string|max:60',
            'meta_title_ar' => 'nullable|string|max:60',
            'meta_description_en' => 'nullable|string|max:160',
            'meta_description_ar' => 'nullable|string|max:160',
            'meta_keywords_en' => 'nullable|string|max:255',
            'meta_keywords_ar' => 'nullable|string|max:255',
        ]);

        $data = [
            'name' => [
                'en' => $request->name_en,
                'ar' => $request->name_ar,
            ],
            'position' => $request->position,
            'description' => [
                'en' => $request->description_en,
                'ar' => $request->description_ar,
            ],
            'content_en' => $request->content_en,
            'content_ar' => $request->content_ar,
            'js_functionality' => $request->js_functionality,
            'status' => $request->status,
            'sort_order' => $request->sort_order ?? 0,
            'meta_title' => [
                'en' => $request->meta_title_en,
                'ar' => $request->meta_title_ar,
            ],
            'meta_description' => [
                'en' => $request->meta_description_en,
                'ar' => $request->meta_description_ar,
            ],
            'meta_keywords' => [
                'en' => $request->meta_keywords_en,
                'ar' => $request->meta_keywords_ar,
            ],
        ];

        $page->update($data);

        return redirect()->route('admin.pages.index')
            ->with('toast_success', __('admin.page_updated_successfully'));
    }

    /**
     * Remove the specified page
     */
    public function destroy(Page $page): RedirectResponse
    {
        $page->delete();

        return redirect()->route('admin.pages.index')
            ->with('toast_success', __('admin.page_deleted_successfully'));
    }

    /**
     * Update page order via AJAX
     */
    public function updateOrder(Request $request): \Illuminate\Http\JsonResponse
    {
        $request->validate([
            'pages' => 'required|array',
            'pages.*.id' => 'required|exists:pages,id',
            'pages.*.sort_order' => 'required|integer|min:0',
        ]);

        foreach ($request->pages as $pageData) {
            Page::where('id', $pageData['id'])->update(['sort_order' => $pageData['sort_order']]);
        }

        return response()->json(['success' => true]);
    }

    /**
     * Toggle page status via AJAX
     */
    public function toggleStatus(Page $page): \Illuminate\Http\JsonResponse
    {
        $page->update([
            'status' => $page->status === 'active' ? 'inactive' : 'active'
        ]);

        return response()->json([
            'success' => true,
            'status' => $page->status,
            'message' => __('admin.page_status_updated')
        ]);
    }
}

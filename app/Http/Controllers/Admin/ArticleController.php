<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ArticleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
    }

    /**
     * Display a listing of articles
     */
    public function index(Request $request)
    {
        $query = Article::with('author')->orderBy('created_at', 'desc');

        // Filter by status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Filter by category
        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }

        // Search
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->whereRaw("JSON_EXTRACT(title, '$.en') LIKE ?", ["%{$search}%"])
                  ->orWhereRaw("JSON_EXTRACT(title, '$.ar') LIKE ?", ["%{$search}%"]);
            });
        }

        $articles = $query->paginate(15);
        $categories = Article::getCategories();

        return view('admin.articles.index', compact('articles', 'categories'));
    }

    /**
     * Show the form for creating a new article
     */
    public function create()
    {
        $categories = Article::getCategories();
        return view('admin.articles.create', compact('categories'));
    }

    /**
     * Store a newly created article
     */
    public function store(Request $request)
    {
        $request->validate([
            'title_en' => 'required|string|max:255',
            'title_ar' => 'required|string|max:255',
            'excerpt_en' => 'required|string|max:500',
            'excerpt_ar' => 'required|string|max:500',
            'content_en' => 'required|string',
            'content_ar' => 'required|string',
            'category' => 'required|string|in:' . implode(',', array_keys(Article::getCategories())),
            'tags_en' => 'nullable|string',
            'tags_ar' => 'nullable|string',
            'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'meta_title_en' => 'nullable|string|max:60',
            'meta_title_ar' => 'nullable|string|max:60',
            'meta_description_en' => 'nullable|string|max:160',
            'meta_description_ar' => 'nullable|string|max:160',
            'meta_keywords_en' => 'nullable|string|max:255',
            'meta_keywords_ar' => 'nullable|string|max:255',
            'status' => 'required|in:draft,published',
            'published_at' => 'nullable|date',
            'is_featured' => 'boolean',
        ]);

        $data = [
            'title' => [
                'en' => $request->title_en,
                'ar' => $request->title_ar,
            ],
            'slug' => [
                'en' => Article::generateSlug($request->title_en, 'en'),
                'ar' => Article::generateSlug($request->title_ar, 'ar'),
            ],
            'excerpt' => [
                'en' => $request->excerpt_en,
                'ar' => $request->excerpt_ar,
            ],
            'content' => [
                'en' => $request->content_en,
                'ar' => $request->content_ar,
            ],
            'category' => $request->category,
            'tags' => [
                'en' => $request->tags_en ? array_map('trim', explode(',', $request->tags_en)) : [],
                'ar' => $request->tags_ar ? array_map('trim', explode(',', $request->tags_ar)) : [],
            ],
            'meta_title' => [
                'en' => $request->meta_title_en ?: $request->title_en,
                'ar' => $request->meta_title_ar ?: $request->title_ar,
            ],
            'meta_description' => [
                'en' => $request->meta_description_en ?: $request->excerpt_en,
                'ar' => $request->meta_description_ar ?: $request->excerpt_ar,
            ],
            'meta_keywords' => [
                'en' => $request->meta_keywords_en ?: '',
                'ar' => $request->meta_keywords_ar ?: '',
            ],
            'status' => $request->status,
            'published_at' => $request->status === 'published' 
                ? ($request->published_at ? $request->published_at : now()) 
                : null,
            'author_id' => auth()->id(),
            'is_featured' => $request->boolean('is_featured'),
        ];

        // Handle featured image upload
        if ($request->hasFile('featured_image')) {
            $data['featured_image'] = $request->file('featured_image')->store('articles', 'public');
        }

        Article::create($data);

        return redirect()->route('admin.articles.index')
            ->with('success', __('admin.article_created_successfully'));
    }

    /**
     * Display the specified article
     */
    public function show(Article $article)
    {
        return view('admin.articles.show', compact('article'));
    }

    /**
     * Show the form for editing the specified article
     */
    public function edit(Article $article)
    {
        $categories = Article::getCategories();
        return view('admin.articles.edit', compact('article', 'categories'));
    }

    /**
     * Update the specified article
     */
    public function update(Request $request, Article $article)
    {
        $request->validate([
            'title_en' => 'required|string|max:255',
            'title_ar' => 'required|string|max:255',
            'excerpt_en' => 'required|string|max:500',
            'excerpt_ar' => 'required|string|max:500',
            'content_en' => 'required|string',
            'content_ar' => 'required|string',
            'category' => 'required|string|in:' . implode(',', array_keys(Article::getCategories())),
            'tags_en' => 'nullable|string',
            'tags_ar' => 'nullable|string',
            'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'meta_title_en' => 'nullable|string|max:60',
            'meta_title_ar' => 'nullable|string|max:60',
            'meta_description_en' => 'nullable|string|max:160',
            'meta_description_ar' => 'nullable|string|max:160',
            'meta_keywords_en' => 'nullable|string|max:255',
            'meta_keywords_ar' => 'nullable|string|max:255',
            'status' => 'required|in:draft,published',
            'published_at' => 'nullable|date',
            'is_featured' => 'boolean',
        ]);

        $data = [
            'title' => [
                'en' => $request->title_en,
                'ar' => $request->title_ar,
            ],
            'excerpt' => [
                'en' => $request->excerpt_en,
                'ar' => $request->excerpt_ar,
            ],
            'content' => [
                'en' => $request->content_en,
                'ar' => $request->content_ar,
            ],
            'category' => $request->category,
            'tags' => [
                'en' => $request->tags_en ? array_map('trim', explode(',', $request->tags_en)) : [],
                'ar' => $request->tags_ar ? array_map('trim', explode(',', $request->tags_ar)) : [],
            ],
            'meta_title' => [
                'en' => $request->meta_title_en ?: $request->title_en,
                'ar' => $request->meta_title_ar ?: $request->title_ar,
            ],
            'meta_description' => [
                'en' => $request->meta_description_en ?: $request->excerpt_en,
                'ar' => $request->meta_description_ar ?: $request->excerpt_ar,
            ],
            'meta_keywords' => [
                'en' => $request->meta_keywords_en ?: '',
                'ar' => $request->meta_keywords_ar ?: '',
            ],
            'status' => $request->status,
            'published_at' => $request->status === 'published' 
                ? ($request->published_at ? $request->published_at : ($article->published_at ?: now())) 
                : null,
            'is_featured' => $request->boolean('is_featured'),
        ];

        // Update slug if title changed
        if ($article->title['en'] !== $request->title_en) {
            $data['slug']['en'] = Article::generateSlug($request->title_en, 'en');
        }
        if ($article->title['ar'] !== $request->title_ar) {
            $data['slug']['ar'] = Article::generateSlug($request->title_ar, 'ar');
        }

        // Handle featured image upload
        if ($request->hasFile('featured_image')) {
            // Delete old image
            if ($article->featured_image) {
                Storage::disk('public')->delete($article->featured_image);
            }
            $data['featured_image'] = $request->file('featured_image')->store('articles', 'public');
        }

        $article->update($data);

        return redirect()->route('admin.articles.index')
            ->with('success', __('admin.article_updated_successfully'));
    }

    /**
     * Remove the specified article
     */
    public function destroy(Article $article)
    {
        // Delete featured image if exists
        if ($article->featured_image) {
            Storage::disk('public')->delete($article->featured_image);
        }

        $article->delete();

        return redirect()->route('admin.articles.index')
            ->with('success', __('admin.article_deleted_successfully'));
    }

    /**
     * Toggle featured status
     */
    public function toggleFeatured(Article $article)
    {
        $article->update(['is_featured' => !$article->is_featured]);

        $message = $article->is_featured 
            ? __('admin.article_featured') 
            : __('admin.article_unfeatured');

        return redirect()->back()->with('success', $message);
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
    }

    /**
     * Display a listing of posts
     */
    public function index()
    {
        $posts = Post::with('author')->orderBy('created_at', 'desc')->paginate(15);
        return view('admin.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new post
     */
    public function create()
    {
        return view('admin.posts.create');
    }

    /**
     * Store a newly created post
     */
    public function store(Request $request)
    {
        $request->validate([
            'title_en' => 'required|string|max:255',
            'title_ar' => 'required|string|max:255',
            'excerpt_en' => 'nullable|string|max:500',
            'excerpt_ar' => 'nullable|string|max:500',
            'content_en' => 'required|string',
            'content_ar' => 'required|string',
            'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'type' => 'required|in:news,blog',
            'status' => 'required|in:draft,published',
            'published_at' => 'nullable|date',
        ]);

        $post = new Post();

        // Handle featured image upload
        if ($request->hasFile('featured_image')) {
            $imagePath = $request->file('featured_image')->store('posts', 'public');
            $post->featured_image = $imagePath;
        }

        // Generate slugs
        $slugEn = Str::slug($request->title_en);
        $slugAr = Str::slug($request->title_ar);

        $post->title = [
            'en' => $request->title_en,
            'ar' => $request->title_ar,
        ];

        $post->slug = [
            'en' => $slugEn,
            'ar' => $slugAr,
        ];

        $post->excerpt = [
            'en' => $request->excerpt_en,
            'ar' => $request->excerpt_ar,
        ];

        $post->content = [
            'en' => $request->content_en,
            'ar' => $request->content_ar,
        ];

        $post->type = $request->type;
        $post->status = $request->status;
        $post->author_id = auth()->id();

        if ($request->status === 'published' && $request->published_at) {
            $post->published_at = $request->published_at;
        } elseif ($request->status === 'published') {
            $post->published_at = now();
        }

        $post->save();

        return redirect()->route('admin.posts.index')
            ->with('success', __('admin.success_created'));
    }

    /**
     * Show the form for editing a post
     */
    public function edit(Post $post)
    {
        return view('admin.posts.edit', compact('post'));
    }

    /**
     * Update the specified post
     */
    public function update(Request $request, Post $post)
    {
        $request->validate([
            'title_en' => 'required|string|max:255',
            'title_ar' => 'required|string|max:255',
            'excerpt_en' => 'nullable|string|max:500',
            'excerpt_ar' => 'nullable|string|max:500',
            'content_en' => 'required|string',
            'content_ar' => 'required|string',
            'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'type' => 'required|in:news,blog',
            'status' => 'required|in:draft,published,archived',
            'published_at' => 'nullable|date',
        ]);

        // Handle featured image upload
        if ($request->hasFile('featured_image')) {
            // Delete old image if exists
            if ($post->featured_image && Storage::disk('public')->exists($post->featured_image)) {
                Storage::disk('public')->delete($post->featured_image);
            }

            $imagePath = $request->file('featured_image')->store('posts', 'public');
            $post->featured_image = $imagePath;
        }

        // Generate slugs
        $slugEn = Str::slug($request->title_en);
        $slugAr = Str::slug($request->title_ar);

        $post->title = [
            'en' => $request->title_en,
            'ar' => $request->title_ar,
        ];

        $post->slug = [
            'en' => $slugEn,
            'ar' => $slugAr,
        ];

        $post->excerpt = [
            'en' => $request->excerpt_en,
            'ar' => $request->excerpt_ar,
        ];

        $post->content = [
            'en' => $request->content_en,
            'ar' => $request->content_ar,
        ];

        $post->type = $request->type;
        $post->status = $request->status;

        if ($request->status === 'published' && $request->published_at) {
            $post->published_at = $request->published_at;
        } elseif ($request->status === 'published' && !$post->published_at) {
            $post->published_at = now();
        }

        $post->save();

        return redirect()->route('admin.posts.index')
            ->with('success', __('admin.success_updated'));
    }

    /**
     * Remove the specified post
     */
    public function destroy(Post $post)
    {
        // Delete featured image if exists
        if ($post->featured_image && Storage::disk('public')->exists($post->featured_image)) {
            Storage::disk('public')->delete($post->featured_image);
        }

        $post->delete();

        return redirect()->route('admin.posts.index')
            ->with('success', __('admin.success_deleted'));
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'excerpt',
        'content',
        'featured_image',
        'type',
        'status',
        'published_at',
        'author_id',
        'meta_data',
    ];

    protected function casts(): array
    {
        return [
            'title' => 'array',
            'slug' => 'array',
            'excerpt' => 'array',
            'content' => 'array',
            'meta_data' => 'array',
            'published_at' => 'datetime',
        ];
    }

    /**
     * Get the author of the post
     */
    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    /**
     * Get localized title
     */
    public function getLocalizedTitle($locale = null)
    {
        $locale = $locale ?? app()->getLocale();
        return $this->title[$locale] ?? $this->title['en'] ?? '';
    }

    /**
     * Get localized slug
     */
    public function getLocalizedSlug($locale = null)
    {
        $locale = $locale ?? app()->getLocale();
        return $this->slug[$locale] ?? $this->slug['en'] ?? '';
    }

    /**
     * Get localized excerpt
     */
    public function getLocalizedExcerpt($locale = null)
    {
        $locale = $locale ?? app()->getLocale();
        return $this->excerpt[$locale] ?? $this->excerpt['en'] ?? '';
    }

    /**
     * Get localized content
     */
    public function getLocalizedContent($locale = null)
    {
        $locale = $locale ?? app()->getLocale();
        return $this->content[$locale] ?? $this->content['en'] ?? '';
    }

    /**
     * Scope for published posts
     */
    public function scopePublished($query)
    {
        return $query->where('status', 'published')
                    ->where('published_at', '<=', now());
    }

    /**
     * Scope for news posts
     */
    public function scopeNews($query)
    {
        return $query->where('type', 'news');
    }

    /**
     * Scope for blog posts
     */
    public function scopeBlog($query)
    {
        return $query->where('type', 'blog');
    }
}

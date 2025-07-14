<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Article extends Model
{
    protected $table = 'articles';
    
    protected $fillable = [
        'title',
        'slug',
        'excerpt',
        'content',
        'featured_image',
        'category',
        'tags',
        'status',
        'published_at',
        'author_id',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'views_count',
        'is_featured',
    ];

    protected function casts(): array
    {
        return [
            'title' => 'array',
            'slug' => 'array',
            'excerpt' => 'array',
            'content' => 'array',
            'meta_title' => 'array',
            'meta_description' => 'array',
            'meta_keywords' => 'array',
            'tags' => 'array',
            'published_at' => 'datetime',
            'is_featured' => 'boolean',
            'views_count' => 'integer',
        ];
    }

    /**
     * Get the author of the article
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
     * Get localized meta title
     */
    public function getLocalizedMetaTitle($locale = null)
    {
        $locale = $locale ?? app()->getLocale();
        return $this->meta_title[$locale] ?? $this->meta_title['en'] ?? $this->getLocalizedTitle($locale);
    }

    /**
     * Get localized meta description
     */
    public function getLocalizedMetaDescription($locale = null)
    {
        $locale = $locale ?? app()->getLocale();
        return $this->meta_description[$locale] ?? $this->meta_description['en'] ?? $this->getLocalizedExcerpt($locale);
    }

    /**
     * Get localized meta keywords
     */
    public function getLocalizedMetaKeywords($locale = null)
    {
        $locale = $locale ?? app()->getLocale();
        return $this->meta_keywords[$locale] ?? $this->meta_keywords['en'] ?? '';
    }

    /**
     * Get localized tags
     */
    public function getLocalizedTags($locale = null)
    {
        $locale = $locale ?? app()->getLocale();
        return $this->tags[$locale] ?? $this->tags['en'] ?? [];
    }

    /**
     * Scope for published articles
     */
    public function scopePublished($query)
    {
        return $query->where('status', 'published')
                    ->where('published_at', '<=', now());
    }

    /**
     * Scope for featured articles
     */
    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    /**
     * Scope for articles by category
     */
    public function scopeByCategory($query, $category)
    {
        return $query->where('category', $category);
    }

    /**
     * Scope for recent articles
     */
    public function scopeRecent($query, $limit = 10)
    {
        return $query->orderBy('published_at', 'desc')->limit($limit);
    }

    /**
     * Generate slug from title
     */
    public static function generateSlug($title, $locale = 'en')
    {
        $baseSlug = Str::slug($title);
        $slug = $baseSlug;
        $counter = 1;

        while (static::where("slug->{$locale}", $slug)->exists()) {
            $slug = $baseSlug . '-' . $counter;
            $counter++;
        }

        return $slug;
    }

    /**
     * Increment views count
     */
    public function incrementViews()
    {
        $this->increment('views_count');
    }

    /**
     * Get article URL
     */
    public function getUrl($locale = null)
    {
        $locale = $locale ?? app()->getLocale();
        $slug = $this->getLocalizedSlug($locale);
        
        return route('articles.show', ['locale' => $locale, 'slug' => $slug]);
    }

    /**
     * Get reading time estimate
     */
    public function getReadingTime($locale = null)
    {
        $content = $this->getLocalizedContent($locale);
        $wordCount = str_word_count(strip_tags($content));
        $readingTime = ceil($wordCount / 200); // Average reading speed: 200 words per minute
        
        return max(1, $readingTime);
    }

    /**
     * Get available categories
     */
    public static function getCategories()
    {
        return [
            'news' => __('admin.news'),
            'announcements' => __('admin.announcements'),
            'reports' => __('admin.reports'),
            'insights' => __('admin.insights'),
            'events' => __('admin.events'),
        ];
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Page extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'slug',
        'position',
        'description',
        'content_ar',
        'content_en',
        'status',
        'sort_order',
        'meta_title',
        'meta_description',
        'meta_keywords',
    ];

    protected function casts(): array
    {
        return [
            'name' => 'array',
            'slug' => 'array',
            'description' => 'array',
            'meta_title' => 'array',
            'meta_description' => 'array',
            'meta_keywords' => 'array',
            'sort_order' => 'integer',
        ];
    }

    /**
     * Get localized name
     */
    public function getLocalizedName($locale = null)
    {
        $locale = $locale ?? app()->getLocale();
        return $this->name[$locale] ?? $this->name['en'] ?? '';
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
     * Get localized description
     */
    public function getLocalizedDescription($locale = null)
    {
        $locale = $locale ?? app()->getLocale();
        return $this->description[$locale] ?? $this->description['en'] ?? '';
    }

    /**
     * Get localized meta title
     */
    public function getLocalizedMetaTitle($locale = null)
    {
        $locale = $locale ?? app()->getLocale();
        return $this->meta_title[$locale] ?? $this->meta_title['en'] ?? $this->getLocalizedName($locale);
    }

    /**
     * Get localized meta description
     */
    public function getLocalizedMetaDescription($locale = null)
    {
        $locale = $locale ?? app()->getLocale();
        return $this->meta_description[$locale] ?? $this->meta_description['en'] ?? $this->getLocalizedDescription($locale);
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
     * Get localized content
     */
    public function getLocalizedContent($locale = null)
    {
        $locale = $locale ?? app()->getLocale();

        if ($locale === 'ar' && !empty($this->content_ar)) {
            return $this->content_ar;
        } elseif ($locale === 'en' && !empty($this->content_en)) {
            return $this->content_en;
        }

        // Fallback to English content if Arabic is not available
        return $this->content_en ?? '';
    }

    /**
     * Scope for active pages
     */
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    /**
     * Scope for navbar pages
     */
    public function scopeNavbar($query)
    {
        return $query->where('position', 'navbar');
    }

    /**
     * Scope for footer pages
     */
    public function scopeFooter($query)
    {
        return $query->where('position', 'footer');
    }

    /**
     * Get available positions
     */
    public static function getPositions()
    {
        return [
            'navbar' => __('admin.navbar'),
            'footer' => __('admin.footer'),
        ];
    }

    /**
     * Get available statuses
     */
    public static function getStatuses()
    {
        return [
            'active' => __('admin.active'),
            'inactive' => __('admin.inactive'),
        ];
    }

    /**
     * Generate slug from name
     */
    public static function generateSlug($name, $locale = 'en')
    {
        return Str::slug($name, '-', $locale);
    }

    /**
     * Boot method to handle model events
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($page) {
            // Auto-generate slugs if not provided
            if (empty($page->slug)) {
                $page->slug = [
                    'en' => self::generateSlug($page->name['en'] ?? '', 'en'),
                    'ar' => self::generateSlug($page->name['ar'] ?? '', 'ar'),
                ];
            }
        });

        static::updating(function ($page) {
            // Update slugs if names changed
            if ($page->isDirty('name')) {
                $page->slug = [
                    'en' => self::generateSlug($page->name['en'] ?? '', 'en'),
                    'ar' => self::generateSlug($page->name['ar'] ?? '', 'ar'),
                ];
            }
        });
    }
}

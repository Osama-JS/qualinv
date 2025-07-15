<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class ContentSection extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'content_sections';

    protected $fillable = [
        'title_ar',
        'title_en',
        'content_ar',
        'content_en',
        'page_location',
        'display_order',
        'is_active',
        'created_by',
        'updated_by',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'display_order' => 'integer',
    ];

    // Page location constants
    const PAGE_HOME = 'home';
    const PAGE_ABOUT = 'about';
    const PAGE_CONTACT = 'contact';
    const PAGE_BOARD_DIRECTORS = 'board-directors';
    const PAGE_NEWS = 'news';
    const PAGE_INVESTMENT_APPLICATION = 'investment-application';

    /**
     * Get all available page locations
     */
    public static function getPageLocations(): array
    {
        return [
            self::PAGE_HOME => __('admin.page_home'),
            self::PAGE_ABOUT => __('admin.page_about'),
            self::PAGE_CONTACT => __('admin.page_contact'),
            self::PAGE_BOARD_DIRECTORS => __('admin.page_board_directors'),
            self::PAGE_NEWS => __('admin.page_news'),
            self::PAGE_INVESTMENT_APPLICATION => __('admin.page_investment_application'),
        ];
    }

    /**
     * Get localized title
     */
    public function getLocalizedTitle(): string
    {
        $locale = app()->getLocale();
        return $this->{"title_{$locale}"} ?? $this->title_en ?? $this->title_ar ?? '';
    }

    /**
     * Get localized content
     */
    public function getLocalizedContent(): string
    {
        $locale = app()->getLocale();
        return $this->{"content_{$locale}"} ?? $this->content_en ?? $this->content_ar ?? '';
    }

    /**
     * Get page location label
     */
    public function getPageLocationLabel(): string
    {
        $locations = self::getPageLocations();
        return $locations[$this->page_location] ?? $this->page_location;
    }

    /**
     * Scope for active sections
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope for specific page
     */
    public function scopeForPage($query, string $page)
    {
        return $query->where('page_location', $page);
    }

    /**
     * Scope ordered by display order
     */
    public function scopeOrdered($query)
    {
        return $query->orderBy('display_order', 'asc');
    }

    /**
     * Get the user who created this section
     */
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    /**
     * Get the user who last updated this section
     */
    public function updater()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }

    /**
     * Boot method to set created_by and updated_by
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (Auth::check()) {
                $model->created_by = Auth::id();
                $model->updated_by = Auth::id();
            }
        });

        static::updating(function ($model) {
            if (Auth::check()) {
                $model->updated_by = Auth::id();
            }
        });
    }
}

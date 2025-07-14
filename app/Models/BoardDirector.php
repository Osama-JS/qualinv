<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BoardDirector extends Model
{
    protected $table = 'board_directors';

    protected $fillable = [
        'name',
        'position',
        'bio',
        'photo',
        'email',
        'phone',
        'social_media',
        'sort_order',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'name' => 'array',
            'position' => 'array',
            'bio' => 'array',
            'social_media' => 'array',
            'is_active' => 'boolean',
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
     * Get localized position
     */
    public function getLocalizedPosition($locale = null)
    {
        $locale = $locale ?? app()->getLocale();
        return $this->position[$locale] ?? $this->position['en'] ?? '';
    }

    /**
     * Get localized bio
     */
    public function getLocalizedBio($locale = null)
    {
        $locale = $locale ?? app()->getLocale();
        return $this->bio[$locale] ?? $this->bio['en'] ?? '';
    }

    /**
     * Scope for active board directors
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope for ordered board directors
     */
    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order');
    }

    /**
     * Get social media URL by platform
     */
    public function getSocialMediaUrl($platform)
    {
        return $this->social_media[$platform] ?? null;
    }

    /**
     * Get LinkedIn URL
     */
    public function getLinkedinUrl()
    {
        return $this->getSocialMediaUrl('linkedin');
    }

    /**
     * Get Twitter URL
     */
    public function getTwitterUrl()
    {
        return $this->getSocialMediaUrl('twitter');
    }

    /**
     * Get Facebook URL
     */
    public function getFacebookUrl()
    {
        return $this->getSocialMediaUrl('facebook');
    }

    /**
     * Get Instagram URL
     */
    public function getInstagramUrl()
    {
        return $this->getSocialMediaUrl('instagram');
    }

    /**
     * Check if has any social media
     */
    public function hasSocialMedia()
    {
        return !empty($this->social_media) &&
               (isset($this->social_media['linkedin']) ||
                isset($this->social_media['twitter']) ||
                isset($this->social_media['facebook']) ||
                isset($this->social_media['instagram']));
    }
}

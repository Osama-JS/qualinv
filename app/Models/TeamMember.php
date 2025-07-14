<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TeamMember extends Model
{
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
     * Scope for active team members
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope for ordered team members
     */
    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order');
    }
}

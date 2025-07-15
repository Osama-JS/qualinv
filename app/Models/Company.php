<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $fillable = [
        'name',
        'about',
        'mission',
        'vision',
        'values',
        'logo',
        'favicon',
        'email',
        'phone',
        'address',
        'website',
        'social_media',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'name' => 'array',
            'about' => 'array',
            'mission' => 'array',
            'vision' => 'array',
            'values' => 'array',
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
     * Get localized about content
     */
    public function getLocalizedAbout($locale = null)
    {
        $locale = $locale ?? app()->getLocale();
        return $this->about[$locale] ?? $this->about['en'] ?? '';
    }

    /**
     * Get localized mission
     */
    public function getLocalizedMission($locale = null)
    {
        $locale = $locale ?? app()->getLocale();
        return $this->mission[$locale] ?? $this->mission['en'] ?? '';
    }

    /**
     * Get localized vision
     */
    public function getLocalizedVision($locale = null)
    {
        $locale = $locale ?? app()->getLocale();
        return $this->vision[$locale] ?? $this->vision['en'] ?? '';
    }

    /**
     * Get localized values
     */
    public function getLocalizedValues($locale = null)
    {
        $locale = $locale ?? app()->getLocale();
        return $this->values[$locale] ?? $this->values['en'] ?? '';
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Faq extends Model
{
    use HasFactory;

    protected $fillable = [
        'question_ar',
        'question_en',
        'answer_ar',
        'answer_en',
        'is_active',
        'order'
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    /**
     * Scope for active FAQs
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope for ordered FAQs
     */
    public function scopeOrdered($query)
    {
        return $query->orderBy('order', 'asc')->orderBy('id', 'asc');
    }

    /**
     * Get localized question
     */
    public function getLocalizedQuestion()
    {
        return app()->getLocale() === 'ar' ? $this->question_ar : $this->question_en;
    }

    /**
     * Get localized answer
     */
    public function getLocalizedAnswer()
    {
        return app()->getLocale() === 'ar' ? $this->answer_ar : $this->answer_en;
    }

    /**
     * Get question attribute based on locale
     */
    public function getQuestionAttribute()
    {
        return $this->getLocalizedQuestion();
    }

    /**
     * Get answer attribute based on locale
     */
    public function getAnswerAttribute()
    {
        return $this->getLocalizedAnswer();
    }
}

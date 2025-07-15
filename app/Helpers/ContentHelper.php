<?php

namespace App\Helpers;

use App\Models\ContentSection;

class ContentHelper
{
    /**
     * Get content sections for a specific page
     *
     * @param string $pageLocation The page location identifier
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public static function getContentSections(string $pageLocation)
    {
        return ContentSection::active()
            ->forPage($pageLocation)
            ->ordered()
            ->get();
    }

    /**
     * Render content sections for a specific page
     *
     * @param string $pageLocation The page location identifier
     * @return string HTML content
     */
    public static function renderContentSections(string $pageLocation)
    {
        $sections = self::getContentSections($pageLocation);
        
        if ($sections->isEmpty()) {
            return '';
        }

        $html = '<div class="content-sections py-12 bg-white dark:bg-gray-900">';
        
        foreach ($sections as $section) {
            $html .= self::renderSection($section);
        }
        
        $html .= '</div>';
        
        return $html;
    }

    /**
     * Render a single content section
     *
     * @param ContentSection $section The content section to render
     * @return string HTML content
     */
    private static function renderSection(ContentSection $section)
    {
        $locale = app()->getLocale();
        $title = $section->{"title_{$locale}"} ?? $section->title_en ?? $section->title_ar ?? '';
        $content = $section->{"content_{$locale}"} ?? $section->content_en ?? $section->content_ar ?? '';
        
        $html = '<section class="content-section py-12 px-4 sm:px-6 lg:px-8 max-w-7xl mx-auto" id="content-section-' . $section->id . '">';
        $html .= '<div class="section-container">';
        
        // Title
        if (!empty($title)) {
            $html .= '<h2 class="text-3xl font-bold text-center text-gray-900 dark:text-white mb-8">' . $title . '</h2>';
        }
        
        // Content
        if (!empty($content)) {
            $html .= '<div class="prose prose-lg max-w-none dark:prose-invert mx-auto">' . $content . '</div>';
        }
        
        $html .= '</div>';
        $html .= '</section>';
        
        return $html;
    }
}

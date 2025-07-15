<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Page;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class PageController extends Controller
{
    /**
     * Display a dynamic page by slug
     */
    public function show(string $slug): View
{
    $locale = app()->getLocale();
    $driver = DB::getDriverName(); // 'mysql' or 'pgsql'

    $page = Page::active()
        ->where(function ($query) use ($slug, $locale, $driver) {
            if ($driver === 'pgsql') {
                // PostgreSQL uses ->> operator
                $query->whereRaw("slug->>'{$locale}' = ?", [$slug])
                      ->orWhereRaw("slug->>'en' = ?", [$slug])
                      ->orWhereRaw("slug->>'ar' = ?", [$slug]);
            } else {
                // MySQL uses JSON_EXTRACT
                $query->whereRaw("JSON_EXTRACT(slug, '$.{$locale}') = ?", [$slug])
                      ->orWhereRaw("JSON_EXTRACT(slug, '$.en') = ?", [$slug])
                      ->orWhereRaw("JSON_EXTRACT(slug, '$.ar') = ?", [$slug]);
            }
        })
        ->firstOrFail();

    // Get page data for SEO
    $pageTitle = $page->getLocalizedMetaTitle($locale);
    $pageDescription = $page->getLocalizedMetaDescription($locale);
    $pageKeywords = $page->getLocalizedMetaKeywords($locale);
    $company = Company::first();

    return view('page.show', compact('page', 'pageTitle', 'pageDescription', 'pageKeywords', 'company'));
}

}

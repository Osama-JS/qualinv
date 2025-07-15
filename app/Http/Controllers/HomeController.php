<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\BoardDirector;
use App\Models\Article;
use App\Models\SiteSetting;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index()
    {
        // Get company information (primary source for company data)
        $company = Company::first();

        // Get featured articles
        $featuredArticles = Article::published()
            ->featured()
            ->latest('published_at')
            ->take(3)
            ->get();

        // Get latest news
        $latestNews = Article::published()
            ->latest('published_at')
            ->take(6)
            ->get();

        // Get board directors
        $boardDirectors = BoardDirector::active()
            ->orderBy('sort_order')
            ->take(4)
            ->get();

        // Get all public site settings (for UI texts and configurations)
        $siteSettings = SiteSetting::getPublicSettings();

        // Add essential settings with fallbacks if not in database
        $essentialSettings = [
            'share_price' => SiteSetting::get('share_price', '125.50'),
            'currency' => SiteSetting::get('currency', 'SAR'),
            'investors_count' => SiteSetting::get('investors_count', '1000'),
            'sold_shares' => SiteSetting::get('sold_shares', '50000'),
            'available_shares' => SiteSetting::get('available_shares', '25000'),
            'company_value' => SiteSetting::get('company_value', '500M SAR'),
        ];

        // Merge settings
        $siteSettings = array_merge($siteSettings, $essentialSettings);

        // Calculate dynamic statistics
        $statistics = [
            'investors_count' => $siteSettings['investors_count'],
            'sold_shares' => $siteSettings['sold_shares'],
            'available_shares' => $siteSettings['available_shares'],
            'company_value' => $siteSettings['company_value'],
            'total_articles' => Article::published()->count(),
            'total_board_directors' => BoardDirector::active()->count(),
        ];

        return view('home', compact(
            'company',
            'featuredArticles',
            'latestNews',
            'boardDirectors',
            'siteSettings',
            'statistics'
        ));
    }

    public function about()
    {
        // Get company information (primary source for company data)
        $company = Company::first();

        // Get board directors
        $boardDirectors = BoardDirector::active()->orderBy('sort_order')->get();

        // Get all public site settings
        $siteSettings = SiteSetting::getPublicSettings();

        return view('about', compact('company', 'boardDirectors', 'siteSettings'));
    }

    public function contact()
    {
        // Get company information (primary source for company data)
        $company = Company::first();

        // Get all public site settings
        $siteSettings = SiteSetting::getPublicSettings();

        return view('contact', compact('company', 'siteSettings'));
    }

     public function investment()
    {
        // Get company information (primary source for company data)
        $company = Company::first();

        // Get all public site settings
        $siteSettings = SiteSetting::getPublicSettings();

        return view('investment', compact('company', 'siteSettings'));
    }

    public function news()
    {
        // Check if news page is enabled
        if (!\App\Models\SiteSetting::get('news_page_enabled', true)) {
            abort(404);
        }

        $articles = Article::published()
            ->latest('published_at')
            ->paginate(12);

        $featuredArticles = Article::published()
            ->featured()
            ->latest('published_at')
            ->take(3)
            ->get();
                    $company = Company::first();


        return view('news.index', compact('articles', 'featuredArticles','company'));
    }

    public function newsShow($slug)
    {
        // Check if news page is enabled
        if (!\App\Models\SiteSetting::get('news_page_enabled', true)) {
            abort(404);
        }

        $article = Article::published()
            ->where('slug', $slug)
            ->firstOrFail();

        // Increment views
        $article->increment('views_count');

        // Get related articles
        $relatedArticles = Article::published()
            ->where('id', '!=', $article->id)
            ->where('category', $article->category)
            ->latest('published_at')
            ->take(3)
            ->get();

        return view('news.show', compact('article', 'relatedArticles'));
    }

    /**
     * Show the board directors page
     */
    public function boardDirectors(): View
    {
        $boardDirectors = BoardDirector::active()->orderBy('sort_order')->get();

        return view('board-directors', compact('boardDirectors'));
    }

    public function maintenance()
    {
        // Get maintenance messages with safety checks to ensure they're strings
        $maintenanceMessageEn = \App\Models\SiteSetting::get('maintenance_message_en', 'Site is under maintenance. Please check back later.');
        $maintenanceMessageAr = \App\Models\SiteSetting::get('maintenance_message_ar', 'الموقع تحت الصيانة. يرجى المحاولة لاحقاً.');

        // Ensure messages are strings (in case they're returned as arrays)
        if (is_array($maintenanceMessageEn)) {
            $maintenanceMessageEn = 'Site is under maintenance. Please check back later.';
        }
        if (is_array($maintenanceMessageAr)) {
            $maintenanceMessageAr = 'الموقع تحت الصيانة. يرجى المحاولة لاحقاً.';
        }

        $company = Company::first();

        return view('maintenance', compact('maintenanceMessageEn', 'maintenanceMessageAr', 'company'));
    }
}

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
        // Get company information
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

        // Get site settings for SEO and branding
        $siteSettings = [
            'site_name_en' => SiteSetting::get('site_name_en', 'Quality Investment'),
            'site_name_ar' => SiteSetting::get('site_name_ar', 'الجودة للاستثمار'),
            'share_price' => SiteSetting::get('share_price', '125.50'),
            'currency' => SiteSetting::get('currency', 'SAR'),
            'meta_title_en' => SiteSetting::get('meta_title_en', 'Quality Investment Company - Leading Investment Solutions'),
            'meta_title_ar' => SiteSetting::get('meta_title_ar', 'شركة الجودة للاستثمار - حلول استثمارية رائدة'),
            'meta_description_en' => SiteSetting::get('meta_description_en', 'Quality Investment Company provides comprehensive investment solutions and financial services in Saudi Arabia'),
            'meta_description_ar' => SiteSetting::get('meta_description_ar', 'شركة الجودة للاستثمار تقدم حلول استثمارية شاملة وخدمات مالية في المملكة العربية السعودية'),
            'meta_keywords_en' => SiteSetting::get('meta_keywords_en', 'investment, finance, Saudi Arabia, quality investment'),
            'meta_keywords_ar' => SiteSetting::get('meta_keywords_ar', 'استثمار، تمويل، السعودية، الجودة للاستثمار'),
        ];

        // Get statistics for display from settings (matching admin settings)
        $statistics = [
            'investors_count' => SiteSetting::get('investors_count', '1000'),
            'sold_shares' => SiteSetting::get('sold_shares', '50000'),
            'available_shares' => SiteSetting::get('available_shares', '25000'),
            'company_value' => SiteSetting::get('company_value', '500M'),
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
        $company = Company::first();
        $boardDirectors = BoardDirector::active()->orderBy('sort_order')->get();

        return view('about', compact('company', 'boardDirectors'));
    }

    public function contact()
    {
        $company = Company::first();

        return view('contact', compact('company'));
    }

    public function news()
    {
        $articles = Article::published()
            ->latest('published_at')
            ->paginate(12);

        $featuredArticles = Article::published()
            ->featured()
            ->latest('published_at')
            ->take(3)
            ->get();

        return view('news', compact('articles', 'featuredArticles'));
    }

    public function newsShow($slug)
    {
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
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Article;
use App\Models\BoardDirector;
use App\Models\InvestmentApplication;
use App\Models\SiteSetting;
use Illuminate\Http\Request;
use Carbon\Carbon;

class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the admin dashboard.
     */
    public function index()
    {
        // Get real statistics from database
        $stats = [
            'total_users' => User::count(),
            'total_articles' => Article::count(),
            'published_articles' => Article::published()->count(),
            'draft_articles' => Article::where('status', 'draft')->count(),
            'total_board_directors' => BoardDirector::count(),
            'active_board_directors' => BoardDirector::active()->count(),
            'total_applications' => InvestmentApplication::count(),
            'pending_applications' => InvestmentApplication::pending()->count(),
            'approved_applications' => InvestmentApplication::approved()->count(),
            'rejected_applications' => InvestmentApplication::rejected()->count(),
        ];

        // Recent activities
        $recent_articles = Article::latest()->take(5)->get();
        $recent_applications = InvestmentApplication::latest()->take(5)->get();
        $recent_users = User::latest()->take(5)->get();

        // Monthly statistics
        $monthly_stats = [
            'articles_this_month' => Article::whereMonth('created_at', Carbon::now()->month)->count(),
            'applications_this_month' => InvestmentApplication::whereMonth('created_at', Carbon::now()->month)->count(),
            'users_this_month' => User::whereMonth('created_at', Carbon::now()->month)->count(),
        ];

        // Site settings
        $site_settings = [
            'share_price' => SiteSetting::get('share_price', '0.00'),
            'currency' => SiteSetting::get('currency', 'SAR'),
            'maintenance_mode' => SiteSetting::get('maintenance_mode', false),
        ];

        // Chart data for articles over time
        $articles_chart_data = [];
        for ($i = 6; $i >= 0; $i--) {
            $date = Carbon::now()->subDays($i);
            $articles_chart_data[] = [
                'date' => $date->format('M d'),
                'count' => Article::whereDate('created_at', $date)->count()
            ];
        }

        // Chart data for applications over time
        $applications_chart_data = [];
        for ($i = 6; $i >= 0; $i--) {
            $date = Carbon::now()->subDays($i);
            $applications_chart_data[] = [
                'date' => $date->format('M d'),
                'count' => InvestmentApplication::whereDate('created_at', $date)->count()
            ];
        }

        return view('admin.dashboard', compact(
            'stats',
            'recent_articles',
            'recent_applications',
            'recent_users',
            'monthly_stats',
            'site_settings',
            'articles_chart_data',
            'applications_chart_data'
        ));
    }
}

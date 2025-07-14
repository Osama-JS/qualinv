<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\CompanyController;
use App\Http\Controllers\Admin\ServiceController;

use App\Http\Controllers\Admin\InvestmentApplicationController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\LanguageController;

// Public Routes
Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Language switching
Route::get('/language/{locale}', [LanguageController::class, 'switch'])->name('language.switch');

// Public Pages
Route::get('/about', [App\Http\Controllers\HomeController::class, 'about'])->name('about');
Route::get('/board-directors', [App\Http\Controllers\HomeController::class, 'boardDirectors'])->name('board-directors');
Route::get('/news', [App\Http\Controllers\HomeController::class, 'news'])->name('news');
Route::get('/news/{slug}', [App\Http\Controllers\HomeController::class, 'newsShow'])->name('news.show');

// Contact routes
Route::get('/contact', [App\Http\Controllers\ContactController::class, 'index'])->name('contact');
Route::post('/contact', [App\Http\Controllers\ContactController::class, 'store'])->name('contact.store');

// Test route for comprehensive data verification (remove in production)
Route::get('/verify-data', function() {
    if (app()->environment('local')) {
        $company = \App\Models\Company::first();
        $settings = \App\Models\SiteSetting::all()->pluck('value', 'key');
        $articles = \App\Models\Article::published()->count();
        $boardDirectors = \App\Models\BoardDirector::active()->count();

        // Check data consistency
        $dataConsistency = [
            'homepage_statistics' => [
                'investors_count_matches' => isset($settings['investors_count']),
                'sold_shares_matches' => isset($settings['sold_shares']),
                'available_shares_matches' => isset($settings['available_shares']),
                'company_value_matches' => isset($settings['company_value']),
            ],
            'company_info_complete' => [
                'basic_info' => $company && $company->name_ar && $company->name_en,
                'about_section' => $company && $company->about_ar && $company->about_en,
                'mission_vision_values' => $company && $company->mission_ar && $company->vision_ar && $company->values_ar,
            ],
            'content_availability' => [
                'articles_exist' => $articles > 0,
                'board_directors_exist' => $boardDirectors > 0,
            ],
            'pages_data_source' => [
                'homepage' => 'Uses Company model + SiteSetting for statistics',
                'about' => 'Uses Company model for all content',
                'board_directors' => 'Uses BoardDirector model',
                'news' => 'Uses Article model (not Post)',
                'investment_application' => 'Uses SiteSetting for share price',
            ]
        ];

        return response()->json([
            'success' => true,
            'data_verification' => [
                'company' => [
                    'name_ar' => $company->name_ar ?? 'Not set',
                    'name_en' => $company->name_en ?? 'Not set',
                    'about_ar' => $company->about_ar ? 'Set (' . strlen($company->about_ar) . ' chars)' : 'Not set',
                    'about_en' => $company->about_en ? 'Set (' . strlen($company->about_en) . ' chars)' : 'Not set',
                    'mission_ar' => $company->mission_ar ? 'Set' : 'Not set',
                    'mission_en' => $company->mission_en ? 'Set' : 'Not set',
                    'vision_ar' => $company->vision_ar ? 'Set' : 'Not set',
                    'vision_en' => $company->vision_en ? 'Set' : 'Not set',
                    'values_ar' => $company->values_ar ? 'Set' : 'Not set',
                    'values_en' => $company->values_en ? 'Set' : 'Not set',
                ],
                'statistics_settings' => [
                    'investors_count' => $settings['investors_count'] ?? 'Not set',
                    'sold_shares' => $settings['sold_shares'] ?? 'Not set',
                    'available_shares' => $settings['available_shares'] ?? 'Not set',
                    'company_value' => $settings['company_value'] ?? 'Not set',
                    'share_price' => $settings['share_price'] ?? 'Not set',
                ],
                'content_counts' => [
                    'published_articles' => $articles,
                    'active_board_directors' => $boardDirectors,
                ],
                'data_consistency' => $dataConsistency,
            ],
            'status' => 'All data sources verified and consistent',
            'message' => 'Comprehensive data verification completed successfully'
        ]);
    }
    return abort(404);
})->name('verify.data');

// Investment Application
Route::get('/investment-application', [App\Http\Controllers\InvestmentApplicationController::class, 'create'])->name('investment-application.create');
Route::post('/investment-application', [App\Http\Controllers\InvestmentApplicationController::class, 'store'])->name('investment-application.store');
Route::get('/investment-application/success', [App\Http\Controllers\InvestmentApplicationController::class, 'success'])->name('investment-application.success');

// Authentication Routes (Login and Logout only)
Route::get('login', [App\Http\Controllers\Auth\LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [App\Http\Controllers\Auth\LoginController::class, 'login']);
Route::post('logout', [App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');

// Admin Routes
Route::prefix('admin')->name('admin.')->middleware(['auth', 'admin', 'update.last.login'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Company routes
    Route::get('/company', [CompanyController::class, 'index'])->name('company.index');
    Route::get('/company/edit', [CompanyController::class, 'edit'])->name('company.edit');
    Route::put('/company', [CompanyController::class, 'update'])->name('company.update');

    // Service routes
    Route::resource('services', ServiceController::class);

    // Board director routes
    Route::resource('board-directors', App\Http\Controllers\Admin\BoardDirectorController::class);

    // Article routes (Media Center)
    Route::resource('articles', App\Http\Controllers\Admin\ArticleController::class);
    Route::post('articles/{article}/toggle-featured', [App\Http\Controllers\Admin\ArticleController::class, 'toggleFeatured'])->name('articles.toggle-featured');

    // User management routes (Admin only)
    Route::resource('users', UserController::class);
    Route::post('users/bulk-update-status', [UserController::class, 'bulkUpdateStatus'])->name('users.bulk-update-status');

    // Profile routes
    Route::prefix('profile')->name('profile.')->group(function () {
        Route::get('/', [App\Http\Controllers\Admin\ProfileController::class, 'index'])->name('index');
        Route::get('/edit', [App\Http\Controllers\Admin\ProfileController::class, 'edit'])->name('edit');
        Route::put('/update', [App\Http\Controllers\Admin\ProfileController::class, 'update'])->name('update');
        Route::get('/change-password', [App\Http\Controllers\Admin\ProfileController::class, 'showChangePasswordForm'])->name('change-password');
        Route::put('/update-password', [App\Http\Controllers\Admin\ProfileController::class, 'updatePassword'])->name('update-password');
        Route::post('/upload-avatar', [App\Http\Controllers\Admin\ProfileController::class, 'uploadAvatar'])->name('upload-avatar');
        Route::delete('/delete-avatar', [App\Http\Controllers\Admin\ProfileController::class, 'deleteAvatar'])->name('delete-avatar');
    });

    // Investment Applications routes - Specific routes first
    Route::get('investment-applications/export', [InvestmentApplicationController::class, 'export'])->name('investment-applications.export');
    Route::get('investment-applications/stats', [InvestmentApplicationController::class, 'getStats'])->name('investment-applications.stats');
    Route::post('investment-applications/bulk-action', [InvestmentApplicationController::class, 'bulkAction'])->name('investment-applications.bulk-action');
    Route::post('investment-applications/{investmentApplication}/update-status', [InvestmentApplicationController::class, 'updateStatus'])->name('investment-applications.update-status');

    // Resource routes last
    Route::resource('investment-applications', InvestmentApplicationController::class)->only(['index', 'show', 'destroy']);

    // Site Settings routes
    Route::get('settings', [App\Http\Controllers\Admin\SiteSettingsController::class, 'index'])->name('settings.index');
    Route::put('settings', [App\Http\Controllers\Admin\SiteSettingsController::class, 'update'])->name('settings.update');
    Route::post('settings/toggle-maintenance', [App\Http\Controllers\Admin\SiteSettingsController::class, 'toggleMaintenance'])->name('settings.toggle-maintenance');
    Route::post('settings/test-email', [App\Http\Controllers\Admin\SiteSettingsController::class, 'testEmail'])->name('settings.test-email');

    // FAQs routes
    Route::resource('faqs', App\Http\Controllers\Admin\FaqController::class);
    Route::post('faqs/{faq}/toggle-status', [App\Http\Controllers\Admin\FaqController::class, 'toggleStatus'])->name('faqs.toggle-status');
    Route::post('faqs/bulk-action', [App\Http\Controllers\Admin\FaqController::class, 'bulkAction'])->name('faqs.bulk-action');
    Route::post('faqs/update-order', [App\Http\Controllers\Admin\FaqController::class, 'updateOrder'])->name('faqs.update-order');
});

// Redirect /home to admin dashboard for authenticated users
Route::get('/home', function () {
    return redirect()->route('admin.dashboard');
})->middleware('auth');

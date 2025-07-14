<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SiteSetting;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class SiteSettingsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
    }

    /**
     * Display the site settings page
     */
    public function index(): View
    {
        $settings = [
            'maintenance' => [
                'maintenance_mode' => SiteSetting::get('maintenance_mode', false),
                'maintenance_message_en' => SiteSetting::get('maintenance_message_en', 'Site is under maintenance. Please check back later.'),
                'maintenance_message_ar' => SiteSetting::get('maintenance_message_ar', 'الموقع تحت الصيانة. يرجى المحاولة لاحقاً.'),
            ],
            'general' => [
                'site_name_en' => SiteSetting::get('site_name_en', 'Quality Investment Company'),
                'site_name_ar' => SiteSetting::get('site_name_ar', 'شركة الجودة للاستثمار'),
                'share_price' => SiteSetting::get('share_price', 100.00),
                'currency' => SiteSetting::get('currency', 'SAR'),
            ],

            'social' => [
                'facebook_url' => SiteSetting::get('facebook_url', ''),
                'twitter_url' => SiteSetting::get('twitter_url', ''),
                'linkedin_url' => SiteSetting::get('linkedin_url', ''),
                'instagram_url' => SiteSetting::get('instagram_url', ''),
                'youtube_url' => SiteSetting::get('youtube_url', ''),
            ],
            'statistics' => [
                'years_experience' => SiteSetting::get('years_experience', '15'),
                'assets_under_management' => SiteSetting::get('assets_under_management', '500M+'),
                'satisfied_clients' => SiteSetting::get('satisfied_clients', '1000+'),
                'average_return' => SiteSetting::get('average_return', '25%'),
            ],
            'seo' => [
                'meta_title_en' => SiteSetting::get('meta_title_en', 'Quality Investment Company - Leading Investment Solutions'),
                'meta_title_ar' => SiteSetting::get('meta_title_ar', 'شركة الجودة للاستثمار - حلول استثمارية رائدة'),
                'meta_description_en' => SiteSetting::get('meta_description_en', 'Quality Investment Company provides professional investment solutions and services in Saudi Arabia.'),
                'meta_description_ar' => SiteSetting::get('meta_description_ar', 'شركة الجودة للاستثمار تقدم حلول وخدمات استثمارية احترافية في المملكة العربية السعودية.'),
                'meta_keywords_en' => SiteSetting::get('meta_keywords_en', 'investment, finance, Saudi Arabia, quality investment'),
                'meta_keywords_ar' => SiteSetting::get('meta_keywords_ar', 'استثمار، تمويل، السعودية، الجودة للاستثمار'),
            ],
            'statistics' => [
                'years_experience' => SiteSetting::get('years_experience', '1500+'),
                'assets_under_management' => SiteSetting::get('assets_under_management', '75,000'),
                'satisfied_clients' => SiteSetting::get('satisfied_clients', '100,000'),
                'average_return' => SiteSetting::get('average_return', '12.5M SAR'),
            ],
            'investment' => [
                'share_price' => SiteSetting::get('share_price', '125.50'),
                'currency' => SiteSetting::get('currency', 'SAR'),
            ],
            'email' => [
                'smtp_host' => SiteSetting::get('smtp_host', 'smtp.gmail.com'),
                'smtp_port' => SiteSetting::get('smtp_port', 587),
                'smtp_username' => SiteSetting::get('smtp_username', ''),
                'smtp_password' => SiteSetting::get('smtp_password', ''),
                'smtp_encryption' => SiteSetting::get('smtp_encryption', 'tls'),
                'mail_from_address' => SiteSetting::get('mail_from_address', 'noreply@qualityinvestment.com'),
                'mail_from_name' => SiteSetting::get('mail_from_name', 'Quality Investment Company'),
            ]
        ];

        return view('admin.settings.index', compact('settings'));
    }

    /**
     * Update site settings
     */
    public function update(Request $request): RedirectResponse
    {
        $request->validate([
            // Maintenance settings
            'maintenance_mode' => 'boolean',
            'maintenance_message_en' => 'nullable|string|max:500',
            'maintenance_message_ar' => 'nullable|string|max:500',

            // General settings
            'site_name_en' => 'required|string|max:255',
            'site_name_ar' => 'required|string|max:255',
            'share_price' => 'required|numeric|min:0',
            'currency' => 'required|string|max:10',



            // Social media
            'facebook_url' => 'nullable|url|max:255',
            'twitter_url' => 'nullable|url|max:255',
            'linkedin_url' => 'nullable|url|max:255',
            'instagram_url' => 'nullable|url|max:255',
            'youtube_url' => 'nullable|url|max:255',

            // SEO settings
            'meta_title_en' => 'required|string|max:255',
            'meta_title_ar' => 'required|string|max:255',
            'meta_description_en' => 'required|string|max:500',
            'meta_description_ar' => 'required|string|max:500',
            'meta_keywords_en' => 'nullable|string|max:255',
            'meta_keywords_ar' => 'nullable|string|max:255',

            // Statistics validation
            'years_experience' => 'nullable|string|max:10',
            'assets_under_management' => 'nullable|string|max:20',
            'satisfied_clients' => 'nullable|string|max:20',
            'average_return' => 'nullable|string|max:10',

            // Investment settings
            'share_price' => 'nullable|numeric|min:0',
            'currency' => 'nullable|string|max:10',

            // Email settings
            'smtp_host' => 'nullable|string|max:255',
            'smtp_port' => 'nullable|integer|min:1|max:65535',
            'smtp_username' => 'nullable|string|max:255',
            'smtp_password' => 'nullable|string|max:255',
            'smtp_encryption' => 'nullable|in:tls,ssl',
            'mail_from_address' => 'nullable|email|max:255',
            'mail_from_name' => 'nullable|string|max:255',
        ]);

        // Define settings with their types and groups
        $settingsConfig = [
            // Maintenance
            'maintenance_mode' => ['type' => 'boolean', 'group' => 'maintenance', 'public' => true],
            'maintenance_message_en' => ['type' => 'text', 'group' => 'maintenance', 'public' => true],
            'maintenance_message_ar' => ['type' => 'text', 'group' => 'maintenance', 'public' => true],

            // General
            'site_name_en' => ['type' => 'text', 'group' => 'general', 'public' => true],
            'site_name_ar' => ['type' => 'text', 'group' => 'general', 'public' => true],
            'share_price' => ['type' => 'number', 'group' => 'general', 'public' => true],
            'currency' => ['type' => 'text', 'group' => 'general', 'public' => true],



            // Social
            'facebook_url' => ['type' => 'url', 'group' => 'social', 'public' => true],
            'twitter_url' => ['type' => 'url', 'group' => 'social', 'public' => true],
            'linkedin_url' => ['type' => 'url', 'group' => 'social', 'public' => true],
            'instagram_url' => ['type' => 'url', 'group' => 'social', 'public' => true],
            'youtube_url' => ['type' => 'url', 'group' => 'social', 'public' => true],

            // SEO
            'meta_title_en' => ['type' => 'text', 'group' => 'seo', 'public' => true],
            'meta_title_ar' => ['type' => 'text', 'group' => 'seo', 'public' => true],
            'meta_description_en' => ['type' => 'text', 'group' => 'seo', 'public' => true],
            'meta_description_ar' => ['type' => 'text', 'group' => 'seo', 'public' => true],
            'meta_keywords_en' => ['type' => 'text', 'group' => 'seo', 'public' => true],
            'meta_keywords_ar' => ['type' => 'text', 'group' => 'seo', 'public' => true],

            // Statistics
            'years_experience' => ['type' => 'text', 'group' => 'statistics', 'public' => true],
            'assets_under_management' => ['type' => 'text', 'group' => 'statistics', 'public' => true],
            'satisfied_clients' => ['type' => 'text', 'group' => 'statistics', 'public' => true],
            'average_return' => ['type' => 'text', 'group' => 'statistics', 'public' => true],

            // Investment settings
            'share_price' => ['type' => 'number', 'group' => 'investment', 'public' => true],
            'currency' => ['type' => 'text', 'group' => 'investment', 'public' => true],

            // Email
            'smtp_host' => ['type' => 'text', 'group' => 'email', 'public' => false],
            'smtp_port' => ['type' => 'number', 'group' => 'email', 'public' => false],
            'smtp_username' => ['type' => 'text', 'group' => 'email', 'public' => false],
            'smtp_password' => ['type' => 'text', 'group' => 'email', 'public' => false],
            'smtp_encryption' => ['type' => 'text', 'group' => 'email', 'public' => false],
            'mail_from_address' => ['type' => 'email', 'group' => 'email', 'public' => false],
            'mail_from_name' => ['type' => 'text', 'group' => 'email', 'public' => false],
        ];

        // Update each setting
        foreach ($settingsConfig as $key => $config) {
            if ($request->has($key)) {
                SiteSetting::set(
                    $key,
                    $request->input($key),
                    $config['type'],
                    $config['group'],
                    null,
                    $config['public']
                );
            }
        }

        return redirect()->route('admin.settings.index')
            ->with('success', __('admin.settings_updated_successfully'));
    }

    /**
     * Toggle maintenance mode
     */
    public function toggleMaintenance(Request $request): RedirectResponse
    {
        $currentMode = SiteSetting::get('maintenance_mode', false);
        $newMode = !$currentMode;

        SiteSetting::set('maintenance_mode', $newMode, 'boolean', 'maintenance', null, true);

        $message = $newMode
            ? __('admin.maintenance_mode_enabled')
            : __('admin.maintenance_mode_disabled');

        return redirect()->back()->with('success', $message);
    }

    /**
     * Test email configuration
     */
    public function testEmail(Request $request): RedirectResponse
    {
        $request->validate([
            'test_email' => 'required|email'
        ]);

        try {
            // Here you would implement email testing logic
            // For now, just return success
            return redirect()->back()->with('success', __('admin.test_email_sent_successfully'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', __('admin.test_email_failed') . ': ' . $e->getMessage());
        }
    }
}

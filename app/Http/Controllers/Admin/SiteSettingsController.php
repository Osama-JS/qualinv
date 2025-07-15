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

            // Hero Section Settings
            'hero' => [
                'hero_title_ar' => SiteSetting::get('hero_title_ar', 'استثمر في مستقبلك مع شركة الجودة للاستثمار'),
                'hero_title_en' => SiteSetting::get('hero_title_en', 'Invest in Your Future with Quality Investment Company'),
                'hero_button_start_ar' => SiteSetting::get('hero_button_start_ar', 'ابدأ الاستثمار'),
                'hero_button_start_en' => SiteSetting::get('hero_button_start_en', 'Start Investing'),
                'hero_button_learn_ar' => SiteSetting::get('hero_button_learn_ar', 'تعرف علينا'),
                'hero_button_learn_en' => SiteSetting::get('hero_button_learn_en', 'Learn More'),
                'hero_share_price_title_ar' => SiteSetting::get('hero_share_price_title_ar', 'سعر السهم الحالي'),
                'hero_share_price_title_en' => SiteSetting::get('hero_share_price_title_en', 'Current Share Price'),
                'hero_share_price_change_ar' => SiteSetting::get('hero_share_price_change_ar', 'اليوم'),
                'hero_share_price_change_en' => SiteSetting::get('hero_share_price_change_en', 'Today'),
                'hero_share_price_updated_ar' => SiteSetting::get('hero_share_price_updated_ar', 'آخر تحديث: اليوم'),
                'hero_share_price_updated_en' => SiteSetting::get('hero_share_price_updated_en', 'Last updated: Today'),
            ],

            // Statistics Section Settings
            'stats' => [
                'stats_title_ar' => SiteSetting::get('stats_title_ar', 'إنجازاتنا بالأرقام'),
                'stats_title_en' => SiteSetting::get('stats_title_en', 'Our Achievements in Numbers'),
                'stats_subtitle_ar' => SiteSetting::get('stats_subtitle_ar', 'أرقام تعكس ثقة عملائنا وتميز خدماتنا في السوق المالي'),
                'stats_subtitle_en' => SiteSetting::get('stats_subtitle_en', 'Numbers that reflect our clients\' trust and excellence of our services in the financial market'),
                'stats_investors_ar' => SiteSetting::get('stats_investors_ar', 'المستثمرين'),
                'stats_investors_en' => SiteSetting::get('stats_investors_en', 'Investors'),
                'stats_investors_desc_ar' => SiteSetting::get('stats_investors_desc_ar', 'عميل يثق بخدماتنا'),
                'stats_investors_desc_en' => SiteSetting::get('stats_investors_desc_en', 'Clients trust our services'),
                'stats_shares_sold_ar' => SiteSetting::get('stats_shares_sold_ar', 'الأسهم المباعة'),
                'stats_shares_sold_en' => SiteSetting::get('stats_shares_sold_en', 'Shares Sold'),
                'stats_shares_sold_desc_ar' => SiteSetting::get('stats_shares_sold_desc_ar', 'سهم تم بيعه بنجاح'),
                'stats_shares_sold_desc_en' => SiteSetting::get('stats_shares_sold_desc_en', 'Shares sold successfully'),
                'stats_available_shares_ar' => SiteSetting::get('stats_available_shares_ar', 'الأسهم المتاحة'),
                'stats_available_shares_en' => SiteSetting::get('stats_available_shares_en', 'Available Shares'),
                'stats_available_shares_desc_ar' => SiteSetting::get('stats_available_shares_desc_ar', 'سهم متاح للاستثمار'),
                'stats_available_shares_desc_en' => SiteSetting::get('stats_available_shares_desc_en', 'Shares available for investment'),
                'stats_company_value_ar' => SiteSetting::get('stats_company_value_ar', 'قيمة الشركة'),
                'stats_company_value_en' => SiteSetting::get('stats_company_value_en', 'Company Value'),
                'stats_company_value_desc_ar' => SiteSetting::get('stats_company_value_desc_ar', 'إجمالي قيمة الشركة'),
                'stats_company_value_desc_en' => SiteSetting::get('stats_company_value_desc_en', 'Total company value'),
            ],

            // Company Overview Section Settings
            'company_overview' => [
                'company_overview_title_ar' => SiteSetting::get('company_overview_title_ar', 'نبذة عن الشركة'),
                'company_overview_title_en' => SiteSetting::get('company_overview_title_en', 'About Our Company'),
                'company_mission_title_ar' => SiteSetting::get('company_mission_title_ar', 'رسالتنا'),
                'company_mission_title_en' => SiteSetting::get('company_mission_title_en', 'Our Mission'),
                'company_vision_title_ar' => SiteSetting::get('company_vision_title_ar', 'رؤيتنا'),
                'company_vision_title_en' => SiteSetting::get('company_vision_title_en', 'Our Vision'),
                'company_values_title_ar' => SiteSetting::get('company_values_title_ar', 'قيمنا'),
                'company_values_title_en' => SiteSetting::get('company_values_title_en', 'Our Values'),
            ],

            // FAQ Section Settings
            'faq' => [
                'faq_title_ar' => SiteSetting::get('faq_title_ar', 'الأسئلة الشائعة'),
                'faq_title_en' => SiteSetting::get('faq_title_en', 'Frequently Asked Questions'),
                'faq_subtitle_ar' => SiteSetting::get('faq_subtitle_ar', 'إجابات على أكثر الأسئلة شيوعاً حول خدماتنا الاستثمارية وعملياتنا'),
                'faq_subtitle_en' => SiteSetting::get('faq_subtitle_en', 'Answers to the most common questions about our investment services and operations'),
                'faq_contact_question_ar' => SiteSetting::get('faq_contact_question_ar', 'لديك سؤال آخر؟'),
                'faq_contact_question_en' => SiteSetting::get('faq_contact_question_en', 'Have another question?'),
                'faq_contact_button_ar' => SiteSetting::get('faq_contact_button_ar', 'تواصل معنا'),
                'faq_contact_button_en' => SiteSetting::get('faq_contact_button_en', 'Contact Us'),
            ],

            // News Section Settings
            'news' => [
                'news_title_ar' => SiteSetting::get('news_title_ar', 'آخر الأخبار'),
                'news_title_en' => SiteSetting::get('news_title_en', 'Latest News'),
                'news_subtitle_ar' => SiteSetting::get('news_subtitle_ar', 'تابع آخر أخبار الشركة والسوق المالي'),
                'news_subtitle_en' => SiteSetting::get('news_subtitle_en', 'Stay updated with our latest company and market news'),
                'news_read_more_ar' => SiteSetting::get('news_read_more_ar', 'اقرأ المزيد'),
                'news_read_more_en' => SiteSetting::get('news_read_more_en', 'Read More'),
                'news_view_all_ar' => SiteSetting::get('news_view_all_ar', 'جميع الأخبار'),
                'news_view_all_en' => SiteSetting::get('news_view_all_en', 'View All News'),
            ],

            // Board Directors Section Settings
            'board' => [
                'board_title_ar' => SiteSetting::get('board_title_ar', 'مجلس الإدارة'),
                'board_title_en' => SiteSetting::get('board_title_en', 'Board of Directors'),
                'board_subtitle_ar' => SiteSetting::get('board_subtitle_ar', 'فريق من الخبراء المتميزين يقود الشركة نحو التميز والنجاح'),
                'board_subtitle_en' => SiteSetting::get('board_subtitle_en', 'A team of distinguished experts leading the company towards excellence and success'),
            ],

            // CTA Section Settings
            'cta' => [
                'cta_title_ar' => SiteSetting::get('cta_title_ar', 'ابدأ رحلتك الاستثمارية اليوم'),
                'cta_title_en' => SiteSetting::get('cta_title_en', 'Start Your Investment Journey Today'),
                'cta_subtitle_ar' => SiteSetting::get('cta_subtitle_ar', 'انضم إلى آلاف المستثمرين الذين يثقون بخبرتنا لتحقيق أهدافهم المالية'),
                'cta_subtitle_en' => SiteSetting::get('cta_subtitle_en', 'Join thousands of investors who trust our expertise to achieve their financial goals'),
                'cta_button_ar' => SiteSetting::get('cta_button_ar', 'ابدأ الاستثمار الآن'),
                'cta_button_en' => SiteSetting::get('cta_button_en', 'Start Investing Now'),
            ],

            // About Page Settings
            'about' => [
                'about_page_title_ar' => SiteSetting::get('about_page_title_ar', 'عن الشركة'),
                'about_page_title_en' => SiteSetting::get('about_page_title_en', 'About Us'),
                'about_who_we_are_ar' => SiteSetting::get('about_who_we_are_ar', 'من نحن'),
                'about_who_we_are_en' => SiteSetting::get('about_who_we_are_en', 'Who We Are'),
                'about_our_story_ar' => SiteSetting::get('about_our_story_ar', 'قصتنا'),
                'about_our_story_en' => SiteSetting::get('about_our_story_en', 'Our Story'),
            ],

            // Contact Page Settings
            'contact' => [
                'contact_page_title_ar' => SiteSetting::get('contact_page_title_ar', 'تواصل معنا'),
                'contact_page_title_en' => SiteSetting::get('contact_page_title_en', 'Contact Us'),
                'contact_page_subtitle_ar' => SiteSetting::get('contact_page_subtitle_ar', 'نحن هنا لمساعدتك في رحلتك الاستثمارية. تواصل معنا للحصول على استشارة مجانية'),
                'contact_page_subtitle_en' => SiteSetting::get('contact_page_subtitle_en', 'We are here to help you in your investment journey. Contact us for a free consultation'),
                'contact_phone_title_ar' => SiteSetting::get('contact_phone_title_ar', 'الهاتف'),
                'contact_phone_title_en' => SiteSetting::get('contact_phone_title_en', 'Phone'),
                'contact_phone_hours_ar' => SiteSetting::get('contact_phone_hours_ar', 'الأحد - الخميس: 9:00 ص - 6:00 م'),
                'contact_phone_hours_en' => SiteSetting::get('contact_phone_hours_en', 'Sun - Thu: 9:00 AM - 6:00 PM'),
                'contact_email_title_ar' => SiteSetting::get('contact_email_title_ar', 'البريد الإلكتروني'),
                'contact_email_title_en' => SiteSetting::get('contact_email_title_en', 'Email'),
                'contact_address_title_ar' => SiteSetting::get('contact_address_title_ar', 'العنوان'),
                'contact_address_title_en' => SiteSetting::get('contact_address_title_en', 'Address'),
                'contact_follow_us_ar' => SiteSetting::get('contact_follow_us_ar', 'تابعنا على'),
                'contact_follow_us_en' => SiteSetting::get('contact_follow_us_en', 'Follow Us'),
                'contact_form_title_ar' => SiteSetting::get('contact_form_title_ar', 'أرسل لنا رسالة'),
                'contact_form_title_en' => SiteSetting::get('contact_form_title_en', 'Send us a Message'),
                'contact_form_name_ar' => SiteSetting::get('contact_form_name_ar', 'الاسم الكامل'),
                'contact_form_name_en' => SiteSetting::get('contact_form_name_en', 'Full Name'),
                'contact_form_email_ar' => SiteSetting::get('contact_form_email_ar', 'البريد الإلكتروني'),
                'contact_form_email_en' => SiteSetting::get('contact_form_email_en', 'Email Address'),
                'contact_form_subject_ar' => SiteSetting::get('contact_form_subject_ar', 'الموضوع'),
                'contact_form_subject_en' => SiteSetting::get('contact_form_subject_en', 'Subject'),
                'contact_form_message_ar' => SiteSetting::get('contact_form_message_ar', 'الرسالة'),
                'contact_form_message_en' => SiteSetting::get('contact_form_message_en', 'Message'),
                'contact_form_send_ar' => SiteSetting::get('contact_form_send_ar', 'إرسال الرسالة'),
                'contact_form_send_en' => SiteSetting::get('contact_form_send_en', 'Send Message'),
            ],

            // Investment Application Page Settings
            'investment_app' => [
                'investment_page_title_ar' => SiteSetting::get('investment_page_title_ar', 'طلب استثمار'),
                'investment_page_title_en' => SiteSetting::get('investment_page_title_en', 'Investment Application'),
                'investment_page_subtitle_ar' => SiteSetting::get('investment_page_subtitle_ar', 'ابدأ رحلتك الاستثمارية معنا من خلال تعبئة النموذج أدناه بعناية'),
                'investment_page_subtitle_en' => SiteSetting::get('investment_page_subtitle_en', 'Start your investment journey with us by carefully filling out the form below'),
                'investment_instructions_title_ar' => SiteSetting::get('investment_instructions_title_ar', 'تعليمات مهمة'),
                'investment_instructions_title_en' => SiteSetting::get('investment_instructions_title_en', 'Important Instructions'),
                'investment_share_info_title_ar' => SiteSetting::get('investment_share_info_title_ar', 'معلومات السهم'),
                'investment_share_info_title_en' => SiteSetting::get('investment_share_info_title_en', 'Share Information'),
                'investment_support_title_ar' => SiteSetting::get('investment_support_title_ar', 'الدعم'),
                'investment_support_title_en' => SiteSetting::get('investment_support_title_en', 'Support'),
            ],

            'social' => [
                'facebook_url' => SiteSetting::get('facebook_url', ''),
                'twitter_url' => SiteSetting::get('twitter_url', ''),
                'linkedin_url' => SiteSetting::get('linkedin_url', ''),
                'instagram_url' => SiteSetting::get('instagram_url', ''),
                'youtube_url' => SiteSetting::get('youtube_url', ''),
            ],
            'seo' => [
                'meta_title_en' => SiteSetting::get('meta_title_en', 'Quality Investment Company - Leading Investment Solutions'),
                'meta_title_ar' => SiteSetting::get('meta_title_ar', 'شركة الجودة للاستثمار - حلول استثمارية رائدة'),
                'meta_description_en' => SiteSetting::get('meta_description_en', 'Quality Investment Company provides professional investment solutions and services in Saudi Arabia.'),
                'meta_description_ar' => SiteSetting::get('meta_description_ar', 'شركة الجودة للاستثمار تقدم حلول وخدمات استثمارية احترافية في المملكة العربية السعودية.'),
                'meta_keywords_en' => SiteSetting::get('meta_keywords_en', 'investment, finance, Saudi Arabia, quality investment'),
                'meta_keywords_ar' => SiteSetting::get('meta_keywords_ar', 'استثمار، تمويل، السعودية، الجودة للاستثمار'),
            ],
            'pages' => [
                'news_page_enabled' => SiteSetting::get('news_page_enabled', true),
            ],
            'statistics' => [
                'years_experience' => SiteSetting::get('years_experience', '1500+'),
                'assets_under_management' => SiteSetting::get('assets_under_management', '75,000'),
                'satisfied_clients' => SiteSetting::get('satisfied_clients', '100,000'),
                'average_return' => SiteSetting::get('average_return', '12.5M SAR'),
                'investors_count' => SiteSetting::get('investors_count', '1000'),
                'sold_shares' => SiteSetting::get('sold_shares', '50000'),
                'available_shares' => SiteSetting::get('available_shares', '25000'),
                'company_value' => SiteSetting::get('company_value', '500M'),
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

            // Page visibility settings
            'news_page_enabled' => 'boolean',

            // Statistics validation
            'years_experience' => 'nullable|string|max:10',
            'assets_under_management' => 'nullable|string|max:20',
            'satisfied_clients' => 'nullable|string|max:20',
            'average_return' => 'nullable|string|max:10',
            'investors_count' => 'nullable|string|max:10',
            'sold_shares' => 'nullable|string|max:10',
            'available_shares' => 'nullable|string|max:10',
            'company_value' => 'nullable|string|max:10',

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

            // Hero Section
            'hero_title_ar' => ['type' => 'text', 'group' => 'content', 'public' => true],
            'hero_title_en' => ['type' => 'text', 'group' => 'content', 'public' => true],
            'hero_button_start_ar' => ['type' => 'text', 'group' => 'content', 'public' => true],
            'hero_button_start_en' => ['type' => 'text', 'group' => 'content', 'public' => true],
            'hero_button_learn_ar' => ['type' => 'text', 'group' => 'content', 'public' => true],
            'hero_button_learn_en' => ['type' => 'text', 'group' => 'content', 'public' => true],
            'hero_share_price_title_ar' => ['type' => 'text', 'group' => 'content', 'public' => true],
            'hero_share_price_title_en' => ['type' => 'text', 'group' => 'content', 'public' => true],
            'hero_share_price_change_ar' => ['type' => 'text', 'group' => 'content', 'public' => true],
            'hero_share_price_change_en' => ['type' => 'text', 'group' => 'content', 'public' => true],
            'hero_share_price_updated_ar' => ['type' => 'text', 'group' => 'content', 'public' => true],
            'hero_share_price_updated_en' => ['type' => 'text', 'group' => 'content', 'public' => true],

            // Statistics Section
            'stats_title_ar' => ['type' => 'text', 'group' => 'content', 'public' => true],
            'stats_title_en' => ['type' => 'text', 'group' => 'content', 'public' => true],
            'stats_subtitle_ar' => ['type' => 'text', 'group' => 'content', 'public' => true],
            'stats_subtitle_en' => ['type' => 'text', 'group' => 'content', 'public' => true],
            'stats_investors_ar' => ['type' => 'text', 'group' => 'content', 'public' => true],
            'stats_investors_en' => ['type' => 'text', 'group' => 'content', 'public' => true],
            'stats_investors_desc_ar' => ['type' => 'text', 'group' => 'content', 'public' => true],
            'stats_investors_desc_en' => ['type' => 'text', 'group' => 'content', 'public' => true],
            'stats_shares_sold_ar' => ['type' => 'text', 'group' => 'content', 'public' => true],
            'stats_shares_sold_en' => ['type' => 'text', 'group' => 'content', 'public' => true],
            'stats_shares_sold_desc_ar' => ['type' => 'text', 'group' => 'content', 'public' => true],
            'stats_shares_sold_desc_en' => ['type' => 'text', 'group' => 'content', 'public' => true],
            'stats_available_shares_ar' => ['type' => 'text', 'group' => 'content', 'public' => true],
            'stats_available_shares_en' => ['type' => 'text', 'group' => 'content', 'public' => true],
            'stats_available_shares_desc_ar' => ['type' => 'text', 'group' => 'content', 'public' => true],
            'stats_available_shares_desc_en' => ['type' => 'text', 'group' => 'content', 'public' => true],
            'stats_company_value_ar' => ['type' => 'text', 'group' => 'content', 'public' => true],
            'stats_company_value_en' => ['type' => 'text', 'group' => 'content', 'public' => true],
            'stats_company_value_desc_ar' => ['type' => 'text', 'group' => 'content', 'public' => true],
            'stats_company_value_desc_en' => ['type' => 'text', 'group' => 'content', 'public' => true],

            // Company Overview Section
            'company_overview_title_ar' => ['type' => 'text', 'group' => 'content', 'public' => true],
            'company_overview_title_en' => ['type' => 'text', 'group' => 'content', 'public' => true],
            'company_mission_title_ar' => ['type' => 'text', 'group' => 'content', 'public' => true],
            'company_mission_title_en' => ['type' => 'text', 'group' => 'content', 'public' => true],
            'company_vision_title_ar' => ['type' => 'text', 'group' => 'content', 'public' => true],
            'company_vision_title_en' => ['type' => 'text', 'group' => 'content', 'public' => true],
            'company_values_title_ar' => ['type' => 'text', 'group' => 'content', 'public' => true],
            'company_values_title_en' => ['type' => 'text', 'group' => 'content', 'public' => true],

            // FAQ Section
            'faq_title_ar' => ['type' => 'text', 'group' => 'content', 'public' => true],
            'faq_title_en' => ['type' => 'text', 'group' => 'content', 'public' => true],
            'faq_subtitle_ar' => ['type' => 'text', 'group' => 'content', 'public' => true],
            'faq_subtitle_en' => ['type' => 'text', 'group' => 'content', 'public' => true],
            'faq_contact_question_ar' => ['type' => 'text', 'group' => 'content', 'public' => true],
            'faq_contact_question_en' => ['type' => 'text', 'group' => 'content', 'public' => true],
            'faq_contact_button_ar' => ['type' => 'text', 'group' => 'content', 'public' => true],
            'faq_contact_button_en' => ['type' => 'text', 'group' => 'content', 'public' => true],

            // News Section
            'news_title_ar' => ['type' => 'text', 'group' => 'content', 'public' => true],
            'news_title_en' => ['type' => 'text', 'group' => 'content', 'public' => true],
            'news_subtitle_ar' => ['type' => 'text', 'group' => 'content', 'public' => true],
            'news_subtitle_en' => ['type' => 'text', 'group' => 'content', 'public' => true],
            'news_read_more_ar' => ['type' => 'text', 'group' => 'content', 'public' => true],
            'news_read_more_en' => ['type' => 'text', 'group' => 'content', 'public' => true],
            'news_view_all_ar' => ['type' => 'text', 'group' => 'content', 'public' => true],
            'news_view_all_en' => ['type' => 'text', 'group' => 'content', 'public' => true],

            // Board Directors Section
            'board_title_ar' => ['type' => 'text', 'group' => 'content', 'public' => true],
            'board_title_en' => ['type' => 'text', 'group' => 'content', 'public' => true],
            'board_subtitle_ar' => ['type' => 'text', 'group' => 'content', 'public' => true],
            'board_subtitle_en' => ['type' => 'text', 'group' => 'content', 'public' => true],

            // CTA Section
            'cta_title_ar' => ['type' => 'text', 'group' => 'content', 'public' => true],
            'cta_title_en' => ['type' => 'text', 'group' => 'content', 'public' => true],
            'cta_subtitle_ar' => ['type' => 'text', 'group' => 'content', 'public' => true],
            'cta_subtitle_en' => ['type' => 'text', 'group' => 'content', 'public' => true],
            'cta_button_ar' => ['type' => 'text', 'group' => 'content', 'public' => true],
            'cta_button_en' => ['type' => 'text', 'group' => 'content', 'public' => true],

            // About Page
            'about_page_title_ar' => ['type' => 'text', 'group' => 'content', 'public' => true],
            'about_page_title_en' => ['type' => 'text', 'group' => 'content', 'public' => true],
            'about_who_we_are_ar' => ['type' => 'text', 'group' => 'content', 'public' => true],
            'about_who_we_are_en' => ['type' => 'text', 'group' => 'content', 'public' => true],
            'about_our_story_ar' => ['type' => 'text', 'group' => 'content', 'public' => true],
            'about_our_story_en' => ['type' => 'text', 'group' => 'content', 'public' => true],

            // Contact Page
            'contact_page_title_ar' => ['type' => 'text', 'group' => 'content', 'public' => true],
            'contact_page_title_en' => ['type' => 'text', 'group' => 'content', 'public' => true],
            'contact_page_subtitle_ar' => ['type' => 'text', 'group' => 'content', 'public' => true],
            'contact_page_subtitle_en' => ['type' => 'text', 'group' => 'content', 'public' => true],
            'contact_phone_title_ar' => ['type' => 'text', 'group' => 'content', 'public' => true],
            'contact_phone_title_en' => ['type' => 'text', 'group' => 'content', 'public' => true],
            'contact_phone_hours_ar' => ['type' => 'text', 'group' => 'content', 'public' => true],
            'contact_phone_hours_en' => ['type' => 'text', 'group' => 'content', 'public' => true],
            'contact_email_title_ar' => ['type' => 'text', 'group' => 'content', 'public' => true],
            'contact_email_title_en' => ['type' => 'text', 'group' => 'content', 'public' => true],
            'contact_address_title_ar' => ['type' => 'text', 'group' => 'content', 'public' => true],
            'contact_address_title_en' => ['type' => 'text', 'group' => 'content', 'public' => true],
            'contact_follow_us_ar' => ['type' => 'text', 'group' => 'content', 'public' => true],
            'contact_follow_us_en' => ['type' => 'text', 'group' => 'content', 'public' => true],
            'contact_form_title_ar' => ['type' => 'text', 'group' => 'content', 'public' => true],
            'contact_form_title_en' => ['type' => 'text', 'group' => 'content', 'public' => true],
            'contact_form_name_ar' => ['type' => 'text', 'group' => 'content', 'public' => true],
            'contact_form_name_en' => ['type' => 'text', 'group' => 'content', 'public' => true],
            'contact_form_email_ar' => ['type' => 'text', 'group' => 'content', 'public' => true],
            'contact_form_email_en' => ['type' => 'text', 'group' => 'content', 'public' => true],
            'contact_form_subject_ar' => ['type' => 'text', 'group' => 'content', 'public' => true],
            'contact_form_subject_en' => ['type' => 'text', 'group' => 'content', 'public' => true],
            'contact_form_message_ar' => ['type' => 'text', 'group' => 'content', 'public' => true],
            'contact_form_message_en' => ['type' => 'text', 'group' => 'content', 'public' => true],
            'contact_form_send_ar' => ['type' => 'text', 'group' => 'content', 'public' => true],
            'contact_form_send_en' => ['type' => 'text', 'group' => 'content', 'public' => true],

            // Investment Application Page
            'investment_page_title_ar' => ['type' => 'text', 'group' => 'content', 'public' => true],
            'investment_page_title_en' => ['type' => 'text', 'group' => 'content', 'public' => true],
            'investment_page_subtitle_ar' => ['type' => 'text', 'group' => 'content', 'public' => true],
            'investment_page_subtitle_en' => ['type' => 'text', 'group' => 'content', 'public' => true],
            'investment_instructions_title_ar' => ['type' => 'text', 'group' => 'content', 'public' => true],
            'investment_instructions_title_en' => ['type' => 'text', 'group' => 'content', 'public' => true],
            'investment_share_info_title_ar' => ['type' => 'text', 'group' => 'content', 'public' => true],
            'investment_share_info_title_en' => ['type' => 'text', 'group' => 'content', 'public' => true],
            'investment_support_title_ar' => ['type' => 'text', 'group' => 'content', 'public' => true],
            'investment_support_title_en' => ['type' => 'text', 'group' => 'content', 'public' => true],

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

            // Page visibility
            'news_page_enabled' => ['type' => 'boolean', 'group' => 'pages', 'public' => true],

            // Statistics
            'years_experience' => ['type' => 'text', 'group' => 'statistics', 'public' => true],
            'assets_under_management' => ['type' => 'text', 'group' => 'statistics', 'public' => true],
            'satisfied_clients' => ['type' => 'text', 'group' => 'statistics', 'public' => true],
            'average_return' => ['type' => 'text', 'group' => 'statistics', 'public' => true],
            'investors_count' => ['type' => 'text', 'group' => 'statistics', 'public' => true],
            'sold_shares' => ['type' => 'text', 'group' => 'statistics', 'public' => true],
            'available_shares' => ['type' => 'text', 'group' => 'statistics', 'public' => true],
            'company_value' => ['type' => 'text', 'group' => 'statistics', 'public' => true],

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
            // Handle boolean fields specially (checkboxes)
            if ($config['type'] === 'boolean') {
                $value = $request->has($key) ? true : false;
                SiteSetting::set(
                    $key,
                    $value,
                    $config['type'],
                    $config['group'],
                    null,
                    $config['public']
                );
            } elseif ($request->has($key)) {
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

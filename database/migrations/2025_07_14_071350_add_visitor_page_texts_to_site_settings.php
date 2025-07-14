<?php

use Illuminate\Database\Migrations\Migration;
use App\Models\SiteSetting;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Homepage texts
        $homepageTexts = [
            // Hero section
            'hero_title_ar' => 'استثمر في مستقبلك مع شركة الجودة للاستثمار',
            'hero_title_en' => 'Invest in Your Future with Quality Investment Company',
            'hero_button_start_ar' => 'ابدأ الاستثمار',
            'hero_button_start_en' => 'Start Investing',
            'hero_button_learn_ar' => 'تعرف علينا',
            'hero_button_learn_en' => 'Learn More',
            'hero_share_price_title_ar' => 'سعر السهم الحالي',
            'hero_share_price_title_en' => 'Current Share Price',
            'hero_share_price_change_ar' => 'اليوم',
            'hero_share_price_change_en' => 'Today',
            'hero_share_price_updated_ar' => 'آخر تحديث: اليوم',
            'hero_share_price_updated_en' => 'Last updated: Today',
            
            // Statistics section
            'stats_title_ar' => 'إنجازاتنا بالأرقام',
            'stats_title_en' => 'Our Achievements in Numbers',
            'stats_subtitle_ar' => 'أرقام تعكس ثقة عملائنا وتميز خدماتنا في السوق المالي',
            'stats_subtitle_en' => 'Numbers that reflect our clients\' trust and excellence of our services in the financial market',
            'stats_investors_ar' => 'المستثمرين',
            'stats_investors_en' => 'Investors',
            'stats_investors_desc_ar' => 'عميل يثق بخدماتنا',
            'stats_investors_desc_en' => 'Clients trust our services',
            'stats_shares_sold_ar' => 'الأسهم المباعة',
            'stats_shares_sold_en' => 'Shares Sold',
            'stats_shares_sold_desc_ar' => 'سهم تم بيعه بنجاح',
            'stats_shares_sold_desc_en' => 'Shares sold successfully',
            'stats_available_shares_ar' => 'الأسهم المتاحة',
            'stats_available_shares_en' => 'Available Shares',
            'stats_available_shares_desc_ar' => 'سهم متاح للاستثمار',
            'stats_available_shares_desc_en' => 'Shares available for investment',
            'stats_company_value_ar' => 'قيمة الشركة',
            'stats_company_value_en' => 'Company Value',
            'stats_company_value_desc_ar' => 'إجمالي قيمة الشركة',
            'stats_company_value_desc_en' => 'Total company value',
            
            // Company overview section
            'company_overview_title_ar' => 'نبذة عن الشركة',
            'company_overview_title_en' => 'About Our Company',
            'company_mission_title_ar' => 'رسالتنا',
            'company_mission_title_en' => 'Our Mission',
            'company_vision_title_ar' => 'رؤيتنا',
            'company_vision_title_en' => 'Our Vision',
            'company_values_title_ar' => 'قيمنا',
            'company_values_title_en' => 'Our Values',
            
            // FAQ section
            'faq_title_ar' => 'الأسئلة الشائعة',
            'faq_title_en' => 'Frequently Asked Questions',
            'faq_subtitle_ar' => 'إجابات على أكثر الأسئلة شيوعاً حول خدماتنا الاستثمارية وعملياتنا',
            'faq_subtitle_en' => 'Answers to the most common questions about our investment services and operations',
            'faq_contact_question_ar' => 'لديك سؤال آخر؟',
            'faq_contact_question_en' => 'Have another question?',
            'faq_contact_button_ar' => 'تواصل معنا',
            'faq_contact_button_en' => 'Contact Us',
            
            // News section
            'news_title_ar' => 'آخر الأخبار',
            'news_title_en' => 'Latest News',
            'news_subtitle_ar' => 'تابع آخر أخبار الشركة والسوق المالي',
            'news_subtitle_en' => 'Stay updated with our latest company and market news',
            'news_read_more_ar' => 'اقرأ المزيد',
            'news_read_more_en' => 'Read More',
            'news_view_all_ar' => 'جميع الأخبار',
            'news_view_all_en' => 'View All News',
            
            // Board directors section
            'board_title_ar' => 'مجلس الإدارة',
            'board_title_en' => 'Board of Directors',
            'board_subtitle_ar' => 'فريق من الخبراء المتميزين يقود الشركة نحو التميز والنجاح',
            'board_subtitle_en' => 'A team of distinguished experts leading the company towards excellence and success',
            
            // CTA section
            'cta_title_ar' => 'ابدأ رحلتك الاستثمارية اليوم',
            'cta_title_en' => 'Start Your Investment Journey Today',
            'cta_subtitle_ar' => 'انضم إلى آلاف المستثمرين الذين يثقون بخبرتنا لتحقيق أهدافهم المالية',
            'cta_subtitle_en' => 'Join thousands of investors who trust our expertise to achieve their financial goals',
            'cta_button_ar' => 'ابدأ الاستثمار الآن',
            'cta_button_en' => 'Start Investing Now',
        ];
        
        // About page texts
        $aboutTexts = [
            'about_page_title_ar' => 'عن الشركة',
            'about_page_title_en' => 'About Us',
            'about_who_we_are_ar' => 'من نحن',
            'about_who_we_are_en' => 'Who We Are',
            'about_our_story_ar' => 'قصتنا',
            'about_our_story_en' => 'Our Story',
        ];
        
        // Contact page texts
        $contactTexts = [
            'contact_page_title_ar' => 'تواصل معنا',
            'contact_page_title_en' => 'Contact Us',
            'contact_page_subtitle_ar' => 'نحن هنا لمساعدتك في رحلتك الاستثمارية. تواصل معنا للحصول على استشارة مجانية',
            'contact_page_subtitle_en' => 'We are here to help you in your investment journey. Contact us for a free consultation',
            'contact_phone_title_ar' => 'الهاتف',
            'contact_phone_title_en' => 'Phone',
            'contact_phone_hours_ar' => 'الأحد - الخميس: 9:00 ص - 6:00 م',
            'contact_phone_hours_en' => 'Sun - Thu: 9:00 AM - 6:00 PM',
            'contact_email_title_ar' => 'البريد الإلكتروني',
            'contact_email_title_en' => 'Email',
            'contact_address_title_ar' => 'العنوان',
            'contact_address_title_en' => 'Address',
            'contact_follow_us_ar' => 'تابعنا على',
            'contact_follow_us_en' => 'Follow Us',
            'contact_form_title_ar' => 'أرسل لنا رسالة',
            'contact_form_title_en' => 'Send us a Message',
            'contact_form_name_ar' => 'الاسم الكامل',
            'contact_form_name_en' => 'Full Name',
            'contact_form_email_ar' => 'البريد الإلكتروني',
            'contact_form_email_en' => 'Email Address',
            'contact_form_subject_ar' => 'الموضوع',
            'contact_form_subject_en' => 'Subject',
            'contact_form_message_ar' => 'الرسالة',
            'contact_form_message_en' => 'Message',
            'contact_form_send_ar' => 'إرسال الرسالة',
            'contact_form_send_en' => 'Send Message',
        ];
        
        // Investment application texts
        $investmentTexts = [
            'investment_page_title_ar' => 'طلب استثمار',
            'investment_page_title_en' => 'Investment Application',
            'investment_page_subtitle_ar' => 'ابدأ رحلتك الاستثمارية معنا من خلال تعبئة النموذج أدناه بعناية',
            'investment_page_subtitle_en' => 'Start your investment journey with us by carefully filling out the form below',
            'investment_instructions_title_ar' => 'تعليمات مهمة',
            'investment_instructions_title_en' => 'Important Instructions',
            'investment_share_info_title_ar' => 'معلومات السهم',
            'investment_share_info_title_en' => 'Share Information',
            'investment_support_title_ar' => 'الدعم',
            'investment_support_title_en' => 'Support',
        ];
        
        // Combine all texts
        $allTexts = array_merge($homepageTexts, $aboutTexts, $contactTexts, $investmentTexts);
        
        // Insert all settings
        foreach ($allTexts as $key => $value) {
            SiteSetting::set($key, $value, 'text', 'content', null, true);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Remove all added settings
        $keys = [
            // Homepage
            'hero_title_ar', 'hero_title_en', 'hero_button_start_ar', 'hero_button_start_en',
            'hero_button_learn_ar', 'hero_button_learn_en', 'hero_share_price_title_ar', 'hero_share_price_title_en',
            'stats_title_ar', 'stats_title_en', 'stats_subtitle_ar', 'stats_subtitle_en',
            'company_overview_title_ar', 'company_overview_title_en',
            'faq_title_ar', 'faq_title_en', 'faq_subtitle_ar', 'faq_subtitle_en',
            'news_title_ar', 'news_title_en', 'board_title_ar', 'board_title_en',
            'cta_title_ar', 'cta_title_en', 'cta_subtitle_ar', 'cta_subtitle_en',
            
            // About page
            'about_page_title_ar', 'about_page_title_en', 'about_who_we_are_ar', 'about_who_we_are_en',
            
            // Contact page
            'contact_page_title_ar', 'contact_page_title_en', 'contact_page_subtitle_ar', 'contact_page_subtitle_en',
            'contact_phone_title_ar', 'contact_phone_title_en', 'contact_email_title_ar', 'contact_email_title_en',
            
            // Investment page
            'investment_page_title_ar', 'investment_page_title_en', 'investment_page_subtitle_ar', 'investment_page_subtitle_en',
        ];
        
        foreach ($keys as $key) {
            SiteSetting::where('key', $key)->delete();
        }
    }
};

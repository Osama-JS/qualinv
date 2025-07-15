<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ContentSection;

class ContentSectionTestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $sections = [
            [
                'title_ar' => 'قسم الترحيب',
                'title_en' => 'Welcome Section',
                'content_ar' => '<h2>مرحباً بكم في شركة الجودة للاستثمار</h2><p>نحن نقدم أفضل الحلول الاستثمارية لعملائنا الكرام.</p>',
                'content_en' => '<h2>Welcome to Quality Investment Company</h2><p>We provide the best investment solutions for our valued clients.</p>',
                'page_location' => 'home',
                'display_order' => 1,
                'is_active' => true,
            ],
            [
                'title_ar' => 'خدماتنا المميزة',
                'title_en' => 'Our Premium Services',
                'content_ar' => '<h3>خدمات استثمارية متنوعة</h3><ul><li>إدارة المحافظ الاستثمارية</li><li>الاستشارات المالية</li><li>التخطيط المالي</li></ul>',
                'content_en' => '<h3>Diverse Investment Services</h3><ul><li>Investment Portfolio Management</li><li>Financial Consulting</li><li>Financial Planning</li></ul>',
                'page_location' => 'home',
                'display_order' => 2,
                'is_active' => true,
            ],
            [
                'title_ar' => 'عن الشركة',
                'title_en' => 'About Company',
                'content_ar' => '<p>شركة الجودة للاستثمار هي شركة رائدة في مجال الاستثمار والخدمات المالية.</p>',
                'content_en' => '<p>Quality Investment Company is a leading company in investment and financial services.</p>',
                'page_location' => 'about',
                'display_order' => 1,
                'is_active' => false,
            ],
            [
                'title_ar' => 'اتصل بنا',
                'title_en' => 'Contact Us',
                'content_ar' => '<p>نحن هنا لخدمتكم على مدار الساعة. تواصلوا معنا في أي وقت.</p>',
                'content_en' => '<p>We are here to serve you 24/7. Contact us anytime.</p>',
                'page_location' => 'contact',
                'display_order' => 1,
                'is_active' => true,
            ],
        ];

        foreach ($sections as $section) {
            ContentSection::create($section);
        }
    }
}

<?php

namespace Database\Seeders;

use App\Models\Page;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create sample pages for testing
        $pages = [
            [
                'name' => ['en' => 'Privacy Policy', 'ar' => 'سياسة الخصوصية'],
                'position' => 'footer',
                'description' => ['en' => 'Our privacy policy and data protection guidelines', 'ar' => 'سياسة الخصوصية وإرشادات حماية البيانات'],
                'html_content' => '<div class="space-y-6">
                    <h1 class="text-3xl font-bold text-gray-900 dark:text-gray-100">Privacy Policy</h1>
                    <p class="text-lg text-gray-700 dark:text-gray-300">This privacy policy explains how we collect, use, and protect your personal information.</p>
                    <h2 class="text-2xl font-semibold text-gray-900 dark:text-gray-100">Information We Collect</h2>
                    <p class="text-gray-700 dark:text-gray-300">We collect information you provide directly to us, such as when you create an account, make an investment application, or contact us.</p>
                    <h2 class="text-2xl font-semibold text-gray-900 dark:text-gray-100">How We Use Your Information</h2>
                    <p class="text-gray-700 dark:text-gray-300">We use the information we collect to provide, maintain, and improve our services, process transactions, and communicate with you.</p>
                </div>',
                'css_styling' => '.privacy-content { max-width: 800px; margin: 0 auto; }',
                'status' => 'active',
                'sort_order' => 1,
                'meta_title' => ['en' => 'Privacy Policy - Quality Investment', 'ar' => 'سياسة الخصوصية - الجودة للاستثمار'],
                'meta_description' => ['en' => 'Learn about our privacy policy and how we protect your personal information.', 'ar' => 'تعرف على سياسة الخصوصية وكيف نحمي معلوماتك الشخصية.'],
            ],
            [
                'name' => ['en' => 'Terms of Service', 'ar' => 'شروط الخدمة'],
                'position' => 'footer',
                'description' => ['en' => 'Terms and conditions for using our services', 'ar' => 'الشروط والأحكام لاستخدام خدماتنا'],
                'html_content' => '<div class="space-y-6">
                    <h1 class="text-3xl font-bold text-gray-900 dark:text-gray-100">Terms of Service</h1>
                    <p class="text-lg text-gray-700 dark:text-gray-300">These terms govern your use of our investment services and platform.</p>
                    <h2 class="text-2xl font-semibold text-gray-900 dark:text-gray-100">Acceptance of Terms</h2>
                    <p class="text-gray-700 dark:text-gray-300">By accessing and using our services, you accept and agree to be bound by the terms and provision of this agreement.</p>
                    <h2 class="text-2xl font-semibold text-gray-900 dark:text-gray-100">Investment Risks</h2>
                    <p class="text-gray-700 dark:text-gray-300">All investments carry risk, and past performance does not guarantee future results. Please read our risk disclosure carefully.</p>
                </div>',
                'status' => 'active',
                'sort_order' => 2,
                'meta_title' => ['en' => 'Terms of Service - Quality Investment', 'ar' => 'شروط الخدمة - الجودة للاستثمار'],
                'meta_description' => ['en' => 'Read our terms of service and conditions for using our investment platform.', 'ar' => 'اقرأ شروط الخدمة والأحكام لاستخدام منصة الاستثمار.'],
            ],
            [
                'name' => ['en' => 'Investment Guide', 'ar' => 'دليل الاستثمار'],
                'position' => 'navbar',
                'description' => ['en' => 'Complete guide to investment opportunities', 'ar' => 'دليل شامل لفرص الاستثمار'],
                'html_content' => '<div class="space-y-8">
                    <div class="text-center">
                        <h1 class="text-4xl font-bold text-gray-900 dark:text-gray-100 mb-4">Investment Guide</h1>
                        <p class="text-xl text-gray-700 dark:text-gray-300">Your comprehensive guide to smart investing</p>
                    </div>

                    <div class="grid md:grid-cols-2 gap-8">
                        <div class="bg-blue-50 dark:bg-blue-900/20 p-6 rounded-lg">
                            <h2 class="text-2xl font-semibold text-blue-900 dark:text-blue-100 mb-4">Getting Started</h2>
                            <ul class="space-y-2 text-gray-700 dark:text-gray-300">
                                <li>• Understand your risk tolerance</li>
                                <li>• Set clear investment goals</li>
                                <li>• Diversify your portfolio</li>
                                <li>• Start with small amounts</li>
                            </ul>
                        </div>

                        <div class="bg-green-50 dark:bg-green-900/20 p-6 rounded-lg">
                            <h2 class="text-2xl font-semibold text-green-900 dark:text-green-100 mb-4">Investment Types</h2>
                            <ul class="space-y-2 text-gray-700 dark:text-gray-300">
                                <li>• Equity investments</li>
                                <li>• Fixed income securities</li>
                                <li>• Real estate investments</li>
                                <li>• Alternative investments</li>
                            </ul>
                        </div>
                    </div>

                    <div class="bg-yellow-50 dark:bg-yellow-900/20 p-6 rounded-lg">
                        <h2 class="text-2xl font-semibold text-yellow-900 dark:text-yellow-100 mb-4">Important Considerations</h2>
                        <p class="text-gray-700 dark:text-gray-300">Always consult with our financial advisors before making investment decisions. Past performance does not guarantee future results.</p>
                    </div>
                </div>',
                'css_styling' => '.investment-guide { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); }',
                'status' => 'active',
                'sort_order' => 1,
                'meta_title' => ['en' => 'Investment Guide - Quality Investment', 'ar' => 'دليل الاستثمار - الجودة للاستثمار'],
                'meta_description' => ['en' => 'Learn how to invest wisely with our comprehensive investment guide.', 'ar' => 'تعلم كيفية الاستثمار بحكمة مع دليل الاستثمار الشامل.'],
            ],
        ];

        foreach ($pages as $pageData) {
            Page::create($pageData);
        }
    }
}

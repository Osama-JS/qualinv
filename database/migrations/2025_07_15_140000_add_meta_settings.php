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
        // Add meta settings
        $settings = [
            // Meta Tags
            'meta_title_ar' => [
                'value' => 'شركة الجودة للاستثمار - استثمر في مستقبلك',
                'type' => 'text',
                'group' => 'seo',
                'description' => 'Meta title in Arabic',
                'is_public' => true
            ],
            'meta_title_en' => [
                'value' => 'Quality Investment Company - Invest in Your Future',
                'type' => 'text',
                'group' => 'seo',
                'description' => 'Meta title in English',
                'is_public' => true
            ],
            'meta_description_ar' => [
                'value' => 'شركة الجودة للاستثمار - شريكك الموثوق في عالم الاستثمار. نقدم حلول استثمارية متنوعة وآمنة لتحقيق أهدافك المالية.',
                'type' => 'textarea',
                'group' => 'seo',
                'description' => 'Meta description in Arabic',
                'is_public' => true
            ],
            'meta_description_en' => [
                'value' => 'Quality Investment Company - Your trusted partner in the world of investment. We offer diverse and secure investment solutions to achieve your financial goals.',
                'type' => 'textarea',
                'group' => 'seo',
                'description' => 'Meta description in English',
                'is_public' => true
            ],
            'meta_keywords_ar' => [
                'value' => 'استثمار، شركة استثمار، أسهم، عوائد، مالية، السعودية، جودة',
                'type' => 'text',
                'group' => 'seo',
                'description' => 'Meta keywords in Arabic',
                'is_public' => true
            ],
            'meta_keywords_en' => [
                'value' => 'investment, investment company, shares, returns, finance, saudi arabia, quality',
                'type' => 'text',
                'group' => 'seo',
                'description' => 'Meta keywords in English',
                'is_public' => true
            ],
        ];

        foreach ($settings as $key => $config) {
            SiteSetting::updateOrCreate(
                ['key' => $key],
                [
                    'value' => $config['value'],
                    'type' => $config['type'],
                    'group' => $config['group'],
                    'description' => $config['description'],
                    'is_public' => $config['is_public']
                ]
            );
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        $keys = [
            'meta_title_ar',
            'meta_title_en',
            'meta_description_ar',
            'meta_description_en',
            'meta_keywords_ar',
            'meta_keywords_en',
        ];

        SiteSetting::whereIn('key', $keys)->delete();
    }
};

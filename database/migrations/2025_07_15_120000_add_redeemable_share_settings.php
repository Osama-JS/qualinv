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
        // Add redeemable share settings
        $settings = [
            // Redeemable Share Settings
            'redeemable_share_price' => [
                'value' => '150.00',
                'type' => 'number',
                'group' => 'general',
                'description' => 'Price of redeemable share',
                'is_public' => true
            ],
            'redeemable_share_currency' => [
                'value' => 'SAR',
                'type' => 'text',
                'group' => 'general',
                'description' => 'Currency for redeemable share',
                'is_public' => true
            ],
            
            // Hero Section - Redeemable Share Texts
            'hero_redeemable_share_title_ar' => [
                'value' => 'سعر السهم المسترد',
                'type' => 'text',
                'group' => 'content',
                'description' => 'Redeemable share title in Arabic for hero section',
                'is_public' => true
            ],
            'hero_redeemable_share_title_en' => [
                'value' => 'Redeemable Share Price',
                'type' => 'text',
                'group' => 'content',
                'description' => 'Redeemable share title in English for hero section',
                'is_public' => true
            ],
            
            // Regular Share Texts (rename existing)
            'hero_regular_share_title_ar' => [
                'value' => 'سعر السهم العادي',
                'type' => 'text',
                'group' => 'content',
                'description' => 'Regular share title in Arabic for hero section',
                'is_public' => true
            ],
            'hero_regular_share_title_en' => [
                'value' => 'Regular Share Price',
                'type' => 'text',
                'group' => 'content',
                'description' => 'Regular share title in English for hero section',
                'is_public' => true
            ],
            
            // Investment Application Page - Share Type Texts
            'investment_share_type_title_ar' => [
                'value' => 'نوع السهم',
                'type' => 'text',
                'group' => 'content',
                'description' => 'Share type selection title in Arabic',
                'is_public' => true
            ],
            'investment_share_type_title_en' => [
                'value' => 'Share Type',
                'type' => 'text',
                'group' => 'content',
                'description' => 'Share type selection title in English',
                'is_public' => true
            ],
            'investment_regular_share_label_ar' => [
                'value' => 'السهم العادي',
                'type' => 'text',
                'group' => 'content',
                'description' => 'Regular share label in Arabic',
                'is_public' => true
            ],
            'investment_regular_share_label_en' => [
                'value' => 'Regular Share',
                'type' => 'text',
                'group' => 'content',
                'description' => 'Regular share label in English',
                'is_public' => true
            ],
            'investment_redeemable_share_label_ar' => [
                'value' => 'السهم المسترد',
                'type' => 'text',
                'group' => 'content',
                'description' => 'Redeemable share label in Arabic',
                'is_public' => true
            ],
            'investment_redeemable_share_label_en' => [
                'value' => 'Redeemable Share',
                'type' => 'text',
                'group' => 'content',
                'description' => 'Redeemable share label in English',
                'is_public' => true
            ],
            'investment_regular_share_desc_ar' => [
                'value' => 'سهم عادي بعائد ثابت وحقوق تصويت',
                'type' => 'text',
                'group' => 'content',
                'description' => 'Regular share description in Arabic',
                'is_public' => true
            ],
            'investment_regular_share_desc_en' => [
                'value' => 'Regular share with fixed return and voting rights',
                'type' => 'text',
                'group' => 'content',
                'description' => 'Regular share description in English',
                'is_public' => true
            ],
            'investment_redeemable_share_desc_ar' => [
                'value' => 'سهم قابل للاسترداد بعائد متغير',
                'type' => 'text',
                'group' => 'content',
                'description' => 'Redeemable share description in Arabic',
                'is_public' => true
            ],
            'investment_redeemable_share_desc_en' => [
                'value' => 'Redeemable share with variable return',
                'type' => 'text',
                'group' => 'content',
                'description' => 'Redeemable share description in English',
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
            'redeemable_share_price',
            'redeemable_share_currency',
            'hero_redeemable_share_title_ar',
            'hero_redeemable_share_title_en',
            'hero_regular_share_title_ar',
            'hero_regular_share_title_en',
            'investment_share_type_title_ar',
            'investment_share_type_title_en',
            'investment_regular_share_label_ar',
            'investment_regular_share_label_en',
            'investment_redeemable_share_label_ar',
            'investment_redeemable_share_label_en',
            'investment_regular_share_desc_ar',
            'investment_regular_share_desc_en',
            'investment_redeemable_share_desc_ar',
            'investment_redeemable_share_desc_en',
        ];

        SiteSetting::whereIn('key', $keys)->delete();
    }
};

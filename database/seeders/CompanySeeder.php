<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Company;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Company::create([
            'name' => [
                'en' => 'Quality Investment Company',
                'ar' => 'شركة جودة الإستثمار'
            ],
            'about' => [
                'en' => 'Quality Investment Company is a leading investment firm dedicated to providing exceptional financial services and investment opportunities. We specialize in strategic investments, portfolio management, and financial consulting.',
                'ar' => 'شركة جودة الإستثمار هي شركة استثمار رائدة مكرسة لتقديم خدمات مالية استثنائية وفرص استثمارية. نحن متخصصون في الاستثمارات الاستراتيجية وإدارة المحافظ والاستشارات المالية.'
            ],
            'mission' => [
                'en' => 'To provide innovative investment solutions that create sustainable value for our clients while maintaining the highest standards of integrity and professionalism.',
                'ar' => 'تقديم حلول استثمارية مبتكرة تخلق قيمة مستدامة لعملائنا مع الحفاظ على أعلى معايير النزاهة والمهنية.'
            ],
            'vision' => [
                'en' => 'To be the most trusted and respected investment partner in the region, known for our expertise, innovation, and commitment to client success.',
                'ar' => 'أن نكون الشريك الاستثماري الأكثر ثقة واحتراماً في المنطقة، المعروف بخبرتنا وابتكارنا والتزامنا بنجاح العملاء.'
            ],
            'values' => [
                'en' => 'Integrity, Excellence, Innovation, Client Focus, Transparency, and Sustainable Growth.',
                'ar' => 'النزاهة، التميز، الابتكار، التركيز على العميل، الشفافية، والنمو المستدام.'
            ],
            'email' => 'info@qualityinvestment.com',
            'phone' => '+966 11 123 4567',
            'address' => 'Riyadh, Saudi Arabia',
            'website' => 'https://www.qualityinvestment.com',
            'social_media' => [
                'linkedin' => 'https://linkedin.com/company/quality-investment',
                'twitter' => 'https://twitter.com/quality_invest',
                'facebook' => 'https://facebook.com/qualityinvestment'
            ],
            'is_active' => true,
        ]);
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Company;
use App\Models\BoardDirector;
use App\Models\Article;
use App\Models\SiteSetting;
use Illuminate\Support\Facades\Storage;

class DemoDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Company Information
        $this->seedCompanyInfo();
        
        // Site Settings
        $this->seedSiteSettings();
        
        // Board Directors
        $this->seedBoardDirectors();
        
        // Articles
        $this->seedArticles();
    }

    private function seedCompanyInfo()
    {
        $company = Company::first();
        if (!$company) {
            $company = new Company();
        }

        $company->update([
            'name' => [
                'en' => 'Quality Investment Company',
                'ar' => 'شركة الجودة للاستثمار'
            ],
            'about' => [
                'en' => '<p>Quality Investment Company is a leading investment firm in Saudi Arabia, established to provide comprehensive investment solutions and financial services. With over 15 years of experience in the market, we have built a reputation for excellence, integrity, and innovation.</p><p>Our company specializes in various investment sectors including real estate, technology, healthcare, and energy. We are committed to delivering sustainable returns while maintaining the highest standards of corporate governance and risk management.</p>',
                'ar' => '<p>شركة الجودة للاستثمار هي شركة استثمار رائدة في المملكة العربية السعودية، تأسست لتقديم حلول استثمارية شاملة وخدمات مالية متميزة. مع أكثر من 15 عاماً من الخبرة في السوق، بنينا سمعة طيبة في التميز والنزاهة والابتكار.</p><p>تتخصص شركتنا في قطاعات استثمارية متنوعة تشمل العقارات والتكنولوجيا والرعاية الصحية والطاقة. نحن ملتزمون بتحقيق عائدات مستدامة مع الحفاظ على أعلى معايير الحوكمة المؤسسية وإدارة المخاطر.</p>'
            ],
            'mission' => [
                'en' => '<p>To provide innovative investment solutions that create sustainable value for our clients while contributing to the economic development of Saudi Arabia and the region.</p>',
                'ar' => '<p>تقديم حلول استثمارية مبتكرة تخلق قيمة مستدامة لعملائنا مع المساهمة في التنمية الاقتصادية للمملكة العربية السعودية والمنطقة.</p>'
            ],
            'vision' => [
                'en' => '<p>To be the most trusted and innovative investment company in the Middle East, recognized for our excellence in delivering superior returns and exceptional client service.</p>',
                'ar' => '<p>أن نكون شركة الاستثمار الأكثر ثقة وابتكاراً في الشرق الأوسط، معترف بها لتميزنا في تحقيق عائدات متفوقة وخدمة عملاء استثنائية.</p>'
            ],
            'values' => [
                'en' => '<ul><li><strong>Integrity:</strong> We conduct business with the highest ethical standards</li><li><strong>Excellence:</strong> We strive for excellence in everything we do</li><li><strong>Innovation:</strong> We embrace innovation and continuous improvement</li><li><strong>Transparency:</strong> We maintain transparency in all our dealings</li><li><strong>Client Focus:</strong> Our clients\' success is our success</li></ul>',
                'ar' => '<ul><li><strong>النزاهة:</strong> نمارس أعمالنا بأعلى المعايير الأخلاقية</li><li><strong>التميز:</strong> نسعى للتميز في كل ما نقوم به</li><li><strong>الابتكار:</strong> نتبنى الابتكار والتحسين المستمر</li><li><strong>الشفافية:</strong> نحافظ على الشفافية في جميع تعاملاتنا</li><li><strong>التركيز على العميل:</strong> نجاح عملائنا هو نجاحنا</li></ul>'
            ],
            'email' => 'info@qualityinvestment.com',
            'phone' => '+966 11 123 4567',
            'website' => 'https://qualityinvestment.com',
            'address' => 'King Fahd Road, Riyadh 12345, Saudi Arabia'
        ]);
    }

    private function seedSiteSettings()
    {
        $settings = [
            'site_name_en' => 'Quality Investment',
            'site_name_ar' => 'الجودة للاستثمار',
            'share_price' => '125.50',
            'currency' => 'SAR',
            'maintenance_mode' => false,
            'maintenance_message_en' => 'We are currently performing scheduled maintenance. Please check back soon.',
            'maintenance_message_ar' => 'نقوم حالياً بأعمال صيانة مجدولة. يرجى المراجعة قريباً.',
            'meta_title_en' => 'Quality Investment Company - Leading Investment Solutions in Saudi Arabia',
            'meta_title_ar' => 'شركة الجودة للاستثمار - حلول استثمارية رائدة في المملكة العربية السعودية',
            'meta_description_en' => 'Quality Investment Company provides comprehensive investment solutions and financial services in Saudi Arabia with over 15 years of market experience.',
            'meta_description_ar' => 'شركة الجودة للاستثمار تقدم حلول استثمارية شاملة وخدمات مالية في المملكة العربية السعودية مع أكثر من 15 عاماً من الخبرة.',
            'meta_keywords_en' => 'investment, finance, Saudi Arabia, quality investment, financial services',
            'meta_keywords_ar' => 'استثمار، تمويل، السعودية، الجودة للاستثمار، خدمات مالية',
            'facebook_url' => 'https://facebook.com/qualityinvestment',
            'twitter_url' => 'https://twitter.com/qualityinvest',
            'linkedin_url' => 'https://linkedin.com/company/quality-investment',
            'instagram_url' => 'https://instagram.com/qualityinvestment',
            'youtube_url' => 'https://youtube.com/qualityinvestment'
        ];

        foreach ($settings as $key => $value) {
            SiteSetting::set($key, $value);
        }
    }

    private function seedBoardDirectors()
    {
        $directors = [
            [
                'name' => ['en' => 'Ahmed Al-Rashid', 'ar' => 'أحمد الراشد'],
                'position' => ['en' => 'Chairman of the Board', 'ar' => 'رئيس مجلس الإدارة'],
                'bio' => [
                    'en' => '<p>Ahmed Al-Rashid brings over 25 years of experience in investment banking and corporate finance. He holds an MBA from Harvard Business School and has led numerous successful investment initiatives across the Middle East.</p>',
                    'ar' => '<p>يتمتع أحمد الراشد بخبرة تزيد عن 25 عاماً في الخدمات المصرفية الاستثمارية والتمويل المؤسسي. حاصل على ماجستير إدارة الأعمال من كلية هارفارد للأعمال وقاد العديد من المبادرات الاستثمارية الناجحة في الشرق الأوسط.</p>'
                ],
                'email' => 'ahmed.alrashid@qualityinvestment.com',
                'phone' => '+966 11 123 4501',
                'sort_order' => 1,
                'is_active' => true
            ],
            [
                'name' => ['en' => 'Sarah Al-Mahmoud', 'ar' => 'سارة المحمود'],
                'position' => ['en' => 'Vice Chairman', 'ar' => 'نائب رئيس مجلس الإدارة'],
                'bio' => [
                    'en' => '<p>Sarah Al-Mahmoud is a renowned expert in financial markets with 20 years of experience. She previously served as Managing Director at several leading investment firms and holds a PhD in Economics.</p>',
                    'ar' => '<p>سارة المحمود خبيرة مشهورة في الأسواق المالية مع 20 عاماً من الخبرة. شغلت سابقاً منصب المدير العام في عدة شركات استثمار رائدة وحاصلة على دكتوراه في الاقتصاد.</p>'
                ],
                'email' => 'sarah.almahmoud@qualityinvestment.com',
                'phone' => '+966 11 123 4502',
                'sort_order' => 2,
                'is_active' => true
            ],
            [
                'name' => ['en' => 'Mohammed Al-Fahad', 'ar' => 'محمد الفهد'],
                'position' => ['en' => 'Chief Executive Officer', 'ar' => 'الرئيس التنفيذي'],
                'bio' => [
                    'en' => '<p>Mohammed Al-Fahad has been leading Quality Investment Company as CEO for the past 8 years. Under his leadership, the company has achieved remarkable growth and expansion across multiple sectors.</p>',
                    'ar' => '<p>يقود محمد الفهد شركة الجودة للاستثمار كرئيس تنفيذي منذ 8 سنوات. تحت قيادته، حققت الشركة نمواً وتوسعاً ملحوظاً عبر قطاعات متعددة.</p>'
                ],
                'email' => 'mohammed.alfahad@qualityinvestment.com',
                'phone' => '+966 11 123 4503',
                'sort_order' => 3,
                'is_active' => true
            ],
            [
                'name' => ['en' => 'Fatima Al-Zahra', 'ar' => 'فاطمة الزهراء'],
                'position' => ['en' => 'Chief Financial Officer', 'ar' => 'المدير المالي'],
                'bio' => [
                    'en' => '<p>Fatima Al-Zahra is a certified public accountant with extensive experience in financial management and risk assessment. She has been instrumental in maintaining the company\'s strong financial position.</p>',
                    'ar' => '<p>فاطمة الزهراء محاسبة قانونية معتمدة مع خبرة واسعة في الإدارة المالية وتقييم المخاطر. لعبت دوراً مهماً في الحفاظ على المركز المالي القوي للشركة.</p>'
                ],
                'email' => 'fatima.alzahra@qualityinvestment.com',
                'phone' => '+966 11 123 4504',
                'sort_order' => 4,
                'is_active' => true
            ],
            [
                'name' => ['en' => 'Omar Al-Saud', 'ar' => 'عمر السعود'],
                'position' => ['en' => 'Independent Director', 'ar' => 'عضو مجلس إدارة مستقل'],
                'bio' => [
                    'en' => '<p>Omar Al-Saud brings valuable independent perspective to the board with his background in corporate governance and regulatory compliance. He serves on several other boards in the region.</p>',
                    'ar' => '<p>يجلب عمر السعود منظوراً مستقلاً قيماً لمجلس الإدارة بخلفيته في الحوكمة المؤسسية والامتثال التنظيمي. يشغل عضوية في عدة مجالس إدارة أخرى في المنطقة.</p>'
                ],
                'email' => 'omar.alsaud@qualityinvestment.com',
                'phone' => '+966 11 123 4505',
                'sort_order' => 5,
                'is_active' => true
            ]
        ];

        foreach ($directors as $directorData) {
            BoardDirector::create($directorData);
        }
    }

    private function seedArticles()
    {
        $articles = [
            [
                'title' => [
                    'en' => 'Quality Investment Company Announces Record Q3 2024 Results',
                    'ar' => 'شركة الجودة للاستثمار تعلن عن نتائج قياسية للربع الثالث 2024'
                ],
                'excerpt' => [
                    'en' => 'The company reported a 25% increase in revenue and expanded its portfolio across multiple sectors, demonstrating strong performance in challenging market conditions.',
                    'ar' => 'أعلنت الشركة عن زيادة 25% في الإيرادات وتوسيع محفظتها عبر قطاعات متعددة، مما يظهر أداءً قوياً في ظروف السوق الصعبة.'
                ],
                'content' => [
                    'en' => '<p>Quality Investment Company today announced its financial results for the third quarter of 2024, reporting record-breaking performance across all key metrics. The company achieved a 25% year-over-year increase in revenue, reaching SAR 450 million.</p><p>CEO Mohammed Al-Fahad commented: "These exceptional results reflect our strategic focus on diversification and our commitment to delivering value to our shareholders. Despite global economic uncertainties, we have maintained our growth trajectory through careful portfolio management and strategic investments."</p><p>Key highlights include:</p><ul><li>Revenue growth of 25% to SAR 450 million</li><li>Net profit increase of 30% to SAR 135 million</li><li>Successful completion of three major acquisitions</li><li>Expansion into renewable energy sector</li></ul>',
                    'ar' => '<p>أعلنت شركة الجودة للاستثمار اليوم عن نتائجها المالية للربع الثالث من عام 2024، مسجلة أداءً قياسياً عبر جميع المؤشرات الرئيسية. حققت الشركة زيادة 25% في الإيرادات مقارنة بالعام السابق، لتصل إلى 450 مليون ريال سعودي.</p><p>علق الرئيس التنفيذي محمد الفهد قائلاً: "تعكس هذه النتائج الاستثنائية تركيزنا الاستراتيجي على التنويع والتزامنا بتقديم القيمة لمساهمينا. رغم الشكوك الاقتصادية العالمية، حافظنا على مسار نمونا من خلال الإدارة الحذرة للمحفظة والاستثمارات الاستراتيجية."</p><p>تشمل النقاط البارزة:</p><ul><li>نمو الإيرادات بنسبة 25% إلى 450 مليون ريال سعودي</li><li>زيادة صافي الربح بنسبة 30% إلى 135 مليون ريال سعودي</li><li>إتمام ثلاث عمليات استحواذ كبرى بنجاح</li><li>التوسع في قطاع الطاقة المتجددة</li></ul>'
                ],
                'category' => 'news',
                'status' => 'published',
                'is_featured' => true,
                'published_at' => now()->subDays(2),
                'views_count' => 1250,
                'author_id' => 1
            ],
            [
                'title' => [
                    'en' => 'New Strategic Partnership with Leading Technology Firm',
                    'ar' => 'شراكة استراتيجية جديدة مع شركة تكنولوجيا رائدة'
                ],
                'excerpt' => [
                    'en' => 'Quality Investment Company enters into a strategic partnership to accelerate digital transformation and innovation in the financial services sector.',
                    'ar' => 'تدخل شركة الجودة للاستثمار في شراكة استراتيجية لتسريع التحول الرقمي والابتكار في قطاع الخدمات المالية.'
                ],
                'content' => [
                    'en' => '<p>Quality Investment Company announced today a strategic partnership with TechInnovate Solutions, a leading technology firm specializing in financial technology solutions. This partnership aims to accelerate digital transformation initiatives and enhance the company\'s technological capabilities.</p><p>The collaboration will focus on developing cutting-edge fintech solutions, improving customer experience through digital platforms, and implementing advanced analytics for better investment decision-making.</p>',
                    'ar' => '<p>أعلنت شركة الجودة للاستثمار اليوم عن شراكة استراتيجية مع شركة تك إنوفيت سوليوشنز، وهي شركة تكنولوجيا رائدة متخصصة في حلول التكنولوجيا المالية. تهدف هذه الشراكة إلى تسريع مبادرات التحول الرقمي وتعزيز القدرات التكنولوجية للشركة.</p><p>سيركز التعاون على تطوير حلول تكنولوجيا مالية متطورة، وتحسين تجربة العملاء من خلال المنصات الرقمية، وتنفيذ تحليلات متقدمة لاتخاذ قرارات استثمارية أفضل.</p>'
                ],
                'category' => 'announcements',
                'status' => 'published',
                'is_featured' => false,
                'published_at' => now()->subDays(5),
                'views_count' => 890,
                'author_id' => 1
            ]
        ];

        foreach ($articles as $articleData) {
            Article::create($articleData);
        }
    }
}

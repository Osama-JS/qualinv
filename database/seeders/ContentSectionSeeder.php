<?php

namespace Database\Seeders;

use App\Models\ContentSection;
use Illuminate\Database\Seeder;

class ContentSectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Home page sections
        ContentSection::create([
            'title_ar' => 'لماذا الاستثمار معنا؟',
            'title_en' => 'Why Invest With Us?',
            'content_ar' => '<div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="bg-white p-6 rounded-xl shadow-md hover:shadow-lg transition-all duration-300 border border-gray-100">
                    <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mb-4">
                        <i class="fas fa-shield-alt text-2xl text-green-600"></i>
                    </div>
                    <h3 class="text-xl font-bold mb-3">الأمان والموثوقية</h3>
                    <p class="text-gray-600">نحن نضع أمان استثماراتك في المقام الأول، مع فريق من الخبراء المتخصصين في إدارة المخاطر.</p>
                </div>
                <div class="bg-white p-6 rounded-xl shadow-md hover:shadow-lg transition-all duration-300 border border-gray-100">
                    <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center mb-4">
                        <i class="fas fa-chart-line text-2xl text-blue-600"></i>
                    </div>
                    <h3 class="text-xl font-bold mb-3">عوائد مجزية</h3>
                    <p class="text-gray-600">نسعى دائماً لتحقيق أفضل العوائد الاستثمارية لعملائنا من خلال استراتيجيات استثمارية مدروسة.</p>
                </div>
                <div class="bg-white p-6 rounded-xl shadow-md hover:shadow-lg transition-all duration-300 border border-gray-100">
                    <div class="w-16 h-16 bg-purple-100 rounded-full flex items-center justify-center mb-4">
                        <i class="fas fa-user-tie text-2xl text-purple-600"></i>
                    </div>
                    <h3 class="text-xl font-bold mb-3">خبرة متميزة</h3>
                    <p class="text-gray-600">يتمتع فريقنا بخبرة واسعة في مجال الاستثمار والأسواق المالية تمتد لأكثر من 15 عاماً.</p>
                </div>
            </div>',
            'content_en' => '<div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="bg-white p-6 rounded-xl shadow-md hover:shadow-lg transition-all duration-300 border border-gray-100">
                    <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mb-4">
                        <i class="fas fa-shield-alt text-2xl text-green-600"></i>
                    </div>
                    <h3 class="text-xl font-bold mb-3">Security & Reliability</h3>
                    <p class="text-gray-600">We put the security of your investments first, with a team of experts specialized in risk management.</p>
                </div>
                <div class="bg-white p-6 rounded-xl shadow-md hover:shadow-lg transition-all duration-300 border border-gray-100">
                    <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center mb-4">
                        <i class="fas fa-chart-line text-2xl text-blue-600"></i>
                    </div>
                    <h3 class="text-xl font-bold mb-3">Rewarding Returns</h3>
                    <p class="text-gray-600">We always strive to achieve the best investment returns for our clients through well-studied investment strategies.</p>
                </div>
                <div class="bg-white p-6 rounded-xl shadow-md hover:shadow-lg transition-all duration-300 border border-gray-100">
                    <div class="w-16 h-16 bg-purple-100 rounded-full flex items-center justify-center mb-4">
                        <i class="fas fa-user-tie text-2xl text-purple-600"></i>
                    </div>
                    <h3 class="text-xl font-bold mb-3">Distinguished Expertise</h3>
                    <p class="text-gray-600">Our team has extensive experience in investment and financial markets extending for more than 15 years.</p>
                </div>
            </div>',
            'page_location' => ContentSection::PAGE_HOME,
            'display_order' => 1,
            'is_active' => true,
        ]);

        // About page sections
        ContentSection::create([
            'title_ar' => 'قيمنا الأساسية',
            'title_en' => 'Our Core Values',
            'content_ar' => '<div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div class="bg-white p-6 rounded-xl shadow-md hover:shadow-lg transition-all duration-300 border border-gray-100">
                    <div class="flex items-center mb-4">
                        <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center mr-4">
                            <i class="fas fa-handshake text-xl text-green-600"></i>
                        </div>
                        <h3 class="text-xl font-bold">النزاهة والشفافية</h3>
                    </div>
                    <p class="text-gray-600">نؤمن بأهمية النزاهة والشفافية في جميع تعاملاتنا مع العملاء والشركاء، ونلتزم بأعلى معايير الأخلاق المهنية.</p>
                </div>
                <div class="bg-white p-6 rounded-xl shadow-md hover:shadow-lg transition-all duration-300 border border-gray-100">
                    <div class="flex items-center mb-4">
                        <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center mr-4">
                            <i class="fas fa-lightbulb text-xl text-blue-600"></i>
                        </div>
                        <h3 class="text-xl font-bold">الابتكار والتطوير</h3>
                    </div>
                    <p class="text-gray-600">نسعى دائماً للابتكار وتطوير حلولنا الاستثمارية لتلبية احتياجات عملائنا المتغيرة ومواكبة التطورات في عالم الاستثمار.</p>
                </div>
                <div class="bg-white p-6 rounded-xl shadow-md hover:shadow-lg transition-all duration-300 border border-gray-100">
                    <div class="flex items-center mb-4">
                        <div class="w-12 h-12 bg-purple-100 rounded-full flex items-center justify-center mr-4">
                            <i class="fas fa-users text-xl text-purple-600"></i>
                        </div>
                        <h3 class="text-xl font-bold">التركيز على العميل</h3>
                    </div>
                    <p class="text-gray-600">نضع عملاءنا في قلب كل ما نقوم به، ونعمل على فهم احتياجاتهم وتطلعاتهم لتقديم خدمات تفوق توقعاتهم.</p>
                </div>
                <div class="bg-white p-6 rounded-xl shadow-md hover:shadow-lg transition-all duration-300 border border-gray-100">
                    <div class="flex items-center mb-4">
                        <div class="w-12 h-12 bg-yellow-100 rounded-full flex items-center justify-center mr-4">
                            <i class="fas fa-award text-xl text-yellow-600"></i>
                        </div>
                        <h3 class="text-xl font-bold">التميز والجودة</h3>
                    </div>
                    <p class="text-gray-600">نسعى للتميز في كل ما نقدمه من خدمات ومنتجات استثمارية، ونلتزم بأعلى معايير الجودة في جميع عملياتنا.</p>
                </div>
            </div>',
            'content_en' => '<div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div class="bg-white p-6 rounded-xl shadow-md hover:shadow-lg transition-all duration-300 border border-gray-100">
                    <div class="flex items-center mb-4">
                        <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center mr-4">
                            <i class="fas fa-handshake text-xl text-green-600"></i>
                        </div>
                        <h3 class="text-xl font-bold">Integrity & Transparency</h3>
                    </div>
                    <p class="text-gray-600">We believe in the importance of integrity and transparency in all our dealings with clients and partners, and we adhere to the highest standards of professional ethics.</p>
                </div>
                <div class="bg-white p-6 rounded-xl shadow-md hover:shadow-lg transition-all duration-300 border border-gray-100">
                    <div class="flex items-center mb-4">
                        <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center mr-4">
                            <i class="fas fa-lightbulb text-xl text-blue-600"></i>
                        </div>
                        <h3 class="text-xl font-bold">Innovation & Development</h3>
                    </div>
                    <p class="text-gray-600">We always strive for innovation and development of our investment solutions to meet the changing needs of our clients and keep pace with developments in the world of investment.</p>
                </div>
                <div class="bg-white p-6 rounded-xl shadow-md hover:shadow-lg transition-all duration-300 border border-gray-100">
                    <div class="flex items-center mb-4">
                        <div class="w-12 h-12 bg-purple-100 rounded-full flex items-center justify-center mr-4">
                            <i class="fas fa-users text-xl text-purple-600"></i>
                        </div>
                        <h3 class="text-xl font-bold">Client Focus</h3>
                    </div>
                    <p class="text-gray-600">We put our clients at the heart of everything we do, and work to understand their needs and aspirations to provide services that exceed their expectations.</p>
                </div>
                <div class="bg-white p-6 rounded-xl shadow-md hover:shadow-lg transition-all duration-300 border border-gray-100">
                    <div class="flex items-center mb-4">
                        <div class="w-12 h-12 bg-yellow-100 rounded-full flex items-center justify-center mr-4">
                            <i class="fas fa-award text-xl text-yellow-600"></i>
                        </div>
                        <h3 class="text-xl font-bold">Excellence & Quality</h3>
                    </div>
                    <p class="text-gray-600">We strive for excellence in all the services and investment products we offer, and we adhere to the highest quality standards in all our operations.</p>
                </div>
            </div>',
            'page_location' => ContentSection::PAGE_ABOUT,
            'display_order' => 1,
            'is_active' => true,
        ]);

        // Board of Directors page sections
        ContentSection::create([
            'title_ar' => 'مسؤولياتنا',
            'title_en' => 'Our Responsibilities',
            'content_ar' => '<div class="bg-gray-50 p-8 rounded-xl border border-gray-200 mb-8">
                <h3 class="text-2xl font-bold mb-4 text-gray-800">مسؤوليات مجلس الإدارة</h3>
                <ul class="list-disc list-inside space-y-3 text-gray-700">
                    <li>وضع الاستراتيجية العامة للشركة وخطط العمل الرئيسية</li>
                    <li>الإشراف على تنفيذ الخطط الاستراتيجية والسياسات العامة</li>
                    <li>اعتماد الميزانيات السنوية والتقارير المالية</li>
                    <li>ضمان الالتزام بالقوانين واللوائح المعمول بها</li>
                    <li>حماية مصالح المساهمين والمستثمرين</li>
                    <li>تعيين ومراقبة أداء الإدارة التنفيذية</li>
                    <li>تقييم المخاطر وضمان وجود أنظمة فعالة لإدارتها</li>
                </ul>
            </div>',
            'content_en' => '<div class="bg-gray-50 p-8 rounded-xl border border-gray-200 mb-8">
                <h3 class="text-2xl font-bold mb-4 text-gray-800">Board of Directors Responsibilities</h3>
                <ul class="list-disc list-inside space-y-3 text-gray-700">
                    <li>Setting the company\'s general strategy and main business plans</li>
                    <li>Overseeing the implementation of strategic plans and general policies</li>
                    <li>Approving annual budgets and financial reports</li>
                    <li>Ensuring compliance with applicable laws and regulations</li>
                    <li>Protecting the interests of shareholders and investors</li>
                    <li>Appointing and monitoring the performance of executive management</li>
                    <li>Assessing risks and ensuring effective systems for their management</li>
                </ul>
            </div>',
            'page_location' => ContentSection::PAGE_BOARD_DIRECTORS,
            'display_order' => 1,
            'is_active' => true,
        ]);

        // Investment Application page sections
        ContentSection::create([
            'title_ar' => 'معلومات هامة',
            'title_en' => 'Important Information',
            'content_ar' => '<div class="bg-blue-50 p-6 rounded-xl border border-blue-100 mb-8">
                <h3 class="text-xl font-bold mb-4 text-blue-800">قبل تقديم طلب الاستثمار</h3>
                <ul class="list-disc list-inside space-y-2 text-gray-700">
                    <li>يرجى التأكد من صحة جميع المعلومات المقدمة</li>
                    <li>سيتم التواصل معك خلال 48 ساعة من تقديم الطلب</li>
                    <li>يمكنك اختيار نوع السهم المناسب لاحتياجاتك الاستثمارية</li>
                    <li>الحد الأدنى للاستثمار هو سهم واحد</li>
                    <li>يمكنك طلب استشارة مجانية قبل الاستثمار</li>
                </ul>
            </div>',
            'content_en' => '<div class="bg-blue-50 p-6 rounded-xl border border-blue-100 mb-8">
                <h3 class="text-xl font-bold mb-4 text-blue-800">Before Submitting Your Application</h3>
                <ul class="list-disc list-inside space-y-2 text-gray-700">
                    <li>Please ensure the accuracy of all information provided</li>
                    <li>You will be contacted within 48 hours of submitting the application</li>
                    <li>You can choose the type of share that suits your investment needs</li>
                    <li>The minimum investment is one share</li>
                    <li>You can request a free consultation before investing</li>
                </ul>
            </div>',
            'page_location' => ContentSection::PAGE_INVESTMENT_APPLICATION,
            'display_order' => 1,
            'is_active' => true,
        ]);
    }
}

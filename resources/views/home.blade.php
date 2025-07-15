@extends('layouts.public')

@section('title', app()->getLocale() === 'ar' ? $siteSettings['meta_title_ar'] : $siteSettings['meta_title_en'])
@section('description', app()->getLocale() === 'ar' ? $siteSettings['meta_description_ar'] : $siteSettings['meta_description_en'])
@section('keywords', app()->getLocale() === 'ar' ? $siteSettings['meta_keywords_ar'] : $siteSettings['meta_keywords_en'])

@push('styles')
<style>
    /* Fix for mobile white space issue */
    body, html {
        overflow-x: hidden;
        max-width: 100vw;
    }

    /* Only prevent horizontal overflow, keep natural widths */

    /* Specific fixes for mobile screens */
    @media (max-width: 768px) {
        body, html {
            overflow-x: hidden !important;
            width: 100% !important;
            max-width: 100vw !important;
        }

        /* Hero section fixes */
        .hero-section {
            width: 100%;
            max-width: 100vw;
        }

        /* Grid and flex container fixes */
        .grid, .flex {
            max-width: 100%;
        }

        /* Animation transform fixes */
        .animate-slide-left,
        .animate-slide-right,
        .animate-fade-in,
        .animate-scale {
            max-width: 100%;
        }

        /* Prevent horizontal scroll from transforms */
        .animate-slide-left {
            transform: translateY(20px);
        }

        .animate-slide-right {
            transform: translateY(20px);
        }

        .animate-slide-left.animated,
        .animate-slide-right.animated {
            transform: translateY(0);
        }

        /* Container responsive adjustments only for very small screens */
        .max-w-7xl {
            padding-left: 1rem;
            padding-right: 1rem;
        }

        .max-w-4xl {
            padding-left: 1rem;
            padding-right: 1rem;
        }
    }

    @media (max-width: 640px) {
        /* Extra small screens - just add more padding */
        .max-w-7xl,
        .max-w-4xl {
            padding-left: 0.75rem;
            padding-right: 0.75rem;
        }

        /* Use only vertical animations on very small screens */
        .animate-slide-left,
        .animate-slide-right {
            transform: translateY(20px);
        }

        .animate-slide-left.animated,
        .animate-slide-right.animated {
            transform: translateY(0);
        }
    }
</style>
@endpush

@section('content')
<!-- Hero Section -->
<section class="hero-section relative bg-gradient-investment text-white overflow-hidden min-h-screen flex items-center">
    <!-- Background Image -->
    <div class="absolute inset-0 bg-cover bg-center bg-no-repeat"
         style="background-image: url('https://images.unsplash.com/photo-1559526324-4b87b5e36e44?ixlib=rb-4.0.3&auto=format&fit=crop&w=2070&q=80');">
    </div>
    <!-- Dark Overlay -->
    <div class="absolute inset-0 bg-gradient-to-r from-green-900/90 via-gray-900/80 to-green-800/90"></div>
    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-24">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
            <div class="animate-fade-in-up">
                <h1 class="text-4xl md:text-6xl font-bold mb-6 leading-tight text-white"
                    style="text-shadow: 3px 3px 6px rgba(0, 0, 0, 0.9), 1px 1px 3px rgba(0, 0, 0, 0.8);">
                    {{ $siteSettings['hero_title_' . app()->getLocale()] ?? ($company ? $company->getLocalizedName() : __('public.hero_title')) }}
                </h1>

                <p class="text-xl mb-8 text-green-100 leading-relaxed">
                    {!! $siteSettings['hero_subtitle_' . app()->getLocale()] ?? ($company ? $company->getLocalizedAbout() : __('public.hero_subtitle')) !!}
                </p>

                <div class="flex flex-col sm:flex-row gap-4 mt-4">
                    <a href="{{ route('contact') }}" class="bg-white text-green-800 px-8 py-4 rounded-lg font-semibold hover:bg-gray-100 transition-colors text-center shadow-lg">
                        {{ $siteSettings['hero_button_start_' . app()->getLocale()] ?? __('public.start_investing') }}
                    </a>
                    <a href="{{ route('about') }}" class="border-2 border-white text-white px-8 py-4 rounded-lg font-semibold hover:bg-white hover:text-green-800 transition-colors text-center">
                        {{ $siteSettings['hero_button_learn_' . app()->getLocale()] ?? __('public.learn_more') }}
                    </a>
                </div>
            </div>

            <div class="animate-slide-in-right">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Regular Share Card -->
                    <div class="bg-white/10 backdrop-blur-lg rounded-2xl p-6 border border-white/20 hover:bg-white/15 transition-all duration-300">
                        <h3 class="text-xl font-bold mb-4 text-center">
                            {{ $siteSettings['hero_regular_share_title_' . app()->getLocale()] ?? ($siteSettings['hero_share_price_title_' . app()->getLocale()] ?? __('public.regular_share_price')) }}
                        </h3>
                        <div class="text-center">
                            <div class="text-4xl font-bold mb-2">{{ $siteSettings['share_price'] ?? '125.50' }}</div>
                            <div class="text-lg text-gray-200">{{ $siteSettings['currency'] ?? 'SAR' }}</div>
                            
                            <div class="mt-3 text-sm text-gray-300">
                                {{ $siteSettings['hero_share_price_updated_' . app()->getLocale()] ?? __('public.last_updated') . ': ' . __('public.today') }}
                            </div>
                        </div>
                    </div>

                    <!-- Redeemable Share Card -->
                    <div class="bg-white/10 backdrop-blur-lg rounded-2xl p-6 border border-white/20 hover:bg-white/15 transition-all duration-300">
                        <h3 class="text-xl font-bold mb-4 text-center">
                            {{ $siteSettings['hero_redeemable_share_title_' . app()->getLocale()] ?? __('public.redeemable_share_price') }}
                        </h3>
                        <div class="text-center">
                            <div class="text-4xl font-bold mb-2">{{ $siteSettings['redeemable_share_price'] ?? '150.00' }}</div>
                            <div class="text-lg text-gray-200">{{ $siteSettings['redeemable_share_currency'] ?? 'SAR' }}</div>
                            
                            <div class="mt-3 text-sm text-gray-300">
                                {{ $siteSettings['hero_share_price_updated_' . app()->getLocale()] ?? __('public.last_updated') . ': ' . __('public.today') }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Floating Elements -->
    <div class="absolute top-20 left-10 w-20 h-20 bg-white/10 rounded-full animate-pulse"></div>
    <div class="absolute bottom-20 right-10 w-32 h-32 bg-white/5 rounded-full animate-pulse"></div>
</section>

<!-- Content Sections -->
<x-content-sections page="home" />


<!-- Company Overview Section -->
@if($company)
<section class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <h2 class="text-4xl font-bold text-gray-900 mb-4">
                {{ $siteSettings['about_section_title_' . app()->getLocale()] ?? (app()->getLocale() === 'ar' ? 'نبذة عن الشركة' : 'About Our Company') }}
            </h2>
            <div class="max-w-4xl mx-auto text-lg text-gray-600 leading-relaxed">
                @if($company)
                    {!! $company->getLocalizedAbout() !!}
                @endif
            </div>
        </div>

        <!-- Mission, Vision, Values -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            @if($company && $company->getLocalizedMission())
            <div class="text-center">
                <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-6">
                    <i class="fas fa-bullseye text-blue-600 text-2xl"></i>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-4">
                    {{ $siteSettings['mission_title_' . app()->getLocale()] ?? (app()->getLocale() === 'ar' ? 'رسالتنا' : 'Our Mission') }}
                </h3>
                <div class="text-gray-600">
                    {!! $company->getLocalizedMission() !!}
                </div>
            </div>
            @endif

            @if($company && $company->getLocalizedVision())
            <div class="text-center">
                <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-6">
                    <i class="fas fa-eye text-green-600 text-2xl"></i>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-4">
                    {{ $siteSettings['vision_title_' . app()->getLocale()] ?? (app()->getLocale() === 'ar' ? 'رؤيتنا' : 'Our Vision') }}
                </h3>
                <div class="text-gray-600">
                    {!! $company->getLocalizedVision() !!}
                </div>
            </div>
            @endif

            @if($company && $company->getLocalizedValues())
            <div class="text-center">
                <div class="w-16 h-16 bg-purple-100 rounded-full flex items-center justify-center mx-auto mb-6">
                    <i class="fas fa-heart text-purple-600 text-2xl"></i>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-4">
                    {{ $siteSettings['values_title_' . app()->getLocale()] ?? (app()->getLocale() === 'ar' ? 'قيمنا' : 'Our Values') }}
                </h3>
                <div class="text-gray-600">
                    {!! $company->getLocalizedValues() !!}
                </div>
            </div>
            @endif
        </div>
    </div>
</section>
@endif



<!-- Statistics Section -->
<section class="stats-section py-20 bg-gradient-to-br from-gray-50 to-blue-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <h2 class="text-4xl font-bold text-gray-900 mb-4">
                {{ $siteSettings['stats_title_' . app()->getLocale()] ?? (app()->getLocale() === 'ar' ? 'إنجازاتنا بالأرقام' : 'Our Achievements in Numbers') }}
            </h2>
            <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                {{ $siteSettings['stats_subtitle_' . app()->getLocale()] ?? (app()->getLocale() === 'ar'
                    ? 'أرقام تعكس ثقة عملائنا ونجاحنا في تحقيق أهدافهم الاستثمارية'
                    : 'Numbers that reflect our clients\' trust and our success in achieving their investment goals')
                }}
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
            <!-- Investors Counter -->
            <div class="group">
                <div class="bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-500 p-8 text-center border border-gray-100 group-hover:border-green-200 transform group-hover:-translate-y-2 relative overflow-hidden">
                    <!-- Background Pattern -->
                    <div class="absolute inset-0 bg-gradient-to-br from-green-50 to-emerald-50 opacity-50"></div>
                    <div class="absolute top-0 right-0 w-20 h-20 bg-green-100 rounded-full -translate-y-10 translate-x-10 opacity-30"></div>

                    <div class="relative z-10">
                        <div class="w-20 h-20 bg-gradient-to-br from-green-700 to-green-800 rounded-2xl flex items-center justify-center mx-auto mb-6 group-hover:scale-110 transition-transform duration-300 shadow-lg">
                            <i class="fas fa-users text-white text-3xl"></i>
                        </div>
                        <div class="text-4xl font-bold text-gray-900 mb-2 counter" data-target="{{ $statistics['investors_count'] ?? 0 }}">0</div>
                        <div class="text-lg font-semibold text-green-700 mb-2">{{ app()->getLocale() === 'ar' ? 'المستثمرين' : 'Investors' }}</div>
                        <div class="text-sm text-gray-500">{{ app()->getLocale() === 'ar' ? 'عميل يثق بخدماتنا' : 'Clients trust our services' }}</div>
                    </div>
                </div>
            </div>

            <!-- Shares Sold Counter -->
            <div class="group">
                <div class="bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-500 p-8 text-center border border-gray-100 group-hover:border-green-200 transform group-hover:-translate-y-2 relative overflow-hidden">
                    <!-- Background Pattern -->
                    <div class="absolute inset-0 bg-gradient-to-br from-green-50 to-emerald-50 opacity-50"></div>
                    <div class="absolute top-0 right-0 w-20 h-20 bg-green-100 rounded-full -translate-y-10 translate-x-10 opacity-30"></div>

                    <div class="relative z-10">
                        <div class="w-20 h-20 bg-gradient-to-br from-green-700 to-green-800 rounded-2xl flex items-center justify-center mx-auto mb-6 group-hover:scale-110 transition-transform duration-300 shadow-lg">
                            <i class="fas fa-chart-line text-white text-3xl"></i>
                        </div>
                        <div class="text-4xl font-bold text-gray-900 mb-2 counter" data-target="{{ $statistics['sold_shares'] ?? 0 }}">0</div>
                        <div class="text-lg font-semibold text-green-700 mb-2">{{ app()->getLocale() === 'ar' ? 'الأسهم المباعة' : 'Shares Sold' }}</div>
                        <div class="text-sm text-gray-500">{{ app()->getLocale() === 'ar' ? 'سهم تم بيعه بنجاح' : 'Shares sold successfully' }}</div>
                    </div>
                </div>
            </div>

            <!-- Available Shares Counter -->
            <div class="group">
                <div class="bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-500 p-8 text-center border border-gray-100 group-hover:border-green-200 transform group-hover:-translate-y-2 relative overflow-hidden">
                    <!-- Background Pattern -->
                    <div class="absolute inset-0 bg-gradient-to-br from-green-50 to-emerald-50 opacity-50"></div>
                    <div class="absolute top-0 right-0 w-20 h-20 bg-green-100 rounded-full -translate-y-10 translate-x-10 opacity-30"></div>

                    <div class="relative z-10">
                        <div class="w-20 h-20 bg-gradient-to-br from-green-700 to-green-800 rounded-2xl flex items-center justify-center mx-auto mb-6 group-hover:scale-110 transition-transform duration-300 shadow-lg">
                            <i class="fas fa-coins text-white text-3xl"></i>
                        </div>
                        <div class="text-4xl font-bold text-gray-900 mb-2 counter" data-target="{{ $statistics['available_shares'] ?? 0 }}">0</div>
                        <div class="text-lg font-semibold text-green-700 mb-2">{{ app()->getLocale() === 'ar' ? 'الأسهم المتاحة' : 'Available Shares' }}</div>
                        <div class="text-sm text-gray-500">{{ app()->getLocale() === 'ar' ? 'سهم متاح للاستثمار' : 'Shares available for investment' }}</div>
                    </div>
                </div>
            </div>

            <!-- Company Value Counter -->
            <div class="group">
                <div class="bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-500 p-8 text-center border border-gray-100 group-hover:border-green-200 transform group-hover:-translate-y-2 relative overflow-hidden">
                    <!-- Background Pattern -->
                    <div class="absolute inset-0 bg-gradient-to-br from-green-50 to-emerald-50 opacity-50"></div>
                    <div class="absolute top-0 right-0 w-20 h-20 bg-green-100 rounded-full -translate-y-10 translate-x-10 opacity-30"></div>

                    <div class="relative z-10">
                        <div class="w-20 h-20 bg-gradient-to-br from-green-700 to-green-800 rounded-2xl flex items-center justify-center mx-auto mb-6 group-hover:scale-110 transition-transform duration-300 shadow-lg">
                            <i class="fas fa-dollar-sign text-white text-3xl"></i>
                        </div>
                        <div class="text-4xl font-bold text-gray-900 mb-2">{{ $statistics['company_value'] ?? '0 SAR' }}</div>
                        <div class="text-lg font-semibold text-green-700 mb-2">{{ app()->getLocale() === 'ar' ? 'قيمة الشركة' : 'Company Value' }}</div>
                        <div class="text-sm text-gray-500">{{ app()->getLocale() === 'ar' ? 'القيمة السوقية الحالية' : 'Current market value' }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<!-- FAQ Section -->
<section class="py-20 bg-gray-50" id="faq-section">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <h2 class="text-4xl font-bold text-gray-900 mb-4">
                {{ app()->getLocale() === 'ar' ? 'الأسئلة الشائعة' : 'Frequently Asked Questions' }}
            </h2>
            <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                {{ app()->getLocale() === 'ar'
                    ? 'إجابات على أكثر الأسئلة شيوعاً حول خدماتنا الاستثمارية وعملياتنا'
                    : 'Answers to the most common questions about our investment services and operations'
                }}
            </p>
        </div>

        <div class="space-y-4">
            @php
                $faqs = \App\Models\Faq::active()->ordered()->get();
            @endphp

            @forelse($faqs as $index => $faq)
                <div class="faq-item bg-white rounded-xl shadow-lg border border-gray-100 overflow-hidden transition-all duration-300 hover:shadow-xl">
                    <button class="faq-question w-full px-6 py-6 text-left flex justify-between items-center focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-inset"
                            data-target="faq-{{ $index }}"
                            aria-expanded="false">
                        <span class="text-lg font-semibold text-gray-900 pr-4">
                            {{ $faq->getLocalizedQuestion() }}
                        </span>
                        <div class="flex-shrink-0">
                            <div class="w-8 h-8 bg-green-100 rounded-full flex items-center justify-center transition-all duration-300">
                                <i class="fas fa-plus text-green-600 transition-transform duration-300"></i>
                            </div>
                        </div>
                    </button>
                    <div id="faq-{{ $index }}" class="faq-answer hidden">
                        <div class="px-6 pb-6 pt-0">
                            <div class="prose prose-lg max-w-none text-gray-600 leading-relaxed">
                                {!! $faq->getLocalizedAnswer() !!}
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <!-- Default FAQs when no FAQs exist in database -->
                <div class="faq-item bg-white rounded-xl shadow-lg border border-gray-100 overflow-hidden transition-all duration-300 hover:shadow-xl">
                    <button class="faq-question w-full px-6 py-6 text-left flex justify-between items-center focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-inset"
                            data-target="faq-0"
                            aria-expanded="false">
                        <span class="text-lg font-semibold text-gray-900 pr-4">
                            {{ app()->getLocale() === 'ar' ? 'ما هو الحد الأدنى للاستثمار؟' : 'What is the minimum investment amount?' }}
                        </span>
                        <div class="flex-shrink-0">
                            <div class="w-8 h-8 bg-green-100 rounded-full flex items-center justify-center transition-all duration-300">
                                <i class="fas fa-plus text-green-600 transition-transform duration-300"></i>
                            </div>
                        </div>
                    </button>
                    <div id="faq-0" class="faq-answer hidden">
                        <div class="px-6 pb-6 pt-0">
                            <div class="prose prose-lg max-w-none text-gray-600 leading-relaxed">
                                <p>{{ app()->getLocale() === 'ar'
                                    ? 'الحد الأدنى للاستثمار هو سهم واحد بقيمة 125.50 ريال سعودي. يمكنك البدء بأي مبلغ تشعر بالراحة معه وزيادة استثمارك تدريجياً.'
                                    : 'The minimum investment is one share valued at 125.50 SAR. You can start with any amount you feel comfortable with and gradually increase your investment.'
                                }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="faq-item bg-white rounded-xl shadow-lg border border-gray-100 overflow-hidden transition-all duration-300 hover:shadow-xl">
                    <button class="faq-question w-full px-6 py-6 text-left flex justify-between items-center focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-inset"
                            data-target="faq-1"
                            aria-expanded="false">
                        <span class="text-lg font-semibold text-gray-900 pr-4">
                            {{ app()->getLocale() === 'ar' ? 'كم من الوقت يستغرق معالجة طلب الاستثمار؟' : 'How long does it take to process an investment application?' }}
                        </span>
                        <div class="flex-shrink-0">
                            <div class="w-8 h-8 bg-green-100 rounded-full flex items-center justify-center transition-all duration-300">
                                <i class="fas fa-plus text-green-600 transition-transform duration-300"></i>
                            </div>
                        </div>
                    </button>
                    <div id="faq-1" class="faq-answer hidden">
                        <div class="px-6 pb-6 pt-0">
                            <div class="prose prose-lg max-w-none text-gray-600 leading-relaxed">
                                <p>{{ app()->getLocale() === 'ar'
                                    ? 'عادة ما نقوم بمراجعة ومعالجة طلبات الاستثمار خلال 3-5 أيام عمل. سنتواصل معك فور اكتمال المراجعة لإرشادك خلال الخطوات التالية.'
                                    : 'We typically review and process investment applications within 3-5 business days. We will contact you as soon as the review is complete to guide you through the next steps.'
                                }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="faq-item bg-white rounded-xl shadow-lg border border-gray-100 overflow-hidden transition-all duration-300 hover:shadow-xl">
                    <button class="faq-question w-full px-6 py-6 text-left flex justify-between items-center focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-inset"
                            data-target="faq-2"
                            aria-expanded="false">
                        <span class="text-lg font-semibold text-gray-900 pr-4">
                            {{ app()->getLocale() === 'ar' ? 'ما هي العوائد المتوقعة من الاستثمار؟' : 'What are the expected returns from investment?' }}
                        </span>
                        <div class="flex-shrink-0">
                            <div class="w-8 h-8 bg-green-100 rounded-full flex items-center justify-center transition-all duration-300">
                                <i class="fas fa-plus text-green-600 transition-transform duration-300"></i>
                            </div>
                        </div>
                    </button>
                    <div id="faq-2" class="faq-answer hidden">
                        <div class="px-6 pb-6 pt-0">
                            <div class="prose prose-lg max-w-none text-gray-600 leading-relaxed">
                                <p>{{ app()->getLocale() === 'ar'
                                    ? 'نستهدف تحقيق عوائد سنوية تتراوح بين 12-15% بناءً على أداء السوق والاستراتيجيات الاستثمارية المطبقة. العوائد الفعلية قد تختلف حسب ظروف السوق.'
                                    : 'We target annual returns of 12-15% based on market performance and applied investment strategies. Actual returns may vary depending on market conditions.'
                                }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="faq-item bg-white rounded-xl shadow-lg border border-gray-100 overflow-hidden transition-all duration-300 hover:shadow-xl">
                    <button class="faq-question w-full px-6 py-6 text-left flex justify-between items-center focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-inset"
                            data-target="faq-3"
                            aria-expanded="false">
                        <span class="text-lg font-semibold text-gray-900 pr-4">
                            {{ app()->getLocale() === 'ar' ? 'هل يمكنني سحب استثماري في أي وقت؟' : 'Can I withdraw my investment at any time?' }}
                        </span>
                        <div class="flex-shrink-0">
                            <div class="w-8 h-8 bg-green-100 rounded-full flex items-center justify-center transition-all duration-300">
                                <i class="fas fa-plus text-green-600 transition-transform duration-300"></i>
                            </div>
                        </div>
                    </button>
                    <div id="faq-3" class="faq-answer hidden">
                        <div class="px-6 pb-6 pt-0">
                            <div class="prose prose-lg max-w-none text-gray-600 leading-relaxed">
                                <p>{{ app()->getLocale() === 'ar'
                                    ? 'نعم، يمكنك طلب سحب استثمارك في أي وقت. ومع ذلك، ننصح بالاستثمار طويل الأمد لتحقيق أفضل العوائد والاستفادة من نمو رأس المال.'
                                    : 'Yes, you can request to withdraw your investment at any time. However, we recommend long-term investment for the best returns and to benefit from capital growth.'
                                }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="faq-item bg-white rounded-xl shadow-lg border border-gray-100 overflow-hidden transition-all duration-300 hover:shadow-xl">
                    <button class="faq-question w-full px-6 py-6 text-left flex justify-between items-center focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-inset"
                            data-target="faq-4"
                            aria-expanded="false">
                        <span class="text-lg font-semibold text-gray-900 pr-4">
                            {{ app()->getLocale() === 'ar' ? 'ما هي المستندات المطلوبة للاستثمار؟' : 'What documents are required for investment?' }}
                        </span>
                        <div class="flex-shrink-0">
                            <div class="w-8 h-8 bg-green-100 rounded-full flex items-center justify-center transition-all duration-300">
                                <i class="fas fa-plus text-green-600 transition-transform duration-300"></i>
                            </div>
                        </div>
                    </button>
                    <div id="faq-4" class="faq-answer hidden">
                        <div class="px-6 pb-6 pt-0">
                            <div class="prose prose-lg max-w-none text-gray-600 leading-relaxed">
                                <p>{{ app()->getLocale() === 'ar'
                                    ? 'للأفراد: الهوية الوطنية، كشف حساب بنكي حديث. للشركات: السجل التجاري، عقد التأسيس، تفويض مدير مخول. جميع المستندات يجب أن تكون سارية المفعول.'
                                    : 'For individuals: National ID, recent bank statement. For companies: Commercial registration, articles of incorporation, authorized manager delegation. All documents must be valid.'
                                }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="faq-item bg-white rounded-xl shadow-lg border border-gray-100 overflow-hidden transition-all duration-300 hover:shadow-xl">
                    <button class="faq-question w-full px-6 py-6 text-left flex justify-between items-center focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-inset"
                            data-target="faq-5"
                            aria-expanded="false">
                        <span class="text-lg font-semibold text-gray-900 pr-4">
                            {{ app()->getLocale() === 'ar' ? 'كيف يمكنني متابعة أداء استثماري؟' : 'How can I track my investment performance?' }}
                        </span>
                        <div class="flex-shrink-0">
                            <div class="w-8 h-8 bg-green-100 rounded-full flex items-center justify-center transition-all duration-300">
                                <i class="fas fa-plus text-green-600 transition-transform duration-300"></i>
                            </div>
                        </div>
                    </button>
                    <div id="faq-5" class="faq-answer hidden">
                        <div class="px-6 pb-6 pt-0">
                            <div class="prose prose-lg max-w-none text-gray-600 leading-relaxed">
                                <p>{{ app()->getLocale() === 'ar'
                                    ? 'سنوفر لك تقارير دورية شهرية وربع سنوية تتضمن تفاصيل أداء استثمارك والعوائد المحققة. كما يمكنك التواصل مع فريق خدمة العملاء في أي وقت للاستفسار.'
                                    : 'We will provide you with monthly and quarterly periodic reports including details of your investment performance and achieved returns. You can also contact our customer service team anytime for inquiries.'
                                }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            @endforelse
        </div>

        <div class="text-center mt-12">
            <p class="text-gray-600 mb-6">
                {{ app()->getLocale() === 'ar' ? 'لديك سؤال آخر؟' : 'Have another question?' }}
            </p>
            <a href="{{ route('contact') }}" class="inline-flex items-center bg-green-700 text-white px-8 py-3 rounded-xl font-semibold hover:bg-green-800 transition-all duration-300 transform hover:scale-105 shadow-lg">
                <i class="fas fa-phone {{ app()->getLocale() === 'ar' ? 'ml-2' : 'mr-2' }}"></i>
                {{ app()->getLocale() === 'ar' ? 'تواصل معنا' : 'Contact Us' }}
            </a>
        </div>
    </div>
</section>

<!-- Featured News Section -->
@if($featuredArticles && $featuredArticles->count() > 0)
<section class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <h2 class="text-4xl font-bold text-gray-900 mb-4">
                {{ $siteSettings['news_section_title_' . app()->getLocale()] ?? (app()->getLocale() === 'ar' ? 'آخر الأخبار' : 'Latest News') }}
            </h2>
            <p class="text-xl text-gray-600">
                {{ $siteSettings['news_section_subtitle_' . app()->getLocale()] ?? (app()->getLocale() === 'ar' ? 'تابع آخر أخبار الشركة والسوق المالي' : 'Stay updated with our latest company and market news') }}
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            @foreach($featuredArticles as $article)
            <article class="bg-gray-50 rounded-xl shadow-lg overflow-hidden hover:shadow-xl transition-all duration-300 transform hover:-translate-y-2">
                @if($article->featured_image)
                    <img src="{{ asset('storage/' . $article->featured_image) }}" alt="{{ $article->getLocalizedTitle() }}" class="w-full h-48 object-cover">
                @else
                    <div class="w-full h-48 bg-gradient-investment flex items-center justify-center">
                        <i class="fas fa-newspaper text-white text-4xl"></i>
                    </div>
                @endif

                <div class="p-6">
                    <div class="flex items-center justify-between text-sm text-blue-600 font-medium mb-3">
                        <span>{{ ucfirst($article->category) }}</span>
                        <span>{{ $article->published_at->format('M d, Y') }}</span>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3 line-clamp-2">
                        {{ $article->getLocalizedTitle() }}
                    </h3>
                    <p class="text-gray-600 mb-4 line-clamp-3">
                        {{ $article->getLocalizedExcerpt() }}
                    </p>
                    <div class="flex items-center justify-between">
                        <a href="{{ route('news.show', $article->slug) }}" class="text-blue-600 font-medium hover:text-blue-800 transition-colors">
                            {{ app()->getLocale() === 'ar' ? 'اقرأ المزيد' : 'Read More' }} →
                        </a>
                        <div class="flex items-center text-sm text-gray-500">
                            <i class="fas fa-eye mr-1"></i>
                            {{ number_format($article->views_count) }}
                        </div>
                    </div>
                </div>
            </article>
            @endforeach
        </div>

        <div class="text-center mt-12">
            <a href="{{ route('news') }}" class="bg-green-700 text-white px-8 py-3 rounded-lg font-semibold hover:bg-green-800 transition-colors">
                {{ app()->getLocale() === 'ar' ? 'جميع الأخبار' : 'View All News' }}
            </a>
        </div>
    </div>
</section>
@endif

<!-- Board Directors Section -->
@if($boardDirectors && $boardDirectors->count() > 0)
<section class="py-20 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <h2 class="text-4xl font-bold text-gray-900 mb-4">
                {{ $siteSettings['board_section_title_' . app()->getLocale()] ?? (app()->getLocale() === 'ar' ? 'مجلس الإدارة' : 'Board of Directors') }}
            </h2>
            <p class="text-xl text-gray-600">
                {{ $siteSettings['board_section_subtitle_' . app()->getLocale()] ?? (app()->getLocale() === 'ar' ? 'تعرف على قادة الشركة وخبراتهم المتميزة' : 'Meet our company leaders and their distinguished expertise') }}
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
            @foreach($boardDirectors as $director)
            <div class="text-center group">
                <div class="relative mb-6">
                    @if($director->photo)
                        <img src="{{ asset('storage/' . $director->photo) }}" alt="{{ $director->getLocalizedName() }}"
                             class="w-32 h-32 rounded-full mx-auto object-cover shadow-lg group-hover:shadow-xl transition-shadow">
                    @else
                        <div class="w-32 h-32 rounded-full mx-auto bg-gradient-investment flex items-center justify-center shadow-lg group-hover:shadow-xl transition-shadow">
                            <i class="fas fa-user text-white text-4xl"></i>
                        </div>
                    @endif
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-2">{{ $director->getLocalizedName() }}</h3>
                <p class="text-blue-600 font-medium">{{ $director->getLocalizedPosition() }}</p>
            </div>
            @endforeach
        </div>

        <div class="text-center mt-12">
            <a href="{{ route('about') }}" class="bg-gray-900 text-white px-8 py-3 rounded-lg font-semibold hover:bg-gray-800 transition-colors">
                {{ app()->getLocale() === 'ar' ? 'تعرف على الفريق' : 'Meet the Team' }}
            </a>
        </div>
    </div>
</section>
@endif

<!-- CTA Section -->
<section class="py-20 bg-gradient-to-r from-green-800 via-gray-900 to-green-700 text-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h2 class="text-4xl font-bold mb-6">
            {{ app()->getLocale() === 'ar' ? 'ابدأ رحلتك الاستثمارية اليوم' : 'Start Your Investment Journey Today' }}
        </h2>
        <p class="text-xl mb-8 max-w-3xl mx-auto">
            {{ app()->getLocale() === 'ar'
                ? 'انضم إلى آلاف المستثمرين الذين يثقون بخبرتنا لتحقيق أهدافهم المالية'
                : 'Join thousands of investors who trust our expertise to achieve their financial goals'
            }}
        </p>
        <a href="{{ route('contact') }}" class="bg-white text-green-800 px-8 py-4 rounded-lg font-semibold hover:bg-gray-100 transition-colors text-lg shadow-lg">
            {{ app()->getLocale() === 'ar' ? 'تواصل معنا الآن' : 'Contact Us Now' }}
        </a>
    </div>
</section>
@endsection

@push('scripts')
<script>
// Counter Animation
function animateCounters() {
    const counters = document.querySelectorAll('.counter');

    counters.forEach(counter => {
        const target = parseInt(counter.getAttribute('data-target'));
        const duration = 2000; // 2 seconds
        const increment = target / (duration / 16); // 60fps
        let current = 0;

        const updateCounter = () => {
            if (current < target) {
                current += increment;
                counter.textContent = Math.floor(current).toLocaleString();
                requestAnimationFrame(updateCounter);
            } else {
                counter.textContent = target.toLocaleString();
            }
        };

        updateCounter();
    });
}

// Intersection Observer for triggering animation when section is visible
// Adjust threshold based on screen size for better mobile experience
const isMobile = window.innerWidth <= 768;
const observerOptions = {
    threshold: isMobile ? 0.2 : 0.5, // Lower threshold for mobile devices
    rootMargin: isMobile ? '0px 0px -50px 0px' : '0px 0px -100px 0px' // Smaller margin for mobile
};

const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
        if (entry.isIntersecting) {
            // Add a small delay for mobile devices to ensure smooth animation
            if (isMobile) {
                setTimeout(() => {
                    animateCounters();
                }, 100);
            } else {
                animateCounters();
            }
            observer.unobserve(entry.target);
        }
    });
}, observerOptions);

// Start observing the statistics section
document.addEventListener('DOMContentLoaded', () => {
    const statsSection = document.querySelector('.counter').closest('section');
    if (statsSection) {
        observer.observe(statsSection);
    }

    // Fallback for very small screens - trigger animation on scroll if not triggered by intersection observer
    if (window.innerWidth <= 414) {
        let animationTriggered = false;
        window.addEventListener('scroll', () => {
            if (!animationTriggered) {
                const statsSection = document.querySelector('.counter').closest('section');
                if (statsSection) {
                    const rect = statsSection.getBoundingClientRect();
                    const windowHeight = window.innerHeight;

                    // Trigger when any part of the section is visible
                    if (rect.top < windowHeight && rect.bottom > 0) {
                        animateCounters();
                        animationTriggered = true;
                    }
                }
            }
        });
    }
});
</script>
@endpush

@push('scripts')
<script>
// Immediate mobile overflow fix
(function() {
    function forceOverflowFix() {
        document.body.style.overflowX = 'hidden';
        document.documentElement.style.overflowX = 'hidden';
        document.body.style.maxWidth = '100vw';
        document.documentElement.style.maxWidth = '100vw';
    }

    // Apply immediately
    forceOverflowFix();

    // Apply on resize
    window.addEventListener('resize', forceOverflowFix);
})();

// FAQ Accordion Functionality
document.addEventListener('DOMContentLoaded', function() {
    const faqQuestions = document.querySelectorAll('.faq-question');

    faqQuestions.forEach(question => {
        question.addEventListener('click', function() {
            const targetId = this.getAttribute('data-target');
            const answer = document.getElementById(targetId);
            const icon = this.querySelector('i');
            const iconContainer = this.querySelector('.w-8.h-8');
            const isExpanded = this.getAttribute('aria-expanded') === 'true';

            // Close all other FAQs
            faqQuestions.forEach(otherQuestion => {
                if (otherQuestion !== this) {
                    const otherTargetId = otherQuestion.getAttribute('data-target');
                    const otherAnswer = document.getElementById(otherTargetId);
                    const otherIcon = otherQuestion.querySelector('i');
                    const otherIconContainer = otherQuestion.querySelector('.w-8.h-8');

                    otherAnswer.classList.add('hidden');
                    otherQuestion.setAttribute('aria-expanded', 'false');
                    otherIcon.classList.remove('fa-minus', 'rotate-180');
                    otherIcon.classList.add('fa-plus');
                    otherIconContainer.classList.remove('bg-green-600');
                    otherIconContainer.classList.add('bg-green-100');
                    otherIcon.classList.remove('text-white');
                    otherIcon.classList.add('text-green-600');
                }
            });

            // Toggle current FAQ
            if (isExpanded) {
                // Close current FAQ
                answer.classList.add('hidden');
                this.setAttribute('aria-expanded', 'false');
                icon.classList.remove('fa-minus', 'rotate-180');
                icon.classList.add('fa-plus');
                iconContainer.classList.remove('bg-green-600');
                iconContainer.classList.add('bg-green-100');
                icon.classList.remove('text-white');
                icon.classList.add('text-green-600');
            } else {
                // Open current FAQ
                answer.classList.remove('hidden');
                this.setAttribute('aria-expanded', 'true');
                icon.classList.remove('fa-plus');
                icon.classList.add('fa-minus', 'rotate-180');
                iconContainer.classList.remove('bg-green-100');
                iconContainer.classList.add('bg-green-600');
                icon.classList.remove('text-green-600');
                icon.classList.add('text-white');

                // Smooth scroll to FAQ if needed
                setTimeout(() => {
                    const rect = this.getBoundingClientRect();
                    if (rect.top < 100) {
                        this.scrollIntoView({ behavior: 'smooth', block: 'start' });
                    }
                }, 100);
            }
        });
    });

    // Add keyboard navigation
    faqQuestions.forEach(question => {
        question.addEventListener('keydown', function(e) {
            if (e.key === 'Enter' || e.key === ' ') {
                e.preventDefault();
                this.click();
            }
        });
    });
});
</script>
@endpush

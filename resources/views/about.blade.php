@extends('layouts.public')

@section('title', $siteSettings['about_page_title_' . app()->getLocale()] ?? ($company ? $company->getLocalizedName() : (app()->getLocale() === 'ar' ? 'عن الشركة' : 'About Us')))
@section('description', $siteSettings['about_page_subtitle_' . app()->getLocale()] ?? ($company ? $company->getLocalizedAbout() : (app()->getLocale() === 'ar' ? 'تعرف على شركة الجودة للاستثمار ورؤيتنا ورسالتنا وفريق الإدارة' : 'Learn about Quality Investment Company, our vision, mission, and management team')))

@push('styles')
<style>
    /* About page responsive fixes */
    .about-page-section {
        padding-top: 5rem;
        padding-bottom: 5rem;
    }

    @media (max-width: 1024px) {
        .about-page-section {
            padding-top: 4rem;
            padding-bottom: 4rem;
        }

        .about-page-section .mb-16 {
            margin-bottom: 3rem;
        }

        .about-page-section .mb-12 {
            margin-bottom: 2rem;
        }
    }

    @media (max-width: 768px) {
        .about-page-section {
            padding-top: 3rem;
            padding-bottom: 3rem;
        }

        .about-page-section:first-of-type {
            padding-top: 2rem;
        }

        /* Remove extra spacing on mobile */
        .about-page-section .grid {
            gap: 2rem;
        }

        .about-page-section .space-y-6 {
            gap: 1.5rem;
        }

        .about-page-section .mb-16 {
            margin-bottom: 2rem;
        }

        .about-page-section .mb-12 {
            margin-bottom: 1.5rem;
        }

        .about-page-section .mb-8 {
            margin-bottom: 1rem;
        }

        /* Compact board member cards */
        .board-member-card {
            margin-bottom: 1rem;
        }

        .board-member-card .p-6 {
            padding: 1rem;
        }

        .board-member-card .h-64 {
            height: 10rem;
        }

        /* Reduce text sizes */
        .about-page-section h2 {
            font-size: 2rem !important;
            line-height: 1.2;
        }

        .about-page-section h3 {
            font-size: 1.5rem !important;
            line-height: 1.3;
        }

        .about-page-section p {
            font-size: 0.95rem !important;
            line-height: 1.5;
        }
    }

    @media (max-width: 640px) {
        .about-page-section {
            padding-top: 2rem;
            padding-bottom: 2rem;
        }

        .about-page-section:first-of-type {
            padding-top: 1rem;
        }

        .about-page-section .px-4 {
            padding-left: 1rem;
            padding-right: 1rem;
        }

        .about-page-section .grid {
            gap: 1.5rem;
        }

        .about-page-section .space-y-6 {
            gap: 1rem;
        }

        .about-page-section .mb-16 {
            margin-bottom: 1.5rem;
        }

        .about-page-section .mb-12 {
            margin-bottom: 1rem;
        }

        .board-member-card .h-64 {
            height: 8rem;
        }

        /* Further reduce text sizes */
        .about-page-section h2 {
            font-size: 1.75rem !important;
        }

        .about-page-section h3 {
            font-size: 1.25rem !important;
        }

        .about-page-section p {
            font-size: 0.875rem !important;
        }
    }

    @media (max-width: 480px) {
        .about-page-section {
            padding-top: 1.5rem;
            padding-bottom: 1.5rem;
        }

        .about-page-section .px-4 {
            padding-left: 0.75rem;
            padding-right: 0.75rem;
        }

        .about-page-section .grid {
            gap: 1rem;
        }

        .about-page-section .space-y-6 {
            gap: 0.75rem;
        }

        .board-member-card .h-64 {
            height: 6rem;
        }

        .about-page-section h2 {
            font-size: 1.5rem !important;
        }

        .about-page-section h3 {
            font-size: 1.125rem !important;
        }
    }

    /* Remove any potential overflow */
    .about-page-section {
        overflow-x: hidden;
    }

    /* Keep natural container behavior */

    /* Professional Board Member Cards */
    .board-member-card {
        transition: all 0.5s cubic-bezier(0.25, 0.46, 0.45, 0.94);
    }

    .board-member-card:hover {
        transform: translateY(-8px) scale(1.02);
    }

    .member-photo-container {
        perspective: 1000px;
    }

    .member-photo-container > div {
        transform-style: preserve-3d;
        transition: transform 0.5s ease;
    }

    .board-member-card:hover .member-photo-container > div {
        transform: rotateY(5deg) rotateX(5deg);
    }

    /* Professional Photo Frame Effects */
    .member-photo-container .w-28.h-28 {
        box-shadow:
            0 10px 25px rgba(0, 0, 0, 0.15),
            0 4px 10px rgba(0, 0, 0, 0.1),
            inset 0 1px 0 rgba(255, 255, 255, 0.2);
    }

    .board-member-card:hover .member-photo-container .w-28.h-28 {
        box-shadow:
            0 20px 40px rgba(0, 0, 0, 0.2),
            0 8px 20px rgba(0, 0, 0, 0.15),
            inset 0 1px 0 rgba(255, 255, 255, 0.3);
    }

    /* Position Badge Animation */
    .board-member-card .bg-gradient-to-r {
        position: relative;
        overflow: hidden;
    }

    .board-member-card .bg-gradient-to-r::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
        transition: left 0.5s ease;
    }

    .board-member-card:hover .bg-gradient-to-r::before {
        left: 100%;
    }

    /* Social Media Hover Effects */
    .member-photo-container a {
        transform: scale(0.8);
        transition: all 0.3s ease;
    }

    .member-photo-container:hover a {
        transform: scale(1);
    }

    .member-photo-container a:hover {
        transform: scale(1.2) rotate(5deg);
    }

    /* Professional Credentials Animation */
    .board-member-card .grid > div {
        transform: translateY(10px);
        opacity: 0.8;
        transition: all 0.3s ease;
    }

    .board-member-card:hover .grid > div {
        transform: translateY(0);
        opacity: 1;
    }

    .board-member-card:hover .grid > div:nth-child(1) {
        transition-delay: 0.1s;
    }

    .board-member-card:hover .grid > div:nth-child(2) {
        transition-delay: 0.2s;
    }

    /* Contact Info Slide Animation */
    .board-member-card .text-xs.text-gray-500 {
        transform: translateY(20px);
        transition: all 0.4s ease;
    }

    .board-member-card:hover .text-xs.text-gray-500 {
        transform: translateY(0);
    }

    /* Scale effect for smaller screens */
    @media (max-width: 768px) {
        .board-member-card:hover {
            transform: translateY(-4px) scale(1.01);
        }

        .board-member-card:hover .member-photo-container > div {
            transform: rotateY(2deg) rotateX(2deg);
        }
    }
</style>
@endpush

@section('content')
@php
    $company = \App\Models\Company::first();
    $boardMembers = collect(); // Temporary fix - will be replaced when BoardMember model is created
@endphp


<!-- Page Header -->
<section class="page-header relative bg-gradient-investment text-white overflow-hidden">
    <!-- Background Image -->
    <div class="absolute inset-0 bg-cover bg-center bg-no-repeat"
         style="background-image: url('https://images.unsplash.com/photo-1559526324-4b87b5e36e44?ixlib=rb-4.0.3&auto=format&fit=crop&w=2070&q=80');">
    </div>
    <!-- Dark Overlay -->
    <div class="absolute inset-0 bg-gradient-to-r from-green-900/90 via-gray-900/80 to-green-800/90"></div>
    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <div class="mb-8">
            <div class="inline-flex items-center justify-center w-20 h-20 bg-white/20 backdrop-blur-sm rounded-full mb-6">
                <i class="fas fa-building text-3xl text-white"></i>
            </div>
            <h1 class="text-4xl md:text-6xl font-bold mb-6">
                {{ $siteSettings['about_page_title_' . app()->getLocale()] ?? (app()->getLocale() === 'ar' ? 'عن الشركة' : 'About Us') }}
            </h1>
            <p class="text-xl md:text-2xl text-gray-200 max-w-4xl mx-auto">
                {{ $siteSettings['about_page_subtitle_' . app()->getLocale()] ?? (app()->getLocale() === 'ar'
                    ? 'تعرف على قصتنا ورؤيتنا في عالم الاستثمار والنمو المستدام'
                    : 'Discover our story and vision in the world of investment and sustainable growth')
                }}
            </p>
        </div>
    </div>
</section>



<!-- Company Overview -->
<section class="about-page-section py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
            <div>
                <h2 class="text-4xl font-bold text-gray-900 mb-6">
                    {{ $siteSettings['who_we_are_title_' . app()->getLocale()] ?? (app()->getLocale() === 'ar' ? 'من نحن' : 'Who We Are') }}
                </h2>
                <div class="prose prose-lg text-gray-600 space-y-6">
                    @if($company && $company->getLocalizedAbout())
                        {!! $company->getLocalizedAbout() !!}
                    @else
                        <p>
                            {{ app()->getLocale() === 'ar'
                                ? 'شركة الجودة للاستثمار هي شركة رائدة في مجال الاستثمار والخدمات المالية، تأسست بهدف تقديم حلول استثمارية مبتكرة ومتطورة لعملائنا. نحن نؤمن بأن الاستثمار الذكي هو مفتاح النجاح المالي والنمو المستدام.'
                                : 'Quality Investment Company is a leading firm in investment and financial services, founded with the goal of providing innovative and advanced investment solutions to our clients. We believe that smart investing is the key to financial success and sustainable growth.'
                            }}
                        </p>
                        <p>
                            {{ app()->getLocale() === 'ar'
                                ? 'مع سنوات من الخبرة في السوق المالي، نقدم خدمات استثمارية متنوعة تلبي احتياجات جميع فئات المستثمرين، من الأفراد إلى الشركات والمؤسسات الكبيرة.'
                                : 'With years of experience in the financial market, we offer diverse investment services that meet the needs of all types of investors, from individuals to large corporations and institutions.'
                            }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="relative">
                <div class="bg-gradient-to-br from-green-100 to-blue-100 rounded-2xl p-8">
                    <img src="{{ asset('images/about-illustration.svg') }}" alt="About Us" class="w-full h-auto">
                </div>
                <!-- Floating Stats -->
                <div class="absolute -top-6 -right-6 bg-white rounded-xl shadow-lg p-6 border border-gray-100">
                    <div class="text-center">
                        <div class="text-2xl font-bold text-green-600">15+</div>
                        <div class="text-sm text-gray-600">{{ app()->getLocale() === 'ar' ? 'سنة خبرة' : 'Years Experience' }}</div>
                    </div>
                </div>
                <div class="absolute -bottom-6 -left-6 bg-white rounded-xl shadow-lg p-6 border border-gray-100">
                    <div class="text-center">
                        <div class="text-2xl font-bold text-blue-600">1000+</div>
                        <div class="text-sm text-gray-600">{{ app()->getLocale() === 'ar' ? 'عميل راضي' : 'Happy Clients' }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Vision & Mission -->
<section class="about-page-section py-20 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <h2 class="text-4xl font-bold text-gray-900 mb-4">
                {{ app()->getLocale() === 'ar' ? 'رؤيتنا ورسالتنا' : 'Our Vision & Mission' }}
            </h2>
            <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                {{ app()->getLocale() === 'ar'
                    ? 'نسعى لتحقيق التميز في الخدمات الاستثمارية وبناء مستقبل مالي مستدام لعملائنا'
                    : 'We strive for excellence in investment services and building a sustainable financial future for our clients'
                }}
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-12">
            <!-- Vision -->
            <div class="bg-white rounded-2xl shadow-lg p-8 border border-gray-100 hover:shadow-xl transition-shadow duration-300">
                <div class="flex items-center mb-6">
                    <div class="w-16 h-16 bg-gradient-to-br from-blue-500 to-indigo-600 rounded-full flex items-center justify-center mr-4">
                        <i class="fas fa-eye text-white text-2xl"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900">
                        {{ app()->getLocale() === 'ar' ? 'رؤيتنا' : 'Our Vision' }}
                    </h3>
                </div>
                <p class="text-gray-600 leading-relaxed">
                    @if($company && $company->getLocalizedVision())
                        {{ $company->getLocalizedVision() }}
                    @else
                        {{ app()->getLocale() === 'ar'
                            ? 'أن نكون الشركة الرائدة في مجال الاستثمار في المنطقة، ونقدم حلولاً استثمارية مبتكرة تحقق أعلى العوائد مع إدارة المخاطر بفعالية.'
                            : 'To be the leading investment company in the region, providing innovative investment solutions that achieve the highest returns while effectively managing risks.'
                        }}
                    @endif
                </p>
            </div>

            <!-- Mission -->
            <div class="bg-white rounded-2xl shadow-lg p-8 border border-gray-100 hover:shadow-xl transition-shadow duration-300">
                <div class="flex items-center mb-6">
                    <div class="w-16 h-16 bg-gradient-to-br from-green-500 to-emerald-600 rounded-full flex items-center justify-center mr-4">
                        <i class="fas fa-bullseye text-white text-2xl"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900">
                        {{ app()->getLocale() === 'ar' ? 'رسالتنا' : 'Our Mission' }}
                    </h3>
                </div>
                <p class="text-gray-600 leading-relaxed">
                    @if($company && $company->getLocalizedMission())
                        {{ $company->getLocalizedMission() }}
                    @else
                        {{ app()->getLocale() === 'ar'
                            ? 'تقديم خدمات استثمارية متميزة ومبتكرة لعملائنا، مع الالتزام بأعلى معايير الشفافية والمهنية، لتحقيق أهدافهم المالية وبناء ثقة طويلة الأمد.'
                            : 'Providing exceptional and innovative investment services to our clients, while maintaining the highest standards of transparency and professionalism, to achieve their financial goals and build long-term trust.'
                        }}
                    @endif
                </p>
            </div>
        </div>
    </div>
</section>

<!-- Values -->
<section class="about-page-section py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <h2 class="text-4xl font-bold text-gray-900 mb-4">
                {{ app()->getLocale() === 'ar' ? 'قيمنا الأساسية' : 'Our Core Values' }}
            </h2>
            <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                {{ app()->getLocale() === 'ar'
                    ? 'القيم التي نؤمن بها وتوجه عملنا في كل ما نقوم به'
                    : 'The values we believe in and that guide our work in everything we do'
                }}
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
            <!-- Integrity -->
            <div class="text-center group">
                <div class="w-20 h-20 bg-gradient-to-br from-blue-500 to-indigo-600 rounded-full flex items-center justify-center mx-auto mb-6 group-hover:scale-110 transition-transform duration-300">
                    <i class="fas fa-shield-alt text-white text-2xl"></i>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-4">
                    {{ app()->getLocale() === 'ar' ? 'النزاهة' : 'Integrity' }}
                </h3>
                <p class="text-gray-600">
                    {{ app()->getLocale() === 'ar'
                        ? 'نلتزم بأعلى معايير النزاهة والشفافية في جميع تعاملاتنا'
                        : 'We maintain the highest standards of integrity and transparency in all our dealings'
                    }}
                </p>
            </div>

            <!-- Excellence -->
            <div class="text-center group">
                <div class="w-20 h-20 bg-gradient-to-br from-green-500 to-emerald-600 rounded-full flex items-center justify-center mx-auto mb-6 group-hover:scale-110 transition-transform duration-300">
                    <i class="fas fa-star text-white text-2xl"></i>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-4">
                    {{ app()->getLocale() === 'ar' ? 'التميز' : 'Excellence' }}
                </h3>
                <p class="text-gray-600">
                    {{ app()->getLocale() === 'ar'
                        ? 'نسعى للتميز في كل ما نقوم به لتحقيق أفضل النتائج لعملائنا'
                        : 'We strive for excellence in everything we do to achieve the best results for our clients'
                    }}
                </p>
            </div>

            <!-- Innovation -->
            <div class="text-center group">
                <div class="w-20 h-20 bg-gradient-to-br from-purple-500 to-pink-600 rounded-full flex items-center justify-center mx-auto mb-6 group-hover:scale-110 transition-transform duration-300">
                    <i class="fas fa-lightbulb text-white text-2xl"></i>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-4">
                    {{ app()->getLocale() === 'ar' ? 'الابتكار' : 'Innovation' }}
                </h3>
                <p class="text-gray-600">
                    {{ app()->getLocale() === 'ar'
                        ? 'نبتكر حلولاً استثمارية متطورة تواكب التطورات العالمية'
                        : 'We innovate advanced investment solutions that keep pace with global developments'
                    }}
                </p>
            </div>

            <!-- Trust -->
            <div class="text-center group">
                <div class="w-20 h-20 bg-gradient-to-br from-orange-500 to-red-600 rounded-full flex items-center justify-center mx-auto mb-6 group-hover:scale-110 transition-transform duration-300">
                    <i class="fas fa-handshake text-white text-2xl"></i>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-4">
                    {{ app()->getLocale() === 'ar' ? 'الثقة' : 'Trust' }}
                </h3>
                <p class="text-gray-600">
                    {{ app()->getLocale() === 'ar'
                        ? 'نبني علاقات طويلة الأمد مع عملائنا قائمة على الثقة المتبادلة'
                        : 'We build long-term relationships with our clients based on mutual trust'
                    }}
                </p>
            </div>
        </div>
    </div>
</section>

<!-- Content Sections -->
<x-content-sections page="about" />

<!-- Board of Directors -->
@if($boardMembers->count() > 0)
<section class="about-page-section py-20 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <h2 class="text-4xl font-bold text-gray-900 mb-4">
                {{ app()->getLocale() === 'ar' ? 'مجلس الإدارة' : 'Board of Directors' }}
            </h2>
            <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                {{ app()->getLocale() === 'ar'
                    ? 'فريق من الخبراء والقادة المتميزين الذين يقودون الشركة نحو النجاح والتميز'
                    : 'A team of distinguished experts and leaders who guide the company towards success and excellence'
                }}
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @php
                $boardDirectors = \App\Models\BoardDirector::active()->ordered()->get();
            @endphp

            @forelse($boardDirectors as $index => $director)
                <div class="group board-member-card">
                    <div class="relative bg-white rounded-2xl shadow-xl hover:shadow-2xl transition-all duration-500 overflow-hidden border border-gray-100 group-hover:border-green-300 transform group-hover:-translate-y-2 group-hover:scale-102">
                        <!-- Professional Background -->
                        <div class="absolute inset-0 bg-gradient-to-br from-gray-50 via-white to-green-50/30"></div>

                        <!-- Decorative Elements -->
                        <div class="absolute top-0 right-0 w-20 h-20 bg-gradient-to-br from-green-100/50 to-transparent rounded-full -translate-y-10 translate-x-10"></div>
                        <div class="absolute bottom-0 left-0 w-16 h-16 bg-gradient-to-tr from-gray-100/50 to-transparent rounded-full translate-y-8 -translate-x-8"></div>

                        <!-- Member Photo Section -->
                        <div class="relative p-6 pb-4">
                            <div class="flex justify-center mb-4">
                                <div class="relative member-photo-container">
                                    <!-- Professional Photo Frame -->
                                    <div class="relative w-28 h-28 rounded-xl overflow-hidden shadow-xl border-4 border-white group-hover:border-green-100 transition-all duration-500 bg-gradient-to-br from-green-700 via-green-800 to-gray-800">
                                        <!-- Inner Frame -->
                                        <div class="absolute inset-1 rounded-lg border-2 border-white/20 group-hover:border-white/40 transition-all duration-500"></div>

                                        <!-- Photo or Placeholder -->
                                        @if($director->photo)
                                            <img src="{{ Storage::url($director->photo) }}" alt="{{ $director->getLocalizedName() }}" class="w-full h-full object-cover">
                                        @else
                                            <div class="w-full h-full flex items-center justify-center">
                                                <i class="fas fa-user-tie text-white text-3xl"></i>
                                            </div>
                                        @endif

                                        <!-- Professional Overlay -->
                                        <div class="absolute inset-0 bg-gradient-to-t from-black/20 via-transparent to-transparent"></div>
                                    </div>

                                    <!-- Social Media Overlay - Shows on Hover -->
                                    @if($director->hasSocialMedia())
                                        <div class="absolute inset-0 bg-black/80 rounded-xl opacity-0 group-hover:opacity-100 transition-all duration-300 flex items-center justify-center">
                                            <div class="flex space-x-3">
                                                @if($director->getLinkedinUrl())
                                                    <a href="{{ $director->getLinkedinUrl() }}" target="_blank" class="w-8 h-8 bg-blue-600 rounded-lg flex items-center justify-center text-white hover:bg-blue-700 transition-colors transform hover:scale-110">
                                                        <i class="fab fa-linkedin text-xs"></i>
                                                    </a>
                                                @endif
                                                @if($director->contact_info['email'] ?? null)
                                                    <a href="mailto:{{ $director->contact_info['email'] }}" class="w-8 h-8 bg-gray-600 rounded-lg flex items-center justify-center text-white hover:bg-gray-700 transition-colors transform hover:scale-110">
                                                        <i class="fas fa-envelope text-xs"></i>
                                                    </a>
                                                @endif
                                                @if($director->contact_info['phone'] ?? null)
                                                    <a href="tel:{{ $director->contact_info['phone'] }}" class="w-8 h-8 bg-green-600 rounded-lg flex items-center justify-center text-white hover:bg-green-700 transition-colors transform hover:scale-110">
                                                        <i class="fas fa-phone text-xs"></i>
                                                    </a>
                                                @endif
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <!-- Member Info -->
                            <div class="text-center relative z-10">
                                <h3 class="text-xl font-bold text-gray-900 mb-2 group-hover:text-green-800 transition-colors duration-300">
                                    {{ $director->getLocalizedName() }}
                                </h3>

                                <!-- Professional Position Badge -->
                                <div class="relative inline-block">
                                    <div class="bg-gradient-to-r from-green-600 to-green-700 text-white px-4 py-2 rounded-lg text-sm font-semibold shadow-md relative overflow-hidden">
                                        <!-- Background Pattern -->
                                        <div class="absolute inset-0 bg-gradient-to-r from-transparent via-white/10 to-transparent transform -skew-x-12"></div>

                                        <!-- Position Text -->
                                        <span class="relative flex items-center">
                                            <i class="fas fa-crown text-yellow-300 mr-2 text-xs"></i>
                                            {{ $director->getLocalizedPosition() }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Member Details -->
                        <div class="px-6 pb-6 relative z-10">
                            <p class="text-gray-600 text-center leading-relaxed mb-4 text-sm">
                                {{ Str::limit($director->getLocalizedBio(), 150) }}
                            </p>

                            <!-- Professional Credentials -->
                            <div class="grid grid-cols-2 gap-2 mb-4">
                                <div class="bg-green-50 rounded-lg p-2 text-center border border-green-100">
                                    <i class="fas fa-user-tie text-green-600 text-xs mb-1"></i>
                                    <div class="text-xs font-semibold text-green-800">{{ app()->getLocale() === 'ar' ? 'عضو' : 'Member' }}</div>
                                    <div class="text-xs text-green-600">{{ app()->getLocale() === 'ar' ? 'مجلس الإدارة' : 'Board' }}</div>
                                </div>
                                <div class="bg-blue-50 rounded-lg p-2 text-center border border-blue-100">
                                    <i class="fas fa-building text-blue-600 text-xs mb-1"></i>
                                    <div class="text-xs font-semibold text-blue-800">{{ app()->getLocale() === 'ar' ? 'خبير' : 'Expert' }}</div>
                                    <div class="text-xs text-blue-600">{{ app()->getLocale() === 'ar' ? 'استثمار' : 'Investment' }}</div>
                                </div>
                            </div>

                            <!-- Contact Info (Hidden by default, shows on hover) -->
                            @if($director->contact_info['email'] || $director->contact_info['phone'])
                                <div class="text-center opacity-0 group-hover:opacity-100 transition-all duration-500 transform translate-y-2 group-hover:translate-y-0">
                                    <div class="text-xs text-gray-500 space-y-1">
                                        @if($director->contact_info['email'])
                                            <div class="flex items-center justify-center space-x-2">
                                                <i class="fas fa-envelope text-gray-400"></i>
                                                <span>{{ $director->contact_info['email'] }}</span>
                                            </div>
                                        @endif
                                        @if($director->contact_info['phone'])
                                            <div class="flex items-center justify-center space-x-2">
                                                <i class="fas fa-phone text-gray-400"></i>
                                                <span>{{ $director->contact_info['phone'] }}</span>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            @endif
                        </div>

                        <!-- Professional Border Effect -->
                        <div class="absolute inset-0 rounded-2xl border-2 border-transparent group-hover:border-green-200 transition-all duration-500"></div>
                    </div>
                </div>
            @empty
                <!-- Default Demo Members when no directors exist -->
            <div class="group board-member-card">
                <div class="relative bg-white rounded-2xl shadow-xl hover:shadow-2xl transition-all duration-500 overflow-hidden border border-gray-100 group-hover:border-green-300 transform group-hover:-translate-y-2 group-hover:scale-102">
                    <!-- Professional Background -->
                    <div class="absolute inset-0 bg-gradient-to-br from-gray-50 via-white to-green-50/30"></div>

                    <!-- Decorative Elements -->
                    <div class="absolute top-0 right-0 w-20 h-20 bg-gradient-to-br from-green-100/50 to-transparent rounded-full -translate-y-10 translate-x-10"></div>
                    <div class="absolute bottom-0 left-0 w-16 h-16 bg-gradient-to-tr from-gray-100/50 to-transparent rounded-full translate-y-8 -translate-x-8"></div>

                    <!-- Member Photo Section -->
                    <div class="relative p-6 pb-4">
                        <div class="flex justify-center mb-4">
                            <div class="relative member-photo-container">
                                <!-- Professional Photo Frame -->
                                <div class="relative w-28 h-28 rounded-xl overflow-hidden shadow-xl border-4 border-white group-hover:border-green-100 transition-all duration-500 bg-gradient-to-br from-green-700 via-green-800 to-gray-800">
                                    <!-- Inner Frame -->
                                    <div class="absolute inset-1 rounded-lg border-2 border-white/20 group-hover:border-white/40 transition-all duration-500"></div>

                                    <!-- Photo Placeholder -->
                                    <div class="w-full h-full flex items-center justify-center">
                                        <i class="fas fa-user-tie text-white text-3xl"></i>
                                    </div>

                                    <!-- Professional Overlay -->
                                    <div class="absolute inset-0 bg-gradient-to-t from-black/20 via-transparent to-transparent"></div>
                                </div>

                                <!-- Social Media Overlay - Shows on Hover -->
                                <div class="absolute inset-0 bg-black/80 rounded-xl opacity-0 group-hover:opacity-100 transition-all duration-300 flex items-center justify-center">
                                    <div class="flex space-x-3">
                                        <a href="#" class="w-8 h-8 bg-blue-600 rounded-lg flex items-center justify-center text-white hover:bg-blue-700 transition-colors transform hover:scale-110">
                                            <i class="fab fa-linkedin text-xs"></i>
                                        </a>
                                        <a href="mailto:" class="w-8 h-8 bg-gray-600 rounded-lg flex items-center justify-center text-white hover:bg-gray-700 transition-colors transform hover:scale-110">
                                            <i class="fas fa-envelope text-xs"></i>
                                        </a>
                                        <a href="tel:" class="w-8 h-8 bg-green-600 rounded-lg flex items-center justify-center text-white hover:bg-green-700 transition-colors transform hover:scale-110">
                                            <i class="fas fa-phone text-xs"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Member Info -->
                        <div class="text-center relative z-10">
                            <h3 class="text-xl font-bold text-gray-900 mb-2 group-hover:text-green-800 transition-colors duration-300">
                                {{ app()->getLocale() === 'ar' ? 'أحمد محمد الأحمد' : 'Ahmed Mohammed Al-Ahmed' }}
                            </h3>

                            <!-- Professional Position Badge -->
                            <div class="relative inline-block">
                                <div class="bg-gradient-to-r from-green-600 to-green-700 text-white px-4 py-2 rounded-lg text-sm font-semibold shadow-md relative overflow-hidden">
                                    <!-- Background Pattern -->
                                    <div class="absolute inset-0 bg-gradient-to-r from-transparent via-white/10 to-transparent transform -skew-x-12"></div>

                                    <!-- Position Text -->
                                    <span class="relative flex items-center">
                                        <i class="fas fa-crown text-yellow-300 mr-2 text-xs"></i>
                                        {{ app()->getLocale() === 'ar' ? 'رئيس مجلس الإدارة' : 'Chairman of the Board' }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Member Details -->
                    <div class="px-6 pb-6 relative z-10">
                        <p class="text-gray-600 text-center leading-relaxed mb-4 text-sm">
                            {{ app()->getLocale() === 'ar'
                                ? 'خبرة تزيد عن 20 عاماً في مجال الاستثمار والأسواق المالية مع سجل حافل من النجاحات في قيادة الشركات الاستثمارية.'
                                : 'Over 20 years of experience in investment and financial markets with a proven track record of success in leading investment companies.'
                            }}
                        </p>

                        <!-- Professional Credentials -->
                        <div class="grid grid-cols-2 gap-2 mb-4">
                            <div class="bg-green-50 rounded-lg p-2 text-center border border-green-100">
                                <i class="fas fa-clock text-green-600 text-xs mb-1"></i>
                                <div class="text-xs font-semibold text-green-800">{{ app()->getLocale() === 'ar' ? '20+ سنة' : '20+ Years' }}</div>
                                <div class="text-xs text-green-600">{{ app()->getLocale() === 'ar' ? 'خبرة' : 'Experience' }}</div>
                            </div>
                            <div class="bg-blue-50 rounded-lg p-2 text-center border border-blue-100">
                                <i class="fas fa-graduation-cap text-blue-600 text-xs mb-1"></i>
                                <div class="text-xs font-semibold text-blue-800">MBA</div>
                                <div class="text-xs text-blue-600">{{ app()->getLocale() === 'ar' ? 'إدارة أعمال' : 'Business' }}</div>
                            </div>
                        </div>

                        <!-- Contact Info (Hidden by default, shows on hover) -->
                        <div class="text-center opacity-0 group-hover:opacity-100 transition-all duration-500 transform translate-y-2 group-hover:translate-y-0">
                            <div class="text-xs text-gray-500 space-y-1">
                                <div class="flex items-center justify-center space-x-2">
                                    <i class="fas fa-envelope text-gray-400"></i>
                                    <span>ahmed@qualityinvestment.com</span>
                                </div>
                                <div class="flex items-center justify-center space-x-2">
                                    <i class="fas fa-phone text-gray-400"></i>
                                    <span>+966 11 123 4567</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Professional Border Effect -->
                    <div class="absolute inset-0 rounded-2xl border-2 border-transparent group-hover:border-green-200 transition-all duration-500"></div>
                </div>
            </div>
            @endforelse
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="py-20 bg-gradient-to-r from-green-700 to-green-800 text-white">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h2 class="text-4xl font-bold mb-6">
            {{ app()->getLocale() === 'ar' ? 'ابدأ رحلتك الاستثمارية اليوم' : 'Start Your Investment Journey Today' }}
        </h2>
        <p class="text-xl mb-8 text-green-100">
            {{ app()->getLocale() === 'ar'
                ? 'انضم إلى آلاف المستثمرين الذين يثقون بخبرتنا لتحقيق أهدافهم المالية'
                : 'Join thousands of investors who trust our expertise to achieve their financial goals'
            }}
        </p>
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <a href="{{ route('investment-application') }}" class="bg-white text-green-800 px-8 py-4 rounded-lg font-semibold hover:bg-gray-100 transition-colors">
                {{ app()->getLocale() === 'ar' ? 'ابدأ الاستثمار الآن' : 'Start Investing Now' }}
            </a>
            <a href="{{ route('contact') }}" class="border-2 border-white text-white px-8 py-4 rounded-lg font-semibold hover:bg-white hover:text-green-800 transition-colors">
                {{ app()->getLocale() === 'ar' ? 'تواصل معنا' : 'Contact Us' }}
            </a>
        </div>
    </div>
</section>
@endsection

                    <!-- Decorative Elements -->
                    <div class="absolute top-0 right-0 w-20 h-20 bg-gradient-to-br from-green-100/50 to-transparent rounded-full -translate-y-10 translate-x-10"></div>
                    <div class="absolute bottom-0 left-0 w-16 h-16 bg-gradient-to-tr from-gray-100/50 to-transparent rounded-full translate-y-8 -translate-x-8"></div>

                    <!-- Member Photo Section -->
                    <div class="relative p-6 pb-4">
                        <div class="flex justify-center mb-4">
                            <div class="relative member-photo-container">
                                <!-- Professional Photo Frame -->
                                <div class="relative w-28 h-28 rounded-xl overflow-hidden shadow-xl border-4 border-white group-hover:border-green-100 transition-all duration-500 bg-gradient-to-br from-green-700 via-green-800 to-gray-800">
                                    <!-- Inner Frame -->
                                    <div class="absolute inset-1 rounded-lg border-2 border-white/20 group-hover:border-white/40 transition-all duration-500"></div>

                                    <!-- Photo Placeholder -->
                                    <div class="w-full h-full flex items-center justify-center">
                                        <i class="fas fa-user-tie text-white text-3xl"></i>
                                    </div>

                                    <!-- Professional Overlay -->
                                    <div class="absolute inset-0 bg-gradient-to-t from-black/20 via-transparent to-transparent"></div>
                                </div>

                                <!-- Social Media Overlay - Shows on Hover -->
                                <div class="absolute inset-0 bg-black/80 rounded-xl opacity-0 group-hover:opacity-100 transition-all duration-300 flex items-center justify-center">
                                    <div class="flex space-x-3">
                                        <a href="#" class="w-8 h-8 bg-blue-600 rounded-lg flex items-center justify-center text-white hover:bg-blue-700 transition-colors transform hover:scale-110">
                                            <i class="fab fa-linkedin text-xs"></i>
                                        </a>
                                        <a href="mailto:" class="w-8 h-8 bg-gray-600 rounded-lg flex items-center justify-center text-white hover:bg-gray-700 transition-colors transform hover:scale-110">
                                            <i class="fas fa-envelope text-xs"></i>
                                        </a>
                                        <a href="tel:" class="w-8 h-8 bg-green-600 rounded-lg flex items-center justify-center text-white hover:bg-green-700 transition-colors transform hover:scale-110">
                                            <i class="fas fa-phone text-xs"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Member Info -->
                        <div class="text-center relative z-10">
                            <h3 class="text-xl font-bold text-gray-900 mb-2 group-hover:text-green-800 transition-colors duration-300">
                                {{ app()->getLocale() === 'ar' ? 'أحمد محمد الأحمد' : 'Ahmed Mohammed Al-Ahmed' }}
                            </h3>

                            <!-- Professional Position Badge -->
                            <div class="relative inline-block">
                                <div class="bg-gradient-to-r from-green-600 to-green-700 text-white px-4 py-2 rounded-lg text-sm font-semibold shadow-md relative overflow-hidden">
                                    <!-- Background Pattern -->
                                    <div class="absolute inset-0 bg-gradient-to-r from-transparent via-white/10 to-transparent transform -skew-x-12"></div>

                                    <!-- Position Text -->
                                    <span class="relative flex items-center">
                                        <i class="fas fa-crown text-yellow-300 mr-2 text-xs"></i>
                                        {{ app()->getLocale() === 'ar' ? 'رئيس مجلس الإدارة' : 'Chairman of the Board' }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Member Details -->
                    <div class="px-6 pb-6 relative z-10">
                        <p class="text-gray-600 text-center leading-relaxed mb-4 text-sm">
                            {{ app()->getLocale() === 'ar'
                                ? 'خبرة تزيد عن 20 عاماً في مجال الاستثمار والأسواق المالية مع سجل حافل من النجاحات في قيادة الشركات الاستثمارية.'
                                : 'Over 20 years of experience in investment and financial markets with a proven track record of success in leading investment companies.'
                            }}
                        </p>

                        <!-- Professional Credentials -->
                        <div class="grid grid-cols-2 gap-2 mb-4">
                            <div class="bg-green-50 rounded-lg p-2 text-center border border-green-100">
                                <i class="fas fa-clock text-green-600 text-xs mb-1"></i>
                                <div class="text-xs font-semibold text-green-800">{{ app()->getLocale() === 'ar' ? '20+ سنة' : '20+ Years' }}</div>
                                <div class="text-xs text-green-600">{{ app()->getLocale() === 'ar' ? 'خبرة' : 'Experience' }}</div>
                            </div>
                            <div class="bg-blue-50 rounded-lg p-2 text-center border border-blue-100">
                                <i class="fas fa-graduation-cap text-blue-600 text-xs mb-1"></i>
                                <div class="text-xs font-semibold text-blue-800">MBA</div>
                                <div class="text-xs text-blue-600">{{ app()->getLocale() === 'ar' ? 'إدارة أعمال' : 'Business' }}</div>
                            </div>
                        </div>

                        <!-- Contact Info (Hidden by default, shows on hover) -->
                        <div class="text-center opacity-0 group-hover:opacity-100 transition-all duration-500 transform translate-y-2 group-hover:translate-y-0">
                            <div class="text-xs text-gray-500 space-y-1">
                                <div class="flex items-center justify-center space-x-2">
                                    <i class="fas fa-envelope text-gray-400"></i>
                                    <span>ahmed@qualityinvestment.com</span>
                                </div>
                                <div class="flex items-center justify-center space-x-2">
                                    <i class="fas fa-phone text-gray-400"></i>
                                    <span>+966 11 123 4567</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Professional Border Effect -->
                    <div class="absolute inset-0 rounded-2xl border-2 border-transparent group-hover:border-green-200 transition-all duration-500"></div>
                </div>
            </div>

            <!-- Second Member -->
            <div class="group board-member-card">
                <div class="relative bg-white rounded-2xl shadow-xl hover:shadow-2xl transition-all duration-500 overflow-hidden border border-gray-100 group-hover:border-green-300 transform group-hover:-translate-y-2 group-hover:scale-102">
                    <!-- Professional Background -->
                    <div class="absolute inset-0 bg-gradient-to-br from-purple-50/50 via-white to-gray-50/30"></div>

                    <!-- Decorative Elements -->
                    <div class="absolute top-0 right-0 w-20 h-20 bg-gradient-to-br from-purple-100/50 to-transparent rounded-full -translate-y-10 translate-x-10"></div>
                    <div class="absolute bottom-0 left-0 w-16 h-16 bg-gradient-to-tr from-gray-100/50 to-transparent rounded-full translate-y-8 -translate-x-8"></div>

                    <!-- Member Photo Section -->
                    <div class="relative p-6 pb-4">
                        <div class="flex justify-center mb-4">
                            <div class="relative member-photo-container">
                                <!-- Professional Photo Frame -->
                                <div class="relative w-28 h-28 rounded-xl overflow-hidden shadow-xl border-4 border-white group-hover:border-purple-100 transition-all duration-500 bg-gradient-to-br from-purple-600 via-purple-700 to-gray-800">
                                    <!-- Inner Frame -->
                                    <div class="absolute inset-1 rounded-lg border-2 border-white/20 group-hover:border-white/40 transition-all duration-500"></div>

                                    <!-- Photo Placeholder -->
                                    <div class="w-full h-full flex items-center justify-center">
                                        <i class="fas fa-user-graduate text-white text-3xl"></i>
                                    </div>

                                    <!-- Professional Overlay -->
                                    <div class="absolute inset-0 bg-gradient-to-t from-black/20 via-transparent to-transparent"></div>
                                </div>

                                <!-- Social Media Overlay - Shows on Hover -->
                                <div class="absolute inset-0 bg-black/80 rounded-xl opacity-0 group-hover:opacity-100 transition-all duration-300 flex items-center justify-center">
                                    <div class="flex space-x-3">
                                        <a href="#" class="w-8 h-8 bg-blue-600 rounded-lg flex items-center justify-center text-white hover:bg-blue-700 transition-colors transform hover:scale-110">
                                            <i class="fab fa-linkedin text-xs"></i>
                                        </a>
                                        <a href="mailto:" class="w-8 h-8 bg-gray-600 rounded-lg flex items-center justify-center text-white hover:bg-gray-700 transition-colors transform hover:scale-110">
                                            <i class="fas fa-envelope text-xs"></i>
                                        </a>
                                        <a href="tel:" class="w-8 h-8 bg-purple-600 rounded-lg flex items-center justify-center text-white hover:bg-purple-700 transition-colors transform hover:scale-110">
                                            <i class="fas fa-phone text-xs"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Member Info -->
                        <div class="text-center relative z-10">
                            <h3 class="text-xl font-bold text-gray-900 mb-2 group-hover:text-purple-800 transition-colors duration-300">
                                {{ app()->getLocale() === 'ar' ? 'سارة عبدالله السعد' : 'Sarah Abdullah Al-Saad' }}
                            </h3>

                            <!-- Professional Position Badge -->
                            <div class="relative inline-block">
                                <div class="bg-gradient-to-r from-purple-600 to-purple-700 text-white px-4 py-2 rounded-lg text-sm font-semibold shadow-md relative overflow-hidden">
                                    <!-- Background Pattern -->
                                    <div class="absolute inset-0 bg-gradient-to-r from-transparent via-white/10 to-transparent transform -skew-x-12"></div>

                                    <!-- Position Text -->
                                    <span class="relative flex items-center">
                                        <i class="fas fa-gem text-yellow-300 mr-2 text-xs"></i>
                                        {{ app()->getLocale() === 'ar' ? 'نائب رئيس مجلس الإدارة' : 'Vice Chairman' }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Member Details -->
                    <div class="px-6 pb-6 relative z-10">
                        <p class="text-gray-600 text-center leading-relaxed mb-4 text-sm">
                            {{ app()->getLocale() === 'ar'
                                ? 'خبيرة في التخطيط الاستراتيجي وإدارة المخاطر مع خلفية قوية في الأسواق المالية والاستثمارات البديلة.'
                                : 'Expert in strategic planning and risk management with a strong background in financial markets and alternative investments.'
                            }}
                        </p>

                        <!-- Professional Credentials -->
                        <div class="grid grid-cols-2 gap-2 mb-4">
                            <div class="bg-purple-50 rounded-lg p-2 text-center border border-purple-100">
                                <i class="fas fa-clock text-purple-600 text-xs mb-1"></i>
                                <div class="text-xs font-semibold text-purple-800">{{ app()->getLocale() === 'ar' ? '15+ سنة' : '15+ Years' }}</div>
                                <div class="text-xs text-purple-600">{{ app()->getLocale() === 'ar' ? 'خبرة' : 'Experience' }}</div>
                            </div>
                            <div class="bg-blue-50 rounded-lg p-2 text-center border border-blue-100">
                                <i class="fas fa-chart-line text-blue-600 text-xs mb-1"></i>
                                <div class="text-xs font-semibold text-blue-800">CFA</div>
                                <div class="text-xs text-blue-600">{{ app()->getLocale() === 'ar' ? 'محلل مالي' : 'Financial' }}</div>
                            </div>
                        </div>

                        <!-- Contact Info (Hidden by default, shows on hover) -->
                        <div class="text-center opacity-0 group-hover:opacity-100 transition-all duration-500 transform translate-y-2 group-hover:translate-y-0">
                            <div class="text-xs text-gray-500 space-y-1">
                                <div class="flex items-center justify-center space-x-2">
                                    <i class="fas fa-envelope text-gray-400"></i>
                                    <span>sarah@qualityinvestment.com</span>
                                </div>
                                <div class="flex items-center justify-center space-x-2">
                                    <i class="fas fa-phone text-gray-400"></i>
                                    <span>+966 11 123 4568</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Professional Border Effect -->
                    <div class="absolute inset-0 rounded-2xl border-2 border-transparent group-hover:border-purple-200 transition-all duration-500"></div>
                </div>
            </div>

            <!-- Third Member -->
            <div class="group board-member-card">
                <div class="relative bg-white rounded-2xl shadow-xl hover:shadow-2xl transition-all duration-500 overflow-hidden border border-gray-100 group-hover:border-green-300 transform group-hover:-translate-y-2 group-hover:scale-102">
                    <!-- Professional Background -->
                    <div class="absolute inset-0 bg-gradient-to-br from-blue-50/50 via-white to-gray-50/30"></div>

                    <!-- Decorative Elements -->
                    <div class="absolute top-0 right-0 w-20 h-20 bg-gradient-to-br from-blue-100/50 to-transparent rounded-full -translate-y-10 translate-x-10"></div>
                    <div class="absolute bottom-0 left-0 w-16 h-16 bg-gradient-to-tr from-gray-100/50 to-transparent rounded-full translate-y-8 -translate-x-8"></div>

                    <!-- Member Photo Section -->
                    <div class="relative p-6 pb-4">
                        <div class="flex justify-center mb-4">
                            <div class="relative member-photo-container">
                                <!-- Professional Photo Frame -->
                                <div class="relative w-28 h-28 rounded-xl overflow-hidden shadow-xl border-4 border-white group-hover:border-blue-100 transition-all duration-500 bg-gradient-to-br from-blue-600 via-blue-700 to-gray-800">
                                    <!-- Inner Frame -->
                                    <div class="absolute inset-1 rounded-lg border-2 border-white/20 group-hover:border-white/40 transition-all duration-500"></div>

                                    <!-- Photo Placeholder -->
                                    <div class="w-full h-full flex items-center justify-center">
                                        <i class="fas fa-laptop-code text-white text-3xl"></i>
                                    </div>

                                    <!-- Professional Overlay -->
                                    <div class="absolute inset-0 bg-gradient-to-t from-black/20 via-transparent to-transparent"></div>
                                </div>

                                <!-- Social Media Overlay - Shows on Hover -->
                                <div class="absolute inset-0 bg-black/80 rounded-xl opacity-0 group-hover:opacity-100 transition-all duration-300 flex items-center justify-center">
                                    <div class="flex space-x-3">
                                        <a href="#" class="w-8 h-8 bg-blue-600 rounded-lg flex items-center justify-center text-white hover:bg-blue-700 transition-colors transform hover:scale-110">
                                            <i class="fab fa-linkedin text-xs"></i>
                                        </a>
                                        <a href="mailto:" class="w-8 h-8 bg-gray-600 rounded-lg flex items-center justify-center text-white hover:bg-gray-700 transition-colors transform hover:scale-110">
                                            <i class="fas fa-envelope text-xs"></i>
                                        </a>
                                        <a href="tel:" class="w-8 h-8 bg-green-600 rounded-lg flex items-center justify-center text-white hover:bg-green-700 transition-colors transform hover:scale-110">
                                            <i class="fas fa-phone text-xs"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Member Info -->
                        <div class="text-center relative z-10">
                            <h3 class="text-xl font-bold text-gray-900 mb-2 group-hover:text-blue-800 transition-colors duration-300">
                                {{ app()->getLocale() === 'ar' ? 'محمد علي الخالد' : 'Mohammed Ali Al-Khalid' }}
                            </h3>

                            <!-- Professional Position Badge -->
                            <div class="relative inline-block">
                                <div class="bg-gradient-to-r from-blue-600 to-blue-700 text-white px-4 py-2 rounded-lg text-sm font-semibold shadow-md relative overflow-hidden">
                                    <!-- Background Pattern -->
                                    <div class="absolute inset-0 bg-gradient-to-r from-transparent via-white/10 to-transparent transform -skew-x-12"></div>

                                    <!-- Position Text -->
                                    <span class="relative flex items-center">
                                        <i class="fas fa-cog text-yellow-300 mr-2 text-xs"></i>
                                        {{ app()->getLocale() === 'ar' ? 'عضو مجلس الإدارة' : 'Board Member' }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Member Details -->
                    <div class="px-6 pb-6 relative z-10">
                        <p class="text-gray-600 text-center leading-relaxed mb-4 text-sm">
                            {{ app()->getLocale() === 'ar'
                                ? 'متخصص في التكنولوجيا المالية والابتكار مع خبرة واسعة في تطوير الحلول الاستثمارية الرقمية.'
                                : 'Specialist in financial technology and innovation with extensive experience in developing digital investment solutions.'
                            }}
                        </p>

                        <!-- Professional Credentials -->
                        <div class="grid grid-cols-2 gap-2 mb-4">
                            <div class="bg-blue-50 rounded-lg p-2 text-center border border-blue-100">
                                <i class="fas fa-clock text-blue-600 text-xs mb-1"></i>
                                <div class="text-xs font-semibold text-blue-800">{{ app()->getLocale() === 'ar' ? '12+ سنة' : '12+ Years' }}</div>
                                <div class="text-xs text-blue-600">{{ app()->getLocale() === 'ar' ? 'خبرة' : 'Experience' }}</div>
                            </div>
                            <div class="bg-purple-50 rounded-lg p-2 text-center border border-purple-100">
                                <i class="fas fa-laptop-code text-purple-600 text-xs mb-1"></i>
                                <div class="text-xs font-semibold text-purple-800">FinTech</div>
                                <div class="text-xs text-purple-600">{{ app()->getLocale() === 'ar' ? 'تكنولوجيا' : 'Technology' }}</div>
                            </div>
                        </div>

                        <!-- Contact Info (Hidden by default, shows on hover) -->
                        <div class="text-center opacity-0 group-hover:opacity-100 transition-all duration-500 transform translate-y-2 group-hover:translate-y-0">
                            <div class="text-xs text-gray-500 space-y-1">
                                <div class="flex items-center justify-center space-x-2">
                                    <i class="fas fa-envelope text-gray-400"></i>
                                    <span>mohammed@qualityinvestment.com</span>
                                </div>
                                <div class="flex items-center justify-center space-x-2">
                                    <i class="fas fa-phone text-gray-400"></i>
                                    <span>+966 11 123 4569</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Professional Border Effect -->
                    <div class="absolute inset-0 rounded-2xl border-2 border-transparent group-hover:border-blue-200 transition-all duration-500"></div>
                            <a href="#" class="w-10 h-10 bg-gradient-to-r from-blue-600 to-blue-700 rounded-xl flex items-center justify-center text-white hover:from-blue-700 hover:to-blue-800 transition-all duration-300 transform hover:scale-110 shadow-lg">
                                <i class="fab fa-linkedin text-sm"></i>
                            </a>
                            <a href="#" class="w-10 h-10 bg-gradient-to-r from-gray-600 to-gray-700 rounded-xl flex items-center justify-center text-white hover:from-gray-700 hover:to-gray-800 transition-all duration-300 transform hover:scale-110 shadow-lg">
                                <i class="fas fa-envelope text-sm"></i>
                            </a>
                            <a href="#" class="w-10 h-10 bg-gradient-to-r from-green-600 to-green-700 rounded-xl flex items-center justify-center text-white hover:from-green-700 hover:to-green-800 transition-all duration-300 transform hover:scale-110 shadow-lg">
                                <i class="fas fa-phone text-sm"></i>
                            </a>
                        </div>
                    </div>

                    <!-- Hover Overlay Effect -->
                    <div class="absolute inset-0 bg-gradient-to-t from-blue-600/5 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                </div>
            </div>
        </div>
    </div>
</section>
@endif

<!-- Call to Action -->
<section class="py-20 bg-gradient-to-r from-green-600 to-blue-600 text-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h2 class="text-4xl font-bold mb-6">
            {{ app()->getLocale() === 'ar' ? 'هل أنت مستعد للبدء؟' : 'Ready to Get Started?' }}
        </h2>
        <p class="text-xl mb-8 max-w-3xl mx-auto">
            {{ app()->getLocale() === 'ar'
                ? 'انضم إلى آلاف المستثمرين الذين يثقون بخبرتنا في تحقيق أهدافهم المالية'
                : 'Join thousands of investors who trust our expertise in achieving their financial goals'
            }}
        </p>
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <a href="{{ route('investment-application.create') }}"
               class="bg-white text-green-600 px-8 py-4 rounded-xl font-bold hover:bg-gray-100 transition-colors transform hover:scale-105 shadow-lg">
                <i class="fas fa-chart-line mr-2"></i>
                {{ app()->getLocale() === 'ar' ? 'ابدأ الاستثمار الآن' : 'Start Investing Now' }}
            </a>
            <a href="{{ route('contact') }}"
               class="border-2 border-white text-white px-8 py-4 rounded-xl font-bold hover:bg-white hover:text-green-600 transition-colors transform hover:scale-105">
                <i class="fas fa-phone mr-2"></i>
                {{ app()->getLocale() === 'ar' ? 'تواصل معنا' : 'Contact Us' }}
            </a>
        </div>
    </div>
</section>
@endsection

@extends('layouts.public')

@section('title', app()->getLocale() === 'ar' ? 'آلية الإستثمار' : 'Investment mechanism')
@section('description', app()->getLocale() === 'ar' ? 'تعرف على شركة الجودة للاستثمار ورؤيتنا ورسالتنا وفريق الإدارة' : 'Learn about Quality Investment Company, our vision, mission, and management team')

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
                {{ app()->getLocale() === 'ar' ? 'آلية الإستثمار' : 'Investment mechanism' }}
            </h1>
            <p class="text-xl md:text-2xl text-gray-200 max-w-4xl mx-auto">
                {{ app()->getLocale() === 'ar'
                    ? 'تعرف على قصتنا ورؤيتنا في عالم الاستثمار والنمو المستدام'
                    : 'Discover our story and vision in the world of investment and sustainable growth'
                }}
            </p>
        </div>
    </div>
</section>

<section class="content">

</section>


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

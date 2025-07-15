<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}"
      dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}"
      class="{{ app()->getLocale() === 'ar' ? 'font-arabic' : '' }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', config('app.name', ($company ? $company->getLocalizedName() : 'Quality Investment')))</title>
    <meta name="description" content="@yield('description', 'Quality Investment Company - Leading investment solutions in Saudi Arabia')">
    <meta name="keywords" content="@yield('keywords', 'investment, finance, Saudi Arabia, quality investment')">

    <!-- Favicon -->
    @php
        $company = \App\Models\Company::first();
    @endphp
    @if($company && $company->favicon)
        <link rel="icon" type="image/x-icon" href="{{ asset('storage/' . $company->favicon) }}">
        <link rel="shortcut icon" type="image/x-icon" href="{{ asset('storage/' . $company->favicon) }}">
        @if(pathinfo($company->favicon, PATHINFO_EXTENSION) === 'png')
            <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('storage/' . $company->favicon) }}">
            <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('storage/' . $company->favicon) }}">
        @endif
    @else
        <!-- Default favicon -->
        <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
    @endif

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@300;400;500;700;800&display=swap"
        rel="stylesheet">

    <!-- Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        /* Mobile Overflow Fix - Critical CSS */
        html, body {
            overflow-x: hidden;
            max-width: 100vw;
        }

        * {
            box-sizing: border-box;
        }

        /* Prevent unwanted scrollbars - keep natural behavior */
        section, .container {
            overflow: visible;
        }

        /* Only hide horizontal overflow on body and html */
        body {
            overflow-y: auto;
            overflow-x: hidden;
        }

        html {
            overflow-y: auto;
            overflow-x: hidden;
        }

        /* RTL Support */
        [dir="rtl"] {
            text-align: right;
        }

        /* Navbar RTL Support */
        [dir="rtl"] .navbar-container {
            direction: rtl;
        }

        [dir="rtl"] .navbar-container .flex.items-center.justify-between {
            flex-direction: row-reverse;
        }

        /* Desktop Navigation RTL */
        [dir="rtl"] .hidden.md\\:flex.md\\:space-x-8 {
            flex-direction: row-reverse;
        }

        [dir="rtl"] .hidden.md\\:flex.md\\:space-x-8 > * + * {
            margin-left: 0;
            margin-right: 2rem;
        }

        /* Right side items RTL */
        [dir="rtl"] .flex.items-center.space-x-6 {
            flex-direction: row-reverse;
        }

        [dir="rtl"] .flex.items-center.space-x-6 > * + * {
            margin-left: 0;
            margin-right: 1.5rem;
        }

        /* Language switcher RTL */
        [dir="rtl"] .flex.items-center.space-x-2 {
            flex-direction: row-reverse;
        }

        [dir="rtl"] .flex.items-center.space-x-2 > * + * {
            margin-left: 0;
            margin-right: 0.5rem;
        }

        /* Mobile menu button positioning */
        [dir="rtl"] .md\\:hidden {
            order: -1;
        }

        /* Mobile Menu RTL Support */
        [dir="rtl"] .mobile-menu {
            direction: rtl;
        }

        [dir="rtl"] .mobile-menu .flex.items-center.space-x-4 {
            flex-direction: row-reverse;
        }

        [dir="rtl"] .mobile-menu .flex.items-center.space-x-4 > * + * {
            margin-left: 0;
            margin-right: 1rem;
        }

        /* Mobile menu arrow direction */
        [dir="rtl"] .mobile-menu .fa-arrow-right:before {
            content: "\f060"; /* fa-arrow-left */
        }

        /* Mobile menu text alignment */
        [dir="rtl"] .mobile-menu .text-sm {
            text-align: right;
        }

        /* Force RTL for Arabic */
        html[lang="ar"] {
            direction: rtl !important;
        }

        html[lang="en"] {
            direction: ltr !important;
        }

        /* Navbar specific RTL fixes */
        [dir="rtl"] .navbar-container .flex {
            flex-direction: row-reverse;
        }

        [dir="rtl"] .navbar-container .space-x-8 > * + * {
            margin-left: 0 !important;
            margin-right: 2rem !important;
        }

        [dir="rtl"] .navbar-container .space-x-6 > * + * {
            margin-left: 0 !important;
            margin-right: 1.5rem !important;
        }

        [dir="rtl"] .navbar-container .space-x-2 > * + * {
            margin-left: 0 !important;
            margin-right: 0.5rem !important;
        }

        /* Additional RTL fixes for immediate application */
        html[dir="rtl"] .navbar-container {
            direction: rtl !important;
        }

        html[dir="rtl"] .mobile-menu {
            direction: rtl !important;
        }

        html[dir="rtl"] .flex.items-center.space-x-8,
        html[dir="rtl"] .flex.items-center.space-x-6,
        html[dir="rtl"] .flex.items-center.space-x-4,
        html[dir="rtl"] .flex.items-center.space-x-2 {
            flex-direction: row-reverse !important;
        }

        html[dir="rtl"] .space-x-8 > * + *,
        html[dir="rtl"] .space-x-6 > * + *,
        html[dir="rtl"] .space-x-4 > * + *,
        html[dir="rtl"] .space-x-2 > * + * {
            margin-left: 0 !important;
        }

        html[dir="rtl"] .space-x-8 > * + * {
            margin-right: 2rem !important;
        }

        html[dir="rtl"] .space-x-6 > * + * {
            margin-right: 1.5rem !important;
        }

        html[dir="rtl"] .space-x-4 > * + * {
            margin-right: 1rem !important;
        }

        html[dir="rtl"] .space-x-2 > * + * {
            margin-right: 0.5rem !important;
        }

        /* RTL Navbar Layout Fix - Reverse the entire navbar structure */
        html[dir="rtl"] .navbar-container .flex.items-center.justify-between {
            flex-direction: row-reverse !important;
        }

        /* RTL Logo positioning */
        html[dir="rtl"] .navbar-container .flex.items-center.flex-shrink-0 {
            order: 3 !important; /* Move logo to the right */
        }

        /* RTL Navigation menu positioning */
        html[dir="rtl"] .navbar-container .hidden.md\\:flex.md\\:space-x-8 {
            order: 2 !important; /* Keep navigation in center */
        }

        /* RTL Right side elements positioning */
        html[dir="rtl"] .navbar-container .flex.items-center.space-x-6 {
            order: 1 !important; /* Move language/CTA to the left */
        }

        /* Additional RTL fixes for immediate effect */
        [dir="rtl"] .navbar-container .flex.items-center.justify-between {
            flex-direction: row-reverse !important;
        }

        [dir="rtl"] .navbar-container .flex.items-center.flex-shrink-0 {
            order: 3 !important;
        }

        [dir="rtl"] .navbar-container .hidden.md\\:flex.md\\:space-x-8 {
            order: 2 !important;
        }

        [dir="rtl"] .navbar-container .flex.items-center.space-x-6 {
            order: 1 !important;
        }

        /* RTL Mobile menu button positioning */
        [dir="rtl"] .md\\:hidden {
            order: 1 !important;
        }

        /* Force RTL layout with higher specificity */
        html[lang="ar"] .navbar-container .flex.items-center.justify-between {
            flex-direction: row-reverse !important;
        }

        html[lang="ar"] .navbar-container .flex.items-center.flex-shrink-0 {
            order: 3 !important;
        }

        html[lang="ar"] .navbar-container .hidden.md\\:flex.md\\:space-x-8 {
            order: 2 !important;
        }

        html[lang="ar"] .navbar-container .flex.items-center.space-x-6 {
            order: 1 !important;
        }

        html[lang="ar"] .md\\:hidden {
            order: 1 !important;
        }

        .font-english {
            font-family: 'Inter', sans-serif;
        }

        .font-arabic {
            font-family: 'Tajawal', sans-serif;
        }

        /* Custom animations */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes slideInRight {
            from {
                opacity: 0;
                transform: translateX(30px);
            }

            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        .animate-fade-in-up {
            animation: fadeInUp 0.6s ease-out;
        }

        .animate-slide-in-right {
            animation: slideInRight 0.6s ease-out;
        }

        /* Gradient backgrounds - Updated for brand colors */
        .bg-gradient-investment {
            background: linear-gradient(135deg, #1a5f3f 0%, #2d3748 100%);
        }

        .bg-gradient-brand {
            background: linear-gradient(135deg, #22543d 0%, #1a202c 100%);
        }

        .bg-gradient-gold {
            background: linear-gradient(135deg, #22543d 0%, #2f855a 100%);
        }

        /* Custom scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
        }

        ::-webkit-scrollbar-track {
            background: #f1f1f1;
        }

        ::-webkit-scrollbar-thumb {
            background: #888;
            border-radius: 4px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: #555;
        }

        /* Navbar Styles - Enhanced Solution 2 */
        .navbar-transparent {
            background: linear-gradient(135deg, rgba(255, 255, 255, 0.25), rgba(255, 255, 255, 0.15));
            backdrop-filter: blur(25px);
            border-bottom: 1px solid rgba(255, 255, 255, 0.2);
            box-shadow: 0 2px 20px rgba(0, 0, 0, 0.1);
        }

        .navbar-solid {
            background: rgb(255, 255, 255);
            backdrop-filter: blur(20px);
            border-bottom: 1px solid rgba(0, 0, 0, 0.1);
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        }

        .navbar-text {
            color: #1f2937;
            font-weight: 600;
            text-shadow: 0 1px 2px rgba(255, 255, 255, 0.8);
            transition: all 0.3s ease;
        }

        .navbar-text.scrolled {
            color: #1f2937;
            text-shadow: none;
        }

        .navbar-link {
            color: #fdfdfd;
            font-weight: 500;
            transition: all 0.3s ease;
            position: relative;
        }

        .navbar-link.scrolled {
            color: #4b5563;
            text-shadow: none;
        }

        .navbar-link:hover {
            color: #ffffff;
            transform: translateY(-1px);
        }

        .navbar-link.scrolled:hover {
            background-color: rgba(34, 197, 94, 0.1);
            color: #16a34a;
        }

        .active-link {
            color: #ffffff !important;
            font-weight: 700;
        }

        .active-link.scrolled {
            background-color: rgba(34, 197, 94, 0.15);
            color: #16a34a !important;
        }

        .logo-with-border-enhanced {
            /* filter: drop-shadow(0 0 0 white) drop-shadow(1px 0 0 white) drop-shadow(-1px 0 0 white) drop-shadow(0 1px 0 white) drop-shadow(0 -1px 0 white); */
            height: 80px;
        }

        .logo-with-border{
            /* filter: drop-shadow(0 0 0 white) drop-shadow(1px 0 0 white) drop-shadow(-1px 0 0 white) drop-shadow(0 1px 0 white) drop-shadow(0 -1px 0 white); */
            height: 100px;
        }

        @media (max-width: 768px) {
             .logo-with-border-enhanced {
                height: 50px;
            }
        }

        /* Page Header Styles */
        .page-header {
            padding-top: 8rem;
            padding-bottom: 8rem;
            min-height: 60vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        @media (max-width: 768px) {
            .page-header {
                padding-top: 6rem;
                padding-bottom: 6rem;
                min-height: 50vh;
            }
        }

        /* Utility Classes */
        .line-clamp-2 {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .line-clamp-3 {
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        /* Animation Classes */
        .animate-fadeIn {
            animation: fadeIn 0.5s ease-in-out;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Prose Styles for Article Content */
        .prose {
            color: #374151;
            line-height: 1.75;
        }

        .prose h1,
        .prose h2,
        .prose h3,
        .prose h4 {
            color: #111827;
            font-weight: 700;
            margin-top: 2rem;
            margin-bottom: 1rem;
        }

        .prose h1 {
            font-size: 2.25rem;
        }

        .prose h2 {
            font-size: 1.875rem;
        }

        .prose h3 {
            font-size: 1.5rem;
        }

        .prose h4 {
            font-size: 1.25rem;
        }

        .prose p {
            margin-bottom: 1.5rem;
        }

        .prose ul,
        .prose ol {
            margin-bottom: 1.5rem;
            padding-left: 1.5rem;
        }

        .prose li {
            margin-bottom: 0.5rem;
        }

        .prose blockquote {
            border-left: 4px solid #10b981;
            padding-left: 1rem;
            margin: 2rem 0;
            font-style: italic;
            color: #6b7280;
        }

        /* Duplicate styles removed - using main navbar styles above */

        .active-link::after {
            content: '';
            position: absolute;
            bottom: -2px;
            left: 50%;
            transform: translateX(-50%);
            width: 20px;
            height: 2px;
            background: currentColor;
            border-radius: 1px;
        }

        /* Smooth transitions */
        #navbar * {
            transition: all 0.3s ease;
        }

        /* Mobile responsive fixes */
        @media (max-width: 768px) {
            /* Logo positioning for mobile */
            .logo-container {
                margin-right: auto;
                margin-left: 0;
                flex: 0 0 auto;
            }

            .logo-container img {
                height: 65px !important;
            }

            /* Navbar mobile layout */
            .navbar .max-w-7xl > .flex {
                justify-content: space-between;
                align-items: center;
                gap: 0.5rem;
                padding-left: 0.5rem;
                padding-right: 0.5rem;
            }

            /* Logo section - left aligned */
            .navbar .max-w-7xl > .flex > div:first-child {
                flex: 0 0 auto;
                order: 1;
                margin-right: auto;
            }

            /* Right side controls */
            .navbar .max-w-7xl > .flex > div:last-child {
                flex: 0 0 auto;
                order: 3;
                display: flex;
                align-items: center;
                gap: 0.25rem;
            }

            /* Language switcher mobile */
            .navbar .flex.items-center.space-x-6 {
                space-x: 0.25rem;
            }

            /* Mobile menu button positioning */
            .mobile-menu-button {
                order: 4;
                margin-left: 0.5rem;
            }
        }

        /* RTL Fixes */
        [dir="rtl"] .flex.items-center.space-x-2 {
            flex-direction: row-reverse;
        }

        [dir="rtl"] .flex.items-center.space-x-4 {
            flex-direction: row-reverse;
        }

        [dir="rtl"] .flex.items-center.space-x-6 {
            flex-direction: row-reverse;
        }

        [dir="rtl"] .space-x-2 > * + * {
            margin-left: 0;
            margin-right: 0.5rem;
        }

        [dir="rtl"] .space-x-4 > * + * {
            margin-left: 0;
            margin-right: 1rem;
        }

        [dir="rtl"] .space-x-6 > * + * {
            margin-left: 0;
            margin-right: 1.5rem;
        }

        /* RTL Language switcher and mobile menu spacing */
        [dir="rtl"] .navbar .flex.items-center.space-x-6 {
            gap: 1rem;
        }

        [dir="rtl"] .mobile-menu-button {
            margin-left: 0;
            margin-right: 0.5rem;
        }

        /* RTL Mobile menu items */
        [dir="rtl"] .mobile-menu .flex.items-center.space-x-4 {
            flex-direction: row-reverse;
        }

        [dir="rtl"] .mobile-menu .space-x-4 > * + * {
            margin-left: 0;
            margin-right: 1rem;
        }

        /* RTL Progress steps */
        [dir="rtl"] .progress-steps {
            flex-direction: row-reverse;
        }

        [dir="rtl"] .progress-steps .space-x-2 > * + * {
            margin-left: 0;
            margin-right: 0.5rem;
        }

        [dir="rtl"] .progress-steps .space-x-4 > * + * {
            margin-left: 0;
            margin-right: 1rem;
        }

        /* Mobile Menu Scrolling Support */
        .mobile-menu {
            height: 100vh;
            height: 100dvh; /* Dynamic viewport height for mobile browsers */
        }

        .mobile-menu .flex.flex-col {
            height: 100%;
        }

        .mobile-menu .overflow-y-auto {
            max-height: calc(100vh - 120px); /* Account for header height */
            max-height: calc(100dvh - 120px);
            -webkit-overflow-scrolling: touch; /* Smooth scrolling on iOS */
            scrollbar-width: thin; /* Firefox */
            scrollbar-color: rgba(156, 163, 175, 0.5) transparent; /* Firefox */
        }

        /* Custom scrollbar for webkit browsers */
        .mobile-menu .overflow-y-auto::-webkit-scrollbar {
            width: 6px;
        }

        .mobile-menu .overflow-y-auto::-webkit-scrollbar-track {
            background: transparent;
        }

        .mobile-menu .overflow-y-auto::-webkit-scrollbar-thumb {
            background-color: rgba(156, 163, 175, 0.5);
            border-radius: 3px;
        }

        .mobile-menu .overflow-y-auto::-webkit-scrollbar-thumb:hover {
            background-color: rgba(156, 163, 175, 0.7);
        }

        /* Ensure mobile menu items have proper spacing */
        .mobile-menu .space-y-4 > * + * {
            margin-top: 1rem;
        }

        /* Mobile menu fade in/out animation */
        .mobile-menu.hidden {
            opacity: 0;
            visibility: hidden;
            transform: translateY(-10px);
        }

        .mobile-menu:not(.hidden) {
            opacity: 1;
            visibility: visible;
            transform: translateY(0);
        }
    </style>

    @stack('styles')
</head>

<body class="antialiased {{ app()->getLocale() === 'ar' ? 'font-arabic' : 'font-english' }}">
    <!-- Modern Enhanced Navigation -->
    <nav id="navbar" class="fixed top-0 left-0 right-0 z-50 transition-all duration-300 ease-in-out navbar-transparent">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 navbar-container">
            <div class="flex items-center justify-between h-20" style="{{ app()->getLocale() === 'ar' ? 'flex-direction: row-reverse !important;' : '' }}">
                <!-- Logo Section -->
                <div class="flex items-center flex-shrink-0" style="{{ app()->getLocale() === 'ar' ? 'order: 3;' : 'order: 1;' }}">
                    <!-- Logo -->
                    <div class="flex-shrink-0 flex items-center">
                        <a href="{{ route('home') }}" class="flex items-center">
                            @php
                                $company = \App\Models\Company::first();
                            @endphp
                            @if ($company && $company->logo)
                                <div class="logo-container transition-all duration-300">
                                    <img src="{{ asset('storage/' . $company->logo) }}"
                                        alt="{{ app()->getLocale() === 'ar' ? $company->getLocalizedName() : $company->getLocalizedName() }}"
                                        class=" w-auto object-contain logo-with-border-enhanced">
                                </div>
                            @else
                                <div
                                    class="w-12 h-12 bg-gradient-to-br from-green-700 to-gray-900 rounded-xl flex items-center justify-center shadow-lg transform hover:scale-105 transition-transform logo-with-border">
                                    <i class="fas fa-chart-line text-white text-xl"></i>
                                </div>
                            @endif
                        </a>
                    </div>
                </div>

                <!-- Centered Desktop Navigation -->
                <div class="hidden md:flex md:space-x-8 flex-1 justify-center" style="{{ app()->getLocale() === 'ar' ? 'order: 2;' : 'order: 2;' }}">
                    <a href="{{ route('home') }}"
                        class="navbar-link px-4 py-2 text-sm font-semibold transition-all duration-300 rounded-lg {{ request()->routeIs('home') ? 'active-link' : '' }}">
                        {{ __('public.home') }}
                    </a>
                    <a href="{{ route('about') }}"
                        class="navbar-link px-4 py-2 text-sm font-semibold transition-all duration-300 rounded-lg {{ request()->routeIs('about') ? 'active-link' : '' }}">
                        {{ __('public.about') }}
                    </a>



                    @if(\App\Models\SiteSetting::get('news_page_enabled', true))
                    <a href="{{ route('news') }}"
                        class="navbar-link px-4 py-2 text-sm font-semibold transition-all duration-300 rounded-lg {{ request()->routeIs('news*') ? 'active-link' : '' }}">
                        {{ app()->getLocale() === 'ar' ? 'الأخبار' : 'News' }}
                    </a>
                    @endif

                    @php
                        $navbarPages = \App\Models\Page::active()->navbar()->orderBy('sort_order')->get();
                    @endphp
                    @foreach($navbarPages as $navPage)
                        <a href="{{ route('page.show', $navPage->getLocalizedSlug()) }}"
                            class="navbar-link px-4 py-2 text-sm font-semibold transition-all duration-300 rounded-lg {{ request()->is('page/' . $navPage->getLocalizedSlug()) ? 'active-link' : '' }}">
                            {{ $navPage->getLocalizedName() }}
                        </a>
                    @endforeach

                    <a href="{{ route('contact') }}"
                        class="navbar-link px-4 py-2 text-sm font-semibold transition-all duration-300 rounded-lg {{ request()->routeIs('contact') ? 'active-link' : '' }}">
                        {{ __('public.contact') }}
                    </a>
                    <a href="{{ route('investment-application.create') }}"
                        class="navbar-link px-4 py-2 text-sm font-semibold transition-all duration-300 rounded-lg {{ request()->routeIs('investment-application.*') ? 'active-link' : '' }}">
                        {{ __('public.investment_application') }}
                    </a>
                </div>

                <!-- Right side -->
                <div class="flex items-center space-x-6" style="{{ app()->getLocale() === 'ar' ? 'order: 1;' : 'order: 3;' }}">
                    <!-- Language Switcher -->
                    <div class="relative">
                        <a href="{{ route('language.switch', app()->getLocale() === 'ar' ? 'en' : 'ar') }}"
                            class="flex items-center space-x-2 px-3 py-2 rounded-lg transition-all duration-300 bg-white/20 hover:bg-white/30 border border-white/20 backdrop-blur-sm"
                            title="{{ __('public.toggle_language') }}">
                            <i class="fas fa-globe text-lg text-gray-700"></i>
                            <span class="text-sm font-medium text-gray-700">{{ app()->getLocale() === 'ar' ? __('public.english') : __('public.arabic') }}</span>
                        </a>
                    </div>

                    <!-- CTA Button -->
                    <div class="hidden md:block">
                        <a href="{{ route('investment-application.create') }}"
                            class="bg-gradient-to-r from-green-700 to-gray-800 text-white px-6 py-3 rounded-xl font-semibold hover:shadow-lg transform hover:scale-105 transition-all duration-300 border border-white/20 backdrop-blur-sm">
                            {{ app()->getLocale() === 'ar' ? 'ابدأ الاستثمار' : 'Start Investing' }}
                        </a>
                    </div>

                    <!-- Mobile menu button -->
                    <div class="md:hidden">
                        <button type="button"
                            class="mobile-menu-button p-3 rounded-xl backdrop-blur-sm bg-white/20 hover:bg-white/30 focus:outline-none focus:ring-2 focus:ring-white/50 transition-all duration-300 border border-white/20">
                            <i class="fas fa-bars text-xl menu-icon text-gray-700"></i>
                            <i class="fas fa-times text-xl close-icon hidden text-gray-700"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Mobile Navigation -->
        <div class="mobile-menu hidden md:hidden fixed inset-0 z-50 transform transition-all duration-300 ease-in-out" dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}">
            <div class="bg-white/95 backdrop-blur-xl shadow-2xl h-full flex flex-col">
                <!-- Mobile Header -->
                <div class="flex items-center justify-between p-6 border-b border-gray-200/50">
                    <div class="flex items-center space-x-3">
                        @if ($company && $company->logo)
                            <img src="{{ asset('storage/' . $company->logo) }}"
                                alt="{{ $company->getLocalizedName() }}" class="h-20 w-auto object-contain">
                        @endif

                    </div>
                    <button type="button"
                        class="mobile-menu-close p-2 rounded-xl bg-gray-100 hover:bg-gray-200 transition-colors">
                        <i class="fas fa-times text-xl text-gray-600"></i>
                    </button>
                </div>

                <!-- Mobile Menu Items - With Scrolling Support -->
                <div class="flex-1 overflow-y-auto px-6 py-8 space-y-4">
                    <a href="{{ route('home') }}"
                        class="flex items-center space-x-4 p-4 rounded-xl hover:bg-gradient-to-r hover:from-green-50 hover:to-blue-50 transition-all duration-300 group {{ request()->routeIs('home') ? 'bg-gradient-to-r from-green-100 to-blue-100 text-green-700' : 'text-gray-700' }}">
                        <div
                            class="w-10 h-10 rounded-lg bg-green-100 flex items-center justify-center group-hover:bg-green-200 transition-colors">
                            <i class="fas fa-home text-green-600"></i>
                        </div>
                        <div>
                            <div class="font-semibold">{{ __('public.home') }}</div>
                            <div class="text-sm text-gray-500">
                                {{ app()->getLocale() === 'ar' ? 'الصفحة الرئيسية' : 'Main page' }}</div>
                        </div>
                    </a>

                    <a href="{{ route('about') }}"
                        class="flex items-center space-x-4 p-4 rounded-xl hover:bg-gradient-to-r hover:from-green-50 hover:to-blue-50 transition-all duration-300 group {{ request()->routeIs('about') ? 'bg-gradient-to-r from-green-100 to-blue-100 text-green-700' : 'text-gray-700' }}">
                        <div
                            class="w-10 h-10 rounded-lg bg-blue-100 flex items-center justify-center group-hover:bg-blue-200 transition-colors">
                            <i class="fas fa-info-circle text-blue-600"></i>
                        </div>
                        <div>
                            <div class="font-semibold">{{ __('About Us') }}</div>
                            <div class="text-sm text-gray-500">
                                {{ app()->getLocale() === 'ar' ? 'معلومات عن الشركة' : 'Company information' }}</div>
                        </div>
                    </a>

                    <a href="{{ route('board-directors') }}"
                        class="flex items-center space-x-4 p-4 rounded-xl hover:bg-gradient-to-r hover:from-green-50 hover:to-blue-50 transition-all duration-300 group {{ request()->routeIs('board-directors') ? 'bg-gradient-to-r from-green-100 to-blue-100 text-green-700' : 'text-gray-700' }}">
                        <div
                            class="w-10 h-10 rounded-lg bg-purple-100 flex items-center justify-center group-hover:bg-purple-200 transition-colors">
                            <i class="fas fa-users text-purple-600"></i>
                        </div>
                        <div>
                            <div class="font-semibold">{{ app()->getLocale() === 'ar' ? 'مجلس الإدارة' : 'Board of Directors' }}</div>
                            <div class="text-sm text-gray-500">
                                {{ app()->getLocale() === 'ar' ? 'أعضاء مجلس الإدارة' : 'Our leadership team' }}</div>
                        </div>
                    </a>

                    @if(\App\Models\SiteSetting::get('news_page_enabled', true))
                    <a href="{{ route('news') }}"
                        class="flex items-center space-x-4 p-4 rounded-xl hover:bg-gradient-to-r hover:from-green-50 hover:to-blue-50 transition-all duration-300 group {{ request()->routeIs('news*') ? 'bg-gradient-to-r from-green-100 to-blue-100 text-green-700' : 'text-gray-700' }}">
                        <div
                            class="w-10 h-10 rounded-lg bg-indigo-100 flex items-center justify-center group-hover:bg-indigo-200 transition-colors">
                            <i class="fas fa-newspaper text-indigo-600"></i>
                        </div>
                        <div>
                            <div class="font-semibold">{{ app()->getLocale() === 'ar' ? 'الأخبار' : 'News' }}</div>
                            <div class="text-sm text-gray-500">
                                {{ app()->getLocale() === 'ar' ? 'آخر الأخبار والتحديثات' : 'Latest news and updates' }}</div>
                        </div>
                    </a>
                    @endif

                    @foreach($navbarPages as $navPage)
                        <a href="{{ route('page.show', $navPage->getLocalizedSlug()) }}"
                            class="flex items-center space-x-4 p-4 rounded-xl hover:bg-gradient-to-r hover:from-green-50 hover:to-blue-50 transition-all duration-300 group {{ request()->is('page/' . $navPage->getLocalizedSlug()) ? 'bg-gradient-to-r from-green-100 to-blue-100 text-green-700' : 'text-gray-700' }}">
                            <div class="w-10 h-10 rounded-lg bg-purple-100 flex items-center justify-center group-hover:bg-purple-200 transition-colors">
                                <i class="fas fa-file-alt text-purple-600"></i>
                            </div>
                            <div>
                                <div class="font-semibold">{{ $navPage->getLocalizedName() }}</div>
                                @if($navPage->getLocalizedDescription())
                                <div class="text-sm text-gray-500">{{ Str::limit($navPage->getLocalizedDescription(), 40) }}</div>
                                @endif
                            </div>
                        </a>
                    @endforeach

                    <a href="{{ route('contact') }}"
                        class="flex items-center space-x-4 p-4 rounded-xl hover:bg-gradient-to-r hover:from-green-50 hover:to-blue-50 transition-all duration-300 group {{ request()->routeIs('contact') ? 'bg-gradient-to-r from-green-100 to-blue-100 text-green-700' : 'text-gray-700' }}">
                        <div
                            class="w-10 h-10 rounded-lg bg-orange-100 flex items-center justify-center group-hover:bg-orange-200 transition-colors">
                            <i class="fas fa-envelope text-orange-600"></i>
                        </div>
                        <div>
                            <div class="font-semibold">{{ __('Contact') }}</div>
                            <div class="text-sm text-gray-500">
                                {{ app()->getLocale() === 'ar' ? 'تواصل معنا' : 'Get in touch' }}</div>
                        </div>
                    </a>

                    <!-- Investment Application - Special Button -->
                    <div class="pt-4 border-t border-gray-200">
                        <a href="{{ route('investment-application.create') }}"
                            class="flex items-center space-x-4 p-4 rounded-xl bg-gradient-to-r from-green-600 to-blue-600 text-white hover:from-green-700 hover:to-blue-700 transition-all duration-300 transform hover:scale-105 shadow-lg {{ request()->routeIs('investment-application.*') ? 'ring-2 ring-green-300' : '' }}">
                            <div class="w-10 h-10 rounded-lg bg-white/20 flex items-center justify-center">
                                <i class="fas fa-chart-line text-white"></i>
                            </div>
                            <div class="flex-1">
                                <div class="font-bold">{{ app()->getLocale() === 'ar' ? 'طلب استثمار' : 'Apply Now' }}
                                </div>
                                <div class="text-sm text-white/80">
                                    {{ app()->getLocale() === 'ar' ? 'ابدأ رحلتك الاستثمارية' : 'Start your investment journey' }}
                                </div>
                            </div>
                            <div>
                                <i class="fas fa-arrow-right text-white"></i>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <!-- Company Info -->
                <div class="col-span-1 md:col-span-2">
                    <div class="flex items-center justify-center space-x-3 mb-4">
                        @php
                            $company = \App\Models\Company::first();
                        @endphp
                        @if ($company && $company->logo)
                            <img src="{{ asset('storage/' . $company->logo) }}"
                                alt="{{ $company->getLocalizedName() }}"
                                class="h-10 w-auto object-contain logo-with-border">
                        @else
                            <div
                                class="w-12 h-12 bg-gradient-to-br from-green-700 to-gray-900 rounded-lg flex items-center justify-center">
                                <i class="fas fa-chart-line text-white text-xl"></i>
                            </div>
                        @endif

                    </div>
                    <p class="text-gray-300 mb-4 leading-relaxed">
                        {{ app()->getLocale() === 'ar'
                            ? 'شركة رائدة في مجال الاستثمار في المملكة العربية السعودية، نقدم حلول استثمارية شاملة وخدمات مالية متميزة.'
                            : 'A leading investment company in Saudi Arabia, providing comprehensive investment solutions and exceptional financial services.' }}
                    </p>
                    <div class="flex space-x-4">
                        @php
                            $facebook = \App\Models\SiteSetting::get('facebook_url');
                            $twitter = \App\Models\SiteSetting::get('twitter_url');
                            $linkedin = \App\Models\SiteSetting::get('linkedin_url');
                            $instagram = \App\Models\SiteSetting::get('instagram_url');
                            $youtube = \App\Models\SiteSetting::get('youtube_url');
                        @endphp
                        @if ($facebook)
                            <a href="{{ $facebook }}" target="_blank"
                                class="text-gray-400 hover:text-white transition-colors">
                                <i class="fab fa-facebook-f"></i>
                            </a>
                        @endif
                        @if ($twitter)
                            <a href="{{ $twitter }}" target="_blank"
                                class="text-gray-400 hover:text-white transition-colors">
                                <i class="fab fa-twitter"></i>
                            </a>
                        @endif
                        @if ($linkedin)
                            <a href="{{ $linkedin }}" target="_blank"
                                class="text-gray-400 hover:text-white transition-colors">
                                <i class="fab fa-linkedin-in"></i>
                            </a>
                        @endif
                        @if ($instagram)
                            <a href="{{ $instagram }}" target="_blank"
                                class="text-gray-400 hover:text-white transition-colors">
                                <i class="fab fa-instagram"></i>
                            </a>
                        @endif
                        @if ($youtube)
                            <a href="{{ $youtube }}" target="_blank"
                                class="text-gray-400 hover:text-white transition-colors">
                                <i class="fab fa-youtube"></i>
                            </a>
                        @endif
                    </div>
                </div>

                <!-- Quick Links -->
                <div>
                    <h3 class="text-lg font-semibold mb-4">{{ __('Quick Links') }}</h3>
                    <ul class="space-y-2">
                        <li><a href="{{ route('home') }}"
                                class="text-gray-300 hover:text-white transition-colors">{{ __('Home') }}</a></li>
                        <li><a href="{{ route('about') }}"
                                class="text-gray-300 hover:text-white transition-colors">{{ __('About Us') }}</a></li>

                        @php
                            $footerPages = \App\Models\Page::active()->footer()->orderBy('sort_order')->get();
                        @endphp
                        @foreach($footerPages as $footerPage)
                            <li><a href="{{ route('page.show', $footerPage->getLocalizedSlug()) }}"
                                    class="text-gray-300 hover:text-white transition-colors">{{ $footerPage->getLocalizedName() }}</a></li>
                        @endforeach

                        <li><a href="{{ route('contact') }}"
                                class="text-gray-300 hover:text-white transition-colors">{{ __('Contact') }}</a></li>
                    </ul>
                </div>

                <!-- Contact Info -->
                <div>
                    <h3 class="text-lg font-semibold mb-4">{{ __('Contact Info') }}</h3>
                    <ul class="space-y-2 text-gray-300">
                        @php
                            $company = \App\Models\Company::first();
                        @endphp
                        @if ($company)
                            <li class="flex items-center space-x-2">
                                <i class="fas fa-phone text-blue-400"></i>
                                <span>{{ $company->phone ?? '+966 11 123 4567' }}</span>
                            </li>
                            <li class="flex items-center space-x-2">
                                <i class="fas fa-envelope text-blue-400"></i>
                                <span>{{ $company->email ?? 'info@qualityinvestment.com' }}</span>
                            </li>
                            <li class="flex items-center space-x-2">
                                <i class="fas fa-map-marker-alt text-blue-400"></i>
                                <span>{{ $company->address ?? __('Riyadh, Saudi Arabia') }}</span>
                            </li>
                        @else
                            <li class="flex items-center space-x-2">
                                <i class="fas fa-phone text-blue-400"></i>
                                <span>+966 11 123 4567</span>
                            </li>
                            <li class="flex items-center space-x-2">
                                <i class="fas fa-envelope text-blue-400"></i>
                                <span>info@qualityinvestment.com</span>
                            </li>
                            <li class="flex items-center space-x-2">
                                <i class="fas fa-map-marker-alt text-blue-400"></i>
                                <span>{{ __('Riyadh, Saudi Arabia') }}</span>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>

            <div class="border-t border-gray-800 mt-8 pt-8 text-center">
                <p class="text-gray-400">
                    &copy; {{ date('Y') }}
                    {{ $company ? $company->getLocalizedName() : (app()->getLocale() === 'ar' ? 'شركة الجودة للاستثمار' : 'Quality Investment Company') }}.
                    {{ __('All rights reserved.') }}
                </p>
            </div>
        </div>
    </footer>

    <!-- Scripts -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const navbar = document.getElementById('navbar');
            const navbarText = document.querySelector('.navbar-text');
            const navbarLinks = document.querySelectorAll('.navbar-link');
            const activeLinks = document.querySelectorAll('.active-link');
            const logoContainer = document.querySelector('.logo-container');

            // Mobile menu toggle
            const mobileMenuButton = document.querySelector('.mobile-menu-button');
            const mobileMenu = document.querySelector('.mobile-menu');
            const mobileMenuClose = document.querySelector('.mobile-menu-close');
            const menuIcon = document.querySelector('.menu-icon');
            const closeIcon = document.querySelector('.close-icon');

            function toggleMobileMenu() {
                mobileMenu.classList.toggle('hidden');

                if (mobileMenu.classList.contains('hidden')) {
                    menuIcon.classList.remove('hidden');
                    closeIcon.classList.add('hidden');
                    document.body.style.overflow = '';
                } else {
                    menuIcon.classList.add('hidden');
                    closeIcon.classList.remove('hidden');
                    document.body.style.overflow = 'hidden';
                }
            }

            if (mobileMenuButton && mobileMenu) {
                mobileMenuButton.addEventListener('click', toggleMobileMenu);
            }

            if (mobileMenuClose) {
                mobileMenuClose.addEventListener('click', toggleMobileMenu);
            }

            // Close mobile menu when clicking on links
            const mobileMenuLinks = document.querySelectorAll('.mobile-menu a');
            mobileMenuLinks.forEach(link => {
                link.addEventListener('click', () => {
                    if (!mobileMenu.classList.contains('hidden')) {
                        toggleMobileMenu();
                    }
                });
            });

            // Navbar scroll effect - Enhanced for Solution 2
            function updateNavbar() {
                const scrolled = window.scrollY > 50;

                if (scrolled) {
                    // Keep the enhanced transparent background, just add more shadow
                    navbar.classList.remove('bg-transparent');
                    navbar.classList.add('navbar-solid');

                    if (navbarText) navbarText.classList.add('scrolled');
                    if (logoContainer) logoContainer.classList.add('scrolled');

                    navbarLinks.forEach(link => {
                        link.classList.add('scrolled');
                    });

                    activeLinks.forEach(link => {
                        link.classList.add('scrolled');
                    });
                } else {
                    // Use our enhanced transparent navbar
                    navbar.classList.remove('navbar-solid');
                    navbar.classList.add('navbar-transparent');

                    if (navbarText) navbarText.classList.remove('scrolled');
                    if (logoContainer) logoContainer.classList.remove('scrolled');

                    navbarLinks.forEach(link => {
                        link.classList.remove('scrolled');
                    });

                    activeLinks.forEach(link => {
                        link.classList.remove('scrolled');
                    });
                }
            }

            // Initial check
            updateNavbar();

            // Listen for scroll events
            window.addEventListener('scroll', updateNavbar);

            // Smooth scrolling for anchor links
            document.querySelectorAll('a[href^="#"]').forEach(anchor => {
                anchor.addEventListener('click', function(e) {
                    e.preventDefault();
                    const target = document.querySelector(this.getAttribute('href'));
                    if (target) {
                        target.scrollIntoView({
                            behavior: 'smooth',
                            block: 'start'
                        });
                    }
                });
            });
        });
    </script>

    @stack('scripts')

    <!-- Comprehensive Animation System -->
    <script>
    // Animation Observer for scroll-triggered animations
    class AnimationObserver {
        constructor() {
            this.observer = null;
            this.animatedElements = new Set();
            this.init();
        }

        init() {
            // Check for reduced motion preference
            const prefersReducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
            if (prefersReducedMotion) return;

            // Fix mobile overflow issues immediately
            this.fixMobileOverflow();

            this.setupObserver();
            this.addAnimationClasses();
            this.observeElements();
        }

        fixMobileOverflow() {
            // Force overflow hidden on body and html only
            document.body.style.overflowX = 'hidden';
            document.documentElement.style.overflowX = 'hidden';
            document.body.style.maxWidth = '100vw';
            document.documentElement.style.maxWidth = '100vw';
        },

        // Update RTL/LTR direction
        updateDirection() {
            const currentLang = document.documentElement.lang;
            const isArabic = currentLang === 'ar';

            // Update HTML direction
            document.documentElement.dir = isArabic ? 'rtl' : 'ltr';

            // Update mobile menu direction
            const mobileMenu = document.querySelector('.mobile-menu');
            if (mobileMenu) {
                mobileMenu.dir = isArabic ? 'rtl' : 'ltr';
            }

            // Update navbar container direction
            const navbarContainer = document.querySelector('.navbar-container');
            if (navbarContainer) {
                navbarContainer.dir = isArabic ? 'rtl' : 'ltr';
            }
        }

        setupObserver() {
            const options = {
                threshold: 0.1,
                rootMargin: '0px 0px -50px 0px'
            };

            this.observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting && !this.animatedElements.has(entry.target)) {
                        this.animateElement(entry.target);
                        this.animatedElements.add(entry.target);
                    }
                });
            }, options);
        }

        addAnimationClasses() {
            const style = document.createElement('style');
            style.textContent = `
                /* Animation Base Classes */
                .animate-on-scroll {
                    opacity: 0;
                    transition: all 0.8s cubic-bezier(0.25, 0.46, 0.45, 0.94);
                }

                .animate-fade-in {
                    transform: translateY(30px);
                }

                .animate-fade-in.animated {
                    opacity: 1;
                    transform: translateY(0);
                }

                .animate-slide-up {
                    transform: translateY(50px);
                }

                .animate-slide-up.animated {
                    opacity: 1;
                    transform: translateY(0);
                }

                .animate-slide-left {
                    transform: translateX(30px);
                }

                .animate-slide-left.animated {
                    opacity: 1;
                    transform: translateX(0);
                }

                .animate-slide-right {
                    transform: translateX(-30px);
                }

                .animate-slide-right.animated {
                    opacity: 1;
                    transform: translateX(0);
                }

                /* Mobile-specific animation fixes */
                @media (max-width: 768px) {
                    .animate-slide-left,
                    .animate-slide-right {
                        transform: translateY(20px) !important;
                    }

                    .animate-slide-left.animated,
                    .animate-slide-right.animated {
                        transform: translateY(0) !important;
                    }

                    /* Prevent horizontal overflow */
                    .animate-on-scroll {
                        max-width: 100% !important;
                        overflow-x: hidden !important;
                    }
                }

                .animate-scale {
                    transform: scale(0.9);
                }

                .animate-scale.animated {
                    opacity: 1;
                    transform: scale(1);
                }

                .animate-rotate {
                    transform: rotate(-5deg) scale(0.9);
                }

                .animate-rotate.animated {
                    opacity: 1;
                    transform: rotate(0deg) scale(1);
                }

                /* Staggered animations */
                .animate-stagger {
                    transition-delay: 0ms;
                }

                .animate-stagger:nth-child(1) { transition-delay: 0ms; }
                .animate-stagger:nth-child(2) { transition-delay: 100ms; }
                .animate-stagger:nth-child(3) { transition-delay: 200ms; }
                .animate-stagger:nth-child(4) { transition-delay: 300ms; }
                .animate-stagger:nth-child(5) { transition-delay: 400ms; }
                .animate-stagger:nth-child(6) { transition-delay: 500ms; }

                /* Hover animations */
                .hover-lift {
                    transition: transform 0.3s ease, box-shadow 0.3s ease;
                }

                .hover-lift:hover {
                    transform: translateY(-5px);
                    box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
                }

                .hover-scale {
                    transition: transform 0.3s ease;
                }

                .hover-scale:hover {
                    transform: scale(1.05);
                }

                .hover-glow {
                    transition: box-shadow 0.3s ease;
                }

                .hover-glow:hover {
                    box-shadow: 0 0 30px rgba(34, 197, 94, 0.3);
                }

                /* Performance optimizations */
                .animate-on-scroll {
                    will-change: transform, opacity;
                }

                .animate-on-scroll.animated {
                    will-change: auto;
                }

                /* Reduced motion support */
                @media (prefers-reduced-motion: reduce) {
                    .animate-on-scroll,
                    .hover-lift,
                    .hover-scale,
                    .hover-glow {
                        transition: none !important;
                        animation: none !important;
                        transform: none !important;
                    }
                }
            `;
            document.head.appendChild(style);
        }

        observeElements() {
            // Auto-detect elements to animate
            const selectors = [
                'section',
                '.card',
                '.board-member-card',
                '.faq-item',
                '.stats-card',
                '.service-card',
                '.news-card',
                'article',
                '.hero-content',
                '.feature-box',
                'h1, h2, h3',
                '.btn',
                '.investment-form',
                '.sidebar-sticky'
            ];

            selectors.forEach(selector => {
                document.querySelectorAll(selector).forEach((element, index) => {
                    if (!element.classList.contains('animate-on-scroll')) {
                        this.addAnimationClass(element, index);
                        this.observer.observe(element);
                    }
                });
            });
        }

        addAnimationClass(element, index) {
            element.classList.add('animate-on-scroll');

            // Check if mobile to avoid horizontal animations
            const isMobile = window.innerWidth <= 768;

            // Determine animation type based on element type and position
            if (element.tagName === 'SECTION') {
                element.classList.add('animate-fade-in');
            } else if (element.classList.contains('card') || element.classList.contains('board-member-card')) {
                element.classList.add('animate-scale', 'animate-stagger');
            } else if (element.tagName.match(/^H[1-3]$/)) {
                element.classList.add('animate-slide-up');
            } else if (element.classList.contains('btn')) {
                element.classList.add('animate-fade-in');
            } else if (!isMobile && index % 2 === 0) {
                element.classList.add('animate-slide-left');
            } else if (!isMobile) {
                element.classList.add('animate-slide-right');
            } else {
                // On mobile, use only vertical animations
                element.classList.add('animate-slide-up');
            }

            // Add hover effects
            if (element.classList.contains('card') || element.classList.contains('btn')) {
                element.classList.add('hover-lift');
            }

            if (element.classList.contains('board-member-card')) {
                element.classList.add('hover-glow');
            }

            // Ensure element doesn't cause overflow
            element.style.maxWidth = '100%';
        }

        animateElement(element) {
            element.classList.add('animated');

            // Remove will-change after animation completes
            setTimeout(() => {
                element.style.willChange = 'auto';
            }, 800);
        }
    }

    // Immediate overflow fix - runs before DOM is ready
    (function() {
        function fixOverflow() {
            document.body.style.overflowX = 'hidden';
            document.documentElement.style.overflowX = 'hidden';
            document.body.style.maxWidth = '100vw';
            document.documentElement.style.maxWidth = '100vw';
        }

        // Apply immediately
        fixOverflow();

        // Apply on window resize
        window.addEventListener('resize', fixOverflow);
    })();

    // Initialize animations when DOM is ready
    document.addEventListener('DOMContentLoaded', () => {
        new AnimationObserver();

        // Update direction for RTL/LTR
        const currentLang = document.documentElement.lang;
        const isArabic = currentLang === 'ar';

        // Update HTML direction
        document.documentElement.dir = isArabic ? 'rtl' : 'ltr';

        // Update mobile menu direction
        const mobileMenu = document.querySelector('.mobile-menu');
        if (mobileMenu) {
            mobileMenu.dir = isArabic ? 'rtl' : 'ltr';
        }

        // Update navbar container direction
        const navbarContainer = document.querySelector('.navbar-container');
        if (navbarContainer) {
            navbarContainer.dir = isArabic ? 'rtl' : 'ltr';
        }

        // Force navbar layout update for RTL
        const navbarMainContainer = document.querySelector('.navbar-container .flex.items-center.justify-between');
        if (navbarMainContainer) {
            if (isArabic) {
                navbarMainContainer.style.flexDirection = 'row-reverse';
            } else {
                navbarMainContainer.style.flexDirection = 'row';
            }
        }

        // Update individual navbar sections
        const logoSection = document.querySelector('.navbar-container .flex.items-center.flex-shrink-0');
        const navigationSection = document.querySelector('.navbar-container .hidden.md\\:flex.md\\:space-x-8');
        const rightSection = document.querySelector('.navbar-container .flex.items-center.space-x-6');

        if (isArabic) {
            if (logoSection) logoSection.style.order = '3';
            if (navigationSection) navigationSection.style.order = '2';
            if (rightSection) rightSection.style.order = '1';
        } else {
            if (logoSection) logoSection.style.order = '1';
            if (navigationSection) navigationSection.style.order = '2';
            if (rightSection) rightSection.style.order = '3';
        }

        // Force refresh if language was changed
        @if(session('language_changed'))
            // Apply RTL changes immediately before reload
            if (isArabic) {
                document.documentElement.setAttribute('lang', 'ar');
                document.documentElement.setAttribute('dir', 'rtl');

                // Force navbar layout update
                const navbarMainContainer = document.querySelector('.navbar-container .flex.items-center.justify-between');
                if (navbarMainContainer) {
                    navbarMainContainer.style.flexDirection = 'row-reverse';
                }
            }

            // Small delay to ensure DOM is ready
            setTimeout(() => {
                window.location.reload();
            }, 50);
        @endif

        // Add smooth scrolling for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });

        // Add loading animations for images
        document.querySelectorAll('img').forEach(img => {
            if (!img.complete) {
                img.style.opacity = '0';
                img.style.transition = 'opacity 0.5s ease';
                img.addEventListener('load', () => {
                    img.style.opacity = '1';
                });
            }
        });
    });

    // Performance monitoring
    if ('requestIdleCallback' in window) {
        requestIdleCallback(() => {
            console.log('Animation system initialized');
        });
    }
    </script>
</body>

</html>

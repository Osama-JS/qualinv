<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }} - Admin Dashboard</title>

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
    <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@300;400;500;700&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Additional Styles -->
    @stack('styles')

    <style>
        /* Custom scrollbar for sidebar */
        .scrollbar-thin::-webkit-scrollbar {
            width: 6px;
        }

        .scrollbar-thin::-webkit-scrollbar-track {
            background: rgba(55, 65, 81, 0.3);
            border-radius: 3px;
        }

        .scrollbar-thin::-webkit-scrollbar-thumb {
            background: rgba(107, 114, 128, 0.6);
            border-radius: 3px;
        }

        .scrollbar-thin::-webkit-scrollbar-thumb:hover {
            background: rgba(107, 114, 128, 0.8);
        }

        /* Ensure sidebar is always fixed and RTL support */
        @media (min-width: 1024px) {
            #sidebar {
                position: fixed !important;
                top: 0 !important;
                bottom: 0 !important;
                transform: translateX(0) !important;
            }

            /* LTR (English) */
            html[dir="ltr"] #sidebar {
                left: 0 !important;
                right: auto !important;
            }

            /* RTL (Arabic) */
            html[dir="rtl"] #sidebar {
                right: 0 !important;
                left: auto !important;
            }

            /* Adjust main content for RTL */
            html[dir="ltr"] .main-content {
                margin-left: 16rem !important;
                margin-right: 0 !important;
            }

            html[dir="rtl"] .main-content {
                margin-right: 16rem !important;
                margin-left: 0 !important;
            }
        }

        /* Smooth transitions */
        * {
            transition: all 0.2s ease;
        }
    </style>

    <!-- Alpine.js for enhanced interactivity -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <style>
        /* Enhanced font loading and application */
        :root {
            --font-arabic: 'Tajawal', 'Inter', system-ui, -apple-system, sans-serif;
            --font-english: 'Inter', system-ui, -apple-system, sans-serif;
        }

        body {
            font-family: {{ app()->getLocale() == 'ar' ? 'var(--font-arabic)' : 'var(--font-english)' }};
            font-feature-settings: "kern" 1, "liga" 1;
            text-rendering: optimizeLegibility;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
        }

        /* Ensure Arabic text always uses Tajawal */
        .arabic-text, [lang="ar"], .font-arabic {
            font-family: var(--font-arabic) !important;
            line-height: 1.8;
            letter-spacing: 0.01em;
        }

        /* Ensure English text uses Inter */
        .english-text, [lang="en"], .font-english {
            font-family: var(--font-english) !important;
            line-height: 1.6;
            letter-spacing: -0.01em;
        }

        /* Font weight classes for Arabic */
        .font-arabic-light { font-weight: 300; }
        .font-arabic-normal { font-weight: 400; }
        .font-arabic-medium { font-weight: 500; }
        .font-arabic-bold { font-weight: 700; }

        /* Headings optimization */
        h1, h2, h3, h4, h5, h6 {
            font-family: {{ app()->getLocale() == 'ar' ? 'var(--font-arabic)' : 'var(--font-english)' }};
            font-weight: {{ app()->getLocale() == 'ar' ? '700' : '600' }};
            line-height: {{ app()->getLocale() == 'ar' ? '1.4' : '1.3' }};
        }

        /* Button and form elements */
        button, input, select, textarea {
            font-family: inherit;
        }
    </style>
</head>
<body class="antialiased bg-gray-100 dark:bg-gray-900 {{ app()->getLocale() == 'ar' ? 'font-arabic' : 'font-english' }}" lang="{{ app()->getLocale() }}">
    <div class="min-h-screen flex">
        <!-- Modern Fixed Sidebar -->
        <div id="sidebar" class="fixed inset-y-0 left-0 z-50 w-72 bg-gradient-to-b from-gray-900 via-gray-800 to-gray-900 shadow-2xl transform -translate-x-full transition-all duration-300 ease-in-out lg:translate-x-0 lg:fixed lg:inset-y-0 flex flex-col">
            <!-- Logo Section -->
            <div class="flex items-center px-6 py-6 border-b border-gray-700/50 flex-shrink-0">
                <div class="flex items-center space-x-3">
                    <div class="w-12 h-12 bg-gradient-to-br from-blue-500 to-purple-600 rounded-xl flex items-center justify-center shadow-lg">
                        <i class="fas fa-chart-line text-white text-xl"></i>
                    </div>
                    <div>
                        <h1 class="text-white text-xl font-bold tracking-tight">{{ __('admin.admin_panel') }}</h1>
                        <p class="text-gray-400 text-xs">{{ __('admin.investment_management') }}</p>
                    </div>
                </div>
            </div>

            <nav class="mt-6 px-4 space-y-2 overflow-y-auto flex-1 scrollbar-thin scrollbar-thumb-gray-600 scrollbar-track-gray-800">
                <!-- Dashboard -->
                <a href="{{ route('admin.dashboard') }}" class="group flex items-center px-4 py-3 text-sm font-medium rounded-xl transition-all duration-200 {{ request()->routeIs('admin.dashboard') ? 'bg-gradient-to-r from-blue-600 to-purple-600 text-white shadow-lg transform scale-105' : 'text-gray-300 hover:bg-gray-700/50 hover:text-white hover:transform hover:scale-105' }}">
                    <div class="flex items-center justify-center w-8 h-8 rounded-lg {{ request()->routeIs('admin.dashboard') ? 'bg-white/20' : 'bg-gray-700 group-hover:bg-gray-600' }} mr-3 transition-colors">
                        <i class="fas fa-tachometer-alt text-sm"></i>
                    </div>
                    {{ __('admin.dashboard') }}
                    @if(request()->routeIs('admin.dashboard'))
                        <div class="ml-auto w-2 h-2 bg-white rounded-full animate-pulse"></div>
                    @endif
                </a>

                <!-- Company Info -->
                <a href="{{ route('admin.company.index') }}" class="group flex items-center px-4 py-3 text-sm font-medium rounded-xl transition-all duration-200 {{ request()->routeIs('admin.company.*') ? 'bg-gradient-to-r from-green-600 to-teal-600 text-white shadow-lg transform scale-105' : 'text-gray-300 hover:bg-gray-700/50 hover:text-white hover:transform hover:scale-105' }}">
                    <div class="flex items-center justify-center w-8 h-8 rounded-lg {{ request()->routeIs('admin.company.*') ? 'bg-white/20' : 'bg-gray-700 group-hover:bg-gray-600' }} mr-3 transition-colors">
                        <i class="fas fa-building text-sm"></i>
                    </div>
                    {{ __('admin.company_info') }}
                    @if(request()->routeIs('admin.company.*'))
                        <div class="ml-auto w-2 h-2 bg-white rounded-full animate-pulse"></div>
                    @endif
                </a>

                <!-- Settings -->
                <a href="{{ route('admin.settings.index') }}" class="group flex items-center px-4 py-3 text-sm font-medium rounded-xl transition-all duration-200 {{ request()->routeIs('admin.settings.*') ? 'bg-gradient-to-r from-orange-600 to-red-600 text-white shadow-lg transform scale-105' : 'text-gray-300 hover:bg-gray-700/50 hover:text-white hover:transform hover:scale-105' }}">
                    <div class="flex items-center justify-center w-8 h-8 rounded-lg {{ request()->routeIs('admin.settings.*') ? 'bg-white/20' : 'bg-gray-700 group-hover:bg-gray-600' }} mr-3 transition-colors">
                        <i class="fas fa-cogs text-sm"></i>
                    </div>
                    {{ __('admin.site_settings') }}
                    @if(request()->routeIs('admin.settings.*'))
                        <div class="ml-auto w-2 h-2 bg-white rounded-full animate-pulse"></div>
                    @endif
                </a>



                <!-- Board Directors -->
                <a href="{{ route('admin.board-directors.index') }}" class="group flex items-center px-4 py-3 text-sm font-medium rounded-xl transition-all duration-200 {{ request()->routeIs('admin.board-directors.*') ? 'bg-gradient-to-r from-indigo-600 to-purple-600 text-white shadow-lg transform scale-105' : 'text-gray-300 hover:bg-gray-700/50 hover:text-white hover:transform hover:scale-105' }}">
                    <div class="flex items-center justify-center w-8 h-8 rounded-lg {{ request()->routeIs('admin.board-directors.*') ? 'bg-white/20' : 'bg-gray-700 group-hover:bg-gray-600' }} mr-3 transition-colors">
                        <i class="fas fa-user-tie text-sm"></i>
                    </div>
                    {{ __('admin.board_of_directors') }}
                    @if(request()->routeIs('admin.board-directors.*'))
                        <div class="ml-auto w-2 h-2 bg-white rounded-full animate-pulse"></div>
                    @endif
                </a>

                <!-- Media Center -->
                <a href="{{ route('admin.articles.index') }}" class="group flex items-center px-4 py-3 text-sm font-medium rounded-xl transition-all duration-200 {{ request()->routeIs('admin.articles.*') ? 'bg-gradient-to-r from-pink-600 to-rose-600 text-white shadow-lg transform scale-105' : 'text-gray-300 hover:bg-gray-700/50 hover:text-white hover:transform hover:scale-105' }}">
                    <div class="flex items-center justify-center w-8 h-8 rounded-lg {{ request()->routeIs('admin.articles.*') ? 'bg-white/20' : 'bg-gray-700 group-hover:bg-gray-600' }} mr-3 transition-colors">
                        <i class="fas fa-newspaper text-sm"></i>
                    </div>
                    {{ __('admin.media_center') }}
                    @if(request()->routeIs('admin.articles.*'))
                        <div class="ml-auto w-2 h-2 bg-white rounded-full animate-pulse"></div>
                    @endif
                </a>

                <!-- Page Management -->
                <a href="{{ route('admin.pages.index') }}" class="group flex items-center px-4 py-3 text-sm font-medium rounded-xl transition-all duration-200 {{ request()->routeIs('admin.pages.*') ? 'bg-gradient-to-r from-cyan-600 to-blue-600 text-white shadow-lg transform scale-105' : 'text-gray-300 hover:bg-gray-700/50 hover:text-white hover:transform hover:scale-105' }}">
                    <div class="flex items-center justify-center w-8 h-8 rounded-lg {{ request()->routeIs('admin.pages.*') ? 'bg-white/20' : 'bg-gray-700 group-hover:bg-gray-600' }} mr-3 transition-colors">
                        <i class="fas fa-file-code text-sm"></i>
                    </div>
                    {{ __('admin.page_management') }}
                    @if(request()->routeIs('admin.pages.*'))
                        <div class="ml-auto w-2 h-2 bg-white rounded-full animate-pulse"></div>
                    @endif
                </a>



                <!-- Content Sections -->
                <a href="{{ route('admin.content-sections.index') }}" class="group flex items-center px-4 py-3 text-sm font-medium rounded-xl transition-all duration-200 {{ request()->routeIs('admin.content-sections.*') ? 'bg-gradient-to-r from-emerald-600 to-teal-600 text-white shadow-lg transform scale-105' : 'text-gray-300 hover:bg-gray-700/50 hover:text-white hover:transform hover:scale-105' }}">
                    <div class="flex items-center justify-center w-8 h-8 rounded-lg {{ request()->routeIs('admin.content-sections.*') ? 'bg-white/20' : 'bg-gray-700 group-hover:bg-gray-600' }} mr-3 transition-colors">
                        <i class="fas fa-layer-group text-sm"></i>
                    </div>
                    {{ __('admin.content_sections') }}
                    @if(request()->routeIs('admin.content-sections.*'))
                        <div class="ml-auto w-2 h-2 bg-white rounded-full animate-pulse"></div>
                    @endif
                </a>

                <!-- Divider -->
                <div class="my-4 border-t border-gray-700/50"></div>

                <!-- Investment Applications -->
                <a href="{{ route('admin.investment-applications.index') }}" class="group flex items-center px-4 py-3 text-sm font-medium rounded-xl transition-all duration-200 {{ request()->routeIs('admin.investment-applications.*') ? 'bg-gradient-to-r from-yellow-600 to-orange-600 text-white shadow-lg transform scale-105' : 'text-gray-300 hover:bg-gray-700/50 hover:text-white hover:transform hover:scale-105' }}">
                    <div class="flex items-center justify-center w-8 h-8 rounded-lg {{ request()->routeIs('admin.investment-applications.*') ? 'bg-white/20' : 'bg-gray-700 group-hover:bg-gray-600' }} mr-3 transition-colors">
                        <i class="fas fa-file-invoice-dollar text-sm"></i>
                    </div>
                    <span class="flex-1">{{ __('admin.investment_applications') }}</span>
                    @php
                        $unreadCount = \App\Models\InvestmentApplication::unread()->count();
                    @endphp
                    @if($unreadCount > 0)
                        <span class="inline-flex items-center justify-center w-5 h-5 text-xs font-bold text-white bg-red-500 rounded-full animate-bounce">
                            {{ $unreadCount }}
                        </span>
                    @endif
                    @if(request()->routeIs('admin.investment-applications.*'))
                        <div class="ml-2 w-2 h-2 bg-white rounded-full animate-pulse"></div>
                    @endif
                </a>

                <!-- FAQ Management -->
                <a href="{{ route('admin.faqs.index') }}" class="group flex items-center px-4 py-3 text-sm font-medium rounded-xl transition-all duration-200 {{ request()->routeIs('admin.faqs.*') ? 'bg-gradient-to-r from-indigo-600 to-purple-600 text-white shadow-lg transform scale-105' : 'text-gray-300 hover:bg-gray-700/50 hover:text-white hover:transform hover:scale-105' }}">
                    <div class="flex items-center justify-center w-8 h-8 rounded-lg {{ request()->routeIs('admin.faqs.*') ? 'bg-white/20' : 'bg-gray-700 group-hover:bg-gray-600' }} mr-3 transition-colors">
                        <i class="fas fa-question-circle text-sm"></i>
                    </div>
                    <span class="flex-1">{{ __('FAQ Management') }}</span>
                    @if(request()->routeIs('admin.faqs.*'))
                        <div class="ml-2 w-2 h-2 bg-white rounded-full animate-pulse"></div>
                    @endif
                </a>

                @if(auth()->user()->isAdmin())
                <!-- User Management -->
                <a href="{{ route('admin.users.index') }}" class="group flex items-center px-4 py-3 text-sm font-medium rounded-xl transition-all duration-200 {{ request()->routeIs('admin.users.*') ? 'bg-gradient-to-r from-red-600 to-pink-600 text-white shadow-lg transform scale-105' : 'text-gray-300 hover:bg-gray-700/50 hover:text-white hover:transform hover:scale-105' }}">
                    <div class="flex items-center justify-center w-8 h-8 rounded-lg {{ request()->routeIs('admin.users.*') ? 'bg-white/20' : 'bg-gray-700 group-hover:bg-gray-600' }} mr-3 transition-colors">
                        <i class="fas fa-user-shield text-sm"></i>
                    </div>
                    {{ __('admin.user_management') }}
                    @if(request()->routeIs('admin.users.*'))
                        <div class="ml-auto w-2 h-2 bg-white rounded-full animate-pulse"></div>
                    @endif
                </a>
                @endif

                <!-- Divider -->
                <div class="my-4 border-t border-gray-700/50"></div>

                <!-- Profile -->
                <a href="{{ route('admin.profile.index') }}" class="group flex items-center px-4 py-3 text-sm font-medium rounded-xl transition-all duration-200 {{ request()->routeIs('admin.profile.*') ? 'bg-gradient-to-r from-cyan-600 to-blue-600 text-white shadow-lg transform scale-105' : 'text-gray-300 hover:bg-gray-700/50 hover:text-white hover:transform hover:scale-105' }}">
                    <div class="flex items-center justify-center w-8 h-8 rounded-lg {{ request()->routeIs('admin.profile.*') ? 'bg-white/20' : 'bg-gray-700 group-hover:bg-gray-600' }} mr-3 transition-colors">
                        <i class="fas fa-user-circle text-sm"></i>
                    </div>
                    {{ __('admin.profile') }}
                    @if(request()->routeIs('admin.profile.*'))
                        <div class="ml-auto w-2 h-2 bg-white rounded-full animate-pulse"></div>
                    @endif
                </a>
            </nav>

            <!-- User Profile Section -->
            <div class="p-4 border-t border-gray-700/50 bg-gray-800/50 flex-shrink-0">
                <div class="flex items-center space-x-3">
                    <a href="{{ route('admin.profile.index') }}" class="w-10 h-10 rounded-full overflow-hidden hover:ring-2 hover:ring-blue-500 transition-all duration-200">
                        <img src="{{ auth()->user()->getAvatarUrl() }}"
                             alt="{{ auth()->user()->name }}"
                             class="w-full h-full object-cover">
                    </a>
                    <div class="flex-1 min-w-0">
                        <a href="{{ route('admin.profile.index') }}" class="block">
                            <p class="text-sm font-medium text-white truncate hover:text-blue-300 transition-colors">{{ auth()->user()->name }}</p>
                            <p class="text-xs text-gray-400 truncate">{{ auth()->user()->getRoleLabel() }}</p>
                        </a>
                    </div>
                    <div class="flex items-center space-x-1">
                        <a href="{{ route('admin.profile.edit') }}"
                           class="p-2 text-gray-400 hover:text-blue-300 transition-colors"
                           title="{{ __('admin.edit_profile') }}">
                            <i class="fas fa-edit text-sm"></i>
                        </a>
                        <form method="POST" action="{{ route('logout') }}" class="inline">
                            @csrf
                            <button type="submit" class="p-2 text-gray-400 hover:text-red-300 transition-colors" title="{{ __('admin.logout') }}">
                                <i class="fas fa-sign-out-alt text-sm"></i>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col lg:ml-72 min-h-screen main-content">
            <!-- Modern Top Navigation -->
            <header class="bg-white/80 dark:bg-gray-800/80 backdrop-blur-lg shadow-sm border-b border-gray-200/50 dark:border-gray-700/50 sticky top-0 z-40">
                <div class="flex items-center justify-between px-6 py-4">
                    <div class="flex items-center">
                        <button id="sidebar-toggle" class="lg:hidden p-2 rounded-xl text-gray-600 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors">
                            <i class="fas fa-bars"></i>
                        </button>
                        <div class="ml-4">
                            <h2 class="text-2xl font-bold text-gray-800 dark:text-gray-200">@yield('page-title', __('admin.dashboard'))</h2>
                            <p class="text-sm text-gray-500 dark:text-gray-400">{{ __('admin.welcome_back') }}, {{ auth()->user()->name }}</p>
                        </div>
                    </div>

                    <div class="flex items-center space-x-4">
                        <!-- Investment Applications Notifications -->
                        <x-investment-notifications />

                        <!-- Language Switcher -->
                        <div class="relative">
                            <button id="language-toggle" class="flex items-center text-sm text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-200">
                                <i class="fas fa-globe mr-2"></i>
                                {{ app()->getLocale() === 'ar' ? 'العربية' : 'English' }}
                                <i class="fas fa-chevron-down ml-2"></i>
                            </button>
                            <div id="language-menu" class="hidden absolute right-0 mt-2 w-48 bg-white dark:bg-gray-800 rounded-md shadow-lg py-1 z-50">
                                <a href="{{ route('language.switch', 'en') }}" class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 {{ app()->getLocale() === 'en' ? 'bg-gray-100 dark:bg-gray-700' : '' }}">
                                    English
                                </a>
                                <a href="{{ route('language.switch', 'ar') }}" class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 {{ app()->getLocale() === 'ar' ? 'bg-gray-100 dark:bg-gray-700' : '' }}">
                                    العربية
                                </a>
                            </div>
                        </div>

                        <!-- Dark Mode Toggle -->
                        <button id="theme-toggle" class="text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-200">
                            <i class="fas fa-moon dark:hidden"></i>
                            <i class="fas fa-sun hidden dark:block"></i>
                        </button>

                        <!-- User Menu -->
                        <div class="relative">
                            <button id="user-menu-toggle" class="flex items-center text-sm text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-200">
                                <div class="w-8 h-8 bg-blue-500 rounded-full flex items-center justify-center text-white text-sm font-medium mr-2">
                                    {{ substr(auth()->user()->name, 0, 1) }}
                                </div>
                                {{ auth()->user()->name }}
                                <i class="fas fa-chevron-down ml-2"></i>
                            </button>
                            <div id="user-menu" class="hidden absolute right-0 mt-2 w-48 bg-white dark:bg-gray-800 rounded-md shadow-lg py-1 z-50">
                                <a href="#" class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700">
                                    <i class="fas fa-user mr-2"></i>
                                    {{ __('Profile') }}
                                </a>
                                <a href="#" class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700">
                                    <i class="fas fa-cog mr-2"></i>
                                    {{ __('Settings') }}
                                </a>
                                <div class="border-t border-gray-100 dark:border-gray-700"></div>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700">
                                        <i class="fas fa-sign-out-alt mr-2"></i>
                                        {{ __('Logout') }}
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Page Content -->
            <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-50 dark:bg-gray-900">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
                    <!-- Enhanced Flash Messages -->
                    @if (session('success'))
                        <div class="mb-6">
                            @include('components.alert', [
                                'type' => 'success',
                                'title' => __('admin.success'),
                                'dismissible' => true,
                                'slot' => session('success')
                            ])
                        </div>
                    @endif

                    @if (session('error'))
                        <div class="mb-6">
                            <x-alert type="error"
                                     title="{{ __('admin.error') }}"
                                     :dismissible="true">
                                {{ session('error') }}
                            </x-alert>
                        </div>
                    @endif

                    @if (session('warning'))
                        <div class="mb-6">
                            <x-alert type="warning"
                                     title="{{ __('admin.warning') }}"
                                     :dismissible="true">
                                {{ session('warning') }}
                            </x-alert>
                        </div>
                    @endif

                    @if (session('info'))
                        <div class="mb-6">
                            <x-alert type="info"
                                     title="{{ __('admin.info') }}"
                                     :dismissible="true">
                                {{ session('info') }}
                            </x-alert>
                        </div>
                    @endif

                    <!-- Validation Errors Summary -->
                    @if ($errors->any())
                        <div class="mb-6">
                            <x-alert type="error"
                                     title="{{ __('admin.validation_errors') }}"
                                     :dismissible="true">
                                <ul class="mt-2 space-y-1">
                                    @foreach ($errors->all() as $error)
                                        <li class="flex items-start">
                                            <i class="fas fa-circle text-xs {{ app()->getLocale() == 'ar' ? 'ml-2' : 'mr-2' }} mt-1.5 opacity-60"></i>
                                            <span>{{ $error }}</span>
                                        </li>
                                    @endforeach
                                </ul>
                            </x-alert>
                        </div>
                    @endif

                    @yield('content')
                </div>
            </main>
        </div>
    </div>

    <!-- Sidebar Overlay for Mobile -->
    <div id="sidebar-overlay" class="fixed inset-0 z-40 bg-black bg-opacity-50 hidden lg:hidden"></div>

    <!-- Toast Notifications Container -->
    <div id="toast-container" class="fixed top-4 right-4 z-50 space-y-2"></div>

    <!-- Toast Notifications from Session -->
    @if (session('toast_success'))
        @include('components.toast', [
            'type' => 'success',
            'title' => __('admin.success'),
            'slot' => session('toast_success')
        ])
    @endif

    @if (session('toast_error'))
        @include('components.toast', [
            'type' => 'error',
            'title' => __('admin.error'),
            'slot' => session('toast_error')
        ])
    @endif

    @if (session('toast_warning'))
        @include('components.toast', [
            'type' => 'warning',
            'title' => __('admin.warning'),
            'slot' => session('toast_warning')
        ])
    @endif

    @if (session('toast_info'))
        @include('components.toast', [
            'type' => 'info',
            'title' => __('admin.info'),
            'slot' => session('toast_info')
        ])
    @endif

    <script>
        // Sidebar toggle functionality
        document.getElementById('sidebar-toggle').addEventListener('click', function() {
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('sidebar-overlay');

            sidebar.classList.toggle('-translate-x-full');
            overlay.classList.toggle('hidden');
        });

        // Close sidebar when clicking overlay
        document.getElementById('sidebar-overlay').addEventListener('click', function() {
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('sidebar-overlay');

            sidebar.classList.add('-translate-x-full');
            overlay.classList.add('hidden');
        });

        // User menu toggle
        document.getElementById('user-menu-toggle').addEventListener('click', function() {
            document.getElementById('user-menu').classList.toggle('hidden');
        });

        // Language menu toggle
        document.getElementById('language-toggle').addEventListener('click', function() {
            document.getElementById('language-menu').classList.toggle('hidden');
        });

        // Close dropdowns when clicking outside
        document.addEventListener('click', function(event) {
            const userMenu = document.getElementById('user-menu');
            const userMenuToggle = document.getElementById('user-menu-toggle');
            const languageMenu = document.getElementById('language-menu');
            const languageToggle = document.getElementById('language-toggle');

            if (!userMenuToggle.contains(event.target)) {
                userMenu.classList.add('hidden');
            }

            if (!languageToggle.contains(event.target)) {
                languageMenu.classList.add('hidden');
            }
        });

        // Dark mode toggle
        document.getElementById('theme-toggle').addEventListener('click', function() {
            document.documentElement.classList.toggle('dark');
            localStorage.setItem('theme', document.documentElement.classList.contains('dark') ? 'dark' : 'light');
        });

        // Load saved theme
        if (localStorage.getItem('theme') === 'dark' || (!localStorage.getItem('theme') && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        }

        // Set RTL direction based on locale
        document.addEventListener('DOMContentLoaded', function() {
            const locale = '{{ app()->getLocale() }}';
            if (locale === 'ar') {
                document.documentElement.setAttribute('dir', 'rtl');
                document.documentElement.setAttribute('lang', 'ar');
            } else {
                document.documentElement.setAttribute('dir', 'ltr');
                document.documentElement.setAttribute('lang', 'en');
            }
        });
    </script>

    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Additional Scripts -->
    @stack('scripts')
</body>
</html>

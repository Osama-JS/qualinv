<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ __('Maintenance Mode') }} - {{ config('app.name', 'Quality Investment') }}</title>
    <meta name="description" content="Site is under maintenance. Please check back later.">

    <!-- Favicon -->
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
    <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@200;300;400;500;700;800;900&display=swap" rel="stylesheet">

    <!-- Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        body {
            font-family: 'Tajawal', sans-serif;
        }
        .maintenance-bg {
            background: linear-gradient(135deg, #1f2937 0%, #111827 50%, #0f172a 100%);
            min-height: 100vh;
            position: relative;
            overflow: hidden;
        }
        .maintenance-bg::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="grid" width="10" height="10" patternUnits="userSpaceOnUse"><path d="M 10 0 L 0 0 0 10" fill="none" stroke="%23374151" stroke-width="0.5" opacity="0.3"/></pattern></defs><rect width="100" height="100" fill="url(%23grid)"/></svg>');
            opacity: 0.1;
        }
        .floating-animation {
            animation: float 6s ease-in-out infinite;
        }
        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-20px); }
        }
        .pulse-animation {
            animation: pulse 2s infinite;
        }
        @keyframes pulse {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.5; }
        }
    </style>
</head>

<body class="maintenance-bg">
    <div class="relative z-10 flex items-center justify-center min-h-screen px-4 sm:px-6 lg:px-8">
        <div class="max-w-4xl mx-auto text-center">
            <!-- Logo Section -->
            @if($company && $company->logo)
            <div class="mb-8 floating-animation">
                <img src="{{ Storage::url($company->logo) }}"
                     {{-- alt="{{ $company->name ?? 'Company Logo' }}"  --}}
                     class="h-20 md:h-24 lg:h-28 w-auto mx-auto filter drop-shadow-2xl">
            </div>
            @endif

            <!-- Maintenance Icon -->
            <div class="mb-8">
                <div class="inline-flex items-center justify-center w-24 h-24 md:w-32 md:h-32 bg-gradient-to-br from-yellow-400 to-orange-500 rounded-full shadow-2xl floating-animation">
                    <i class="fas fa-tools text-white text-3xl md:text-4xl"></i>
                </div>
            </div>

            <!-- Main Content -->
            <div class="mb-12">
                <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold text-white mb-6 leading-tight">
                    {{ app()->getLocale() === 'ar' ? 'الموقع تحت الصيانة' : 'Under Maintenance' }}
                </h1>

                <div class="max-w-2xl mx-auto mb-8">
                    <p class="text-xl md:text-2xl text-gray-300 leading-relaxed">
                        {{ app()->getLocale() === 'ar' ? $maintenanceMessageAr : $maintenanceMessageEn }}
                    </p>
                </div>

                <!-- Features Grid -->
                <div class="grid md:grid-cols-3 gap-6 max-w-3xl mx-auto mb-12">
                    <div class="bg-white/10 backdrop-blur-sm rounded-xl p-6 border border-white/20">
                        <div class="w-12 h-12 bg-blue-500 rounded-lg flex items-center justify-center mx-auto mb-4">
                            <i class="fas fa-sync-alt text-white pulse-animation"></i>
                        </div>
                        <h3 class="text-white font-semibold mb-2">
                            {{ app()->getLocale() === 'ar' ? 'تحديث النظام' : 'System Update' }}
                        </h3>
                        <p class="text-gray-300 text-sm">
                            {{ app()->getLocale() === 'ar' ? 'نقوم بتحديث النظام لتحسين الأداء' : 'Updating our system for better performance' }}
                        </p>
                    </div>

                    <div class="bg-white/10 backdrop-blur-sm rounded-xl p-6 border border-white/20">
                        <div class="w-12 h-12 bg-green-500 rounded-lg flex items-center justify-center mx-auto mb-4">
                            <i class="fas fa-shield-alt text-white"></i>
                        </div>
                        <h3 class="text-white font-semibold mb-2">
                            {{ app()->getLocale() === 'ar' ? 'تحسين الأمان' : 'Security Enhancement' }}
                        </h3>
                        <p class="text-gray-300 text-sm">
                            {{ app()->getLocale() === 'ar' ? 'تعزيز أمان البيانات والمعلومات' : 'Enhancing data security and protection' }}
                        </p>
                    </div>

                    <div class="bg-white/10 backdrop-blur-sm rounded-xl p-6 border border-white/20">
                        <div class="w-12 h-12 bg-purple-500 rounded-lg flex items-center justify-center mx-auto mb-4">
                            <i class="fas fa-rocket text-white"></i>
                        </div>
                        <h3 class="text-white font-semibold mb-2">
                            {{ app()->getLocale() === 'ar' ? 'ميزات جديدة' : 'New Features' }}
                        </h3>
                        <p class="text-gray-300 text-sm">
                            {{ app()->getLocale() === 'ar' ? 'إضافة ميزات جديدة لتحسين التجربة' : 'Adding new features for better experience' }}
                        </p>
                    </div>
                </div>
            </div>

            <!-- Contact Information -->
            @if($company)
            <div class="bg-white/5 backdrop-blur-sm rounded-2xl p-8 border border-white/10 max-w-2xl mx-auto">
                <h2 class="text-2xl font-bold text-white mb-6">
                    {{ app()->getLocale() === 'ar' ? 'تحتاج مساعدة؟' : 'Need Help?' }}
                </h2>

                <div class="grid md:grid-cols-2 gap-6 text-center">
                    @if($company->email)
                    <div>
                        <div class="w-12 h-12 bg-blue-500 rounded-lg flex items-center justify-center mx-auto mb-3">
                            <i class="fas fa-envelope text-white"></i>
                        </div>
                        <h3 class="text-white font-semibold mb-2">
                            {{ app()->getLocale() === 'ar' ? 'البريد الإلكتروني' : 'Email' }}
                        </h3>
                        <a href="mailto:{{ $company->email }}" class="text-blue-400 hover:text-blue-300 transition-colors">
                            {{ $company->email }}
                        </a>
                    </div>
                    @endif

                    @if($company->phone)
                    <div>
                        <div class="w-12 h-12 bg-green-500 rounded-lg flex items-center justify-center mx-auto mb-3">
                            <i class="fas fa-phone text-white"></i>
                        </div>
                        <h3 class="text-white font-semibold mb-2">
                            {{ app()->getLocale() === 'ar' ? 'الهاتف' : 'Phone' }}
                        </h3>
                        <a href="tel:{{ $company->phone }}" class="text-green-400 hover:text-green-300 transition-colors">
                            {{ $company->phone }}
                        </a>
                    </div>
                    @endif
                </div>
            </div>
            @endif

            <!-- Footer -->
            <div class="mt-12 pt-8 border-t border-white/10">
                <p class="text-gray-400 text-sm">
                    {{ app()->getLocale() === 'ar' ? 'شكراً لصبركم. سنعود قريباً!' : 'Thank you for your patience. We\'ll be back soon!' }}
                </p>
                <p class="text-gray-500 text-xs mt-2">
                    &copy; {{ date('Y') }} {{ $company ? $company->getLocalizedName() : 'Quality Investment Company' }}.
                    {{ app()->getLocale() === 'ar' ? 'جميع الحقوق محفوظة.' : 'All rights reserved.' }}
                </p>
            </div>
        </div>
    </div>

    <!-- Background Animation -->
    <div class="absolute inset-0 overflow-hidden pointer-events-none">
        <div class="absolute -top-40 -right-40 w-80 h-80 bg-blue-500 rounded-full mix-blend-multiply filter blur-xl opacity-10 animate-pulse"></div>
        <div class="absolute -bottom-40 -left-40 w-80 h-80 bg-green-500 rounded-full mix-blend-multiply filter blur-xl opacity-10 animate-pulse" style="animation-delay: 2s;"></div>
        <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-80 h-80 bg-purple-500 rounded-full mix-blend-multiply filter blur-xl opacity-10 animate-pulse" style="animation-delay: 4s;"></div>
    </div>

    <script>
        // Auto-refresh page every 5 minutes
        setTimeout(function() {
            window.location.reload();
        }, 300000); // 5 minutes

        // Add some interactive effects
        document.addEventListener('DOMContentLoaded', function() {
            // Add hover effects to cards
            const cards = document.querySelectorAll('.bg-white\\/10');
            cards.forEach(card => {
                card.addEventListener('mouseenter', function() {
                    this.style.transform = 'translateY(-5px)';
                    this.style.transition = 'transform 0.3s ease';
                });
                card.addEventListener('mouseleave', function() {
                    this.style.transform = 'translateY(0)';
                });
            });
        });
    </script>
</body>
</html>

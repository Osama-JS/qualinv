<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ __('auth.login') }} - {{ config('app.name') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@300;400;500;700&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body {
            font-family: {{ app()->getLocale() == 'ar' ? "'Tajawal', sans-serif" : "'Inter', sans-serif" }};
        }

        /* Enhanced animations and effects */
        .login-container {
            animation: fadeInUp 0.8s ease-out;
        }

        .logo-pulse {
            animation: pulse 2s infinite;
        }

        .form-slide-in {
            animation: slideInFromBottom 0.6s ease-out 0.2s both;
        }

        .floating-shapes {
            position: absolute;
            width: 100%;
            height: 100%;
            overflow: hidden;
            z-index: -1;
        }

        .floating-shapes::before,
        .floating-shapes::after {
            content: '';
            position: absolute;
            border-radius: 50%;
            background: linear-gradient(45deg, rgba(59, 130, 246, 0.1), rgba(147, 197, 253, 0.1));
            animation: float 6s ease-in-out infinite;
        }

        .floating-shapes::before {
            width: 300px;
            height: 300px;
            top: -150px;
            left: -150px;
            animation-delay: 0s;
        }

        .floating-shapes::after {
            width: 200px;
            height: 200px;
            bottom: -100px;
            right: -100px;
            animation-delay: 3s;
        }

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

        @keyframes slideInFromBottom {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes pulse {
            0%, 100% {
                transform: scale(1);
            }
            50% {
                transform: scale(1.05);
            }
        }

        @keyframes float {
            0%, 100% {
                transform: translateY(0px) rotate(0deg);
            }
            50% {
                transform: translateY(-20px) rotate(180deg);
            }
        }

        .input-focus-effect {
            transition: all 0.3s ease;
        }

        .input-focus-effect:focus {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(59, 130, 246, 0.15);
        }

        .btn-hover-effect {
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .btn-hover-effect::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.5s;
        }

        .btn-hover-effect:hover::before {
            left: 100%;
        }

        .btn-hover-effect:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(59, 130, 246, 0.3);
        }
    </style>
</head>
<body class="min-h-screen bg-gradient-to-br from-blue-50 via-indigo-50 to-purple-50 dark:from-gray-900 dark:via-blue-900 dark:to-indigo-900 relative">
    <!-- Floating Background Shapes -->
    <div class="floating-shapes"></div>
    <!-- Language Switcher -->
    <div class="absolute top-6 {{ app()->getLocale() == 'ar' ? 'left-6' : 'right-6' }} z-20">
        <div class="flex items-center space-x-1 {{ app()->getLocale() == 'ar' ? 'space-x-reverse' : '' }} bg-white/80 dark:bg-gray-800/80 backdrop-blur-sm rounded-full p-1 shadow-lg">
            <a href="{{ route('language.switch', 'en') }}"
               class="px-4 py-2 text-sm font-medium rounded-full transition-all duration-300 {{ app()->getLocale() == 'en' ? 'bg-blue-600 text-white shadow-md' : 'text-gray-600 dark:text-gray-300 hover:text-blue-600 hover:bg-blue-50 dark:hover:bg-gray-700' }}">
                <i class="fas fa-globe {{ app()->getLocale() == 'ar' ? 'ml-1' : 'mr-1' }}"></i>
                EN
            </a>
            <a href="{{ route('language.switch', 'ar') }}"
               class="px-4 py-2 text-sm font-medium rounded-full transition-all duration-300 {{ app()->getLocale() == 'ar' ? 'bg-blue-600 text-white shadow-md' : 'text-gray-600 dark:text-gray-300 hover:text-blue-600 hover:bg-blue-50 dark:hover:bg-gray-700' }}">
                <i class="fas fa-globe {{ app()->getLocale() == 'ar' ? 'ml-1' : 'mr-1' }}"></i>
                العربية
            </a>
        </div>
    </div>

    <div class="min-h-screen flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-md w-full login-container">
            <!-- Company Logo and Branding -->
            <div class="text-center mb-8">
                <div class="mx-auto h-24 w-24 bg-gradient-to-r from-blue-600 via-blue-700 to-indigo-700 rounded-2xl flex items-center justify-center shadow-2xl logo-pulse mb-6">
                    <i class="fas fa-chart-line text-white text-3xl"></i>
                </div>

                <h2 class="text-2xl font-semibold text-gray-900 dark:text-white mb-2">
                    {{ __('auth.welcome_back') }}
                </h2>
                <p class="text-sm text-gray-600 dark:text-gray-400 mb-4">
                    {{ __('auth.login_subtitle') }}
                </p>

            </div>

            <!-- Login Form -->
            <div class="bg-white/80 dark:bg-gray-800/80 backdrop-blur-sm shadow-2xl rounded-3xl p-8 border border-gray-200/50 dark:border-gray-700/50 form-slide-in">
                <form class="space-y-6" method="POST" action="{{ route('login') }}">
                    @csrf

                    <!-- Email Field -->
                    <div class="space-y-2">
                        <label for="email" class="block text-sm font-semibold text-gray-700 dark:text-gray-300">
                            <i class="fas fa-envelope {{ app()->getLocale() == 'ar' ? 'ml-2' : 'mr-2' }} text-blue-500"></i>
                            {{ __('auth.email') }}
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 {{ app()->getLocale() == 'ar' ? 'right-0 pr-3' : 'left-0 pl-3' }} flex items-center pointer-events-none">
                                <i class="fas fa-user text-gray-400"></i>
                            </div>
                            <input id="email"
                                   name="email"
                                   type="email"
                                   autocomplete="email"
                                   required
                                   autofocus
                                   value="{{ old('email') }}"
                                   class="input-focus-effect block w-full {{ app()->getLocale() == 'ar' ? 'pr-10 pl-4' : 'pl-10 pr-4' }} py-4 border-2 border-gray-200 dark:border-gray-600 placeholder-gray-400 dark:placeholder-gray-500 text-gray-900 dark:text-white bg-gray-50 dark:bg-gray-700 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-300 @error('email') border-red-400 ring-red-400 @enderror"
                                   placeholder="{{ __('auth.email_placeholder') }}">
                            @error('email')
                                <div class="absolute inset-y-0 {{ app()->getLocale() == 'ar' ? 'left-0 pl-3' : 'right-0 pr-3' }} flex items-center pointer-events-none">
                                    <i class="fas fa-exclamation-circle text-red-500"></i>
                                </div>
                            @enderror
                        </div>
                        @error('email')
                            <div class="flex items-center mt-2 p-3 bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800 rounded-lg">
                                <i class="fas fa-exclamation-triangle text-red-500 {{ app()->getLocale() == 'ar' ? 'ml-2' : 'mr-2' }}"></i>
                                <p class="text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                            </div>
                            </p>
                        @enderror
                    </div>

                    <!-- Password Field -->
                    <div class="space-y-2">
                        <label for="password" class="block text-sm font-semibold text-gray-700 dark:text-gray-300">
                            <i class="fas fa-lock {{ app()->getLocale() == 'ar' ? 'ml-2' : 'mr-2' }} text-blue-500"></i>
                            {{ __('auth.password') }}
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 {{ app()->getLocale() == 'ar' ? 'right-0 pr-3' : 'left-0 pl-3' }} flex items-center pointer-events-none">
                                <i class="fas fa-key text-gray-400"></i>
                            </div>
                            <input id="password"
                                   name="password"
                                   type="password"
                                   autocomplete="current-password"
                                   required
                                   class="input-focus-effect block w-full {{ app()->getLocale() == 'ar' ? 'pr-10 pl-12' : 'pl-10 pr-12' }} py-4 border-2 border-gray-200 dark:border-gray-600 placeholder-gray-400 dark:placeholder-gray-500 text-gray-900 dark:text-white bg-gray-50 dark:bg-gray-700 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-300 @error('password') border-red-400 ring-red-400 @enderror"
                                   placeholder="{{ __('auth.password_placeholder') }}">
                            <button type="button"
                                    class="absolute inset-y-0 {{ app()->getLocale() == 'ar' ? 'left-0 pl-3' : 'right-0 pr-3' }} flex items-center toggle-password hover:bg-gray-100 dark:hover:bg-gray-600 rounded-lg transition-colors duration-200"
                                    onclick="togglePassword()">
                                <i class="fas fa-eye text-gray-400 hover:text-blue-500 transition-colors duration-200" id="password-toggle-icon"></i>
                            </button>
                            @error('password')
                                <div class="absolute inset-y-0 {{ app()->getLocale() == 'ar' ? 'left-10 pl-3' : 'right-10 pr-3' }} flex items-center pointer-events-none">
                                    <i class="fas fa-exclamation-circle text-red-500"></i>
                                </div>
                            @enderror
                        </div>
                        @error('password')
                            <div class="flex items-center mt-2 p-3 bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800 rounded-lg">
                                <i class="fas fa-exclamation-triangle text-red-500 {{ app()->getLocale() == 'ar' ? 'ml-2' : 'mr-2' }}"></i>
                                <p class="text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                            </div>
                        @enderror
                    </div>

                    <!-- Remember Me -->
                    <div class="flex items-center justify-between py-2">
                        <div class="flex items-center">
                            <input id="remember"
                                   name="remember"
                                   type="checkbox"
                                   {{ old('remember') ? 'checked' : '' }}
                                   class="h-5 w-5 text-blue-600 focus:ring-blue-500 border-2 border-gray-300 dark:border-gray-600 rounded-md bg-gray-50 dark:bg-gray-700 transition-colors duration-200">
                            <label for="remember" class="{{ app()->getLocale() == 'ar' ? 'mr-3' : 'ml-3' }} text-sm font-medium text-gray-700 dark:text-gray-300 cursor-pointer">
                                {{ __('auth.remember_me') }}
                            </label>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div class="pt-4">
                        <button type="submit"
                                class="btn-hover-effect group relative w-full flex justify-center items-center py-4 px-6 border border-transparent text-base font-semibold rounded-xl text-white bg-gradient-to-r from-blue-600 via-blue-700 to-indigo-700 hover:from-blue-700 hover:via-blue-800 hover:to-indigo-800 focus:outline-none focus:ring-4 focus:ring-blue-300 dark:focus:ring-blue-800 transition-all duration-300 shadow-lg">
                            <span class="absolute {{ app()->getLocale() == 'ar' ? 'right-0 pr-4' : 'left-0 pl-4' }} inset-y-0 flex items-center">
                                <i class="fas fa-sign-in-alt text-blue-200 group-hover:text-white transition-colors duration-200"></i>
                            </span>
                            <span class="relative">{{ __('auth.login_button') }}</span>
                            <span class="absolute {{ app()->getLocale() == 'ar' ? 'left-0 pl-4' : 'right-0 pr-4' }} inset-y-0 flex items-center">
                                <i class="fas fa-arrow-{{ app()->getLocale() == 'ar' ? 'left' : 'right' }} text-blue-200 group-hover:text-white transition-all duration-200 group-hover:translate-x-1"></i>
                            </span>
                        </button>
                    </div>
                </form>

                <!-- Additional Info -->
                <div class="mt-6 text-center">
                    <div class="flex items-center justify-center space-x-2 {{ app()->getLocale() == 'ar' ? 'space-x-reverse' : '' }} text-sm text-gray-600 dark:text-gray-400">
                        <i class="fas fa-shield-alt text-green-500"></i>
                        <span>{{ __('auth.secure_login') }}</span>
                    </div>
                </div>
            </div>

            <!-- Footer -->
            <div class="text-center mt-8 space-y-4">
                <div class="flex items-center justify-center space-x-4 {{ app()->getLocale() == 'ar' ? 'space-x-reverse' : '' }} text-sm text-gray-500 dark:text-gray-400">
                    <div class="flex items-center space-x-1 {{ app()->getLocale() == 'ar' ? 'space-x-reverse' : '' }}">
                        <i class="fas fa-phone text-blue-500"></i>
                        <span>+966 11 123 4567</span>
                    </div>
                    <div class="flex items-center space-x-1 {{ app()->getLocale() == 'ar' ? 'space-x-reverse' : '' }}">
                        <i class="fas fa-envelope text-blue-500"></i>
                        <span>info@qualityinvestment.com</span>
                    </div>
                </div>
                <p class="text-xs text-gray-500 dark:text-gray-400">
                    © {{ date('Y') }} {{ __('auth.company_name') }}. {{ __('auth.all_rights_reserved') }}
                </p>
            </div>
        </div>
    </div>

    <script>
        function togglePassword() {
            const passwordInput = document.getElementById('password');
            const toggleIcon = document.getElementById('password-toggle-icon');

            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                toggleIcon.classList.remove('fa-eye');
                toggleIcon.classList.add('fa-eye-slash');
            } else {
                passwordInput.type = 'password';
                toggleIcon.classList.remove('fa-eye-slash');
                toggleIcon.classList.add('fa-eye');
            }
        }

        // Enhanced form interactions
        document.addEventListener('DOMContentLoaded', function() {
            // Add focus effects to form inputs
            const inputs = document.querySelectorAll('input[type="email"], input[type="password"]');
            inputs.forEach(input => {
                input.addEventListener('focus', function() {
                    this.parentElement.classList.add('ring-2', 'ring-blue-500');
                });

                input.addEventListener('blur', function() {
                    this.parentElement.classList.remove('ring-2', 'ring-blue-500');
                });
            });

            // Auto-hide error messages after 7 seconds with fade effect
            setTimeout(function() {
                const errorMessages = document.querySelectorAll('.bg-red-50, .dark\\:bg-red-900\\/20');
                errorMessages.forEach(function(message) {
                    message.style.transition = 'all 0.5s ease-out';
                    message.style.opacity = '0';
                    message.style.transform = 'translateY(-10px)';
                    setTimeout(function() {
                        message.style.display = 'none';
                    }, 500);
                });
            }, 7000);

            // Add loading state to submit button
            const form = document.querySelector('form');
            const submitBtn = document.querySelector('button[type="submit"]');
            const originalText = submitBtn.innerHTML;

            form.addEventListener('submit', function() {
                submitBtn.disabled = true;
                submitBtn.innerHTML = `
                    <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                    {{ __('auth.logging_in') }}
                `;
            });
        });
    </script>
</body>
</html>

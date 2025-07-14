@extends('layouts.admin')

@section('title', __('admin.change_password'))

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <h1 class="text-2xl font-bold text-gray-900 dark:text-white">{{ __('admin.change_password') }}</h1>
            <p class="text-gray-600 dark:text-gray-400 mt-1">{{ __('admin.update_your_password') }}</p>
        </div>
        <a href="{{ route('admin.profile.index') }}"
           class="inline-flex items-center px-4 py-2 bg-gray-600 hover:bg-gray-700 text-white font-medium rounded-lg transition-colors duration-200">
            <i class="fas fa-arrow-{{ app()->getLocale() == 'ar' ? 'right' : 'left' }} {{ app()->getLocale() == 'ar' ? 'ml-2' : 'mr-2' }}"></i>
            {{ __('admin.back_to_profile') }}
        </a>
    </div>

    <!-- Password Change Form -->
    <div class="max-w-2xl">
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 p-6">
            <div class="mb-6">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">
                    <i class="fas fa-key {{ app()->getLocale() == 'ar' ? 'ml-2' : 'mr-2' }} text-red-600"></i>
                    {{ __('admin.security_settings') }}
                </h3>
                <p class="text-gray-600 dark:text-gray-400">
                    {{ __('admin.password_change_description') }}
                </p>
            </div>

            <form action="{{ route('admin.profile.update-password') }}" method="POST" class="space-y-6">
                @csrf
                @method('PUT')

                <!-- Current Password -->
                <div>
                    <label for="current_password" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        {{ __('admin.current_password') }} <span class="text-red-500">*</span>
                    </label>
                    <div class="relative">
                        <input type="password" 
                               id="current_password" 
                               name="current_password"
                               class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent dark:bg-gray-700 dark:text-white {{ app()->getLocale() == 'ar' ? 'pl-12' : 'pr-12' }}"
                               required>
                        <button type="button" 
                                class="absolute inset-y-0 {{ app()->getLocale() == 'ar' ? 'left-0 pl-3' : 'right-0 pr-3' }} flex items-center"
                                onclick="togglePassword('current_password')">
                            <i class="fas fa-eye text-gray-400 hover:text-gray-600 dark:hover:text-gray-300" id="current_password_icon"></i>
                        </button>
                    </div>
                    @error('current_password')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- New Password -->
                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        {{ __('admin.new_password') }} <span class="text-red-500">*</span>
                    </label>
                    <div class="relative">
                        <input type="password" 
                               id="password" 
                               name="password"
                               class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent dark:bg-gray-700 dark:text-white {{ app()->getLocale() == 'ar' ? 'pl-12' : 'pr-12' }}"
                               required>
                        <button type="button" 
                                class="absolute inset-y-0 {{ app()->getLocale() == 'ar' ? 'left-0 pl-3' : 'right-0 pr-3' }} flex items-center"
                                onclick="togglePassword('password')">
                            <i class="fas fa-eye text-gray-400 hover:text-gray-600 dark:hover:text-gray-300" id="password_icon"></i>
                        </button>
                    </div>
                    @error('password')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                    
                    <!-- Password Strength Indicator -->
                    <div class="mt-2">
                        <div class="flex items-center space-x-2 {{ app()->getLocale() == 'ar' ? 'space-x-reverse' : '' }}">
                            <div class="flex-1 bg-gray-200 dark:bg-gray-600 rounded-full h-2">
                                <div id="password-strength-bar" class="h-2 rounded-full transition-all duration-300" style="width: 0%;"></div>
                            </div>
                            <span id="password-strength-text" class="text-sm text-gray-500 dark:text-gray-400"></span>
                        </div>
                        <div class="mt-2 text-sm text-gray-500 dark:text-gray-400">
                            <p>{{ __('admin.password_requirements') }}:</p>
                            <ul class="list-disc {{ app()->getLocale() == 'ar' ? 'list-inside' : 'ml-4' }} mt-1 space-y-1">
                                <li id="length-check" class="text-gray-500">{{ __('admin.password_length') }}</li>
                                <li id="uppercase-check" class="text-gray-500">{{ __('admin.password_uppercase') }}</li>
                                <li id="lowercase-check" class="text-gray-500">{{ __('admin.password_lowercase') }}</li>
                                <li id="number-check" class="text-gray-500">{{ __('admin.password_number') }}</li>
                                <li id="special-check" class="text-gray-500">{{ __('admin.password_special') }}</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- Confirm New Password -->
                <div>
                    <label for="password_confirmation" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        {{ __('admin.confirm_new_password') }} <span class="text-red-500">*</span>
                    </label>
                    <div class="relative">
                        <input type="password" 
                               id="password_confirmation" 
                               name="password_confirmation"
                               class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent dark:bg-gray-700 dark:text-white {{ app()->getLocale() == 'ar' ? 'pl-12' : 'pr-12' }}"
                               required>
                        <button type="button" 
                                class="absolute inset-y-0 {{ app()->getLocale() == 'ar' ? 'left-0 pl-3' : 'right-0 pr-3' }} flex items-center"
                                onclick="togglePassword('password_confirmation')">
                            <i class="fas fa-eye text-gray-400 hover:text-gray-600 dark:hover:text-gray-300" id="password_confirmation_icon"></i>
                        </button>
                    </div>
                    @error('password_confirmation')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                    <div id="password-match" class="mt-1 text-sm"></div>
                </div>

                <!-- Security Notice -->
                <div class="bg-yellow-50 dark:bg-yellow-900/20 border border-yellow-200 dark:border-yellow-800 rounded-lg p-4">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <i class="fas fa-exclamation-triangle text-yellow-400"></i>
                        </div>
                        <div class="{{ app()->getLocale() == 'ar' ? 'mr-3' : 'ml-3' }}">
                            <h3 class="text-sm font-medium text-yellow-800 dark:text-yellow-200">
                                {{ __('admin.security_notice') }}
                            </h3>
                            <div class="mt-2 text-sm text-yellow-700 dark:text-yellow-300">
                                <p>{{ __('admin.password_change_notice') }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Submit Buttons -->
                <div class="flex justify-end space-x-4 {{ app()->getLocale() == 'ar' ? 'space-x-reverse' : '' }}">
                    <a href="{{ route('admin.profile.index') }}"
                       class="px-6 py-3 border border-gray-300 dark:border-gray-600 text-gray-700 dark:text-gray-300 font-medium rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors duration-200">
                        {{ __('admin.cancel') }}
                    </a>
                    <button type="submit"
                            id="submit-btn"
                            class="px-6 py-3 bg-red-600 hover:bg-red-700 text-white font-medium rounded-lg transition-colors duration-200 disabled:opacity-50 disabled:cursor-not-allowed"
                            disabled>
                        <i class="fas fa-key {{ app()->getLocale() == 'ar' ? 'ml-2' : 'mr-2' }}"></i>
                        {{ __('admin.update_password') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const passwordInput = document.getElementById('password');
    const confirmPasswordInput = document.getElementById('password_confirmation');
    const submitBtn = document.getElementById('submit-btn');
    
    // Password visibility toggle
    window.togglePassword = function(fieldId) {
        const field = document.getElementById(fieldId);
        const icon = document.getElementById(fieldId + '_icon');
        
        if (field.type === 'password') {
            field.type = 'text';
            icon.classList.remove('fa-eye');
            icon.classList.add('fa-eye-slash');
        } else {
            field.type = 'password';
            icon.classList.remove('fa-eye-slash');
            icon.classList.add('fa-eye');
        }
    };
    
    // Password strength checker
    passwordInput.addEventListener('input', function() {
        checkPasswordStrength(this.value);
        checkPasswordMatch();
    });
    
    confirmPasswordInput.addEventListener('input', function() {
        checkPasswordMatch();
    });
    
    function checkPasswordStrength(password) {
        const strengthBar = document.getElementById('password-strength-bar');
        const strengthText = document.getElementById('password-strength-text');
        
        let score = 0;
        let feedback = [];
        
        // Length check
        const lengthCheck = document.getElementById('length-check');
        if (password.length >= 8) {
            score += 20;
            lengthCheck.className = 'text-green-600';
        } else {
            lengthCheck.className = 'text-gray-500';
        }
        
        // Uppercase check
        const uppercaseCheck = document.getElementById('uppercase-check');
        if (/[A-Z]/.test(password)) {
            score += 20;
            uppercaseCheck.className = 'text-green-600';
        } else {
            uppercaseCheck.className = 'text-gray-500';
        }
        
        // Lowercase check
        const lowercaseCheck = document.getElementById('lowercase-check');
        if (/[a-z]/.test(password)) {
            score += 20;
            lowercaseCheck.className = 'text-green-600';
        } else {
            lowercaseCheck.className = 'text-gray-500';
        }
        
        // Number check
        const numberCheck = document.getElementById('number-check');
        if (/[0-9]/.test(password)) {
            score += 20;
            numberCheck.className = 'text-green-600';
        } else {
            numberCheck.className = 'text-gray-500';
        }
        
        // Special character check
        const specialCheck = document.getElementById('special-check');
        if (/[^A-Za-z0-9]/.test(password)) {
            score += 20;
            specialCheck.className = 'text-green-600';
        } else {
            specialCheck.className = 'text-gray-500';
        }
        
        // Update strength bar
        strengthBar.style.width = score + '%';
        
        if (score < 40) {
            strengthBar.className = 'h-2 rounded-full transition-all duration-300 bg-red-500';
            strengthText.textContent = '{{ __("admin.weak") }}';
            strengthText.className = 'text-sm text-red-500';
        } else if (score < 80) {
            strengthBar.className = 'h-2 rounded-full transition-all duration-300 bg-yellow-500';
            strengthText.textContent = '{{ __("admin.medium") }}';
            strengthText.className = 'text-sm text-yellow-500';
        } else {
            strengthBar.className = 'h-2 rounded-full transition-all duration-300 bg-green-500';
            strengthText.textContent = '{{ __("admin.strong") }}';
            strengthText.className = 'text-sm text-green-500';
        }
    }
    
    function checkPasswordMatch() {
        const password = passwordInput.value;
        const confirmPassword = confirmPasswordInput.value;
        const matchDiv = document.getElementById('password-match');
        
        if (confirmPassword.length > 0) {
            if (password === confirmPassword) {
                matchDiv.textContent = '{{ __("admin.passwords_match") }}';
                matchDiv.className = 'mt-1 text-sm text-green-600';
                submitBtn.disabled = false;
            } else {
                matchDiv.textContent = '{{ __("admin.passwords_do_not_match") }}';
                matchDiv.className = 'mt-1 text-sm text-red-600';
                submitBtn.disabled = true;
            }
        } else {
            matchDiv.textContent = '';
            submitBtn.disabled = true;
        }
    }
});
</script>
@endpush

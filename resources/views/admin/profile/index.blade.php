@extends('layouts.admin')

@section('title', __('admin.profile'))

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <h1 class="text-2xl font-bold text-gray-900 dark:text-white">{{ __('admin.profile') }}</h1>
            <p class="text-gray-600 dark:text-gray-400 mt-1">{{ __('admin.manage_your_profile') }}</p>
        </div>
        <div class="flex gap-3">
            <a href="{{ route('admin.profile.edit') }}"
               class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg transition-colors duration-200">
                <i class="fas fa-edit {{ app()->getLocale() == 'ar' ? 'ml-2' : 'mr-2' }}"></i>
                {{ __('admin.edit_profile') }}
            </a>
            <a href="{{ route('admin.profile.change-password') }}"
               class="inline-flex items-center px-4 py-2 bg-green-600 hover:bg-green-700 text-white font-medium rounded-lg transition-colors duration-200">
                <i class="fas fa-key {{ app()->getLocale() == 'ar' ? 'ml-2' : 'mr-2' }}"></i>
                {{ __('admin.change_password') }}
            </a>
        </div>
    </div>

    <!-- Profile Card -->
    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 overflow-hidden">
        <!-- Cover Section -->
        <div class="h-32 bg-gradient-to-r from-blue-600 via-purple-600 to-green-600"></div>
        
        <!-- Profile Info Section -->
        <div class="relative px-6 pb-6">
            <!-- Avatar -->
            <div class="flex flex-col sm:flex-row sm:items-end sm:space-x-5 {{ app()->getLocale() == 'ar' ? 'sm:space-x-reverse' : '' }}">
                <div class="relative -mt-16 mb-4 sm:mb-0">
                    <div class="w-32 h-32 bg-white dark:bg-gray-800 rounded-full p-2 shadow-lg">
                        <img src="{{ $user->getAvatarUrl() }}" 
                             alt="{{ $user->name }}"
                             class="w-full h-full rounded-full object-cover">
                    </div>
                    <!-- Status Badge -->
                    <div class="absolute bottom-2 {{ app()->getLocale() == 'ar' ? 'left-2' : 'right-2' }}">
                        <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium
                            {{ $user->is_active ? 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200' : 'bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200' }}">
                            <span class="w-2 h-2 {{ $user->is_active ? 'bg-green-400' : 'bg-red-400' }} rounded-full {{ app()->getLocale() == 'ar' ? 'ml-1' : 'mr-1' }}"></span>
                            {{ $user->getStatusLabel() }}
                        </span>
                    </div>
                </div>
                
                <!-- User Info -->
                <div class="flex-1 min-w-0">
                    <h2 class="text-2xl font-bold text-gray-900 dark:text-white truncate">{{ $user->name }}</h2>
                    <p class="text-gray-600 dark:text-gray-400">{{ $user->email }}</p>
                    <div class="flex items-center mt-2 space-x-4 {{ app()->getLocale() == 'ar' ? 'space-x-reverse' : '' }}">
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium
                            {{ $user->role === 'admin' ? 'bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200' : 
                               ($user->role === 'editor' ? 'bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200' : 
                                'bg-gray-100 text-gray-800 dark:bg-gray-900 dark:text-gray-200') }}">
                            <i class="fas fa-{{ $user->role === 'admin' ? 'crown' : ($user->role === 'editor' ? 'edit' : 'eye') }} {{ app()->getLocale() == 'ar' ? 'ml-1' : 'mr-1' }}"></i>
                            {{ $user->getRoleLabel() }}
                        </span>
                        @if($user->last_login_at)
                        <span class="text-sm text-gray-500 dark:text-gray-400">
                            <i class="fas fa-clock {{ app()->getLocale() == 'ar' ? 'ml-1' : 'mr-1' }}"></i>
                            {{ __('admin.last_login') }}: {{ $user->getLastLoginFormatted() }}
                        </span>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Profile Details -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Personal Information -->
        <div class="lg:col-span-2">
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 p-6">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-6">
                    <i class="fas fa-user {{ app()->getLocale() == 'ar' ? 'ml-2' : 'mr-2' }} text-blue-600"></i>
                    {{ __('admin.personal_information') }}
                </h3>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            {{ __('admin.full_name') }}
                        </label>
                        <p class="text-gray-900 dark:text-white font-medium">{{ $user->name }}</p>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            {{ __('admin.email_address') }}
                        </label>
                        <p class="text-gray-900 dark:text-white font-medium">{{ $user->email }}</p>
                    </div>
                    
                    @if($user->phone)
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            {{ __('admin.phone_number') }}
                        </label>
                        <p class="text-gray-900 dark:text-white font-medium">{{ $user->phone }}</p>
                    </div>
                    @endif
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            {{ __('admin.role') }}
                        </label>
                        <p class="text-gray-900 dark:text-white font-medium">{{ $user->getRoleLabel() }}</p>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            {{ __('admin.account_status') }}
                        </label>
                        <p class="text-gray-900 dark:text-white font-medium">{{ $user->getStatusLabel() }}</p>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            {{ __('admin.member_since') }}
                        </label>
                        <p class="text-gray-900 dark:text-white font-medium">{{ $user->created_at->format('M d, Y') }}</p>
                    </div>
                </div>
                
                @if($user->bio)
                <div class="mt-6">
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        {{ __('admin.bio') }}
                    </label>
                    <p class="text-gray-900 dark:text-white">{{ $user->bio }}</p>
                </div>
                @endif
            </div>
        </div>

        <!-- Account Statistics -->
        <div class="space-y-6">
            <!-- Quick Stats -->
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 p-6">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">
                    <i class="fas fa-chart-bar {{ app()->getLocale() == 'ar' ? 'ml-2' : 'mr-2' }} text-green-600"></i>
                    {{ __('admin.account_stats') }}
                </h3>
                
                <div class="space-y-4">
                    <div class="flex items-center justify-between">
                        <span class="text-gray-600 dark:text-gray-400">{{ __('admin.total_logins') }}</span>
                        <span class="font-semibold text-gray-900 dark:text-white">--</span>
                    </div>
                    
                    @if($user->last_login_at)
                    <div class="flex items-center justify-between">
                        <span class="text-gray-600 dark:text-gray-400">{{ __('admin.last_login') }}</span>
                        <span class="font-semibold text-gray-900 dark:text-white">{{ $user->last_login_at->format('M d, Y') }}</span>
                    </div>
                    @endif
                    
                    <div class="flex items-center justify-between">
                        <span class="text-gray-600 dark:text-gray-400">{{ __('admin.account_created') }}</span>
                        <span class="font-semibold text-gray-900 dark:text-white">{{ $user->created_at->format('M d, Y') }}</span>
                    </div>
                </div>
            </div>

            <!-- Security Info -->
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 p-6">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">
                    <i class="fas fa-shield-alt {{ app()->getLocale() == 'ar' ? 'ml-2' : 'mr-2' }} text-red-600"></i>
                    {{ __('admin.security') }}
                </h3>
                
                <div class="space-y-3">
                    <div class="flex items-center justify-between">
                        <span class="text-gray-600 dark:text-gray-400">{{ __('admin.password') }}</span>
                        <a href="{{ route('admin.profile.change-password') }}" 
                           class="text-blue-600 hover:text-blue-700 dark:text-blue-400 dark:hover:text-blue-300 text-sm font-medium">
                            {{ __('admin.change') }}
                        </a>
                    </div>
                    
                    <div class="flex items-center justify-between">
                        <span class="text-gray-600 dark:text-gray-400">{{ __('admin.two_factor') }}</span>
                        <span class="text-gray-500 dark:text-gray-400 text-sm">{{ __('admin.not_enabled') }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

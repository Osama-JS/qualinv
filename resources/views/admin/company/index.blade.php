@extends('layouts.admin')

@section('page-title', __('admin.company_info'))

@section('content')
<div class="mb-6 flex justify-between items-center">
    <div>
        <h1 class="text-3xl font-bold text-gray-900 dark:text-gray-100">{{ __('admin.company_info') }}</h1>
        <p class="text-gray-600 dark:text-gray-400">{{ __('Manage your company information and details') }}</p>
    </div>
    <a href="{{ route('admin.company.edit') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg transition-colors">
        <i class="fas fa-edit mr-2"></i>
        {{ __('admin.edit') }}
    </a>
</div>

@if($company)
<div class="bg-white dark:bg-gray-800 shadow-sm rounded-lg overflow-hidden">
    <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
        <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">{{ __('admin.company_info') }}</h3>
    </div>
    
    <div class="p-6">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <!-- Company Logo -->
            @if($company->logo)
            <div class="lg:col-span-2">
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">{{ __('admin.company_logo') }}</label>
                <div class="flex items-center">
                    <img src="{{ Storage::url($company->logo) }}" alt="Company Logo" class="h-20 w-auto object-contain">
                </div>
            </div>
            @endif
            
            <!-- Company Name -->
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">{{ __('admin.company_name') }} (English)</label>
                <p class="text-gray-900 dark:text-gray-100">{{ $company->getLocalizedName('en') ?: 'Not set' }}</p>
            </div>
            
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">{{ __('admin.company_name') }} (العربية)</label>
                <p class="text-gray-900 dark:text-gray-100">{{ $company->getLocalizedName('ar') ?: 'غير محدد' }}</p>
            </div>
            
            <!-- Contact Information -->
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">{{ __('admin.contact_email') }}</label>
                <p class="text-gray-900 dark:text-gray-100">{{ $company->email ?: 'Not set' }}</p>
            </div>
            
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">{{ __('admin.contact_phone') }}</label>
                <p class="text-gray-900 dark:text-gray-100">{{ $company->phone ?: 'Not set' }}</p>
            </div>
            
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">{{ __('admin.company_website') }}</label>
                <p class="text-gray-900 dark:text-gray-100">
                    @if($company->website)
                        <a href="{{ $company->website }}" target="_blank" class="text-blue-600 hover:text-blue-800">{{ $company->website }}</a>
                    @else
                        Not set
                    @endif
                </p>
            </div>
            
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">{{ __('admin.company_address') }}</label>
                <p class="text-gray-900 dark:text-gray-100">{{ $company->address ?: 'Not set' }}</p>
            </div>
        </div>
        
        <!-- About Us -->
        @if($company->getLocalizedAbout('en') || $company->getLocalizedAbout('ar'))
        <div class="mt-6">
            <h4 class="text-lg font-medium text-gray-900 dark:text-gray-100 mb-4">{{ __('admin.about_us') }}</h4>
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">English</label>
                    <div class="prose dark:prose-invert max-w-none">
                        {!! nl2br(e($company->getLocalizedAbout('en'))) !!}
                    </div>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">العربية</label>
                    <div class="prose dark:prose-invert max-w-none">
                        {!! nl2br(e($company->getLocalizedAbout('ar'))) !!}
                    </div>
                </div>
            </div>
        </div>
        @endif
        
        <!-- Mission -->
        @if($company->getLocalizedMission('en') || $company->getLocalizedMission('ar'))
        <div class="mt-6">
            <h4 class="text-lg font-medium text-gray-900 dark:text-gray-100 mb-4">{{ __('admin.our_mission') }}</h4>
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">English</label>
                    <div class="prose dark:prose-invert max-w-none">
                        {!! nl2br(e($company->getLocalizedMission('en'))) !!}
                    </div>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">العربية</label>
                    <div class="prose dark:prose-invert max-w-none">
                        {!! nl2br(e($company->getLocalizedMission('ar'))) !!}
                    </div>
                </div>
            </div>
        </div>
        @endif
        
        <!-- Vision -->
        @if($company->getLocalizedVision('en') || $company->getLocalizedVision('ar'))
        <div class="mt-6">
            <h4 class="text-lg font-medium text-gray-900 dark:text-gray-100 mb-4">{{ __('admin.our_vision') }}</h4>
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">English</label>
                    <div class="prose dark:prose-invert max-w-none">
                        {!! nl2br(e($company->getLocalizedVision('en'))) !!}
                    </div>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">العربية</label>
                    <div class="prose dark:prose-invert max-w-none">
                        {!! nl2br(e($company->getLocalizedVision('ar'))) !!}
                    </div>
                </div>
            </div>
        </div>
        @endif
        
        <!-- Values -->
        @if($company->getLocalizedValues('en') || $company->getLocalizedValues('ar'))
        <div class="mt-6">
            <h4 class="text-lg font-medium text-gray-900 dark:text-gray-100 mb-4">{{ __('admin.our_values') }}</h4>
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">English</label>
                    <div class="prose dark:prose-invert max-w-none">
                        {!! nl2br(e($company->getLocalizedValues('en'))) !!}
                    </div>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">العربية</label>
                    <div class="prose dark:prose-invert max-w-none">
                        {!! nl2br(e($company->getLocalizedValues('ar'))) !!}
                    </div>
                </div>
            </div>
        </div>
        @endif
    </div>
</div>
@else
<div class="bg-white dark:bg-gray-800 shadow-sm rounded-lg">
    <div class="p-6 text-center">
        <i class="fas fa-building text-4xl text-gray-400 dark:text-gray-600 mb-4"></i>
        <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100 mb-2">{{ __('No company information found') }}</h3>
        <p class="text-gray-600 dark:text-gray-400 mb-4">{{ __('Set up your company information to get started.') }}</p>
        <a href="{{ route('admin.company.edit') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg transition-colors">
            <i class="fas fa-plus mr-2"></i>
            {{ __('admin.create') }}
        </a>
    </div>
</div>
@endif
@endsection

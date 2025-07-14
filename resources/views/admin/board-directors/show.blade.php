@extends('layouts.admin')

@section('page-title', $boardDirector->getLocalizedName())

@section('content')
<div class="mb-6">
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-3xl font-bold text-gray-900 dark:text-gray-100">{{ $boardDirector->getLocalizedName() }}</h1>
            <p class="text-gray-600 dark:text-gray-400">{{ $boardDirector->getLocalizedPosition() }}</p>
        </div>
        <div class="flex space-x-4">
            <a href="{{ route('admin.board-directors.edit', $boardDirector) }}" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg transition-colors">
                <i class="fas fa-edit mr-2"></i>
                {{ __('admin.edit') }}
            </a>
            <a href="{{ route('admin.board-directors.index') }}" class="bg-gray-600 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded-lg transition-colors">
                <i class="fas fa-arrow-left mr-2"></i>
                {{ __('admin.back_to_list') }}
            </a>
        </div>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
    <!-- Profile Card -->
    <div class="lg:col-span-1">
        <div class="bg-white dark:bg-gray-800 shadow-sm rounded-lg overflow-hidden">
            @if($boardDirector->photo)
                <img src="{{ asset('storage/' . $boardDirector->photo) }}" alt="{{ $boardDirector->getLocalizedName() }}" 
                     class="w-full h-64 object-cover">
            @else
                <div class="w-full h-64 bg-gray-300 dark:bg-gray-600 flex items-center justify-center">
                    <i class="fas fa-user text-gray-500 dark:text-gray-400 text-6xl"></i>
                </div>
            @endif
            
            <div class="p-6">
                <h3 class="text-xl font-bold text-gray-900 dark:text-gray-100 mb-2">
                    {{ $boardDirector->getLocalizedName() }}
                </h3>
                <p class="text-gray-600 dark:text-gray-400 mb-4">
                    {{ $boardDirector->getLocalizedPosition() }}
                </p>
                
                <!-- Status -->
                <div class="mb-4">
                    @if($boardDirector->is_active)
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200">
                            <i class="fas fa-check-circle mr-2"></i>
                            {{ __('admin.active') }}
                        </span>
                    @else
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200">
                            <i class="fas fa-times-circle mr-2"></i>
                            {{ __('admin.inactive') }}
                        </span>
                    @endif
                </div>

                <!-- Contact Information -->
                @if($boardDirector->email || $boardDirector->phone)
                <div class="border-t border-gray-200 dark:border-gray-700 pt-4">
                    <h4 class="text-sm font-medium text-gray-900 dark:text-gray-100 mb-3">{{ __('admin.contact_information') }}</h4>
                    
                    @if($boardDirector->email)
                    <div class="flex items-center mb-2">
                        <i class="fas fa-envelope text-gray-400 mr-3"></i>
                        <a href="mailto:{{ $boardDirector->email }}" class="text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-300">
                            {{ $boardDirector->email }}
                        </a>
                    </div>
                    @endif
                    
                    @if($boardDirector->phone)
                    <div class="flex items-center">
                        <i class="fas fa-phone text-gray-400 mr-3"></i>
                        <a href="tel:{{ $boardDirector->phone }}" class="text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-300">
                            {{ $boardDirector->phone }}
                        </a>
                    </div>
                    @endif
                </div>
                @endif

                <!-- Sort Order -->
                <div class="border-t border-gray-200 dark:border-gray-700 pt-4 mt-4">
                    <div class="flex justify-between items-center">
                        <span class="text-sm font-medium text-gray-900 dark:text-gray-100">{{ __('admin.sort_order') }}</span>
                        <span class="text-sm text-gray-600 dark:text-gray-400">{{ $boardDirector->sort_order }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Details -->
    <div class="lg:col-span-2 space-y-8">
        <!-- Names in Both Languages -->
        <div class="bg-white dark:bg-gray-800 shadow-sm rounded-lg">
            <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">{{ __('admin.names') }}</h3>
            </div>
            <div class="p-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            {{ __('admin.name') }} (English)
                        </label>
                        <p class="text-gray-900 dark:text-gray-100">{{ $boardDirector->name['en'] ?? '-' }}</p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            {{ __('admin.name') }} (العربية)
                        </label>
                        <p class="text-gray-900 dark:text-gray-100" dir="rtl">{{ $boardDirector->name['ar'] ?? '-' }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Positions in Both Languages -->
        <div class="bg-white dark:bg-gray-800 shadow-sm rounded-lg">
            <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">{{ __('admin.positions') }}</h3>
            </div>
            <div class="p-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            {{ __('admin.position') }} (English)
                        </label>
                        <p class="text-gray-900 dark:text-gray-100">{{ $boardDirector->position['en'] ?? '-' }}</p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            {{ __('admin.position') }} (العربية)
                        </label>
                        <p class="text-gray-900 dark:text-gray-100" dir="rtl">{{ $boardDirector->position['ar'] ?? '-' }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Biography -->
        @if($boardDirector->bio['en'] || $boardDirector->bio['ar'])
        <div class="bg-white dark:bg-gray-800 shadow-sm rounded-lg">
            <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">{{ __('admin.biography') }}</h3>
            </div>
            <div class="p-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    @if($boardDirector->bio['en'])
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            {{ __('admin.biography') }} (English)
                        </label>
                        <div class="prose prose-sm max-w-none text-gray-900 dark:text-gray-100">
                            {!! $boardDirector->bio['en'] !!}
                        </div>
                    </div>
                    @endif
                    
                    @if($boardDirector->bio['ar'])
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            {{ __('admin.biography') }} (العربية)
                        </label>
                        <div class="prose prose-sm max-w-none text-gray-900 dark:text-gray-100" dir="rtl">
                            {!! $boardDirector->bio['ar'] !!}
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
        @endif

        <!-- Metadata -->
        <div class="bg-white dark:bg-gray-800 shadow-sm rounded-lg">
            <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">{{ __('admin.metadata') }}</h3>
            </div>
            <div class="p-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            {{ __('admin.created_at') }}
                        </label>
                        <p class="text-gray-900 dark:text-gray-100">
                            {{ $boardDirector->created_at->format('Y-m-d H:i:s') }}
                        </p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            {{ __('admin.updated_at') }}
                        </label>
                        <p class="text-gray-900 dark:text-gray-100">
                            {{ $boardDirector->updated_at->format('Y-m-d H:i:s') }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

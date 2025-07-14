@extends('layouts.admin')

@section('title', __('admin.user_details'))

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <h1 class="text-2xl font-bold text-gray-900 dark:text-white {{ app()->getLocale() == 'ar' ? 'font-arabic-bold' : 'font-english' }}">
                {{ __('admin.user_details') }}
            </h1>
            <nav class="flex mt-2" aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-1 md:space-x-3 {{ app()->getLocale() == 'ar' ? 'space-x-reverse' : '' }}">
                    <li class="inline-flex items-center">
                        <a href="{{ route('admin.dashboard') }}" class="text-gray-700 hover:text-blue-600 dark:text-gray-300 dark:hover:text-blue-400 transition-colors duration-200">
                            {{ __('admin.dashboard') }}
                        </a>
                    </li>
                    <li>
                        <div class="flex items-center">
                            <i class="fas fa-chevron-{{ app()->getLocale() == 'ar' ? 'left' : 'right' }} text-gray-400 mx-2"></i>
                            <a href="{{ route('admin.users.index') }}" class="text-gray-700 hover:text-blue-600 dark:text-gray-300 dark:hover:text-blue-400 transition-colors duration-200">
                                {{ __('admin.user_management') }}
                            </a>
                        </div>
                    </li>
                    <li>
                        <div class="flex items-center">
                            <i class="fas fa-chevron-{{ app()->getLocale() == 'ar' ? 'left' : 'right' }} text-gray-400 mx-2"></i>
                            <span class="text-gray-500 dark:text-gray-400 {{ app()->getLocale() == 'ar' ? 'font-arabic-normal' : 'font-english' }}">{{ $user->name }}</span>
                        </div>
                    </li>
                </ol>
            </nav>
        </div>
        <div class="flex flex-col sm:flex-row gap-2">
            <a href="{{ route('admin.users.edit', $user) }}"
               class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg transition-colors duration-200">
                <i class="fas fa-edit {{ app()->getLocale() == 'ar' ? 'ml-2' : 'mr-2' }}"></i>
                {{ __('admin.edit_user') }}
            </a>
            <a href="{{ route('admin.users.index') }}"
               class="inline-flex items-center px-4 py-2 bg-gray-600 hover:bg-gray-700 text-white font-medium rounded-lg transition-colors duration-200">
                <i class="fas fa-arrow-left {{ app()->getLocale() == 'ar' ? 'ml-2' : 'mr-2' }}"></i>
                {{ __('admin.back_to_users') }}
            </a>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <div class="lg:col-span-2">
            <!-- User Information -->
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700">
                <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white {{ app()->getLocale() == 'ar' ? 'font-arabic-medium' : 'font-english' }}">
                        {{ __('admin.user_information') }}
                    </h3>
                </div>
                <div class="p-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-1">
                            <label class="text-sm font-medium text-gray-500 dark:text-gray-400 {{ app()->getLocale() == 'ar' ? 'font-arabic-normal' : 'font-english' }}">
                                {{ __('admin.name') }}
                            </label>
                            <div class="text-lg font-semibold text-gray-900 dark:text-white {{ app()->getLocale() == 'ar' ? 'font-arabic-medium' : 'font-english' }}">
                                {{ $user->name }}
                            </div>
                        </div>

                        <div class="space-y-1">
                            <label class="text-sm font-medium text-gray-500 dark:text-gray-400 {{ app()->getLocale() == 'ar' ? 'font-arabic-normal' : 'font-english' }}">
                                {{ __('admin.email') }}
                            </label>
                            <div class="text-lg font-semibold text-gray-900 dark:text-white {{ app()->getLocale() == 'ar' ? 'font-arabic-medium' : 'font-english' }}">
                                {{ $user->email }}
                            </div>
                        </div>

                        <div class="space-y-1">
                            <label class="text-sm font-medium text-gray-500 dark:text-gray-400 {{ app()->getLocale() == 'ar' ? 'font-arabic-normal' : 'font-english' }}">
                                {{ __('admin.role') }}
                            </label>
                            <div>
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium
                                    {{ $user->role === 'admin' ? 'bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200' :
                                       ($user->role === 'editor' ? 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-200' :
                                        'bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-300') }}">
                                    {{ __('admin.' . $user->role) }}
                                </span>
                            </div>
                        </div>

                        <div class="space-y-1">
                            <label class="text-sm font-medium text-gray-500 dark:text-gray-400 {{ app()->getLocale() == 'ar' ? 'font-arabic-normal' : 'font-english' }}">
                                {{ __('admin.status') }}
                            </label>
                            <div class="flex items-center gap-2">
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium
                                    {{ $user->is_active ? 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200' :
                                       'bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-300' }}">
                                    {{ $user->is_active ? __('admin.active') : __('admin.inactive') }}
                                </span>
                                @if($user->id === auth()->id())
                                    <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200">
                                        {{ __('admin.you') }}
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="space-y-1">
                            <label class="text-sm font-medium text-gray-500 dark:text-gray-400 {{ app()->getLocale() == 'ar' ? 'font-arabic-normal' : 'font-english' }}">
                                {{ __('admin.email_verified') }}
                            </label>
                            <div>
                                @if($user->email_verified_at)
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200">
                                        <i class="fas fa-check {{ app()->getLocale() == 'ar' ? 'ml-1' : 'mr-1' }}"></i>
                                        {{ __('admin.verified') }}
                                    </span>
                                    <div class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                                        {{ $user->email_verified_at->format('Y-m-d H:i') }}
                                    </div>
                                @else
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-200">
                                        <i class="fas fa-exclamation-triangle {{ app()->getLocale() == 'ar' ? 'ml-1' : 'mr-1' }}"></i>
                                        {{ __('admin.not_verified') }}
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="space-y-1">
                            <label class="text-sm font-medium text-gray-500 dark:text-gray-400 {{ app()->getLocale() == 'ar' ? 'font-arabic-normal' : 'font-english' }}">
                                {{ __('admin.user_id') }}
                            </label>
                            <div class="text-lg font-semibold text-gray-900 dark:text-white font-mono">
                                #{{ $user->id }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Account Timeline -->
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700">
                <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white {{ app()->getLocale() == 'ar' ? 'font-arabic-medium' : 'font-english' }}">
                        {{ __('admin.account_timeline') }}
                    </h3>
                </div>
                <div class="p-6">
                    <div class="space-y-6">
                        <div class="flex items-start">
                            <div class="flex-shrink-0">
                                <div class="w-3 h-3 bg-green-500 rounded-full mt-2"></div>
                            </div>
                            <div class="{{ app()->getLocale() == 'ar' ? 'mr-4' : 'ml-4' }} flex-1">
                                <h4 class="text-sm font-semibold text-gray-900 dark:text-white {{ app()->getLocale() == 'ar' ? 'font-arabic-medium' : 'font-english' }}">
                                    {{ __('admin.account_created') }}
                                </h4>
                                <p class="text-sm text-gray-600 dark:text-gray-400 mt-1 {{ app()->getLocale() == 'ar' ? 'font-arabic-normal' : 'font-english' }}">
                                    {{ __('admin.user_account_created_on') }} {{ $user->created_at->format('F j, Y \a\t g:i A') }}
                                </p>
                                <span class="text-xs text-gray-500 dark:text-gray-500">{{ $user->created_at->diffForHumans() }}</span>
                            </div>
                        </div>

                        @if($user->email_verified_at)
                        <div class="flex items-start">
                            <div class="flex-shrink-0">
                                <div class="w-3 h-3 bg-blue-500 rounded-full mt-2"></div>
                            </div>
                            <div class="{{ app()->getLocale() == 'ar' ? 'mr-4' : 'ml-4' }} flex-1">
                                <h4 class="text-sm font-semibold text-gray-900 dark:text-white {{ app()->getLocale() == 'ar' ? 'font-arabic-medium' : 'font-english' }}">
                                    {{ __('admin.email_verified') }}
                                </h4>
                                <p class="text-sm text-gray-600 dark:text-gray-400 mt-1 {{ app()->getLocale() == 'ar' ? 'font-arabic-normal' : 'font-english' }}">
                                    {{ __('admin.email_verified_on') }} {{ $user->email_verified_at->format('F j, Y \a\t g:i A') }}
                                </p>
                                <span class="text-xs text-gray-500 dark:text-gray-500">{{ $user->email_verified_at->diffForHumans() }}</span>
                            </div>
                        </div>
                        @endif

                        @if($user->updated_at != $user->created_at)
                        <div class="flex items-start">
                            <div class="flex-shrink-0">
                                <div class="w-3 h-3 bg-yellow-500 rounded-full mt-2"></div>
                            </div>
                            <div class="{{ app()->getLocale() == 'ar' ? 'mr-4' : 'ml-4' }} flex-1">
                                <h4 class="text-sm font-semibold text-gray-900 dark:text-white {{ app()->getLocale() == 'ar' ? 'font-arabic-medium' : 'font-english' }}">
                                    {{ __('admin.last_updated') }}
                                </h4>
                                <p class="text-sm text-gray-600 dark:text-gray-400 mt-1 {{ app()->getLocale() == 'ar' ? 'font-arabic-normal' : 'font-english' }}">
                                    {{ __('admin.account_last_updated_on') }} {{ $user->updated_at->format('F j, Y \a\t g:i A') }}
                                </p>
                                <span class="text-xs text-gray-500 dark:text-gray-500">{{ $user->updated_at->diffForHumans() }}</span>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <div class="space-y-6">
            <!-- User Avatar -->
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700">
                <div class="p-6 text-center">
                    <div class="w-20 h-20 bg-gradient-to-r from-blue-600 to-blue-700 rounded-full flex items-center justify-center mx-auto mb-4">
                        <span class="text-white text-2xl font-bold">{{ strtoupper(substr($user->name, 0, 2)) }}</span>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-2 {{ app()->getLocale() == 'ar' ? 'font-arabic-bold' : 'font-english' }}">
                        {{ $user->name }}
                    </h3>
                    <p class="text-gray-600 dark:text-gray-400 mb-3 {{ app()->getLocale() == 'ar' ? 'font-arabic-normal' : 'font-english' }}">
                        {{ $user->email }}
                    </p>
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium
                        {{ $user->role === 'admin' ? 'bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200' :
                           ($user->role === 'editor' ? 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-200' :
                            'bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-300') }}">
                        {{ __('admin.' . $user->role) }}
                    </span>
                </div>
            </div>

            <!-- Role Permissions -->
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700 mb-6">
                <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white {{ app()->getLocale() == 'ar' ? 'font-arabic-medium' : 'font-english' }}">
                        {{ __('admin.current_permissions') }}
                    </h3>
                </div>
                <div class="p-6">
                    @if($user->isAdmin())
                        <div class="bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800 rounded-lg p-4">
                            <h4 class="text-sm font-semibold text-red-800 dark:text-red-200 mb-2 {{ app()->getLocale() == 'ar' ? 'font-arabic-medium' : 'font-english' }}">
                                {{ __('admin.admin_role') }}
                            </h4>
                            <p class="text-sm text-red-700 dark:text-red-300 {{ app()->getLocale() == 'ar' ? 'font-arabic-normal' : 'font-english' }}">
                                {{ __('admin.admin_permissions') }}
                            </p>
                        </div>
                    @elseif($user->isEditor())
                        <div class="bg-yellow-50 dark:bg-yellow-900/20 border border-yellow-200 dark:border-yellow-800 rounded-lg p-4">
                            <h4 class="text-sm font-semibold text-yellow-800 dark:text-yellow-200 mb-2 {{ app()->getLocale() == 'ar' ? 'font-arabic-medium' : 'font-english' }}">
                                {{ __('admin.editor_role') }}
                            </h4>
                            <p class="text-sm text-yellow-700 dark:text-yellow-300 {{ app()->getLocale() == 'ar' ? 'font-arabic-normal' : 'font-english' }}">
                                {{ __('admin.editor_permissions') }}
                            </p>
                        </div>
                    @else
                        <div class="bg-gray-50 dark:bg-gray-700/20 border border-gray-200 dark:border-gray-600 rounded-lg p-4">
                            <h4 class="text-sm font-semibold text-gray-800 dark:text-gray-200 mb-2 {{ app()->getLocale() == 'ar' ? 'font-arabic-medium' : 'font-english' }}">
                                {{ __('admin.viewer_role') }}
                            </h4>
                            <p class="text-sm text-gray-700 dark:text-gray-300 {{ app()->getLocale() == 'ar' ? 'font-arabic-normal' : 'font-english' }}">
                                {{ __('admin.viewer_permissions') }}
                            </p>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700">
                <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white {{ app()->getLocale() == 'ar' ? 'font-arabic-medium' : 'font-english' }}">
                        {{ __('admin.quick_actions') }}
                    </h3>
                </div>
                <div class="p-6">
                    <div class="space-y-3">
                        <a href="{{ route('admin.users.edit', $user) }}"
                           class="w-full inline-flex items-center justify-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg transition-colors duration-200">
                            <i class="fas fa-edit {{ app()->getLocale() == 'ar' ? 'ml-2' : 'mr-2' }}"></i>
                            {{ __('admin.edit_user') }}
                        </a>

                        @if($user->id !== auth()->id())
                            @if($user->is_active)
                                <form method="POST" action="{{ route('admin.users.bulk-update-status') }}">
                                    @csrf
                                    <input type="hidden" name="user_ids[]" value="{{ $user->id }}">
                                    <input type="hidden" name="action" value="deactivate">
                                    <button type="submit"
                                            class="w-full inline-flex items-center justify-center px-4 py-2 bg-yellow-600 hover:bg-yellow-700 text-white font-medium rounded-lg transition-colors duration-200"
                                            onclick="return confirm('{{ __('admin.confirm_deactivate_user') }}')">
                                        <i class="fas fa-ban {{ app()->getLocale() == 'ar' ? 'ml-2' : 'mr-2' }}"></i>
                                        {{ __('admin.deactivate_user') }}
                                    </button>
                                </form>
                            @else
                                <form method="POST" action="{{ route('admin.users.bulk-update-status') }}">
                                    @csrf
                                    <input type="hidden" name="user_ids[]" value="{{ $user->id }}">
                                    <input type="hidden" name="action" value="activate">
                                    <button type="submit"
                                            class="w-full inline-flex items-center justify-center px-4 py-2 bg-green-600 hover:bg-green-700 text-white font-medium rounded-lg transition-colors duration-200">
                                        <i class="fas fa-check {{ app()->getLocale() == 'ar' ? 'ml-2' : 'mr-2' }}"></i>
                                        {{ __('admin.activate_user') }}
                                    </button>
                                </form>
                            @endif

                            <form method="POST" action="{{ route('admin.users.destroy', $user) }}"
                                  onsubmit="return confirm('{{ __('admin.confirm_delete_user') }}')">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                        class="w-full inline-flex items-center justify-center px-4 py-2 bg-red-600 hover:bg-red-700 text-white font-medium rounded-lg transition-colors duration-200">
                                    <i class="fas fa-trash {{ app()->getLocale() == 'ar' ? 'ml-2' : 'mr-2' }}"></i>
                                    {{ __('admin.delete_user') }}
                                </button>
                            </form>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

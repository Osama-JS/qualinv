@extends('layouts.admin')

@section('title', __('admin.edit_user'))

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <h1 class="text-2xl font-bold text-gray-900 dark:text-white {{ app()->getLocale() == 'ar' ? 'font-arabic-bold' : 'font-english' }}">
                {{ __('admin.edit_user') }}
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
                            <span class="text-gray-500 dark:text-gray-400 {{ app()->getLocale() == 'ar' ? 'font-arabic-normal' : 'font-english' }}">{{ __('admin.edit_user') }}</span>
                        </div>
                    </li>
                </ol>
            </nav>
        </div>
        <div class="flex flex-col sm:flex-row gap-2">
            <a href="{{ route('admin.users.show', $user) }}"
               class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg transition-colors duration-200">
                <i class="fas fa-eye {{ app()->getLocale() == 'ar' ? 'ml-2' : 'mr-2' }}"></i>
                {{ __('admin.view_user') }}
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
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700">
                <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white {{ app()->getLocale() == 'ar' ? 'font-arabic-medium' : 'font-english' }}">
                        {{ __('admin.user_information') }}
                    </h3>
                </div>
                <div class="p-6">
                    <form method="POST" action="{{ route('admin.users.update', $user) }}" class="space-y-6">
                        @csrf
                        @method('PUT')

                        <!-- Name -->
                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2 {{ app()->getLocale() == 'ar' ? 'font-arabic-normal' : 'font-english' }}">
                                {{ __('admin.name') }} <span class="text-red-500">*</span>
                            </label>
                            <input type="text"
                                   class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-gray-100 transition-all duration-200 @error('name') border-red-500 ring-red-500 @enderror"
                                   id="name" name="name" value="{{ old('name', $user->name) }}" required
                                   x-data="{ focused: false }"
                                   @focus="focused = true"
                                   @blur="focused = false"
                                   :class="{ 'ring-2 ring-blue-500 border-blue-500': focused }">
                            <x-validation-error field="name" :animated="true" />
                        </div>

                        <!-- Email -->
                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2 {{ app()->getLocale() == 'ar' ? 'font-arabic-normal' : 'font-english' }}">
                                {{ __('admin.email') }} <span class="text-red-500">*</span>
                            </label>
                            <input type="email"
                                   class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-gray-100 transition-all duration-200 @error('email') border-red-500 ring-red-500 @enderror"
                                   id="email" name="email" value="{{ old('email', $user->email) }}" required
                                   x-data="{ focused: false }"
                                   @focus="focused = true"
                                   @blur="focused = false"
                                   :class="{ 'ring-2 ring-blue-500 border-blue-500': focused }">
                            <x-validation-error field="email" :animated="true" />
                        </div>

                        <!-- Password -->
                        <div>
                            <label for="password" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2 {{ app()->getLocale() == 'ar' ? 'font-arabic-normal' : 'font-english' }}">
                                {{ __('admin.new_password') }}
                            </label>
                            <div class="relative">
                                <input type="password"
                                       class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-gray-100 transition-all duration-200 @error('password') border-red-500 ring-red-500 @enderror {{ app()->getLocale() == 'ar' ? 'pl-10' : 'pr-10' }}"
                                       id="password" name="password"
                                       x-data="{ focused: false }"
                                       @focus="focused = true"
                                       @blur="focused = false"
                                       :class="{ 'ring-2 ring-blue-500 border-blue-500': focused }">
                                <button type="button"
                                        class="absolute inset-y-0 {{ app()->getLocale() == 'ar' ? 'left-0 pl-3' : 'right-0 pr-3' }} flex items-center text-gray-400 hover:text-gray-600 dark:hover:text-gray-300 transition-colors duration-200"
                                        onclick="togglePassword('password')">
                                    <i class="fas fa-eye" id="password-icon"></i>
                                </button>
                            </div>
                            <x-validation-error field="password" :animated="true" />
                            <p class="mt-2 text-sm text-gray-600 dark:text-gray-400 {{ app()->getLocale() == 'ar' ? 'font-arabic-normal' : 'font-english' }}">
                                {{ __('admin.leave_blank_to_keep_current') }}
                            </p>
                        </div>

                        <!-- Confirm Password -->
                        <div>
                            <label for="password_confirmation" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2 {{ app()->getLocale() == 'ar' ? 'font-arabic-normal' : 'font-english' }}">
                                {{ __('admin.confirm_new_password') }}
                            </label>
                            <div class="relative">
                                <input type="password"
                                       class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-gray-100 transition-all duration-200 {{ app()->getLocale() == 'ar' ? 'pl-10' : 'pr-10' }}"
                                       id="password_confirmation" name="password_confirmation"
                                       x-data="{ focused: false }"
                                       @focus="focused = true"
                                       @blur="focused = false"
                                       :class="{ 'ring-2 ring-blue-500 border-blue-500': focused }">
                                <button type="button"
                                        class="absolute inset-y-0 {{ app()->getLocale() == 'ar' ? 'left-0 pl-3' : 'right-0 pr-3' }} flex items-center text-gray-400 hover:text-gray-600 dark:hover:text-gray-300 transition-colors duration-200"
                                        onclick="togglePassword('password_confirmation')">
                                    <i class="fas fa-eye" id="password_confirmation-icon"></i>
                                </button>
                            </div>
                        </div>

                        <!-- Role -->
                        <div>
                            <label for="role" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2 {{ app()->getLocale() == 'ar' ? 'font-arabic-normal' : 'font-english' }}">
                                {{ __('admin.role') }} <span class="text-red-500">*</span>
                            </label>
                            <select class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-gray-100 transition-all duration-200 @error('role') border-red-500 ring-red-500 @enderror"
                                    id="role" name="role" required
                                    x-data="{ focused: false }"
                                    @focus="focused = true"
                                    @blur="focused = false"
                                    :class="{ 'ring-2 ring-blue-500 border-blue-500': focused }">
                                <option value="">{{ __('admin.select_role') }}</option>
                                <option value="admin" {{ old('role', $user->role) == 'admin' ? 'selected' : '' }}>{{ __('admin.admin') }}</option>
                                <option value="editor" {{ old('role', $user->role) == 'editor' ? 'selected' : '' }}>{{ __('admin.editor') }}</option>
                                <option value="viewer" {{ old('role', $user->role) == 'viewer' ? 'selected' : '' }}>{{ __('admin.viewer') }}</option>
                            </select>
                            <x-validation-error field="role" :animated="true" />
                        </div>

                        <!-- Status -->
                        <div>
                            <div class="flex items-center">
                                <input type="checkbox"
                                       class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600"
                                       id="is_active" name="is_active" value="1"
                                       {{ old('is_active', $user->is_active) ? 'checked' : '' }}
                                       {{ $user->id === auth()->id() ? 'disabled' : '' }}>
                                <label for="is_active" class="{{ app()->getLocale() == 'ar' ? 'mr-2' : 'ml-2' }} text-sm font-medium text-gray-700 dark:text-gray-300 {{ app()->getLocale() == 'ar' ? 'font-arabic-normal' : 'font-english' }}">
                                    {{ __('admin.active_user') }}
                                </label>
                            </div>
                            @if($user->id === auth()->id())
                                <p class="mt-2 text-sm text-yellow-600 dark:text-yellow-400 {{ app()->getLocale() == 'ar' ? 'font-arabic-normal' : 'font-english' }}">
                                    {{ __('admin.cannot_deactivate_yourself') }}
                                </p>
                                <input type="hidden" name="is_active" value="1">
                            @else
                                <p class="mt-2 text-sm text-gray-600 dark:text-gray-400 {{ app()->getLocale() == 'ar' ? 'font-arabic-normal' : 'font-english' }}">
                                    {{ __('admin.active_user_description') }}
                                </p>
                            @endif
                        </div>

                        <!-- Submit Buttons -->
                        <div class="flex flex-col sm:flex-row gap-3 pt-6">
                            <a href="{{ route('admin.users.index') }}"
                               class="inline-flex items-center justify-center px-4 py-2 bg-gray-600 hover:bg-gray-700 text-white font-medium rounded-lg transition-colors duration-200">
                                {{ __('admin.cancel') }}
                            </a>
                            <button type="submit"
                                    class="inline-flex items-center justify-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg transition-colors duration-200">
                                <i class="fas fa-save {{ app()->getLocale() == 'ar' ? 'ml-2' : 'mr-2' }}"></i>
                                {{ __('admin.update_user') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="space-y-6">
            <!-- User Info -->
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700">
                <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white {{ app()->getLocale() == 'ar' ? 'font-arabic-medium' : 'font-english' }}">
                        {{ __('admin.user_details') }}
                    </h3>
                </div>
                <div class="p-6">
                    <div class="text-center mb-6">
                        <div class="w-16 h-16 bg-gradient-to-r from-blue-600 to-blue-700 rounded-full flex items-center justify-center mx-auto">
                            <span class="text-white text-xl font-bold">{{ strtoupper(substr($user->name, 0, 2)) }}</span>
                        </div>
                    </div>
                    <div class="space-y-3">
                        <div class="flex justify-between items-center py-2 border-b border-gray-100 dark:border-gray-700">
                            <span class="text-sm font-medium text-gray-500 dark:text-gray-400 {{ app()->getLocale() == 'ar' ? 'font-arabic-normal' : 'font-english' }}">{{ __('admin.user_id') }}:</span>
                            <span class="text-sm text-gray-900 dark:text-white font-mono">{{ $user->id }}</span>
                        </div>
                        <div class="flex justify-between items-center py-2 border-b border-gray-100 dark:border-gray-700">
                            <span class="text-sm font-medium text-gray-500 dark:text-gray-400 {{ app()->getLocale() == 'ar' ? 'font-arabic-normal' : 'font-english' }}">{{ __('admin.created_at') }}:</span>
                            <span class="text-sm text-gray-900 dark:text-white">{{ $user->created_at->format('Y-m-d H:i') }}</span>
                        </div>
                        <div class="flex justify-between items-center py-2 border-b border-gray-100 dark:border-gray-700">
                            <span class="text-sm font-medium text-gray-500 dark:text-gray-400 {{ app()->getLocale() == 'ar' ? 'font-arabic-normal' : 'font-english' }}">{{ __('admin.updated_at') }}:</span>
                            <span class="text-sm text-gray-900 dark:text-white">{{ $user->updated_at->format('Y-m-d H:i') }}</span>
                        </div>
                        <div class="flex justify-between items-center py-2">
                            <span class="text-sm font-medium text-gray-500 dark:text-gray-400 {{ app()->getLocale() == 'ar' ? 'font-arabic-normal' : 'font-english' }}">{{ __('admin.email_verified') }}:</span>
                            <div>
                                @if($user->email_verified_at)
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200">
                                        {{ __('admin.verified') }}
                                    </span>
                                @else
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-200">
                                        {{ __('admin.not_verified') }}
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Role Information -->
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700">
                <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white {{ app()->getLocale() == 'ar' ? 'font-arabic-medium' : 'font-english' }}">
                        {{ __('admin.role_permissions') }}
                    </h3>
                </div>
                <div class="p-6 space-y-4">
                    <div>
                        <h4 class="text-sm font-semibold text-red-600 dark:text-red-400 mb-1 {{ app()->getLocale() == 'ar' ? 'font-arabic-medium' : 'font-english' }}">{{ __('admin.admin') }}</h4>
                        <p class="text-sm text-gray-600 dark:text-gray-400 {{ app()->getLocale() == 'ar' ? 'font-arabic-normal' : 'font-english' }}">{{ __('admin.admin_permissions') }}</p>
                    </div>
                    <div>
                        <h4 class="text-sm font-semibold text-yellow-600 dark:text-yellow-400 mb-1 {{ app()->getLocale() == 'ar' ? 'font-arabic-medium' : 'font-english' }}">{{ __('admin.editor') }}</h4>
                        <p class="text-sm text-gray-600 dark:text-gray-400 {{ app()->getLocale() == 'ar' ? 'font-arabic-normal' : 'font-english' }}">{{ __('admin.editor_permissions') }}</p>
                    </div>
                    <div>
                        <h4 class="text-sm font-semibold text-gray-600 dark:text-gray-400 mb-1 {{ app()->getLocale() == 'ar' ? 'font-arabic-medium' : 'font-english' }}">{{ __('admin.viewer') }}</h4>
                        <p class="text-sm text-gray-600 dark:text-gray-400 {{ app()->getLocale() == 'ar' ? 'font-arabic-normal' : 'font-english' }}">{{ __('admin.viewer_permissions') }}</p>
                    </div>
                </div>
            </div>

            <!-- Danger Zone -->
            @if($user->id !== auth()->id())
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm border-2 border-red-200 dark:border-red-800">
                <div class="px-6 py-4 bg-red-50 dark:bg-red-900/20 border-b border-red-200 dark:border-red-800 rounded-t-lg">
                    <h3 class="text-lg font-semibold text-red-800 dark:text-red-200 {{ app()->getLocale() == 'ar' ? 'font-arabic-medium' : 'font-english' }}">
                        {{ __('admin.danger_zone') }}
                    </h3>
                </div>
                <div class="p-6">
                    <p class="text-sm text-gray-600 dark:text-gray-400 mb-4 {{ app()->getLocale() == 'ar' ? 'font-arabic-normal' : 'font-english' }}">
                        {{ __('admin.delete_user_warning') }}
                    </p>
                    <form method="POST" action="{{ route('admin.users.destroy', $user) }}"
                          onsubmit="return confirm('{{ __('admin.confirm_delete_user') }}')">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                                class="inline-flex items-center px-4 py-2 bg-red-600 hover:bg-red-700 text-white font-medium rounded-lg transition-colors duration-200">
                            <i class="fas fa-trash {{ app()->getLocale() == 'ar' ? 'ml-2' : 'mr-2' }}"></i>
                            {{ __('admin.delete_user') }}
                        </button>
                    </form>
                </div>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
function togglePassword(fieldId) {
    const field = document.getElementById(fieldId);
    const icon = document.getElementById(fieldId + '-icon');

    if (field.type === 'password') {
        field.type = 'text';
        icon.classList.remove('fa-eye');
        icon.classList.add('fa-eye-slash');
    } else {
        field.type = 'password';
        icon.classList.remove('fa-eye-slash');
        icon.classList.add('fa-eye');
    }
}
</script>
@endpush

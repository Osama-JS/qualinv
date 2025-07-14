@extends('layouts.admin')

@section('title', __('admin.edit_profile'))

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <h1 class="text-2xl font-bold text-gray-900 dark:text-white">{{ __('admin.edit_profile') }}</h1>
            <p class="text-gray-600 dark:text-gray-400 mt-1">{{ __('admin.update_your_profile_information') }}</p>
        </div>
        <a href="{{ route('admin.profile.index') }}"
           class="inline-flex items-center px-4 py-2 bg-gray-600 hover:bg-gray-700 text-white font-medium rounded-lg transition-colors duration-200">
            <i class="fas fa-arrow-{{ app()->getLocale() == 'ar' ? 'right' : 'left' }} {{ app()->getLocale() == 'ar' ? 'ml-2' : 'mr-2' }}"></i>
            {{ __('admin.back_to_profile') }}
        </a>
    </div>

    <form action="{{ route('admin.profile.update') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf
        @method('PUT')

        <!-- Avatar Section -->
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 p-6">
            <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-6">
                <i class="fas fa-image {{ app()->getLocale() == 'ar' ? 'ml-2' : 'mr-2' }} text-blue-600"></i>
                {{ __('admin.profile_picture') }}
            </h3>
            
            <div class="flex items-center space-x-6 {{ app()->getLocale() == 'ar' ? 'space-x-reverse' : '' }}">
                <!-- Current Avatar -->
                <div class="relative">
                    <img id="avatar-preview" 
                         src="{{ $user->getAvatarUrl() }}" 
                         alt="{{ $user->name }}"
                         class="w-24 h-24 rounded-full object-cover border-4 border-gray-200 dark:border-gray-600">
                    
                    @if($user->avatar)
                    <button type="button" 
                            id="delete-avatar-btn"
                            class="absolute -top-2 -{{ app()->getLocale() == 'ar' ? 'left' : 'right' }}-2 w-6 h-6 bg-red-500 hover:bg-red-600 text-white rounded-full flex items-center justify-center transition-colors duration-200"
                            title="{{ __('admin.delete_avatar') }}">
                        <i class="fas fa-times text-xs"></i>
                    </button>
                    @endif
                </div>
                
                <!-- Upload Controls -->
                <div class="flex-1">
                    <div class="flex items-center space-x-4 {{ app()->getLocale() == 'ar' ? 'space-x-reverse' : '' }}">
                        <label for="avatar" class="cursor-pointer inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg transition-colors duration-200">
                            <i class="fas fa-upload {{ app()->getLocale() == 'ar' ? 'ml-2' : 'mr-2' }}"></i>
                            {{ __('admin.upload_new') }}
                        </label>
                        <input type="file" 
                               id="avatar" 
                               name="avatar" 
                               accept="image/*" 
                               class="hidden">
                    </div>
                    <p class="text-sm text-gray-500 dark:text-gray-400 mt-2">
                        {{ __('admin.avatar_requirements') }}
                    </p>
                    @error('avatar')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>
        </div>

        <!-- Personal Information -->
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 p-6">
            <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-6">
                <i class="fas fa-user {{ app()->getLocale() == 'ar' ? 'ml-2' : 'mr-2' }} text-green-600"></i>
                {{ __('admin.personal_information') }}
            </h3>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Name -->
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        {{ __('admin.full_name') }} <span class="text-red-500">*</span>
                    </label>
                    <input type="text" 
                           id="name" 
                           name="name" 
                           value="{{ old('name', $user->name) }}"
                           class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent dark:bg-gray-700 dark:text-white"
                           required>
                    @error('name')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Email -->
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        {{ __('admin.email_address') }} <span class="text-red-500">*</span>
                    </label>
                    <input type="email" 
                           id="email" 
                           name="email" 
                           value="{{ old('email', $user->email) }}"
                           class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent dark:bg-gray-700 dark:text-white"
                           required>
                    @error('email')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Phone -->
                <div>
                    <label for="phone" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        {{ __('admin.phone_number') }}
                    </label>
                    <input type="tel" 
                           id="phone" 
                           name="phone" 
                           value="{{ old('phone', $user->phone) }}"
                           class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent dark:bg-gray-700 dark:text-white"
                           placeholder="{{ __('admin.phone_placeholder') }}">
                    @error('phone')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Role (Read-only) -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        {{ __('admin.role') }}
                    </label>
                    <div class="w-full px-4 py-3 bg-gray-100 dark:bg-gray-600 border border-gray-300 dark:border-gray-600 rounded-lg text-gray-700 dark:text-gray-300">
                        {{ $user->getRoleLabel() }}
                    </div>
                    <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                        {{ __('admin.role_cannot_be_changed') }}
                    </p>
                </div>
            </div>

            <!-- Bio -->
            <div class="mt-6">
                <label for="bio" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                    {{ __('admin.bio') }}
                </label>
                <textarea id="bio" 
                          name="bio" 
                          rows="4"
                          class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent dark:bg-gray-700 dark:text-white resize-vertical"
                          placeholder="{{ __('admin.bio_placeholder') }}">{{ old('bio', $user->bio) }}</textarea>
                @error('bio')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
                <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                    {{ __('admin.bio_help') }}
                </p>
            </div>
        </div>

        <!-- Submit Buttons -->
        <div class="flex justify-end space-x-4 {{ app()->getLocale() == 'ar' ? 'space-x-reverse' : '' }}">
            <a href="{{ route('admin.profile.index') }}"
               class="px-6 py-3 border border-gray-300 dark:border-gray-600 text-gray-700 dark:text-gray-300 font-medium rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors duration-200">
                {{ __('admin.cancel') }}
            </a>
            <button type="submit"
                    class="px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg transition-colors duration-200">
                <i class="fas fa-save {{ app()->getLocale() == 'ar' ? 'ml-2' : 'mr-2' }}"></i>
                {{ __('admin.save_changes') }}
            </button>
        </div>
    </form>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Avatar preview
    const avatarInput = document.getElementById('avatar');
    const avatarPreview = document.getElementById('avatar-preview');
    const deleteAvatarBtn = document.getElementById('delete-avatar-btn');

    if (avatarInput) {
        avatarInput.addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    avatarPreview.src = e.target.result;
                };
                reader.readAsDataURL(file);
            }
        });
    }

    // Delete avatar
    if (deleteAvatarBtn) {
        deleteAvatarBtn.addEventListener('click', function() {
            if (confirm('{{ __("admin.confirm_delete_avatar") }}')) {
                fetch('{{ route("admin.profile.delete-avatar") }}', {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Content-Type': 'application/json',
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Reset to default avatar
                        avatarPreview.src = '{{ $user->getAvatarUrl() }}';
                        deleteAvatarBtn.style.display = 'none';
                        
                        // Show success message
                        showNotification(data.message, 'success');
                    } else {
                        showNotification(data.message, 'error');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    showNotification('{{ __("admin.avatar_delete_failed") }}', 'error');
                });
            }
        });
    }

    // Notification function
    function showNotification(message, type) {
        // You can implement your notification system here
        alert(message);
    }
});
</script>
@endpush

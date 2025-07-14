@extends('layouts.admin')

@section('page-title', __('admin.edit_board_director'))

@section('content')
<div class="mb-6">
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-3xl font-bold text-gray-900 dark:text-gray-100">{{ __('admin.edit_board_director') }}</h1>
            <p class="text-gray-600 dark:text-gray-400">{{ __('admin.edit_board_director_description') }}</p>
        </div>
        <a href="{{ route('admin.board-directors.index') }}" class="bg-gray-600 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded-lg transition-colors">
            <i class="fas fa-arrow-left mr-2"></i>
            {{ __('admin.back_to_list') }}
        </a>
    </div>
</div>

<form action="{{ route('admin.board-directors.update', $boardDirector) }}" method="POST" enctype="multipart/form-data" class="space-y-8">
    @csrf
    @method('PUT')

    <!-- Basic Information -->
    <div class="bg-white dark:bg-gray-800 shadow-sm rounded-lg">
        <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
            <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">{{ __('admin.basic_information') }}</h3>
        </div>
        <div class="p-6 space-y-6">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <!-- Name English -->
                <div>
                    <label for="name_en" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        {{ __('admin.name') }} (English) <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="name_en" id="name_en" value="{{ old('name_en', $boardDirector->name['en'] ?? '') }}"
                           class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-gray-100"
                           required>
                    @error('name_en')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Name Arabic -->
                <div>
                    <label for="name_ar" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        {{ __('admin.name') }} (العربية) <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="name_ar" id="name_ar" value="{{ old('name_ar', $boardDirector->name['ar'] ?? '') }}"
                           class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-gray-100"
                           dir="rtl" required>
                    @error('name_ar')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Position English -->
                <div>
                    <label for="position_en" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        {{ __('admin.position') }} (English) <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="position_en" id="position_en" value="{{ old('position_en', $boardDirector->position['en'] ?? '') }}"
                           class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-gray-100"
                           required>
                    @error('position_en')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Position Arabic -->
                <div>
                    <label for="position_ar" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        {{ __('admin.position') }} (العربية) <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="position_ar" id="position_ar" value="{{ old('position_ar', $boardDirector->position['ar'] ?? '') }}"
                           class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-gray-100"
                           dir="rtl" required>
                    @error('position_ar')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Email -->
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        {{ __('admin.email') }}
                    </label>
                    <input type="email" name="email" id="email" value="{{ old('email', $boardDirector->email) }}"
                           class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-gray-100">
                    @error('email')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Phone -->
                <div>
                    <label for="phone" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        {{ __('admin.phone') }}
                    </label>
                    <input type="tel" name="phone" id="phone" value="{{ old('phone', $boardDirector->phone) }}"
                           class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-gray-100">
                    @error('phone')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Sort Order -->
                <div>
                    <label for="sort_order" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        {{ __('admin.sort_order') }}
                    </label>
                    <input type="number" name="sort_order" id="sort_order" value="{{ old('sort_order', $boardDirector->sort_order) }}" min="0"
                           class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-gray-100">
                    @error('sort_order')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Status -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        {{ __('admin.status') }}
                    </label>
                    <div class="flex items-center">
                        <input type="checkbox" name="is_active" id="is_active" value="1" 
                               {{ old('is_active', $boardDirector->is_active) ? 'checked' : '' }}
                               class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                        <label for="is_active" class="ml-2 block text-sm text-gray-900 dark:text-gray-100">
                            {{ __('admin.active') }}
                        </label>
                    </div>
                    @error('is_active')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Current Photo -->
            @if($boardDirector->photo)
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                    {{ __('admin.current_photo') }}
                </label>
                <img src="{{ asset('storage/' . $boardDirector->photo) }}" alt="{{ $boardDirector->getLocalizedName() }}" 
                     class="h-32 w-32 rounded-lg object-cover">
            </div>
            @endif

            <!-- Photo -->
            <div>
                <label for="photo" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                    {{ $boardDirector->photo ? __('admin.change_photo') : __('admin.photo') }}
                </label>
                <input type="file" name="photo" id="photo" accept="image/*"
                       class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-gray-100">
                <p class="mt-1 text-sm text-gray-500">{{ __('admin.photo_upload_hint') }}</p>
                @error('photo')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
        </div>
    </div>

    <!-- Biography -->
    <div class="bg-white dark:bg-gray-800 shadow-sm rounded-lg">
        <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
            <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">{{ __('admin.biography') }}</h3>
        </div>
        <div class="p-6 space-y-6">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <!-- Bio English -->
                <div>
                    <label for="bio_en" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        {{ __('admin.biography') }} (English)
                    </label>
                    <textarea name="bio_en" id="bio_en" rows="6"
                              class="tinymce-editor w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-gray-100">{{ old('bio_en', $boardDirector->bio['en'] ?? '') }}</textarea>
                    @error('bio_en')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Bio Arabic -->
                <div>
                    <label for="bio_ar" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        {{ __('admin.biography') }} (العربية)
                    </label>
                    <textarea name="bio_ar" id="bio_ar" rows="6"
                              class="tinymce-editor-rtl w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-gray-100"
                              dir="rtl">{{ old('bio_ar', $boardDirector->bio['ar'] ?? '') }}</textarea>
                    @error('bio_ar')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>
        </div>
    </div>

    <!-- Submit Button -->
    <div class="flex justify-end space-x-4">
        <a href="{{ route('admin.board-directors.index') }}" class="bg-gray-600 hover:bg-gray-700 text-white font-bold py-3 px-6 rounded-lg transition-colors">
            {{ __('admin.cancel') }}
        </a>
        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-6 rounded-lg transition-colors">
            <i class="fas fa-save mr-2"></i>
            {{ __('admin.update_board_director') }}
        </button>
    </div>
</form>
@endsection

@push('scripts')
<!-- TinyMCE Professional Editor -->
<script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Initialize TinyMCE for English fields (LTR)
    tinymce.init({
        selector: '.tinymce-editor',
        height: 300,
        menubar: false,
        plugins: [
            'advlist', 'autolink', 'lists', 'link', 'charmap', 'preview',
            'anchor', 'searchreplace', 'visualblocks', 'code', 'fullscreen',
            'insertdatetime', 'table', 'help', 'wordcount'
        ],
        toolbar: 'undo redo | blocks fontsize | bold italic underline | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link | code fullscreen help',
        directionality: 'ltr',
        language: 'en',
        content_style: 'body { font-family: Inter, sans-serif; font-size: 14px; line-height: 1.6; }',
        branding: false,
        promotion: false
    });

    // Initialize TinyMCE for Arabic fields (RTL)
    tinymce.init({
        selector: '.tinymce-editor-rtl',
        height: 300,
        menubar: false,
        plugins: [
            'advlist', 'autolink', 'lists', 'link', 'charmap', 'preview',
            'anchor', 'searchreplace', 'visualblocks', 'code', 'fullscreen',
            'insertdatetime', 'table', 'help', 'wordcount', 'directionality'
        ],
        toolbar: 'undo redo | blocks fontsize | bold italic underline | alignright aligncenter alignleft alignjustify | bullist numlist outdent indent | link | ltr rtl | code fullscreen help',
        directionality: 'rtl',
        language: 'ar',
        content_style: 'body { font-family: Tajawal, sans-serif; font-size: 16px; line-height: 1.8; direction: rtl; text-align: right; }',
        branding: false,
        promotion: false
    });

    // Form submission handling
    document.querySelector('form').addEventListener('submit', function(e) {
        tinymce.triggerSave();
    });
});
</script>
@endpush

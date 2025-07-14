@extends('layouts.admin')

@section('page-title', __('admin.add_article'))

@section('content')
<div class="mb-6">
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-3xl font-bold text-gray-900 dark:text-gray-100">{{ __('admin.add_article') }}</h1>
            <p class="text-gray-600 dark:text-gray-400">{{ __('admin.add_new_article_description') }}</p>
        </div>
        <a href="{{ route('admin.articles.index') }}" class="bg-gray-600 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded-lg transition-colors">
            <i class="fas fa-arrow-left mr-2"></i>
            {{ __('admin.back_to_list') }}
        </a>
    </div>
</div>

<form action="{{ route('admin.articles.store') }}" method="POST" enctype="multipart/form-data" class="space-y-8">
    @csrf

    <!-- Basic Information -->
    <div class="bg-white dark:bg-gray-800 shadow-sm rounded-lg">
        <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
            <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">{{ __('admin.basic_information') }}</h3>
        </div>
        <div class="p-6 space-y-6">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <!-- Title English -->
                <div>
                    <label for="title_en" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        {{ __('admin.article_title') }} (English) <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="title_en" id="title_en" value="{{ old('title_en') }}"
                           class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-gray-100"
                           required>
                    @error('title_en')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Title Arabic -->
                <div>
                    <label for="title_ar" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        {{ __('admin.article_title') }} (العربية) <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="title_ar" id="title_ar" value="{{ old('title_ar') }}"
                           class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-gray-100"
                           dir="rtl" required>
                    @error('title_ar')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Category -->
                <div>
                    <label for="category" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        {{ __('admin.category') }} <span class="text-red-500">*</span>
                    </label>
                    <select name="category" id="category"
                            class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-gray-100"
                            required>
                        <option value="">{{ __('admin.select_category') }}</option>
                        @foreach($categories as $key => $value)
                            <option value="{{ $key }}" {{ old('category') === $key ? 'selected' : '' }}>{{ $value }}</option>
                        @endforeach
                    </select>
                    @error('category')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Status -->
                <div>
                    <label for="status" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        {{ __('admin.status') }} <span class="text-red-500">*</span>
                    </label>
                    <select name="status" id="status"
                            class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-gray-100"
                            required>
                        <option value="draft" {{ old('status', 'draft') === 'draft' ? 'selected' : '' }}>{{ __('admin.draft') }}</option>
                        <option value="published" {{ old('status') === 'published' ? 'selected' : '' }}>{{ __('admin.published') }}</option>
                    </select>
                    @error('status')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Published At -->
                <div>
                    <label for="published_at" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        {{ __('admin.published_at') }}
                    </label>
                    <input type="datetime-local" name="published_at" id="published_at" value="{{ old('published_at') }}"
                           class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-gray-100">
                    @error('published_at')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Featured -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        {{ __('admin.featured') }}
                    </label>
                    <div class="flex items-center">
                        <input type="checkbox" name="is_featured" id="is_featured" value="1" 
                               {{ old('is_featured') ? 'checked' : '' }}
                               class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                        <label for="is_featured" class="ml-2 block text-sm text-gray-900 dark:text-gray-100">
                            {{ __('admin.mark_as_featured') }}
                        </label>
                    </div>
                    @error('is_featured')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Featured Image -->
            <div>
                <label for="featured_image" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                    {{ __('admin.featured_image') }}
                </label>
                <input type="file" name="featured_image" id="featured_image" accept="image/*"
                       class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-gray-100">
                <p class="mt-1 text-sm text-gray-500">{{ __('admin.image_upload_hint') }}</p>
                @error('featured_image')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
        </div>
    </div>

    <!-- Excerpts -->
    <div class="bg-white dark:bg-gray-800 shadow-sm rounded-lg">
        <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
            <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">{{ __('admin.excerpts') }}</h3>
        </div>
        <div class="p-6 space-y-6">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <!-- Excerpt English -->
                <div>
                    <label for="excerpt_en" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        {{ __('admin.article_excerpt') }} (English) <span class="text-red-500">*</span>
                    </label>
                    <textarea name="excerpt_en" id="excerpt_en" rows="4"
                              class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-gray-100"
                              maxlength="500" required>{{ old('excerpt_en') }}</textarea>
                    <p class="mt-1 text-sm text-gray-500">{{ __('admin.max_characters', ['count' => 500]) }}</p>
                    @error('excerpt_en')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Excerpt Arabic -->
                <div>
                    <label for="excerpt_ar" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        {{ __('admin.article_excerpt') }} (العربية) <span class="text-red-500">*</span>
                    </label>
                    <textarea name="excerpt_ar" id="excerpt_ar" rows="4"
                              class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-gray-100"
                              maxlength="500" dir="rtl" required>{{ old('excerpt_ar') }}</textarea>
                    <p class="mt-1 text-sm text-gray-500">{{ __('admin.max_characters', ['count' => 500]) }}</p>
                    @error('excerpt_ar')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>
        </div>
    </div>

    <!-- Content -->
    <div class="bg-white dark:bg-gray-800 shadow-sm rounded-lg">
        <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
            <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">{{ __('admin.article_content') }}</h3>
        </div>
        <div class="p-6 space-y-6">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <!-- Content English -->
                <div>
                    <label for="content_en" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        {{ __('admin.article_content') }} (English) <span class="text-red-500">*</span>
                    </label>
                    <textarea name="content_en" id="content_en" rows="10"
                              class="tinymce-editor w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-gray-100">{{ old('content_en') }}</textarea>
                    @error('content_en')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Content Arabic -->
                <div>
                    <label for="content_ar" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        {{ __('admin.article_content') }} (العربية) <span class="text-red-500">*</span>
                    </label>
                    <textarea name="content_ar" id="content_ar" rows="10"
                              class="tinymce-editor-rtl w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-gray-100"
                              dir="rtl">{{ old('content_ar') }}</textarea>
                    @error('content_ar')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>
        </div>
    </div>

    <!-- Submit Button -->
    <div class="flex justify-end space-x-4">
        <a href="{{ route('admin.articles.index') }}" class="bg-gray-600 hover:bg-gray-700 text-white font-bold py-3 px-6 rounded-lg transition-colors">
            {{ __('admin.cancel') }}
        </a>
        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-6 rounded-lg transition-colors">
            <i class="fas fa-save mr-2"></i>
            {{ __('admin.create_article') }}
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
        height: 400,
        menubar: false,
        plugins: [
            'advlist', 'autolink', 'lists', 'link', 'image', 'charmap', 'preview',
            'anchor', 'searchreplace', 'visualblocks', 'code', 'fullscreen',
            'insertdatetime', 'media', 'table', 'help', 'wordcount'
        ],
        toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | forecolor backcolor | link image media table | code fullscreen help',
        directionality: 'ltr',
        language: 'en',
        content_style: 'body { font-family: Inter, sans-serif; font-size: 14px; line-height: 1.6; }',
        branding: false,
        promotion: false
    });

    // Initialize TinyMCE for Arabic fields (RTL)
    tinymce.init({
        selector: '.tinymce-editor-rtl',
        height: 400,
        menubar: false,
        plugins: [
            'advlist', 'autolink', 'lists', 'link', 'image', 'charmap', 'preview',
            'anchor', 'searchreplace', 'visualblocks', 'code', 'fullscreen',
            'insertdatetime', 'media', 'table', 'help', 'wordcount', 'directionality'
        ],
        toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | alignright aligncenter alignleft alignjustify | bullist numlist outdent indent | forecolor backcolor | link image media table | ltr rtl | code fullscreen help',
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

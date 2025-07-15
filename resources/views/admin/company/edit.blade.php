@extends('layouts.admin')

@section('page-title', __('admin.update_company_info'))

@section('content')
<div class="mb-6">
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-3xl font-bold text-gray-900 dark:text-gray-100">{{ __('admin.update_company_info') }}</h1>
            <p class="text-gray-600 dark:text-gray-400">{{ __('Edit your company information and details') }}</p>
        </div>
        <a href="{{ route('admin.company.index') }}" class="bg-gray-600 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded-lg transition-colors">
            <i class="fas fa-arrow-left mr-2"></i>
            {{ __('admin.back') }}
        </a>
    </div>
</div>

<form action="{{ route('admin.company.update') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
    @csrf
    @method('PUT')

    <!-- Basic Information -->
    <div class="bg-white dark:bg-gray-800 shadow-sm rounded-lg">
        <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
            <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">{{ __('Basic Information') }}</h3>
        </div>

        <div class="p-6 space-y-6">
            <!-- Company Name -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <div>
                    <label for="name_en" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        {{ __('admin.company_name') }} (English) <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="name_en" id="name_en"
                           value="{{ old('name_en', $company->getLocalizedName('en')) }}"
                           class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-gray-100"
                           required>
                    @error('name_en')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="name_ar" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        {{ __('admin.company_name') }} (العربية) <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="name_ar" id="name_ar"
                           value="{{ old('name_ar', $company->getLocalizedName('ar')) }}"
                           class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-gray-100"
                           required>
                    @error('name_ar')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Company Logo -->
            <div>
                <label for="logo" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                    {{ __('admin.company_logo') }}
                </label>
                @if($company->logo)
                    <div class="mb-4">
                        <img src="{{ Storage::url($company->logo) }}" alt="Current Logo" class="h-20 w-auto object-contain">
                        <p class="text-sm text-gray-500 mt-1">{{ __('admin.current_image') }}</p>
                    </div>
                @endif
                <input type="file" name="logo" id="logo" accept="image/*"
                       class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-gray-100">
                <p class="mt-1 text-sm text-gray-500">{{ __('admin.max_file_size', ['size' => '2MB']) }}</p>
                @error('logo')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Company Favicon -->
            <div>
                <label for="favicon" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                    {{ __('admin.company_favicon') }}
                </label>
                @if($company->favicon)
                    <div class="mb-4 flex items-center space-x-3">
                        <img src="{{ Storage::url($company->favicon) }}" alt="Current Favicon" class="h-8 w-8 object-contain">
                        <div>
                            <p class="text-sm text-gray-700 dark:text-gray-300">{{ __('admin.current_favicon') }}</p>
                            <p class="text-xs text-gray-500">{{ basename($company->favicon) }}</p>
                        </div>
                    </div>
                @endif
                <input type="file" name="favicon" id="favicon" accept=".ico,.png"
                       class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-gray-100">
                <p class="mt-1 text-sm text-gray-500">{{ __('admin.favicon_help_text') }}</p>
                @error('favicon')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Contact Information -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        {{ __('admin.contact_email') }}
                    </label>
                    <input type="email" name="email" id="email"
                           value="{{ old('email', $company->email) }}"
                           class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-gray-100">
                    @error('email')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="phone" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        {{ __('admin.contact_phone') }}
                    </label>
                    <input type="text" name="phone" id="phone"
                           value="{{ old('phone', $company->phone) }}"
                           class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-gray-100">
                    @error('phone')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <div>
                    <label for="website" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        {{ __('admin.company_website') }}
                    </label>
                    <input type="url" name="website" id="website"
                           value="{{ old('website', $company->website) }}"
                           class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-gray-100">
                    @error('website')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="address" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        {{ __('admin.company_address') }}
                    </label>
                    <input type="text" name="address" id="address"
                           value="{{ old('address', $company->address) }}"
                           class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-gray-100">
                    @error('address')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>
        </div>
    </div>

    <!-- About Us -->
    <div class="bg-white dark:bg-gray-800 shadow-sm rounded-lg">
        <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
            <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">{{ __('admin.about_us') }}</h3>
        </div>

        <div class="p-6 space-y-6">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <div>
                    <label for="about_en" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        English
                    </label>
                    <textarea name="about_en" id="about_en" rows="6"
                              class="tinymce-editor w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-gray-100"
                              placeholder="Enter detailed information about the company, its history, and mission...">{{ old('about_en', $company->getLocalizedAbout('en')) }}</textarea>
                    @error('about_en')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                    <div class="mt-2 text-xs text-gray-500 flex justify-between">
                        <span>{{ __('admin.professional_content_tip') }}</span>
                        <span id="about_en_count">{{ __('admin.words') }}: 0 | {{ __('admin.characters') }}: 0</span>
                    </div>
                </div>

                <div>
                    <label for="about_ar" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        العربية
                    </label>
                    <textarea name="about_ar" id="about_ar" rows="6"
                              class="tinymce-editor-rtl w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-gray-100">{{ old('about_ar', $company->getLocalizedAbout('ar')) }}</textarea>
                    @error('about_ar')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>
        </div>
    </div>

    <!-- Mission -->
    <div class="bg-white dark:bg-gray-800 shadow-sm rounded-lg">
        <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
            <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">{{ __('admin.our_mission') }}</h3>
        </div>

        <div class="p-6 space-y-6">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <div>
                    <label for="mission_en" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        English
                    </label>
                    <textarea name="mission_en" id="mission_en" rows="4"
                              class="tinymce-editor w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-gray-100">{{ old('mission_en', $company->getLocalizedMission('en')) }}</textarea>
                    @error('mission_en')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="mission_ar" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        العربية
                    </label>
                    <textarea name="mission_ar" id="mission_ar" rows="4"
                              class="tinymce-editor-rtl w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-gray-100">{{ old('mission_ar', $company->getLocalizedMission('ar')) }}</textarea>
                    @error('mission_ar')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>
        </div>
    </div>

    <!-- Vision -->
    <div class="bg-white dark:bg-gray-800 shadow-sm rounded-lg">
        <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
            <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">{{ __('admin.our_vision') }}</h3>
        </div>

        <div class="p-6 space-y-6">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <div>
                    <label for="vision_en" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        English
                    </label>
                    <textarea name="vision_en" id="vision_en" rows="4"
                              class="tinymce-editor w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-gray-100">{{ old('vision_en', $company->getLocalizedVision('en')) }}</textarea>
                    @error('vision_en')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="vision_ar" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        العربية
                    </label>
                    <textarea name="vision_ar" id="vision_ar" rows="4"
                              class="tinymce-editor-rtl w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-gray-100">{{ old('vision_ar', $company->getLocalizedVision('ar')) }}</textarea>
                    @error('vision_ar')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>
        </div>
    </div>

    <!-- Values -->
    <div class="bg-white dark:bg-gray-800 shadow-sm rounded-lg">
        <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
            <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">{{ __('admin.our_values') }}</h3>
        </div>

        <div class="p-6 space-y-6">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <div>
                    <label for="values_en" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        English
                    </label>
                    <textarea name="values_en" id="values_en" rows="4"
                              class="tinymce-editor w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-gray-100">{{ old('values_en', $company->getLocalizedValues('en')) }}</textarea>
                    @error('values_en')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="values_ar" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        العربية
                    </label>
                    <textarea name="values_ar" id="values_ar" rows="4"
                              class="tinymce-editor-rtl w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-gray-100">{{ old('values_ar', $company->getLocalizedValues('ar')) }}</textarea>
                    @error('values_ar')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>
        </div>
    </div>

    <!-- Submit Button -->
    <div class="flex justify-end space-x-4">
        <a href="{{ route('admin.company.index') }}" class="bg-gray-600 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded-lg transition-colors">
            {{ __('admin.cancel') }}
        </a>
        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg transition-colors">
            <i class="fas fa-save mr-2"></i>
            {{ __('admin.save') }}
        </button>
    </div>
</form>
@endsection

@push('scripts')
<!-- Quill Rich Text Editor -->
<link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
<script src="https://cdn.quilljs.com/1.3.6/quill.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Initialize Quill editors
    const quillEditors = {};

    // English editors (LTR)
    document.querySelectorAll('.tinymce-editor').forEach(function(element) {
        const editorId = element.id;
        const hiddenInput = element;

        // Create editor container
        const editorContainer = document.createElement('div');
        editorContainer.id = editorId + '_editor';
        editorContainer.style.height = '300px';
        hiddenInput.style.display = 'none';
        hiddenInput.parentNode.insertBefore(editorContainer, hiddenInput);

        // Initialize Quill
        const quill = new Quill('#' + editorId + '_editor', {
            theme: 'snow',
            modules: {
                toolbar: [
                    [{ 'header': [1, 2, 3, false] }],
                    ['bold', 'italic', 'underline', 'strike'],
                    [{ 'color': [] }, { 'background': [] }],
                    [{ 'align': [] }],
                    [{ 'list': 'ordered'}, { 'list': 'bullet' }],
                    [{ 'indent': '-1'}, { 'indent': '+1' }],
                    ['link', 'blockquote', 'code-block'],
                    ['clean']
                ]
            },
            placeholder: 'Enter content...'
        });

        // Set initial content
        quill.root.innerHTML = hiddenInput.value;

        // Update hidden input on content change
        quill.on('text-change', function() {
            hiddenInput.value = quill.root.innerHTML;
        });

        quillEditors[editorId] = quill;
    });

    // Arabic editors (RTL)
    document.querySelectorAll('.tinymce-editor-rtl').forEach(function(element) {
        const editorId = element.id;
        const hiddenInput = element;

        // Create editor container
        const editorContainer = document.createElement('div');
        editorContainer.id = editorId + '_editor';
        editorContainer.style.height = '300px';
        editorContainer.style.direction = 'rtl';
        editorContainer.style.textAlign = 'right';
        hiddenInput.style.display = 'none';
        hiddenInput.parentNode.insertBefore(editorContainer, hiddenInput);

        // Initialize Quill
        const quill = new Quill('#' + editorId + '_editor', {
            theme: 'snow',
            modules: {
                toolbar: [
                    [{ 'header': [1, 2, 3, false] }],
                    ['bold', 'italic', 'underline', 'strike'],
                    [{ 'color': [] }, { 'background': [] }],
                    [{ 'align': [] }],
                    [{ 'list': 'ordered'}, { 'list': 'bullet' }],
                    [{ 'indent': '-1'}, { 'indent': '+1' }],
                    ['link', 'blockquote', 'code-block'],
                    ['clean']
                ]
            },
            placeholder: 'أدخل المحتوى...'
        });

        // Set initial content
        quill.root.innerHTML = hiddenInput.value;
        quill.root.style.direction = 'rtl';
        quill.root.style.textAlign = 'right';

        // Update hidden input on content change
        quill.on('text-change', function() {
            hiddenInput.value = quill.root.innerHTML;
        });

        quillEditors[editorId] = quill;
    });

    // Form submission handling
    document.querySelector('form').addEventListener('submit', function(e) {
        // Update all hidden inputs before submission
        Object.keys(quillEditors).forEach(function(editorId) {
            const quill = quillEditors[editorId];
            const hiddenInput = document.getElementById(editorId);
            hiddenInput.value = quill.root.innerHTML;
        });
    });
});
</script>
@endpush

@push('styles')
<style>
.ql-editor {
    font-family: 'Tajawal', sans-serif !important;
    font-size: 14px !important;
    line-height: 1.6 !important;
}

.ql-container {
    border-radius: 0 0 8px 8px !important;
    border: 2px solid #e2e8f0 !important;
    border-top: none !important;
    transition: border-color 0.2s ease !important;
}

.ql-toolbar {
    border-radius: 8px 8px 0 0 !important;
    border: 2px solid #e2e8f0 !important;
    border-bottom: none !important;
    background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%) !important;
    transition: border-color 0.2s ease !important;
}

.ql-container:focus-within,
.ql-toolbar:focus-within {
    border-color: #4299e1 !important;
}

.ql-container:focus-within {
    box-shadow: 0 0 0 3px rgba(66, 153, 225, 0.1) !important;
}

.ql-toolbar button {
    border-radius: 6px !important;
    margin: 2px !important;
    transition: all 0.2s ease !important;
}

.ql-toolbar button:hover {
    background: rgba(66, 153, 225, 0.1) !important;
    transform: translateY(-1px) !important;
}

.ql-toolbar button.ql-active {
    background: #4299e1 !important;
    color: white !important;
}

/* RTL Support */
.ql-editor[dir="rtl"] {
    direction: rtl !important;
    text-align: right !important;
}

.ql-snow {
    border: none !important;
}
</style>
@endpush

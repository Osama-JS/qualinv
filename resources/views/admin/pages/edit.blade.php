@extends('layouts.admin')

@section('page-title', __('admin.edit_page'))

@push('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.2/codemirror.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.2/theme/monokai.min.css">
<style>
.CodeMirror {
    border: 1px solid #e5e7eb;
    border-radius: 0.5rem;
    font-size: 14px;
    height: 300px;
}
.dark .CodeMirror {
    border-color: #4b5563;
    background-color: #1f2937;
    color: #f9fafb;
}
</style>
@endpush

@section('content')
<div class="space-y-6">
    <!-- Header Section -->
    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 p-6">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-bold text-gray-900 dark:text-gray-100">{{ __('admin.edit_page') }}</h1>
                <p class="text-gray-600 dark:text-gray-400 mt-1">{{ __('admin.edit_dynamic_page') }}: {{ $page->getLocalizedName() }}</p>
            </div>
            <div class="flex items-center space-x-3">
                <a href="{{ route('admin.pages.show', $page) }}"
                   class="inline-flex items-center px-4 py-2 bg-green-500 text-white font-semibold rounded-lg shadow-md hover:bg-green-600 transition-colors">
                    <i class="fas fa-eye mr-2"></i>
                    {{ __('admin.view') }}
                </a>
                <a href="{{ route('admin.pages.index') }}"
                   class="inline-flex items-center px-4 py-2 bg-gray-500 text-white font-semibold rounded-lg shadow-md hover:bg-gray-600 transition-colors">
                    <i class="fas fa-arrow-left mr-2"></i>
                    {{ __('admin.back') }}
                </a>
            </div>
        </div>
    </div>

    <!-- Edit Form -->
    <form action="{{ route('admin.pages.update', $page) }}" method="POST" class="space-y-6">
        @csrf
        @method('PUT')

        <!-- Basic Information -->
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 p-6">
            <h2 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-6 flex items-center">
                <i class="fas fa-info-circle text-blue-500 mr-2"></i>
                {{ __('admin.basic_information') }}
            </h2>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <!-- Page Name English -->
                <div>
                    <label for="name_en" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        {{ __('admin.page_name') }} ({{ __('admin.english_version') }}) <span class="text-red-500">*</span>
                    </label>
                    <input type="text" id="name_en" name="name_en" value="{{ old('name_en', $page->name['en'] ?? '') }}" required
                           class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent dark:bg-gray-700 dark:text-white"
                           placeholder="{{ __('admin.enter_page_name_english') }}">
                    @error('name_en')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Page Name Arabic -->
                <div>
                    <label for="name_ar" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        {{ __('admin.page_name') }} ({{ __('admin.arabic_version') }}) <span class="text-red-500">*</span>
                    </label>
                    <input type="text" id="name_ar" name="name_ar" value="{{ old('name_ar', $page->name['ar'] ?? '') }}" required
                           class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent dark:bg-gray-700 dark:text-white"
                           placeholder="{{ __('admin.enter_page_name_arabic') }}" dir="rtl">
                    @error('name_ar')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Position -->
                <div>
                    <label for="position" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        {{ __('admin.page_position') }} <span class="text-red-500">*</span>
                    </label>
                    <select id="position" name="position" required
                            class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent dark:bg-gray-700 dark:text-white">
                        <option value="">{{ __('admin.select_position') }}</option>
                        @foreach($positions as $key => $label)
                            <option value="{{ $key }}" {{ old('position', $page->position) == $key ? 'selected' : '' }}>{{ $label }}</option>
                        @endforeach
                    </select>
                    @error('position')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Status -->
                <div>
                    <label for="status" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        {{ __('admin.page_status') }} <span class="text-red-500">*</span>
                    </label>
                    <select id="status" name="status" required
                            class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent dark:bg-gray-700 dark:text-white">
                        @foreach($statuses as $key => $label)
                            <option value="{{ $key }}" {{ old('status', $page->status) == $key ? 'selected' : '' }}>{{ $label }}</option>
                        @endforeach
                    </select>
                    @error('status')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Sort Order -->
                <div>
                    <label for="sort_order" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        {{ __('admin.sort_order') }}
                    </label>
                    <input type="number" id="sort_order" name="sort_order" value="{{ old('sort_order', $page->sort_order) }}" min="0"
                           class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent dark:bg-gray-700 dark:text-white"
                           placeholder="0">
                    @error('sort_order')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Description -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mt-6">
                <!-- Description English -->
                <div>
                    <label for="description_en" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        {{ __('admin.page_description') }} ({{ __('admin.english_version') }})
                        <span class="text-gray-500 text-xs">({{ __('admin.optional') }})</span>
                    </label>
                    <textarea id="description_en" name="description_en" rows="3"
                              class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent dark:bg-gray-700 dark:text-white"
                              placeholder="{{ __('admin.enter_page_description_english') }}">{{ old('description_en', $page->description['en'] ?? '') }}</textarea>
                    @error('description_en')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Description Arabic -->
                <div>
                    <label for="description_ar" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        {{ __('admin.page_description') }} ({{ __('admin.arabic_version') }})
                        <span class="text-gray-500 text-xs">({{ __('admin.optional') }})</span>
                    </label>
                    <textarea id="description_ar" name="description_ar" rows="3" dir="rtl"
                              class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent dark:bg-gray-700 dark:text-white"
                              placeholder="{{ __('admin.enter_page_description_arabic') }}">{{ old('description_ar', $page->description['ar'] ?? '') }}</textarea>
                    @error('description_ar')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>
        </div>

        <!-- Page Content -->
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 p-6">
            <h2 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-6 flex items-center">
                <i class="fas fa-code text-green-500 mr-2"></i>
                {{ __('admin.page_content') }}
            </h2>

            <!-- Content Tabs -->
            <div class="border-b border-gray-200 dark:border-gray-700 mb-6">
                <nav class="-mb-px flex space-x-8">
                    <button type="button" onclick="switchTab('content-en')" id="content-en-tab"
                            class="tab-button active py-2 px-1 border-b-2 border-blue-500 font-medium text-sm text-blue-600 dark:text-blue-400">
                        <i class="fas fa-edit mr-1"></i>
                        {{ __('admin.content') }} (English)
                    </button>
                    <button type="button" onclick="switchTab('content-ar')" id="content-ar-tab"
                            class="tab-button py-2 px-1 border-b-2 border-transparent font-medium text-sm text-gray-500 hover:text-gray-700 hover:border-gray-300 dark:text-gray-400 dark:hover:text-gray-300">
                        <i class="fas fa-edit mr-1"></i>
                        {{ __('admin.content') }} (العربية)
                    </button>
                </nav>
            </div>

            <!-- Content English Tab -->
            <div id="content-en-content" class="tab-content">
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                    {{ __('admin.content') }} (English)
                    <span class="text-gray-500 text-xs">({{ __('admin.optional') }})</span>
                </label>
                <textarea id="content_en" name="content_en" class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-gray-100" rows="10">{{ old('content_en', $page->content_en) }}</textarea>
                @error('content_en')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Content Arabic Tab -->
            <div id="content-ar-content" class="tab-content hidden">
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                    {{ __('admin.content') }} (العربية)
                    <span class="text-gray-500 text-xs">({{ __('admin.optional') }})</span>
                </label>
                <textarea id="content_ar" name="content_ar" class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-gray-100" rows="10" dir="rtl">{{ old('content_ar', $page->content_ar) }}</textarea>
                @error('content_ar')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>


        </div>

        <!-- SEO Settings -->
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 p-6">
            <h2 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-6 flex items-center">
                <i class="fas fa-search text-purple-500 mr-2"></i>
                {{ __('admin.seo_settings') }}
            </h2>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <!-- Meta Title English -->
                <div>
                    <label for="meta_title_en" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        {{ __('admin.meta_title') }} ({{ __('admin.english_version') }})
                        <span class="text-gray-500 text-xs">(60 {{ __('admin.characters_max') }})</span>
                    </label>
                    <input type="text" id="meta_title_en" name="meta_title_en" value="{{ old('meta_title_en', $page->meta_title['en'] ?? '') }}" maxlength="60"
                           class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent dark:bg-gray-700 dark:text-white"
                           placeholder="{{ __('admin.enter_meta_title_english') }}">
                    @error('meta_title_en')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Meta Title Arabic -->
                <div>
                    <label for="meta_title_ar" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        {{ __('admin.meta_title') }} ({{ __('admin.arabic_version') }})
                        <span class="text-gray-500 text-xs">(60 {{ __('admin.characters_max') }})</span>
                    </label>
                    <input type="text" id="meta_title_ar" name="meta_title_ar" value="{{ old('meta_title_ar', $page->meta_title['ar'] ?? '') }}" maxlength="60" dir="rtl"
                           class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent dark:bg-gray-700 dark:text-white"
                           placeholder="{{ __('admin.enter_meta_title_arabic') }}">
                    @error('meta_title_ar')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>
        </div>

        <!-- Form Actions -->
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 p-6">
            <div class="flex items-center justify-end space-x-4">
                <a href="{{ route('admin.pages.index') }}"
                   class="px-6 py-2 border border-gray-300 dark:border-gray-600 text-gray-700 dark:text-gray-300 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">
                    {{ __('admin.cancel') }}
                </a>
                <button type="submit"
                        class="px-6 py-2 bg-gradient-to-r from-blue-600 to-purple-600 text-white font-semibold rounded-lg shadow-md hover:shadow-lg transform hover:scale-105 transition-all duration-200">
                    <i class="fas fa-save mr-2"></i>
                    {{ __('admin.update') }}
                </button>
            </div>
        </div>
    </form>
</div>

@push('styles')
<style>
    /* TinyMCE Custom Styling */
    .tox-tinymce {
        border-radius: 8px !important;
        border: 1px solid #d1d5db !important;
    }

    .tox-toolbar {
        background: #f9fafb !important;
        border-bottom: 1px solid #e5e7eb !important;
    }

    .tox-toolbar__primary {
        background: transparent !important;
    }

    .tox-tbtn {
        border-radius: 4px !important;
        margin: 2px !important;
    }

    .tox-tbtn:hover {
        background: #e5e7eb !important;
    }

    .tox-tbtn--enabled {
        background: #3b82f6 !important;
        color: white !important;
    }

    .tox-edit-area {
        border-radius: 0 0 8px 8px !important;
    }

    /* RTL Support */
    .tox-tinymce[dir="rtl"] .tox-toolbar {
        direction: rtl;
    }

    .tox-tinymce[dir="rtl"] .tox-edit-area {
        direction: rtl;
        text-align: right;
    }
</style>
@endpush

@push('scripts')
<!-- TinyMCE Advanced Editor -->
<script src="{{url(asset('build/assets/tinymce/tinymce.min.js'))}}"></script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Initialize TinyMCE for English content (LTR)
    tinymce.init({
        selector: '#content_en',
        height: 500,
        menubar: 'file edit view insert format tools table help',
        plugins: [
            'advlist', 'autolink', 'lists', 'link', 'image', 'charmap', 'preview',
            'anchor', 'searchreplace', 'visualblocks', 'code', 'fullscreen',
            'insertdatetime', 'media', 'table', 'help', 'wordcount', 'directionality',
            'emoticons', 'template', 'paste', 'textcolor', 'colorpicker', 'textpattern',
            'nonbreaking', 'pagebreak', 'save', 'autosave', 'visualchars', 'noneditable',
            'quickbars', 'accordion', 'codesample', 'hr'
        ],
        toolbar1: 'undo redo | bold italic underline strikethrough | fontfamily fontsize blocks | alignleft aligncenter alignright alignjustify',
        toolbar2: 'outdent indent | numlist bullist | forecolor backcolor removeformat | pagebreak | charmap emoticons | fullscreen preview save print',
        toolbar3: 'insertfile image media template link anchor codesample | ltr rtl | showcomments addcomment',
        toolbar4: 'visualblocks visualchars | table tabledelete | tableprops tablerowprops tablecellprops | tableinsertrowbefore tableinsertrowafter tabledeleterow',

        // Advanced content styling
        content_style: `
            body {
                font-family: 'Tajawal', Arial, sans-serif;
                font-size: 14px;
                line-height: 1.6;
                color: #333;
                background-color: #fff;
                margin: 1rem;
            }
            h1, h2, h3, h4, h5, h6 {
                font-family: 'Tajawal', Arial, sans-serif;
                color: #2d3748;
                margin-top: 1.5em;
                margin-bottom: 0.5em;
            }
            p { margin-bottom: 1em; }
            a { color: #3182ce; text-decoration: none; }
            a:hover { text-decoration: underline; }
            blockquote {
                border-left: 4px solid #e2e8f0;
                margin: 1.5em 0;
                padding: 0.5em 1em;
                background-color: #f7fafc;
                font-style: italic;
            }
            code {
                background-color: #f7fafc;
                padding: 0.2em 0.4em;
                border-radius: 3px;
                font-family: 'Courier New', monospace;
            }
            pre {
                background-color: #2d3748;
                color: #e2e8f0;
                padding: 1em;
                border-radius: 5px;
                overflow-x: auto;
            }
            table {
                border-collapse: collapse;
                width: 100%;
                margin: 1em 0;
            }
            th, td {
                border: 1px solid #e2e8f0;
                padding: 0.5em;
                text-align: left;
            }
            th {
                background-color: #f7fafc;
                font-weight: bold;
            }
        `,

        // Advanced features
        directionality: 'ltr',
        language: 'en',
        branding: false,
        promotion: false,
        resize: true,

        // Image and media handling
        image_advtab: true,
        image_uploadtab: true,
        file_picker_types: 'image',
        images_upload_url: '{{ route("admin.upload-image") }}',
        images_upload_handler: function (blobInfo, success, failure) {
            var xhr, formData;
            xhr = new XMLHttpRequest();
            xhr.withCredentials = false;
            xhr.open('POST', '{{ route("admin.upload-image") }}');
            xhr.setRequestHeader('X-CSRF-TOKEN', '{{ csrf_token() }}');
            xhr.onload = function() {
                var json;
                if (xhr.status != 200) {
                    failure('HTTP Error: ' + xhr.status);
                    return;
                }
                json = JSON.parse(xhr.responseText);
                if (!json || typeof json.location != 'string') {
                    failure('Invalid JSON: ' + xhr.responseText);
                    return;
                }
                success(json.location);
            };
            formData = new FormData();
            formData.append('file', blobInfo.blob(), blobInfo.filename());
            xhr.send(formData);
        },

        // Templates for quick content
        templates: [
            {
                title: 'Basic Article',
                description: 'Basic article template',
                content: '<h1>Article Title</h1><p>Article content goes here...</p>'
            },
            {
                title: 'Two Columns',
                description: 'Two column layout',
                content: '<div style="display: flex; gap: 20px;"><div style="flex: 1;"><h3>Column 1</h3><p>Content for column 1</p></div><div style="flex: 1;"><h3>Column 2</h3><p>Content for column 2</p></div></div>'
            }
        ],

        setup: function(editor) {
            editor.on('change', function() {
                editor.save();
            });
        }
    });

    // Initialize TinyMCE for Arabic content (RTL)
    tinymce.init({
        selector: '#content_ar',
        height: 500,
        menubar: 'file edit view insert format tools table help',
        plugins: [
            'advlist', 'autolink', 'lists', 'link', 'image', 'charmap', 'preview',
            'anchor', 'searchreplace', 'visualblocks', 'code', 'fullscreen',
            'insertdatetime', 'media', 'table', 'help', 'wordcount', 'directionality',
            'emoticons', 'template', 'paste', 'textcolor', 'colorpicker', 'textpattern',
            'nonbreaking', 'pagebreak', 'save', 'autosave', 'visualchars', 'noneditable',
            'quickbars', 'accordion', 'codesample', 'hr'
        ],
        toolbar1: 'undo redo | bold italic underline strikethrough | fontfamily fontsize blocks | alignleft aligncenter alignright alignjustify',
        toolbar2: 'outdent indent | numlist bullist | forecolor backcolor removeformat | pagebreak | charmap emoticons | fullscreen preview save print',
        toolbar3: 'insertfile image media template link anchor codesample | ltr rtl | showcomments addcomment',
        toolbar4: 'visualblocks visualchars | table tabledelete | tableprops tablerowprops tablecellprops | tableinsertrowbefore tableinsertrowafter tabledeleterow',

        // RTL specific settings
        content_style: `
            body {
                font-family: 'Tajawal', Arial, sans-serif;
                font-size: 14px;
                line-height: 1.6;
                color: #333;
                background-color: #fff;
                margin: 1rem;
                direction: rtl;
                text-align: right;
            }
            h1, h2, h3, h4, h5, h6 {
                font-family: 'Tajawal', Arial, sans-serif;
                color: #2d3748;
                margin-top: 1.5em;
                margin-bottom: 0.5em;
                text-align: right;
            }
            p { margin-bottom: 1em; text-align: right; }
            a { color: #3182ce; text-decoration: none; }
            a:hover { text-decoration: underline; }
            blockquote {
                border-right: 4px solid #e2e8f0;
                border-left: none;
                margin: 1.5em 0;
                padding: 0.5em 1em;
                background-color: #f7fafc;
                font-style: italic;
                text-align: right;
            }
            code {
                background-color: #f7fafc;
                padding: 0.2em 0.4em;
                border-radius: 3px;
                font-family: 'Courier New', monospace;
            }
            pre {
                background-color: #2d3748;
                color: #e2e8f0;
                padding: 1em;
                border-radius: 5px;
                overflow-x: auto;
                direction: ltr;
                text-align: left;
            }
            table {
                border-collapse: collapse;
                width: 100%;
                margin: 1em 0;
            }
            th, td {
                border: 1px solid #e2e8f0;
                padding: 0.5em;
                text-align: right;
            }
            th {
                background-color: #f7fafc;
                font-weight: bold;
            }
        `,

        // RTL specific features
        directionality: 'rtl',
        language: 'ar',
        branding: false,
        promotion: false,
        resize: true,

        // Image and media handling
        image_advtab: true,
        image_uploadtab: true,
        file_picker_types: 'image',
        images_upload_url: '{{ route("admin.upload-image") }}',
        images_upload_handler: function (blobInfo, success, failure) {
            var xhr, formData;
            xhr = new XMLHttpRequest();
            xhr.withCredentials = false;
            xhr.open('POST', '{{ route("admin.upload-image") }}');
            xhr.setRequestHeader('X-CSRF-TOKEN', '{{ csrf_token() }}');
            xhr.onload = function() {
                var json;
                if (xhr.status != 200) {
                    failure('HTTP Error: ' + xhr.status);
                    return;
                }
                json = JSON.parse(xhr.responseText);
                if (!json || typeof json.location != 'string') {
                    failure('Invalid JSON: ' + xhr.responseText);
                    return;
                }
                success(json.location);
            };
            formData = new FormData();
            formData.append('file', blobInfo.blob(), blobInfo.filename());
            xhr.send(formData);
        },

        // Arabic templates
        templates: [
            {
                title: 'مقال أساسي',
                description: 'قالب مقال أساسي',
                content: '<h1>عنوان المقال</h1><p>محتوى المقال يأتي هنا...</p>'
            },
            {
                title: 'عمودين',
                description: 'تخطيط عمودين',
                content: '<div style="display: flex; gap: 20px; direction: rtl;"><div style="flex: 1;"><h3>العمود الأول</h3><p>محتوى العمود الأول</p></div><div style="flex: 1;"><h3>العمود الثاني</h3><p>محتوى العمود الثاني</p></div></div>'
            }
        ],

        setup: function(editor) {
            editor.on('change', function() {
                editor.save();
            });
        }
    });




});

function switchTab(tab) {
    // Hide all tab contents
    document.querySelectorAll('.tab-content').forEach(content => {
        content.classList.add('hidden');
    });

    // Remove active class from all tabs
    document.querySelectorAll('.tab-button').forEach(button => {
        button.classList.remove('active', 'border-blue-500', 'text-blue-600', 'dark:text-blue-400');
        button.classList.add('border-transparent', 'text-gray-500', 'hover:text-gray-700', 'hover:border-gray-300', 'dark:text-gray-400', 'dark:hover:text-gray-300');
    });

    // Show selected tab content
    document.getElementById(tab + '-content').classList.remove('hidden');

    // Add active class to selected tab
    const activeTab = document.getElementById(tab + '-tab');
    activeTab.classList.add('active', 'border-blue-500', 'text-blue-600', 'dark:text-blue-400');
    activeTab.classList.remove('border-transparent', 'text-gray-500', 'hover:text-gray-700', 'hover:border-gray-300', 'dark:text-gray-400', 'dark:hover:text-gray-300');

    // No need to refresh editors as we're using TinyMCE now
}
</script>
@endpush
@endsection

@extends('layouts.admin')

@section('title', __('admin.create_content_section'))

@section('content')
<div class="container px-6 mx-auto grid">
    <div class="flex justify-between items-center">
        <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
            {{ __('admin.create_content_section') }}
        </h2>
        <a href="{{ route('admin.content-sections.index') }}" class="flex items-center justify-between px-4 py-2 text-sm font-medium leading-5 text-gray-700 transition-colors duration-150 bg-white border border-gray-300 rounded-lg active:bg-gray-100 hover:bg-gray-100 focus:outline-none focus:shadow-outline-gray">
            <i class="fas fa-arrow-left mr-2"></i>
            <span>{{ __('admin.back_to_list') }}</span>
        </a>
    </div>

    <div class="bg-white dark:bg-gray-800 shadow-md rounded-lg border border-gray-200 dark:border-gray-700">
        <div class="p-6 border-b border-gray-200 dark:border-gray-700">
            <h3 class="text-lg font-semibold text-gray-800 dark:text-white">
                {{ __('admin.content_section_details') }}
            </h3>
        </div>

        <form method="POST" action="{{ route('admin.content-sections.store') }}" class="p-6">
            @csrf

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
                <!-- Arabic Title -->
                <div>
                    <label for="title_ar" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        {{ __('admin.title_arabic') }} <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="title_ar" id="title_ar" value="{{ old('title_ar') }}"
                           class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-gray-300"
                           required>
                    @error('title_ar')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- English Title -->
                <div>
                    <label for="title_en" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        {{ __('admin.title_english') }} <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="title_en" id="title_en" value="{{ old('title_en') }}"
                           class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-gray-300"
                           required>
                    @error('title_en')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-6">
                <!-- Page Location -->
                <div>
                    <label for="page_location" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        {{ __('admin.page_location') }} <span class="text-red-500">*</span>
                    </label>
                    <select name="page_location" id="page_location"
                            class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-gray-300"
                            required>
                        <option value="">{{ __('admin.select_page') }}</option>
                        @foreach(\App\Models\ContentSection::getPageLocations() as $value => $label)
                            <option value="{{ $value }}" {{ old('page_location') == $value ? 'selected' : '' }}>{{ $label }}</option>
                        @endforeach
                    </select>
                    @error('page_location')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Display Order -->
                <div>
                    <label for="display_order" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        {{ __('admin.display_order') }} <span class="text-red-500">*</span>
                    </label>
                    <input type="number" name="display_order" id="display_order" value="{{ old('display_order', 0) }}" min="0"
                           class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-gray-300"
                           required>
                    @error('display_order')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Status -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        {{ __('admin.status') }}
                    </label>
                    <div class="flex items-center">
                        <input type="checkbox" name="is_active" id="is_active" value="1" {{ old('is_active', true) ? 'checked' : '' }}
                               class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                        <label for="is_active" class="ml-2 text-sm text-gray-700 dark:text-gray-300">
                            {{ __('admin.active') }}
                        </label>
                    </div>
                </div>
            </div>

            <!-- Arabic Content -->
            <div class="mb-6">
                <label for="content_ar" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                    {{ __('admin.content_arabic') }} <span class="text-red-500">*</span>
                </label>
                <textarea name="content_ar" id="content_ar" rows="10"
                          class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-gray-300"
                          required>{{ old('content_ar') }}</textarea>
                @error('content_ar')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- English Content -->
            <div class="mb-6">
                <label for="content_en" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                    {{ __('admin.content_english') }} <span class="text-red-500">*</span>
                </label>
                <textarea name="content_en" id="content_en" rows="10"
                          class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-gray-300"
                          required>{{ old('content_en') }}</textarea>
                @error('content_en')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex justify-end space-x-4">
                <a href="{{ route('admin.content-sections.index') }}" class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                    {{ __('admin.cancel') }}
                </a>
                <button type="submit" class="px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                    {{ __('admin.create') }}
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

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
            'insertdatetime', 'media', 'table', 'help', 'wordcount', 'emoticons',
            'template', 'codesample', 'hr', 'pagebreak', 'nonbreaking',
            'toc', 'imagetools', 'textpattern', 'noneditable', 'quickbars'
        ],
        toolbar1: 'undo redo | bold italic underline strikethrough | fontselect fontsizeselect formatselect | alignleft aligncenter alignright alignjustify',
        toolbar2: 'cut copy paste | searchreplace | bullist numlist | outdent indent blockquote | insertdatetime preview | forecolor backcolor',
        toolbar3: 'table | hr removeformat | subscript superscript | charmap emoticons | print fullscreen | ltr rtl | spellchecker | visualchars visualblocks nonbreaking',
        toolbar4: 'link unlink anchor image media codesample | insertdatetime hr pagebreak | showcomments addcomment',

        // Content styling
        content_style: `
            body {
                font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, sans-serif;
                font-size: 14px;
                line-height: 1.6;
                color: #333;
                max-width: 100%;
                margin: 0 auto;
                padding: 20px;
            }
            .mce-content-body[data-mce-placeholder]:not(.mce-visualblocks)::before {
                color: #999;
                font-style: italic;
            }
            img { max-width: 100%; height: auto; }
            table { border-collapse: collapse; width: 100%; }
            table td, table th { border: 1px solid #ddd; padding: 8px; }
        `,

        // Advanced options
        branding: false,
        elementpath: true,
        resize: 'both',
        statusbar: true,

        // Image handling
        images_upload_url: '/admin/upload-image',
        images_upload_base_path: '/storage/',
        images_upload_credentials: true,
        images_upload_handler: function (blobInfo, success, failure) {
            var xhr, formData;
            xhr = new XMLHttpRequest();
            xhr.withCredentials = false;
            xhr.open('POST', '/admin/upload-image');
            xhr.setRequestHeader('X-CSRF-TOKEN', document.querySelector('meta[name="csrf-token"]').getAttribute('content'));

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

        // Templates
        templates: [
            {
                title: 'Simple Layout',
                description: 'Simple content layout',
                content: '<h2>Title</h2><p>Your content goes here...</p>'
            },
            {
                title: 'Two Column Layout',
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
            'insertdatetime', 'media', 'table', 'help', 'wordcount', 'emoticons',
            'template', 'codesample', 'hr', 'pagebreak', 'nonbreaking',
            'toc', 'imagetools', 'textpattern', 'noneditable', 'quickbars'
        ],
        toolbar1: 'undo redo | bold italic underline strikethrough | fontselect fontsizeselect formatselect | alignleft aligncenter alignright alignjustify',
        toolbar2: 'cut copy paste | searchreplace | bullist numlist | outdent indent blockquote | insertdatetime preview | forecolor backcolor',
        toolbar3: 'table | hr removeformat | subscript superscript | charmap emoticons | print fullscreen | ltr rtl | spellchecker | visualchars visualblocks nonbreaking',
        toolbar4: 'link unlink anchor image media codesample | insertdatetime hr pagebreak | showcomments addcomment',

        // RTL Configuration
        directionality: 'rtl',
        language: 'ar',

        // Content styling for Arabic
        content_style: `
            body {
                font-family: 'Tajawal', 'Cairo', 'Amiri', Arial, sans-serif;
                font-size: 14px;
                line-height: 1.8;
                color: #333;
                direction: rtl;
                text-align: right;
                max-width: 100%;
                margin: 0 auto;
                padding: 20px;
            }
            .mce-content-body[data-mce-placeholder]:not(.mce-visualblocks)::before {
                color: #999;
                font-style: italic;
            }
            img { max-width: 100%; height: auto; }
            table { border-collapse: collapse; width: 100%; }
            table td, table th { border: 1px solid #ddd; padding: 8px; text-align: right; }
            h1, h2, h3, h4, h5, h6 { text-align: right; }
            ul, ol { text-align: right; }
        `,

        // Advanced options
        branding: false,
        elementpath: true,
        resize: 'both',
        statusbar: true,

        // Image handling
        images_upload_url: '/admin/upload-image',
        images_upload_base_path: '/storage/',
        images_upload_credentials: true,
        images_upload_handler: function (blobInfo, success, failure) {
            var xhr, formData;
            xhr = new XMLHttpRequest();
            xhr.withCredentials = false;
            xhr.open('POST', '/admin/upload-image');
            xhr.setRequestHeader('X-CSRF-TOKEN', document.querySelector('meta[name="csrf-token"]').getAttribute('content'));

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

        // Templates for Arabic
        templates: [
            {
                title: 'تخطيط بسيط',
                description: 'تخطيط محتوى بسيط',
                content: '<h2>العنوان</h2><p>المحتوى الخاص بك هنا...</p>'
            },
            {
                title: 'تخطيط عمودين',
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
</script>
@endpush

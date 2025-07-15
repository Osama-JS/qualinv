@extends('layouts.admin')

@section('page-title', __('admin.page_preview'))

@section('content')
<div class="space-y-6">
    <!-- Header Section -->
    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 p-6">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-bold text-gray-900 dark:text-gray-100">{{ __('admin.page_preview') }}</h1>
                <p class="text-gray-600 dark:text-gray-400 mt-1">{{ $page->getLocalizedName() }}</p>
            </div>
            <div class="flex items-center space-x-3">
                <a href="{{ route('admin.pages.edit', $page) }}"
                   class="inline-flex items-center px-4 py-2 bg-blue-600 text-white font-semibold rounded-lg shadow-md hover:bg-blue-700 transition-colors">
                    <i class="fas fa-edit mr-2"></i>
                    {{ __('admin.edit') }}
                </a>
                <a href="{{ route('admin.pages.index') }}"
                   class="inline-flex items-center px-4 py-2 bg-gray-500 text-white font-semibold rounded-lg shadow-md hover:bg-gray-600 transition-colors">
                    <i class="fas fa-arrow-left mr-2"></i>
                    {{ __('admin.back') }}
                </a>
            </div>
        </div>
    </div>

    <!-- Page Information -->
    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 p-6">
        <h2 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-6 flex items-center">
            <i class="fas fa-info-circle text-blue-500 mr-2"></i>
            {{ __('admin.page_information') }}
        </h2>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <!-- Basic Info -->
            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">{{ __('admin.page_name') }}</label>
                    <div class="space-y-2">
                        <div class="flex items-center space-x-2">
                            <span class="inline-flex items-center px-2 py-1 bg-blue-100 text-blue-800 text-xs font-medium rounded dark:bg-blue-900 dark:text-blue-200">EN</span>
                            <span class="text-gray-900 dark:text-gray-100">{{ $page->name['en'] ?? 'N/A' }}</span>
                        </div>
                        <div class="flex items-center space-x-2">
                            <span class="inline-flex items-center px-2 py-1 bg-green-100 text-green-800 text-xs font-medium rounded dark:bg-green-900 dark:text-green-200">AR</span>
                            <span class="text-gray-900 dark:text-gray-100" dir="rtl">{{ $page->name['ar'] ?? 'N/A' }}</span>
                        </div>
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">{{ __('admin.page_position') }}</label>
                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                        {{ $page->position === 'navbar' ? 'bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200' : 'bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-200' }}">
                        <i class="fas {{ $page->position === 'navbar' ? 'fa-bars' : 'fa-grip-lines' }} mr-1"></i>
                        {{ \App\Models\Page::getPositions()[$page->position] }}
                    </span>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">{{ __('admin.status') }}</label>
                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                        {{ $page->status === 'active' ? 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200' : 'bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200' }}">
                        <i class="fas {{ $page->status === 'active' ? 'fa-check-circle' : 'fa-times-circle' }} mr-1"></i>
                        {{ \App\Models\Page::getStatuses()[$page->status] }}
                    </span>
                </div>
            </div>

            <!-- URLs -->
            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">{{ __('admin.page_urls') }}</label>
                    <div class="space-y-2">
                        <div class="flex items-center space-x-2">
                            <span class="inline-flex items-center px-2 py-1 bg-blue-100 text-blue-800 text-xs font-medium rounded dark:bg-blue-900 dark:text-blue-200">EN</span>
                            <code class="text-sm bg-gray-100 dark:bg-gray-700 px-2 py-1 rounded text-gray-800 dark:text-gray-200">
                                /page/{{ $page->slug['en'] ?? 'N/A' }}
                            </code>
                        </div>
                        <div class="flex items-center space-x-2">
                            <span class="inline-flex items-center px-2 py-1 bg-green-100 text-green-800 text-xs font-medium rounded dark:bg-green-900 dark:text-green-200">AR</span>
                            <code class="text-sm bg-gray-100 dark:bg-gray-700 px-2 py-1 rounded text-gray-800 dark:text-gray-200">
                                /page/{{ $page->slug['ar'] ?? 'N/A' }}
                            </code>
                        </div>
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">{{ __('admin.sort_order') }}</label>
                    <span class="inline-flex items-center px-2 py-1 bg-gray-100 dark:bg-gray-700 rounded text-xs text-gray-800 dark:text-gray-200">
                        {{ $page->sort_order }}
                    </span>
                </div>
            </div>

            <!-- Timestamps -->
            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">{{ __('admin.created_at') }}</label>
                    <p class="text-sm text-gray-600 dark:text-gray-400">{{ $page->created_at->format('M d, Y H:i') }}</p>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">{{ __('admin.updated_at') }}</label>
                    <p class="text-sm text-gray-600 dark:text-gray-400">{{ $page->updated_at->format('M d, Y H:i') }}</p>
                </div>
            </div>
        </div>

        <!-- Description -->
        @if($page->description && (($page->description['en'] ?? '') || ($page->description['ar'] ?? '')))
        <div class="mt-6 pt-6 border-t border-gray-200 dark:border-gray-700">
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-3">{{ __('admin.page_description') }}</label>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                @if($page->description['en'] ?? '')
                <div>
                    <div class="flex items-center space-x-2 mb-2">
                        <span class="inline-flex items-center px-2 py-1 bg-blue-100 text-blue-800 text-xs font-medium rounded dark:bg-blue-900 dark:text-blue-200">EN</span>
                    </div>
                    <p class="text-sm text-gray-600 dark:text-gray-400 bg-gray-50 dark:bg-gray-700 p-3 rounded-lg">{{ $page->description['en'] }}</p>
                </div>
                @endif
                @if($page->description['ar'] ?? '')
                <div>
                    <div class="flex items-center space-x-2 mb-2">
                        <span class="inline-flex items-center px-2 py-1 bg-green-100 text-green-800 text-xs font-medium rounded dark:bg-green-900 dark:text-green-200">AR</span>
                    </div>
                    <p class="text-sm text-gray-600 dark:text-gray-400 bg-gray-50 dark:bg-gray-700 p-3 rounded-lg" dir="rtl">{{ $page->description['ar'] }}</p>
                </div>
                @endif
            </div>
        </div>
        @endif
    </div>

    <!-- Content Preview -->
    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 p-6">
        <h2 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-6 flex items-center">
            <i class="fas fa-eye text-green-500 mr-2"></i>
            {{ __('admin.content_preview') }}
        </h2>

        <!-- Preview Tabs -->
        <div class="border-b border-gray-200 dark:border-gray-700 mb-6">
            <nav class="-mb-px flex space-x-8">
                <button type="button" onclick="switchPreviewTab('content-en')" id="content-en-tab"
                        class="preview-tab-button active py-2 px-1 border-b-2 border-blue-500 font-medium text-sm text-blue-600 dark:text-blue-400">
                    <i class="fas fa-edit mr-1"></i>
                    {{ __('admin.content') }} (English)
                </button>
                <button type="button" onclick="switchPreviewTab('content-ar')" id="content-ar-tab"
                        class="preview-tab-button py-2 px-1 border-b-2 border-transparent font-medium text-sm text-gray-500 hover:text-gray-700 hover:border-gray-300 dark:text-gray-400 dark:hover:text-gray-300">
                    <i class="fas fa-edit mr-1"></i>
                    {{ __('admin.content') }} (العربية)
                </button>
            </nav>
        </div>

        <!-- English Content Preview -->
        <div id="content-en-preview" class="preview-tab-content">
            <div class="border border-gray-200 dark:border-gray-700 rounded-lg p-6 bg-white dark:bg-gray-900 min-h-96">
                <div class="prose prose-lg max-w-none dark:prose-invert
                    prose-headings:text-gray-900 dark:prose-headings:text-gray-100
                    prose-p:text-gray-700 dark:prose-p:text-gray-300
                    prose-a:text-blue-600 dark:prose-a:text-blue-400
                    prose-strong:text-gray-900 dark:prose-strong:text-gray-100
                    prose-code:text-pink-600 dark:prose-code:text-pink-400
                    prose-pre:bg-gray-900 dark:prose-pre:bg-gray-800
                    prose-blockquote:border-blue-500 dark:prose-blockquote:border-blue-400
                    prose-hr:border-gray-300 dark:prose-hr:border-gray-600
                    prose-table:text-gray-900 dark:prose-table:text-gray-100
                    prose-th:bg-gray-100 dark:prose-th:bg-gray-700
                    prose-td:border-gray-300 dark:prose-td:border-gray-600">

                    @if($page->content_en)
                        {!! $page->content_en !!}
                    @else
                        <div class="text-center py-12">
                            <i class="fas fa-file-alt text-gray-400 text-4xl mb-4"></i>
                            <p class="text-gray-500">{{ __('admin.no_english_content') }}</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Arabic Content Preview -->
        <div id="content-ar-preview" class="preview-tab-content hidden">
            <div class="border border-gray-200 dark:border-gray-700 rounded-lg p-6 bg-white dark:bg-gray-900 min-h-96" dir="rtl">
                <div class="prose prose-lg max-w-none dark:prose-invert
                    prose-headings:text-gray-900 dark:prose-headings:text-gray-100
                    prose-p:text-gray-700 dark:prose-p:text-gray-300
                    prose-a:text-blue-600 dark:prose-a:text-blue-400
                    prose-strong:text-gray-900 dark:prose-strong:text-gray-100
                    prose-code:text-pink-600 dark:prose-code:text-pink-400
                    prose-pre:bg-gray-900 dark:prose-pre:bg-gray-800
                    prose-blockquote:border-blue-500 dark:prose-blockquote:border-blue-400
                    prose-hr:border-gray-300 dark:prose-hr:border-gray-600
                    prose-table:text-gray-900 dark:prose-table:text-gray-100
                    prose-th:bg-gray-100 dark:prose-th:bg-gray-700
                    prose-td:border-gray-300 dark:prose-td:border-gray-600
                    text-right">

                    @if($page->content_ar)
                        {!! $page->content_ar !!}
                    @else
                        <div class="text-center py-12">
                            <i class="fas fa-file-alt text-gray-400 text-4xl mb-4"></i>
                            <p class="text-gray-500">{{ __('admin.no_arabic_content') }}</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- SEO Information -->
    @if($page->meta_title || $page->meta_description || $page->meta_keywords)
    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 p-6">
        <h2 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-6 flex items-center">
            <i class="fas fa-search text-purple-500 mr-2"></i>
            {{ __('admin.seo_information') }}
        </h2>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Meta Title -->
            @if($page->meta_title && (($page->meta_title['en'] ?? '') || ($page->meta_title['ar'] ?? '')))
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">{{ __('admin.meta_title') }}</label>
                <div class="space-y-2">
                    @if($page->meta_title['en'] ?? '')
                    <div class="flex items-start space-x-2">
                        <span class="inline-flex items-center px-2 py-1 bg-blue-100 text-blue-800 text-xs font-medium rounded dark:bg-blue-900 dark:text-blue-200">EN</span>
                        <p class="text-sm text-gray-600 dark:text-gray-400 bg-gray-50 dark:bg-gray-700 p-2 rounded flex-1">{{ $page->meta_title['en'] }}</p>
                    </div>
                    @endif
                    @if($page->meta_title['ar'] ?? '')
                    <div class="flex items-start space-x-2">
                        <span class="inline-flex items-center px-2 py-1 bg-green-100 text-green-800 text-xs font-medium rounded dark:bg-green-900 dark:text-green-200">AR</span>
                        <p class="text-sm text-gray-600 dark:text-gray-400 bg-gray-50 dark:bg-gray-700 p-2 rounded flex-1" dir="rtl">{{ $page->meta_title['ar'] }}</p>
                    </div>
                    @endif
                </div>
            </div>
            @endif

            <!-- Meta Description -->
            @if($page->meta_description && (($page->meta_description['en'] ?? '') || ($page->meta_description['ar'] ?? '')))
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">{{ __('admin.meta_description') }}</label>
                <div class="space-y-2">
                    @if($page->meta_description['en'] ?? '')
                    <div class="flex items-start space-x-2">
                        <span class="inline-flex items-center px-2 py-1 bg-blue-100 text-blue-800 text-xs font-medium rounded dark:bg-blue-900 dark:text-blue-200">EN</span>
                        <p class="text-sm text-gray-600 dark:text-gray-400 bg-gray-50 dark:bg-gray-700 p-2 rounded flex-1">{{ $page->meta_description['en'] }}</p>
                    </div>
                    @endif
                    @if($page->meta_description['ar'] ?? '')
                    <div class="flex items-start space-x-2">
                        <span class="inline-flex items-center px-2 py-1 bg-green-100 text-green-800 text-xs font-medium rounded dark:bg-green-900 dark:text-green-200">AR</span>
                        <p class="text-sm text-gray-600 dark:text-gray-400 bg-gray-50 dark:bg-gray-700 p-2 rounded flex-1" dir="rtl">{{ $page->meta_description['ar'] }}</p>
                    </div>
                    @endif
                </div>
            </div>
            @endif
        </div>
    </div>
    @endif
</div>

@push('scripts')
<script>
function switchPreviewTab(tab) {
    // Hide all preview tab contents
    document.querySelectorAll('.preview-tab-content').forEach(content => {
        content.classList.add('hidden');
    });

    // Remove active class from all preview tabs
    document.querySelectorAll('.preview-tab-button').forEach(button => {
        button.classList.remove('active', 'border-blue-500', 'text-blue-600', 'dark:text-blue-400');
        button.classList.add('border-transparent', 'text-gray-500', 'hover:text-gray-700', 'hover:border-gray-300', 'dark:text-gray-400', 'dark:hover:text-gray-300');
    });

    // Show selected preview tab content
    document.getElementById(tab + '-preview').classList.remove('hidden');

    // Add active class to selected preview tab
    const activeTab = document.getElementById(tab + '-tab') || document.getElementById(tab + '-preview-tab');
    if (activeTab) {
        activeTab.classList.add('active', 'border-blue-500', 'text-blue-600', 'dark:text-blue-400');
        activeTab.classList.remove('border-transparent', 'text-gray-500', 'hover:text-gray-700', 'hover:border-gray-300', 'dark:text-gray-400', 'dark:hover:text-gray-300');
    }
}
</script>
@endpush
@endsection

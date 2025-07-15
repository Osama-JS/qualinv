@extends('layouts.public')

@section('title', $pageTitle)
@section('description', $pageDescription)
@section('keywords', $pageKeywords)

@push('styles')
@if($page->css_styling)
<style>
{!! $page->css_styling !!}
</style>
@endif
@endpush

@section('content')
<!-- Page Header -->
<section class="page-header relative bg-gradient-investment text-white overflow-hidden">
    <!-- Background Image -->
    <div class="absolute inset-0 bg-cover bg-center bg-no-repeat"
         style="background-image: url('https://images.unsplash.com/photo-1559526324-4b87b5e36e44?ixlib=rb-4.0.3&auto=format&fit=crop&w=2070&q=80');">
    </div>
    <!-- Dark Overlay -->
    <div class="absolute inset-0 bg-gradient-to-r from-green-900/90 via-gray-900/80 to-green-800/90"></div>
    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <div class="mb-8">
            <div class="inline-flex items-center justify-center w-20 h-20 bg-white/20 backdrop-blur-sm rounded-full mb-6">
                <i class="fas fa-file-alt text-3xl text-white"></i>
            </div>
            <h1 class="text-4xl md:text-6xl font-bold mb-6">
                {{ $page->getLocalizedName() }}
            </h1>

            @if($page->getLocalizedDescription())
            <p class="text-xl md:text-2xl text-gray-200 max-w-4xl mx-auto">
                {!! $page->getLocalizedDescription() !!}
            </p>
            @endif
        </div>


    </div>
</section>

<!-- Page Content -->
<section class="py-16 bg-gray-50 dark:bg-gray-900 min-h-screen">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl overflow-hidden">
            @if($page->getLocalizedContent())
            <!-- Custom Page Content -->
            <div class="p-8 md:p-12 ">
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
                    {{ app()->getLocale() === 'ar' ? 'text-right' : 'text-left' }}"
                    dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}">

                    {!! $page->getLocalizedContent() !!}
                </div>
            </div>
            @else
            <!-- Default Content when no HTML is provided -->
            <div class="p-8 md:p-12 lg:p-16 text-center">
                <div class="max-w-2xl mx-auto">
                    <div class="w-24 h-24 bg-gradient-to-br from-blue-500 to-purple-600 rounded-full flex items-center justify-center mx-auto mb-8">
                        <i class="fas fa-file-alt text-white text-3xl"></i>
                    </div>

                    <h2 class="text-3xl font-bold text-gray-900 dark:text-gray-100 mb-4">
                        {{ $page->getLocalizedName() }}
                    </h2>

                    @if($page->getLocalizedDescription())
                    <p class="text-lg text-gray-600 dark:text-gray-400 mb-8 leading-relaxed">
                        {!! $page->getLocalizedDescription() !!}
                    </p>
                    @endif

                    <div class="bg-blue-50 dark:bg-blue-900/20 border border-blue-200 dark:border-blue-800 rounded-lg p-6">
                        <p class="text-blue-800 dark:text-blue-200">
                            <i class="fas fa-info-circle mr-2"></i>
                            {{ app()->getLocale() === 'ar' ? 'هذه الصفحة قيد التطوير. سيتم إضافة المحتوى قريباً.' : 'This page is under development. Content will be added soon.' }}
                        </p>
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>
</section>

<!-- Call to Action Section -->
<section class="py-16 bg-gradient-to-r from-green-800 via-gray-900 to-green-700">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <div class="animate-on-scroll">
            <h2 class="text-3xl md:text-4xl font-bold text-white mb-4">
                {{ app()->getLocale() === 'ar' ? 'هل لديك أسئلة؟' : 'Have Questions?' }}
            </h2>
            <p class="text-xl text-gray-200 mb-8 max-w-2xl mx-auto">
                {{ app()->getLocale() === 'ar' ? 'فريقنا جاهز لمساعدتك في أي استفسارات حول خدماتنا الاستثمارية.' : 'Our team is ready to help you with any questions about our investment services.' }}
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="{{ route('contact') }}"
                   class="inline-flex items-center px-8 py-3 bg-white text-green-800 font-semibold rounded-lg shadow-lg hover:bg-gray-50 transform hover:scale-105 transition-all duration-200">
                    <i class="fas fa-envelope mr-2"></i>
                    {{ app()->getLocale() === 'ar' ? 'تواصل معنا' : 'Contact Us' }}
                </a>
                <a href="{{ route('investment-mechanism') }}"
                   class="inline-flex items-center px-8 py-3 bg-transparent border-2 border-white text-white font-semibold rounded-lg hover:bg-white hover:text-green-800 transform hover:scale-105 transition-all duration-200">
                    <i class="fas fa-chart-line mr-2"></i>
                    {{ app()->getLocale() === 'ar' ? 'آلية الاستثمار' : 'Investment Mechanism' }}
                </a>
            </div>
        </div>
    </div>
</section>
@endsection

@push('scripts')
@if($page->js_functionality)
<script>
{!! $page->js_functionality !!}
</script>
@endif

<script>
// Enhanced page-specific functionality
document.addEventListener('DOMContentLoaded', function() {
    // Smooth scrolling for anchor links within the page content
    const pageContent = document.querySelector('.prose');
    if (pageContent) {
        const anchorLinks = pageContent.querySelectorAll('a[href^="#"]');
        anchorLinks.forEach(link => {
            link.addEventListener('click', function(e) {
                e.preventDefault();
                const targetId = this.getAttribute('href').substring(1);
                const targetElement = document.getElementById(targetId);
                if (targetElement) {
                    targetElement.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });
    }

    // Add copy functionality to code blocks
    const codeBlocks = document.querySelectorAll('pre code');
    codeBlocks.forEach(block => {
        const button = document.createElement('button');
        button.className = 'absolute top-2 right-2 px-2 py-1 bg-gray-700 text-white text-xs rounded hover:bg-gray-600 transition-colors';
        button.innerHTML = '<i class="fas fa-copy mr-1"></i>Copy';

        const pre = block.parentElement;
        pre.style.position = 'relative';
        pre.appendChild(button);

        button.addEventListener('click', function() {
            navigator.clipboard.writeText(block.textContent).then(() => {
                button.innerHTML = '<i class="fas fa-check mr-1"></i>Copied!';
                setTimeout(() => {
                    button.innerHTML = '<i class="fas fa-copy mr-1"></i>Copy';
                }, 2000);
            });
        });
    });

    // Enhanced table responsiveness
    const tables = document.querySelectorAll('.prose table');
    tables.forEach(table => {
        const wrapper = document.createElement('div');
        wrapper.className = 'overflow-x-auto';
        table.parentNode.insertBefore(wrapper, table);
        wrapper.appendChild(table);
    });

    // Add loading states for external links
    const externalLinks = document.querySelectorAll('.prose a[href^="http"]');
    externalLinks.forEach(link => {
        link.addEventListener('click', function() {
            this.innerHTML += ' <i class="fas fa-spinner fa-spin ml-1"></i>';
        });
    });
});
</script>
@endpush

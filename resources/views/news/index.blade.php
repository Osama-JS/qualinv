@extends('layouts.public')

@section('title', app()->getLocale() === 'ar' ? 'الأخبار والتحديثات' : 'News & Updates')
@section('description', app()->getLocale() === 'ar' ? 'آخر الأخبار والتحديثات من شركة الجودة للاستثمار' : 'Latest news and updates from Quality Investment Company')

@section('content')
@php
    $articles = \App\Models\Article::published()->latest()->paginate(9);
    $featuredArticle = \App\Models\Article::published()->featured()->first();
@endphp

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
                <i class="fas fa-newspaper text-3xl text-white"></i>
            </div>
            <h1 class="text-4xl md:text-6xl font-bold mb-6">
                {{ app()->getLocale() === 'ar' ? 'الأخبار والتحديثات' : 'News & Updates' }}
            </h1>
            <p class="text-xl md:text-2xl text-gray-200 max-w-4xl mx-auto">
                {{ app()->getLocale() === 'ar'
                    ? 'ابق على اطلاع بآخر الأخبار والتطورات في عالم الاستثمار والأسواق المالية'
                    : 'Stay updated with the latest news and developments in the world of investment and financial markets'
                }}
            </p>
        </div>
    </div>
</section>

<!-- Featured Article -->
@if($featuredArticle)
<section class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="mb-12">
            <h2 class="text-3xl font-bold text-gray-900 mb-4">
                {{ app()->getLocale() === 'ar' ? 'الخبر المميز' : 'Featured News' }}
            </h2>
        </div>

        <div class="bg-white rounded-2xl shadow-xl overflow-hidden border border-gray-100">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-0">
                <!-- Featured Image -->
                <div class="relative h-96 lg:h-auto">
                    @if($featuredArticle->featured_image)
                        <img src="{{ asset('storage/' . $featuredArticle->featured_image) }}"
                             alt="{{ app()->getLocale() === 'ar' ? $featuredArticle->title_ar : $featuredArticle->title_en }}"
                             class="w-full h-full object-cover">
                    @else
                        <div class="w-full h-full bg-gradient-to-br from-green-100 to-blue-100 flex items-center justify-center">
                            <i class="fas fa-newspaper text-gray-400 text-6xl"></i>
                        </div>
                    @endif

                    <!-- Category Badge -->
                    <div class="absolute top-6 left-6">
                        <span class="bg-green-600 text-white px-4 py-2 rounded-full text-sm font-semibold">
                            {{ app()->getLocale() === 'ar' ? 'خبر مميز' : 'Featured' }}
                        </span>
                    </div>
                </div>

                <!-- Content -->
                <div class="p-8 lg:p-12 flex flex-col justify-center">
                    <div class="flex items-center text-sm text-gray-500 mb-4">
                        <i class="fas fa-calendar mr-2"></i>
                        {{ $featuredArticle->created_at->format('M d, Y') }}
                        <span class="mx-2">•</span>
                        <i class="fas fa-clock mr-2"></i>
                        {{ app()->getLocale() === 'ar' ? '5 دقائق قراءة' : '5 min read' }}
                    </div>

                    <h3 class="text-3xl font-bold text-gray-900 mb-4">
                        {{ app()->getLocale() === 'ar' ? $featuredArticle->title_ar : $featuredArticle->title_en }}
                    </h3>

                    <p class="text-gray-600 text-lg leading-relaxed mb-6">
                        {{ app()->getLocale() === 'ar' ? Str::limit($featuredArticle->excerpt_ar, 200) : Str::limit($featuredArticle->excerpt_en, 200) }}
                    </p>

                    <a href="{{ route('news.show', $featuredArticle->slug) }}"
                       class="inline-flex items-center text-green-600 font-semibold hover:text-green-700 transition-colors">
                        {{ app()->getLocale() === 'ar' ? 'اقرأ المزيد' : 'Read More' }}
                        <i class="fas fa-arrow-right mr-2"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
@endif

<!-- News Grid -->
<section class="py-20 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center mb-12">
            <h2 class="text-3xl font-bold text-gray-900">
                {{ app()->getLocale() === 'ar' ? 'جميع الأخبار' : 'All News' }}
            </h2>

            <!-- Filter Buttons -->
            <div class="hidden md:flex space-x-4">
                <button class="filter-btn active px-4 py-2 bg-green-600 text-white rounded-lg font-semibold transition-colors" data-filter="all">
                    {{ app()->getLocale() === 'ar' ? 'الكل' : 'All' }}
                </button>
                <button class="filter-btn px-4 py-2 bg-gray-200 text-gray-700 rounded-lg font-semibold hover:bg-gray-300 transition-colors" data-filter="investment">
                    {{ app()->getLocale() === 'ar' ? 'استثمار' : 'Investment' }}
                </button>
                <button class="filter-btn px-4 py-2 bg-gray-200 text-gray-700 rounded-lg font-semibold hover:bg-gray-300 transition-colors" data-filter="market">
                    {{ app()->getLocale() === 'ar' ? 'السوق' : 'Market' }}
                </button>
                <button class="filter-btn px-4 py-2 bg-gray-200 text-gray-700 rounded-lg font-semibold hover:bg-gray-300 transition-colors" data-filter="company">
                    {{ app()->getLocale() === 'ar' ? 'الشركة' : 'Company' }}
                </button>
            </div>
        </div>

        @if($articles->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8" id="news-grid">
                @foreach($articles as $article)
                <article class="news-item bg-white rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300 overflow-hidden border border-gray-100 group" data-category="{{ $article->category ?? 'general' }}">
                    <!-- Article Image -->
                    <div class="relative h-48 overflow-hidden">
                        @if($article->featured_image)
                            <img src="{{ asset('storage/' . $article->featured_image) }}"
                                 alt="{{ app()->getLocale() === 'ar' ? $article->title_ar : $article->title_en }}"
                                 class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                        @else
                            <div class="w-full h-full bg-gradient-to-br from-gray-200 to-gray-300 flex items-center justify-center">
                                <i class="fas fa-newspaper text-gray-400 text-3xl"></i>
                            </div>
                        @endif

                        <!-- Date Badge -->
                        <div class="absolute top-4 right-4 bg-white/90 backdrop-blur-sm rounded-lg px-3 py-1">
                            <span class="text-sm font-semibold text-gray-700">
                                {{ $article->created_at->format('M d') }}
                            </span>
                        </div>
                    </div>

                    <!-- Article Content -->
                    <div class="p-6">
                        <div class="flex items-center text-sm text-gray-500 mb-3">
                            <i class="fas fa-tag mr-2"></i>
                            <span>{{ ucfirst($article->category ?? 'General') }}</span>
                            <span class="mx-2">•</span>
                            <i class="fas fa-clock mr-2"></i>
                            <span>{{ app()->getLocale() === 'ar' ? '3 دقائق' : '3 min' }}</span>
                        </div>

                        <h3 class="text-xl font-bold text-gray-900 mb-3 line-clamp-2">
                            {{ app()->getLocale() === 'ar' ? $article->title_ar : $article->title_en }}
                        </h3>

                        <p class="text-gray-600 mb-4 line-clamp-3">
                            {{ app()->getLocale() === 'ar' ? Str::limit($article->excerpt_ar, 120) : Str::limit($article->excerpt_en, 120) }}
                        </p>

                        <a href="{{ route('news.show', $article->slug) }}"
                           class="inline-flex items-center text-green-600 font-semibold hover:text-green-700 transition-colors group">
                            {{ app()->getLocale() === 'ar' ? 'اقرأ المزيد' : 'Read More' }}
                            <i class="fas fa-arrow-right mr-2 group-hover:translate-x-1 transition-transform"></i>
                        </a>
                    </div>
                </article>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="mt-12">
                {{ $articles->links() }}
            </div>
        @else
            <!-- Empty State -->
            <div class="text-center py-16">
                <div class="w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-6">
                    <i class="fas fa-newspaper text-gray-400 text-3xl"></i>
                </div>
                <h3 class="text-2xl font-bold text-gray-900 mb-4">
                    {{ app()->getLocale() === 'ar' ? 'لا توجد أخبار حالياً' : 'No News Available' }}
                </h3>
                <p class="text-gray-600 max-w-md mx-auto">
                    {{ app()->getLocale() === 'ar'
                        ? 'سنقوم بنشر آخر الأخبار والتحديثات قريباً. ابق متابعاً معنا.'
                        : 'We will publish the latest news and updates soon. Stay tuned with us.'
                    }}
                </p>
            </div>
        @endif
    </div>
</section>

<!-- Newsletter Subscription -->
<section class="py-20 bg-gradient-to-r from-green-600 to-blue-600 text-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h2 class="text-4xl font-bold mb-6">
            {{ app()->getLocale() === 'ar' ? 'ابق على اطلاع دائم' : 'Stay Always Updated' }}
        </h2>
        <p class="text-xl mb-8 max-w-3xl mx-auto">
            {{ app()->getLocale() === 'ar'
                ? 'اشترك في نشرتنا الإخبارية لتصلك آخر الأخبار والتحديثات مباشرة إلى بريدك الإلكتروني'
                : 'Subscribe to our newsletter to receive the latest news and updates directly to your email'
            }}
        </p>
        <div class="max-w-md mx-auto">
            <form class="flex gap-4">
                <input type="email" placeholder="{{ app()->getLocale() === 'ar' ? 'بريدك الإلكتروني' : 'Your email address' }}"
                       class="flex-1 px-4 py-3 rounded-lg text-gray-900 focus:outline-none focus:ring-2 focus:ring-white">
                <button type="submit"
                        class="bg-white text-green-600 px-6 py-3 rounded-lg font-bold hover:bg-gray-100 transition-colors">
                    {{ app()->getLocale() === 'ar' ? 'اشتراك' : 'Subscribe' }}
                </button>
            </form>
        </div>
    </div>
</section>
@endsection

@push('scripts')
<script>
// News Filter Functionality
document.addEventListener('DOMContentLoaded', function() {
    const filterBtns = document.querySelectorAll('.filter-btn');
    const newsItems = document.querySelectorAll('.news-item');

    filterBtns.forEach(btn => {
        btn.addEventListener('click', function() {
            const filter = this.getAttribute('data-filter');

            // Update active button
            filterBtns.forEach(b => {
                b.classList.remove('active', 'bg-green-600', 'text-white');
                b.classList.add('bg-gray-200', 'text-gray-700');
            });
            this.classList.add('active', 'bg-green-600', 'text-white');
            this.classList.remove('bg-gray-200', 'text-gray-700');

            // Filter news items
            newsItems.forEach(item => {
                const category = item.getAttribute('data-category');
                if (filter === 'all' || category === filter) {
                    item.style.display = 'block';
                    item.classList.add('animate-fadeIn');
                } else {
                    item.style.display = 'none';
                }
            });
        });
    });
});
</script>
@endpush

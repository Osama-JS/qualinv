@extends('layouts.public')

@section('title', app()->getLocale() === 'ar' ? $article->title_ar : $article->title_en)
@section('description', app()->getLocale() === 'ar' ? $article->excerpt_ar : $article->excerpt_en)

@section('content')
@php
    $relatedArticles = \App\Models\Article::published()
        ->where('id', '!=', $article->id)
        ->where('category', $article->category)
        ->latest()
        ->take(3)
        ->get();
@endphp

<!-- Article Header -->
<section class="py-20 bg-white">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Breadcrumb -->
        <nav class="mb-8">
            <ol class="flex items-center space-x-2 text-sm text-gray-500">
                <li><a href="{{ route('home') }}" class="hover:text-green-600">{{ app()->getLocale() === 'ar' ? 'الرئيسية' : 'Home' }}</a></li>
                <li><i class="fas fa-chevron-right mx-2"></i></li>
                <li><a href="{{ route('news') }}" class="hover:text-green-600">{{ app()->getLocale() === 'ar' ? 'الأخبار' : 'News' }}</a></li>
                <li><i class="fas fa-chevron-right mx-2"></i></li>
                <li class="text-gray-900">{{ app()->getLocale() === 'ar' ? 'تفاصيل الخبر' : 'Article Details' }}</li>
            </ol>
        </nav>

        <!-- Article Meta -->
        <div class="flex items-center space-x-4 text-sm text-gray-500 mb-6">
            <div class="flex items-center">
                <i class="fas fa-calendar mr-2"></i>
                {{ $article->created_at->format('F d, Y') }}
            </div>
            <div class="flex items-center">
                <i class="fas fa-tag mr-2"></i>
                {{ ucfirst($article->category ?? 'General') }}
            </div>
            <div class="flex items-center">
                <i class="fas fa-clock mr-2"></i>
                {{ app()->getLocale() === 'ar' ? '5 دقائق قراءة' : '5 min read' }}
            </div>
        </div>

        <!-- Article Title -->
        <h1 class="text-4xl md:text-5xl font-bold text-gray-900 mb-6 leading-tight">
            {{ app()->getLocale() === 'ar' ? $article->title_ar : $article->title_en }}
        </h1>

        <!-- Article Excerpt -->
        <p class="text-xl text-gray-600 leading-relaxed mb-8">
            {{ app()->getLocale() === 'ar' ? $article->excerpt_ar : $article->excerpt_en }}
        </p>

        <!-- Featured Image -->
        @if($article->featured_image)
        <div class="mb-12">
            <img src="{{ asset('storage/' . $article->featured_image) }}"
                 alt="{{ app()->getLocale() === 'ar' ? $article->title_ar : $article->title_en }}"
                 class="w-full h-96 object-cover rounded-2xl shadow-lg">
        </div>
        @endif

        <!-- Article Content -->
        <div class="prose prose-lg max-w-none">
            @if(app()->getLocale() === 'ar' && $article->content_ar)
                {!! $article->content_ar !!}
            @elseif(app()->getLocale() === 'en' && $article->content_en)
                {!! $article->content_en !!}
            @else
                <p class="text-gray-600">
                    {{ app()->getLocale() === 'ar'
                        ? 'محتوى المقال غير متوفر بهذه اللغة.'
                        : 'Article content is not available in this language.'
                    }}
                </p>
            @endif
        </div>

        <!-- Share Buttons -->
        <div class="mt-12 pt-8 border-t border-gray-200">
            <h3 class="text-lg font-semibold text-gray-900 mb-4">
                {{ app()->getLocale() === 'ar' ? 'شارك هذا المقال' : 'Share this article' }}
            </h3>
            <div class="flex space-x-4">
                <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->url()) }}"
                   target="_blank"
                   class="flex items-center justify-center w-12 h-12 bg-blue-600 text-white rounded-full hover:bg-blue-700 transition-colors">
                    <i class="fab fa-facebook-f"></i>
                </a>
                <a href="https://twitter.com/intent/tweet?url={{ urlencode(request()->url()) }}&text={{ urlencode(app()->getLocale() === 'ar' ? $article->title_ar : $article->title_en) }}"
                   target="_blank"
                   class="flex items-center justify-center w-12 h-12 bg-blue-400 text-white rounded-full hover:bg-blue-500 transition-colors">
                    <i class="fab fa-twitter"></i>
                </a>
                <a href="https://www.linkedin.com/sharing/share-offsite/?url={{ urlencode(request()->url()) }}"
                   target="_blank"
                   class="flex items-center justify-center w-12 h-12 bg-blue-800 text-white rounded-full hover:bg-blue-900 transition-colors">
                    <i class="fab fa-linkedin-in"></i>
                </a>
                <a href="https://wa.me/?text={{ urlencode((app()->getLocale() === 'ar' ? $article->title_ar : $article->title_en) . ' ' . request()->url()) }}"
                   target="_blank"
                   class="flex items-center justify-center w-12 h-12 bg-green-600 text-white rounded-full hover:bg-green-700 transition-colors">
                    <i class="fab fa-whatsapp"></i>
                </a>
            </div>
        </div>
    </div>
</section>

<!-- Related Articles -->
@if($relatedArticles->count() > 0)
<section class="py-20 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h2 class="text-3xl font-bold text-gray-900 mb-12 text-center">
            {{ app()->getLocale() === 'ar' ? 'مقالات ذات صلة' : 'Related Articles' }}
        </h2>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            @foreach($relatedArticles as $relatedArticle)
            <article class="bg-white rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300 overflow-hidden border border-gray-100 group">
                <!-- Article Image -->
                <div class="relative h-48 overflow-hidden">
                    @if($relatedArticle->featured_image)
                        <img src="{{ asset('storage/' . $relatedArticle->featured_image) }}"
                             alt="{{ app()->getLocale() === 'ar' ? $relatedArticle->title_ar : $relatedArticle->title_en }}"
                             class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                    @else
                        <div class="w-full h-full bg-gradient-to-br from-gray-200 to-gray-300 flex items-center justify-center">
                            <i class="fas fa-newspaper text-gray-400 text-3xl"></i>
                        </div>
                    @endif

                    <!-- Date Badge -->
                    <div class="absolute top-4 right-4 bg-white/90 backdrop-blur-sm rounded-lg px-3 py-1">
                        <span class="text-sm font-semibold text-gray-700">
                            {{ $relatedArticle->created_at->format('M d') }}
                        </span>
                    </div>
                </div>

                <!-- Article Content -->
                <div class="p-6">
                    <div class="flex items-center text-sm text-gray-500 mb-3">
                        <i class="fas fa-tag mr-2"></i>
                        <span>{{ ucfirst($relatedArticle->category ?? 'General') }}</span>
                    </div>

                    <h3 class="text-lg font-bold text-gray-900 mb-3 line-clamp-2">
                        {{ app()->getLocale() === 'ar' ? $relatedArticle->title_ar : $relatedArticle->title_en }}
                    </h3>

                    <p class="text-gray-600 mb-4 line-clamp-3">
                        {{ app()->getLocale() === 'ar' ? Str::limit($relatedArticle->excerpt_ar, 100) : Str::limit($relatedArticle->excerpt_en, 100) }}
                    </p>

                    <a href="{{ route('news.show', $relatedArticle->slug) }}"
                       class="inline-flex items-center text-green-600 font-semibold hover:text-green-700 transition-colors group">
                        {{ app()->getLocale() === 'ar' ? 'اقرأ المزيد' : 'Read More' }}
                        <i class="fas fa-arrow-right mr-2 group-hover:translate-x-1 transition-transform"></i>
                    </a>
                </div>
            </article>
            @endforeach
        </div>
    </div>
</section>
@endif

<!-- Call to Action -->
<section class="py-20 bg-gradient-to-r from-green-600 to-blue-600 text-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h2 class="text-4xl font-bold mb-6">
            {{ app()->getLocale() === 'ar' ? 'هل أنت مستعد للاستثمار؟' : 'Ready to Start Investing?' }}
        </h2>
        <p class="text-xl mb-8 max-w-3xl mx-auto">
            {{ app()->getLocale() === 'ar'
                ? 'ابدأ رحلتك الاستثمارية معنا اليوم واستفد من خبرتنا في الأسواق المالية'
                : 'Start your investment journey with us today and benefit from our expertise in financial markets'
            }}
        </p>
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <a href="{{ route('investment-application.create') }}"
               class="bg-white text-green-600 px-8 py-4 rounded-xl font-bold hover:bg-gray-100 transition-colors transform hover:scale-105 shadow-lg">
                <i class="fas fa-chart-line mr-2"></i>
                {{ app()->getLocale() === 'ar' ? 'ابدأ الاستثمار الآن' : 'Start Investing Now' }}
            </a>
            <a href="{{ route('contact') }}"
               class="border-2 border-white text-white px-8 py-4 rounded-xl font-bold hover:bg-white hover:text-green-600 transition-colors transform hover:scale-105">
                <i class="fas fa-phone mr-2"></i>
                {{ app()->getLocale() === 'ar' ? 'تواصل معنا' : 'Contact Us' }}
            </a>
        </div>
    </div>
</section>
@endsection

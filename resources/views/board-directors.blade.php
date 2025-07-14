@extends('layouts.public')

@section('title', app()->getLocale() === 'ar' ? 'مجلس الإدارة' : 'Board of Directors')
@section('description', app()->getLocale() === 'ar' ? 'تعرف على أعضاء مجلس إدارة شركتنا وخبراتهم المتميزة في مجال الاستثمار' : 'Meet our board of directors and their distinguished expertise in investment')

@section('content')
<!-- Page Header -->
<section class="relative bg-gradient-to-br from-gray-900 via-gray-800 to-green-900 py-24 overflow-hidden">
    <!-- Background Pattern -->
    <div class="absolute inset-0 opacity-10">
        <div class="absolute inset-0" style="background-image: url('data:image/svg+xml,<svg width="60" height="60" viewBox="0 0 60 60" xmlns="http://www.w3.org/2000/svg"><g fill="none" fill-rule="evenodd"><g fill="%23ffffff" fill-opacity="0.1"><circle cx="30" cy="30" r="2"/></g></svg>');"></div>
    </div>
    
    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h1 class="text-4xl md:text-6xl font-bold text-white mb-6">
            {{ app()->getLocale() === 'ar' ? 'مجلس الإدارة' : 'Board of Directors' }}
        </h1>
        <p class="text-xl text-gray-300 max-w-3xl mx-auto leading-relaxed">
            {{ app()->getLocale() === 'ar' 
                ? 'يضم مجلس إدارتنا نخبة من الخبراء والمتخصصين في مجال الاستثمار والأعمال، الذين يقودون الشركة نحو تحقيق أهدافها الاستراتيجية'
                : 'Our board of directors comprises elite experts and specialists in investment and business, who lead the company towards achieving its strategic goals' }}
        </p>
    </div>
</section>

<!-- Board Members -->
<section class="py-20 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        @if($boardDirectors->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($boardDirectors as $director)
                <div class="group bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-500 overflow-hidden border border-gray-100 hover:border-green-200 transform hover:-translate-y-2">
                    <!-- Director Image -->
                    <div class="relative h-80 overflow-hidden">
                        @if($director->image)
                            <img src="{{ asset('storage/' . $director->image) }}" 
                                 alt="{{ app()->getLocale() === 'ar' ? $director->name_ar : $director->name_en }}"
                                 class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                        @else
                            <div class="w-full h-full bg-gradient-to-br from-gray-200 to-gray-300 flex items-center justify-center">
                                <i class="fas fa-user text-gray-400 text-6xl"></i>
                            </div>
                        @endif
                        
                        <!-- Overlay with Social Links -->
                        <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                            <div class="absolute bottom-4 left-4 right-4">
                                <div class="flex justify-center space-x-3 {{ app()->getLocale() === 'ar' ? 'space-x-reverse' : '' }}">
                                    @if($director->linkedin_url)
                                        <a href="{{ $director->linkedin_url }}" target="_blank" 
                                           class="w-10 h-10 bg-white/20 backdrop-blur-sm rounded-full flex items-center justify-center text-white hover:bg-blue-600 transition-colors duration-200">
                                            <i class="fab fa-linkedin-in"></i>
                                        </a>
                                    @endif
                                    @if($director->twitter_url)
                                        <a href="{{ $director->twitter_url }}" target="_blank" 
                                           class="w-10 h-10 bg-white/20 backdrop-blur-sm rounded-full flex items-center justify-center text-white hover:bg-blue-400 transition-colors duration-200">
                                            <i class="fab fa-twitter"></i>
                                        </a>
                                    @endif
                                    @if($director->email)
                                        <a href="mailto:{{ $director->email }}" 
                                           class="w-10 h-10 bg-white/20 backdrop-blur-sm rounded-full flex items-center justify-center text-white hover:bg-green-600 transition-colors duration-200">
                                            <i class="fas fa-envelope"></i>
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Director Info -->
                    <div class="p-6">
                        <h3 class="text-xl font-bold text-gray-900 mb-2">
                            {{ app()->getLocale() === 'ar' ? $director->name_ar : $director->name_en }}
                        </h3>
                        
                        <p class="text-green-600 font-semibold mb-4">
                            {{ app()->getLocale() === 'ar' ? $director->position_ar : $director->position_en }}
                        </p>
                        
                        @if(app()->getLocale() === 'ar' ? $director->bio_ar : $director->bio_en)
                            <p class="text-gray-600 leading-relaxed line-clamp-4">
                                {{ app()->getLocale() === 'ar' ? $director->bio_ar : $director->bio_en }}
                            </p>
                        @endif

                        <!-- Contact Info -->
                        <div class="mt-4 pt-4 border-t border-gray-100">
                            <div class="flex items-center justify-between text-sm text-gray-500">
                                @if($director->phone)
                                    <div class="flex items-center">
                                        <i class="fas fa-phone {{ app()->getLocale() === 'ar' ? 'ml-2' : 'mr-2' }} text-green-600"></i>
                                        <span>{{ $director->phone }}</span>
                                    </div>
                                @endif
                                
                                @if($director->email)
                                    <div class="flex items-center">
                                        <i class="fas fa-envelope {{ app()->getLocale() === 'ar' ? 'ml-2' : 'mr-2' }} text-green-600"></i>
                                        <span class="truncate">{{ $director->email }}</span>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        @else
            <!-- No Directors Message -->
            <div class="text-center py-16">
                <div class="w-24 h-24 bg-gray-200 rounded-full flex items-center justify-center mx-auto mb-6">
                    <i class="fas fa-users text-gray-400 text-3xl"></i>
                </div>
                <h3 class="text-2xl font-bold text-gray-900 mb-4">
                    {{ app()->getLocale() === 'ar' ? 'لا توجد معلومات متاحة' : 'No Information Available' }}
                </h3>
                <p class="text-gray-600 max-w-md mx-auto">
                    {{ app()->getLocale() === 'ar' 
                        ? 'معلومات أعضاء مجلس الإدارة ستكون متاحة قريباً'
                        : 'Board of directors information will be available soon' }}
                </p>
            </div>
        @endif
    </div>
</section>

<!-- Call to Action -->
<section class="py-20 bg-gradient-to-r from-green-600 to-blue-600">
    <div class="max-w-4xl mx-auto text-center px-4 sm:px-6 lg:px-8">
        <h2 class="text-3xl md:text-4xl font-bold text-white mb-6">
            {{ app()->getLocale() === 'ar' ? 'انضم إلى رحلة الاستثمار معنا' : 'Join Our Investment Journey' }}
        </h2>
        <p class="text-xl text-white/90 mb-8 leading-relaxed">
            {{ app()->getLocale() === 'ar' 
                ? 'استفد من خبرة مجلس إدارتنا المتميز وابدأ رحلتك الاستثمارية معنا اليوم'
                : 'Benefit from our distinguished board\'s expertise and start your investment journey with us today' }}
        </p>
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <a href="{{ route('investment-application.create') }}"
               class="bg-white text-green-600 px-8 py-4 rounded-xl font-bold hover:bg-gray-100 transition-colors transform hover:scale-105 shadow-lg">
                <i class="fas fa-chart-line {{ app()->getLocale() === 'ar' ? 'ml-2' : 'mr-2' }}"></i>
                {{ app()->getLocale() === 'ar' ? 'ابدأ الاستثمار الآن' : 'Start Investing Now' }}
            </a>
            <a href="{{ route('contact') }}"
               class="border-2 border-white text-white px-8 py-4 rounded-xl font-bold hover:bg-white hover:text-green-600 transition-colors transform hover:scale-105">
                <i class="fas fa-phone {{ app()->getLocale() === 'ar' ? 'ml-2' : 'mr-2' }}"></i>
                {{ app()->getLocale() === 'ar' ? 'تواصل معنا' : 'Contact Us' }}
            </a>
        </div>
    </div>
</section>
@endsection

@push('styles')
<style>
.line-clamp-4 {
    display: -webkit-box;
    -webkit-line-clamp: 4;
    -webkit-box-orient: vertical;
    overflow: hidden;
}
</style>
@endpush

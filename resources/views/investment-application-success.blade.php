@extends('layouts.public')

@section('title', app()->getLocale() === 'ar' ? 'تم إرسال الطلب بنجاح' : 'Application Submitted Successfully')
@section('description', app()->getLocale() === 'ar' ? 'تم إرسال طلب الاستثمار بنجاح' : 'Investment application submitted successfully')

@section('content')
<!-- Success Page -->
<section class="py-20 bg-gray-50 min-h-screen flex items-center">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <div class="bg-white rounded-2xl shadow-xl p-12">
            <!-- Success Icon -->
            <div class="w-24 h-24 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-8">
                <i class="fas fa-check text-green-600 text-4xl"></i>
            </div>

            <!-- Success Message -->
            <h1 class="text-4xl font-bold text-gray-900 mb-6">
                {{ app()->getLocale() === 'ar' ? 'تم إرسال طلبك بنجاح!' : 'Application Submitted Successfully!' }}
            </h1>

            <p class="text-xl text-gray-600 mb-8 max-w-2xl mx-auto">
                {{ app()->getLocale() === 'ar' 
                    ? 'شكراً لك على تقديم طلب الاستثمار. سيقوم فريقنا بمراجعة طلبك والتواصل معك خلال 3-5 أيام عمل.'
                    : 'Thank you for submitting your investment application. Our team will review your application and contact you within 3-5 business days.'
                }}
            </p>

            <!-- What's Next -->
            <div class="bg-blue-50 rounded-xl p-8 mb-8">
                <h2 class="text-2xl font-bold text-gray-900 mb-6">
                    {{ app()->getLocale() === 'ar' ? 'ما الخطوات التالية؟' : 'What\'s Next?' }}
                </h2>
                
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div class="text-center">
                        <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-4">
                            <i class="fas fa-search text-blue-600 text-2xl"></i>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-900 mb-2">
                            {{ app()->getLocale() === 'ar' ? 'مراجعة الطلب' : 'Application Review' }}
                        </h3>
                        <p class="text-gray-600">
                            {{ app()->getLocale() === 'ar' 
                                ? 'سيقوم فريقنا بمراجعة طلبك وتقييم ملفك الاستثماري'
                                : 'Our team will review your application and assess your investment profile'
                            }}
                        </p>
                    </div>

                    <div class="text-center">
                        <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4">
                            <i class="fas fa-phone text-green-600 text-2xl"></i>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-900 mb-2">
                            {{ app()->getLocale() === 'ar' ? 'التواصل معك' : 'Contact You' }}
                        </h3>
                        <p class="text-gray-600">
                            {{ app()->getLocale() === 'ar' 
                                ? 'سنتواصل معك لمناقشة تفاصيل الاستثمار والخيارات المتاحة'
                                : 'We will contact you to discuss investment details and available options'
                            }}
                        </p>
                    </div>

                    <div class="text-center">
                        <div class="w-16 h-16 bg-purple-100 rounded-full flex items-center justify-center mx-auto mb-4">
                            <i class="fas fa-handshake text-purple-600 text-2xl"></i>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-900 mb-2">
                            {{ app()->getLocale() === 'ar' ? 'بدء الاستثمار' : 'Start Investing' }}
                        </h3>
                        <p class="text-gray-600">
                            {{ app()->getLocale() === 'ar' 
                                ? 'بعد الموافقة، سنبدأ رحلتك الاستثمارية معنا'
                                : 'After approval, we will start your investment journey with us'
                            }}
                        </p>
                    </div>
                </div>
            </div>

            <!-- Contact Information -->
            <div class="bg-gray-50 rounded-xl p-8 mb-8">
                <h2 class="text-xl font-bold text-gray-900 mb-4">
                    {{ app()->getLocale() === 'ar' ? 'هل لديك أسئلة؟' : 'Have Questions?' }}
                </h2>
                <p class="text-gray-600 mb-6">
                    {{ app()->getLocale() === 'ar' 
                        ? 'لا تتردد في التواصل معنا إذا كان لديك أي استفسارات'
                        : 'Feel free to contact us if you have any questions'
                    }}
                </p>
                
                @php
                    $company = \App\Models\Company::first();
                @endphp
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="flex items-center justify-center space-x-3">
                        <i class="fas fa-phone text-green-600"></i>
                        <span class="text-gray-700">{{ $company->phone ?? '+966 11 123 4567' }}</span>
                    </div>
                    <div class="flex items-center justify-center space-x-3">
                        <i class="fas fa-envelope text-green-600"></i>
                        <span class="text-gray-700">{{ $company->email ?? 'info@qualityinvestment.com' }}</span>
                    </div>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="{{ route('home') }}" 
                   class="bg-green-600 text-white px-8 py-3 rounded-lg font-semibold hover:bg-green-700 transition-colors">
                    <i class="fas fa-home mr-2"></i>
                    {{ app()->getLocale() === 'ar' ? 'العودة للرئيسية' : 'Back to Home' }}
                </a>
                
                <a href="{{ route('contact') }}" 
                   class="border border-green-600 text-green-600 px-8 py-3 rounded-lg font-semibold hover:bg-green-50 transition-colors">
                    <i class="fas fa-envelope mr-2"></i>
                    {{ app()->getLocale() === 'ar' ? 'تواصل معنا' : 'Contact Us' }}
                </a>
            </div>
        </div>
    </div>
</section>
@endsection

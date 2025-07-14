@extends('layouts.public')

@section('title', app()->getLocale() === 'ar' ? 'طلب استثمار' : 'Investment Application')
@section('description', app()->getLocale() === 'ar' ? 'قدم طلب استثمار مع شركة الجودة للاستثمار' : 'Submit an investment application with Quality Investment Company')

@push('styles')
<style>
    .animate-fadeIn {
        animation: fadeIn 0.5s ease-in-out;
    }

    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }

    .step-indicator {
        transition: all 0.3s ease;
    }

    .step-indicator.active {
        background: linear-gradient(135deg, #10b981, #3b82f6);
        color: white;
        transform: scale(1.1);
    }

    .form-section {
        transition: all 0.3s ease;
        transform: translateY(0);
    }

    .form-section.hidden {
        opacity: 0;
        transform: translateY(20px);
        pointer-events: none;
    }

    .investment-calculator {
        background: linear-gradient(135deg, rgba(255,255,255,0.1), rgba(255,255,255,0.05));
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255,255,255,0.2);
    }

    .progress-step {
        transition: all 0.3s ease;
    }

    .progress-step.completed .step-number {
        background: #10b981 !important;
        color: white;
    }

    /* Sidebar Styles */
    .sidebar-sticky {
        position: sticky;
        top: 2rem;
        overflow-y: auto;
    }

    /* Custom scrollbar for sidebar */
    .sidebar-sticky::-webkit-scrollbar {
        width: 4px;
    }

    .sidebar-sticky::-webkit-scrollbar-track {
        background: #f1f5f9;
        border-radius: 2px;
    }

    .sidebar-sticky::-webkit-scrollbar-thumb {
        background: #cbd5e1;
        border-radius: 2px;
    }

    .sidebar-sticky::-webkit-scrollbar-thumb:hover {
        background: #94a3b8;
    }

    /* Form sections spacing */
    .form-section {
        margin-bottom: 1.5rem;
    }

    /* Responsive adjustments */
    @media (max-width: 1024px) {
        .sidebar-sticky {
            position: static;
            max-height: none;
            margin-bottom: 2rem;
        }

        /* Mobile layout adjustments */
        .investment-grid {
            grid-template-columns: 1fr !important;
            gap: 1.5rem !important;
        }

        /* Sidebar order on mobile */
        .sidebar-mobile-order {
            order: 1;
        }

        .form-mobile-order {
            order: 2;
        }

        /* Reduce sidebar card spacing on mobile */
        .sidebar-sticky .space-y-6 {
            gap: 1rem;
        }

        /* Adjust sidebar card padding */
        .sidebar-sticky .p-6 {
            padding: 1rem;
        }

        /* Make sidebar cards more compact */
        .sidebar-sticky .text-xl {
            font-size: 1.125rem;
        }

        .sidebar-sticky .text-lg {
            font-size: 1rem;
        }
    }

    @media (max-width: 640px) {
        /* Extra small screens */
        .sidebar-sticky .p-6 {
            padding: 0.75rem;
        }

        .sidebar-sticky .mb-6 {
            margin-bottom: 1rem;
        }

        .sidebar-sticky .space-y-3 > * + * {
            margin-top: 0.5rem;
        }
    }

    /* Page Header Responsive Fixes */
    .investment-page-header {
        padding-top: 8rem;
        padding-bottom: 6rem;
        min-height: 50vh;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    @media (max-width: 1024px) {
        .investment-page-header {
            padding-top: 6rem;
            padding-bottom: 4rem;
            min-height: 45vh;
        }

        .investment-page-header h1 {
            font-size: 3rem !important;
            line-height: 1.1;
        }

        .investment-page-header p {
            font-size: 1.25rem !important;
            line-height: 1.4;
        }
    }

    @media (max-width: 768px) {
        .investment-page-header {
            padding-top: 5rem;
            padding-bottom: 3rem;
            min-height: 40vh;
        }

        .investment-page-header h1 {
            font-size: 2.5rem !important;
            line-height: 1.2;
            margin-bottom: 1rem !important;
        }

        .investment-page-header p {
            font-size: 1.125rem !important;
            line-height: 1.5;
            margin-bottom: 1.5rem !important;
        }

        .investment-page-header .progress-steps {
            flex-wrap: wrap;
            gap: 0.5rem;
            justify-content: center;
        }

        .investment-page-header .progress-steps .w-8 {
            display: none;
        }

        .investment-page-header .progress-steps .flex.items-center {
            padding: 0.5rem 1rem;
            font-size: 0.875rem;
        }
    }

    @media (max-width: 640px) {
        .investment-page-header {
            padding-top: 4rem;
            padding-bottom: 2rem;
            min-height: 35vh;
        }

        .investment-page-header h1 {
            font-size: 2rem !important;
            margin-bottom: 0.75rem !important;
        }

        .investment-page-header p {
            font-size: 1rem !important;
            margin-bottom: 1rem !important;
        }

        .investment-page-header .progress-steps {
            flex-direction: column;
            gap: 0.25rem;
            align-items: center;
        }

        .investment-page-header .progress-steps .flex.items-center {
            padding: 0.375rem 0.75rem;
            font-size: 0.75rem;
            min-width: auto;
        }

        .investment-page-header .progress-steps span {
            font-size: 0.75rem;
        }

        .investment-page-header .w-20.h-20 {
            width: 4rem !important;
            height: 4rem !important;
        }

        .investment-page-header .w-20.h-20 i {
            font-size: 1.5rem !important;
        }
    }

    @media (max-width: 480px) {
        .investment-page-header {
            padding-top: 3rem;
            padding-bottom: 1.5rem;
            min-height: 30vh;
        }

        .investment-page-header h1 {
            font-size: 1.75rem !important;
        }

        .investment-page-header p {
            font-size: 0.875rem !important;
        }

        .investment-page-header .w-20.h-20 {
            width: 3rem !important;
            height: 3rem !important;
        }

        .investment-page-header .w-20.h-20 i {
            font-size: 1.25rem !important;
        }
    }

    /* RTL Fixes for Investment Application */
    [dir="rtl"] {
        text-align: right;
    }

    /* RTL Grid Layout */
    [dir="rtl"] .investment-grid {
        direction: rtl;
    }

    [dir="rtl"] .sidebar-mobile-order {
        order: 2;
        direction: rtl;
    }

    [dir="rtl"] .form-mobile-order {
        order: 1;
        direction: rtl;
    }

    /* RTL Flex Containers */
    [dir="rtl"] .flex.items-center.space-x-2,
    [dir="rtl"] .flex.items-center.space-x-3,
    [dir="rtl"] .flex.items-center.space-x-4,
    [dir="rtl"] .flex.items-center.space-x-6 {
        flex-direction: row-reverse;
        gap: 0.5rem;
    }

    [dir="rtl"] .flex.items-center.space-x-3 {
        gap: 0.75rem;
    }

    [dir="rtl"] .flex.items-center.space-x-4 {
        gap: 1rem;
    }

    [dir="rtl"] .flex.items-center.space-x-6 {
        gap: 1.5rem;
    }

    /* Reset space-x margins in RTL */
    [dir="rtl"] .space-x-2 > * + *,
    [dir="rtl"] .space-x-3 > * + *,
    [dir="rtl"] .space-x-4 > * + *,
    [dir="rtl"] .space-x-6 > * + * {
        margin-left: 0;
        margin-right: 0;
    }

    /* RTL Progress Steps */
    [dir="rtl"] .progress-steps {
        flex-direction: row-reverse;
        gap: 1rem;
    }

    [dir="rtl"] .progress-steps .space-x-4 > * + * {
        margin-left: 0;
        margin-right: 0;
    }

    /* RTL Sidebar */
    [dir="rtl"] .sidebar-sticky {
        text-align: right;
    }

    [dir="rtl"] .sidebar-sticky .flex.items-center {
        flex-direction: row-reverse;
        gap: 0.75rem;
    }

    [dir="rtl"] .sidebar-sticky .mr-2,
    [dir="rtl"] .sidebar-sticky .mr-3,
    [dir="rtl"] .sidebar-sticky .ml-2,
    [dir="rtl"] .sidebar-sticky .ml-3 {
        margin-right: 0;
        margin-left: 0;
    }

    /* RTL Form Elements */
    [dir="rtl"] .form-section {
        text-align: right;
    }

    [dir="rtl"] .form-section .flex.items-center {
        flex-direction: row-reverse;
        gap: 0.5rem;
    }

    [dir="rtl"] .form-section .flex.items-start {
        flex-direction: row-reverse;
        gap: 0.75rem;
    }

    [dir="rtl"] .form-section .space-x-2 > * + *,
    [dir="rtl"] .form-section .space-x-4 > * + * {
        margin-left: 0;
        margin-right: 0;
    }

    /* RTL Icons and Text */
    [dir="rtl"] .fas,
    [dir="rtl"] .far,
    [dir="rtl"] .fab {
        margin-left: 0.5rem;
        margin-right: 0;
    }

    [dir="rtl"] .flex.items-center .fas + span,
    [dir="rtl"] .flex.items-center .far + span,
    [dir="rtl"] .flex.items-center .fab + span {
        margin-right: 0.5rem;
        margin-left: 0;
    }

    /* RTL Calculator */
    [dir="rtl"] .sidebar-sticky .flex.items-center.space-x-2 {
        justify-content: flex-end;
        gap: 0.5rem;
    }

    /* RTL Instructions */
    [dir="rtl"] .sidebar-sticky .flex.items-start.space-x-2 {
        flex-direction: row-reverse;
        gap: 0.5rem;
    }

    /* RTL Contact Support */
    [dir="rtl"] .sidebar-sticky .inline-flex.items-center {
        flex-direction: row-reverse;
        gap: 0.5rem;
    }

    /* RTL Form Grid */
    [dir="rtl"] .grid.grid-cols-1.md\\:grid-cols-2 {
        direction: rtl;
    }

    /* RTL Buttons */
    [dir="rtl"] .inline-flex.items-center {
        flex-direction: row-reverse;
        gap: 0.5rem;
    }

    [dir="rtl"] .inline-flex.items-center .fas,
    [dir="rtl"] .inline-flex.items-center .far {
        margin-left: 0;
        margin-right: 0;
    }

    /* RTL Text Alignment */
    [dir="rtl"] .text-center {
        text-align: center;
    }

    [dir="rtl"] .text-left {
        text-align: right;
    }

    [dir="rtl"] .text-right {
        text-align: left;
    }

    /* RTL Specific Margins */
    [dir="rtl"] .mr-2 { margin-right: 0; margin-left: 0.5rem; }
    [dir="rtl"] .mr-3 { margin-right: 0; margin-left: 0.75rem; }
    [dir="rtl"] .mr-4 { margin-right: 0; margin-left: 1rem; }
    [dir="rtl"] .ml-2 { margin-left: 0; margin-right: 0.5rem; }
    [dir="rtl"] .ml-3 { margin-left: 0; margin-right: 0.75rem; }
    [dir="rtl"] .ml-4 { margin-left: 0; margin-right: 1rem; }

    /* RTL Padding */
    [dir="rtl"] .pr-2 { padding-right: 0; padding-left: 0.5rem; }
    [dir="rtl"] .pr-3 { padding-right: 0; padding-left: 0.75rem; }
    [dir="rtl"] .pr-4 { padding-right: 0; padding-left: 1rem; }
    [dir="rtl"] .pl-2 { padding-left: 0; padding-right: 0.5rem; }
    [dir="rtl"] .pl-3 { padding-left: 0; padding-right: 0.75rem; }
    [dir="rtl"] .pl-4 { padding-left: 0; padding-right: 1rem; }

    /* RTL Form Labels and Inputs */
    [dir="rtl"] .form-section label {
        text-align: right;
    }

    [dir="rtl"] .form-section input,
    [dir="rtl"] .form-section select,
    [dir="rtl"] .form-section textarea {
        text-align: right;
        direction: rtl;
    }

    [dir="rtl"] .form-section input[type="email"],
    [dir="rtl"] .form-section input[type="tel"] {
        direction: ltr;
        text-align: left;
    }

    /* RTL Grid Columns */
    [dir="rtl"] .grid.grid-cols-1.md\\:grid-cols-2 > div:first-child {
        order: 2;
    }

    [dir="rtl"] .grid.grid-cols-1.md\\:grid-cols-2 > div:last-child {
        order: 1;
    }

    /* RTL Error Messages */
    [dir="rtl"] .error-message {
        text-align: right;
    }

    /* RTL Investment Grid Mobile */
    @media (max-width: 1024px) {
        [dir="rtl"] .investment-grid {
            direction: rtl;
        }

        [dir="rtl"] .sidebar-mobile-order {
            order: 2;
        }

        [dir="rtl"] .form-mobile-order {
            order: 1;
        }
    }
</style>
@endpush

@section('content')
<!-- Page Header -->
<section class="investment-page-header bg-gradient-to-r from-green-800 via-gray-900 to-green-700 text-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <div class="mb-8">
            <div class="inline-flex items-center justify-center w-20 h-20 bg-white/20 backdrop-blur-sm rounded-full mb-6">
                <i class="fas fa-chart-line text-3xl text-white"></i>
            </div>
            <h1 class="text-4xl md:text-6xl font-bold mb-6">
                {{ app()->getLocale() === 'ar' ? 'طلب استثمار' : 'Investment Application' }}
            </h1>
            <p class="text-xl md:text-2xl text-gray-200 max-w-4xl mx-auto mb-8">
                {{ app()->getLocale() === 'ar'
                    ? 'ابدأ رحلتك الاستثمارية معنا من خلال تعبئة النموذج أدناه بعناية'
                    : 'Start your investment journey with us by carefully filling out the form below'
                }}
            </p>

            <!-- Progress Steps -->
            <div class="progress-steps flex justify-center items-center space-x-4 mt-8">
                <div class="flex items-center space-x-2 bg-white/10 backdrop-blur-sm rounded-full px-4 py-2">
                    <div class="w-8 h-8 bg-green-500 rounded-full flex items-center justify-center text-white font-bold text-sm">1</div>
                    <span class="text-sm font-medium">{{ app()->getLocale() === 'ar' ? 'معلومات السهم' : 'Share Info' }}</span>
                </div>
                <div class="w-8 h-0.5 bg-white/30"></div>
                <div class="flex items-center space-x-2 bg-white/10 backdrop-blur-sm rounded-full px-4 py-2">
                    <div class="w-8 h-8 bg-white/30 rounded-full flex items-center justify-center text-white font-bold text-sm">2</div>
                    <span class="text-sm font-medium">{{ app()->getLocale() === 'ar' ? 'نوع المتقدم' : 'Applicant Type' }}</span>
                </div>
                <div class="w-8 h-0.5 bg-white/30"></div>
                <div class="flex items-center space-x-2 bg-white/10 backdrop-blur-sm rounded-full px-4 py-2">
                    <div class="w-8 h-8 bg-white/30 rounded-full flex items-center justify-center text-white font-bold text-sm">3</div>
                    <span class="text-sm font-medium">{{ app()->getLocale() === 'ar' ? 'البيانات' : 'Information' }}</span>
                </div>
                <div class="w-8 h-0.5 bg-white/30"></div>
                <div class="flex items-center space-x-2 bg-white/10 backdrop-blur-sm rounded-full px-4 py-2">
                    <div class="w-8 h-8 bg-white/30 rounded-full flex items-center justify-center text-white font-bold text-sm">4</div>
                    <span class="text-sm font-medium">{{ app()->getLocale() === 'ar' ? 'الإرسال' : 'Submit' }}</span>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Application Form -->
<section class="py-20 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="investment-grid grid grid-cols-1 lg:grid-cols-3 gap-8">

            <!-- Left Sidebar - Instructions & Share Info -->
            <div class="lg:col-span-1 sidebar-mobile-order">
                <div class="sidebar-sticky space-y-6">

                <!-- Share Price Information -->
                <div class="bg-white rounded-xl shadow-lg p-6 border border-gray-100 hover:shadow-xl transition-shadow duration-300">
                    <div class="text-center mb-6">
                        <div class="inline-flex items-center justify-center w-16 h-16 bg-gradient-to-br from-green-100 to-blue-100 rounded-full mb-4">
                            <i class="fas fa-chart-line text-2xl text-green-600"></i>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-2">
                            {{ app()->getLocale() === 'ar' ? 'معلومات السهم' : 'Share Information' }}
                        </h3>
                    </div>

                    <!-- Current Price Card -->
                    <div class="bg-gradient-to-br from-green-50 to-blue-50 rounded-lg p-4 mb-4">
                        <div class="text-center">
                            <div class="text-sm text-gray-600 mb-1">
                                {{ app()->getLocale() === 'ar' ? 'سعر السهم الحالي' : 'Current Share Price' }}
                            </div>
                            <div class="text-3xl font-bold text-green-600">
                                @php
                                    $sharePrice = \App\Models\SiteSetting::get('share_price', '125.50');
                                    $currency = \App\Models\SiteSetting::get('currency', 'SAR');
                                @endphp
                                {{ $sharePrice }} {{ $currency }}
                            </div>
                        </div>
                    </div>

                    <!-- Investment Details -->
                    <div class="space-y-3 mb-6">
                        <div class="flex justify-between items-center p-3 bg-gray-50 rounded-lg">
                            <span class="text-sm text-gray-600">{{ app()->getLocale() === 'ar' ? 'الحد الأدنى' : 'Minimum' }}</span>
                            <span class="font-semibold text-gray-900">1 {{ app()->getLocale() === 'ar' ? 'سهم' : 'Share' }}</span>
                        </div>
                        <div class="flex justify-between items-center p-3 bg-gray-50 rounded-lg">
                            <span class="text-sm text-gray-600">{{ app()->getLocale() === 'ar' ? 'العائد المتوقع' : 'Expected Return' }}</span>
                            <span class="font-semibold text-green-600">12-15%</span>
                        </div>
                    </div>

                    <!-- Investment Calculator -->
                    <div class="border-t pt-4">
                        <h4 class="text-sm font-semibold text-gray-900 mb-3">
                            {{ app()->getLocale() === 'ar' ? 'حاسبة الاستثمار' : 'Investment Calculator' }}
                        </h4>
                        <div class="space-y-3">
                            <div class="flex items-center {{ app()->getLocale() === 'ar' ? 'flex-row-reverse gap-2' : 'space-x-2' }}">
                                <input type="number" id="calc-shares" min="1" value="1"
                                       class="flex-1 px-3 py-2 border border-gray-300 rounded-lg text-center focus:ring-2 focus:ring-green-500 focus:border-transparent"
                                       placeholder="1">
                                <span class="text-gray-500">×</span>
                                <span class="text-sm font-medium text-gray-700">{{ $sharePrice }}</span>
                            </div>
                            <div class="text-center p-3 bg-green-50 rounded-lg">
                                <div class="text-sm text-green-700 mb-1">{{ app()->getLocale() === 'ar' ? 'إجمالي الاستثمار' : 'Total Investment' }}</div>
                                <div id="calc-total" class="text-xl font-bold text-green-600">{{ $sharePrice }} {{ $currency }}</div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Instructions Card -->
                <div class="bg-white rounded-xl shadow-lg p-6">
                    <div class="flex items-center mb-4 {{ app()->getLocale() === 'ar' ? 'flex-row-reverse' : '' }}">
                        <div class="w-10 h-10 bg-blue-100 rounded-full flex items-center justify-center {{ app()->getLocale() === 'ar' ? 'ml-3' : 'mr-3' }}">
                            <i class="fas fa-info-circle text-blue-600"></i>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-900">
                            {{ app()->getLocale() === 'ar' ? 'تعليمات مهمة' : 'Important Instructions' }}
                        </h3>
                    </div>
                    <ul class="space-y-3 text-sm text-gray-700">
                        <li class="flex items-start {{ app()->getLocale() === 'ar' ? 'flex-row-reverse gap-2' : 'space-x-2' }}">
                            <i class="fas fa-check-circle text-green-500 mt-0.5 flex-shrink-0"></i>
                            <span>{{ app()->getLocale() === 'ar' ? 'تأكد من صحة جميع البيانات المدخلة' : 'Ensure all entered data is accurate' }}</span>
                        </li>
                        <li class="flex items-start {{ app()->getLocale() === 'ar' ? 'flex-row-reverse gap-2' : 'space-x-2' }}">
                            <i class="fas fa-check-circle text-green-500 mt-0.5 flex-shrink-0"></i>
                            <span>{{ app()->getLocale() === 'ar' ? 'الحقول المميزة بـ (*) مطلوبة' : 'Fields marked with (*) are required' }}</span>
                        </li>
                        <li class="flex items-start {{ app()->getLocale() === 'ar' ? 'flex-row-reverse gap-2' : 'space-x-2' }}">
                            <i class="fas fa-check-circle text-green-500 mt-0.5 flex-shrink-0"></i>
                            <span>{{ app()->getLocale() === 'ar' ? 'سنتواصل معك خلال 3-5 أيام عمل' : 'We will contact you within 3-5 business days' }}</span>
                        </li>
                        <li class="flex items-start {{ app()->getLocale() === 'ar' ? 'flex-row-reverse gap-2' : 'space-x-2' }}">
                            <i class="fas fa-check-circle text-green-500 mt-0.5 flex-shrink-0"></i>
                            <span>{{ app()->getLocale() === 'ar' ? 'يمكنك حفظ الصفحة والعودة لاحقاً' : 'You can save this page and return later' }}</span>
                        </li>
                    </ul>
                </div>

                <!-- Contact Support -->
                <div class="bg-gradient-to-br from-blue-50 to-indigo-50 rounded-xl p-6">
                    <div class="text-center">
                        <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-3">
                            <i class="fas fa-headset text-blue-600"></i>
                        </div>
                        <h4 class="font-semibold text-gray-900 mb-2">
                            {{ app()->getLocale() === 'ar' ? 'هل تحتاج مساعدة؟' : 'Need Help?' }}
                        </h4>
                        <p class="text-sm text-gray-600 mb-4">
                            {{ app()->getLocale() === 'ar' ? 'فريق الدعم متاح لمساعدتك' : 'Our support team is here to help' }}
                        </p>
                        <a href="{{ route('contact') }}" class="inline-flex items-center text-sm font-medium text-blue-600 hover:text-blue-700 {{ app()->getLocale() === 'ar' ? 'flex-row-reverse gap-2' : '' }}">
                            <i class="fas fa-phone {{ app()->getLocale() === 'ar' ? '' : 'mr-2' }}"></i>
                            {{ app()->getLocale() === 'ar' ? 'تواصل معنا' : 'Contact Us' }}
                        </a>
                    </div>
                </div>
                </div>
            </div>

            <!-- Right Content - Application Form -->
            <div class="lg:col-span-2 form-mobile-order">
                <!-- Success/Error Messages -->
                <div id="form-messages" class="hidden mb-6"></div>

                <form id="investment-application-form" class="space-y-6">
                    @csrf

            <!-- Applicant Type Selection -->
            <div class="bg-white rounded-xl shadow-lg p-8 border border-gray-100 hover:shadow-xl transition-shadow duration-300 form-section">
                <h2 class="text-2xl font-bold text-gray-900 mb-6">
                    {{ app()->getLocale() === 'ar' ? 'نوع المتقدم' : 'Applicant Type' }}
                </h2>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <label class="relative cursor-pointer">
                        <input type="radio" name="applicant_type" value="saudi_individual"
                               class="sr-only peer" {{ old('applicant_type') === 'saudi_individual' ? 'checked' : '' }}>
                        <div class="p-6 border-2 border-gray-200 rounded-lg peer-checked:border-green-500 peer-checked:bg-green-50 transition-all">
                            <div class="flex items-center space-x-4">
                                <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center">
                                    <i class="fas fa-user text-green-600 text-xl"></i>
                                </div>
                                <div>
                                    <h3 class="text-lg font-semibold text-gray-900">
                                        {{ app()->getLocale() === 'ar' ? 'فرد سعودي' : 'Saudi Individual' }}
                                    </h3>
                                    <p class="text-gray-600">
                                        {{ app()->getLocale() === 'ar' ? 'للأفراد السعوديين' : 'For Saudi individuals' }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </label>

                    <label class="relative cursor-pointer">
                        <input type="radio" name="applicant_type" value="company_institution"
                               class="sr-only peer" {{ old('applicant_type') === 'company_institution' ? 'checked' : '' }}>
                        <div class="p-6 border-2 border-gray-200 rounded-lg peer-checked:border-green-500 peer-checked:bg-green-50 transition-all">
                            <div class="flex items-center space-x-4">
                                <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center">
                                    <i class="fas fa-building text-blue-600 text-xl"></i>
                                </div>
                                <div>
                                    <h3 class="text-lg font-semibold text-gray-900">
                                        {{ app()->getLocale() === 'ar' ? 'شركة أو مؤسسة' : 'Company/Institution' }}
                                    </h3>
                                    <p class="text-gray-600">
                                        {{ app()->getLocale() === 'ar' ? 'للشركات والمؤسسات' : 'For companies and institutions' }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </label>
                </div>
                @error('applicant_type')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Saudi Individual Fields -->
            <div id="individual-fields" class="bg-white rounded-xl shadow-lg p-8 border border-gray-100 hover:shadow-xl transition-all duration-300 form-section" style="display: none;">
                <h2 class="text-2xl font-bold text-gray-900 mb-6">
                    {{ app()->getLocale() === 'ar' ? 'معلومات إضافية للأفراد السعوديين' : 'Additional Information for Saudi Individuals' }}
                </h2>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="national_id_residence_number" class="block text-sm font-medium text-gray-700 mb-2">
                            {{ app()->getLocale() === 'ar' ? 'رقم الهوية الوطنية/الإقامة' : 'National ID/Residence Number' }} <span class="text-red-500">*</span>
                        </label>
                        <input type="text" id="national_id_residence_number" name="national_id_residence_number"
                               value="{{ old('national_id_residence_number') }}"
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent">
                        @error('national_id_residence_number')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="date_of_birth" class="block text-sm font-medium text-gray-700 mb-2">
                            {{ app()->getLocale() === 'ar' ? 'تاريخ الميلاد' : 'Date of Birth' }} <span class="text-red-500">*</span>
                        </label>
                        <input type="date" id="date_of_birth" name="date_of_birth"
                               value="{{ old('date_of_birth') }}"
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent">
                        @error('date_of_birth')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="full_name" class="block text-sm font-medium text-gray-700 mb-2">
                            {{ app()->getLocale() === 'ar' ? 'الاسم الكامل' : 'Full Name' }} <span class="text-red-500">*</span>
                        </label>
                        <input type="text" id="full_name" name="full_name"
                               value="{{ old('full_name') }}"
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent">
                        @error('full_name')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="profession" class="block text-sm font-medium text-gray-700 mb-2">
                            {{ app()->getLocale() === 'ar' ? 'المهنة' : 'Profession' }} <span class="text-red-500">*</span>
                        </label>
                        <input type="text" id="profession" name="profession"
                               value="{{ old('profession') }}"
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent">
                        @error('profession')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Company/Institution Fields -->
            <div id="company-fields" class="bg-white rounded-xl shadow-lg p-8 border border-gray-100 hover:shadow-xl transition-all duration-300 form-section" style="display: none;">
                <h2 class="text-2xl font-bold text-gray-900 mb-6">
                    {{ app()->getLocale() === 'ar' ? 'معلومات الشركة/المؤسسة' : 'Company/Institution Information' }}
                </h2>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="commercial_registration_number" class="block text-sm font-medium text-gray-700 mb-2">
                            {{ app()->getLocale() === 'ar' ? 'رقم السجل التجاري' : 'Commercial Registration Number' }} <span class="text-red-500">*</span>
                        </label>
                        <input type="text" id="commercial_registration_number" name="commercial_registration_number"
                               value="{{ old('commercial_registration_number') }}"
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent">
                        @error('commercial_registration_number')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="name_per_commercial_registration" class="block text-sm font-medium text-gray-700 mb-2">
                            {{ app()->getLocale() === 'ar' ? 'الاسم حسب السجل التجاري' : 'Name per Commercial Registration' }} <span class="text-red-500">*</span>
                        </label>
                        <input type="text" id="name_per_commercial_registration" name="name_per_commercial_registration"
                               value="{{ old('name_per_commercial_registration') }}"
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent">
                        @error('name_per_commercial_registration')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="md:col-span-2">
                        <label for="absher_registered_mobile" class="block text-sm font-medium text-gray-700 mb-2">
                            {{ app()->getLocale() === 'ar' ? 'رقم الجوال المسجل في أبشر' : 'Absher Registered Mobile Number' }} <span class="text-red-500">*</span>
                        </label>
                        <input type="tel" id="absher_registered_mobile" name="absher_registered_mobile"
                               value="{{ old('absher_registered_mobile') }}"
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent"
                               placeholder="{{ app()->getLocale() === 'ar' ? '+966xxxxxxxxx' : '+966xxxxxxxxx' }}">
                        @error('absher_registered_mobile')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Basic Information -->
            <div class="bg-white rounded-xl shadow-lg p-8 border border-gray-100 hover:shadow-xl transition-shadow duration-300 form-section">
                <h2 class="text-2xl font-bold text-gray-900 mb-6">
                    {{ app()->getLocale() === 'ar' ? 'المعلومات الأساسية' : 'Basic Information' }}
                </h2>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="nationality" class="block text-sm font-medium text-gray-700 mb-2">
                            {{ app()->getLocale() === 'ar' ? 'الجنسية' : 'Nationality' }} <span class="text-red-500">*</span>
                        </label>
                        <select id="nationality" name="nationality"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent"
                                required>
                            <option value="">{{ app()->getLocale() === 'ar' ? 'اختر الجنسية' : 'Select Nationality' }}</option>
                            <option value="saudi" {{ old('nationality') === 'saudi' ? 'selected' : '' }}>
                                {{ app()->getLocale() === 'ar' ? 'سعودي' : 'Saudi' }}
                            </option>
                            <option value="other" {{ old('nationality') === 'other' ? 'selected' : '' }}>
                                {{ app()->getLocale() === 'ar' ? 'أخرى' : 'Other' }}
                            </option>
                        </select>
                        @error('nationality')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="country_of_residence" class="block text-sm font-medium text-gray-700 mb-2">
                            {{ app()->getLocale() === 'ar' ? 'بلد الإقامة' : 'Country of Residence' }} <span class="text-red-500">*</span>
                        </label>
                        <select id="country_of_residence" name="country_of_residence"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent"
                                required>
                            <option value="">{{ app()->getLocale() === 'ar' ? 'اختر بلد الإقامة' : 'Select Country' }}</option>
                            <option value="saudi_arabia" {{ old('country_of_residence') === 'saudi_arabia' ? 'selected' : '' }}>
                                {{ app()->getLocale() === 'ar' ? 'المملكة العربية السعودية' : 'Saudi Arabia' }}
                            </option>
                            <option value="uae" {{ old('country_of_residence') === 'uae' ? 'selected' : '' }}>
                                {{ app()->getLocale() === 'ar' ? 'الإمارات العربية المتحدة' : 'United Arab Emirates' }}
                            </option>
                            <option value="kuwait" {{ old('country_of_residence') === 'kuwait' ? 'selected' : '' }}>
                                {{ app()->getLocale() === 'ar' ? 'الكويت' : 'Kuwait' }}
                            </option>
                            <option value="qatar" {{ old('country_of_residence') === 'qatar' ? 'selected' : '' }}>
                                {{ app()->getLocale() === 'ar' ? 'قطر' : 'Qatar' }}
                            </option>
                            <option value="bahrain" {{ old('country_of_residence') === 'bahrain' ? 'selected' : '' }}>
                                {{ app()->getLocale() === 'ar' ? 'البحرين' : 'Bahrain' }}
                            </option>
                            <option value="oman" {{ old('country_of_residence') === 'oman' ? 'selected' : '' }}>
                                {{ app()->getLocale() === 'ar' ? 'عُمان' : 'Oman' }}
                            </option>
                            <option value="other" {{ old('country_of_residence') === 'other' ? 'selected' : '' }}>
                                {{ app()->getLocale() === 'ar' ? 'أخرى' : 'Other' }}
                            </option>
                        </select>
                        @error('country_of_residence')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="mobile_number" class="block text-sm font-medium text-gray-700 mb-2">
                            {{ app()->getLocale() === 'ar' ? 'رقم الجوال' : 'Mobile Number' }} <span class="text-red-500">*</span>
                        </label>
                        <input type="tel" id="mobile_number" name="mobile_number"
                               value="{{ old('mobile_number') }}"
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent"
                               placeholder="{{ app()->getLocale() === 'ar' ? '+966xxxxxxxxx' : '+966xxxxxxxxx' }}"
                               required>
                        @error('mobile_number')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
                            {{ app()->getLocale() === 'ar' ? 'البريد الإلكتروني' : 'Email Address' }} <span class="text-red-500">*</span>
                        </label>
                        <input type="email" id="email" name="email"
                               value="{{ old('email') }}"
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent"
                               required>
                        @error('email')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="md:col-span-2">
                        <label for="number_of_shares" class="block text-sm font-medium text-gray-700 mb-2">
                            {{ app()->getLocale() === 'ar' ? 'عدد الأسهم المطلوبة' : 'Number of Shares Required' }} <span class="text-red-500">*</span>
                        </label>
                        <input type="number" id="number_of_shares" name="number_of_shares"
                               value="{{ old('number_of_shares') }}" min="1"
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent"
                               required>
                        @error('number_of_shares')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Share Type Field -->
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-3">
                            {{ app()->getLocale() === 'ar' ? 'نوع السهم' : 'Share Type' }} <span class="text-red-500">*</span>
                        </label>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div class="relative">
                                <input type="radio" id="share_type_regular" name="share_type" value="regular"
                                       {{ old('share_type', 'regular') === 'regular' ? 'checked' : '' }}
                                       class="sr-only peer" required>
                                <label for="share_type_regular"
                                       class="flex items-center justify-center w-full p-4 text-gray-700 bg-white border-2 border-gray-300 rounded-lg cursor-pointer peer-checked:border-green-500 peer-checked:bg-green-50 peer-checked:text-green-700 hover:bg-gray-50 transition-all duration-200">
                                    <div class="text-center">
                                        <div class="font-semibold">
                                            {{ app()->getLocale() === 'ar' ? 'سهم عادي' : 'Regular Share' }}
                                        </div>
                                        <div class="text-sm text-gray-500 mt-1">
                                            {{ app()->getLocale() === 'ar' ? 'سهم عادي بحقوق تصويت' : 'Regular share with voting rights' }}
                                        </div>
                                    </div>
                                </label>
                            </div>
                            <div class="relative">
                                <input type="radio" id="share_type_redeemable" name="share_type" value="redeemable"
                                       {{ old('share_type') === 'redeemable' ? 'checked' : '' }}
                                       class="sr-only peer" required>
                                <label for="share_type_redeemable"
                                       class="flex items-center justify-center w-full p-4 text-gray-700 bg-white border-2 border-gray-300 rounded-lg cursor-pointer peer-checked:border-green-500 peer-checked:bg-green-50 peer-checked:text-green-700 hover:bg-gray-50 transition-all duration-200">
                                    <div class="text-center">
                                        <div class="font-semibold">
                                            {{ app()->getLocale() === 'ar' ? 'سهم مسترد' : 'Redeemable Share' }}
                                        </div>
                                        <div class="text-sm text-gray-500 mt-1">
                                            {{ app()->getLocale() === 'ar' ? 'سهم قابل للاسترداد' : 'Share that can be redeemed' }}
                                        </div>
                                    </div>
                                </label>
                            </div>
                        </div>
                        @error('share_type')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Submit Button -->
            <div class="text-center step-4">
                <div class="bg-white rounded-xl shadow-lg p-8 mb-6 border border-gray-100 hover:shadow-xl transition-shadow duration-300">
                    <div class="flex items-center justify-center w-16 h-16 bg-green-100 rounded-full mx-auto mb-4">
                        <i class="fas fa-check-circle text-green-600 text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-2">
                        {{ app()->getLocale() === 'ar' ? 'مراجعة نهائية قبل الإرسال' : 'Final Review Before Submission' }}
                    </h3>
                    <p class="text-gray-600 mb-6">
                        {{ app()->getLocale() === 'ar'
                            ? 'تأكد من صحة جميع البيانات المدخلة. بعد الإرسال، سيتم مراجعة طلبك والتواصل معك خلال 3-5 أيام عمل.'
                            : 'Please verify all entered information. After submission, your application will be reviewed and we will contact you within 3-5 business days.'
                        }}
                    </p>

                    <!-- Terms and Conditions -->
                    <div class="bg-gray-50 rounded-lg p-4 mb-6">
                        <label class="flex items-start cursor-pointer {{ app()->getLocale() === 'ar' ? 'flex-row-reverse gap-3' : 'space-x-3' }}">
                            <input type="checkbox" id="terms-checkbox" required
                                   class="mt-1 w-4 h-4 text-green-600 border-gray-300 rounded focus:ring-green-500">
                            <span class="text-sm text-gray-700">
                                {{ app()->getLocale() === 'ar'
                                    ? 'أوافق على الشروط والأحكام وسياسة الخصوصية وأؤكد صحة جميع البيانات المقدمة'
                                    : 'I agree to the terms and conditions and privacy policy and confirm the accuracy of all provided information'
                                }}
                            </span>
                        </label>
                    </div>

                    <button type="submit" id="submit-btn"
                            class="bg-gradient-to-r from-green-600 to-blue-600 text-white px-12 py-4 rounded-xl font-bold hover:from-green-700 hover:to-blue-700 focus:ring-4 focus:ring-green-500 focus:ring-offset-2 transition-all duration-300 text-lg shadow-lg transform hover:scale-105 disabled:opacity-50 disabled:cursor-not-allowed disabled:transform-none">
                        <span id="submit-text" class="inline-flex items-center {{ app()->getLocale() === 'ar' ? 'flex-row-reverse gap-2' : '' }}">
                            <i class="fas fa-paper-plane {{ app()->getLocale() === 'ar' ? '' : 'mr-2' }}"></i>
                            {{ app()->getLocale() === 'ar' ? 'إرسال طلب الاستثمار' : 'Submit Investment Application' }}
                        </span>
                        <span id="loading-text" class="hidden inline-flex items-center {{ app()->getLocale() === 'ar' ? 'flex-row-reverse gap-2' : '' }}">
                            <i class="fas fa-spinner fa-spin {{ app()->getLocale() === 'ar' ? '' : 'mr-2' }}"></i>
                            {{ app()->getLocale() === 'ar' ? 'جاري الإرسال...' : 'Submitting...' }}
                        </span>
                    </button>
                </div>
                </div>
                </form>
            </div>
        </div>
    </div>
</section>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const applicantTypeInputs = document.querySelectorAll('input[name="applicant_type"]');
    const individualFields = document.getElementById('individual-fields');
    const companyFields = document.getElementById('company-fields');
    const form = document.getElementById('investment-application-form');
    const submitBtn = document.getElementById('submit-btn');
    const submitText = document.getElementById('submit-text');
    const loadingText = document.getElementById('loading-text');
    const termsCheckbox = document.getElementById('terms-checkbox');
    const messagesContainer = document.getElementById('form-messages');

    // Investment Calculator
    const calcShares = document.getElementById('calc-shares');
    const calcTotal = document.getElementById('calc-total');
    const sharePrice = {{ $sharePrice }};
    const currency = '{{ $currency }}';

    if (calcShares && calcTotal) {
        calcShares.addEventListener('input', function() {
            const shares = parseInt(this.value) || 0;
            const total = (shares * sharePrice).toFixed(2);
            calcTotal.textContent = total + ' ' + currency;
        });
    }

    // Progress Steps Update
    function updateProgressSteps(currentStep) {
        const steps = document.querySelectorAll('.progress-step');
        steps.forEach((step, index) => {
            const stepNumber = index + 1;
            const stepElement = step.querySelector('.step-number');
            const stepIcon = step.querySelector('.step-icon');

            if (stepNumber <= currentStep) {
                step.classList.add('completed');
                stepElement.classList.add('bg-green-500');
                stepElement.classList.remove('bg-white/30');
            } else {
                step.classList.remove('completed');
                stepElement.classList.remove('bg-green-500');
                stepElement.classList.add('bg-white/30');
            }
        });
    }

    // Toggle Fields Based on Applicant Type
    function toggleFields() {
        const selectedType = document.querySelector('input[name="applicant_type"]:checked')?.value;

        if (selectedType === 'saudi_individual') {
            if (individualFields) {
                individualFields.style.display = 'block';
                individualFields.classList.add('animate-fadeIn');
            }
            if (companyFields) companyFields.style.display = 'none';
            updateProgressSteps(3);
        } else if (selectedType === 'company_institution') {
            if (individualFields) individualFields.style.display = 'none';
            if (companyFields) {
                companyFields.style.display = 'block';
                companyFields.classList.add('animate-fadeIn');
            }
            updateProgressSteps(3);
        } else {
            if (individualFields) individualFields.style.display = 'none';
            if (companyFields) companyFields.style.display = 'none';
            updateProgressSteps(2);
        }
    }

    // Terms checkbox validation
    function updateSubmitButton() {
        if (termsCheckbox.checked) {
            submitBtn.disabled = false;
            submitBtn.classList.remove('opacity-50', 'cursor-not-allowed');
        } else {
            submitBtn.disabled = true;
            submitBtn.classList.add('opacity-50', 'cursor-not-allowed');
        }
    }

    // Show Message Function
    function showMessage(type, title, message) {
        const alertClass = type === 'success' ? 'bg-green-50 border-green-200 text-green-800' : 'bg-red-50 border-red-200 text-red-800';
        const iconClass = type === 'success' ? 'fas fa-check-circle text-green-600' : 'fas fa-exclamation-circle text-red-600';

        messagesContainer.innerHTML = `
            <div class="${alertClass} border rounded-xl p-6">
                <div class="flex items-start space-x-4">
                    <div class="flex-shrink-0">
                        <i class="${iconClass} text-xl"></i>
                    </div>
                    <div class="flex-1">
                        <h3 class="font-semibold text-lg mb-2">${title}</h3>
                        <p>${message}</p>
                    </div>
                </div>
            </div>
        `;
        messagesContainer.classList.remove('hidden');
        messagesContainer.scrollIntoView({ behavior: 'smooth', block: 'center' });
    }

    // Show Validation Errors
    function showValidationErrors(errors) {
        // Clear previous errors
        document.querySelectorAll('.error-message').forEach(el => el.remove());
        document.querySelectorAll('.border-red-500').forEach(el => {
            el.classList.remove('border-red-500');
            el.classList.add('border-gray-300');
        });

        // Show new errors
        Object.keys(errors).forEach(field => {
            const input = document.querySelector(`[name="${field}"]`);
            if (input) {
                input.classList.remove('border-gray-300');
                input.classList.add('border-red-500');

                const errorDiv = document.createElement('p');
                errorDiv.className = 'error-message mt-1 text-sm text-red-600';
                errorDiv.textContent = errors[field][0];
                input.parentNode.appendChild(errorDiv);
            }
        });

        // Scroll to first error
        const firstError = document.querySelector('.border-red-500');
        if (firstError) {
            firstError.scrollIntoView({ behavior: 'smooth', block: 'center' });
        }
    }

    // Event Listeners
    applicantTypeInputs.forEach(input => {
        input.addEventListener('change', toggleFields);
    });

    if (termsCheckbox) {
        termsCheckbox.addEventListener('change', updateSubmitButton);
        updateSubmitButton(); // Initial state
    }

    // AJAX Form Submission
    if (form) {
        form.addEventListener('submit', function(e) {
            e.preventDefault();

            if (!termsCheckbox.checked) {
                showMessage('error',
                    '{{ app()->getLocale() === 'ar' ? 'خطأ' : 'Error' }}',
                    '{{ app()->getLocale() === 'ar' ? 'يجب الموافقة على الشروط والأحكام' : 'You must agree to the terms and conditions' }}'
                );
                return;
            }

            // Show loading state
            submitBtn.disabled = true;
            submitText.classList.add('hidden');
            loadingText.classList.remove('hidden');
            messagesContainer.classList.add('hidden');

            // Prepare form data
            const formData = new FormData(form);

            // Debug: Log form data
            console.log('Form data being sent:');
            for (let [key, value] of formData.entries()) {
                console.log(key, value);
            }

            // Send AJAX request
            fetch('{{ route('investment-application.store') }}', {
                method: 'POST',
                body: formData,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            })
            .then(async response => {
                const data = await response.json();

                if (!response.ok) {
                    // Create error object with response for better error handling
                    const error = new Error(data.message || 'Request failed');
                    error.response = response;
                    error.data = data;
                    throw error;
                }

                return data;
            })
            .then(data => {
                if (data.success) {
                    showMessage('success',
                        '{{ app()->getLocale() === 'ar' ? 'تم الإرسال بنجاح!' : 'Successfully Submitted!' }}',
                        data.message || '{{ app()->getLocale() === 'ar' ? 'تم إرسال طلبك بنجاح. سنتواصل معك قريباً.' : 'Your application has been submitted successfully. We will contact you soon.' }}'
                    );

                    // Reset form
                    form.reset();
                    toggleFields();
                    updateProgressSteps(1);

                    // Redirect after 3 seconds
                    setTimeout(() => {
                        window.location.href = '{{ route('investment-application.success') }}';
                    }, 3000);
                } else {
                    throw new Error(data.message || 'Submission failed');
                }
            })
            .catch((error) => {
                console.error('Error:', error);

                // Handle different types of errors
                if (error.name === 'TypeError' && error.message.includes('fetch')) {
                    // Network error
                    showMessage('error',
                        '{{ app()->getLocale() === 'ar' ? 'خطأ في الاتصال' : 'Connection Error' }}',
                        '{{ app()->getLocale() === 'ar' ? 'تعذر الاتصال بالخادم. يرجى التحقق من اتصال الإنترنت والمحاولة مرة أخرى.' : 'Unable to connect to server. Please check your internet connection and try again.' }}'
                    );
                } else if (error.response && error.data) {
                    // Server responded with error status
                    const errorData = error.data;

                    if (error.response.status === 422) {
                        // Validation errors
                        if (errorData.errors) {
                            showValidationErrors(errorData.errors);
                        }
                        showMessage('error',
                            '{{ app()->getLocale() === 'ar' ? 'خطأ في البيانات' : 'Validation Error' }}',
                            errorData.message || '{{ app()->getLocale() === 'ar' ? 'يرجى تصحيح الأخطاء المميزة باللون الأحمر' : 'Please correct the errors highlighted in red' }}'
                        );
                    } else if (error.response.status === 500) {
                        // Server error
                        showMessage('error',
                            '{{ app()->getLocale() === 'ar' ? 'خطأ في الخادم' : 'Server Error' }}',
                            '{{ app()->getLocale() === 'ar' ? 'حدث خطأ في الخادم. يرجى المحاولة مرة أخرى لاحقاً.' : 'A server error occurred. Please try again later.' }}'
                        );
                    } else {
                        // Other HTTP errors
                        showMessage('error',
                            '{{ app()->getLocale() === 'ar' ? 'خطأ في الإرسال' : 'Submission Error' }}',
                            errorData.message || '{{ app()->getLocale() === 'ar' ? 'حدث خطأ أثناء إرسال الطلب. يرجى المحاولة مرة أخرى.' : 'An error occurred while submitting your application. Please try again.' }}'
                        );
                    }
                } else {
                    // Generic error
                    showMessage('error',
                        '{{ app()->getLocale() === 'ar' ? 'خطأ غير متوقع' : 'Unexpected Error' }}',
                        error.message || '{{ app()->getLocale() === 'ar' ? 'حدث خطأ غير متوقع. يرجى إعادة تحميل الصفحة والمحاولة مرة أخرى.' : 'An unexpected error occurred. Please refresh the page and try again.' }}'
                    );
                }
            })
            .finally(() => {
                // Reset button state
                submitBtn.disabled = false;
                submitText.classList.remove('hidden');
                loadingText.classList.add('hidden');
                updateSubmitButton();
            });
        });
    }

    // Initial setup
    toggleFields();
    updateProgressSteps(1);
});
</script>
@endsection

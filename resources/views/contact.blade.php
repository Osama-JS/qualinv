@extends('layouts.public')

@section('title', app()->getLocale() === 'ar' ? 'تواصل معنا' : 'Contact Us')
@section('description', app()->getLocale() === 'ar' ? 'تواصل مع فريق شركة الجودة للاستثمار للحصول على استشارة مجانية' : 'Contact Quality Investment Company team for a free consultation')

@section('content')
@php
    $company = \App\Models\Company::first();
@endphp

<!-- Page Header -->
<section class="page-header bg-gradient-to-r from-green-800 via-gray-900 to-green-700 text-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <div class="mb-8">
            <div class="inline-flex items-center justify-center w-20 h-20 bg-white/20 backdrop-blur-sm rounded-full mb-6">
                <i class="fas fa-envelope text-3xl text-white"></i>
            </div>
            <h1 class="text-4xl md:text-6xl font-bold mb-6">
                {{ app()->getLocale() === 'ar' ? 'تواصل معنا' : 'Contact Us' }}
            </h1>
            <p class="text-xl md:text-2xl text-gray-200 max-w-4xl mx-auto">
                {{ app()->getLocale() === 'ar'
                    ? 'نحن هنا لمساعدتك في رحلتك الاستثمارية. تواصل معنا للحصول على استشارة مجانية'
                    : 'We are here to help you in your investment journey. Contact us for a free consultation'
                }}
            </p>
        </div>
    </div>
</section>

<!-- Contact Section -->
<section class="py-20 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">

            <!-- Contact Information -->
            <div class="lg:col-span-1 space-y-8">
                <div>
                    <h2 class="text-3xl font-bold text-gray-900 mb-6">
                        {{ app()->getLocale() === 'ar' ? 'معلومات التواصل' : 'Contact Information' }}
                    </h2>
                    <p class="text-gray-600 text-lg">
                        {{ app()->getLocale() === 'ar'
                            ? 'نحن متاحون للإجابة على جميع استفساراتك ومساعدتك في اتخاذ القرارات الاستثمارية الصحيحة.'
                            : 'We are available to answer all your questions and help you make the right investment decisions.'
                        }}
                    </p>
                </div>

                <!-- Contact Cards -->
                <div class="space-y-6">
                    <!-- Phone -->
                    <div class="bg-white rounded-2xl shadow-lg p-6 border border-gray-100 hover:shadow-xl transition-shadow duration-300">
                        <div class="flex items-start space-x-4">
                            <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center flex-shrink-0">
                                <i class="fas fa-phone text-green-600"></i>
                            </div>
                            <div>
                                <h3 class="text-lg font-semibold text-gray-900 mb-2">
                                    {{ app()->getLocale() === 'ar' ? 'الهاتف' : 'Phone' }}
                                </h3>
                                <p class="text-gray-600">{{ $company->phone ?? '+966 11 123 4567' }}</p>
                                <p class="text-sm text-gray-500 mt-1">
                                    {{ app()->getLocale() === 'ar' ? 'الأحد - الخميس: 9:00 ص - 6:00 م' : 'Sun - Thu: 9:00 AM - 6:00 PM' }}
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Email -->
                    <div class="bg-white rounded-2xl shadow-lg p-6 border border-gray-100 hover:shadow-xl transition-shadow duration-300">
                        <div class="flex items-start space-x-4">
                            <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center flex-shrink-0">
                                <i class="fas fa-envelope text-blue-600"></i>
                            </div>
                            <div>
                                <h3 class="text-lg font-semibold text-gray-900 mb-2">
                                    {{ app()->getLocale() === 'ar' ? 'البريد الإلكتروني' : 'Email' }}
                                </h3>
                                <p class="text-gray-600">{{ $company->email ?? 'info@qualityinvestment.com' }}</p>
                                <p class="text-sm text-gray-500 mt-1">
                                    {{ app()->getLocale() === 'ar' ? 'نرد خلال 24 ساعة' : 'We reply within 24 hours' }}
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Address -->
                    <div class="bg-white rounded-2xl shadow-lg p-6 border border-gray-100 hover:shadow-xl transition-shadow duration-300">
                        <div class="flex items-start space-x-4">
                            <div class="w-12 h-12 bg-purple-100 rounded-full flex items-center justify-center flex-shrink-0">
                                <i class="fas fa-map-marker-alt text-purple-600"></i>
                            </div>
                            <div>
                                <h3 class="text-lg font-semibold text-gray-900 mb-2">
                                    {{ app()->getLocale() === 'ar' ? 'العنوان' : 'Address' }}
                                </h3>
                                <p class="text-gray-600">
                                    {{ $company->address ?? (app()->getLocale() === 'ar' ? 'الرياض، المملكة العربية السعودية' : 'Riyadh, Saudi Arabia') }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Social Media -->
                <div class="bg-white rounded-2xl shadow-lg p-6 border border-gray-100">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">
                        {{ app()->getLocale() === 'ar' ? 'تابعنا على' : 'Follow Us' }}
                    </h3>
                    <div class="flex space-x-4">
                        <a href="#" class="w-10 h-10 bg-blue-600 rounded-full flex items-center justify-center text-white hover:bg-blue-700 transition-colors">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="#" class="w-10 h-10 bg-blue-400 rounded-full flex items-center justify-center text-white hover:bg-blue-500 transition-colors">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a href="#" class="w-10 h-10 bg-blue-800 rounded-full flex items-center justify-center text-white hover:bg-blue-900 transition-colors">
                            <i class="fab fa-linkedin-in"></i>
                        </a>
                        <a href="#" class="w-10 h-10 bg-red-600 rounded-full flex items-center justify-center text-white hover:bg-red-700 transition-colors">
                            <i class="fab fa-youtube"></i>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Contact Form -->
            <div class="lg:col-span-2">
                <div class="bg-white rounded-2xl shadow-xl p-8 border border-gray-100">
                    <h2 class="text-3xl font-bold text-gray-900 mb-6">
                        {{ app()->getLocale() === 'ar' ? 'أرسل لنا رسالة' : 'Send us a Message' }}
                    </h2>

                    <!-- Success/Error Messages -->
                    <div id="contact-messages" class="hidden mb-6"></div>

                    <form id="contact-form" class="space-y-6">
                        @csrf
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="name" class="block text-sm font-medium text-gray-700 mb-2">
                                    {{ app()->getLocale() === 'ar' ? 'الاسم الكامل' : 'Full Name' }} <span class="text-red-500">*</span>
                                </label>
                                <input type="text" id="name" name="name" required
                                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent transition-colors">
                            </div>

                            <div>
                                <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
                                    {{ app()->getLocale() === 'ar' ? 'البريد الإلكتروني' : 'Email Address' }} <span class="text-red-500">*</span>
                                </label>
                                <input type="email" id="email" name="email" required
                                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent transition-colors">
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="phone" class="block text-sm font-medium text-gray-700 mb-2">
                                    {{ app()->getLocale() === 'ar' ? 'رقم الهاتف' : 'Phone Number' }}
                                </label>
                                <input type="tel" id="phone" name="phone"
                                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent transition-colors">
                            </div>

                            <div>
                                <label for="subject" class="block text-sm font-medium text-gray-700 mb-2">
                                    {{ app()->getLocale() === 'ar' ? 'الموضوع' : 'Subject' }} <span class="text-red-500">*</span>
                                </label>
                                <select id="subject" name="subject" required
                                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent transition-colors">
                                    <option value="">{{ app()->getLocale() === 'ar' ? 'اختر الموضوع' : 'Select Subject' }}</option>
                                    <option value="investment">{{ app()->getLocale() === 'ar' ? 'استفسار عن الاستثمار' : 'Investment Inquiry' }}</option>
                                    <option value="consultation">{{ app()->getLocale() === 'ar' ? 'طلب استشارة' : 'Consultation Request' }}</option>
                                    <option value="support">{{ app()->getLocale() === 'ar' ? 'الدعم الفني' : 'Technical Support' }}</option>
                                    <option value="partnership">{{ app()->getLocale() === 'ar' ? 'شراكة' : 'Partnership' }}</option>
                                    <option value="other">{{ app()->getLocale() === 'ar' ? 'أخرى' : 'Other' }}</option>
                                </select>
                            </div>
                        </div>

                        <div>
                            <label for="message" class="block text-sm font-medium text-gray-700 mb-2">
                                {{ app()->getLocale() === 'ar' ? 'الرسالة' : 'Message' }} <span class="text-red-500">*</span>
                            </label>
                            <textarea id="message" name="message" rows="6" required
                                      class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent transition-colors"
                                      placeholder="{{ app()->getLocale() === 'ar' ? 'اكتب رسالتك هنا...' : 'Write your message here...' }}"></textarea>
                        </div>

                        <div>
                            <button type="submit" id="contact-submit-btn"
                                    class="w-full bg-gradient-to-r from-green-600 to-blue-600 text-white py-4 px-6 rounded-lg font-bold hover:from-green-700 hover:to-blue-700 focus:ring-4 focus:ring-green-500 focus:ring-offset-2 transition-all duration-300 transform hover:scale-105 disabled:opacity-50 disabled:cursor-not-allowed disabled:transform-none">
                                <span id="contact-submit-text">
                                    <i class="fas fa-paper-plane mr-2"></i>
                                    {{ app()->getLocale() === 'ar' ? 'إرسال الرسالة' : 'Send Message' }}
                                </span>
                                <span id="contact-loading-text" class="hidden">
                                    <i class="fas fa-spinner fa-spin mr-2"></i>
                                    {{ app()->getLocale() === 'ar' ? 'جاري الإرسال...' : 'Sending...' }}
                                </span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>


@endsection

@push('scripts')
<script>
// FAQ Toggle Functionality
document.addEventListener('DOMContentLoaded', function() {
    const faqToggles = document.querySelectorAll('.faq-toggle');

    faqToggles.forEach(toggle => {
        toggle.addEventListener('click', function() {
            const targetId = this.getAttribute('data-target');
            const content = document.getElementById(targetId);
            const icon = this.querySelector('i');

            // Toggle content
            content.classList.toggle('hidden');

            // Rotate icon
            if (content.classList.contains('hidden')) {
                icon.style.transform = 'rotate(0deg)';
            } else {
                icon.style.transform = 'rotate(180deg)';
            }
        });
    });

    // Contact Form AJAX
    const contactForm = document.getElementById('contact-form');
    const submitBtn = document.getElementById('contact-submit-btn');
    const submitText = document.getElementById('contact-submit-text');
    const loadingText = document.getElementById('contact-loading-text');
    const messagesContainer = document.getElementById('contact-messages');

    if (contactForm) {
        contactForm.addEventListener('submit', function(e) {
            e.preventDefault();

            // Show loading state
            submitBtn.disabled = true;
            submitText.classList.add('hidden');
            loadingText.classList.remove('hidden');
            messagesContainer.classList.add('hidden');

            // Prepare form data
            const formData = new FormData(contactForm);

            // Send AJAX request
            fetch('{{ route("contact.store") }}', {
                method: 'POST',
                body: formData,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Show success message
                    messagesContainer.innerHTML = `
                        <div class="bg-green-50 border border-green-200 text-green-800 rounded-xl p-6">
                            <div class="flex items-start space-x-4">
                                <div class="flex-shrink-0">
                                    <i class="fas fa-check-circle text-green-600 text-xl"></i>
                                </div>
                                <div>
                                    <h3 class="font-semibold text-lg mb-2">{{ app()->getLocale() === 'ar' ? 'تم إرسال الرسالة بنجاح!' : 'Message sent successfully!' }}</h3>
                                    <p>${data.message}</p>
                                </div>
                            </div>
                        </div>
                    `;
                    messagesContainer.classList.remove('hidden');

                    // Reset form
                    contactForm.reset();
                } else {
                    // Show error message
                    messagesContainer.innerHTML = `
                        <div class="bg-red-50 border border-red-200 text-red-800 rounded-xl p-6">
                            <div class="flex items-start space-x-4">
                                <div class="flex-shrink-0">
                                    <i class="fas fa-exclamation-circle text-red-500 text-xl"></i>
                                </div>
                                <div>
                                    <h3 class="font-semibold text-lg mb-2">{{ app()->getLocale() === 'ar' ? 'حدث خطأ!' : 'Error occurred!' }}</h3>
                                    <p>${data.message}</p>
                                </div>
                            </div>
                        </div>
                    `;
                    messagesContainer.classList.remove('hidden');
                }
            })
            .catch(error => {
                console.error('Error:', error);

                // Show error message
                messagesContainer.innerHTML = `
                    <div class="bg-red-50 border border-red-200 text-red-800 rounded-xl p-6">
                        <div class="flex items-start space-x-4">
                            <div class="flex-shrink-0">
                                <i class="fas fa-exclamation-circle text-red-500 text-xl"></i>
                            </div>
                            <div>
                                <h3 class="font-semibold text-lg mb-2">{{ app()->getLocale() === 'ar' ? 'حدث خطأ!' : 'Error occurred!' }}</h3>
                                <p>{{ app()->getLocale() === 'ar' ? 'حدث خطأ أثناء إرسال الرسالة. يرجى المحاولة مرة أخرى.' : 'An error occurred while sending the message. Please try again.' }}</p>
                            </div>
                        </div>
                    </div>
                `;
                messagesContainer.classList.remove('hidden');
            })
            .finally(() => {
                // Reset button state
                submitBtn.disabled = false;
                submitText.classList.remove('hidden');
                loadingText.classList.add('hidden');
            });
        });
    }
});
</script>
@endpush

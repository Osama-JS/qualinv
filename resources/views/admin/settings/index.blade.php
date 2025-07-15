@extends('layouts.admin')

@section('page-title', __('admin.site_settings'))

@section('content')
<div class="mb-6">
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-3xl font-bold text-gray-900 dark:text-gray-100">{{ __('admin.site_settings') }}</h1>
            <p class="text-gray-600 dark:text-gray-400">{{ __('admin.manage_site_settings_description') }}</p>
        </div>

        <!-- Maintenance Mode Toggle -->
        <div class="flex items-center space-x-4">
            <form action="{{ route('admin.settings.toggle-maintenance') }}" method="POST" class="inline">
                @csrf
                <button type="submit" class="flex items-center px-4 py-2 rounded-lg font-medium transition-colors
                    {{ $settings['maintenance']['maintenance_mode']
                        ? 'bg-red-600 hover:bg-red-700 text-white'
                        : 'bg-green-600 hover:bg-green-700 text-white' }}">
                    <i class="fas {{ $settings['maintenance']['maintenance_mode'] ? 'fa-toggle-on' : 'fa-toggle-off' }} mr-2"></i>
                    {{ $settings['maintenance']['maintenance_mode']
                        ? __('admin.disable_maintenance')
                        : __('admin.enable_maintenance') }}
                </button>
            </form>
        </div>
    </div>
</div>

@if($settings['maintenance']['maintenance_mode'])
<div class="mb-6 p-4 bg-red-50 border border-red-200 rounded-lg">
    <div class="flex items-center">
        <i class="fas fa-exclamation-triangle text-red-600 mr-3"></i>
        <div>
            <h3 class="text-red-800 font-semibold">{{ __('admin.maintenance_mode_active') }}</h3>
            <p class="text-red-700 text-sm">{{ __('admin.maintenance_mode_description') }}</p>
        </div>
    </div>
</div>
@endif

<form action="{{ route('admin.settings.update') }}" method="POST" class="space-y-8">
    @csrf
    @method('PUT')

    <!-- Maintenance Settings -->
    <div class="bg-white dark:bg-gray-800 shadow-sm rounded-lg">
        <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
            <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100 flex items-center">
                <i class="fas fa-tools mr-3 text-orange-500"></i>
                {{ __('admin.maintenance_settings') }}
            </h3>
        </div>
        <div class="p-6 space-y-6">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <div>
                    <label for="maintenance_message_en" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        {{ __('admin.maintenance_message') }} (English)
                    </label>
                    <textarea name="maintenance_message_en" id="maintenance_message_en" rows="3"
                              class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-gray-100"
                              placeholder="Enter maintenance message in English">{{ old('maintenance_message_en', $settings['maintenance']['maintenance_message_en']) }}</textarea>
                    @error('maintenance_message_en')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="maintenance_message_ar" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        {{ __('admin.maintenance_message') }} (العربية)
                    </label>
                    <textarea name="maintenance_message_ar" id="maintenance_message_ar" rows="3"
                              class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-gray-100"
                              placeholder="أدخل رسالة الصيانة بالعربية" dir="rtl">{{ old('maintenance_message_ar', $settings['maintenance']['maintenance_message_ar']) }}</textarea>
                    @error('maintenance_message_ar')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>
        </div>
    </div>

    <!-- General Settings -->
    <div class="bg-white dark:bg-gray-800 shadow-sm rounded-lg">
        <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
            <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100 flex items-center">
                <i class="fas fa-cog mr-3 text-blue-500"></i>
                {{ __('admin.general_settings') }}
            </h3>
        </div>
        <div class="p-6 space-y-6">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <div>
                    <label for="site_name_en" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        {{ __('admin.site_name') }} (English) <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="site_name_en" id="site_name_en"
                           value="{{ old('site_name_en', $settings['general']['site_name_en']) }}"
                           class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-gray-100"
                           required>
                    @error('site_name_en')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="site_name_ar" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        {{ __('admin.site_name') }} (العربية) <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="site_name_ar" id="site_name_ar"
                           value="{{ old('site_name_ar', $settings['general']['site_name_ar']) }}"
                           class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-gray-100"
                           dir="rtl" required>
                    @error('site_name_ar')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="share_price" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        {{ __('admin.share_price') }} <span class="text-red-500">*</span>
                    </label>
                    <div class="relative">
                        <input type="number" name="share_price" id="share_price" step="0.01" min="0"
                               value="{{ old('share_price', $settings['general']['share_price']) }}"
                               class="w-full px-3 py-2 pr-12 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-gray-100"
                               required>
                        <div class="absolute inset-y-0 right-0 flex items-center pr-3">
                            <span class="text-gray-500 text-sm">{{ $settings['general']['currency'] }}</span>
                        </div>
                    </div>
                    @error('share_price')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="currency" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        {{ __('admin.currency') }} <span class="text-red-500">*</span>
                    </label>
                    <select name="currency" id="currency"
                            class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-gray-100"
                            required>
                        <option value="SAR" {{ old('currency', $settings['general']['currency']) == 'SAR' ? 'selected' : '' }}>SAR - {{ __('admin.saudi_riyal') }}</option>
                        <option value="USD" {{ old('currency', $settings['general']['currency']) == 'USD' ? 'selected' : '' }}>USD - {{ __('admin.us_dollar') }}</option>
                        <option value="EUR" {{ old('currency', $settings['general']['currency']) == 'EUR' ? 'selected' : '' }}>EUR - {{ __('admin.euro') }}</option>
                    </select>
                    @error('currency')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>
        </div>
    </div>



    <!-- Contact Information Notice -->
    <div class="bg-blue-50 dark:bg-blue-900/20 border border-blue-200 dark:border-blue-800 rounded-lg p-4 mb-6">
        <div class="flex items-center">
            <i class="fas fa-info-circle text-blue-600 dark:text-blue-400 mr-3"></i>
            <div>
                <h4 class="text-blue-800 dark:text-blue-200 font-medium">{{ __('admin.contact_info_notice_title') }}</h4>
                <p class="text-blue-700 dark:text-blue-300 text-sm mt-1">
                    {{ __('admin.contact_info_notice_description') }}
                    <a href="{{ route('admin.company.edit') }}" class="underline hover:no-underline font-medium">
                        {{ __('admin.company_information_page') }}
                    </a>
                </p>
            </div>
        </div>
    </div>

    <!-- Social Media Links -->
    <div class="bg-white dark:bg-gray-800 shadow-sm rounded-lg">
        <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
            <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100 flex items-center">
                <i class="fas fa-share-alt mr-3 text-purple-500"></i>
                {{ __('admin.social_media_links') }}
            </h3>
        </div>
        <div class="p-6 space-y-6">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <div>
                    <label for="facebook_url" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        <i class="fab fa-facebook text-blue-600 mr-2"></i>{{ __('admin.facebook_url') }}
                    </label>
                    <input type="url" name="facebook_url" id="facebook_url"
                           value="{{ old('facebook_url', $settings['social']['facebook_url']) }}"
                           class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-gray-100"
                           placeholder="https://facebook.com/yourpage">
                    @error('facebook_url')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="twitter_url" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        <i class="fab fa-twitter text-blue-400 mr-2"></i>{{ __('admin.twitter_url') }}
                    </label>
                    <input type="url" name="twitter_url" id="twitter_url"
                           value="{{ old('twitter_url', $settings['social']['twitter_url']) }}"
                           class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-gray-100"
                           placeholder="https://twitter.com/yourhandle">
                    @error('twitter_url')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="linkedin_url" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        <i class="fab fa-linkedin text-blue-700 mr-2"></i>{{ __('admin.linkedin_url') }}
                    </label>
                    <input type="url" name="linkedin_url" id="linkedin_url"
                           value="{{ old('linkedin_url', $settings['social']['linkedin_url']) }}"
                           class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-gray-100"
                           placeholder="https://linkedin.com/company/yourcompany">
                    @error('linkedin_url')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="instagram_url" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        <i class="fab fa-instagram text-pink-500 mr-2"></i>{{ __('admin.instagram_url') }}
                    </label>
                    <input type="url" name="instagram_url" id="instagram_url"
                           value="{{ old('instagram_url', $settings['social']['instagram_url']) }}"
                           class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-gray-100"
                           placeholder="https://instagram.com/yourhandle">
                    @error('instagram_url')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="youtube_url" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        <i class="fab fa-youtube text-red-600 mr-2"></i>{{ __('admin.youtube_url') }}
                    </label>
                    <input type="url" name="youtube_url" id="youtube_url"
                           value="{{ old('youtube_url', $settings['social']['youtube_url']) }}"
                           class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-gray-100"
                           placeholder="https://youtube.com/channel/yourchannel">
                    @error('youtube_url')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>
        </div>
    </div>

    <!-- Page Visibility Settings -->
    <div class="bg-white dark:bg-gray-800 shadow-sm rounded-lg">
        <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
            <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100 flex items-center">
                <i class="fas fa-eye mr-3 text-purple-500"></i>
                {{ __('admin.page_visibility_settings') }}
            </h3>
            <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">{{ __('admin.control_page_visibility') }}</p>
        </div>
        <div class="p-6">
            <div class="space-y-4">
                <!-- News Page Toggle -->
                <div class="flex items-center justify-between p-4 bg-gray-50 dark:bg-gray-700 rounded-lg">
                    <div class="flex-1">
                        <label for="news_page_enabled" class="block text-sm font-medium text-gray-900 dark:text-gray-100">
                            {{ __('admin.news_page') }}
                        </label>
                        <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">
                            {{ __('admin.news_page_description') }}
                        </p>
                    </div>
                    <div class="ml-4">
                        <label class="relative inline-flex items-center cursor-pointer">
                            <input type="checkbox" name="news_page_enabled" id="news_page_enabled" value="1"
                                   {{ old('news_page_enabled', $settings['pages']['news_page_enabled']) ? 'checked' : '' }}
                                   class="sr-only peer">
                            <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600"></div>
                        </label>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- SEO Settings -->
    <div class="bg-white dark:bg-gray-800 shadow-sm rounded-lg">
        <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
            <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100 flex items-center">
                <i class="fas fa-search mr-3 text-indigo-500"></i>
                {{ __('admin.seo_settings') }}
            </h3>
        </div>
        <div class="p-6 space-y-6">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <div>
                    <label for="meta_title_en" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        {{ __('admin.meta_title') }} (English) <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="meta_title_en" id="meta_title_en"
                           value="{{ old('meta_title_en', $settings['seo']['meta_title_en']) }}"
                           class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-gray-100"
                           maxlength="60" required>
                    <p class="mt-1 text-xs text-gray-500">{{ __('admin.recommended_length') }}: 50-60 {{ __('admin.characters') }}</p>
                    @error('meta_title_en')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="meta_title_ar" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        {{ __('admin.meta_title') }} (العربية) <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="meta_title_ar" id="meta_title_ar"
                           value="{{ old('meta_title_ar', $settings['seo']['meta_title_ar']) }}"
                           class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-gray-100"
                           maxlength="60" dir="rtl" required>
                    <p class="mt-1 text-xs text-gray-500">{{ __('admin.recommended_length') }}: 50-60 {{ __('admin.characters') }}</p>
                    @error('meta_title_ar')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="meta_description_en" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        {{ __('admin.meta_description') }} (English) <span class="text-red-500">*</span>
                    </label>
                    <textarea name="meta_description_en" id="meta_description_en" rows="3"
                              class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-gray-100"
                              maxlength="160" required>{{ old('meta_description_en', $settings['seo']['meta_description_en']) }}</textarea>
                    <p class="mt-1 text-xs text-gray-500">{{ __('admin.recommended_length') }}: 150-160 {{ __('admin.characters') }}</p>
                    @error('meta_description_en')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="meta_description_ar" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        {{ __('admin.meta_description') }} (العربية) <span class="text-red-500">*</span>
                    </label>
                    <textarea name="meta_description_ar" id="meta_description_ar" rows="3"
                              class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-gray-100"
                              maxlength="160" dir="rtl" required>{{ old('meta_description_ar', $settings['seo']['meta_description_ar']) }}</textarea>
                    <p class="mt-1 text-xs text-gray-500">{{ __('admin.recommended_length') }}: 150-160 {{ __('admin.characters') }}</p>
                    @error('meta_description_ar')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="meta_keywords_en" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        {{ __('admin.meta_keywords') }} (English)
                    </label>
                    <input type="text" name="meta_keywords_en" id="meta_keywords_en"
                           value="{{ old('meta_keywords_en', $settings['seo']['meta_keywords_en']) }}"
                           class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-gray-100"
                           placeholder="keyword1, keyword2, keyword3">
                    <p class="mt-1 text-xs text-gray-500">{{ __('admin.separate_keywords_with_commas') }}</p>
                    @error('meta_keywords_en')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="meta_keywords_ar" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        {{ __('admin.meta_keywords') }} (العربية)
                    </label>
                    <input type="text" name="meta_keywords_ar" id="meta_keywords_ar"
                           value="{{ old('meta_keywords_ar', $settings['seo']['meta_keywords_ar']) }}"
                           class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-gray-100"
                           placeholder="كلمة مفتاحية، كلمة أخرى، كلمة ثالثة" dir="rtl">
                    <p class="mt-1 text-xs text-gray-500">{{ __('admin.separate_keywords_with_commas') }}</p>
                    @error('meta_keywords_ar')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>
        </div>
    </div>

    <!-- Statistics Settings -->
    <div class="bg-white dark:bg-gray-800 shadow-sm rounded-lg">
        <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
            <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100 flex items-center">
                <i class="fas fa-chart-bar mr-3 text-green-500"></i>
                {{ __('admin.homepage_counters') }}
            </h3>
            <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">
                {{ __('admin.update_statistics_displayed_homepage') }}
            </p>
        </div>
        <div class="p-6 space-y-6">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <!-- المستثمرين -->
                <div>
                    <label for="investors_count" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        <i class="fas fa-users text-green-500 mr-2"></i>{{ app()->getLocale() === 'ar' ? 'المستثمرين' : 'Investors' }}
                    </label>
                    <input type="text"
                           id="investors_count"
                           name="investors_count"
                           value="{{ old('investors_count', $settings['statistics']['investors_count'] ?? '1000') }}"
                           class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-gray-100"
                           placeholder="{{ app()->getLocale() === 'ar' ? 'مثال: 1000' : 'Example: 1000' }}">
                    @error('investors_count')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- الأسهم المباعة -->
                <div>
                    <label for="sold_shares" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        <i class="fas fa-chart-line text-green-500 mr-2"></i>{{ app()->getLocale() === 'ar' ? 'الأسهم المباعة' : 'Shares Sold' }}
                    </label>
                    <input type="text"
                           id="sold_shares"
                           name="sold_shares"
                           value="{{ old('sold_shares', $settings['statistics']['sold_shares'] ?? '50000') }}"
                           class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-gray-100"
                           placeholder="{{ app()->getLocale() === 'ar' ? 'مثال: 50000' : 'Example: 50000' }}">
                    @error('sold_shares')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- الأسهم المتاحة -->
                <div>
                    <label for="available_shares" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        <i class="fas fa-coins text-green-500 mr-2"></i>{{ app()->getLocale() === 'ar' ? 'الأسهم المتاحة' : 'Available Shares' }}
                    </label>
                    <input type="text"
                           id="available_shares"
                           name="available_shares"
                           value="{{ old('available_shares', $settings['statistics']['available_shares'] ?? '25000') }}"
                           class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-gray-100"
                           placeholder="{{ app()->getLocale() === 'ar' ? 'مثال: 25000' : 'Example: 25000' }}">
                    @error('available_shares')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- قيمة الشركة -->
                <div>
                    <label for="company_value" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        <i class="fas fa-dollar-sign text-green-500 mr-2"></i>{{ app()->getLocale() === 'ar' ? 'قيمة الشركة' : 'Company Value' }}
                    </label>
                    <input type="text"
                           id="company_value"
                           name="company_value"
                           value="{{ old('company_value', $settings['statistics']['company_value'] ?? '500M') }}"
                           class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-gray-100"
                           placeholder="{{ app()->getLocale() === 'ar' ? 'مثال: 500M' : 'Example: 500M' }}">
                    @error('company_value')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Help Text -->
            <div class="p-4 bg-green-50 dark:bg-green-900/20 rounded-lg border border-green-200 dark:border-green-800">
                <div class="flex items-start">
                    <i class="fas fa-info-circle text-green-500 mt-1 mr-3"></i>
                    <div>
                        <h4 class="text-sm font-medium text-green-800 dark:text-green-200">{{ __('admin.statistics_help_title') }}</h4>
                        <p class="text-sm text-green-700 dark:text-green-300 mt-1">
                            {{ __('admin.statistics_help_description') }}
                        </p>
                        <div class="text-sm text-green-700 dark:text-green-300 mt-2">
                            <strong>{{ __('admin.examples') }}:</strong> 15+, 500M+, 1000+, 25%
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Investment Settings -->
    <div class="bg-white dark:bg-gray-800 shadow-sm rounded-lg">
        <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
            <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100 flex items-center">
                <i class="fas fa-chart-pie mr-3 text-blue-500"></i>
                {{ app()->getLocale() === 'ar' ? 'إعدادات الاستثمار' : 'Investment Settings' }}
            </h3>
            <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">
                {{ app()->getLocale() === 'ar' ? 'إعدادات سعر السهم والعملة' : 'Configure share price and currency settings' }}
            </p>
        </div>
        <div class="p-6 space-y-6">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <!-- Share Price -->
                <div>
                    <label for="share_price" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        <i class="fas fa-money-bill text-blue-500 mr-2"></i>{{ app()->getLocale() === 'ar' ? 'سعر السهم' : 'Share Price' }}
                    </label>
                    <input type="number"
                           id="share_price"
                           name="share_price"
                           step="0.01"
                           min="0"
                           value="{{ old('share_price', $settings['investment']['share_price'] ?? '125.50') }}"
                           class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-gray-100"
                           placeholder="{{ app()->getLocale() === 'ar' ? 'مثال: 125.50' : 'Example: 125.50' }}">
                    @error('share_price')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Currency -->
                <div>
                    <label for="currency" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        <i class="fas fa-coins text-blue-500 mr-2"></i>{{ app()->getLocale() === 'ar' ? 'العملة' : 'Currency' }}
                    </label>
                    <select id="currency" name="currency"
                            class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-gray-100">
                        <option value="SAR" {{ old('currency', $settings['investment']['share_price'] ?? 'SAR') === 'SAR' ? 'selected' : '' }}>
                            {{ app()->getLocale() === 'ar' ? 'ريال سعودي (SAR)' : 'Saudi Riyal (SAR)' }}
                        </option>
                        <option value="USD" {{ old('currency', $settings['investment']['currency'] ?? 'SAR') === 'USD' ? 'selected' : '' }}>
                            {{ app()->getLocale() === 'ar' ? 'دولار أمريكي (USD)' : 'US Dollar (USD)' }}
                        </option>
                        <option value="EUR" {{ old('currency', $settings['investment']['currency'] ?? 'SAR') === 'EUR' ? 'selected' : '' }}>
                            {{ app()->getLocale() === 'ar' ? 'يورو (EUR)' : 'Euro (EUR)' }}
                        </option>
                    </select>
                    @error('currency')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>
        </div>
    </div>

    <!-- Hero Section Settings -->
    <div class="bg-white dark:bg-gray-800 shadow-sm rounded-lg">
        <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
            <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100 flex items-center">
                <i class="fas fa-home mr-3 text-blue-500"></i>
                {{ __('Hero Section Settings') }}
            </h3>
            <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">
                {{ __('Manage hero section texts and buttons') }}
            </p>
        </div>
        <div class="p-6 space-y-6">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <!-- Hero Title -->
                <div>
                    <label for="hero_title_ar" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        {{ __('Hero Title (Arabic)') }}
                    </label>
                    <input type="text" name="hero_title_ar" id="hero_title_ar"
                           value="{{ old('hero_title_ar', $settings['hero']['hero_title_ar']) }}"
                           class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-gray-100">
                    @error('hero_title_ar')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="hero_title_en" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        {{ __('Hero Title (English)') }}
                    </label>
                    <input type="text" name="hero_title_en" id="hero_title_en"
                           value="{{ old('hero_title_en', $settings['hero']['hero_title_en']) }}"
                           class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-gray-100">
                    @error('hero_title_en')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <!-- Start Button -->
                <div>
                    <label for="hero_button_start_ar" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        {{ __('Start Button (Arabic)') }}
                    </label>
                    <input type="text" name="hero_button_start_ar" id="hero_button_start_ar"
                           value="{{ old('hero_button_start_ar', $settings['hero']['hero_button_start_ar']) }}"
                           class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-gray-100">
                    @error('hero_button_start_ar')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="hero_button_start_en" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        {{ __('Start Button (English)') }}
                    </label>
                    <input type="text" name="hero_button_start_en" id="hero_button_start_en"
                           value="{{ old('hero_button_start_en', $settings['hero']['hero_button_start_en']) }}"
                           class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-gray-100">
                    @error('hero_button_start_en')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <!-- Learn More Button -->
                <div>
                    <label for="hero_button_learn_ar" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        {{ __('Learn More Button (Arabic)') }}
                    </label>
                    <input type="text" name="hero_button_learn_ar" id="hero_button_learn_ar"
                           value="{{ old('hero_button_learn_ar', $settings['hero']['hero_button_learn_ar']) }}"
                           class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-gray-100">
                    @error('hero_button_learn_ar')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="hero_button_learn_en" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        {{ __('Learn More Button (English)') }}
                    </label>
                    <input type="text" name="hero_button_learn_en" id="hero_button_learn_en"
                           value="{{ old('hero_button_learn_en', $settings['hero']['hero_button_learn_en']) }}"
                           class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-gray-100">
                    @error('hero_button_learn_en')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <!-- Share Price Title -->
                <div>
                    <label for="hero_share_price_title_ar" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        {{ __('Share Price Title (Arabic)') }}
                    </label>
                    <input type="text" name="hero_share_price_title_ar" id="hero_share_price_title_ar"
                           value="{{ old('hero_share_price_title_ar', $settings['hero']['hero_share_price_title_ar']) }}"
                           class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-gray-100">
                    @error('hero_share_price_title_ar')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="hero_share_price_title_en" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        {{ __('Share Price Title (English)') }}
                    </label>
                    <input type="text" name="hero_share_price_title_en" id="hero_share_price_title_en"
                           value="{{ old('hero_share_price_title_en', $settings['hero']['hero_share_price_title_en']) }}"
                           class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-gray-100">
                    @error('hero_share_price_title_en')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>
        </div>
    </div>

    <!-- Statistics Section Settings -->
    <div class="bg-white dark:bg-gray-800 shadow-sm rounded-lg">
        <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
            <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100 flex items-center">
                <i class="fas fa-chart-bar mr-3 text-green-500"></i>
                {{ __('Statistics Section Settings') }}
            </h3>
            <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">
                {{ __('Manage statistics section titles and descriptions') }}
            </p>
        </div>
        <div class="p-6 space-y-6">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <!-- Stats Title -->
                <div>
                    <label for="stats_title_ar" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        {{ __('Statistics Title (Arabic)') }}
                    </label>
                    <input type="text" name="stats_title_ar" id="stats_title_ar"
                           value="{{ old('stats_title_ar', $settings['stats']['stats_title_ar']) }}"
                           class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-gray-100">
                    @error('stats_title_ar')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="stats_title_en" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        {{ __('Statistics Title (English)') }}
                    </label>
                    <input type="text" name="stats_title_en" id="stats_title_en"
                           value="{{ old('stats_title_en', $settings['stats']['stats_title_en']) }}"
                           class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-gray-100">
                    @error('stats_title_en')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <!-- Stats Subtitle -->
                <div>
                    <label for="stats_subtitle_ar" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        {{ __('Statistics Subtitle (Arabic)') }}
                    </label>
                    <textarea name="stats_subtitle_ar" id="stats_subtitle_ar" rows="3"
                              class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-gray-100">{{ old('stats_subtitle_ar', $settings['stats']['stats_subtitle_ar']) }}</textarea>
                    @error('stats_subtitle_ar')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="stats_subtitle_en" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        {{ __('Statistics Subtitle (English)') }}
                    </label>
                    <textarea name="stats_subtitle_en" id="stats_subtitle_en" rows="3"
                              class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-gray-100">{{ old('stats_subtitle_en', $settings['stats']['stats_subtitle_en']) }}</textarea>
                    @error('stats_subtitle_en')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>
        </div>
    </div>

    <!-- Save Button -->
    <div class="flex justify-end">
        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-6 rounded-lg transition-colors">
            <i class="fas fa-save mr-2"></i>
            {{ __('admin.save_settings') }}
        </button>
    </div>
</form>
@endsection

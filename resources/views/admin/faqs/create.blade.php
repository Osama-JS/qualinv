@extends('layouts.admin')

@section('title', __('admin.create_faq'))

@section('content')
<div class="p-6">
    <!-- Header -->
    <div class="mb-8">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h1 class="text-3xl font-bold text-gray-900 dark:text-white">{{ __('admin.create_faq') }}</h1>
                <p class="mt-2 text-sm text-gray-600 dark:text-gray-400">{{ __('admin.add_new_faq_description') }}</p>
            </div>
            <div class="mt-4 sm:mt-0">
                <a href="{{ route('admin.faqs.index') }}" 
                   class="inline-flex items-center px-4 py-2 bg-gray-600 hover:bg-gray-700 text-white text-sm font-medium rounded-lg transition-colors duration-200">
                    <i class="fas fa-arrow-left w-4 h-4 mr-2"></i>
                    {{ __('admin.back_to_faqs') }}
                </a>
            </div>
        </div>
    </div>

    <!-- Form Card -->
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700">
        <form action="{{ route('admin.faqs.store') }}" method="POST" class="p-6">
            @csrf
            
            <!-- Error Messages -->
            @if($errors->any())
                <div class="mb-6 bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-lg" role="alert">
                    <div class="flex items-start">
                        <i class="fas fa-exclamation-circle mr-2 mt-0.5"></i>
                        <div>
                            <h4 class="font-medium mb-1">{{ __('admin.validation_errors') }}</h4>
                            <ul class="list-disc list-inside text-sm space-y-1">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            @endif

            <!-- Questions Section -->
            <div class="mb-8">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">{{ __('admin.questions') }}</h3>
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                    <!-- Arabic Question -->
                    <div class="space-y-2">
                        <label for="question_ar" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                            {{ __('admin.question') }} ({{ __('admin.arabic') }}) <span class="text-red-500">*</span>
                        </label>
                        <textarea id="question_ar" name="question_ar" rows="3" required
                                  class="block w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 @error('question_ar') border-red-500 @enderror"
                                  placeholder="{{ __('admin.enter_question_arabic') }}" dir="rtl">{{ old('question_ar') }}</textarea>
                        @error('question_ar')
                            <p class="text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- English Question -->
                    <div class="space-y-2">
                        <label for="question_en" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                            {{ __('admin.question') }} ({{ __('admin.english') }}) <span class="text-red-500">*</span>
                        </label>
                        <textarea id="question_en" name="question_en" rows="3" required
                                  class="block w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 @error('question_en') border-red-500 @enderror"
                                  placeholder="{{ __('admin.enter_question_english') }}">{{ old('question_en') }}</textarea>
                        @error('question_en')
                            <p class="text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Answers Section -->
            <div class="mb-8">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">{{ __('admin.answers') }}</h3>
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                    <!-- Arabic Answer -->
                    <div class="space-y-2">
                        <label for="answer_ar" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                            {{ __('admin.answer') }} ({{ __('admin.arabic') }}) <span class="text-red-500">*</span>
                        </label>
                        <textarea id="answer_ar" name="answer_ar" rows="6" required
                                  class="block w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 @error('answer_ar') border-red-500 @enderror"
                                  placeholder="{{ __('admin.enter_answer_arabic') }}" dir="rtl">{{ old('answer_ar') }}</textarea>
                        @error('answer_ar')
                            <p class="text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- English Answer -->
                    <div class="space-y-2">
                        <label for="answer_en" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                            {{ __('admin.answer') }} ({{ __('admin.english') }}) <span class="text-red-500">*</span>
                        </label>
                        <textarea id="answer_en" name="answer_en" rows="6" required
                                  class="block w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 @error('answer_en') border-red-500 @enderror"
                                  placeholder="{{ __('admin.enter_answer_english') }}">{{ old('answer_en') }}</textarea>
                        @error('answer_en')
                            <p class="text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Settings Section -->
            <div class="mb-8">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">{{ __('admin.settings') }}</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Display Order -->
                    <div class="space-y-2">
                        <label for="order" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                            {{ __('admin.display_order') }}
                        </label>
                        <input type="number" id="order" name="order" min="0" value="{{ old('order', 0) }}"
                               class="block w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 @error('order') border-red-500 @enderror"
                               placeholder="0">
                        <p class="text-xs text-gray-500 dark:text-gray-400">{{ __('admin.lower_numbers_first') }}</p>
                        @error('order')
                            <p class="text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Status -->
                    <div class="space-y-2">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                            {{ __('admin.status') }}
                        </label>
                        <div class="flex items-center">
                            <label class="relative inline-flex items-center cursor-pointer">
                                <input type="checkbox" name="is_active" value="1" {{ old('is_active', true) ? 'checked' : '' }} class="sr-only peer">
                                <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600"></div>
                                <span class="ml-3 text-sm font-medium text-gray-700 dark:text-gray-300">{{ __('admin.visible_on_website') }}</span>
                            </label>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Form Actions -->
            <div class="flex items-center justify-end space-x-4 pt-6 border-t border-gray-200 dark:border-gray-700">
                <a href="{{ route('admin.faqs.index') }}" 
                   class="inline-flex items-center px-4 py-2 border border-gray-300 text-gray-700 bg-white hover:bg-gray-50 text-sm font-medium rounded-lg transition-colors duration-200 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-600 dark:hover:bg-gray-600">
                    {{ __('admin.cancel') }}
                </a>
                <button type="submit" 
                        class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded-lg transition-colors duration-200">
                    <i class="fas fa-save w-4 h-4 mr-2"></i>
                    {{ __('admin.create_faq') }}
                </button>
            </div>
        </form>
    </div>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Auto-resize textareas
    const textareas = document.querySelectorAll('textarea');
    textareas.forEach(textarea => {
        textarea.addEventListener('input', function() {
            this.style.height = 'auto';
            this.style.height = this.scrollHeight + 'px';
        });
    });
});
</script>
@endpush
@endsection

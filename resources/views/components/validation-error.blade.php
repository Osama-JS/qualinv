@props([
    'field' => null,
    'message' => null,
    'show' => true,
    'animated' => true
])

@php
    $errorMessage = $message ?? ($field ? $errors->first($field) : null);
    $hasError = !empty($errorMessage);
    $errorId = 'error-' . ($field ?? uniqid());
@endphp

@if($hasError && $show)
<div id="{{ $errorId }}" 
     class="validation-error mt-2 {{ $animated ? 'animate-fade-in' : '' }}"
     role="alert"
     aria-live="polite">
    <div class="flex items-start p-3 bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800 rounded-lg">
        <div class="flex-shrink-0 {{ app()->getLocale() == 'ar' ? 'ml-2' : 'mr-2' }}">
            <i class="fas fa-exclamation-triangle text-red-500 dark:text-red-400"></i>
        </div>
        <div class="flex-1 min-w-0">
            <p class="text-sm text-red-600 dark:text-red-400 {{ app()->getLocale() == 'ar' ? 'font-arabic-normal' : 'font-english' }}">
                {{ $errorMessage }}
            </p>
        </div>
        <div class="flex-shrink-0 {{ app()->getLocale() == 'ar' ? 'mr-2' : 'ml-2' }}">
            <button type="button" 
                    class="inline-flex rounded-md p-1 text-red-400 hover:text-red-600 dark:hover:text-red-300 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 focus:ring-offset-red-50 dark:focus:ring-offset-red-900/20 transition-colors duration-200"
                    onclick="this.parentElement.parentElement.parentElement.style.display='none'"
                    aria-label="{{ __('admin.dismiss_error') }}">
                <i class="fas fa-times text-xs"></i>
            </button>
        </div>
    </div>
</div>

@if($animated)
<style>
@keyframes fade-in {
    from {
        opacity: 0;
        transform: translateY(-10px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.animate-fade-in {
    animation: fade-in 0.3s ease-out;
}
</style>
@endif
@endif

@props([
    'type' => 'info',
    'title' => null,
    'dismissible' => true,
    'icon' => null,
    'size' => 'normal'
])

@php
    $typeClasses = [
        'success' => 'bg-green-50 border-green-200 text-green-800 dark:bg-green-900/20 dark:border-green-800 dark:text-green-200',
        'error' => 'bg-red-50 border-red-200 text-red-800 dark:bg-red-900/20 dark:border-red-800 dark:text-red-200',
        'warning' => 'bg-yellow-50 border-yellow-200 text-yellow-800 dark:bg-yellow-900/20 dark:border-yellow-800 dark:text-yellow-200',
        'info' => 'bg-blue-50 border-blue-200 text-blue-800 dark:bg-blue-900/20 dark:border-blue-800 dark:text-blue-200'
    ];
    
    $iconClasses = [
        'success' => 'text-green-500 dark:text-green-400',
        'error' => 'text-red-500 dark:text-red-400',
        'warning' => 'text-yellow-500 dark:text-yellow-400',
        'info' => 'text-blue-500 dark:text-blue-400'
    ];
    
    $defaultIcons = [
        'success' => 'fas fa-check-circle',
        'error' => 'fas fa-exclamation-circle',
        'warning' => 'fas fa-exclamation-triangle',
        'info' => 'fas fa-info-circle'
    ];
    
    $sizeClasses = [
        'small' => 'p-3 text-sm',
        'normal' => 'p-4',
        'large' => 'p-6 text-lg'
    ];
    
    $currentIcon = $icon ?? $defaultIcons[$type];
    $alertId = 'alert-' . uniqid();
@endphp

<div id="{{ $alertId }}" 
     class="alert-component border rounded-lg {{ $typeClasses[$type] }} {{ $sizeClasses[$size] }} transition-all duration-300 ease-in-out transform"
     role="alert"
     aria-live="polite"
     x-data="{ show: true }"
     x-show="show"
     x-transition:enter="transition ease-out duration-300"
     x-transition:enter-start="opacity-0 transform scale-95"
     x-transition:enter-end="opacity-100 transform scale-100"
     x-transition:leave="transition ease-in duration-200"
     x-transition:leave-start="opacity-100 transform scale-100"
     x-transition:leave-end="opacity-0 transform scale-95">
    
    <div class="flex items-start">
        <!-- Icon -->
        <div class="flex-shrink-0 {{ app()->getLocale() == 'ar' ? 'ml-3' : 'mr-3' }}">
            <i class="{{ $currentIcon }} {{ $iconClasses[$type] }} text-xl"></i>
        </div>
        
        <!-- Content -->
        <div class="flex-1 min-w-0">
            @if($title)
                <h3 class="font-semibold {{ app()->getLocale() == 'ar' ? 'font-arabic-medium' : 'font-english' }} mb-1">
                    {{ $title }}
                </h3>
            @endif
            
            <div class="{{ app()->getLocale() == 'ar' ? 'font-arabic-normal text-arabic-base' : 'font-english' }}">
                {{ $slot }}
            </div>
        </div>
        
        <!-- Dismiss Button -->
        @if($dismissible)
            <div class="flex-shrink-0 {{ app()->getLocale() == 'ar' ? 'mr-3' : 'ml-3' }}">
                <button type="button" 
                        class="inline-flex rounded-md p-1.5 hover:bg-black/5 dark:hover:bg-white/5 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-transparent focus:ring-current transition-colors duration-200"
                        @click="show = false"
                        aria-label="{{ __('admin.dismiss') }}">
                    <i class="fas fa-times text-current opacity-60 hover:opacity-100"></i>
                </button>
            </div>
        @endif
    </div>
</div>

@if($dismissible)
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Auto-dismiss after 7 seconds for success messages
    @if($type === 'success')
        setTimeout(function() {
            const alert = document.getElementById('{{ $alertId }}');
            if (alert && alert.style.display !== 'none') {
                alert.style.transition = 'all 0.5s ease-out';
                alert.style.opacity = '0';
                alert.style.transform = 'translateY(-10px)';
                setTimeout(function() {
                    alert.style.display = 'none';
                }, 500);
            }
        }, 7000);
    @endif
    
    // Auto-dismiss after 10 seconds for info messages
    @if($type === 'info')
        setTimeout(function() {
            const alert = document.getElementById('{{ $alertId }}');
            if (alert && alert.style.display !== 'none') {
                alert.style.transition = 'all 0.5s ease-out';
                alert.style.opacity = '0';
                alert.style.transform = 'translateY(-10px)';
                setTimeout(function() {
                    alert.style.display = 'none';
                }, 500);
            }
        }, 10000);
    @endif
});
</script>
@endif

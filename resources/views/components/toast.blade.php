@props([
    'type' => 'info',
    'title' => null,
    'duration' => 5000,
    'position' => 'top-right'
])

@php
    $typeClasses = [
        'success' => 'bg-green-500 text-white',
        'error' => 'bg-red-500 text-white',
        'warning' => 'bg-yellow-500 text-white',
        'info' => 'bg-blue-500 text-white'
    ];
    
    $iconClasses = [
        'success' => 'fas fa-check-circle',
        'error' => 'fas fa-exclamation-circle',
        'warning' => 'fas fa-exclamation-triangle',
        'info' => 'fas fa-info-circle'
    ];
    
    $positionClasses = [
        'top-right' => 'top-4 right-4',
        'top-left' => 'top-4 left-4',
        'bottom-right' => 'bottom-4 right-4',
        'bottom-left' => 'bottom-4 left-4',
        'top-center' => 'top-4 left-1/2 transform -translate-x-1/2',
        'bottom-center' => 'bottom-4 left-1/2 transform -translate-x-1/2'
    ];
    
    $toastId = 'toast-' . uniqid();
@endphp

<div id="{{ $toastId }}" 
     class="fixed {{ $positionClasses[$position] }} z-50 max-w-sm w-full shadow-lg rounded-lg pointer-events-auto {{ $typeClasses[$type] }} transform transition-all duration-300 ease-in-out"
     role="alert"
     aria-live="assertive"
     aria-atomic="true"
     x-data="{ show: true }"
     x-show="show"
     x-transition:enter="transition ease-out duration-300"
     x-transition:enter-start="opacity-0 transform scale-95 translate-y-2"
     x-transition:enter-end="opacity-100 transform scale-100 translate-y-0"
     x-transition:leave="transition ease-in duration-200"
     x-transition:leave-start="opacity-100 transform scale-100 translate-y-0"
     x-transition:leave-end="opacity-0 transform scale-95 translate-y-2">
    
    <div class="p-4">
        <div class="flex items-start">
            <!-- Icon -->
            <div class="flex-shrink-0 {{ app()->getLocale() == 'ar' ? 'ml-3' : 'mr-3' }}">
                <i class="{{ $iconClasses[$type] }} text-lg"></i>
            </div>
            
            <!-- Content -->
            <div class="flex-1 min-w-0">
                @if($title)
                    <p class="font-semibold {{ app()->getLocale() == 'ar' ? 'font-arabic-medium' : 'font-english' }} mb-1">
                        {{ $title }}
                    </p>
                @endif
                
                <div class="text-sm {{ app()->getLocale() == 'ar' ? 'font-arabic-normal' : 'font-english' }}">
                    {{ $slot }}
                </div>
            </div>
            
            <!-- Close Button -->
            <div class="flex-shrink-0 {{ app()->getLocale() == 'ar' ? 'mr-3' : 'ml-3' }}">
                <button type="button" 
                        class="inline-flex rounded-md p-1.5 hover:bg-black/10 focus:outline-none focus:ring-2 focus:ring-white/50 transition-colors duration-200"
                        @click="show = false"
                        aria-label="{{ __('admin.dismiss') }}">
                    <i class="fas fa-times text-current opacity-70 hover:opacity-100"></i>
                </button>
            </div>
        </div>
    </div>
    
    <!-- Progress Bar -->
    <div class="h-1 bg-black/10 rounded-b-lg overflow-hidden">
        <div id="{{ $toastId }}-progress" 
             class="h-full bg-white/30 transition-all duration-100 ease-linear" 
             style="width: 100%"></div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const toast = document.getElementById('{{ $toastId }}');
    const progressBar = document.getElementById('{{ $toastId }}-progress');
    const duration = {{ $duration }};
    
    if (toast && progressBar && duration > 0) {
        let startTime = Date.now();
        
        function updateProgress() {
            const elapsed = Date.now() - startTime;
            const progress = Math.max(0, 100 - (elapsed / duration) * 100);
            
            progressBar.style.width = progress + '%';
            
            if (progress > 0) {
                requestAnimationFrame(updateProgress);
            } else {
                // Auto-dismiss
                toast.style.transition = 'all 0.3s ease-out';
                toast.style.opacity = '0';
                toast.style.transform = 'scale(0.95) translateY(-10px)';
                setTimeout(function() {
                    if (toast.parentNode) {
                        toast.parentNode.removeChild(toast);
                    }
                }, 300);
            }
        }
        
        requestAnimationFrame(updateProgress);
    }
});
</script>

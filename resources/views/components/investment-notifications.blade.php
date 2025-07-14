@php
    $recentApplications = \App\Models\InvestmentApplication::with(['readBy', 'assignedTo'])
        ->where('created_at', '>=', now()->subHours(24))
        ->orderBy('created_at', 'desc')
        ->limit(5)
        ->get();

    $unreadCount = \App\Models\InvestmentApplication::unread()->count();
    $pendingCount = \App\Models\InvestmentApplication::pending()->count();
@endphp

<div class="relative" x-data="{ open: false }">
    <!-- Notification Bell -->
    <button @click="open = !open"
            class="relative p-2 text-gray-600 hover:text-gray-900 dark:text-gray-300 dark:hover:text-white focus:outline-none focus:ring-2 focus:ring-blue-500 rounded-lg transition-colors duration-200">
        <i class="fas fa-bell text-xl"></i>
        @if($unreadCount > 0)
            <span class="absolute -top-1 -right-1 inline-flex items-center justify-center px-2 py-1 text-xs font-bold leading-none text-white bg-red-600 rounded-full">
                {{ $unreadCount > 99 ? '99+' : $unreadCount }}
            </span>
        @endif
    </button>

    <!-- Notification Dropdown -->
    <div x-show="open"
         @click.away="open = false"
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="opacity-0 scale-95"
         x-transition:enter-end="opacity-100 scale-100"
         x-transition:leave="transition ease-in duration-150"
         x-transition:leave-start="opacity-100 scale-100"
         x-transition:leave-end="opacity-0 scale-95"
         class="absolute {{ app()->getLocale() == 'ar' ? 'left-0' : 'right-0' }} mt-2 w-96 bg-white dark:bg-gray-800 rounded-lg shadow-lg border border-gray-200 dark:border-gray-700 z-50">

        <!-- Header -->
        <div class="px-4 py-3 border-b border-gray-200 dark:border-gray-700">
            <div class="flex items-center justify-between">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white {{ app()->getLocale() == 'ar' ? 'font-arabic-medium' : 'font-english' }}">
                    {{ __('admin.notifications') }}
                </h3>
                @if($unreadCount > 0)
                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200">
                        {{ $unreadCount }} {{ __('admin.unread') }}
                    </span>
                @endif
            </div>
        </div>

        <!-- Quick Stats -->
        <div class="px-4 py-3 bg-gray-50 dark:bg-gray-700 border-b border-gray-200 dark:border-gray-600">
            <div class="grid grid-cols-2 gap-4 text-center">
                <div>
                    <div class="text-2xl font-bold text-blue-600 dark:text-blue-400">{{ $unreadCount }}</div>
                    <div class="text-xs text-gray-600 dark:text-gray-400 {{ app()->getLocale() == 'ar' ? 'font-arabic-normal' : 'font-english' }}">{{ __('admin.unread_applications') }}</div>
                </div>
                <div>
                    <div class="text-2xl font-bold text-orange-600 dark:text-orange-400">{{ $pendingCount }}</div>
                    <div class="text-xs text-gray-600 dark:text-gray-400 {{ app()->getLocale() == 'ar' ? 'font-arabic-normal' : 'font-english' }}">{{ __('admin.pending_review') }}</div>
                </div>
            </div>
        </div>

        <!-- Recent Applications -->
        <div class="max-h-96 overflow-y-auto">
            @forelse($recentApplications as $application)
                <div class="px-4 py-3 border-b border-gray-100 dark:border-gray-600 hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors duration-200">
                    <div class="flex items-start justify-between">
                        <div class="flex-1 min-w-0">
                            <div class="flex items-center gap-2 mb-1">
                                @if(!$application->is_read)
                                    <div class="w-2 h-2 bg-blue-500 rounded-full flex-shrink-0"></div>
                                @endif
                                <p class="text-sm font-medium text-gray-900 dark:text-white truncate {{ app()->getLocale() == 'ar' ? 'font-arabic-medium' : 'font-english' }}">
                                    {{ __('admin.new_application') }}
                                </p>
                            </div>
                            <p class="text-sm text-gray-600 dark:text-gray-400 {{ app()->getLocale() == 'ar' ? 'font-arabic-normal' : 'font-english' }}">
                                {{ $application->applicant_name }}
                            </p>
                            <p class="text-xs text-gray-500 dark:text-gray-500 font-mono">
                                {{ $application->reference_number }}
                            </p>
                            <div class="flex items-center gap-2 mt-1">
                                <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium
                                    {{ $application->applicant_type === 'saudi_individual' ? 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200' : 'bg-purple-100 text-purple-800 dark:bg-purple-900 dark:text-purple-200' }}">
                                    {{ $application->applicant_type === 'saudi_individual' ? __('admin.individual') : __('admin.company') }}
                                </span>
                                <span class="text-xs text-gray-500 dark:text-gray-500">
                                    {{ number_format($application->number_of_shares) }} {{ __('admin.shares') }}
                                </span>
                            </div>
                        </div>
                        <div class="flex flex-col items-end {{ app()->getLocale() == 'ar' ? 'mr-3' : 'ml-3' }}">
                            <span class="text-xs text-gray-500 dark:text-gray-500">
                                {{ $application->created_at->diffForHumans() }}
                            </span>
                            <a href="{{ route('admin.investment-applications.show', $application) }}"
                               class="text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-300 text-xs mt-1">
                                {{ __('admin.view') }}
                            </a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="px-4 py-8 text-center">
                    <i class="fas fa-inbox text-gray-400 text-3xl mb-2"></i>
                    <p class="text-sm text-gray-500 dark:text-gray-400 {{ app()->getLocale() == 'ar' ? 'font-arabic-normal' : 'font-english' }}">
                        {{ __('admin.no_recent_applications') }}
                    </p>
                </div>
            @endforelse
        </div>

        <!-- Footer -->
        <div class="px-4 py-3 bg-gray-50 dark:bg-gray-700 border-t border-gray-200 dark:border-gray-600">
            <div class="flex items-center justify-between">
                <a href="{{ route('admin.investment-applications.index') }}"
                   class="text-sm text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-300 font-medium {{ app()->getLocale() == 'ar' ? 'font-arabic-medium' : 'font-english' }}">
                    {{ __('admin.view_all_applications') }}
                </a>
                @if($unreadCount > 0)
                    <button onclick="markAllAsRead()"
                            class="text-sm text-gray-600 hover:text-gray-800 dark:text-gray-400 dark:hover:text-gray-300 {{ app()->getLocale() == 'ar' ? 'font-arabic-normal' : 'font-english' }}">
                        {{ __('admin.mark_all_read') }}
                    </button>
                @endif
            </div>
        </div>
    </div>
</div>

<script>
// Auto-refresh notifications every 30 seconds
setInterval(function() {
    // In a real application, this would make an AJAX call to refresh the notification count
    // For now, we'll just reload the page if there are new applications
    fetch('{{ route("admin.investment-applications.stats") }}')
        .then(response => response.json())
        .then(data => {
            // Update notification badge if needed
            const currentUnread = {{ $unreadCount }};
            if (data.unread_applications > currentUnread) {
                // Show toast notification for new applications
                showToast('info', '{{ __("admin.new_applications_received") }}', '{{ __("admin.notifications") }}');

                // Optionally reload the page or update the UI
                setTimeout(() => {
                    window.location.reload();
                }, 2000);
            }
        })
        .catch(error => console.log('Notification refresh error:', error));
}, 30000);

// Mark all notifications as read
function markAllAsRead() {
    if (confirm('{{ __("admin.confirm_mark_all_read") }}')) {
        fetch('{{ route("admin.investment-applications.bulk-action") }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({
                application_ids: @json($recentApplications->where('is_read', false)->pluck('id')),
                action: 'mark_read'
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                window.location.reload();
            }
        })
        .catch(error => console.log('Mark as read error:', error));
    }
}
</script>

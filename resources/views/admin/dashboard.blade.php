@extends('layouts.admin')

@section('page-title', __('admin.dashboard'))

@section('content')
<div class="mb-8">
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-4xl font-bold text-gray-900 dark:text-gray-100">{{ __('admin.dashboard') }}</h1>
            <p class="text-gray-600 dark:text-gray-400 mt-2">{{ __('admin.dashboard_welcome') }}</p>
        </div>
        <div class="flex items-center space-x-4">
            <div class="bg-gradient-to-r from-blue-500 to-purple-600 text-white px-4 py-2 rounded-lg">
                <div class="text-sm">{{ __('admin.share_price') }}</div>
                <div class="text-xl font-bold">{{ $site_settings['share_price'] }} {{ $site_settings['currency'] }}</div>
            </div>
            @if($site_settings['maintenance_mode'])
                <div class="bg-red-100 text-red-800 px-3 py-1 rounded-full text-sm font-medium">
                    <i class="fas fa-tools mr-1"></i>
                    {{ __('admin.maintenance_mode') }}
                </div>
            @endif
        </div>
    </div>
</div>

<!-- Main Statistics Cards -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
    <!-- Users Card -->
    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-lg rounded-xl border border-gray-200 dark:border-gray-700">
        <div class="p-6">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <div class="w-12 h-12 bg-blue-100 dark:bg-blue-900 rounded-lg flex items-center justify-center">
                        <i class="fas fa-users text-blue-600 dark:text-blue-400 text-xl"></i>
                    </div>
                </div>
                <div class="ml-4 flex-1">
                    <div class="text-sm font-medium text-gray-500 dark:text-gray-400">
                        {{ __('admin.total_users') }}
                    </div>
                    <div class="text-2xl font-bold text-gray-900 dark:text-gray-100">
                        {{ number_format($stats['total_users']) }}
                    </div>
                    <div class="text-sm text-green-600 dark:text-green-400">
                        +{{ $monthly_stats['users_this_month'] }} {{ __('admin.this_month') }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Articles Card -->
    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-lg rounded-xl border border-gray-200 dark:border-gray-700">
        <div class="p-6">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <div class="w-12 h-12 bg-green-100 dark:bg-green-900 rounded-lg flex items-center justify-center">
                        <i class="fas fa-newspaper text-green-600 dark:text-green-400 text-xl"></i>
                    </div>
                </div>
                <div class="ml-4 flex-1">
                    <div class="text-sm font-medium text-gray-500 dark:text-gray-400">
                        {{ __('admin.total_articles') }}
                    </div>
                    <div class="text-2xl font-bold text-gray-900 dark:text-gray-100">
                        {{ number_format($stats['total_articles']) }}
                    </div>
                    <div class="text-sm text-blue-600 dark:text-blue-400">
                        {{ $stats['published_articles'] }} {{ __('admin.published') }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Board Directors Card -->
    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-lg rounded-xl border border-gray-200 dark:border-gray-700">
        <div class="p-6">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <div class="w-12 h-12 bg-purple-100 dark:bg-purple-900 rounded-lg flex items-center justify-center">
                        <i class="fas fa-user-tie text-purple-600 dark:text-purple-400 text-xl"></i>
                    </div>
                </div>
                <div class="ml-4 flex-1">
                    <div class="text-sm font-medium text-gray-500 dark:text-gray-400">
                        {{ __('admin.board_directors') }}
                    </div>
                    <div class="text-2xl font-bold text-gray-900 dark:text-gray-100">
                        {{ number_format($stats['total_board_directors']) }}
                    </div>
                    <div class="text-sm text-green-600 dark:text-green-400">
                        {{ $stats['active_board_directors'] }} {{ __('admin.active') }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Applications Card -->
    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-lg rounded-xl border border-gray-200 dark:border-gray-700">
        <div class="p-6">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <div class="w-12 h-12 bg-orange-100 dark:bg-orange-900 rounded-lg flex items-center justify-center">
                        <i class="fas fa-file-invoice-dollar text-orange-600 dark:text-orange-400 text-xl"></i>
                    </div>
                </div>
                <div class="ml-4 flex-1">
                    <div class="text-sm font-medium text-gray-500 dark:text-gray-400">
                        {{ __('admin.investment_applications') }}
                    </div>
                    <div class="text-2xl font-bold text-gray-900 dark:text-gray-100">
                        {{ number_format($stats['total_applications']) }}
                    </div>
                    <div class="text-sm text-yellow-600 dark:text-yellow-400">
                        {{ $stats['pending_applications'] }} {{ __('admin.pending') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Charts Section -->
<div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-8">
    <!-- Articles Chart -->
    <div class="bg-white dark:bg-gray-800 shadow-lg rounded-xl border border-gray-200 dark:border-gray-700">
        <div class="p-6">
            <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-4">
                {{ __('admin.articles_over_time') }}
            </h3>
            <canvas id="articlesChart" width="400" height="200"></canvas>
        </div>
    </div>

    <!-- Applications Chart -->
    <div class="bg-white dark:bg-gray-800 shadow-lg rounded-xl border border-gray-200 dark:border-gray-700">
        <div class="p-6">
            <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-4">
                {{ __('admin.applications_over_time') }}
            </h3>
            <canvas id="applicationsChart" width="400" height="200"></canvas>
        </div>
    </div>
</div>

<!-- Recent Activities -->
<div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
    <!-- Recent Articles -->
    <div class="bg-white dark:bg-gray-800 shadow-lg rounded-xl border border-gray-200 dark:border-gray-700">
        <div class="p-6">
            <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-4">
                {{ __('admin.recent_articles') }}
            </h3>
            <div class="space-y-4">
                @forelse($recent_articles as $article)
                    <div class="flex items-center space-x-3">
                        <div class="w-2 h-2 bg-green-500 rounded-full"></div>
                        <div class="flex-1">
                            <p class="text-sm font-medium text-gray-900 dark:text-gray-100 truncate">
                                {{ $article->getLocalizedTitle() }}
                            </p>
                            <p class="text-xs text-gray-500 dark:text-gray-400">
                                {{ $article->created_at->diffForHumans() }}
                            </p>
                        </div>
                    </div>
                @empty
                    <p class="text-gray-500 dark:text-gray-400 text-sm">{{ __('admin.no_recent_articles') }}</p>
                @endforelse
            </div>
        </div>
    </div>

    <!-- Recent Applications -->
    <div class="bg-white dark:bg-gray-800 shadow-lg rounded-xl border border-gray-200 dark:border-gray-700">
        <div class="p-6">
            <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-4">
                {{ __('admin.recent_applications') }}
            </h3>
            <div class="space-y-4">
                @forelse($recent_applications as $application)
                    <div class="flex items-center space-x-3">
                        <div class="w-2 h-2 bg-orange-500 rounded-full"></div>
                        <div class="flex-1">
                            <p class="text-sm font-medium text-gray-900 dark:text-gray-100 truncate">
                                {{ $application->applicant_name }}
                            </p>
                            <p class="text-xs text-gray-500 dark:text-gray-400">
                                {{ $application->created_at->diffForHumans() }}
                            </p>
                        </div>
                    </div>
                @empty
                    <p class="text-gray-500 dark:text-gray-400 text-sm">{{ __('admin.no_recent_applications') }}</p>
                @endforelse
            </div>
        </div>
    </div>

    <!-- Recent Users -->
    <div class="bg-white dark:bg-gray-800 shadow-lg rounded-xl border border-gray-200 dark:border-gray-700">
        <div class="p-6">
            <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-4">
                {{ __('admin.recent_users') }}
            </h3>
            <div class="space-y-4">
                @forelse($recent_users as $user)
                    <div class="flex items-center space-x-3">
                        <div class="w-2 h-2 bg-blue-500 rounded-full"></div>
                        <div class="flex-1">
                            <p class="text-sm font-medium text-gray-900 dark:text-gray-100 truncate">
                                {{ $user->name }}
                            </p>
                            <p class="text-xs text-gray-500 dark:text-gray-400">
                                {{ $user->created_at->diffForHumans() }}
                            </p>
                        </div>
                    </div>
                @empty
                    <p class="text-gray-500 dark:text-gray-400 text-sm">{{ __('admin.no_recent_users') }}</p>
                @endforelse
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Articles Chart
    const articlesCtx = document.getElementById('articlesChart').getContext('2d');
    new Chart(articlesCtx, {
        type: 'line',
        data: {
            labels: {!! json_encode(array_column($articles_chart_data, 'date')) !!},
            datasets: [{
                label: '{{ __("admin.articles") }}',
                data: {!! json_encode(array_column($articles_chart_data, 'count')) !!},
                borderColor: 'rgb(34, 197, 94)',
                backgroundColor: 'rgba(34, 197, 94, 0.1)',
                tension: 0.4
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    display: false
                }
            },
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });

    // Applications Chart
    const applicationsCtx = document.getElementById('applicationsChart').getContext('2d');
    new Chart(applicationsCtx, {
        type: 'line',
        data: {
            labels: {!! json_encode(array_column($applications_chart_data, 'date')) !!},
            datasets: [{
                label: '{{ __("admin.applications") }}',
                data: {!! json_encode(array_column($applications_chart_data, 'count')) !!},
                borderColor: 'rgb(249, 115, 22)',
                backgroundColor: 'rgba(249, 115, 22, 0.1)',
                tension: 0.4
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    display: false
                }
            },
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
});
</script>
@endpush

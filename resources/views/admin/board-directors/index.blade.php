@extends('layouts.admin')

@section('page-title', __('admin.board_of_directors'))

@section('content')
<div class="mb-6">
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-3xl font-bold text-gray-900 dark:text-gray-100">{{ __('admin.board_of_directors') }}</h1>
            <p class="text-gray-600 dark:text-gray-400">{{ __('admin.manage_board_directors') }}</p>
        </div>
        <a href="{{ route('admin.board-directors.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg transition-colors">
            <i class="fas fa-plus mr-2"></i>
            {{ __('admin.add_board_director') }}
        </a>
    </div>
</div>

<!-- Filters -->
<div class="bg-white dark:bg-gray-800 shadow-sm rounded-lg mb-6">
    <div class="p-6">
        <form method="GET" action="{{ route('admin.board-directors.index') }}" class="grid grid-cols-1 md:grid-cols-4 gap-4">
            <div>
                <label for="search" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                    {{ __('admin.search') }}
                </label>
                <input type="text" name="search" id="search" value="{{ request('search') }}"
                       class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-gray-100"
                       placeholder="{{ __('admin.search_board_directors') }}">
            </div>

            <div>
                <label for="status" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                    {{ __('admin.status') }}
                </label>
                <select name="status" id="status"
                        class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-gray-100">
                    <option value="">{{ __('admin.all_statuses') }}</option>
                    <option value="1" {{ request('status') === '1' ? 'selected' : '' }}>{{ __('admin.active') }}</option>
                    <option value="0" {{ request('status') === '0' ? 'selected' : '' }}>{{ __('admin.inactive') }}</option>
                </select>
            </div>

            <div>
                <label for="sort" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                    {{ __('admin.sort_by') }}
                </label>
                <select name="sort" id="sort"
                        class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-gray-100">
                    <option value="sort_order" {{ request('sort', 'sort_order') === 'sort_order' ? 'selected' : '' }}>{{ __('admin.sort_order') }}</option>
                    <option value="name" {{ request('sort') === 'name' ? 'selected' : '' }}>{{ __('admin.name') }}</option>
                    <option value="created_at" {{ request('sort') === 'created_at' ? 'selected' : '' }}>{{ __('admin.created_at') }}</option>
                </select>
            </div>

            <div class="flex items-end">
                <button type="submit" class="w-full bg-gray-600 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded-lg transition-colors">
                    <i class="fas fa-search mr-2"></i>
                    {{ __('admin.filter') }}
                </button>
            </div>
        </form>
    </div>
</div>

@if($boardDirectors->count() > 0)
<div class="bg-white dark:bg-gray-800 shadow-sm rounded-lg overflow-hidden">
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700 board-directors-table">
            <thead class="bg-gray-50 dark:bg-gray-700">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider w-20">
                        {{ __('admin.photo') }}
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                        {{ __('admin.board_director') }}
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                        {{ __('admin.contact') }}
                    </th>
                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider w-24">
                        {{ __('admin.status') }}
                    </th>
                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider w-20">
                        {{ __('admin.order') }}
                    </th>
                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider w-32">
                        {{ __('admin.actions') }}
                    </th>
                </tr>
            </thead>
            <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                @foreach($boardDirectors as $director)
                <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">
                    <!-- Photo -->
                    <td class="px-6 py-4">
                        <div class="flex-shrink-0">
                            @if($director->photo)
                                <img src="{{ asset('storage/' . $director->photo) }}" alt="{{ $director->getLocalizedName() }}"
                                     class="h-16 w-16 rounded-full object-cover border-2 border-gray-200 dark:border-gray-600 shadow-sm director-photo">
                            @else
                                <div class="h-16 w-16 rounded-full bg-gradient-to-br from-gray-300 to-gray-400 dark:from-gray-600 dark:to-gray-700 flex items-center justify-center border-2 border-gray-200 dark:border-gray-600 shadow-sm director-photo">
                                    <i class="fas fa-user-tie text-gray-500 dark:text-gray-400 text-xl"></i>
                                </div>
                            @endif
                        </div>
                    </td>

                    <!-- Name and Position -->
                    <td class="px-6 py-4">
                        <div class="space-y-1">
                            <div class="text-sm font-semibold text-gray-900 dark:text-gray-100">
                                {{ $director->getLocalizedName() }}
                            </div>
                            <div class="text-xs text-gray-500 dark:text-gray-400">
                                {{ $director->getLocalizedName(app()->getLocale() === 'ar' ? 'en' : 'ar') }}
                            </div>
                            <div class="text-sm text-blue-600 dark:text-blue-400 font-medium">
                                {{ $director->getLocalizedPosition() }}
                            </div>
                            <div class="text-xs text-gray-500 dark:text-gray-400">
                                {{ $director->getLocalizedPosition(app()->getLocale() === 'ar' ? 'en' : 'ar') }}
                            </div>
                        </div>
                    </td>

                    <!-- Contact -->
                    <td class="px-6 py-4">
                        <div class="space-y-1">
                            @if($director->email)
                                <div class="flex items-center text-sm text-gray-600 dark:text-gray-400">
                                    <i class="fas fa-envelope text-gray-400 mr-2 w-4"></i>
                                    <a href="mailto:{{ $director->email }}" class="hover:text-blue-600 dark:hover:text-blue-400 transition-colors contact-link">
                                        {{ $director->email }}
                                    </a>
                                </div>
                            @endif
                            @if($director->phone)
                                <div class="flex items-center text-sm text-gray-600 dark:text-gray-400">
                                    <i class="fas fa-phone text-gray-400 mr-2 w-4"></i>
                                    <a href="tel:{{ $director->phone }}" class="hover:text-blue-600 dark:hover:text-blue-400 transition-colors contact-link">
                                        {{ $director->phone }}
                                    </a>
                                </div>
                            @endif
                            @if(!$director->email && !$director->phone)
                                <span class="text-sm text-gray-400 dark:text-gray-500">{{ __('admin.no_contact_info') }}</span>
                            @endif
                        </div>
                    </td>

                    <!-- Status -->
                    <td class="px-6 py-4 text-center">
                        @if($director->is_active)
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200 status-badge">
                                <i class="fas fa-check-circle mr-1"></i>
                                {{ __('admin.active') }}
                            </span>
                        @else
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200 status-badge">
                                <i class="fas fa-times-circle mr-1"></i>
                                {{ __('admin.inactive') }}
                            </span>
                        @endif
                    </td>

                    <!-- Sort Order -->
                    <td class="px-6 py-4 text-center">
                        <span class="inline-flex items-center justify-center w-8 h-8 bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300 rounded-full text-sm font-medium">
                            {{ $director->sort_order }}
                        </span>
                    </td>

                    <!-- Actions -->
                    <td class="px-6 py-4">
                        <div class="flex items-center justify-center space-x-3">
                            <a href="{{ route('admin.board-directors.show', $director) }}"
                               class="inline-flex items-center justify-center w-8 h-8 bg-blue-100 hover:bg-blue-200 text-blue-600 hover:text-blue-700 rounded-full transition-colors action-button"
                               title="{{ __('admin.view') }}">
                                <i class="fas fa-eye text-sm"></i>
                            </a>
                            <a href="{{ route('admin.board-directors.edit', $director) }}"
                               class="inline-flex items-center justify-center w-8 h-8 bg-indigo-100 hover:bg-indigo-200 text-indigo-600 hover:text-indigo-700 rounded-full transition-colors action-button"
                               title="{{ __('admin.edit') }}">
                                <i class="fas fa-edit text-sm"></i>
                            </a>
                            <form action="{{ route('admin.board-directors.destroy', $director) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                        class="inline-flex items-center justify-center w-8 h-8 bg-red-100 hover:bg-red-200 text-red-600 hover:text-red-700 rounded-full transition-colors action-button"
                                        title="{{ __('admin.delete') }}"
                                        onclick="return confirm('{{ __('admin.confirm_delete') }}')">
                                    <i class="fas fa-trash text-sm"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    @if($boardDirectors->hasPages())
    <div class="px-6 py-4 border-t border-gray-200 dark:border-gray-700">
        {{ $boardDirectors->appends(request()->query())->links() }}
    </div>
    @endif
</div>
@else
<div class="bg-white dark:bg-gray-800 shadow-sm rounded-lg p-6">
    <div class="text-center">
        <i class="fas fa-user-tie text-gray-400 text-6xl mb-4"></i>
        <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100 mb-2">{{ __('admin.no_board_directors') }}</h3>
        <p class="text-gray-500 dark:text-gray-400 mb-4">{{ __('admin.no_board_directors_description') }}</p>
        <a href="{{ route('admin.board-directors.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg transition-colors">
            <i class="fas fa-plus mr-2"></i>
            {{ __('admin.add_first_board_director') }}
        </a>
    </div>
</div>
@endif
@endsection

@push('styles')
<style>
/* تحسينات إضافية لجدول أعضاء مجلس الإدارة */
.board-directors-table {
    border-collapse: separate;
    border-spacing: 0;
}

.board-directors-table td {
    vertical-align: middle;
}

.director-photo {
    transition: transform 0.2s ease, box-shadow 0.2s ease;
}

.director-photo:hover {
    transform: scale(1.05);
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
}

.action-button {
    transition: all 0.2s ease;
}

.action-button:hover {
    transform: translateY(-1px);
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
}

.status-badge {
    transition: all 0.2s ease;
}

.status-badge:hover {
    transform: scale(1.05);
}

.contact-link {
    transition: all 0.2s ease;
}

.contact-link:hover {
    transform: translateX(2px);
}

/* تحسينات للوضع المظلم */
@media (prefers-color-scheme: dark) {
    .director-photo:hover {
        box-shadow: 0 8px 25px rgba(255, 255, 255, 0.1);
    }

    .action-button:hover {
        box-shadow: 0 4px 12px rgba(255, 255, 255, 0.1);
    }
}

/* تحسينات الاستجابة */
@media (max-width: 768px) {
    .board-directors-table {
        font-size: 0.875rem;
    }

    .director-photo {
        width: 3rem;
        height: 3rem;
    }

    .action-button {
        width: 1.75rem;
        height: 1.75rem;
    }
}
</style>
@endpush

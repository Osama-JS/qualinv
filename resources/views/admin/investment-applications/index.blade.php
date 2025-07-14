@extends('layouts.admin')

@section('title', __('admin.investment_applications'))

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <h1 class="text-2xl font-bold text-gray-900 dark:text-white {{ app()->getLocale() == 'ar' ? 'font-arabic-bold' : 'font-english' }}">
                {{ __('admin.investment_applications') }}
            </h1>
            <p class="text-gray-600 dark:text-gray-400 mt-1 {{ app()->getLocale() == 'ar' ? 'font-arabic-normal' : 'font-english' }}">
                {{ __('admin.manage_investment_applications') }}
            </p>
        </div>
        <div class="flex flex-col sm:flex-row gap-2">
            <button class="export-btn inline-flex items-center px-4 py-2 bg-green-600 hover:bg-green-700 text-white font-medium rounded-lg transition-colors duration-200">
                <i class="fas fa-download {{ app()->getLocale() == 'ar' ? 'ml-2' : 'mr-2' }}"></i>
                {{ __('admin.export') }}
            </button>
            <button class="bulk-actions-btn inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg transition-colors duration-200">
                <i class="fas fa-tasks {{ app()->getLocale() == 'ar' ? 'ml-2' : 'mr-2' }}"></i>
                {{ __('admin.bulk_actions') }}
            </button>
        </div>
    </div>

    <!-- Statistics Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-4">
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700 p-6">
            <div class="flex items-center">
                <div class="p-2 bg-blue-100 dark:bg-blue-900 rounded-lg">
                    <i class="fas fa-file-alt text-blue-600 dark:text-blue-400"></i>
                </div>
                <div class="{{ app()->getLocale() == 'ar' ? 'mr-4' : 'ml-4' }}">
                    <p class="text-sm font-medium text-gray-600 dark:text-gray-400">{{ __('admin.total_applications') }}</p>
                    <p class="text-2xl font-bold text-gray-900 dark:text-white">{{ $stats['total'] }}</p>
                </div>
            </div>
        </div>

        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700 p-6">
            <div class="flex items-center">
                <div class="p-2 bg-yellow-100 dark:bg-yellow-900 rounded-lg">
                    <i class="fas fa-envelope text-yellow-600 dark:text-yellow-400"></i>
                </div>
                <div class="{{ app()->getLocale() == 'ar' ? 'mr-4' : 'ml-4' }}">
                    <p class="text-sm font-medium text-gray-600 dark:text-gray-400">{{ __('admin.unread') }}</p>
                    <p class="text-2xl font-bold text-gray-900 dark:text-white">{{ $stats['unread'] }}</p>
                </div>
            </div>
        </div>

        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700 p-6">
            <div class="flex items-center">
                <div class="p-2 bg-orange-100 dark:bg-orange-900 rounded-lg">
                    <i class="fas fa-clock text-orange-600 dark:text-orange-400"></i>
                </div>
                <div class="{{ app()->getLocale() == 'ar' ? 'mr-4' : 'ml-4' }}">
                    <p class="text-sm font-medium text-gray-600 dark:text-gray-400">{{ __('admin.pending') }}</p>
                    <p class="text-2xl font-bold text-gray-900 dark:text-white">{{ $stats['pending'] }}</p>
                </div>
            </div>
        </div>

        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700 p-6">
            <div class="flex items-center">
                <div class="p-2 bg-green-100 dark:bg-green-900 rounded-lg">
                    <i class="fas fa-check-circle text-green-600 dark:text-green-400"></i>
                </div>
                <div class="{{ app()->getLocale() == 'ar' ? 'mr-4' : 'ml-4' }}">
                    <p class="text-sm font-medium text-gray-600 dark:text-gray-400">{{ __('admin.approved') }}</p>
                    <p class="text-2xl font-bold text-gray-900 dark:text-white">{{ $stats['approved'] }}</p>
                </div>
            </div>
        </div>

        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700 p-6">
            <div class="flex items-center">
                <div class="p-2 bg-red-100 dark:bg-red-900 rounded-lg">
                    <i class="fas fa-times-circle text-red-600 dark:text-red-400"></i>
                </div>
                <div class="{{ app()->getLocale() == 'ar' ? 'mr-4' : 'ml-4' }}">
                    <p class="text-sm font-medium text-gray-600 dark:text-gray-400">{{ __('admin.rejected') }}</p>
                    <p class="text-2xl font-bold text-gray-900 dark:text-white">{{ $stats['rejected'] }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Filters -->
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700">
        <div class="p-6">
            <form method="GET" action="{{ route('admin.investment-applications.index') }}" class="grid grid-cols-1 md:grid-cols-6 gap-4">
                <div>
                    <label for="search" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        {{ __('admin.search') }}
                    </label>
                    <input type="text"
                           class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-gray-100"
                           id="search" name="search"
                           value="{{ request('search') }}"
                           placeholder="{{ __('admin.search_applications') }}">
                </div>

                <div>
                    <label for="applicant_type" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        {{ __('admin.applicant_type') }}
                    </label>
                    <select class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-gray-100"
                            id="applicant_type" name="applicant_type">
                        <option value="">{{ __('admin.all_types') }}</option>
                        <option value="saudi_individual" {{ request('applicant_type') == 'saudi_individual' ? 'selected' : '' }}>
                            {{ __('admin.saudi_individual') }}
                        </option>
                        <option value="company_institution" {{ request('applicant_type') == 'company_institution' ? 'selected' : '' }}>
                            {{ __('admin.company_institution') }}
                        </option>
                    </select>
                </div>

                <div>
                    <label for="status" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        {{ __('admin.status') }}
                    </label>
                    <select class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-gray-100"
                            id="status" name="status">
                        <option value="">{{ __('admin.all_statuses') }}</option>
                        <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>{{ __('admin.pending') }}</option>
                        <option value="reviewed" {{ request('status') == 'reviewed' ? 'selected' : '' }}>{{ __('admin.reviewed') }}</option>
                        <option value="approved" {{ request('status') == 'approved' ? 'selected' : '' }}>{{ __('admin.approved') }}</option>
                        <option value="rejected" {{ request('status') == 'rejected' ? 'selected' : '' }}>{{ __('admin.rejected') }}</option>
                    </select>
                </div>

                <div>
                    <label for="read_status" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        {{ __('admin.read_status') }}
                    </label>
                    <select class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-gray-100"
                            id="read_status" name="read_status">
                        <option value="">{{ __('admin.all') }}</option>
                        <option value="unread" {{ request('read_status') == 'unread' ? 'selected' : '' }}>{{ __('admin.unread') }}</option>
                        <option value="read" {{ request('read_status') == 'read' ? 'selected' : '' }}>{{ __('admin.read') }}</option>
                    </select>
                </div>

                <div>
                    <label for="date_from" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        {{ __('admin.date_from') }}
                    </label>
                    <input type="date"
                           class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-gray-100"
                           id="date_from" name="date_from"
                           value="{{ request('date_from') }}">
                </div>

                <div class="flex items-end gap-2">
                    <button type="submit"
                            class="flex-1 inline-flex items-center justify-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-md transition-colors duration-200">
                        <i class="fas fa-search {{ app()->getLocale() == 'ar' ? 'ml-2' : 'mr-2' }}"></i>
                        {{ __('admin.filter') }}
                    </button>
                    <a href="{{ route('admin.investment-applications.index') }}"
                       class="inline-flex items-center justify-center px-4 py-2 bg-gray-500 hover:bg-gray-600 text-white font-medium rounded-md transition-colors duration-200">
                        <i class="fas fa-times"></i>
                    </a>
                </div>
            </form>
        </div>
    </div>

    <!-- Applications Table -->
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700">
        <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
            <div class="flex items-center justify-between">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white {{ app()->getLocale() == 'ar' ? 'font-arabic-medium' : 'font-english' }}">
                    {{ __('admin.applications_list') }}
                </h3>
                <div class="flex items-center gap-2">
                    <input type="checkbox" id="select-all" class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                    <label for="select-all" class="text-sm text-gray-600 dark:text-gray-400">{{ __('admin.select_all') }}</label>
                </div>
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-50 dark:bg-gray-700">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                            <input type="checkbox" class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                            {{ __('admin.reference') }}
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                            {{ __('admin.applicant') }}
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                            {{ __('admin.type') }}
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                            {{ __('admin.shares') }}
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                            {{ __('admin.share_type') }}
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                            {{ __('admin.status') }}
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                            {{ __('admin.date') }}
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                            {{ __('admin.actions') }}
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                    @forelse($applications as $application)
                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 {{ !$application->is_read ? 'bg-blue-50 dark:bg-blue-900/20' : '' }}">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <input type="checkbox" name="application_ids[]" value="{{ $application->id }}"
                                   class="application-checkbox rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                @if(!$application->is_read)
                                    <div class="w-2 h-2 bg-blue-500 rounded-full {{ app()->getLocale() == 'ar' ? 'ml-2' : 'mr-2' }}"></div>
                                @endif
                                <span class="text-sm font-medium text-gray-900 dark:text-white font-mono">
                                    {{ $application->reference_number }}
                                </span>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div>
                                <div class="text-sm font-medium text-gray-900 dark:text-white">
                                    {{ $application->applicant_name }}
                                </div>
                                <div class="text-sm text-gray-500 dark:text-gray-400">
                                    {{ $application->email }}
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                {{ $application->applicant_type === 'saudi_individual' ? 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200' : 'bg-purple-100 text-purple-800 dark:bg-purple-900 dark:text-purple-200' }}">
                                {{ $application->applicant_type === 'saudi_individual' ? __('admin.individual') : __('admin.company') }}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-white">
                            {{ number_format($application->number_of_shares) }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                {{ $application->share_type === 'regular' ? 'bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200' : 'bg-orange-100 text-orange-800 dark:bg-orange-900 dark:text-orange-200' }}">
                                {{ $application->getShareTypeLabel() }}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                bg-{{ $application->status_color }}-100 text-{{ $application->status_color }}-800
                                dark:bg-{{ $application->status_color }}-900 dark:text-{{ $application->status_color }}-200">
                                {{ __('admin.' . $application->status) }}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                            {{ $application->created_at->format('Y-m-d H:i') }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                            <div class="flex items-center gap-2">
                                <a href="{{ route('admin.investment-applications.show', $application) }}"
                                   class="text-blue-600 hover:text-blue-900 dark:text-blue-400 dark:hover:text-blue-300"
                                   title="{{ __('admin.view') }}">
                                    <i class="fas fa-eye"></i>
                                </a>
                                @if(auth()->user()->isAdmin())
                                <button class="edit-status-btn text-green-600 hover:text-green-900 dark:text-green-400 dark:hover:text-green-300"
                                        data-application-id="{{ $application->id }}"
                                        data-current-status="{{ $application->status }}"
                                        title="{{ __('admin.update_status') }}">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button class="delete-btn text-red-600 hover:text-red-900 dark:text-red-400 dark:hover:text-red-300"
                                        data-application-id="{{ $application->id }}"
                                        title="{{ __('admin.delete') }}">
                                    <i class="fas fa-trash"></i>
                                </button>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" class="px-6 py-12 text-center">
                            <div class="text-gray-500 dark:text-gray-400">
                                <i class="fas fa-inbox text-4xl mb-4"></i>
                                <p class="text-lg font-medium">{{ __('admin.no_applications_found') }}</p>
                                <p class="text-sm">{{ __('admin.no_applications_description') }}</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($applications->hasPages())
        <div class="px-6 py-4 border-t border-gray-200 dark:border-gray-700">
            {{ $applications->links() }}
        </div>
        @endif
    </div>
</div>

<!-- Bulk Actions Modal -->
<div id="bulk-actions-modal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden z-50">
    <div class="flex items-center justify-center min-h-screen p-4">
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-xl max-w-md w-full">
            <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">{{ __('admin.bulk_actions') }}</h3>
            </div>
            <form id="bulk-actions-form" method="POST" action="{{ route('admin.investment-applications.bulk-action') }}">
                @csrf
                <div class="p-6 space-y-4">
                    <div>
                        <label for="bulk-action" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            {{ __('admin.select_action') }}
                        </label>
                        <select id="bulk-action" name="action" required
                                class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-gray-100">
                            <option value="">{{ __('admin.choose_action') }}</option>
                            <option value="mark_read">{{ __('admin.mark_as_read') }}</option>
                            <option value="mark_unread">{{ __('admin.mark_as_unread') }}</option>
                            <option value="approve">{{ __('admin.approve') }}</option>
                            <option value="reject">{{ __('admin.reject') }}</option>
                        </select>
                    </div>

                    <div id="notes-field" class="hidden">
                        <label for="bulk-notes" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            {{ __('admin.notes') }}
                        </label>
                        <textarea id="bulk-notes" name="notes" rows="3"
                                  class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-gray-100"
                                  placeholder="{{ __('admin.add_notes') }}"></textarea>
                    </div>
                </div>
                <div class="px-6 py-4 border-t border-gray-200 dark:border-gray-700 flex justify-end gap-2">
                    <button type="button" class="close-bulk-actions-btn px-4 py-2 bg-gray-500 hover:bg-gray-600 text-white font-medium rounded-md transition-colors duration-200">
                        {{ __('admin.cancel') }}
                    </button>
                    <button type="submit"
                            class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-md transition-colors duration-200">
                        {{ __('admin.apply') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('styles')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
@endpush

@push('scripts')
<!-- jQuery - Load first -->
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<!-- SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
// ===== UTILITY FUNCTIONS =====

// Export functionality
function exportApplications() {
    const params = new URLSearchParams(window.location.search);
    window.open(`{{ route('admin.investment-applications.export') }}?${params.toString()}`, '_blank');
}

// Delete application
function deleteApplication(id) {
    console.log('deleteApplication called with id:', id);

    Swal.fire({
        title: '{{ __("admin.confirm_delete") }}',
        text: '{{ __("admin.this_action_cannot_be_undone") }}',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: '{{ __("admin.yes_delete") }}',
        cancelButtonText: '{{ __("admin.cancel") }}'
    }).then((result) => {
        if (result.isConfirmed) {
            submitDeleteForm(id);
        }
    });
}

// Update application status
function updateStatus(id, currentStatus) {
    console.log('updateStatus called with id:', id, 'status:', currentStatus);

    const statuses = {
        'pending': '{{ __("admin.pending") }}',
        'reviewed': '{{ __("admin.under_review") }}',
        'approved': '{{ __("admin.approved") }}',
        'rejected': '{{ __("admin.rejected") }}',
    };

    const options = Object.keys(statuses).map(key =>
        `<option value="${key}" ${key === currentStatus ? 'selected' : ''}>${statuses[key]}</option>`
    ).join('');

    Swal.fire({
        title: '{{ __("admin.update_status") }}',
        html: `<select id="status-select" class="swal2-input">${options}</select>`,
        showCancelButton: true,
        confirmButtonText: '{{ __("admin.update") }}',
        cancelButtonText: '{{ __("admin.cancel") }}',
        preConfirm: () => {
            const status = document.getElementById('status-select').value;
            if (!status) {
                Swal.showValidationMessage('{{ __("admin.please_select_status") }}');
                return false;
            }
            return status;
        }
    }).then((result) => {
        if (result.isConfirmed) {
            updateApplicationStatus(id, result.value);
        }
    });
}

// Show bulk actions modal
function showBulkActions() {
    const checkedBoxes = document.querySelectorAll('.application-checkbox:checked');
    if (checkedBoxes.length === 0) {
        Swal.fire({
            icon: 'warning',
            title: '{{ __("admin.warning") }}',
            text: '{{ __("admin.please_select_applications") }}'
        });
        return;
    }

    // Add selected IDs to form
    const form = document.getElementById('bulk-actions-form');
    const existingInputs = form.querySelectorAll('input[name="application_ids[]"]');
    existingInputs.forEach(input => input.remove());

    checkedBoxes.forEach(checkbox => {
        const input = document.createElement('input');
        input.type = 'hidden';
        input.name = 'application_ids[]';
        input.value = checkbox.value;
        form.appendChild(input);
    });

    document.getElementById('bulk-actions-modal').classList.remove('hidden');
}

// Close bulk actions modal
function closeBulkActions() {
    document.getElementById('bulk-actions-modal').classList.add('hidden');
}




// ===== HELPER FUNCTIONS =====

let baseUrl = "{{ url('/admin/investment-applications') }}";

// Helper function to submit delete form
function submitDeleteForm(id) {
let deleteFullUrl = `${baseUrl}/${id}`;

    const form = document.createElement('form');
    form.method = 'POST';
    form.action = deleteFullUrl;
    form.innerHTML = `
        @csrf
        @method('DELETE')
    `;
    document.body.appendChild(form);
    form.submit();
}

// Helper function to update application status
function updateApplicationStatus(id, newStatus) {
let statusFullUrl = `${baseUrl}/${id}/update-status`;

    fetch(statusFullUrl, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
            'X-Requested-With': 'XMLHttpRequest'
        },
        body: JSON.stringify({ status: newStatus })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            Swal.fire('{{ __("admin.success") }}', data.message, 'success');
            setTimeout(() => window.location.reload(), 1500);
        } else {
            Swal.fire('{{ __("admin.error") }}', data.message, 'error');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        Swal.fire('{{ __("admin.error") }}', '{{ __("admin.error_occurred") }}', 'error');
    });
}

// ===== EVENT LISTENERS USING JQUERY =====
$(document).ready(function() {
    console.log('jQuery loaded and DOM ready');

    // Export button event listener
    $(document).on('click', '.export-btn', function() {
        exportApplications();
    });

    // Bulk actions button event listener
    $(document).on('click', '.bulk-actions-btn', function() {
        showBulkActions();
    });

    // Close bulk actions modal event listener
    $(document).on('click', '.close-bulk-actions-btn', function() {
        closeBulkActions();
    });

    // Edit status button event listener
    $(document).on('click', '.edit-status-btn', function() {
        const id = $(this).data('application-id');
        const currentStatus = $(this).data('current-status');
        updateStatus(id, currentStatus);
    });

    // Delete button event listener
    $(document).on('click', '.delete-btn', function() {
        const id = $(this).data('application-id');
        deleteApplication(id);
    });

    // Select all checkbox event listener
    $('#select-all').on('change', function() {
        $('.application-checkbox').prop('checked', this.checked);
    });

    // Show/hide notes field based on bulk action selection
    $('#bulk-action').on('change', function() {
        const notesField = $('#notes-field');
        if (this.value === 'approve' || this.value === 'reject') {
            notesField.removeClass('hidden');
        } else {
            notesField.addClass('hidden');
        }
    });

    // Log successful initialization
    console.log('All event listeners attached successfully');
});
</script>
@endpush

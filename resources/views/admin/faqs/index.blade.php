@extends('layouts.admin')

@section('title', __('admin.faq_management'))

@section('content')
<div class="p-6">
    <!-- Header -->
    <div class="mb-8">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h1 class="text-3xl font-bold text-gray-900 dark:text-white">{{ __('admin.faq_management') }}</h1>
                <p class="mt-2 text-sm text-gray-600 dark:text-gray-400">{{ __('admin.manage_faqs') }}</p>
            </div>
            <div class="mt-4 sm:mt-0">
                <a href="{{ route('admin.faqs.create') }}"
                   class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded-lg transition-colors duration-200">
                    <i class="fas fa-plus w-4 h-4 mr-2"></i>
                    {{ __('admin.add_faq') }}
                </a>
            </div>
        </div>
    </div>

    <!-- Success Message -->
    @if(session('success'))
        <div class="mb-6 bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-lg" role="alert">
            <div class="flex items-center">
                <i class="fas fa-check-circle mr-2"></i>
                <span>{{ session('success') }}</span>
            </div>
        </div>
    @endif

    <!-- Main Content Card -->
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700">
        <!-- Card Header with Bulk Actions -->
        <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between space-y-3 sm:space-y-0">
                <div class="flex items-center space-x-3">
                    <h2 class="text-lg font-semibold text-gray-900 dark:text-white">{{ __('admin.faqs_list') }}</h2>
                    <span class="bg-gray-100 dark:bg-gray-700 text-gray-600 dark:text-gray-300 px-2 py-1 rounded-full text-xs font-medium">
                        {{ $faqs->total() }} {{ __('admin.total_faqs') }}
                    </span>
                </div>

                <!-- Bulk Actions -->
                <div class="flex items-center space-x-2">
                    <button type="button" onclick="bulkAction('activate')"
                            class="inline-flex items-center px-3 py-2 border border-green-300 text-green-700 bg-green-50 hover:bg-green-100 text-xs font-medium rounded-md transition-colors duration-200">
                        <i class="fas fa-check w-3 h-3 mr-1"></i>
                        {{ __('admin.activate_selected') }}
                    </button>
                    <button type="button" onclick="bulkAction('deactivate')"
                            class="inline-flex items-center px-3 py-2 border border-yellow-300 text-yellow-700 bg-yellow-50 hover:bg-yellow-100 text-xs font-medium rounded-md transition-colors duration-200">
                        <i class="fas fa-times w-3 h-3 mr-1"></i>
                        {{ __('admin.deactivate_selected') }}
                    </button>
                    <button type="button" onclick="bulkAction('delete')"
                            class="inline-flex items-center px-3 py-2 border border-red-300 text-red-700 bg-red-50 hover:bg-red-100 text-xs font-medium rounded-md transition-colors duration-200">
                        <i class="fas fa-trash w-3 h-3 mr-1"></i>
                        {{ __('admin.delete_selected') }}
                    </button>
                </div>
            </div>
        </div>

        <!-- Table -->
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700" id="faqs-table">
                <thead class="bg-gray-50 dark:bg-gray-700">
                    <tr>
                        <th scope="col" class="w-12 px-6 py-3">
                            <input type="checkbox" id="select-all"
                                   class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                        </th>
                        <th scope="col" class="w-20 px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                            {{ __('admin.order') }}
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                            {{ __('admin.question') }} ({{ __('admin.arabic') }})
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                            {{ __('admin.question') }} ({{ __('admin.english') }})
                        </th>
                        <th scope="col" class="w-24 px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                            {{ __('admin.status') }}
                        </th>
                        <th scope="col" class="w-32 px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                            {{ __('admin.actions') }}
                        </th>
                    </tr>
                </thead>
                <tbody id="sortable-faqs" class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                    @forelse($faqs as $faq)
                        <tr data-id="{{ $faq->id }}" class="hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors duration-200">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <input type="checkbox" class="faq-checkbox w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600"
                                       value="{{ $faq->id }}">
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center space-x-2">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-300">
                                        {{ $faq->order }}
                                    </span>
                                    <i class="fas fa-grip-vertical text-gray-400 cursor-move hover:text-gray-600 transition-colors duration-200"></i>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="text-sm text-gray-900 dark:text-white font-medium" dir="rtl">
                                    {{ Str::limit($faq->question_ar, 60) }}
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="text-sm text-gray-900 dark:text-white font-medium">
                                    {{ Str::limit($faq->question_en, 60) }}
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <label class="relative inline-flex items-center cursor-pointer">
                                    <input type="checkbox" class="sr-only status-toggle" data-id="{{ $faq->id }}" {{ $faq->is_active ? 'checked' : '' }}>
                                    <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600"></div>
                                </label>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <div class="flex items-center space-x-2">
                                    <a href="{{ route('admin.faqs.edit', $faq) }}"
                                       class="inline-flex items-center px-3 py-1.5 border border-blue-300 text-blue-700 bg-blue-50 hover:bg-blue-100 text-xs font-medium rounded-md transition-colors duration-200">
                                        <i class="fas fa-edit w-3 h-3 mr-1"></i>
                                        {{ __('admin.edit') }}
                                    </a>
                                    <button type="button" onclick="deleteFaq({{ $faq->id }})"
                                            class="inline-flex items-center px-3 py-1.5 border border-red-300 text-red-700 bg-red-50 hover:bg-red-100 text-xs font-medium rounded-md transition-colors duration-200">
                                        <i class="fas fa-trash w-3 h-3 mr-1"></i>
                                        {{ __('admin.delete') }}
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-12 text-center">
                                <div class="flex flex-col items-center justify-center">
                                    <div class="w-16 h-16 bg-gray-100 dark:bg-gray-700 rounded-full flex items-center justify-center mb-4">
                                        <i class="fas fa-question-circle text-2xl text-gray-400 dark:text-gray-500"></i>
                                    </div>
                                    <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-2">{{ __('admin.no_faqs') }}</h3>
                                    <p class="text-gray-500 dark:text-gray-400 mb-4">{{ __('admin.no_faqs_description') }}</p>
                                    <a href="{{ route('admin.faqs.create') }}"
                                       class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded-lg transition-colors duration-200">
                                        <i class="fas fa-plus w-4 h-4 mr-2"></i>
                                        {{ __('admin.add_first_faq') }}
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        @if($faqs->hasPages())
            <div class="px-6 py-4 border-t border-gray-200 dark:border-gray-700">
                {{ $faqs->links() }}
            </div>
        @endif
    </div>
</div>

<!-- Delete Confirmation Modal -->
<div id="deleteModal" class="fixed inset-0 z-50 hidden overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
    <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>
        <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
        <div class="inline-block align-bottom bg-white dark:bg-gray-800 rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
            <div class="bg-white dark:bg-gray-800 px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                <div class="sm:flex sm:items-start">
                    <div class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-red-100 sm:mx-0 sm:h-10 sm:w-10">
                        <i class="fas fa-exclamation-triangle text-red-600"></i>
                    </div>
                    <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                        <h3 class="text-lg leading-6 font-medium text-gray-900 dark:text-white" id="modal-title">
                            {{ __('admin.confirm_delete') }}
                        </h3>
                        <div class="mt-2">
                            <p class="text-sm text-gray-500 dark:text-gray-400">
                                {{ __('admin.confirm_delete_faq') }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="bg-gray-50 dark:bg-gray-700 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                <form id="delete-form" method="POST" class="inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-red-600 text-base font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:ml-3 sm:w-auto sm:text-sm">
                        {{ __('admin.delete') }}
                    </button>
                </form>
                <button type="button" onclick="closeDeleteModal()" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm dark:bg-gray-600 dark:text-white dark:border-gray-500 dark:hover:bg-gray-700">
                    {{ __('admin.cancel') }}
                </button>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.0/Sortable.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Initialize sortable
    const sortable = Sortable.create(document.getElementById('sortable-faqs'), {
        handle: '.fa-grip-vertical',
        animation: 150,
        ghostClass: 'bg-blue-50',
        chosenClass: 'bg-blue-100',
        dragClass: 'opacity-50',
        onEnd: function(evt) {
            updateOrder();
        }
    });

    // Update FAQ order
    function updateOrder() {
        const orders = [];
        document.querySelectorAll('#sortable-faqs tr[data-id]').forEach((row, index) => {
            if (row.dataset.id) {
                orders.push({
                    id: row.dataset.id,
                    position: index + 1
                });
            }
        });

        if (orders.length > 0) {
            fetch('{{ route("admin.faqs.update-order") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify({ orders: orders })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    showNotification('{{ __("admin.order_updated") }}', 'success');
                }
            })
            .catch(error => {
                console.error('Error updating order:', error);
                showNotification('{{ __("admin.error_occurred") }}', 'error');
            });
        }
    }

    // Select all checkbox
    const selectAllCheckbox = document.getElementById('select-all');
    if (selectAllCheckbox) {
        selectAllCheckbox.addEventListener('change', function() {
            const checkboxes = document.querySelectorAll('.faq-checkbox');
            checkboxes.forEach(checkbox => checkbox.checked = this.checked);
        });
    }

    // Status toggle
    document.querySelectorAll('.status-toggle').forEach(toggle => {
        toggle.addEventListener('change', function() {
            const faqId = this.dataset.id;
            const isChecked = this.checked;

            fetch(`/admin/faqs/${faqId}/toggle-status`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    showNotification(data.message, 'success');
                } else {
                    this.checked = !isChecked; // Revert on error
                    showNotification('{{ __("admin.error_occurred") }}', 'error');
                }
            })
            .catch(error => {
                this.checked = !isChecked; // Revert on error
                console.error('Error updating status:', error);
                showNotification('{{ __("admin.error_occurred") }}', 'error');
            });
        });
    });

// Bulk actions
function bulkAction(action) {
    const selected = Array.from(document.querySelectorAll('.faq-checkbox:checked')).map(cb => cb.value);

    if (selected.length === 0) {
        showNotification('{{ __("admin.select_at_least_one") }}', 'warning');
        return;
    }

    const actionText = {
        'activate': '{{ __("admin.activate") }}',
        'deactivate': '{{ __("admin.deactivate") }}',
        'delete': '{{ __("admin.delete") }}'
    };

    if (confirm(`{{ __("admin.confirm_bulk_action") }} ${actionText[action]} {{ __("admin.selected_faqs") }}?`)) {
        fetch('{{ route("admin.faqs.bulk-action") }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            },
            body: JSON.stringify({ action: action, ids: selected })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                showNotification(data.message, 'success');
                setTimeout(() => location.reload(), 1000);
            } else {
                showNotification(data.message || '{{ __("admin.error_occurred") }}', 'error');
            }
        })
        .catch(error => {
            console.error('Error performing bulk action:', error);
            showNotification('{{ __("admin.error_occurred") }}', 'error');
        });
    }
}

// Delete FAQ
function deleteFaq(id) {
    document.getElementById('delete-form').action = `/admin/faqs/${id}`;
    document.getElementById('deleteModal').classList.remove('hidden');
}

// Close delete modal
function closeDeleteModal() {
    document.getElementById('deleteModal').classList.add('hidden');
}

// Notification system
function showNotification(message, type = 'info') {
    const notification = document.createElement('div');
    notification.className = `fixed top-4 right-4 z-50 p-4 rounded-lg shadow-lg transition-all duration-300 transform translate-x-full`;

    const colors = {
        'success': 'bg-green-500 text-white',
        'error': 'bg-red-500 text-white',
        'warning': 'bg-yellow-500 text-white',
        'info': 'bg-blue-500 text-white'
    };

    notification.className += ` ${colors[type] || colors.info}`;
    notification.innerHTML = `
        <div class="flex items-center">
            <span>${message}</span>
            <button onclick="this.parentElement.parentElement.remove()" class="ml-4 text-white hover:text-gray-200">
                <i class="fas fa-times"></i>
            </button>
        </div>
    `;

    document.body.appendChild(notification);

    // Animate in
    setTimeout(() => {
        notification.classList.remove('translate-x-full');
    }, 100);

    // Auto remove after 5 seconds
    setTimeout(() => {
        notification.classList.add('translate-x-full');
        setTimeout(() => notification.remove(), 300);
    }, 5000);
}
</script>
@endpush

@extends('layouts.admin')

@section('title', __('admin.content_sections'))

@section('content')
<div class="container px-6 mx-auto grid">
    <div class="flex justify-between items-center">
        <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
            {{ __('admin.content_sections') }}
        </h2>
        <a href="{{ route('admin.content-sections.create') }}" class="flex items-center justify-between px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-blue-600 border border-transparent rounded-lg active:bg-blue-600 hover:bg-blue-700 focus:outline-none focus:shadow-outline-blue">
            <span class="mr-2">{{ __('admin.add_new') }}</span>
            <i class="fas fa-plus"></i>
        </a>
    </div>

    <!-- Filters -->
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700">
        <div class="p-6">
            <form method="GET" action="{{ route('admin.content-sections.index') }}" class="grid grid-cols-1 md:grid-cols-4 gap-4">
                <div>
                    <label for="search" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        {{ __('admin.search') }}
                    </label>
                    <input type="text" name="search" id="search" value="{{ request('search') }}"
                           class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-gray-300"
                           placeholder="{{ __('admin.search_content_sections') }}">
                </div>

                <div>
                    <label for="page_location" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        {{ __('admin.page_location') }}
                    </label>
                    <select name="page_location" id="page_location"
                            class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-gray-300">
                        <option value="">{{ __('admin.all_pages') }}</option>
                        @foreach(\App\Models\ContentSection::getPageLocations() as $value => $label)
                            <option value="{{ $value }}" {{ request('page_location') == $value ? 'selected' : '' }}>{{ $label }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label for="status" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        {{ __('admin.status') }}
                    </label>
                    <select name="status" id="status"
                            class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-gray-300">
                        <option value="">{{ __('admin.all_statuses') }}</option>
                        <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>{{ __('admin.active') }}</option>
                        <option value="inactive" {{ request('status') == 'inactive' ? 'selected' : '' }}>{{ __('admin.inactive') }}</option>
                    </select>
                </div>

                <div class="flex items-end">
                    <button type="submit" class="px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        {{ __('admin.filter') }}
                    </button>
                    <a href="{{ route('admin.content-sections.index') }}" class="ml-2 px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        {{ __('admin.reset') }}
                    </a>
                </div>
            </form>
        </div>
    </div>

    <!-- Content Sections Table -->
    <div class="bg-white dark:bg-gray-800 shadow-md rounded-lg border border-gray-200 dark:border-gray-700 mt-6">
        <div class="flex justify-between items-center p-6 border-b border-gray-200 dark:border-gray-700">
            <h3 class="text-lg font-semibold text-gray-800 dark:text-white">
                {{ __('admin.content_sections_list') }}
            </h3>
            <button id="bulk-actions-btn" class="px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                {{ __('admin.bulk_actions') }}
            </button>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-50 dark:bg-gray-700">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                            <input type="checkbox" id="select-all" class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                            {{ __('admin.title') }}
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                            {{ __('admin.page_location') }}
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                            {{ __('admin.order') }}
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                            {{ __('admin.status') }}
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                            {{ __('admin.created_at') }}
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                            {{ __('admin.actions') }}
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                    @forelse($sections as $section)
                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-700">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <input type="checkbox" class="section-checkbox rounded border-gray-300 text-blue-600 focus:ring-blue-500" value="{{ $section->id }}">
                        </td>
                        <td class="px-6 py-4">
                            <div class="text-sm font-medium text-gray-900 dark:text-white">
                                {{ $section->getLocalizedTitle() }}
                            </div>
                            <div class="text-sm text-gray-500 dark:text-gray-400">
                                {{ Str::limit(strip_tags($section->getLocalizedContent()), 50) }}
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200">
                                {{ $section->getPageLocationLabel() }}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                            {{ $section->display_order }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                {{ $section->is_active ? 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200' : 'bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200' }}">
                                {{ $section->is_active ? __('admin.active') : __('admin.inactive') }}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                            {{ $section->created_at->format('Y-m-d H:i') }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                            <div class="flex space-x-2">
                                <a href="{{ route('admin.content-sections.show', $section) }}" class="text-blue-600 hover:text-blue-900 dark:text-blue-400 dark:hover:text-blue-300"
                                   title="{{ __('admin.view') }}">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('admin.content-sections.edit', $section) }}" class="text-indigo-600 hover:text-indigo-900 dark:text-indigo-400 dark:hover:text-indigo-300"
                                   title="{{ __('admin.edit') }}">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <button type="button" class="toggle-status-btn text-yellow-600 hover:text-yellow-900 dark:text-yellow-400 dark:hover:text-yellow-300"
                                        data-section-id="{{ $section->id }}"
                                        data-is-active="{{ $section->is_active ? 1 : 0 }}"
                                        title="{{ $section->is_active ? __('admin.deactivate') : __('admin.activate') }}">
                                    <i class="fas {{ $section->is_active ? 'fa-toggle-on' : 'fa-toggle-off' }}"></i>
                                </button>
                                <button type="button" class="delete-btn text-red-600 hover:text-red-900 dark:text-red-400 dark:hover:text-red-300"
                                        data-section-id="{{ $section->id }}"
                                        title="{{ __('admin.delete') }}">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="px-6 py-4 text-center text-gray-500 dark:text-gray-400">
                            {{ __('admin.no_content_sections_found') }}
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- <div class="px-6 py-4 border-t border-gray-200 dark:border-gray-700">
            {{ $sections->appends(request()->query())->links() }}
        </div> --}}
    </div>
</div>

<!-- Bulk Actions Modal -->
<div id="bulk-actions-modal" class="hidden fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center">
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-xl max-w-md w-full">
        <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
            <h3 class="text-lg font-semibold text-gray-900 dark:text-white">{{ __('admin.bulk_actions') }}</h3>
        </div>
        <form id="bulk-actions-form" method="POST" action="{{ route('admin.content-sections.bulk-action') }}">
            @csrf
            <div class="p-6 space-y-4">
                <div>
                    <label for="bulk-action" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        {{ __('admin.select_action') }}
                    </label>
                    <select id="bulk-action" name="action" class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-gray-300">
                        <option value="activate">{{ __('admin.activate_selected') }}</option>
                        <option value="deactivate">{{ __('admin.deactivate_selected') }}</option>
                        <option value="delete">{{ __('admin.delete_selected') }}</option>
                    </select>
                </div>
                <div id="selected-items" class="text-sm text-gray-600 dark:text-gray-400"></div>
                <input type="hidden" id="selected-sections" name="sections">
            </div>
            <div class="px-6 py-4 border-t border-gray-200 dark:border-gray-700 flex justify-end space-x-2">
                <button type="button" id="cancel-bulk-action" class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                    {{ __('admin.cancel') }}
                </button>
                <button type="submit" class="px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                    {{ __('admin.apply') }}
                </button>
            </div>
        </form>
    </div>
</div>

@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const baseUrl = "{{ route('admin.content-sections.index') }}";
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        // Check if SweetAlert2 is loaded
        if (typeof Swal === 'undefined') {
            console.error('SweetAlert2 is not loaded');
            // Load SweetAlert2 dynamically
            const script = document.createElement('script');
            script.src = 'https://cdn.jsdelivr.net/npm/sweetalert2@11';
            script.onload = function() {
                console.log('SweetAlert2 loaded dynamically');
            };
            document.head.appendChild(script);
        }

        console.log('Content sections page loaded, CSRF token:', csrfToken);

        // Check if buttons exist
        const toggleButtons = document.querySelectorAll('.toggle-status-btn');
        const deleteButtons = document.querySelectorAll('.delete-btn');
        console.log('Found toggle buttons:', toggleButtons.length);
        console.log('Found delete buttons:', deleteButtons.length);

        // Helper function to show alert
        function showAlert(type, title, text) {
            if (typeof Swal !== 'undefined') {
                Swal.fire({
                    icon: type,
                    title: title,
                    text: text
                });
            } else {
                alert(title + ': ' + text);
            }
        }

        // Helper function to show confirmation
        function showConfirmation(title, text, callback) {
            if (typeof Swal !== 'undefined') {
                Swal.fire({
                    title: title,
                    text: text,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: '{{ __('admin.yes_delete') }}',
                    cancelButtonText: '{{ __('admin.cancel') }}'
                }).then(callback);
            } else {
                if (confirm(title + '\n' + text)) {
                    callback({isConfirmed: true});
                }
            }
        }

        // Toggle status using event delegation
        document.addEventListener('click', function(e) {
            if (e.target.closest('.toggle-status-btn')) {
                e.preventDefault();
                e.stopPropagation();

                const btn = e.target.closest('.toggle-status-btn');
                const sectionId = btn.getAttribute('data-section-id');
                const isActive = btn.getAttribute('data-is-active') === '1';

                console.log('Toggle status clicked for section:', sectionId);

                if (!sectionId) {
                    console.error('Section ID not found');
                    return;
                }

                const url = '{{ route('admin.content-sections.toggle-status', ':id') }}'.replace(':id', sectionId);
                console.log('Making request to:', url);

                fetch(url, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken,
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                })
                .then(response => {
                    console.log('Response status:', response.status);
                    if (!response.ok) {
                        throw new Error(`HTTP error! status: ${response.status}`);
                    }
                    return response.json();
                })
                .then(data => {
                    console.log('Toggle response:', data);
                    if (data.success) {
                        // Update UI
                        this.setAttribute('data-is-active', data.is_active ? '1' : '0');
                        this.querySelector('i').className = data.is_active ? 'fas fa-toggle-on' : 'fas fa-toggle-off';
                        this.setAttribute('title', data.is_active ? '{{ __('admin.deactivate') }}' : '{{ __('admin.activate') }}');

                        // Update status badge
                        const statusBadge = this.closest('tr').querySelector('td:nth-child(5) span');
                        if (statusBadge) {
                            statusBadge.className = `inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium ${data.is_active ? 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200' : 'bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200'}`;
                            statusBadge.textContent = data.is_active ? '{{ __('admin.active') }}' : '{{ __('admin.inactive') }}';
                        }

                        // Show success message
                        showAlert('success', '{{ __('admin.success') }}', data.message);
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    showAlert('error', '{{ __('admin.error') }}', '{{ __('admin.something_went_wrong') }}');
                });
            }
        });

        // Delete section using event delegation
        document.addEventListener('click', function(e) {
            if (e.target.closest('.delete-btn')) {
                e.preventDefault();
                e.stopPropagation();

                const btn = e.target.closest('.delete-btn');
                const sectionId = btn.getAttribute('data-section-id');

                console.log('Delete clicked for section:', sectionId);

                if (!sectionId) {
                    console.error('Section ID not found');
                    return;
                }

                showConfirmation(
                    '{{ __('admin.confirm_delete') }}',
                    '{{ __('admin.this_action_cannot_be_undone') }}',
                    function(result) {
                    if (result.isConfirmed) {
                        console.log('Confirmed delete for section:', sectionId);
                        const form = document.createElement('form');
                        form.method = 'POST';
                        const deleteUrl = '{{ route('admin.content-sections.destroy', ':id') }}'.replace(':id', sectionId);
                        console.log('Delete URL:', deleteUrl);
                        form.action = deleteUrl;
                        form.innerHTML = `
                            @csrf
                            @method('DELETE')
                        `;
                        document.body.appendChild(form);
                        form.submit();
                    }
                });
            }
        });

        // Bulk actions
        const bulkActionsBtn = document.getElementById('bulk-actions-btn');
        const bulkActionsModal = document.getElementById('bulk-actions-modal');
        const cancelBulkAction = document.getElementById('cancel-bulk-action');
        const selectAll = document.getElementById('select-all');
        const sectionCheckboxes = document.querySelectorAll('.section-checkbox');
        const selectedSections = document.getElementById('selected-sections');
        const selectedItems = document.getElementById('selected-items');

        bulkActionsBtn.addEventListener('click', function() {
            const checked = Array.from(sectionCheckboxes).filter(cb => cb.checked);

            if (checked.length === 0) {
                showAlert('warning', '{{ __('admin.warning') }}', '{{ __('admin.select_at_least_one_item') }}');
                return;
            }

            const ids = checked.map(cb => cb.value);
            selectedSections.value = ids.join(',');
            selectedItems.textContent = `{{ __('admin.selected_items') }}: ${ids.length}`;

            bulkActionsModal.classList.remove('hidden');
        });

        cancelBulkAction.addEventListener('click', function() {
            bulkActionsModal.classList.add('hidden');
        });

        selectAll.addEventListener('change', function() {
            sectionCheckboxes.forEach(cb => {
                cb.checked = this.checked;
            });
        });
    });
</script>
@endsection

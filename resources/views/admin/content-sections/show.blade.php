@extends('layouts.admin')

@section('title', __('admin.view_content_section'))

@section('content')
<div class="container px-6 mx-auto grid">
    <div class="flex justify-between items-center">
        <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
            {{ __('admin.view_content_section') }}
        </h2>
        <div class="flex space-x-2">
            <a href="{{ route('admin.content-sections.edit', $contentSection) }}" class="flex items-center justify-between px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-blue-600 border border-transparent rounded-lg active:bg-blue-600 hover:bg-blue-700 focus:outline-none focus:shadow-outline-blue">
                <i class="fas fa-edit mr-2"></i>
                <span>{{ __('admin.edit') }}</span>
            </a>
            <a href="{{ route('admin.content-sections.index') }}" class="flex items-center justify-between px-4 py-2 text-sm font-medium leading-5 text-gray-700 transition-colors duration-150 bg-white border border-gray-300 rounded-lg active:bg-gray-100 hover:bg-gray-100 focus:outline-none focus:shadow-outline-gray">
                <i class="fas fa-arrow-left mr-2"></i>
                <span>{{ __('admin.back_to_list') }}</span>
            </a>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Main Content -->
        <div class="lg:col-span-2">
            <!-- Section Details -->
            <div class="bg-white dark:bg-gray-800 shadow-md rounded-lg border border-gray-200 dark:border-gray-700 mb-6">
                <div class="p-6 border-b border-gray-200 dark:border-gray-700">
                    <h3 class="text-lg font-semibold text-gray-800 dark:text-white">
                        {{ __('admin.section_details') }}
                    </h3>
                </div>
                <div class="p-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                        <div>
                            <label class="text-sm font-medium text-gray-500 dark:text-gray-400">{{ __('admin.title_arabic') }}</label>
                            <p class="text-lg font-semibold text-gray-900 dark:text-white mt-1">
                                {{ $contentSection->title_ar }}
                            </p>
                        </div>
                        <div>
                            <label class="text-sm font-medium text-gray-500 dark:text-gray-400">{{ __('admin.title_english') }}</label>
                            <p class="text-lg font-semibold text-gray-900 dark:text-white mt-1">
                                {{ $contentSection->title_en }}
                            </p>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                        <div>
                            <label class="text-sm font-medium text-gray-500 dark:text-gray-400">{{ __('admin.page_location') }}</label>
                            <p class="text-sm font-medium text-gray-900 dark:text-white mt-1">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200">
                                    {{ $contentSection->getPageLocationLabel() }}
                                </span>
                            </p>
                        </div>
                        <div>
                            <label class="text-sm font-medium text-gray-500 dark:text-gray-400">{{ __('admin.display_order') }}</label>
                            <p class="text-sm font-medium text-gray-900 dark:text-white mt-1">
                                {{ $contentSection->display_order }}
                            </p>
                        </div>
                        <div>
                            <label class="text-sm font-medium text-gray-500 dark:text-gray-400">{{ __('admin.status') }}</label>
                            <p class="text-sm font-medium mt-1">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                    {{ $contentSection->is_active ? 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200' : 'bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200' }}">
                                    {{ $contentSection->is_active ? __('admin.active') : __('admin.inactive') }}
                                </span>
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Arabic Content -->
            <div class="bg-white dark:bg-gray-800 shadow-md rounded-lg border border-gray-200 dark:border-gray-700 mb-6">
                <div class="p-6 border-b border-gray-200 dark:border-gray-700">
                    <h3 class="text-lg font-semibold text-gray-800 dark:text-white">
                        {{ __('admin.content_arabic') }}
                    </h3>
                </div>
                <div class="p-6">
                    <div class="prose prose-sm max-w-none dark:prose-invert" dir="rtl">
                        {!! $contentSection->content_ar !!}
                    </div>
                </div>
            </div>

            <!-- English Content -->
            <div class="bg-white dark:bg-gray-800 shadow-md rounded-lg border border-gray-200 dark:border-gray-700">
                <div class="p-6 border-b border-gray-200 dark:border-gray-700">
                    <h3 class="text-lg font-semibold text-gray-800 dark:text-white">
                        {{ __('admin.content_english') }}
                    </h3>
                </div>
                <div class="p-6">
                    <div class="prose prose-sm max-w-none dark:prose-invert">
                        {!! $contentSection->content_en !!}
                    </div>
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="lg:col-span-1">
            <!-- Meta Information -->
            <div class="bg-white dark:bg-gray-800 shadow-md rounded-lg border border-gray-200 dark:border-gray-700 mb-6">
                <div class="p-6 border-b border-gray-200 dark:border-gray-700">
                    <h3 class="text-lg font-semibold text-gray-800 dark:text-white">
                        {{ __('admin.meta_information') }}
                    </h3>
                </div>
                <div class="p-6 space-y-4">
                    <div>
                        <label class="text-sm font-medium text-gray-500 dark:text-gray-400">{{ __('admin.created_at') }}</label>
                        <p class="text-sm text-gray-900 dark:text-white mt-1">
                            {{ $contentSection->created_at->format('Y-m-d H:i:s') }}
                        </p>
                    </div>
                    <div>
                        <label class="text-sm font-medium text-gray-500 dark:text-gray-400">{{ __('admin.updated_at') }}</label>
                        <p class="text-sm text-gray-900 dark:text-white mt-1">
                            {{ $contentSection->updated_at->format('Y-m-d H:i:s') }}
                        </p>
                    </div>
                    @if($contentSection->creator)
                    <div>
                        <label class="text-sm font-medium text-gray-500 dark:text-gray-400">{{ __('admin.created_by') }}</label>
                        <p class="text-sm text-gray-900 dark:text-white mt-1">
                            {{ $contentSection->creator->name }}
                        </p>
                    </div>
                    @endif
                    @if($contentSection->updater)
                    <div>
                        <label class="text-sm font-medium text-gray-500 dark:text-gray-400">{{ __('admin.updated_by') }}</label>
                        <p class="text-sm text-gray-900 dark:text-white mt-1">
                            {{ $contentSection->updater->name }}
                        </p>
                    </div>
                    @endif
                </div>
            </div>

            <!-- Actions -->
            <div class="bg-white dark:bg-gray-800 shadow-md rounded-lg border border-gray-200 dark:border-gray-700">
                <div class="p-6 border-b border-gray-200 dark:border-gray-700">
                    <h3 class="text-lg font-semibold text-gray-800 dark:text-white">
                        {{ __('admin.actions') }}
                    </h3>
                </div>
                <div class="p-6 space-y-3">
                    <a href="{{ route('admin.content-sections.edit', $contentSection) }}" class="w-full flex items-center justify-center px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        <i class="fas fa-edit mr-2"></i>
                        {{ __('admin.edit') }}
                    </a>
                    
                    <button id="toggle-status-btn" class="w-full flex items-center justify-center px-4 py-2 text-sm font-medium text-white {{ $contentSection->is_active ? 'bg-yellow-600 hover:bg-yellow-700' : 'bg-green-600 hover:bg-green-700' }} rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-yellow-500">
                        <i class="fas {{ $contentSection->is_active ? 'fa-pause' : 'fa-play' }} mr-2"></i>
                        {{ $contentSection->is_active ? __('admin.deactivate') : __('admin.activate') }}
                    </button>
                    
                    <button id="delete-btn" class="w-full flex items-center justify-center px-4 py-2 text-sm font-medium text-white bg-red-600 rounded-md hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                        <i class="fas fa-trash mr-2"></i>
                        {{ __('admin.delete') }}
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const csrfToken = "{{ csrf_token() }}";
    const sectionId = {{ $contentSection->id }};
    
    // Toggle status
    document.getElementById('toggle-status-btn').addEventListener('click', function() {
        fetch(`{{ url('admin/content-sections') }}/${sectionId}/toggle-status`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken,
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                Swal.fire({
                    icon: 'success',
                    title: '{{ __('admin.success') }}',
                    text: data.message,
                    timer: 1500,
                    showConfirmButton: false
                }).then(() => {
                    window.location.reload();
                });
            }
        })
        .catch(error => {
            console.error('Error:', error);
            Swal.fire({
                icon: 'error',
                title: '{{ __('admin.error') }}',
                text: '{{ __('admin.something_went_wrong') }}'
            });
        });
    });
    
    // Delete section
    document.getElementById('delete-btn').addEventListener('click', function() {
        Swal.fire({
            title: '{{ __('admin.confirm_delete') }}',
            text: '{{ __('admin.this_action_cannot_be_undone') }}',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: '{{ __('admin.yes_delete') }}',
            cancelButtonText: '{{ __('admin.cancel') }}'
        }).then((result) => {
            if (result.isConfirmed) {
                const form = document.createElement('form');
                form.method = 'POST';
                form.action = `{{ route('admin.content-sections.destroy', $contentSection) }}`;
                form.innerHTML = `
                    @csrf
                    @method('DELETE')
                `;
                document.body.appendChild(form);
                form.submit();
            }
        });
    });
});
</script>
@endsection

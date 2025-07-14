@extends('layouts.admin')

@section('title', __('admin.application_details'))

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <h1 class="text-2xl font-bold text-gray-900 dark:text-white {{ app()->getLocale() == 'ar' ? 'font-arabic-bold' : 'font-english' }}">
                {{ __('admin.application_details') }}
            </h1>
            <p class="text-gray-600 dark:text-gray-400 mt-1 {{ app()->getLocale() == 'ar' ? 'font-arabic-normal' : 'font-english' }}">
                {{ __('admin.reference') }}: <span class="font-mono font-semibold">{{ $investmentApplication->reference_number }}</span>
            </p>
        </div>
        <div class="flex flex-col sm:flex-row gap-2">
            <a href="{{ route('admin.investment-applications.index') }}"
               class="inline-flex items-center px-4 py-2 bg-gray-600 hover:bg-gray-700 text-white font-medium rounded-lg transition-colors duration-200">
                <i class="fas fa-arrow-left {{ app()->getLocale() == 'ar' ? 'ml-2' : 'mr-2' }}"></i>
                {{ __('admin.back_to_applications') }}
            </a>
        </div>
    </div>

    <!-- Status and Quick Actions -->
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700">
        <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
            <div class="flex items-center justify-between">
                <div class="flex items-center gap-4">
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium
                        bg-{{ $investmentApplication->status_color }}-100 text-{{ $investmentApplication->status_color }}-800
                        dark:bg-{{ $investmentApplication->status_color }}-900 dark:text-{{ $investmentApplication->status_color }}-200">
                        {{ __('admin.' . $investmentApplication->status) }}
                    </span>
                    @if(!$investmentApplication->is_read)
                        <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200">
                            {{ __('admin.unread') }}
                        </span>
                    @endif
                </div>

                @if(auth()->user()->isAdmin())
                <div class="flex items-center gap-2">
                    <button onclick="showStatusModal()"
                            class="inline-flex items-center px-3 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded-md transition-colors duration-200">
                        <i class="fas fa-edit {{ app()->getLocale() == 'ar' ? 'ml-2' : 'mr-2' }}"></i>
                        {{ __('admin.change_status') }}
                    </button>
                </div>
                @endif
            </div>
        </div>

        <div class="p-6">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div>
                    <h4 class="text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">{{ __('admin.submitted_on') }}</h4>
                    <p class="text-lg font-semibold text-gray-900 dark:text-white">
                        {{ $investmentApplication->created_at->format('F j, Y \a\t g:i A') }}
                    </p>
                    <p class="text-sm text-gray-500 dark:text-gray-400">
                        {{ $investmentApplication->created_at->diffForHumans() }}
                    </p>
                </div>

                @if($investmentApplication->assignedTo)
                <div>
                    <h4 class="text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">{{ __('admin.assigned_to') }}</h4>
                    <p class="text-lg font-semibold text-gray-900 dark:text-white">
                        {{ $investmentApplication->assignedTo->name }}
                    </p>
                </div>
                @endif

                @if($investmentApplication->status_changed_at)
                <div>
                    <h4 class="text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">{{ __('admin.last_updated') }}</h4>
                    <p class="text-lg font-semibold text-gray-900 dark:text-white">
                        {{ $investmentApplication->status_changed_at->format('F j, Y \a\t g:i A') }}
                    </p>
                    @if($investmentApplication->statusChangedBy)
                    <p class="text-sm text-gray-500 dark:text-gray-400">
                        {{ __('admin.by') }} {{ $investmentApplication->statusChangedBy->name }}
                    </p>
                    @endif
                </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Application Details -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Applicant Information -->
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700">
            <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white {{ app()->getLocale() == 'ar' ? 'font-arabic-medium' : 'font-english' }}">
                    {{ __('admin.applicant_information') }}
                </h3>
            </div>
            <div class="p-6 space-y-4">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="text-sm font-medium text-gray-500 dark:text-gray-400">{{ __('admin.applicant_type') }}</label>
                        <p class="text-sm font-semibold text-gray-900 dark:text-white mt-1">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                {{ $investmentApplication->applicant_type === 'saudi_individual' ? 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200' : 'bg-purple-100 text-purple-800 dark:bg-purple-900 dark:text-purple-200' }}">
                                {{ $investmentApplication->applicant_type === 'saudi_individual' ? __('admin.saudi_individual') : __('admin.company_institution') }}
                            </span>
                        </p>
                    </div>

                    @if($investmentApplication->isSaudiIndividual())
                    <div>
                        <label class="text-sm font-medium text-gray-500 dark:text-gray-400">{{ __('admin.full_name') }}</label>
                        <p class="text-sm font-semibold text-gray-900 dark:text-white mt-1">{{ $investmentApplication->full_name }}</p>
                    </div>

                    <div>
                        <label class="text-sm font-medium text-gray-500 dark:text-gray-400">{{ __('admin.national_id') }}</label>
                        <p class="text-sm font-semibold text-gray-900 dark:text-white mt-1 font-mono">{{ $investmentApplication->national_id_residence_number }}</p>
                    </div>

                    <div>
                        <label class="text-sm font-medium text-gray-500 dark:text-gray-400">{{ __('admin.date_of_birth') }}</label>
                        <p class="text-sm font-semibold text-gray-900 dark:text-white mt-1">{{ $investmentApplication->date_of_birth?->format('Y-m-d') }}</p>
                    </div>

                    <div>
                        <label class="text-sm font-medium text-gray-500 dark:text-gray-400">{{ __('admin.profession') }}</label>
                        <p class="text-sm font-semibold text-gray-900 dark:text-white mt-1">{{ $investmentApplication->profession }}</p>
                    </div>
                    @else
                    <div>
                        <label class="text-sm font-medium text-gray-500 dark:text-gray-400">{{ __('admin.company_name') }}</label>
                        <p class="text-sm font-semibold text-gray-900 dark:text-white mt-1">{{ $investmentApplication->name_per_commercial_registration }}</p>
                    </div>

                    <div>
                        <label class="text-sm font-medium text-gray-500 dark:text-gray-400">{{ __('admin.commercial_registration') }}</label>
                        <p class="text-sm font-semibold text-gray-900 dark:text-white mt-1 font-mono">{{ $investmentApplication->commercial_registration_number }}</p>
                    </div>

                    <div>
                        <label class="text-sm font-medium text-gray-500 dark:text-gray-400">{{ __('admin.absher_mobile') }}</label>
                        <p class="text-sm font-semibold text-gray-900 dark:text-white mt-1">{{ $investmentApplication->absher_registered_mobile }}</p>
                    </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Contact & Investment Details -->
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700">
            <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white {{ app()->getLocale() == 'ar' ? 'font-arabic-medium' : 'font-english' }}">
                    {{ __('admin.contact_investment_details') }}
                </h3>
            </div>
            <div class="p-6 space-y-4">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="text-sm font-medium text-gray-500 dark:text-gray-400">{{ __('admin.email') }}</label>
                        <p class="text-sm font-semibold text-gray-900 dark:text-white mt-1">
                            <a href="mailto:{{ $investmentApplication->email }}" class="text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-300">
                                {{ $investmentApplication->email }}
                            </a>
                        </p>
                    </div>

                    <div>
                        <label class="text-sm font-medium text-gray-500 dark:text-gray-400">{{ __('admin.mobile_number') }}</label>
                        <p class="text-sm font-semibold text-gray-900 dark:text-white mt-1">
                            <a href="tel:{{ $investmentApplication->mobile_number }}" class="text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-300">
                                {{ $investmentApplication->mobile_number }}
                            </a>
                        </p>
                    </div>

                    <div>
                        <label class="text-sm font-medium text-gray-500 dark:text-gray-400">{{ __('admin.nationality') }}</label>
                        <p class="text-sm font-semibold text-gray-900 dark:text-white mt-1">{{ $investmentApplication->nationality }}</p>
                    </div>

                    <div>
                        <label class="text-sm font-medium text-gray-500 dark:text-gray-400">{{ __('admin.country_of_residence') }}</label>
                        <p class="text-sm font-semibold text-gray-900 dark:text-white mt-1">{{ $investmentApplication->country_of_residence }}</p>
                    </div>

                    <div>
                        <label class="text-sm font-medium text-gray-500 dark:text-gray-400">{{ __('admin.number_of_shares') }}</label>
                        <p class="text-2xl font-bold text-blue-600 dark:text-blue-400 mt-1">
                            {{ number_format($investmentApplication->number_of_shares) }} {{ __('admin.shares') }}
                        </p>
                    </div>

                    <div>
                        <label class="text-sm font-medium text-gray-500 dark:text-gray-400">{{ __('admin.share_type') }}</label>
                        <p class="text-lg font-semibold mt-1">
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium
                                {{ $investmentApplication->share_type === 'regular' ? 'bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200' : 'bg-orange-100 text-orange-800 dark:bg-orange-900 dark:text-orange-200' }}">
                                {{ $investmentApplication->getShareTypeLabel() }}
                            </span>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Admin Notes -->
    @if($investmentApplication->admin_notes)
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700">
        <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
            <h3 class="text-lg font-semibold text-gray-900 dark:text-white {{ app()->getLocale() == 'ar' ? 'font-arabic-medium' : 'font-english' }}">
                {{ __('admin.admin_notes') }}
            </h3>
        </div>
        <div class="p-6">
            <div class="bg-gray-50 dark:bg-gray-700 rounded-lg p-4">
                <p class="text-sm text-gray-700 dark:text-gray-300 whitespace-pre-wrap">{{ $investmentApplication->admin_notes }}</p>
            </div>
        </div>
    </div>
    @endif

    <!-- System Information -->
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700">
        <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
            <h3 class="text-lg font-semibold text-gray-900 dark:text-white {{ app()->getLocale() == 'ar' ? 'font-arabic-medium' : 'font-english' }}">
                {{ __('admin.system_information') }}
            </h3>
        </div>
        <div class="p-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm">
                <div>
                    <label class="font-medium text-gray-500 dark:text-gray-400">{{ __('admin.ip_address') }}</label>
                    <p class="text-gray-900 dark:text-white font-mono">{{ $investmentApplication->ip_address }}</p>
                </div>
                <div>
                    <label class="font-medium text-gray-500 dark:text-gray-400">{{ __('admin.user_agent') }}</label>
                    <p class="text-gray-900 dark:text-white text-xs break-all">{{ $investmentApplication->user_agent }}</p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Status Change Modal -->
@if(auth()->user()->isAdmin())
<div id="status-modal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden z-50">
    <div class="flex items-center justify-center min-h-screen p-4">
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-xl max-w-md w-full">
            <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">{{ __('admin.change_application_status') }}</h3>
            </div>
            <form method="POST" action="{{ route('admin.investment-applications.update-status', $investmentApplication) }}">
                @csrf
                <div class="p-6 space-y-4">
                    <div>
                        <label for="status" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            {{ __('admin.new_status') }}
                        </label>
                        <select id="status" name="status" required
                                class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-gray-100">
                            <option value="pending" {{ $investmentApplication->status === 'pending' ? 'selected' : '' }}>{{ __('admin.pending') }}</option>
                            <option value="reviewed" {{ $investmentApplication->status === 'reviewed' ? 'selected' : '' }}>{{ __('admin.reviewed') }}</option>
                            <option value="approved" {{ $investmentApplication->status === 'approved' ? 'selected' : '' }}>{{ __('admin.approved') }}</option>
                            <option value="rejected" {{ $investmentApplication->status === 'rejected' ? 'selected' : '' }}>{{ __('admin.rejected') }}</option>
                        </select>
                    </div>

                    <div>
                        <label for="admin_notes" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            {{ __('admin.notes') }}
                        </label>
                        <textarea id="admin_notes" name="admin_notes" rows="4"
                                  class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-gray-100"
                                  placeholder="{{ __('admin.add_notes_about_status_change') }}">{{ old('admin_notes') }}</textarea>
                    </div>
                </div>
                <div class="px-6 py-4 border-t border-gray-200 dark:border-gray-700 flex justify-end gap-2">
                    <button type="button" onclick="closeStatusModal()"
                            class="px-4 py-2 bg-gray-500 hover:bg-gray-600 text-white font-medium rounded-md transition-colors duration-200">
                        {{ __('admin.cancel') }}
                    </button>
                    <button type="submit"
                            class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-md transition-colors duration-200">
                        {{ __('admin.update_status') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endif
@endsection

@push('scripts')
<script>
function showStatusModal() {
    document.getElementById('status-modal').classList.remove('hidden');
}

function closeStatusModal() {
    document.getElementById('status-modal').classList.add('hidden');
}
</script>
@endpush

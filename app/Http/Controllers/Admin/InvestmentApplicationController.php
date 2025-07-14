<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\InvestmentApplication;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\InvestmentApplicationsExport;

class InvestmentApplicationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin')->except(['index', 'show']);
    }

    /**
     * Display a listing of investment applications
     */
    public function index(Request $request): View
    {
        $query = InvestmentApplication::with(['readBy', 'assignedTo', 'statusChangedBy']);

        // Search functionality
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('reference_number', 'like', "%{$search}%")
                  ->orWhere('full_name', 'like', "%{$search}%")
                  ->orWhere('name_per_commercial_registration', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('mobile_number', 'like', "%{$search}%")
                  ->orWhere('national_id_residence_number', 'like', "%{$search}%")
                  ->orWhere('commercial_registration_number', 'like', "%{$search}%");
            });
        }

        // Filter by applicant type
        if ($request->filled('applicant_type')) {
            $query->where('applicant_type', $request->applicant_type);
        }

        // Filter by status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Filter by read status
        if ($request->filled('read_status')) {
            if ($request->read_status === 'unread') {
                $query->where('is_read', false);
            } elseif ($request->read_status === 'read') {
                $query->where('is_read', true);
            }
        }

        // Filter by date range
        if ($request->filled('date_from')) {
            $query->whereDate('created_at', '>=', $request->date_from);
        }
        if ($request->filled('date_to')) {
            $query->whereDate('created_at', '<=', $request->date_to);
        }

        // Sort by latest first
        $applications = $query->orderBy('created_at', 'desc')->paginate(20);

        // Get statistics
        $stats = [
            'total' => InvestmentApplication::count(),
            'unread' => InvestmentApplication::unread()->count(),
            'pending' => InvestmentApplication::pending()->count(),
            'approved' => InvestmentApplication::where('status', InvestmentApplication::STATUS_APPROVED)->count(),
            'rejected' => InvestmentApplication::where('status', InvestmentApplication::STATUS_REJECTED)->count(),
        ];

        return view('admin.investment-applications.index', compact('applications', 'stats'));
    }

    /**
     * Display the specified investment application
     */
    public function show(InvestmentApplication $investmentApplication): View
    {
        $investmentApplication->load(['readBy', 'assignedTo', 'statusChangedBy']);

        // Mark as read if not already read
        if (!$investmentApplication->is_read) {
            $investmentApplication->markAsRead();
        }

        return view('admin.investment-applications.show', compact('investmentApplication'));
    }







    /**
     * Get application statistics for dashboard
     */
    public function getStats(): JsonResponse
    {
        $stats = [
            'total_applications' => InvestmentApplication::count(),
            'unread_applications' => InvestmentApplication::unread()->count(),
            'pending_applications' => InvestmentApplication::pending()->count(),
            'recent_applications' => InvestmentApplication::recent(7)->count(),
            'approved_this_month' => InvestmentApplication::where('status', InvestmentApplication::STATUS_APPROVED)
                ->whereMonth('created_at', now()->month)
                ->count(),
            'rejected_this_month' => InvestmentApplication::where('status', InvestmentApplication::STATUS_REJECTED)
                ->whereMonth('created_at', now()->month)
                ->count(),
        ];

        return response()->json($stats);
    }

    /**
     * Delete the specified investment application
     */
    public function destroy(InvestmentApplication $investmentApplication): RedirectResponse
    {
        try {
            $investmentApplication->delete();

            return redirect()->route('admin.investment-applications.index')
                ->with('success', __('admin.application_deleted'));
        } catch (\Exception $e) {
            Log::error('Failed to delete investment application', [
                'application_id' => $investmentApplication->id,
                'error' => $e->getMessage()
            ]);

            return redirect()->route('admin.investment-applications.index')
                ->with('error', __('admin.application_delete_failed'));
        }
    }

    /**
     * Update application status
     */
    public function updateStatus(Request $request, InvestmentApplication $investmentApplication): JsonResponse
    {

        $request->validate([
            'status' => 'required|in:pending,reviewed,approved,rejected'
        ]);


        try {
            $investmentApplication->update([
                'status' => $request->status,
                'status_changed_at' => now()
            ]);




            return response()->json([
                'success' => true,
                'message' => __('admin.status_updated_successfully'),
                'status' => $investmentApplication->status,
                'status_label' => $investmentApplication->getStatusLabel()
            ]);

        } catch (\Exception $e) {
            Log::error('Failed to update application status', [
                'application_id' => $investmentApplication->id,
                'error' => $e->getMessage()
            ]);

            return response()->json([
                'success' => false,
                'message' => __('admin.status_update_failed')
            ], 500);
        }
    }

    /**
     * Bulk actions for applications
     */
    public function bulkAction(Request $request)
    {
        $request->validate([
            'action' => 'required|in:delete,update_status,export',
            'applications' => 'required|array',
            'applications.*' => 'exists:investment_applications,id',
            'status' => 'required_if:action,update_status|in:pending,under_review,approved,rejected,on_hold'
        ]);

        try {
            $applications = InvestmentApplication::whereIn('id', $request->applications);

            switch ($request->action) {
                case 'delete':
                    $count = $applications->count();
                    $applications->delete();

                    return response()->json([
                        'success' => true,
                        'message' => __('admin.applications_deleted', ['count' => $count])
                    ]);

                case 'update_status':
                    $count = $applications->update([
                        'status' => $request->status,
                        'status_changed_at' => now()
                    ]);

                    return response()->json([
                        'success' => true,
                        'message' => __('admin.applications_status_updated', ['count' => $count])
                    ]);

                case 'export':
                    $selectedApplications = $applications->get();
                    return $this->exportApplications($selectedApplications);
            }
        } catch (\Exception $e) {
            Log::error('Bulk action failed', [
                'action' => $request->action,
                'applications' => $request->applications,
                'error' => $e->getMessage()
            ]);

            return response()->json([
                'success' => false,
                'message' => __('admin.bulk_action_failed')
            ], 500);
        }
    }

    /**
     * Export applications to Excel
     */
    public function export(Request $request)
    {
        Log::info('Export function called', ['request' => $request->all()]);

        try {
            $query = InvestmentApplication::query();

            // Apply same filters as index
            if ($request->filled('search')) {
                $search = $request->search;
                $query->where(function ($q) use ($search) {
                    $q->where('reference_number', 'like', "%{$search}%")
                      ->orWhere('full_name', 'like', "%{$search}%")
                      ->orWhere('name_per_commercial_registration', 'like', "%{$search}%")
                      ->orWhere('email', 'like', "%{$search}%");
                });
            }

            if ($request->filled('applicant_type')) {
                $query->where('applicant_type', $request->applicant_type);
            }

            if ($request->filled('status')) {
                $query->where('status', $request->status);
            }

            $applications = $query->get();

            Log::info('Applications found for export', ['count' => $applications->count()]);

            // Try Excel export first
            try {
                return Excel::download(
                    new InvestmentApplicationsExport($applications),
                    'investment-applications-' . date('Y-m-d-H-i-s') . '.xlsx'
                );
            } catch (\Exception $excelError) {
                Log::error('Excel export failed, trying CSV fallback', ['error' => $excelError->getMessage()]);

                // Fallback to CSV export
                return $this->exportAsCSV($applications);
            }

        } catch (\Exception $e) {
            Log::error('Export failed completely', ['error' => $e->getMessage()]);

            return redirect()->route('admin.investment-applications.index')
                ->with('error', __('admin.export_failed') . ': ' . $e->getMessage());
        }
    }

    /**
     * Export as CSV fallback
     */
    private function exportAsCSV($applications)
    {
        $filename = 'investment-applications-' . date('Y-m-d-H-i-s') . '.csv';

        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ];

        $callback = function() use ($applications) {
            $file = fopen('php://output', 'w');

            // Add BOM for UTF-8
            fwrite($file, "\xEF\xBB\xBF");

            // CSV Headers
            fputcsv($file, [
                __('admin.reference_number'),
                __('admin.applicant_type'),
                __('admin.full_name_company'),
                __('admin.national_id_cr'),
                __('admin.email'),
                __('admin.mobile_number'),
                __('admin.nationality'),
                __('admin.country_of_residence'),
                __('admin.number_of_shares'),
                __('admin.share_type'),
                __('admin.status'),
                __('admin.submission_date'),
            ]);

            // Data rows
            foreach ($applications as $application) {
                fputcsv($file, [
                    $application->reference_number,
                    $application->applicant_type === 'saudi_individual'
                        ? __('admin.saudi_individual')
                        : __('admin.company_institution'),
                    $application->applicant_type === 'saudi_individual'
                        ? $application->full_name
                        : $application->name_per_commercial_registration,
                    $application->applicant_type === 'saudi_individual'
                        ? $application->national_id_residence_number
                        : $application->commercial_registration_number,
                    $application->email,
                    $application->mobile_number,
                    $application->nationality,
                    $application->country_of_residence,
                    number_format($application->number_of_shares),
                    $application->getShareTypeLabel(),
                    $application->status,
                    $application->created_at->format('Y-m-d H:i:s'),
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    /**
     * Export selected applications
     */
    private function exportApplications($applications)
    {
        try {
            return Excel::download(
                new InvestmentApplicationsExport($applications),
                'selected-applications-' . date('Y-m-d-H-i-s') . '.xlsx'
            );
        } catch (\Exception $e) {
            Log::error('Selected export failed', ['error' => $e->getMessage()]);
            throw $e;
        }
    }
}

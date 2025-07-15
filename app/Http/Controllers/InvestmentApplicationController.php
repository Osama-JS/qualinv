<?php

namespace App\Http\Controllers;

use App\Models\InvestmentApplication;
use App\Models\Company;
use App\Mail\InvestmentApplicationMail;
use App\Http\Requests\InvestmentApplicationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

class InvestmentApplicationController extends Controller
{
    /**
     * Show the investment application form
     */
    public function create()
    {
                $company = Company::first();

        return view('investment-application',compact('company'));
    }

    /**
     * Store a new investment application
     */
    public function store(InvestmentApplicationRequest $request)
    {
        try {
            // Debug: Log incoming request data
            Log::info('Investment application request received', [
                'request_data' => $request->all(),
                'applicant_type' => $request->input('applicant_type')
            ]);

            // Validation is handled by InvestmentApplicationRequest

            // Create application instance
            $application = new InvestmentApplication();

            // Common fields
            $application->applicant_type = $request->applicant_type;
            $application->nationality = $request->nationality;
            $application->country_of_residence = $request->country_of_residence;
            $application->mobile_number = $request->mobile_number;
            $application->email = $request->email;
            $application->number_of_shares = $request->number_of_shares;
            $application->share_type = $request->share_type ?? InvestmentApplication::SHARE_TYPE_REGULAR;
            $application->status = InvestmentApplication::STATUS_PENDING;
            $application->is_read = false;
            $application->ip_address = $request->ip();
            $application->user_agent = $request->userAgent();

            // Saudi Individual specific fields
            if ($request->applicant_type === 'saudi_individual') {
                $application->national_id_residence_number = $request->national_id_residence_number;
                $application->date_of_birth = $request->date_of_birth;
                $application->full_name = $request->full_name;
                $application->profession = $request->profession;
            }

            // Company/Institution specific fields
            if ($request->applicant_type === 'company_institution') {
                $application->commercial_registration_number = $request->commercial_registration_number;
                $application->name_per_commercial_registration = $request->name_per_commercial_registration;
                $application->absher_registered_mobile = $request->absher_registered_mobile;
            }

            // Save application
            $application->save();

            // Send email notification
            $this->sendEmailNotification($application);

        // Check if request is AJAX
        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => app()->getLocale() === 'ar'
                    ? 'تم إرسال طلب الاستثمار بنجاح. سيتم التواصل معك خلال 3-5 أيام عمل.'
                    : 'Your investment application has been submitted successfully. We will contact you within 3-5 business days.',
                'redirect_url' => route('investment-application.success')
            ]);
        }

        return redirect()->route('investment-application.success')
            ->with('success', __('Your investment application has been submitted successfully. We will contact you soon.'));

        } catch (\Exception $e) {
            // Log the error for debugging
            Log::error('Investment application submission failed', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
                'request_data' => $request->except(['_token'])
            ]);
            if ($request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => app()->getLocale() === 'ar'
                        ? 'حدث خطأ أثناء معالجة طلبك. يرجى المحاولة مرة أخرى.'
                        : 'An error occurred while processing your request. Please try again.'
                ], 500);
            }

            return redirect()->back()
                ->withInput()
                ->withErrors(['error' => 'An error occurred while processing your request.']);
        }
    }

    /**
     * Show success page
     */
    public function success()
    {
        return view('investment-application-success');
    }

    /**
     * Send email notification for new investment application
     */
    private function sendEmailNotification(InvestmentApplication $application)
    {
        try {
            // Get company information for email recipient
            $company = Company::first();
            $recipientEmail = $company->contact_email ?? config('mail.from.address');

            // Send email to admin
            Mail::to($recipientEmail)->send(new InvestmentApplicationMail($application));

            // Log successful email sending
            Log::info('Investment application email sent successfully', [
                'application_id' => $application->id,
                'reference_number' => $application->reference_number,
                'recipient_email' => $recipientEmail
            ]);

        } catch (\Exception $e) {
            // Log email sending error but don't fail the application submission
            Log::error('Failed to send investment application email', [
                'application_id' => $application->id,
                'reference_number' => $application->reference_number,
                'error' => $e->getMessage()
            ]);
        }
    }
}

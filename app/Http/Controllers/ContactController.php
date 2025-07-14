<?php

namespace App\Http\Controllers;

use App\Mail\ContactMessageMail;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\JsonResponse;
use Illuminate\View\View;

class ContactController extends Controller
{
    /**
     * Show the contact form
     */
    public function index(): View
    {
        $company = Company::first();
        return view('contact', compact('company'));
    }

    /**
     * Handle contact form submission
     */
    public function store(Request $request): JsonResponse
    {
        // Enhanced validation with stricter rules
        $validated = $request->validate([
            'name' => [
                'required',
                'string',
                'min:2',
                'max:100',
                'regex:/^[\p{L}\p{N}\s\-\.\'\(\)]+$/u',
                'not_regex:/^[.\s\-0-9]+$/', // Prevent names with only dots, spaces, hyphens, or numbers
            ],
            'email' => [
                'required',
                'email:rfc,dns',
                'max:255',
                'not_regex:/\.\./', // Prevent double dots
            ],
            'phone' => 'nullable|string|min:8|max:20|regex:/^[\+]?[0-9\s\-\(\)]+$/',
            'subject' => [
                'required',
                'string',
                'min:5',
                'max:200',
                'not_regex:/^[\s\-\.]+$/', // Prevent subjects with only spaces, hyphens, or dots
            ],
            'message' => [
                'required',
                'string',
                'min:10',
                'max:2000',
                'not_regex:/^[\s\-\.]+$/', // Prevent messages with only spaces, hyphens, or dots
            ],
        ], [
            'name.required' => __('validation.contact_name_required'),
            'name.min' => __('validation.contact_name_min'),
            'name.max' => __('validation.contact_name_max'),
            'name.regex' => __('validation.contact_name_format'),
            'name.not_regex' => __('validation.contact_name_not_regex'),
            'email.required' => __('validation.contact_email_required'),
            'email.email' => __('validation.contact_email_format'),
            'email.not_regex' => __('validation.contact_email_not_regex'),
            'phone.min' => __('validation.contact_phone_min'),
            'phone.max' => __('validation.contact_phone_max'),
            'phone.regex' => __('validation.contact_phone_regex'),
            'subject.required' => __('validation.contact_subject_required'),
            'subject.min' => __('validation.contact_subject_min'),
            'subject.max' => __('validation.contact_subject_max'),
            'subject.not_regex' => __('validation.contact_subject_not_regex'),
            'message.required' => __('validation.contact_message_required'),
            'message.min' => __('validation.contact_message_min'),
            'message.max' => __('validation.contact_message_max'),
            'message.not_regex' => __('validation.contact_message_not_regex'),
        ]);

        try {
            // Comprehensive data validation and cleaning
            $cleanedName = $this->cleanNameForEmail($validated['name']);

            // Additional email validation
            if (!$this->validateEmailAddress($validated['email'])) {
                throw new \Exception('Invalid email address provided');
            }

            // Clean and validate subject
            $cleanedSubject = trim(preg_replace('/[\x00-\x1F\x7F]/', '', $validated['subject']));
            if (empty($cleanedSubject)) {
                $cleanedSubject = 'Contact Form Message';
            }

            // Clean message content
            $cleanedMessage = trim(preg_replace('/[\x00-\x08\x0B\x0C\x0E-\x1F\x7F]/', '', $validated['message']));

            // Prepare contact data with cleaned values
            $contactData = [
                'name' => $cleanedName,
                'email' => $validated['email'],
                'phone' => $validated['phone'] ?? null,
                'subject' => $cleanedSubject,
                'message' => $cleanedMessage,
                'ip_address' => $request->ip(),
                'user_agent' => $request->userAgent(),
                'sent_at' => now(),
            ];

            // Get company information for email recipient
            $company = Company::first();
            $recipientEmail = $company->contact_email ?? config('mail.from.address');

            // Validate recipient email
            if (!filter_var($recipientEmail, FILTER_VALIDATE_EMAIL)) {
                throw new \Exception('Invalid recipient email configuration');
            }

            // Send email with additional error handling
            Mail::to($recipientEmail)->send(new ContactMessageMail($contactData));

            // Log successful email sending
            Log::info('Contact message sent successfully', [
                'original_name' => $validated['name'],
                'cleaned_name' => $cleanedName,
                'email' => $validated['email'],
                'subject' => $validated['subject'],
                'recipient' => $recipientEmail,
                'ip_address' => $request->ip(),
            ]);

            return response()->json([
                'success' => true,
                'message' => app()->getLocale() === 'ar'
                    ? 'تم إرسال رسالتك بنجاح. سنتواصل معك قريباً.'
                    : 'Your message has been sent successfully. We will contact you soon.'
            ]);

        } catch (\Exception $e) {
            // Log the error with more details
            Log::error('Failed to send contact message', [
                'error' => $e->getMessage(),
                'error_line' => $e->getLine(),
                'error_file' => $e->getFile(),
                'original_name' => $validated['name'] ?? 'N/A',
                'email' => $validated['email'] ?? 'N/A',
                'subject' => $validated['subject'] ?? 'N/A',
                'ip_address' => $request->ip(),
                'user_agent' => $request->userAgent(),
            ]);

            return response()->json([
                'success' => false,
                'message' => app()->getLocale() === 'ar'
                    ? 'حدث خطأ أثناء إرسال الرسالة. يرجى المحاولة مرة أخرى.'
                    : 'An error occurred while sending your message. Please try again.'
            ], 500);
        }
    }

    /**
     * Clean name for email compliance with comprehensive validation
     */
    private function cleanNameForEmail(string $name): string
    {
        // First level: Basic cleaning
        $cleanName = trim($name);

        // Remove control characters and normalize whitespace
        $cleanName = preg_replace('/[\x00-\x1F\x7F]/', '', $cleanName);
        $cleanName = preg_replace('/\s+/', ' ', $cleanName);

        // Second level: Remove problematic characters for email headers
        // Allow letters, numbers, spaces, hyphens, dots, apostrophes, and parentheses
        $cleanName = preg_replace('/[^\p{L}\p{N}\s\-\.\'\(\)]/u', '', $cleanName);

        // Third level: Trim and validate
        $cleanName = trim($cleanName);

        // If empty after all cleaning, use safe default
        if (empty($cleanName) || strlen($cleanName) < 2) {
            return 'Website Visitor';
        }

        // Fourth level: Length limitation with proper UTF-8 handling
        if (mb_strlen($cleanName, 'UTF-8') > 50) {
            $cleanName = mb_substr($cleanName, 0, 47, 'UTF-8') . '...';
        }

        // Fifth level: Final validation - ensure no problematic patterns
        if (preg_match('/^[.\s-]+$/', $cleanName) ||
            preg_match('/^[0-9]+$/', $cleanName)) {
            return 'Website Visitor';
        }

        return $cleanName;
    }

    /**
     * Validate email address more strictly
     */
    private function validateEmailAddress(string $email): bool
    {
        // Basic filter validation
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return false;
        }

        // Additional checks for common issues
        if (strpos($email, '..') !== false ||
            strpos($email, '@.') !== false ||
            strpos($email, '.@') !== false) {
            return false;
        }

        // Check for valid domain
        $parts = explode('@', $email);
        if (count($parts) !== 2) {
            return false;
        }

        $domain = $parts[1];
        if (empty($domain) || !checkdnsrr($domain, 'MX') && !checkdnsrr($domain, 'A')) {
            return false;
        }

        return true;
    }
}

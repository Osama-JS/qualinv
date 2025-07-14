<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreInvestmentApplicationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true; // Allow public access for investment applications
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        $rules = [
            'applicant_type' => ['required', 'in:saudi_individual,company_institution'],
            'nationality' => ['required', 'string', 'max:100'],
            'country_of_residence' => ['required', 'string', 'max:100'],
            'mobile_number' => ['required', 'string', 'regex:/^[+]?[0-9\s\-\(\)]{10,20}$/', 'max:20'],
            'email' => ['required', 'email:rfc,dns', 'max:255'],
            'number_of_shares' => ['required', 'integer', 'min:1', 'max:1000000'],

            // Honeypot fields for bot detection
            'website' => ['nullable', 'max:0'], // Should be empty
            'phone' => ['nullable', 'max:0'],   // Should be empty

            // CAPTCHA verification
            'g-recaptcha-response' => ['required'],

            // Terms acceptance
            'terms_accepted' => ['required', 'accepted'],
            'privacy_accepted' => ['required', 'accepted'],
        ];

        // Saudi Individual specific validation
        if ($this->input('applicant_type') === 'saudi_individual') {
            $rules = array_merge($rules, [
                'national_id_residence_number' => [
                    'required',
                    'string',
                    'regex:/^[12][0-9]{9}$/', // Saudi National ID format
                    'unique:investment_applications,national_id_residence_number'
                ],
                'date_of_birth' => [
                    'required',
                    'date',
                    'before:' . now()->subYears(18)->format('Y-m-d'), // Must be 18+
                    'after:' . now()->subYears(100)->format('Y-m-d')  // Reasonable age limit
                ],
                'full_name' => [
                    'required',
                    'string',
                    'min:3',
                    'max:100',
                    'regex:/^[\p{Arabic}\p{L}\s\-\.]+$/u' // Arabic and Latin letters only
                ],
                'profession' => ['required', 'string', 'max:100'],
            ]);
        }

        // Company/Institution specific validation
        if ($this->input('applicant_type') === 'company_institution') {
            $rules = array_merge($rules, [
                'commercial_registration_number' => [
                    'required',
                    'string',
                    'regex:/^[0-9]{10}$/', // Saudi CR format
                    'unique:investment_applications,commercial_registration_number'
                ],
                'name_per_commercial_registration' => [
                    'required',
                    'string',
                    'min:3',
                    'max:200',
                    'regex:/^[\p{Arabic}\p{L}\s\-\.\&\(\)]+$/u'
                ],
                'absher_registered_mobile' => [
                    'required',
                    'string',
                    'regex:/^(05|5)[0-9]{8}$/' // Saudi mobile format
                ],
            ]);
        }

        return $rules;
    }

    /**
     * Get custom validation messages
     */
    public function messages(): array
    {
        return [
            'applicant_type.required' => __('validation.applicant_type_required'),
            'applicant_type.in' => __('validation.applicant_type_invalid'),
            'national_id_residence_number.regex' => __('validation.national_id_format'),
            'national_id_residence_number.unique' => __('validation.national_id_exists'),
            'commercial_registration_number.regex' => __('validation.cr_format'),
            'commercial_registration_number.unique' => __('validation.cr_exists'),
            'date_of_birth.before' => __('validation.must_be_adult'),
            'mobile_number.regex' => __('validation.mobile_format'),
            'absher_registered_mobile.regex' => __('validation.saudi_mobile_format'),
            'full_name.regex' => __('validation.name_format'),
            'name_per_commercial_registration.regex' => __('validation.company_name_format'),
            'number_of_shares.min' => __('validation.shares_minimum'),
            'number_of_shares.max' => __('validation.shares_maximum'),
            'email.email' => __('validation.email_format'),
            'g-recaptcha-response.required' => __('validation.captcha_required'),
            'terms_accepted.accepted' => __('validation.terms_required'),
            'privacy_accepted.accepted' => __('validation.privacy_required'),
            'website.max' => __('validation.bot_detected'),
            'phone.max' => __('validation.bot_detected'),
        ];
    }

    /**
     * Get custom attributes for validator errors
     */
    public function attributes(): array
    {
        return [
            'applicant_type' => __('admin.applicant_type'),
            'national_id_residence_number' => __('admin.national_id'),
            'commercial_registration_number' => __('admin.commercial_registration'),
            'date_of_birth' => __('admin.date_of_birth'),
            'full_name' => __('admin.full_name'),
            'profession' => __('admin.profession'),
            'name_per_commercial_registration' => __('admin.company_name'),
            'absher_registered_mobile' => __('admin.absher_mobile'),
            'nationality' => __('admin.nationality'),
            'country_of_residence' => __('admin.country_of_residence'),
            'mobile_number' => __('admin.mobile_number'),
            'email' => __('admin.email'),
            'number_of_shares' => __('admin.number_of_shares'),
        ];
    }

    /**
     * Prepare the data for validation
     */
    protected function prepareForValidation(): void
    {
        // Sanitize and normalize input data
        $this->merge([
            'mobile_number' => $this->sanitizePhoneNumber($this->input('mobile_number')),
            'email' => strtolower(trim($this->input('email'))),
            'full_name' => $this->sanitizeName($this->input('full_name')),
            'name_per_commercial_registration' => $this->sanitizeName($this->input('name_per_commercial_registration')),
            'nationality' => ucfirst(strtolower(trim($this->input('nationality')))),
            'country_of_residence' => ucfirst(strtolower(trim($this->input('country_of_residence')))),
            'profession' => ucfirst(strtolower(trim($this->input('profession')))),
        ]);
    }

    /**
     * Sanitize phone number
     */
    private function sanitizePhoneNumber(?string $phone): ?string
    {
        if (!$phone) return null;

        // Remove all non-numeric characters except +
        $phone = preg_replace('/[^\d+]/', '', $phone);

        // Normalize Saudi numbers
        if (preg_match('/^(05|5)/', $phone)) {
            $phone = '+966' . substr($phone, -9);
        }

        return $phone;
    }

    /**
     * Sanitize name fields
     */
    private function sanitizeName(?string $name): ?string
    {
        if (!$name) return null;

        // Trim and normalize spaces
        $name = preg_replace('/\s+/', ' ', trim($name));

        // Remove any potentially harmful characters while preserving Arabic and Latin
        $name = preg_replace('/[^\p{Arabic}\p{L}\s\-\.]/u', '', $name);

        return $name;
    }
}

<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class InvestmentApplicationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        $rules = [
            // Common fields
            'applicant_type' => 'required|in:saudi_individual,company_institution',
            'nationality' => 'required|string|min:2|max:100',
            'country_of_residence' => 'required|string|min:2|max:100',
            'mobile_number' => 'required|string|min:8|max:20',
            'email' => 'required|email|max:255',
            'number_of_shares' => 'required|integer|min:1|max:1000000',
            'share_type' => 'required|in:regular,redeemable',
        ];

        // Add conditional rules based on applicant type
        if ($this->input('applicant_type') === 'saudi_individual') {
            $rules['national_id_residence_number'] = 'required|string|size:10';
            $rules['date_of_birth'] = 'required|date|before:today';
            $rules['full_name'] = 'required|string|min:3|max:255';
            $rules['profession'] = 'required|string|min:2|max:100';
        } elseif ($this->input('applicant_type') === 'company_institution') {
            $rules['commercial_registration_number'] = 'required|string|size:10';
            $rules['name_per_commercial_registration'] = 'required|string|min:3|max:255';
            $rules['absher_registered_mobile'] = 'required|string|min:8|max:20';
        }

        return $rules;
    }


    /**
     * Get custom validation messages.
     */
    public function messages(): array
    {
        return [
            'applicant_type.required' => __('validation.applicant_type_required'),
            'nationality.required' => __('validation.nationality_required'),
            'country_of_residence.required' => __('validation.country_required'),
            'mobile_number.required' => __('validation.mobile_required'),
            'email.required' => __('validation.email_required'),
            'email.email' => __('validation.email_format'),
            'number_of_shares.required' => __('validation.shares_required'),
            'number_of_shares.min' => __('validation.shares_min'),
            'number_of_shares.max' => __('validation.shares_max'),
            'share_type.required' => __('validation.share_type_required'),
            'share_type.in' => __('validation.share_type_invalid'),
            'national_id_residence_number.required' => __('validation.national_id_required'),
            'national_id_residence_number.size' => __('validation.national_id_format'),
            'date_of_birth.required' => __('validation.birth_date_required'),
            'date_of_birth.before' => __('validation.birth_date_valid'),
            'full_name.required' => __('validation.full_name_required'),
            'full_name.min' => __('validation.full_name_min'),
            'profession.required' => __('validation.profession_required'),
            'commercial_registration_number.required' => __('validation.commercial_reg_required'),
            'commercial_registration_number.size' => __('validation.commercial_reg_format'),
            'name_per_commercial_registration.required' => __('validation.company_name_required'),
            'absher_registered_mobile.required' => __('validation.absher_mobile_required'),
        ];
    }

    /**
     * Get custom attributes for validator errors.
     */
    public function attributes(): array
    {
        return [
            'applicant_type' => __('validation.attributes.applicant_type'),
            'nationality' => __('validation.attributes.nationality'),
            'country_of_residence' => __('validation.attributes.country_of_residence'),
            'mobile_number' => __('validation.attributes.mobile_number'),
            'number_of_shares' => __('validation.attributes.number_of_shares'),
            'national_id_residence_number' => __('validation.attributes.national_id_residence_number'),
            'date_of_birth' => __('validation.attributes.date_of_birth'),
            'full_name' => __('validation.attributes.full_name'),
            'profession' => __('validation.attributes.profession'),
            'commercial_registration_number' => __('validation.attributes.commercial_registration_number'),
            'name_per_commercial_registration' => __('validation.attributes.name_per_commercial_registration'),
            'absher_registered_mobile' => __('validation.attributes.absher_registered_mobile'),
        ];
    }

    /**
     * Handle a failed validation attempt.
     */
    protected function failedValidation(\Illuminate\Contracts\Validation\Validator $validator)
    {
        if ($this->expectsJson()) {
            $response = response()->json([
                'success' => false,
                'message' => app()->getLocale() === 'ar'
                    ? 'يرجى تصحيح الأخطاء في النموذج'
                    : 'Please correct the errors in the form',
                'errors' => $validator->errors()
            ], 422);

            throw new \Illuminate\Http\Exceptions\HttpResponseException($response);
        }

        parent::failedValidation($validator);
    }
}

<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */

    'accepted' => 'The :attribute field must be accepted.',
    'accepted_if' => 'The :attribute field must be accepted when :other is :value.',
    'active_url' => 'The :attribute field must be a valid URL.',
    'after' => 'The :attribute field must be a date after :date.',
    'after_or_equal' => 'The :attribute field must be a date after or equal to :date.',
    'alpha' => 'The :attribute field must only contain letters.',
    'alpha_dash' => 'The :attribute field must only contain letters, numbers, dashes, and underscores.',
    'alpha_num' => 'The :attribute field must only contain letters and numbers.',
    'any_of' => 'The :attribute field is invalid.',
    'array' => 'The :attribute field must be an array.',
    'ascii' => 'The :attribute field must only contain single-byte alphanumeric characters and symbols.',
    'before' => 'The :attribute field must be a date before :date.',
    'before_or_equal' => 'The :attribute field must be a date before or equal to :date.',
    'between' => [
        'array' => 'The :attribute field must have between :min and :max items.',
        'file' => 'The :attribute field must be between :min and :max kilobytes.',
        'numeric' => 'The :attribute field must be between :min and :max.',
        'string' => 'The :attribute field must be between :min and :max characters.',
    ],
    'boolean' => 'The :attribute field must be true or false.',
    'can' => 'The :attribute field contains an unauthorized value.',
    'confirmed' => 'The :attribute field confirmation does not match.',
    'contains' => 'The :attribute field is missing a required value.',
    'current_password' => 'The password is incorrect.',
    'date' => 'The :attribute field must be a valid date.',
    'date_equals' => 'The :attribute field must be a date equal to :date.',
    'date_format' => 'The :attribute field must match the format :format.',
    'decimal' => 'The :attribute field must have :decimal decimal places.',
    'declined' => 'The :attribute field must be declined.',
    'declined_if' => 'The :attribute field must be declined when :other is :value.',
    'different' => 'The :attribute field and :other must be different.',
    'digits' => 'The :attribute field must be :digits digits.',
    'digits_between' => 'The :attribute field must be between :min and :max digits.',
    'dimensions' => 'The :attribute field has invalid image dimensions.',
    'distinct' => 'The :attribute field has a duplicate value.',
    'doesnt_end_with' => 'The :attribute field must not end with one of the following: :values.',
    'doesnt_start_with' => 'The :attribute field must not start with one of the following: :values.',
    'email' => 'The :attribute field must be a valid email address.',
    'ends_with' => 'The :attribute field must end with one of the following: :values.',
    'enum' => 'The selected :attribute is invalid.',
    'exists' => 'The selected :attribute is invalid.',
    'extensions' => 'The :attribute field must have one of the following extensions: :values.',
    'file' => 'The :attribute field must be a file.',
    'filled' => 'The :attribute field must have a value.',
    'gt' => [
        'array' => 'The :attribute field must have more than :value items.',
        'file' => 'The :attribute field must be greater than :value kilobytes.',
        'numeric' => 'The :attribute field must be greater than :value.',
        'string' => 'The :attribute field must be greater than :value characters.',
    ],
    'gte' => [
        'array' => 'The :attribute field must have :value items or more.',
        'file' => 'The :attribute field must be greater than or equal to :value kilobytes.',
        'numeric' => 'The :attribute field must be greater than or equal to :value.',
        'string' => 'The :attribute field must be greater than or equal to :value characters.',
    ],
    'hex_color' => 'The :attribute field must be a valid hexadecimal color.',
    'image' => 'The :attribute field must be an image.',
    'in' => 'The selected :attribute is invalid.',
    'in_array' => 'The :attribute field must exist in :other.',
    'in_array_keys' => 'The :attribute field must contain at least one of the following keys: :values.',
    'integer' => 'The :attribute field must be an integer.',
    'ip' => 'The :attribute field must be a valid IP address.',
    'ipv4' => 'The :attribute field must be a valid IPv4 address.',
    'ipv6' => 'The :attribute field must be a valid IPv6 address.',
    'json' => 'The :attribute field must be a valid JSON string.',
    'list' => 'The :attribute field must be a list.',
    'lowercase' => 'The :attribute field must be lowercase.',
    'lt' => [
        'array' => 'The :attribute field must have less than :value items.',
        'file' => 'The :attribute field must be less than :value kilobytes.',
        'numeric' => 'The :attribute field must be less than :value.',
        'string' => 'The :attribute field must be less than :value characters.',
    ],
    'lte' => [
        'array' => 'The :attribute field must not have more than :value items.',
        'file' => 'The :attribute field must be less than or equal to :value kilobytes.',
        'numeric' => 'The :attribute field must be less than or equal to :value.',
        'string' => 'The :attribute field must be less than or equal to :value characters.',
    ],
    'mac_address' => 'The :attribute field must be a valid MAC address.',
    'max' => [
        'array' => 'The :attribute field must not have more than :max items.',
        'file' => 'The :attribute field must not be greater than :max kilobytes.',
        'numeric' => 'The :attribute field must not be greater than :max.',
        'string' => 'The :attribute field must not be greater than :max characters.',
    ],
    'max_digits' => 'The :attribute field must not have more than :max digits.',
    'mimes' => 'The :attribute field must be a file of type: :values.',
    'mimetypes' => 'The :attribute field must be a file of type: :values.',
    'min' => [
        'array' => 'The :attribute field must have at least :min items.',
        'file' => 'The :attribute field must be at least :min kilobytes.',
        'numeric' => 'The :attribute field must be at least :min.',
        'string' => 'The :attribute field must be at least :min characters.',
    ],
    'min_digits' => 'The :attribute field must have at least :min digits.',
    'missing' => 'The :attribute field must be missing.',
    'missing_if' => 'The :attribute field must be missing when :other is :value.',
    'missing_unless' => 'The :attribute field must be missing unless :other is :value.',
    'missing_with' => 'The :attribute field must be missing when :values is present.',
    'missing_with_all' => 'The :attribute field must be missing when :values are present.',
    'multiple_of' => 'The :attribute field must be a multiple of :value.',
    'not_in' => 'The selected :attribute is invalid.',
    'not_regex' => 'The :attribute field format is invalid.',
    'numeric' => 'The :attribute field must be a number.',
    'password' => [
        'letters' => 'The :attribute field must contain at least one letter.',
        'mixed' => 'The :attribute field must contain at least one uppercase and one lowercase letter.',
        'numbers' => 'The :attribute field must contain at least one number.',
        'symbols' => 'The :attribute field must contain at least one symbol.',
        'uncompromised' => 'The given :attribute has appeared in a data leak. Please choose a different :attribute.',
    ],
    'present' => 'The :attribute field must be present.',
    'present_if' => 'The :attribute field must be present when :other is :value.',
    'present_unless' => 'The :attribute field must be present unless :other is :value.',
    'present_with' => 'The :attribute field must be present when :values is present.',
    'present_with_all' => 'The :attribute field must be present when :values are present.',
    'prohibited' => 'The :attribute field is prohibited.',
    'prohibited_if' => 'The :attribute field is prohibited when :other is :value.',
    'prohibited_if_accepted' => 'The :attribute field is prohibited when :other is accepted.',
    'prohibited_if_declined' => 'The :attribute field is prohibited when :other is declined.',
    'prohibited_unless' => 'The :attribute field is prohibited unless :other is in :values.',
    'prohibits' => 'The :attribute field prohibits :other from being present.',
    'regex' => 'The :attribute field format is invalid.',
    'required' => 'The :attribute field is required.',
    'required_array_keys' => 'The :attribute field must contain entries for: :values.',
    'required_if' => 'The :attribute field is required when :other is :value.',
    'required_if_accepted' => 'The :attribute field is required when :other is accepted.',
    'required_if_declined' => 'The :attribute field is required when :other is declined.',
    'required_unless' => 'The :attribute field is required unless :other is in :values.',
    'required_with' => 'The :attribute field is required when :values is present.',
    'required_with_all' => 'The :attribute field is required when :values are present.',
    'required_without' => 'The :attribute field is required when :values is not present.',
    'required_without_all' => 'The :attribute field is required when none of :values are present.',
    'same' => 'The :attribute field must match :other.',
    'size' => [
        'array' => 'The :attribute field must contain :size items.',
        'file' => 'The :attribute field must be :size kilobytes.',
        'numeric' => 'The :attribute field must be :size.',
        'string' => 'The :attribute field must be :size characters.',
    ],
    'starts_with' => 'The :attribute field must start with one of the following: :values.',
    'string' => 'The :attribute field must be a string.',
    'timezone' => 'The :attribute field must be a valid timezone.',
    'unique' => 'The :attribute has already been taken.',
    'uploaded' => 'The :attribute failed to upload.',
    'uppercase' => 'The :attribute field must be uppercase.',
    'url' => 'The :attribute field must be a valid URL.',
    'ulid' => 'The :attribute field must be a valid ULID.',
    'uuid' => 'The :attribute field must be a valid UUID.',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap our attribute placeholder
    | with something more reader friendly such as "E-Mail Address" instead
    | of "email". This simply helps us make our message more expressive.
    |
    */

    'attributes' => [
        // Investment Application Fields
        'applicant_type' => 'Applicant Type',
        'nationality' => 'Nationality',
        'country_of_residence' => 'Country of Residence',
        'mobile_number' => 'Mobile Number',
        'number_of_shares' => 'Number of Shares',
        'national_id_residence_number' => 'National ID',
        'date_of_birth' => 'Date of Birth',
        'full_name' => 'Full Name',
        'profession' => 'Profession',
        'commercial_registration_number' => 'Commercial Registration Number',
        'name_per_commercial_registration' => 'Company Name',
        'absher_registered_mobile' => 'Absher Registered Mobile',
        'share_type' => 'Share Type',
    ],

    // Investment Application Custom Validation Messages
    'applicant_type_required' => 'Please select an applicant type',
    'nationality_required' => 'Please enter your nationality',
    'country_required' => 'Please enter your country of residence',
    'mobile_required' => 'Please enter your mobile number',
    'mobile_format' => 'Invalid mobile number format',
    'email_required' => 'Please enter your email address',
    'email_format' => 'Invalid email format',
    'shares_required' => 'Please enter the number of shares',
    'shares_min' => 'Number of shares must be greater than zero',
    'shares_max' => 'Number of shares requested is too large',
    'national_id_required' => 'Please enter your National ID',
    'national_id_format' => 'National ID must be 10 digits',
    'birth_date_required' => 'Please enter your date of birth',
    'birth_date_valid' => 'Invalid date of birth',
    'full_name_required' => 'Please enter your full name',
    'full_name_min' => 'Full name must be at least 3 characters',
    'profession_required' => 'Please enter your profession',
    'commercial_reg_required' => 'Please enter the commercial registration number',
    'commercial_reg_format' => 'Commercial registration number must be 10 digits',
    'company_name_required' => 'Please enter the company name',
    'absher_mobile_required' => 'Please enter the Absher registered mobile',
    'absher_mobile_format' => 'Invalid Absher mobile format',

    // Additional validation messages
    'must_be_adult' => 'Applicant must be at least 18 years old',
    'national_id_exists' => 'An application with this National ID already exists',
    'cr_exists' => 'An application with this Commercial Registration already exists',
    'duplicate_application' => 'You have already submitted an application within the last 24 hours',
    'name_format' => 'Name can only contain letters, spaces, hyphens, and dots',
    'share_type_required' => 'Please select a share type',
    'share_type_invalid' => 'The selected share type is invalid',

    // Contact Form Validation
    'contact_name_required' => 'Name is required',
    'contact_name_min' => 'Name must be at least 2 characters',
    'contact_name_max' => 'Name must not exceed 100 characters',
    'contact_name_format' => 'Name can only contain letters, spaces, hyphens, and dots',
    'contact_email_required' => 'Email is required',
    'contact_email_format' => 'Please enter a valid email address',
    'contact_phone_min' => 'Phone number must be at least 8 digits',
    'contact_phone_max' => 'Phone number must not exceed 20 digits',
    'contact_subject_required' => 'Subject is required',
    'contact_subject_min' => 'Subject must be at least 5 characters',
    'contact_subject_max' => 'Subject must not exceed 200 characters',
    'contact_message_required' => 'Message is required',
    'contact_message_min' => 'Message must be at least 10 characters',
    'contact_message_max' => 'Message must not exceed 2000 characters',

    // Enhanced validation messages
    'contact_name_not_regex' => 'Name cannot contain only numbers or symbols',
    'contact_email_not_regex' => 'Email contains invalid formatting',
    'contact_subject_not_regex' => 'Subject must contain meaningful text',
    'contact_message_not_regex' => 'Message must contain meaningful content',
    'contact_phone_regex' => 'Phone number contains invalid characters',

    // Profile Validation
    'profile_name_required' => 'Name is required',
    'profile_name_min' => 'Name must be at least 2 characters',
    'profile_name_max' => 'Name must not exceed 255 characters',
    'profile_email_required' => 'Email is required',
    'profile_email_format' => 'Please enter a valid email address',
    'profile_email_unique' => 'This email is already taken',
    'profile_phone_format' => 'Invalid phone number format',
    'profile_bio_max' => 'Bio must not exceed 500 characters',
    'profile_avatar_image' => 'File must be an image',
    'profile_avatar_mimes' => 'Image must be of type: jpeg, png, jpg, gif',
    'profile_avatar_max' => 'Image size must not exceed 2MB',

    // Password Validation
    'current_password_required' => 'Current password is required',
    'current_password_incorrect' => 'Current password is incorrect',
    'new_password_required' => 'New password is required',
    'new_password_min' => 'New password must be at least 8 characters',
    'new_password_confirmed' => 'Password confirmation does not match',

];

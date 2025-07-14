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

    'accepted' => 'يجب قبول :attribute.',
    'accepted_if' => 'يجب قبول :attribute عندما يكون :other هو :value.',
    'active_url' => ':attribute ليس رابطاً صحيحاً.',
    'after' => 'يجب أن يكون :attribute تاريخاً بعد :date.',
    'after_or_equal' => 'يجب أن يكون :attribute تاريخاً بعد أو يساوي :date.',
    'alpha' => 'يجب أن يحتوي :attribute على أحرف فقط.',
    'alpha_dash' => 'يجب أن يحتوي :attribute على أحرف وأرقام وشرطات فقط.',
    'alpha_num' => 'يجب أن يحتوي :attribute على أحرف وأرقام فقط.',
    'array' => 'يجب أن يكون :attribute مصفوفة.',
    'ascii' => 'يجب أن يحتوي :attribute على أحرف ورموز أحادية البايت فقط.',
    'before' => 'يجب أن يكون :attribute تاريخاً قبل :date.',
    'before_or_equal' => 'يجب أن يكون :attribute تاريخاً قبل أو يساوي :date.',
    'between' => [
        'array' => 'يجب أن يحتوي :attribute على عدد من العناصر بين :min و :max.',
        'file' => 'يجب أن يكون حجم :attribute بين :min و :max كيلوبايت.',
        'numeric' => 'يجب أن تكون قيمة :attribute بين :min و :max.',
        'string' => 'يجب أن يكون طول :attribute بين :min و :max حرف.',
    ],
    'boolean' => 'يجب أن تكون قيمة :attribute إما true أو false.',
    'can' => 'يحتوي :attribute على قيمة غير مصرح بها.',
    'confirmed' => 'تأكيد :attribute غير متطابق.',
    'current_password' => 'كلمة المرور غير صحيحة.',
    'date' => ':attribute ليس تاريخاً صحيحاً.',
    'date_equals' => 'يجب أن يكون :attribute تاريخاً مساوياً لـ :date.',
    'date_format' => ':attribute لا يتطابق مع الشكل :format.',
    'decimal' => 'يجب أن يحتوي :attribute على :decimal منازل عشرية.',
    'declined' => 'يجب رفض :attribute.',
    'declined_if' => 'يجب رفض :attribute عندما يكون :other هو :value.',
    'different' => 'يجب أن يكون :attribute و :other مختلفين.',
    'digits' => 'يجب أن يحتوي :attribute على :digits رقم.',
    'digits_between' => 'يجب أن يحتوي :attribute على عدد من الأرقام بين :min و :max.',
    'dimensions' => ':attribute يحتوي على أبعاد صورة غير صحيحة.',
    'distinct' => ':attribute يحتوي على قيمة مكررة.',
    'doesnt_end_with' => 'يجب ألا ينتهي :attribute بأحد القيم التالية: :values.',
    'doesnt_start_with' => 'يجب ألا يبدأ :attribute بأحد القيم التالية: :values.',
    'email' => 'يجب أن يكون :attribute عنوان بريد إلكتروني صحيح.',
    'ends_with' => 'يجب أن ينتهي :attribute بأحد القيم التالية: :values.',
    'enum' => ':attribute المحدد غير صحيح.',
    'exists' => ':attribute المحدد غير صحيح.',
    'extensions' => 'يجب أن يحتوي :attribute على أحد الامتدادات التالية: :values.',
    'file' => 'يجب أن يكون :attribute ملفاً.',
    'filled' => 'يجب أن يحتوي :attribute على قيمة.',
    'gt' => [
        'array' => 'يجب أن يحتوي :attribute على أكثر من :value عنصر.',
        'file' => 'يجب أن يكون حجم :attribute أكبر من :value كيلوبايت.',
        'numeric' => 'يجب أن تكون قيمة :attribute أكبر من :value.',
        'string' => 'يجب أن يكون طول :attribute أكبر من :value حرف.',
    ],
    'gte' => [
        'array' => 'يجب أن يحتوي :attribute على :value عنصر أو أكثر.',
        'file' => 'يجب أن يكون حجم :attribute أكبر من أو يساوي :value كيلوبايت.',
        'numeric' => 'يجب أن تكون قيمة :attribute أكبر من أو تساوي :value.',
        'string' => 'يجب أن يكون طول :attribute أكبر من أو يساوي :value حرف.',
    ],
    'hex_color' => 'يجب أن يكون :attribute لون سادس عشري صحيح.',
    'image' => 'يجب أن يكون :attribute صورة.',
    'in' => ':attribute المحدد غير صحيح.',
    'in_array' => ':attribute غير موجود في :other.',
    'integer' => 'يجب أن يكون :attribute رقماً صحيحاً.',
    'ip' => 'يجب أن يكون :attribute عنوان IP صحيح.',
    'ipv4' => 'يجب أن يكون :attribute عنوان IPv4 صحيح.',
    'ipv6' => 'يجب أن يكون :attribute عنوان IPv6 صحيح.',
    'json' => 'يجب أن يكون :attribute نص JSON صحيح.',
    'lowercase' => 'يجب أن يكون :attribute بأحرف صغيرة.',
    'lt' => [
        'array' => 'يجب أن يحتوي :attribute على أقل من :value عنصر.',
        'file' => 'يجب أن يكون حجم :attribute أقل من :value كيلوبايت.',
        'numeric' => 'يجب أن تكون قيمة :attribute أقل من :value.',
        'string' => 'يجب أن يكون طول :attribute أقل من :value حرف.',
    ],
    'lte' => [
        'array' => 'يجب ألا يحتوي :attribute على أكثر من :value عنصر.',
        'file' => 'يجب أن يكون حجم :attribute أقل من أو يساوي :value كيلوبايت.',
        'numeric' => 'يجب أن تكون قيمة :attribute أقل من أو تساوي :value.',
        'string' => 'يجب أن يكون طول :attribute أقل من أو يساوي :value حرف.',
    ],
    'mac_address' => 'يجب أن يكون :attribute عنوان MAC صحيح.',
    'max' => [
        'array' => 'يجب ألا يحتوي :attribute على أكثر من :max عنصر.',
        'file' => 'يجب ألا يكون حجم :attribute أكبر من :max كيلوبايت.',
        'numeric' => 'يجب ألا تكون قيمة :attribute أكبر من :max.',
        'string' => 'يجب ألا يكون طول :attribute أكبر من :max حرف.',
    ],
    'max_digits' => 'يجب ألا يحتوي :attribute على أكثر من :max رقم.',
    'mimes' => 'يجب أن يكون :attribute ملف من نوع: :values.',
    'mimetypes' => 'يجب أن يكون :attribute ملف من نوع: :values.',
    'min' => [
        'array' => 'يجب أن يحتوي :attribute على الأقل على :min عنصر.',
        'file' => 'يجب أن يكون حجم :attribute على الأقل :min كيلوبايت.',
        'numeric' => 'يجب أن تكون قيمة :attribute على الأقل :min.',
        'string' => 'يجب أن يكون طول :attribute على الأقل :min حرف.',
    ],
    'min_digits' => 'يجب أن يحتوي :attribute على الأقل على :min رقم.',
    'missing' => 'يجب أن يكون :attribute مفقوداً.',
    'missing_if' => 'يجب أن يكون :attribute مفقوداً عندما يكون :other هو :value.',
    'missing_unless' => 'يجب أن يكون :attribute مفقوداً إلا إذا كان :other هو :value.',
    'missing_with' => 'يجب أن يكون :attribute مفقوداً عندما يكون :values موجوداً.',
    'missing_with_all' => 'يجب أن يكون :attribute مفقوداً عندما تكون :values موجودة.',
    'multiple_of' => 'يجب أن يكون :attribute مضاعف :value.',
    'not_in' => ':attribute المحدد غير صحيح.',
    'not_regex' => 'تنسيق :attribute غير صحيح.',
    'numeric' => 'يجب أن يكون :attribute رقماً.',
    'password' => [
        'letters' => 'يجب أن يحتوي :attribute على حرف واحد على الأقل.',
        'mixed' => 'يجب أن يحتوي :attribute على حرف كبير وحرف صغير على الأقل.',
        'numbers' => 'يجب أن يحتوي :attribute على رقم واحد على الأقل.',
        'symbols' => 'يجب أن يحتوي :attribute على رمز واحد على الأقل.',
        'uncompromised' => ':attribute المعطى ظهر في تسريب بيانات. يرجى اختيار :attribute مختلف.',
    ],
    'present' => 'يجب أن يكون :attribute موجوداً.',
    'present_if' => 'يجب أن يكون :attribute موجوداً عندما يكون :other هو :value.',
    'present_unless' => 'يجب أن يكون :attribute موجوداً إلا إذا كان :other هو :value.',
    'present_with' => 'يجب أن يكون :attribute موجوداً عندما يكون :values موجوداً.',
    'present_with_all' => 'يجب أن يكون :attribute موجوداً عندما تكون :values موجودة.',
    'prohibited' => ':attribute محظور.',
    'prohibited_if' => ':attribute محظور عندما يكون :other هو :value.',
    'prohibited_unless' => ':attribute محظور إلا إذا كان :other في :values.',
    'prohibits' => ':attribute يحظر وجود :other.',
    'regex' => 'تنسيق :attribute غير صحيح.',
    'required' => ':attribute مطلوب.',
    'required_array_keys' => 'يجب أن يحتوي :attribute على مدخلات لـ: :values.',
    'required_if' => ':attribute مطلوب عندما يكون :other هو :value.',
    'required_if_accepted' => ':attribute مطلوب عندما يتم قبول :other.',
    'required_unless' => ':attribute مطلوب إلا إذا كان :other في :values.',
    'required_with' => ':attribute مطلوب عندما يكون :values موجوداً.',
    'required_with_all' => ':attribute مطلوب عندما تكون :values موجودة.',
    'required_without' => ':attribute مطلوب عندما لا يكون :values موجوداً.',
    'required_without_all' => ':attribute مطلوب عندما لا تكون أي من :values موجودة.',
    'same' => 'يجب أن يتطابق :attribute مع :other.',
    'size' => [
        'array' => 'يجب أن يحتوي :attribute على :size عنصر.',
        'file' => 'يجب أن يكون حجم :attribute :size كيلوبايت.',
        'numeric' => 'يجب أن تكون قيمة :attribute :size.',
        'string' => 'يجب أن يكون طول :attribute :size حرف.',
    ],
    'starts_with' => 'يجب أن يبدأ :attribute بأحد القيم التالية: :values.',
    'string' => 'يجب أن يكون :attribute نص.',
    'timezone' => 'يجب أن يكون :attribute منطقة زمنية صحيحة.',
    'unique' => ':attribute مُستخدم من قبل.',
    'uploaded' => 'فشل في تحميل :attribute.',
    'uppercase' => 'يجب أن يكون :attribute بأحرف كبيرة.',
    'url' => 'يجب أن يكون :attribute رابط صحيح.',
    'ulid' => 'يجب أن يكون :attribute ULID صحيح.',
    'uuid' => 'يجب أن يكون :attribute UUID صحيح.',

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
        'name' => 'الاسم',
        'username' => 'اسم المستخدم',
        'email' => 'البريد الإلكتروني',
        'password' => 'كلمة المرور',
        'password_confirmation' => 'تأكيد كلمة المرور',
        'city' => 'المدينة',
        'country' => 'الدولة',
        'address' => 'العنوان',
        'phone' => 'الهاتف',
        'mobile' => 'الجوال',
        'age' => 'العمر',
        'sex' => 'الجنس',
        'gender' => 'النوع',
        'day' => 'اليوم',
        'month' => 'الشهر',
        'year' => 'السنة',
        'hour' => 'ساعة',
        'minute' => 'دقيقة',
        'second' => 'ثانية',
        'title' => 'العنوان',
        'content' => 'المحتوى',
        'description' => 'الوصف',
        'excerpt' => 'المقتطف',
        'date' => 'التاريخ',
        'time' => 'الوقت',
        'available' => 'متاح',
        'size' => 'الحجم',
        'file' => 'الملف',
        'image' => 'الصورة',
        'photo' => 'الصورة',
        'avatar' => 'الصورة الشخصية',
        'subject' => 'الموضوع',
        'message' => 'الرسالة',
        'first_name' => 'الاسم الأول',
        'last_name' => 'الاسم الأخير',
        'position' => 'المنصب',
        'bio' => 'السيرة الذاتية',
        'website' => 'الموقع الإلكتروني',
        'social_media' => 'وسائل التواصل الاجتماعي',
        'about' => 'حول',
        'mission' => 'الرسالة',
        'vision' => 'الرؤية',
        'values' => 'القيم',
        'logo' => 'الشعار',
        'icon' => 'الأيقونة',
        'slug' => 'الرابط المختصر',
        'status' => 'الحالة',
        'type' => 'النوع',
        'role' => 'الدور',
        'is_active' => 'نشط',
        'featured_image' => 'الصورة المميزة',
        'published_at' => 'تاريخ النشر',
        'sort_order' => 'ترتيب العرض',

        // Investment Application Fields
        'applicant_type' => 'نوع مقدم الطلب',
        'nationality' => 'الجنسية',
        'country_of_residence' => 'بلد الإقامة',
        'mobile_number' => 'رقم الجوال',
        'number_of_shares' => 'عدد الأسهم',
        'national_id_residence_number' => 'رقم الهوية الوطنية',
        'date_of_birth' => 'تاريخ الميلاد',
        'full_name' => 'الاسم الكامل',
        'profession' => 'المهنة',
        'commercial_registration_number' => 'رقم السجل التجاري',
        'name_per_commercial_registration' => 'اسم الشركة',
        'absher_registered_mobile' => 'جوال أبشر المسجل',
        'share_type' => 'نوع السهم',
    ],

    // Investment Application Custom Validation Messages
    'applicant_type_required' => 'يرجى اختيار نوع مقدم الطلب',
    'nationality_required' => 'يرجى إدخال الجنسية',
    'country_required' => 'يرجى إدخال بلد الإقامة',
    'mobile_required' => 'يرجى إدخال رقم الجوال',
    'mobile_format' => 'تنسيق رقم الجوال غير صحيح',
    'email_required' => 'يرجى إدخال البريد الإلكتروني',
    'email_format' => 'تنسيق البريد الإلكتروني غير صحيح',
    'shares_required' => 'يرجى إدخال عدد الأسهم',
    'shares_min' => 'يجب أن يكون عدد الأسهم أكبر من صفر',
    'shares_max' => 'عدد الأسهم المطلوب كبير جداً',
    'national_id_required' => 'يرجى إدخال رقم الهوية الوطنية',
    'national_id_format' => 'رقم الهوية الوطنية يجب أن يكون 10 أرقام',
    'birth_date_required' => 'يرجى إدخال تاريخ الميلاد',
    'birth_date_valid' => 'تاريخ الميلاد غير صحيح',
    'full_name_required' => 'يرجى إدخال الاسم الكامل',
    'full_name_min' => 'الاسم الكامل يجب أن يكون 3 أحرف على الأقل',
    'profession_required' => 'يرجى إدخال المهنة',
    'commercial_reg_required' => 'يرجى إدخال رقم السجل التجاري',
    'commercial_reg_format' => 'رقم السجل التجاري يجب أن يكون 10 أرقام',
    'company_name_required' => 'يرجى إدخال اسم الشركة',
    'absher_mobile_required' => 'يرجى إدخال جوال أبشر المسجل',
    'absher_mobile_format' => 'تنسيق جوال أبشر غير صحيح',

    // Additional validation messages
    'must_be_adult' => 'يجب أن يكون عمر مقدم الطلب 18 سنة على الأقل',
    'national_id_exists' => 'يوجد طلب مسجل بهذا الرقم الوطني مسبقاً',
    'cr_exists' => 'يوجد طلب مسجل بهذا السجل التجاري مسبقاً',
    'duplicate_application' => 'لقد قمت بتقديم طلب خلال آخر 24 ساعة',
    'name_format' => 'الاسم يجب أن يحتوي على أحرف ومسافات وشرطات ونقاط فقط',
    'share_type_required' => 'يرجى اختيار نوع السهم',
    'share_type_invalid' => 'نوع السهم المحدد غير صحيح',

    // Contact Form Validation
    'contact_name_required' => 'الاسم مطلوب',
    'contact_name_min' => 'الاسم يجب أن يكون على الأقل حرفين',
    'contact_name_max' => 'الاسم يجب ألا يزيد عن 100 حرف',
    'contact_name_format' => 'الاسم يجب أن يحتوي على أحرف ومسافات وشرطات ونقاط فقط',
    'contact_email_required' => 'البريد الإلكتروني مطلوب',
    'contact_email_format' => 'يرجى إدخال بريد إلكتروني صحيح',
    'contact_phone_min' => 'رقم الهاتف يجب أن يكون على الأقل 8 أرقام',
    'contact_phone_max' => 'رقم الهاتف يجب ألا يزيد عن 20 رقم',
    'contact_subject_required' => 'الموضوع مطلوب',
    'contact_subject_min' => 'الموضوع يجب أن يكون على الأقل 5 أحرف',
    'contact_subject_max' => 'الموضوع يجب ألا يزيد عن 200 حرف',
    'contact_message_required' => 'الرسالة مطلوبة',
    'contact_message_min' => 'الرسالة يجب أن تكون على الأقل 10 أحرف',
    'contact_message_max' => 'الرسالة يجب ألا تزيد عن 2000 حرف',

    // Enhanced validation messages
    'contact_name_not_regex' => 'الاسم لا يمكن أن يحتوي على أرقام أو رموز فقط',
    'contact_email_not_regex' => 'البريد الإلكتروني يحتوي على تنسيق غير صحيح',
    'contact_subject_not_regex' => 'الموضوع يجب أن يحتوي على نص مفيد',
    'contact_message_not_regex' => 'الرسالة يجب أن تحتوي على محتوى مفيد',
    'contact_phone_regex' => 'رقم الهاتف يحتوي على أحرف غير صحيحة',

    // Profile Validation
    'profile_name_required' => 'الاسم مطلوب',
    'profile_name_min' => 'الاسم يجب أن يكون على الأقل حرفين',
    'profile_name_max' => 'الاسم يجب ألا يزيد عن 255 حرف',
    'profile_email_required' => 'البريد الإلكتروني مطلوب',
    'profile_email_format' => 'يرجى إدخال بريد إلكتروني صحيح',
    'profile_email_unique' => 'هذا البريد الإلكتروني مستخدم بالفعل',
    'profile_phone_format' => 'تنسيق رقم الهاتف غير صحيح',
    'profile_bio_max' => 'النبذة الشخصية يجب ألا تزيد عن 500 حرف',
    'profile_avatar_image' => 'الملف يجب أن يكون صورة',
    'profile_avatar_mimes' => 'الصورة يجب أن تكون من نوع: jpeg, png, jpg, gif',
    'profile_avatar_max' => 'حجم الصورة يجب ألا يزيد عن 2MB',

    // Password Validation
    'current_password_required' => 'كلمة المرور الحالية مطلوبة',
    'current_password_incorrect' => 'كلمة المرور الحالية غير صحيحة',
    'new_password_required' => 'كلمة المرور الجديدة مطلوبة',
    'new_password_min' => 'كلمة المرور الجديدة يجب أن تكون على الأقل 8 أحرف',
    'new_password_confirmed' => 'تأكيد كلمة المرور غير متطابق',

];

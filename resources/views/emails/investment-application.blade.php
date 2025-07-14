<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ app()->getLocale() === 'ar' ? 'طلب استثمار جديد' : 'New Investment Application' }}</title>
    <style>
        body {
            font-family: {{ app()->getLocale() === 'ar' ? 'Tajawal, Arial, sans-serif' : 'Arial, sans-serif' }};
            line-height: 1.6;
            color: #333;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #f8f9fa;
        }
        .email-container {
            background: white;
            border-radius: 10px;
            padding: 30px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .header {
            text-align: center;
            border-bottom: 3px solid #10b981;
            padding-bottom: 20px;
            margin-bottom: 30px;
        }
        .logo {
            max-height: 60px;
            margin-bottom: 15px;
        }
        .title {
            color: #10b981;
            font-size: 24px;
            font-weight: bold;
            margin: 0;
        }
        .reference {
            background: #f0f9ff;
            border: 1px solid #0ea5e9;
            border-radius: 8px;
            padding: 15px;
            margin: 20px 0;
            text-align: center;
        }
        .reference-number {
            font-size: 18px;
            font-weight: bold;
            color: #0ea5e9;
        }
        .section {
            margin: 25px 0;
        }
        .section-title {
            background: #10b981;
            color: white;
            padding: 10px 15px;
            border-radius: 5px;
            font-weight: bold;
            margin-bottom: 15px;
        }
        .info-grid {
            display: grid;
            grid-template-columns: 1fr 2fr;
            gap: 10px;
            margin-bottom: 10px;
        }
        .info-label {
            font-weight: bold;
            color: #4b5563;
        }
        .info-value {
            color: #1f2937;
        }
        .highlight {
            background: #fef3c7;
            border: 1px solid #f59e0b;
            border-radius: 5px;
            padding: 15px;
            margin: 20px 0;
        }
        .footer {
            text-align: center;
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid #e5e7eb;
            color: #6b7280;
            font-size: 14px;
        }
        .btn {
            display: inline-block;
            background: #10b981;
            color: white;
            padding: 12px 24px;
            text-decoration: none;
            border-radius: 6px;
            font-weight: bold;
            margin: 10px 0;
        }
        .status-badge {
            display: inline-block;
            background: #fbbf24;
            color: #92400e;
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: bold;
        }
        @media (max-width: 600px) {
            .info-grid {
                grid-template-columns: 1fr;
            }
            .info-label {
                margin-bottom: 5px;
            }
        }
    </style>
</head>
<body>
    <div class="email-container">
        <!-- Header -->
        <div class="header">
            @if($company && $company->logo)
                <img src="{{ asset('storage/' . $company->logo) }}" alt="{{ $company->getLocalizedName() }}" class="logo">
            @endif
            <h1 class="title">
                {{ app()->getLocale() === 'ar' ? 'طلب استثمار جديد' : 'New Investment Application' }}
            </h1>
        </div>

        <!-- Reference Number -->
        <div class="reference">
            <div style="margin-bottom: 5px;">
                {{ app()->getLocale() === 'ar' ? 'رقم المرجع' : 'Reference Number' }}
            </div>
            <div class="reference-number">{{ $application->reference_number }}</div>
        </div>

        <!-- Application Status -->
        <div style="text-align: center; margin: 20px 0;">
            <span class="status-badge">
                {{ app()->getLocale() === 'ar' ? 'قيد الانتظار' : 'Pending Review' }}
            </span>
        </div>

        <!-- Applicant Information -->
        <div class="section">
            <div class="section-title">
                {{ app()->getLocale() === 'ar' ? 'معلومات مقدم الطلب' : 'Applicant Information' }}
            </div>

            <div class="info-grid">
                <div class="info-label">
                    {{ app()->getLocale() === 'ar' ? 'نوع مقدم الطلب:' : 'Applicant Type:' }}
                </div>
                <div class="info-value">
                    {{ $application->applicant_type === 'saudi_individual'
                        ? (app()->getLocale() === 'ar' ? 'فرد سعودي' : 'Saudi Individual')
                        : (app()->getLocale() === 'ar' ? 'شركة/مؤسسة' : 'Company/Institution') }}
                </div>
            </div>

            @if($application->applicant_type === 'saudi_individual')
                <div class="info-grid">
                    <div class="info-label">{{ app()->getLocale() === 'ar' ? 'الاسم الكامل:' : 'Full Name:' }}</div>
                    <div class="info-value">{{ $application->full_name }}</div>
                </div>
                <div class="info-grid">
                    <div class="info-label">{{ app()->getLocale() === 'ar' ? 'رقم الهوية:' : 'National ID:' }}</div>
                    <div class="info-value">{{ $application->national_id_residence_number }}</div>
                </div>
                <div class="info-grid">
                    <div class="info-label">{{ app()->getLocale() === 'ar' ? 'تاريخ الميلاد:' : 'Date of Birth:' }}</div>
                    <div class="info-value">{{ $application->date_of_birth?->format('Y-m-d') }}</div>
                </div>
                <div class="info-grid">
                    <div class="info-label">{{ app()->getLocale() === 'ar' ? 'المهنة:' : 'Profession:' }}</div>
                    <div class="info-value">{{ $application->profession }}</div>
                </div>
            @else
                <div class="info-grid">
                    <div class="info-label">{{ app()->getLocale() === 'ar' ? 'اسم الشركة:' : 'Company Name:' }}</div>
                    <div class="info-value">{{ $application->name_per_commercial_registration }}</div>
                </div>
                <div class="info-grid">
                    <div class="info-label">{{ app()->getLocale() === 'ar' ? 'رقم السجل التجاري:' : 'Commercial Registration:' }}</div>
                    <div class="info-value">{{ $application->commercial_registration_number }}</div>
                </div>
                <div class="info-grid">
                    <div class="info-label">{{ app()->getLocale() === 'ar' ? 'جوال أبشر:' : 'Absher Mobile:' }}</div>
                    <div class="info-value">{{ $application->absher_registered_mobile }}</div>
                </div>
            @endif
        </div>

        <!-- Contact Information -->
        <div class="section">
            <div class="section-title">
                {{ app()->getLocale() === 'ar' ? 'معلومات التواصل' : 'Contact Information' }}
            </div>

            <div class="info-grid">
                <div class="info-label">{{ app()->getLocale() === 'ar' ? 'الجنسية:' : 'Nationality:' }}</div>
                <div class="info-value">{{ $application->nationality }}</div>
            </div>
            <div class="info-grid">
                <div class="info-label">{{ app()->getLocale() === 'ar' ? 'بلد الإقامة:' : 'Country of Residence:' }}</div>
                <div class="info-value">{{ $application->country_of_residence }}</div>
            </div>
            <div class="info-grid">
                <div class="info-label">{{ app()->getLocale() === 'ar' ? 'رقم الجوال:' : 'Mobile Number:' }}</div>
                <div class="info-value">{{ $application->mobile_number }}</div>
            </div>
            <div class="info-grid">
                <div class="info-label">{{ app()->getLocale() === 'ar' ? 'البريد الإلكتروني:' : 'Email:' }}</div>
                <div class="info-value">{{ $application->email }}</div>
            </div>
        </div>

        <!-- Investment Details -->
        <div class="section">
            <div class="section-title">
                {{ app()->getLocale() === 'ar' ? 'تفاصيل الاستثمار' : 'Investment Details' }}
            </div>

            <div class="highlight">
                <div style="text-align: center;">
                    <div style="font-size: 18px; font-weight: bold; margin-bottom: 10px;">
                        {{ app()->getLocale() === 'ar' ? 'عدد الأسهم المطلوبة' : 'Number of Shares Requested' }}
                    </div>
                    <div style="font-size: 24px; font-weight: bold; color: #10b981;">
                        {{ number_format($application->number_of_shares) }}
                        {{ app()->getLocale() === 'ar' ? 'سهم' : 'Shares' }}
                    </div>
                    <div style="font-size: 14px; margin-top: 15px; color: #6b7280;">
                        <strong>{{ app()->getLocale() === 'ar' ? 'نوع السهم:' : 'Share Type:' }}</strong>
                        <span style="background: {{ $application->share_type === 'regular' ? '#dbeafe' : '#fed7aa' }};
                                     color: {{ $application->share_type === 'regular' ? '#1e40af' : '#ea580c' }};
                                     padding: 4px 8px; border-radius: 4px; font-weight: bold; margin-{{ app()->getLocale() === 'ar' ? 'right' : 'left' }}: 8px;">
                            {{ $application->getShareTypeLabel() }}
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <!-- System Information -->
        <div class="section">
            <div class="section-title">
                {{ app()->getLocale() === 'ar' ? 'معلومات النظام' : 'System Information' }}
            </div>

            <div class="info-grid">
                <div class="info-label">{{ app()->getLocale() === 'ar' ? 'تاريخ التقديم:' : 'Submission Date:' }}</div>
                <div class="info-value">{{ $application->created_at->format('Y-m-d H:i:s') }}</div>
            </div>
            <div class="info-grid">
                <div class="info-label">{{ app()->getLocale() === 'ar' ? 'عنوان IP:' : 'IP Address:' }}</div>
                <div class="info-value">{{ $application->ip_address }}</div>
            </div>
        </div>

        <!-- Action Button -->
        <div style="text-align: center; margin: 30px 0;">
            <a href="{{ route('admin.investment-applications.show', $application->id) }}" class="btn">
                {{ app()->getLocale() === 'ar' ? 'عرض الطلب في لوحة التحكم' : 'View Application in Admin Panel' }}
            </a>
        </div>

        <!-- Footer -->
        <div class="footer">
            <p>
                {{ app()->getLocale() === 'ar'
                    ? 'تم إرسال هذا البريد تلقائياً من نظام إدارة طلبات الاستثمار'
                    : 'This email was sent automatically from the Investment Application Management System' }}
            </p>
            @if($company)
                <p>
                    {{ $company->getLocalizedName() }}<br>
                    {{ $company->contact_email }} | {{ $company->contact_phone }}
                </p>
            @endif
        </div>
    </div>
</body>
</html>

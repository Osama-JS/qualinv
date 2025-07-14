<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ app()->getLocale() === 'ar' ? 'رسالة جديدة من موقع الشركة' : 'New Contact Message' }}</title>
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
        .section {
            margin-bottom: 25px;
        }
        .section-title {
            font-size: 18px;
            font-weight: bold;
            color: #10b981;
            margin-bottom: 15px;
            border-bottom: 2px solid #e5e7eb;
            padding-bottom: 8px;
        }
        .info-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 15px;
            margin-bottom: 20px;
        }
        .info-item {
            background: #f9fafb;
            padding: 15px;
            border-radius: 8px;
            border-left: 4px solid #10b981;
        }
        .info-label {
            font-weight: bold;
            color: #374151;
            margin-bottom: 5px;
        }
        .info-value {
            color: #6b7280;
        }
        .message-content {
            background: #f0f9ff;
            border: 1px solid #0ea5e9;
            border-radius: 8px;
            padding: 20px;
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
        .contact-info {
            background: #f3f4f6;
            padding: 15px;
            border-radius: 8px;
            margin-top: 20px;
        }
        @media (max-width: 600px) {
            .info-grid {
                grid-template-columns: 1fr;
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
                {{ app()->getLocale() === 'ar' ? 'رسالة جديدة من موقع الشركة' : 'New Contact Message' }}
            </h1>
        </div>

        <!-- Contact Information -->
        <div class="section">
            <div class="section-title">
                {{ app()->getLocale() === 'ar' ? 'معلومات المرسل' : 'Sender Information' }}
            </div>
            
            <div class="info-grid">
                <div class="info-item">
                    <div class="info-label">{{ app()->getLocale() === 'ar' ? 'الاسم' : 'Name' }}</div>
                    <div class="info-value">{{ $contactData['name'] }}</div>
                </div>
                <div class="info-item">
                    <div class="info-label">{{ app()->getLocale() === 'ar' ? 'البريد الإلكتروني' : 'Email' }}</div>
                    <div class="info-value">{{ $contactData['email'] }}</div>
                </div>
                <div class="info-item">
                    <div class="info-label">{{ app()->getLocale() === 'ar' ? 'رقم الهاتف' : 'Phone Number' }}</div>
                    <div class="info-value">{{ $contactData['phone'] ?? (app()->getLocale() === 'ar' ? 'غير محدد' : 'Not provided') }}</div>
                </div>
                <div class="info-item">
                    <div class="info-label">{{ app()->getLocale() === 'ar' ? 'الموضوع' : 'Subject' }}</div>
                    <div class="info-value">{{ $contactData['subject'] }}</div>
                </div>
            </div>
        </div>

        <!-- Message Content -->
        <div class="section">
            <div class="section-title">
                {{ app()->getLocale() === 'ar' ? 'محتوى الرسالة' : 'Message Content' }}
            </div>
            
            <div class="message-content">
                {!! nl2br(e($contactData['message'])) !!}
            </div>
        </div>

        <!-- System Information -->
        <div class="section">
            <div class="section-title">
                {{ app()->getLocale() === 'ar' ? 'معلومات النظام' : 'System Information' }}
            </div>
            
            <div class="contact-info">
                <div style="margin-bottom: 10px;">
                    <strong>{{ app()->getLocale() === 'ar' ? 'تاريخ الإرسال:' : 'Sent Date:' }}</strong>
                    {{ now()->format('Y-m-d H:i:s') }}
                </div>
                <div style="margin-bottom: 10px;">
                    <strong>{{ app()->getLocale() === 'ar' ? 'عنوان IP:' : 'IP Address:' }}</strong>
                    {{ request()->ip() }}
                </div>
                <div>
                    <strong>{{ app()->getLocale() === 'ar' ? 'متصفح المستخدم:' : 'User Agent:' }}</strong>
                    {{ request()->userAgent() }}
                </div>
            </div>
        </div>

        <!-- Footer -->
        <div class="footer">
            <p>
                {{ app()->getLocale() === 'ar' ? 'هذه رسالة تلقائية من موقع' : 'This is an automated message from' }}
                @if($company)
                    <strong>{{ $company->getLocalizedName() }}</strong>
                @endif
            </p>
            <p>
                {{ app()->getLocale() === 'ar' ? 'يمكنك الرد مباشرة على هذا الإيميل للتواصل مع المرسل' : 'You can reply directly to this email to contact the sender' }}
            </p>
        </div>
    </div>
</body>
</html>

<?php

namespace App\Mail;

use App\Models\InvestmentApplication;
use App\Models\Company;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class InvestmentApplicationMail extends Mailable
{
    use Queueable, SerializesModels;

    public $application;
    public $company;

    /**
     * Create a new message instance.
     */
    public function __construct(InvestmentApplication $application)
    {
        $this->application = $application;
        $this->company = Company::first();
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        $subject = app()->getLocale() === 'ar'
            ? 'طلب استثمار جديد - ' . $this->application->reference_number
            : 'New Investment Application - ' . $this->application->reference_number;

        return new Envelope(
            subject: $subject,
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.investment-application',
            with: [
                'application' => $this->application,
                'company' => $this->company,
                'locale' => app()->getLocale(),
            ],
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}

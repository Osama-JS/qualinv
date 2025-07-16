<?php

namespace App\Mail;

use App\Models\Company;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Mail\Mailables\Address;

use Illuminate\Queue\SerializesModels;

class ContactMessageMail extends Mailable
{
    use Queueable, SerializesModels;

    public $contactData;
    public $company;

    /**
     * Create a new message instance.
     */
    public function __construct(array $contactData)
    {
        $this->contactData = $contactData;
        $this->company = Company::first();
    }

    /**
     * Get the message envelope.
     */
   public function envelope(): Envelope
{
    $subject = app()->getLocale() === 'ar'
        ? 'رسالة جديدة من موقع الشركة - ' . $this->contactData['subject']
        : 'New Contact Message - ' . $this->contactData['subject'];

    // Clean and format the name
    $cleanName = $this->cleanEmailName($this->contactData['name']);

    try {
        return new Envelope(
            subject: $subject,
            replyTo: [
                new Address($this->contactData['email'], $cleanName)
            ]
        );
    } catch (\Exception $e) {
        // Fallback without name
        return new Envelope(
            subject: $subject,
            replyTo: [
                new Address($this->contactData['email'])
            ]
        );
    }
}


    /**
     * Clean name for RFC 2822 compliance
     * This function ensures the name is properly formatted for email headers
     */
    private function cleanEmailName(string $name): string
    {
        // First, trim and normalize whitespace
        $cleanName = trim($name);
        $cleanName = preg_replace('/\s+/', ' ', $cleanName);

        // If empty, return a safe default
        if (empty($cleanName)) {
            return 'Website Visitor';
        }

        // Remove or replace problematic characters for RFC 2822
        // Keep only letters, numbers, spaces, hyphens, dots, and apostrophes
        $cleanName = preg_replace('/[^\p{L}\p{N}\s\-\.\'\(\)]/u', '', $cleanName);

        // Trim again after character removal
        $cleanName = trim($cleanName);

        // If still empty after cleaning, use default
        if (empty($cleanName)) {
            return 'Website Visitor';
        }

        // Limit length to prevent issues
        if (mb_strlen($cleanName, 'UTF-8') > 50) {
            $cleanName = mb_substr($cleanName, 0, 50, 'UTF-8');
            $cleanName = trim($cleanName);
        }

        // For RFC 2822 compliance, if the name contains special characters
        // or starts/ends with quotes, we need to quote the entire name
        if (preg_match('/[",;:<>@\[\]\\\\]/', $cleanName) ||
            preg_match('/^["\s]|["\s]$/', $cleanName)) {
            // Escape any existing quotes and wrap in quotes
            $cleanName = '"' . str_replace('"', '\\"', $cleanName) . '"';
        }

        return $cleanName;
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.contact-message',
            with: [
                'contactData' => $this->contactData,
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

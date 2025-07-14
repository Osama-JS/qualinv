<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Builder;
use Carbon\Carbon;

class InvestmentApplication extends Model
{
    use HasFactory;

    // Status constants
    public const STATUS_PENDING = 'pending';
    public const STATUS_REVIEWED = 'reviewed';
    public const STATUS_APPROVED = 'approved';
    public const STATUS_REJECTED = 'rejected';

    // Share type constants
    public const SHARE_TYPE_REGULAR = 'regular';
    public const SHARE_TYPE_REDEEMABLE = 'redeemable';

    protected $fillable = [
        'reference_number',
        'applicant_type',
        'status',
        'is_read',
        'read_at',
        'read_by',
        'nationality',
        'country_of_residence',
        'mobile_number',
        'email',
        'number_of_shares',
        'share_type',
        'national_id_residence_number',
        'date_of_birth',
        'full_name',
        'profession',
        'commercial_registration_number',
        'name_per_commercial_registration',
        'absher_registered_mobile',
        'ip_address',
        'user_agent',
        'admin_notes',
        'assigned_to',
        'status_changed_at',
        'status_changed_by',
    ];

    protected $casts = [
        'date_of_birth' => 'date',
        'is_read' => 'boolean',
        'read_at' => 'datetime',
        'status_changed_at' => 'datetime',
        'number_of_shares' => 'integer',
    ];

    protected $dates = [
        'date_of_birth',
        'read_at',
        'status_changed_at',
        'created_at',
        'updated_at',
    ];

    // Constants for applicant types
    const APPLICANT_TYPE_SAUDI_INDIVIDUAL = 'saudi_individual';
    const APPLICANT_TYPE_COMPANY_INSTITUTION = 'company_institution';



    /**
     * Get the user who read this application
     */
    public function readBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'read_by');
    }

    /**
     * Get the user assigned to this application
     */
    public function assignedTo(): BelongsTo
    {
        return $this->belongsTo(User::class, 'assigned_to');
    }

    /**
     * Get the user who changed the status
     */
    public function statusChangedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'status_changed_by');
    }

    /**
     * Boot method to generate reference number
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($application) {
            if (empty($application->reference_number)) {
                $application->reference_number = static::generateReferenceNumber();
            }
        });

        static::updating(function ($application) {
            if ($application->isDirty('status')) {
                $application->status_changed_at = now();
                $application->status_changed_by = auth()->id();
            }
        });
    }

    /**
     * Generate unique reference number
     */
    public static function generateReferenceNumber(): string
    {
        $prefix = 'QIC';
        $year = date('Y');
        $month = date('m');

        do {
            $number = str_pad(rand(1, 9999), 4, '0', STR_PAD_LEFT);
            $referenceNumber = "{$prefix}-{$year}{$month}-{$number}";
        } while (static::where('reference_number', $referenceNumber)->exists());

        return $referenceNumber;
    }





    /**
     * Scope for specific applicant type
     */
    public function scopeOfType(Builder $query, string $type): Builder
    {
        return $query->where('applicant_type', $type);
    }

    /**
     * Scope for recent applications
     */
    public function scopeRecent(Builder $query, int $days = 30): Builder
    {
        return $query->where('created_at', '>=', Carbon::now()->subDays($days));
    }

    /**
     * Mark application as read
     */
    public function markAsRead(?int $userId = null): void
    {
        $this->update([
            'is_read' => true,
            'read_at' => now(),
            'read_by' => $userId ?? auth()->id(),
        ]);
    }

    /**
     * Change application status
     */
    public function changeStatus(string $status, ?string $notes = null): void
    {
        $this->update([
            'status' => $status,
            'admin_notes' => $notes ? ($this->admin_notes ? $this->admin_notes . "\n\n" . $notes : $notes) : $this->admin_notes,
            'status_changed_at' => now(),
            'status_changed_by' => auth()->id(),
        ]);
    }

    /**
     * Get applicant display name
     */
    public function getApplicantNameAttribute(): string
    {
        if ($this->applicant_type === self::APPLICANT_TYPE_SAUDI_INDIVIDUAL) {
            return $this->full_name ?? 'N/A';
        }

        return $this->name_per_commercial_registration ?? 'N/A';
    }

    /**
     * Get applicant identifier
     */
    public function getApplicantIdentifierAttribute(): string
    {
        if ($this->applicant_type === self::APPLICANT_TYPE_SAUDI_INDIVIDUAL) {
            return $this->national_id_residence_number ?? 'N/A';
        }

        return $this->commercial_registration_number ?? 'N/A';
    }

    /**
     * Check if application is Saudi individual
     */
    public function isSaudiIndividual(): bool
    {
        return $this->applicant_type === self::APPLICANT_TYPE_SAUDI_INDIVIDUAL;
    }

    /**
     * Check if application is company/institution
     */
    public function isCompanyInstitution(): bool
    {
        return $this->applicant_type === self::APPLICANT_TYPE_COMPANY_INSTITUTION;
    }

    /**
     * Get status badge color
     */
    public function getStatusColorAttribute(): string
    {
        return match($this->status) {
            self::STATUS_PENDING => 'yellow',
            self::STATUS_REVIEWED => 'blue',
            self::STATUS_APPROVED => 'green',
            self::STATUS_REJECTED => 'red',
            default => 'gray',
        };
    }

    /**
     * Get status label
     */
    public function getStatusLabel(): string
    {
        return match($this->status) {
            self::STATUS_PENDING => __('admin.pending'),
            self::STATUS_REVIEWED => __('admin.reviewed'),
            self::STATUS_APPROVED => __('admin.approved'),
            self::STATUS_REJECTED => __('admin.rejected'),
            'under_review' => __('admin.under_review'),
            'on_hold' => __('admin.on_hold'),
            default => __('admin.unknown'),
        };
    }

    /**
     * Get all available statuses
     */
    public static function getStatuses(): array
    {
        return [
            self::STATUS_PENDING => __('admin.pending'),
            self::STATUS_REVIEWED => __('admin.reviewed'),
            self::STATUS_APPROVED => __('admin.approved'),
            self::STATUS_REJECTED => __('admin.rejected'),
        ];
    }

    /**
     * Get all available applicant types
     */
    public static function getApplicantTypes(): array
    {
        return [
            self::APPLICANT_TYPE_SAUDI_INDIVIDUAL => __('admin.saudi_individual'),
            self::APPLICANT_TYPE_COMPANY_INSTITUTION => __('admin.company_institution'),
        ];
    }

    /**
     * Get all available share types
     */
    public static function getShareTypes(): array
    {
        return [
            self::SHARE_TYPE_REGULAR => __('admin.regular_share'),
            self::SHARE_TYPE_REDEEMABLE => __('admin.redeemable_share'),
        ];
    }

    /**
     * Get share type label
     */
    public function getShareTypeLabel(): string
    {
        return match($this->share_type) {
            self::SHARE_TYPE_REGULAR => __('admin.regular_share'),
            self::SHARE_TYPE_REDEEMABLE => __('admin.redeemable_share'),
            default => __('admin.unknown'),
        };
    }

    /**
     * Scope for unread applications
     */
    public function scopeUnread($query)
    {
        return $query->where('is_read', false);
    }

    /**
     * Scope for pending applications
     */
    public function scopePending($query)
    {
        return $query->where('status', self::STATUS_PENDING);
    }

    /**
     * Scope for approved applications
     */
    public function scopeApproved($query)
    {
        return $query->where('status', self::STATUS_APPROVED);
    }

    /**
     * Scope for rejected applications
     */
    public function scopeRejected($query)
    {
        return $query->where('status', self::STATUS_REJECTED);
    }

    /**
     * Scope for reviewed applications
     */
    public function scopeReviewed($query)
    {
        return $query->where('status', self::STATUS_REVIEWED);
    }
}

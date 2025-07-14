<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'is_active',
        'phone',
        'bio',
        'avatar',
        'last_login_at',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'is_active' => 'boolean',
            'last_login_at' => 'datetime',
        ];
    }

    /**
     * Check if user has admin role
     */
    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    /**
     * Check if user has editor role
     */
    public function isEditor(): bool
    {
        return $this->role === 'editor';
    }

    /**
     * Check if user has viewer role
     */
    public function isViewer(): bool
    {
        return $this->role === 'viewer';
    }

    /**
     * Get user's avatar URL
     */
    public function getAvatarUrl(): string
    {
        if ($this->avatar) {
            return asset('storage/' . $this->avatar);
        }

        // Return default avatar based on user's initials
        return 'https://ui-avatars.com/api/?name=' . urlencode($this->name) . '&color=7F9CF5&background=EBF4FF&size=200';
    }

    /**
     * Get user's initials for avatar
     */
    public function getInitials(): string
    {
        $words = explode(' ', $this->name);
        $initials = '';

        foreach ($words as $word) {
            if (!empty($word)) {
                $initials .= strtoupper(substr($word, 0, 1));
            }
        }

        return substr($initials, 0, 2);
    }

    /**
     * Get user's role label
     */
    public function getRoleLabel(): string
    {
        return match($this->role) {
            'admin' => __('admin.admin'),
            'editor' => __('admin.editor'),
            'viewer' => __('admin.viewer'),
            default => __('admin.unknown'),
        };
    }

    /**
     * Get user's status label
     */
    public function getStatusLabel(): string
    {
        return $this->is_active ? __('admin.active') : __('admin.inactive');
    }

    /**
     * Get user's last login formatted
     */
    public function getLastLoginFormatted(): string
    {
        if (!$this->last_login_at) {
            return __('admin.never_logged_in');
        }

        return $this->last_login_at->diffForHumans();
    }

    /**
     * Get posts authored by this user
     */
    public function posts()
    {
        return $this->hasMany(Post::class, 'author_id');
    }
}

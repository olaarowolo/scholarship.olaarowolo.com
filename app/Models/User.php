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
        'terms_accepted',
        'device',
        'location',
        'credentials',
        'is_iba_indigene',
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
            'password'          => 'hashed',
            'terms_accepted'    => 'boolean',
            'is_iba_indigene'   => 'boolean',
        ];
    }

    /**
     * Check if user has a specific role
     *
     * @param string $role
     * @return bool
     */
    public function hasRole(string $role): bool
    {
        return $this->role === $role;
    }

    /**
     * Check if user has any of the given roles
     *
     * @param array|string $roles
     * @return bool
     */
    public function hasAnyRole($roles): bool
    {
        if (is_string($roles)) {
            return $this->role === $roles;
        }

        return in_array($this->role, $roles);
    }

    /**
     * Check if user is an admin
     *
     * @return bool
     */
    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    /**
     * Check if user is a scholar
     *
     * @return bool
     */
    public function isScholar(): bool
    {
        return $this->role === 'scholar';
    }

    /**
     * Check if user is a review team member
     *
     * @return bool
     */
    public function isReviewTeam(): bool
    {
        return $this->role === 'review_team';
    }

    /**
     * Check if user is an applicant
     *
     * @return bool
     */
    public function isApplicant(): bool
    {
        return $this->role === 'applicant';
    }

    /**
     * Check if user is a verified beneficiary
     *
     * @return bool
     */
    public function isVerifiedBeneficiary(): bool
    {
        return $this->role === 'verified_beneficiary';
    }
}

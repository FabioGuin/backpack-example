<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'is_active',
        'approved_at',
        'last_login_at',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'is_active' => 'boolean',
        'approved_at' => 'datetime',
        'last_login_at' => 'datetime',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    /**
     * Checks if the object has been approved.
     *
     * @return bool returns true if the object has been approved, false otherwise
     */
    public function hasApproved(): bool
    {
        return ! is_null($this->approved_at);
    }

    /**
     * Checks if the object has been activated.
     *
     * @return bool returns true if the object has been activated, false otherwise
     */
    public function hasActivated(): bool
    {
        return $this->is_active;
    }

    /**
     * Get the associated customer.
     */
    public function customer(): HasOne
    {
        return $this
            ->hasOne(
                Customer::class,
                'user_id',
            )
            ->withTrashed();
    }
}

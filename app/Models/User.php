<?php

namespace App\Models;

use App\Enums\UserRoleEnum;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * Model for the 'users' table.
 */
class User extends Authenticatable
{
    use HasFactory, Notifiable, SoftDeletes;

    // Define the fillable attributes for mass assignment.
    protected $guarded = [];

    // The attributes that should be hidden for serialization.
    protected $hidden = [
        'password',
        'remember_token',
    ];

    // The attributes that should be cast.
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'role' => UserRoleEnum::class, // Cast to Enum
    ];

    /**
     * Get the company that owns the user.
     */
    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    /**
     * Get the orders for the user.
     */
    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    /**
     * Get the notifications for the user.
     * Note: Laravel's default Notifiable trait handles polymorphic relations for notifications.
     */
    public function notifications()
    {
        return $this->morphMany(Notification::class, 'notifiable');
    }
}
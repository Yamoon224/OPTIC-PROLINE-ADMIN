<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Model for the 'notifications' table.
 */
class Notification extends Model
{
    use HasFactory, SoftDeletes;

    // Define the fillable attributes for mass assignment.
    protected $guarded = [];

    // The attributes that should be cast.
    protected $casts = [
        'data' => 'array', // Cast JSON column to array
        'read_at' => 'datetime',
    ];

    /**
     * Get the parent notifiable model (user or company).
     */
    public function notifiable()
    {
        return $this->morphTo();
    }
}
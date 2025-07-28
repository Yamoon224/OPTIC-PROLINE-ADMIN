<?php

namespace App\Models;

use App\Enums\OrderStatusEnum;
use App\Enums\PaymentStatusEnum;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Model for the 'orders' table.
 */
class Order extends Model
{
    use HasFactory, SoftDeletes;

    // Define the fillable attributes for mass assignment.
    protected $guarded = [];

    // The attributes that should be cast.
    protected $casts = [
        'total_amount' => 'decimal:2',
        'discount' => 'decimal:2',
        'payment_status' => PaymentStatusEnum::class, // Cast to Enum
        'order_status' => OrderStatusEnum::class, // Cast to Enum
    ];

    /**
     * Get the user that owns the order.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the order items for the order.
     */
    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    /**
     * Get the payments for the order.
     */
    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    public function updateTotalAmount(): void
    {
        $total = $this->orderItems->sum(function ($item) {
            return $item->quantity * $item->unit_price;
        });

        $this->update(['amount' => $total]);
    }
}

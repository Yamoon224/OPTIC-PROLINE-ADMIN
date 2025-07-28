<?php

namespace App\Models;

use App\Enums\ProductGenderEnum;
use App\Enums\ProductStatusEnum;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Model for the 'products' table.
 */
class Product extends Model
{
    use HasFactory, SoftDeletes;

    // Define the fillable attributes for mass assignment.
    protected $guarded = [];

    // The attributes that should be cast.
    protected $casts = [
        'unit_price' => 'decimal:2',
        'batch_price' => 'decimal:2',
        'stock_quantity' => 'integer',
        'status' => ProductStatusEnum::class, // Cast to Enum
        'gender' => ProductGenderEnum::class, // Cast to Enum
    ];

    /**
     * Get the category that owns the product.
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Get the order items for the product.
     */
    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }
}

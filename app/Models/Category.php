<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Model for the 'categories' table.
 */
class Category extends Model
{
    use HasFactory, SoftDeletes;

    // Define the fillable attributes for mass assignment.
    protected $guarded = [];

    /**
     * Get the products for the category.
     */
    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
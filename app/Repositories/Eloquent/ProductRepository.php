<?php

namespace App\Repositories\Eloquent;

use App\Models\Product;
use Illuminate\Database\Eloquent\Collection;
use App\Repositories\ProductRepositoryInterface;

/**
 * Eloquent implementation of Product Repository.
 */
class ProductRepository implements ProductRepositoryInterface
{
    /**
     * Get all products.
     */
    public function getAll(): Collection
    {
        return Product::all();
    }

    /**
     * Find a product by its ID.
     */
    public function findById(int $id): ?Product
    {
        return Product::find($id);
    }

    /**
     * Create a new product.
     */
    public function create(array $data): Product
    {
        return Product::create($data);
    }

    /**
     * Update an existing product.
     */
    public function update(Product $product, array $data): Product
    {
        $product->update($data);
        return $product;
    }

    /**
     * Delete a product.
     */
    public function delete(Product $product): bool
    {
        return $product->delete();
    }
}
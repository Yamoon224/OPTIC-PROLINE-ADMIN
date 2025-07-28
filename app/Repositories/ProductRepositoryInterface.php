<?php

namespace App\Repositories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Collection;

/**
 * Interface for Product Repository.
 */
interface ProductRepositoryInterface
{
    public function getAll(): Collection;
    public function findById(int $id): ?Product;
    public function create(array $data): Product;
    public function update(Product $product, array $data): Product;
    public function delete(Product $product): bool;
}
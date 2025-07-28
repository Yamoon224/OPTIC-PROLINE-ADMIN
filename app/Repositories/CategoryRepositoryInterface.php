<?php

namespace App\Repositories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Collection;

/**
 * Interface for Category Repository.
 */
interface CategoryRepositoryInterface
{
    public function getAll(): Collection;
    public function findById(int $id): ?Category;
    public function create(array $data): Category;
    public function update(Category $category, array $data): Category;
    public function delete(Category $category): bool;
}
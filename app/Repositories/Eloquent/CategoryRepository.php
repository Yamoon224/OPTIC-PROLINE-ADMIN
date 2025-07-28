<?php

namespace App\Repositories\Eloquent;

use App\Models\Category;
use Illuminate\Database\Eloquent\Collection;
use App\Repositories\CategoryRepositoryInterface;

/**
 * Eloquent implementation of Category Repository.
 */
class CategoryRepository implements CategoryRepositoryInterface
{
    /**
     * Get all categories.
     */
    public function getAll(): Collection
    {
        return Category::orderByDesc('id')->get();
    }

    /**
     * Find a category by its ID.
     */
    public function findById(int $id): ?Category
    {
        return Category::find($id);
    }

    /**
     * Create a new category.
     */
    public function create(array $data): Category
    {
        return Category::create($data);
    }

    /**
     * Update an existing category.
     */
    public function update(Category $category, array $data): Category
    {
        $category->update($data);
        return $category;
    }

    /**
     * Delete a category.
     */
    public function delete(Category $category): bool
    {
        return $category->delete();
    }
}

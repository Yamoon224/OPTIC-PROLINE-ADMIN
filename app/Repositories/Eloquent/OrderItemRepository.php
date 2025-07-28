<?php

namespace App\Repositories\Eloquent;

use App\Models\OrderItem;
use Illuminate\Database\Eloquent\Collection;
use App\Repositories\OrderItemRepositoryInterface;

/**
 * Eloquent implementation of OrderItem Repository.
 */
class OrderItemRepository implements OrderItemRepositoryInterface
{
    /**
     * Get all order items.
     */
    public function getAll(): Collection
    {
        return OrderItem::all();
    }

    /**
     * Find an order item by its ID.
     */
    public function findById(int $id): ?OrderItem
    {
        return OrderItem::find($id);
    }

    /**
     * Create a new order item.
     */
    public function create(array $data): OrderItem
    {
        return OrderItem::create($data);
    }

    /**
     * Update an existing order item.
     */
    public function update(OrderItem $orderItem, array $data): OrderItem
    {
        $orderItem->update($data);
        return $orderItem;
    }

    /**
     * Delete an order item.
     */
    public function delete(OrderItem $orderItem): bool
    {
        return $orderItem->delete();
    }
}
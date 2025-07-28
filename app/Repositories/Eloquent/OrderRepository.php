<?php

namespace App\Repositories\Eloquent;

use App\Models\Order;
use Illuminate\Database\Eloquent\Collection;
use App\Repositories\OrderRepositoryInterface;

/**
 * Eloquent implementation of Order Repository.
 */
class OrderRepository implements OrderRepositoryInterface
{
    /**
     * Get all orders.
     */
    public function getAll(): Collection
    {
        return Order::all();
    }

    /**
     * Find an order by its ID.
     */
    public function findById(int $id): ?Order
    {
        return Order::find($id);
    }

    /**
     * Create a new order.
     */
    public function create(array $data): Order
    {
        return Order::create($data);
    }

    /**
     * Update an existing order.
     */
    public function update(Order $order, array $data): Order
    {
        $order->update($data);
        return $order;
    }

    /**
     * Delete an order.
     */
    public function delete(Order $order): bool
    {
        return $order->delete();
    }
}
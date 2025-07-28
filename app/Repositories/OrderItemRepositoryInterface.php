<?php

namespace App\Repositories;

use App\Models\OrderItem;
use Illuminate\Database\Eloquent\Collection;

/**
 * Interface for OrderItem Repository.
 */
interface OrderItemRepositoryInterface
{
    public function getAll(): Collection;
    public function findById(int $id): ?OrderItem;
    public function create(array $data): OrderItem;
    public function update(OrderItem $orderItem, array $data): OrderItem;
    public function delete(OrderItem $orderItem): bool;
}
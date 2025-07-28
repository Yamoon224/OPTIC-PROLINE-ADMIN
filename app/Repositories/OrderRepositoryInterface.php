<?php

namespace App\Repositories;

use App\Models\Order;
use Illuminate\Database\Eloquent\Collection;

/**
 * Interface for Order Repository.
 */
interface OrderRepositoryInterface
{
    public function getAll(): Collection;
    public function findById(int $id): ?Order;
    public function create(array $data): Order;
    public function update(Order $order, array $data): Order;
    public function delete(Order $order): bool;
}

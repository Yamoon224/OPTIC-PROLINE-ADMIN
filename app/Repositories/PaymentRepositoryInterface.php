<?php

namespace App\Repositories;

use App\Models\Payment;
use Illuminate\Database\Eloquent\Collection;

/**
 * Interface for Payment Repository.
 */
interface PaymentRepositoryInterface
{
    public function getAll(): Collection;
    public function findById(int $id): ?Payment;
    public function create(array $data): Payment;
    public function update(Payment $payment, array $data): Payment;
    public function delete(Payment $payment): bool;
}
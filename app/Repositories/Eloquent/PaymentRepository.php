<?php

namespace App\Repositories\Eloquent;

use App\Models\Payment;
use Illuminate\Database\Eloquent\Collection;
use App\Repositories\PaymentRepositoryInterface;

/**
 * Eloquent implementation of Payment Repository.
 */
class PaymentRepository implements PaymentRepositoryInterface
{
    /**
     * Get all payments.
     */
    public function getAll(): Collection
    {
        return Payment::all();
    }

    /**
     * Find a payment by its ID.
     */
    public function findById(int $id): ?Payment
    {
        return Payment::find($id);
    }

    /**
     * Create a new payment.
     */
    public function create(array $data): Payment
    {
        return Payment::create($data);
    }

    /**
     * Update an existing payment.
     */
    public function update(Payment $payment, array $data): Payment
    {
        $payment->update($data);
        return $payment;
    }

    /**
     * Delete a payment.
     */
    public function delete(Payment $payment): bool
    {
        return $payment->delete();
    }
}
<?php

namespace App\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PaymentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'order_id' => $this->order_id,
            'amount' => $this->amount,
            'payment_method' => $this->payment_method->value, // Access enum value
            'transaction_id' => $this->transaction_id,
            'operator_id' => $this->operator_id,
            'currency' => $this->currency,
            'payment_date' => $this->payment_date,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'deleted_at' => $this->deleted_at,
            // Optionally include related order
            // 'order' => new OrderResource($this->whenLoaded('order')),
        ];
    }
}
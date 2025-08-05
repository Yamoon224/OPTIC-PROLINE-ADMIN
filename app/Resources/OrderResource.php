<?php

namespace App\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
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
            'user_id' => $this->user_id,
            'total_amount' => $this->total_amount,
            'discount' => $this->discount,
            'payment_status' => $this->payment_status->value, // Access enum value
            'order_status' => $this->order_status->value, // Access enum value
            'delivery_address' => $this->delivery_address,
            'billing_address' => $this->billing_address,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'deleted_at' => $this->deleted_at,
            // Optionally include related user and items
            // 'user' => new UserResource($this->whenLoaded('user')),
            // 'order_items' => OrderItemResource::collection($this->whenLoaded('orderItems')),
            // 'payments' => PaymentResource::collection($this->whenLoaded('payments')),
        ];
    }
}
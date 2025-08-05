<?php

// ProductResource.php
namespace App\Resources;

use Illuminate\Http\Request;
use App\Enums\ProductStatusEnum;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
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
            'name' => $this->name,
            'description' => $this->description,
            'unit_price' => (float) $this->unit_price,
            'batch_price' => $this->batch_price ? (float) $this->batch_price : null,
            'stock_quantity' => $this->stock_quantity,
            'status' => $this->status,
            'brand' => $this->brand,
            'material' => $this->material,
            'gender' => $this->gender,
            'shape' => $this->shape,
            'color' => $this->color,
            'image' => env('APP_URL') . '/' . $this->image,
            'category_id' => $this->category_id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'category' => new CategoryResource($this->whenLoaded('category')),
            'is_in_stock' => $this->status == ProductStatusEnum::InStock,
            'formatted_price' => number_format($this->unit_price, 0, ',', ' ') . ' XOF',
        ];
    }
}
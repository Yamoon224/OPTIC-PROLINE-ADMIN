<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Enums\PaymentStatusEnum;
use App\Enums\OrderStatusEnum;

class StoreOrderRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'user_id' => ['required', 'exists:users,id'],
            'amount' => ['required', 'numeric', 'min:0'],
            'discount' => ['nullable', 'numeric', 'min:0'],
            'payment_status' => ['nullable', Rule::in(array_column(PaymentStatusEnum::cases(), 'value'))],
            'order_status' => ['nullable', Rule::in(array_column(OrderStatusEnum::cases(), 'value'))],
            'delivery_address' => ['required', 'string'],
            'billing_address' => ['nullable', 'string'],
        ];
    }
}
<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Enums\PaymentMethodEnum;

class UpdatePaymentRequest extends FormRequest
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
            'order_id' => ['sometimes', 'required', 'exists:orders,id'],
            'amount' => ['sometimes', 'required', 'numeric', 'min:0'],
            'payment_method' => ['sometimes', 'required', Rule::in(array_column(PaymentMethodEnum::cases(), 'value'))],
            'transaction_id' => ['nullable', 'string', 'max:255'],
            'operator_id' => ['nullable', 'string', 'max:100'],
            'currency' => ['nullable', 'string', 'max:10'],
            'payment_date' => ['nullable', 'date'],
        ];
    }
}

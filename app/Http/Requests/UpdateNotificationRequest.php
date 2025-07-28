<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateNotificationRequest extends FormRequest
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
            'notifiable_id' => ['sometimes', 'required', 'integer'],
            'notifiable_type' => ['sometimes', 'required', 'string', 'max:100'],
            'type' => ['sometimes', 'required', 'string', 'max:255'],
            'data' => ['sometimes', 'required', 'array'],
            'read_at' => ['nullable', 'date'],
        ];
    }
}
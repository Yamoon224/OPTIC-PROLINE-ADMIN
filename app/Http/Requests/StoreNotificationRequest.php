<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreNotificationRequest extends FormRequest
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
            'notifiable_id' => ['required', 'integer'],
            'notifiable_type' => ['required', 'string', 'max:100'], // e.g., 'App\\Models\\User', 'App\\Models\\Company'
            'type' => ['required', 'string', 'max:255'],
            'data' => ['required', 'array'], // Expecting an array that will be cast to JSON
            'read_at' => ['nullable', 'date'],
        ];
    }
}
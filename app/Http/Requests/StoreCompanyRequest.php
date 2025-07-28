<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCompanyRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // Adjust authorization logic as needed, e.g., Auth::check() or policy checks
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
            'name' => ['required', 'string', 'max:255'],
            'register_id' => ['nullable', 'string', 'max:255', 'unique:companies,register_id'], // Nouvelle règle
            'address' => ['required', 'string', 'max:255'],                                     // Nouvelle règle
            'contact' => ['required', 'string', 'max:255'],                                     // Nouvelle règle
        ];
    }
}

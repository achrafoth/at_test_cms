<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UpdateATSoftwareRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Auth::check() && (
            Auth::user()->hasRole('Admin') || 
            Auth::user()->hasRole('Manager') || 
            Auth::user()->hasRole('Inventory Manager')
        );
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
            'version' => ['nullable', 'string', 'max:50'],
            'description' => ['nullable', 'string'],
            'supplier_id' => ['required', 'exists:suppliers,id'],
            'license_key' => ['nullable', 'string', 'max:255'],
            'number_of_licenses' => ['required', 'integer', 'min:0'],
            'expiry_date' => ['nullable', 'date', 'after_or_equal:today'],
        ];
    }
}

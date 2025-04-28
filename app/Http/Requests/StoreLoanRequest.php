<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreLoanRequest extends FormRequest
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
            'client_id' => ['required', 'exists:clients,id'],
            'at_equipment_id' => ['required', 'exists:at_equipment,id'],
            'start_date' => ['required', 'date'],
            'expected_return_date' => ['required', 'date', 'after_or_equal:start_date'],
            'actual_return_date' => ['nullable', 'date', 'after_or_equal:start_date'],
            'status' => ['required', 'in:on_loan,returned,lost'],
            'notes' => ['nullable', 'string'],
        ];
    }
}

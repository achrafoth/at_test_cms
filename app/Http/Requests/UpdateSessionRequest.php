<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UpdateSessionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Auth::check() && (
            Auth::user()->hasRole('Admin') || 
            Auth::user()->hasRole('Manager') || 
            Auth::user()->hasRole('Trusted Specialist') || 
            Auth::user()->hasRole('AT Expert')
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
            'client_id' => 'required|exists:clients,id',
            'trusted_specialist_id' => 'required|exists:trusted_specialists,id',
            'at_expert_id' => 'nullable|exists:a_t_experts,id',
            'session_type' => 'required|in:Assessment,Training,Device Setup,Follow-up',
            'session_date' => 'required|date',
            'session_duration' => 'required|integer|min:1',
            'notes' => 'nullable|string',
            'outcome' => 'nullable|string',
        ];
    }
}

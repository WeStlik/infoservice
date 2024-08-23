<?php

namespace App\Http\Requests;

use App\Models\Leads;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class LeadsRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'first_name' => ['required', 'string', 'max:32'],
            'last_name' => ['required', 'string', 'max:32'],
            'email' => ['required', 'string', 'email', 'lowercase'],
            'phone' => ['required', 'digits:10'],
            'lead_text' => ['nullable', 'string'],
        ];
    }
}

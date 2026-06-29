<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreFamilyRequest extends FormRequest
{
    public function authorize(): bool { return true; }
    public function rules(): array
    {
        return [
            'date' => 'required|date',
            'recipient' => 'required|string|max:255',
            'relationship' => 'required|string|max:100',
            'amount' => 'required|numeric|min:0.01|max:999999.99',
            'method' => 'required|string|max:100',
            'purpose' => 'nullable|string|max:1000',
        ];
    }
}

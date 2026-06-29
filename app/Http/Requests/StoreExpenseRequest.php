<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreExpenseRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'date' => 'required|date',
            'description' => 'required|string|max:255',
            'category' => 'required|string|max:100',
            'amount' => 'required|numeric|min:0.01|max:999999.99',
            'method' => 'required|string|max:100',
            'vendor' => 'nullable|string|max:255',
            'notes' => 'nullable|string|max:1000',
        ];
    }
}

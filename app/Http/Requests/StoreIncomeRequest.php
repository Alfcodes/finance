<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreIncomeRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'date' => 'required|date',
            'source' => 'required|string|max:255',
            'type' => 'required|string|max:100',
            'amount' => 'required|numeric|min:0.01|max:999999.99',
            'notes' => 'nullable|string|max:1000',
        ];
    }
}

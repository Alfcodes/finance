<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSavingRequest extends FormRequest
{
    public function authorize(): bool { return true; }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'type' => 'required|string|max:100',
            'opening' => 'required|numeric|min:0|max:999999.99',
            'contribution' => 'required|numeric|min:0|max:999999.99',
            'current' => 'required|numeric|min:0|max:999999.99',
            'target' => 'required|numeric|min:0.01|max:999999.99',
        ];
    }
}

<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreGoalRequest extends FormRequest
{
    public function authorize(): bool { return true; }
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'target' => 'required|numeric|min:0.01|max:999999.99',
            'current' => 'required|numeric|min:0|max:999999.99',
            'deadline' => 'nullable|date',
            'category' => 'required|string|max:100',
        ];
    }
}

<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAttribute extends FormRequest
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
             'product_id'=>'required|integer|exists:products,id',
            'sumthumb'=>'nullable|string|max:255',
            'additional_info'=>'nullable|string|max:255',
            'dimension'=>'nullable|string|max:255',
            'maincompartment'=>'nullable|string|max:255',
            'durable_fabric'=>'nullable|string|max:255',
            'spacious'=>'nullable|string|max:255',
        ];
    }
}

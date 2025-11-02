<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class StoreAttribute extends FormRequest
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
            'sumthumb'=>'required|string|max:255',
            'additional_info'=>'required|string|max:255',
            'dimension'=>'required|string|max:255',
            'maincompartment'=>'required|string|max:255',
            'durable_fabric'=>'required|string|max:255',
            'spacious'=>'required|string|max:255',
        ];
    }
}

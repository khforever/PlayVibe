<?php

namespace App\Http\Requests\Api;

use App\Enum\UserType;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class RegisterRequest extends FormRequest
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
            
        'first_name'   => ['required', 'string', 'max:255'],
        'last_name'    => ['required', 'string', 'max:255'],
        'email'        => ['required', 'email', 'unique:users,email'],
        'password' => ['required','min:6','confirmed'],
        'phone'        => ['nullable', 'regex:/^01[0125][0-9]{8}$/','unique:users,phone'],
        'address'      => ['nullable', 'string'],
        'city'         => ['nullable', 'string'],
        'image'        => ['nullable', 'image', 'max:2048'],
        'user_type' => ['required', 'integer', Rule::in(array_column(UserType::cases(), 'value'))],
        ];
    }
}

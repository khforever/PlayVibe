<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class ResetPassword extends FormRequest
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
             'email' => 'required|email|exists:users',
            'otp'=>'required',
            'old_password'=> 'required|min:6',
            'new_password'=>'required|min:6|confirmed',
        ];
    }
}

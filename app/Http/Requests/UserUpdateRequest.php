<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
class UserUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        // Get the user ID from the route parameter
        $userId = $this->route('id');

        return [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => "required|email|unique:users,email,{$userId}",
            'password' => 'nullable|string|min:8|confirmed',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:255',
            'city' => 'nullable|string|max:255',
            'user_type' => 'required|integer|in:1,2',
            'is_verified' => 'nullable|in:0,1',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
        ];
    }

    /**
     * Handle a failed validation attempt.
     */


    protected function failedValidation(\Illuminate\Contracts\Validation\Validator $validator)
    {
        $userId = $this->route('id');

        throw new \Illuminate\Validation\ValidationException(
            $validator,
            redirect()->route('users.edit', $userId)
                ->withErrors($validator)
                ->withInput()
        );
    }




}

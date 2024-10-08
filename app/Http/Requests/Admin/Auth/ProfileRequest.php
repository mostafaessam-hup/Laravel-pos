<?php

namespace App\Http\Requests\Admin\Auth;

use Illuminate\Foundation\Http\FormRequest;

class ProfileRequest extends FormRequest
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
            'full_name' => 'nullable|string|max:100',
            'email' => 'nullable|email|max:100',
            'country_code' => 'nullable|string|max:5',
            'phone' => 'nullable|string|max:20',
            'old_password' => 'nullable|required_if:new_password,!null|string|max:100',
            'new_password' => 'nullable|string|confirmed|max:100',
        ];
    }
}

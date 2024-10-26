<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    public function prepareForValidation()
    {
        $this->merge([
            'country_code' => $this->country_code ?? '91',
            'language_id' => 1,
        ]);
    }
    public function rules(): array
    {
        switch ($this->method()) {
            case 'GET':
            case 'DELETE': {
                    return [];
                }
            case 'POST': {
                    return [
                        'full_name' => 'required|string|max:255',
                        'email' => 'required|email|unique:users,email',
                        'password' => 'required|string|min:6',
                        'phone' => 'required|string|max:20|unique:users,phone',
                        'country_code' => 'required|numeric|exists:countries,phone_code',
                        'language_id' => 'required|integer|exists:languages,id',
                    ];
                }
            case 'PUT': {
                    return [];
                }
        }
    }
}

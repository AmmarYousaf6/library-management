<?php

namespace App\Http\Requests;

use App\Rules\IsValidPassword;
use Illuminate\Foundation\Http\FormRequest;

class RegisterUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => [
                'required',
                'confirmed',
                'string',
                new IsValidPassword(),
            ],
            'date_of_birth' => 'required|date'
        ];
    }
}

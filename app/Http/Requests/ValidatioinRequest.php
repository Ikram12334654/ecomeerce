<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ValidatioinRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'sometimes|required|string|max:50',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8'

        ];
    }
    public function messages(): array
    {
        return [
            'name.required' => 'name is required',
            'email.required' => 'eamil must be unique and required',
            'password.required' => 'password is required'

        ];
    }
}

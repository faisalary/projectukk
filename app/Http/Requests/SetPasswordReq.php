<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SetPasswordReq extends FormRequest
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
            'password' => 'required|string|min:8|confirmed',
        ];
    }

    public function messages()
    {
        return[
            'password.required' => 'password harus di isi',
            'password.string' => 'password sudah terdaftar',
            'password.min:8' => 'password min 8',
            'password.confirmed' => 'password tidak sesuai',
        ];
    }
}

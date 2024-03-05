<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CompanyReg extends FormRequest
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
            'namaindustri' => 'required|string|max:255',
            'email' => 'required|email:rfc,dns|unique:users',
        ];
    }
    public function messages()
    {
        return [

            'email.required' => 'email wajib di isi ',
            'email.unique' => 'email sudah terdaftar',
            'email.email' => 'format salah',
            'email.rfc,dns' => 'masukkan email dengan benar',

            'namaindustri.required' => 'nama perusahaan wajib di isi ',
            'namaindustri.min' => 'Minimal 5 karakter',
            'namaindustri.max' => 'Maksimal 60 karakter',
        ];
    }
}

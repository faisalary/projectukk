<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisMahasiswa extends FormRequest
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
            'nim' => 'required|numeric|unique:users|exists:mahasiswa,nim'
        ];
    }
    public function messages()
    {
        return[
            'nim.required' => 'NIM harus di isi',
            'nim.unique' => 'nim sudah terdaftar',
            'nim.numeric' => 'nim harus angka',
            'nim.exists' => 'nim tidak ditemukan, hubungi LKM untuk info lebih lanjut',
        ];
    }
}

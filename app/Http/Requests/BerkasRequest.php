<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BerkasRequest extends FormRequest
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
            'berkas.*.namaberkas' => ['required', 'max:255'],
            'berkas.*.statusupload' => ['required'],
        ];
    }

    public function messages(): array
    {
        return [
            'berkas.*.namaberkas.required' => 'Berkas Magang harus diisi!',
            'berkas.*.statusupload.required' => 'Status Upload harus diisi!',
        ];
    }
}

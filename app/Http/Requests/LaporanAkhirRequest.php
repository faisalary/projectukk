<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LaporanAkhirRequest extends FormRequest
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
            'jenismagang' => ['required'],
            'durasimagang' => ['required'],
            'berkas' => ['required'],
            'pengumpulan' => ['required'],
            'penilaian' => ['required'],
        ];
    }

    public function messages(): array
    {
        return [
            'jenismagang.required' => 'Jenis Magang harus diisi!',
            'durasimagang.required' => 'Durasi Magang harus diisi!',
            'berkas.required' => 'Berkas Magang harus diisi!',
            'pengumpulan.required' => 'Tenggat pengumpulan harus diisi!',
            'penilaian.required' => 'Tenggat penilaian harus diisi!',
        ];
    }
}

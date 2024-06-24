<?php

namespace App\Http\Requests;

use App\Models\JenisMagang;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class KomponenNilaiRequest extends FormRequest
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
            'id_jenismagang' => ['required'],
            'komponen.*.aspek_penilaian' => ['required'],
            'komponen.*.deskripsi_penilaian' => ['required'],
            'komponen.*.scored_by' => ['required', 'in:1,2'],
            'komponen.*.nilai_max' => ['required']

        ];
    }

    public function messages()
    {
        return [
            'id_jenismagang.required' => 'Jenis Magang harus diisi',
            'komponen.*.aspek_penilaian.required' => 'Aspek Penilaian harus diisi',
            'komponen.*.deskripsi_penilaian.required' => 'Deskripsi Penilaian harus diisi',
            'komponen.*.scored_by.required' => 'Pilih salah satu.',
            'komponen.*.nilai_max.required' => 'Nilai Max harus diisi',

        ];
    }
}

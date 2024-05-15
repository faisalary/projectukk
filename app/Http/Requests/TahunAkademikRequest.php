<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class TahunAkademikRequest extends FormRequest
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
        'tahun' => 'required|string|max:255',
        'semester' => 'required|string|max:255',
        'startdate_daftar' => 'required',
        'enddate_daftar' => 'required',
        'startdate_pengumpulan_berkas' => 'required',
        'enddate_pengumpulan_berkas' => 'required',
        ];
    }

    public function messages(): array
    {
        return [
            'tahun.required' => 'Academic year must be filled',
            'tahun.numeric' => 'Academic year must be number',
            'semester.required' => 'Semester must be filled',
            'startdate_daftar.required' => 'Tanggal Mulai Pendaftaran Magang must be filled',
            'enddate_daftar.required' => 'Tanggal Akhir Pendaftaran Magang must be filled',
            'startdate_pengumpulan_berkas.required' => 'Tanggal Mulai Pengumpulan Berkas must be filled',
            'enddate_pengumpulan_berkas.required' => 'Tanggal Akhir Pengumpulan Berkas must be filled',
        ];
    }
}
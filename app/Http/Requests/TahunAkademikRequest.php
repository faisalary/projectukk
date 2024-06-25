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
        $validate = [
            'tahun' => 'required|unique:tahun_akademik,tahun|numeric|digits:4',
            'semester' => 'required||in:Ganjil,Genap',
            'startdate_daftar' => 'required',
            'enddate_daftar' => 'required',
            'startdate_pengumpulan_berkas' => 'required',
            'enddate_pengumpulan_berkas' => 'required',
        ];

        if (isset($this->id)) {
            $validate['tahun'] = 'required|unique:tahun_akademik,tahun,'.$this->id.',id_year_akademik|numeric|digits:4';
        }

        return $validate;
    }

    public function messages(): array
    {
        return [
            'tahun.required' => 'Tahun Ajaran harus diisi',
            'tahun.unique' => 'Tahun Ajaran sudah ada',
            'tahun.numeric' => 'Tahun Ajaran harus angka',
            'tahun.digits' => 'Tahun Ajaran harus 4 digit',
            'semester.required' => 'Semester harus dipilih',
            'semester.in' => 'Semester tidak valid',
            'startdate_daftar.required' => 'Tanggal Mulai Pendaftaran Magang harus diisi',
            'enddate_daftar.required' => 'Tanggal Akhir Pendaftaran Magang harus diisi',
            'startdate_pengumpulan_berkas.required' => 'Tanggal Mulai Pengumpulan Berkas harus diisi',
            'enddate_pengumpulan_berkas.required' => 'Tanggal Akhir Pengumpulan Berkas harus diisi',
        ];
    }
}
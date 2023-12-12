<?php

namespace App\Http\Requests;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class LowonganMagangRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        if (isset($this->id)) {
            return [
                'mitra' => ['required', 'string','max:255'],
                'tahunajaran' => ['required', 'string','max:255'],
                'created_by' => ['required', 'integer'],
                'jenismagang' => ['required', 'string','max:255'],
                'created_at' => ['required', 'integer'],
                'posisi' => ['required', 'string','max:255'],
                'bidang' => ['required', 'string','max:255'],
                'durasimagang' => ['required', 'integer', 'max:255'],
                'deskripsi' => ['required', 'string', 'max:255'],
                'requirements' => ['required', 'text', 'max:255'],
                'kuota' => ['required', 'integer', 'max:255'],
                'lokasi' => ['required'],
                'benefitmagang' => ['required', 'text', 'max:255'],
                'startdate' => ['required', 'date',],
                'enddate' => ['required', 'date', 'max:255'],
                'tahapan_seleksi' => ['required', 'string', 'max:255'],
                'informasi_lowongan' => ['required', 'date', 'max:255'],
                'program_studi' => ['required', 'string', 'max:255'],
                'fakultas' => ['required', 'string', 'max:255'],
                'paid' => ['required', 'boolean'],
            ];
        }
        return [
            'mitra' => ['required', 'string','max:255'],
            'tahunajaran' => ['required', 'string','max:255'],
            'created_by' => ['required', 'integer'],
            'jenismagang' => ['required', 'string','max:255'],
            'created_at' => ['required', 'integer'],
            'posisi' => ['required', 'string','max:255'],
            'bidang' => ['required', 'string','max:255'],
            'durasimagang' => ['required', 'integer', 'max:255'],
            'deskripsi' => ['required', 'string', 'max:255'],
            'requirements' => ['required', 'text', 'max:255'],
            'kuota' => ['required', 'integer', 'max:255'],
            'lokasi' => ['required'],
            'benefitmagang' => ['required', 'text', 'max:255'],
            'startdate' => ['required', 'date',],
            'enddate' => ['required', 'date', 'max:255'],
            'tahapan_seleksi' => ['required', 'string', 'max:255'],
            'informasi_lowongan' => ['required', 'date', 'max:255'],
            'program_studi' => ['required', 'string', 'max:255'],
            'fakultas' => ['required', 'string', 'max:255'],
            'paid' => ['required', 'boolean'],
        ];
    }
    public function messages(): array
    {
        return [
            'id_industri.required' => 'Mitra must be filled',
            'id_year_akademik.required' => 'School year must be filled',
            'created_by.required' => 'created_by must be filled',
            'id_jenismagang.required' => 'JenisMagang must be filled',
            'created_at.required' => 'created_at must be filled',
            'intern_position.required' => 'Position must be filled',
            'bidang.required' => 'Field must be filled',
            'durasimagang.required' => 'Duration of internship must be filled',
            'deskripsi.required' => 'Description must be filled',
            'requirements.required' => 'Qualification must be filled',
            'id_lokasi.required' => 'Location must be filled',
            'kuota.required' => 'Quota must be filled',
            'benefitmagang.required' => 'internship benefits must be filled',
            'startdate.required' => 'Startdate must be filled',
            'enddate.required' => 'Enddate must be filled',
            'tahapan_seleksi.required' => 'Selection stage must be filled',
            'date_confirm_closing.required' => 'date_confirm_closing must be filled',
            'pelaksanaan.required' => 'Implementation must be filled',
            'id_prodi.required' => 'Prodi must be filled',
            'id_fakultas.required' => 'Fakultas must be filled',
            'paid' => 'paid must be filled',
        ];
    }
}

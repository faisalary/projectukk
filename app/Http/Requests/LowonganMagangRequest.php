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
        return true;
    }

    public function rules(): array
    {
        if (isset($this->id)) {
            return [
                // 'jenismagang' => ['required', 'string','max:255'],
                'posisi' => ['required', 'string','max:255'],
                // 'durasimagang' => ['required', 'integer', 'max:255'],
                // 'tahapan_seleksi' => ['required', 'string', 'max:255'],

            ];
        }
        return [
                // 'jenismagang' => ['required', 'string','max:255'],
                'posisi' => ['required', 'string','max:255'],
                // 'kuota' => ['required', 'integer'],
                // 'deskripsi' => ['required', 'string','max:255'],
                // 'requirements' => ['required', 'text', 'max:255'],
                // 'jenjang' => ['required', 'string','max:255'],
                // 'bidang' => ['required', 'string','max:255'],
                // 'keterampilan' => ['required', 'string','max:255'],
                // 'paid' => ['required', 'boolean'],
                // 'benefitmagang' => ['required', 'text', 'max:255'],
                // 'lokasi' => ['required'],
                // 'startdate' => ['required', 'date',],
                // 'enddate' => ['required', 'date', 'max:255'],
                // 'durasimagang' => ['required', 'integer', 'max:255'],
                // 'tahapan_seleksi' => ['required', 'string', 'max:255'],
        ];
    }
    public function messages(): array
    {
        return [
            // 'jenismagang.required' => 'Type of intership be filled',
            'posisi.required' => 'Position must be filled',
            // 'kuota.required' => 'The kuota must be an integer.',
            // 'deskripsi.required' => 'Description must be filled',
            // 'requirements.required' => 'Qualification must be filled',
            // 'jenjang.required' => 'level must be filled',
            // 'bidang.required' => 'field must be filled',
            // 'keterampilan.required' => 'skills must be filled',
            // 'paid' => 'paid must be filled',
            // 'benefitmagang.required' => 'internship benefits must be filled',
            // 'id_lokasi.required' => 'Location must be filled',
            // 'startdate.required' => 'Startdate must be filled',
            // 'enddate.required' => 'Enddate must be filled',
            // 'durasimagang.required' => 'Duration of internship must be filled',
            // 'tahapan_seleksi.required' => 'Selection stage must be filled',
        ];
    }
}

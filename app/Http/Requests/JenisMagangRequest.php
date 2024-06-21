<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Validation\Rule;

class JenisMagangRequest extends FormRequest
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
            'data_step' => ['required'],
            'namajenis' => ['required'],
            'durasimagang' => ['required', 'in:1 Semester,2 Semester'],
            'id_year_akademik' => ['required', 'exists:tahun_akademik,id_year_akademik'],
        ];

        if (isset($this->data_step)) {
            $dataStep = Crypt::decryptString($this->data_step);
            if ($dataStep == 2) {
                $addValidate = [
                    'berkas.*.namaberkas' => ['required'],
                    'berkas.*.statusupload' => ['required', 'in:1,0'],
                    'berkas.*.template' => ['required', 'mimes:pdf', 'max:2048'],
                ];

                $validate = array_merge($validate, $addValidate);
            }
        }

        return $validate;
    }

    public function messages(): array
    {
        return [
            'data_step.required' => 'Tidak valid!',
            'namajenis.required' => 'Jenis Magang harus diisi!',
            'durasimagang.required' => 'Durasi Magang harus dipilih!',
            'durasimagang.in' => 'Durasi Magang tidak valid!',
            'id_year_akademik.required' => 'Tahun Akademik harus dipilih!',
            'id_year_akademik.exists' => 'Tahun Akademik tidak valid!',
            'berkas.*.namaberkas.required' => 'Berkas Magang harus diisi!',
            'berkas.*.statusupload.required' => 'Status Upload harus dipilih!',
            'berkas.*.statusupload.in' => 'Status Upload tidak valid!',
            'berkas.*.template.required' => 'Template harus diisi!',
            'berkas.*.template.mimes' => 'Template harus berupa PDF!',
            'berkas.*.template.max' => 'File Template tidak boleh lebih dari 2 MB!',
        ];
    }
}

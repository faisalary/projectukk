<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class InformasiPengalamanReq extends FormRequest
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
            'posisi' => 'required|max:100',
            'jenis' => 'required',
            'name_intitutions' => 'required|max:191',
            'startdate' => 'required|date',
            'enddate' => 'required',
            'deskripsi' => 'required|max:255'
        ];
    }

    public function messages()
    {
        return[
            'posisi.required' => 'Posisi Wajib Di isi',
            'jenis.required' => 'jenis pekerjaan wajib di isi',
            'name_intitutions' => 'nama perusahaan wajib di isi',
            'startdate.required' => 'tanggal mulai tidak boleh kosong',
            'enddate.required' => 'tanggal berakhir tidak boleh kosong',
            'deskripsi.required' => 'deskripsi pekerjaan wajib di isi'
        ];
    }
}

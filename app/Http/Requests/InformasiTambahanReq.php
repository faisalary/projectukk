<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class InformasiTambahanReq extends FormRequest
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
            'lok_magang' => 'required|max:255|string',
            'namaSosmed' => 'required|max:255',
            'bahasa' => 'required|max:100',
            'urlSosmed' => 'required|url'
        ];
    }

    public function messages()
    {
        return[
            'lok_magang.required' => 'Lokasi Magang wajib di isi',
            'lok_magang.string' => 'lokasi magang berupa huruf',
            'namaSosmed.required' => 'Pilih Sosmed',
            'bahasa.required' => 'Bahasa Wajib di isi',
            'urlSosmed.required'=> 'url wajib di isi',
            'urlSosmed.url'=> 'url tidak valid'
        ];
    }
}

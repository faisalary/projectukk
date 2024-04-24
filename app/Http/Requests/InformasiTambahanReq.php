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
            'bahasa' => 'required|max:100',
            // 'namaSosmed' => 'required|max:255',
            // 'urlSosmed' => 'required|url'
        ];
    }

    public function messages()
    {
        return[
            'lok_magang.required' => 'Lokasi Magang wajib di isi',
            'lok_magang.string' => 'lokasi magang berupa huruf',
            'bahasa.required' => 'Bahasa Wajib di isi',
            // 'namaSosmed.required' => 'Pilih Sosmed',
            // 'urlSosmed.required'=> 'url wajib di isi',
            // 'urlSosmed.url'=> 'url tidak valid'
        ];
    }
}

<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DokumenRequest extends FormRequest
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
            'nama_sertif' => 'required|max:255|min:3',
            'penerbit' => 'required|max:255|min:3',
            'file_sertif' =>  'required|file|max:10000|mimes:doc,docx,pdf,png,jpeg,jpg',
            'link_sertif' => 'required|url',
            'startdate' => 'required',
            'enddate' => 'required',
            'deskripsi' => 'required|max:255|string'
        ];
    }

    public function messages()
    {
        return [
            'nama_sertif.required' => 'nama tidak boleh kosong',
            'nama_sertif.max' => 'nama terlalu panjang',
            'nama_sertid.min' => 'nama terlalu pendek',
            'penerbit.required' => 'penerbit tidak boleh kosong',

            
        ];
    }
}

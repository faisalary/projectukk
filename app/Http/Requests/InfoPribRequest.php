<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class InfoPribRequest extends FormRequest
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
                'tgl_lahir' => 'required|before:today',
                'ipk' => "required|numeric|min:0|max:4|regex:/^\d+(\.\d{1,2})?$/",
                'TAK' => "required|numeric",
                'eprt' => "required|numeric|max:677",
                'gender' => 'required',
                'headliner' => 'required',
                'headliner' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'tgl_lahir.required' => 'Tanggal lahir wajib di isi',

            'ipk.required' => 'IPK wajib di isi',
            'ipk.regex' => 'isi IPK dengan benar',
            'ipk.max' => 'isi IPK dengan benar',
            'ipk.numeric' => 'IPK harus berupa angka',

            'TAK.required' =>  'TAK wajib di isi',
            'TAK.numeric' =>  'TAK harus berupa angka',

            'gender' =>  'jenis kelamin wajib di isi',

            'headliner' => 'wajib di isi',

            'eprt.required' => 'EPRT wajib di isi',
            'eprt.numeric' => 'EPRT harus berupa angka',
            'eprt.max' => 'isi EPRT dengan benar',
        ];
    }
}

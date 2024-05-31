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
                'gender' => 'required',
                'headliner' => 'required',
                'headliner' => 'required',
                'profile_picture' => 'extensions:jpg,png,jpeg|max:10000'
        ];
    }

    public function messages()
    {
        return [
            'tgl_lahir.required' => 'Tanggal lahir wajib di isi',
            'gender' =>  'jenis kelamin wajib di isi',
            'headliner' => 'wajib di isi',
            'profile_picture.required' => 'isi foto profile',
            'profile_picture.extensions' => 'harus berupa png, jpeg, dan jpg',
            'profile_picture.max' => 'maksimum ukuran file adalah 10000kb'
        ];
    }
}

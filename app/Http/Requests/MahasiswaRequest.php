<?php

namespace App\Http\Requests;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;


class MahasiswaRequest extends FormRequest
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
        if (isset($this->id)) {
            return [
                'nim' => ['required', 'string','max:15', 'unique:mahasiswa', Rule::unique('mahasiswa')->ignore($this->id, 'nim')],
                'angkatan' => ['required', 'integer'],
                'namaprodi' => ['required', 'string','max:255'],
                'namauniv' => ['required', 'string', 'max:255'],
                'namafakultas' => ['required', 'string', 'max:255'],
                'namamhs' => ['required', 'string', 'max:255'],
                'alamatmhs' => ['required', 'string', 'max:255'],
                'emailmhs' => ['required', 'string', 'max:255'],
                'nohpmhs' => ['required', 'numeric',],
            ];    
        }  
        return [
            'nim' => ['required', 'string','max:15','unique:mahasiswa'],
            'angkatan' => ['required', 'integer'],
            'namaprodi' => ['required', 'string','max:255'],
            'namauniv' => ['required', 'string', 'max:255'],
            'namafakultas' => ['required', 'string', 'max:255'],
            'namamhs' => ['required', 'string', 'max:255'],
            'alamatmhs' => ['required', 'string', 'max:255'],
            'emailmhs' => ['required', 'string', 'max:255'],
            'nohpmhs' => ['required', 'numeric',],
        ];
    }           
    public function messages(): array
    {
        return [
            'nim.required' => 'NIM already exist',
            'angkatan.required' => 'Angkatan must be filled',
            'id_prodi.required' => 'Prodi must be filled',
            'id_univ.max' => 'Universitas must be filled',
            'id_fakultas.required' => 'Fakultas must be filled',
            'namamhs.required' => 'The name of Mahasiswa must be filled',
            'nohpmhs.required' => 'The phone number must be filled',
            'nohpmhs.numeric' => 'The phone number must be number',
            'nohpmhs.digits' => 'The phone number must be 12 digits',
            'alamatmhs.required' => 'The address must be filled',
            'emaildosen' => 'The Email must be filled'
        ];
    }
}
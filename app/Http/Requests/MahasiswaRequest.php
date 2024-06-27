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
        $nim = ['required', 'string','max:15','unique:mahasiswa'];
        if (isset($this->id)) {
            array_push($nim, Rule::unique('mahasiswa')->ignore($this->id, 'nim'));
        }  
        return [
            'nim' => $nim,
            'angkatan' => ['required', 'integer'],
            'id_prodi' => ['required', 'string','max:255'],
            'id_univ' => ['required', 'string', 'max:255'],
            'id_fakultas' => ['required', 'string', 'max:255'],
            'namamhs' => ['required', 'string', 'max:255'],
            'alamatmhs' => ['required', 'string', 'max:255'],
            'emailmhs' => ['required', 'string', 'max:255'],
            'nohpmhs' => ['required', 'numeric',],
            'eprt' => ['required', 'numeric',],
            'tak' => ['required', 'numeric',],
            'ipk' => ['required', 'regex:/^\d{1}(\.\d{0,2})?$/',],
            'tunggakan_bpp' => ['required', 'string',],
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
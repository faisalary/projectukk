<?php

namespace App\Http\Requests;

use App\Models\Fakultas;
use App\Models\ProgramStudi;
use App\Models\Universitas;
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
            'id_prodi' => ['required', 'string','max:255', function ($attribute, $value, $fail) {
                $fakultas = Fakultas::where('id_fakultas', $this->id_fakultas)->first();
                $prodi = $fakultas->program_studi()->where('id_prodi', $value)->first();
                if (!$prodi) {
                    $fail('Program Studi not found');
                }
            }],
            'id_univ' => ['required', 'string', 'max:255', 'exists:universitas,id_univ'],
            'id_fakultas' => ['required', 'string', 'max:255', function ($attribute, $value, $fail) {
                $univ = Universitas::where('id_univ', $this->id_univ)->first();
                $fakultas = $univ->fakultas()->where('id_fakultas', $value)->first();
                if (!$fakultas) {
                    $fail('Fakultas not found');
                }
            }],
            'kode_dosen' => ['required', 'string', 'max:5', function ($attribute, $value, $fail) {
                $prodi = ProgramStudi::where('id_prodi', $this->id_prodi)->first();
                $dosen = $prodi->dosen()->where('kode_dosen', $value)->first();
                if (!$dosen) {
                    $fail('Dosen not found');
                }
            }],
            'namamhs' => ['required', 'string', 'max:255'],
            'alamatmhs' => ['required', 'string', 'max:255'],
            'emailmhs' => ['required', 'string', 'max:255'],
            'nohpmhs' => ['required', 'phone:id'],
            'eprt' => ['required', 'numeric',],
            'tak' => ['required', 'numeric',],
            'ipk' => ['required', 'regex:/^\d{1}(\.\d{0,2})?$/',],
            'tunggakan_bpp' => ['required', 'string', 'in:Ya,Tidak'],
        ];
    }           
    public function messages(): array
    {
        return [
            'nim.required' => 'NIM must be filled',
            'nim.unique' => 'NIM already exist',
            'angkatan.required' => 'Angkatan must be filled',
            'id_prodi.required' => 'Prodi must be filled',
            'id_prodi.exists' => 'Prodi not found',
            'id_univ.required' => 'Universitas must be filled',
            'id_univ.exists' => 'Universitas not found',
            'id_fakultas.required' => 'Fakultas must be filled',
            'id_fakultas.exists' => 'Fakultas not found',
            'kode_dosen.required' => 'Dosen must be filled',
            'kode_dosen.exists' => 'Dosen not found',
            'kode_dosen.max' => 'Dosen must be 5 characters',
            'namamhs.required' => 'The name of Mahasiswa must be filled',
            'emailmhs.required' => 'The Email must be filled',
            'nohpmhs.required' => 'The phone number must be filled',
            'nohpmhs.phone' => 'The phone number must be valid',
            'alamatmhs.required' => 'The address must be filled',
            'eprt.required' => 'The EPRT must be filled',
            'tak.required' => 'The TAK must be filled',
            'ipk.required' => 'The IPK must be filled',
            'tunggakan_bpp.required' => 'Choose tungggakan BPP',
            'tunggakan_bpp.in' => 'Tungggakan BPP invalid',
        ];
    }
}
<?php

namespace App\Http\Requests;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;
use App\Models\Dosen;
use App\Models\Universitas;
use App\Models\ProgramStudi;

class DosenRequest extends FormRequest
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
                'nip' => ['required', 'integer', 'unique:dosen', Rule::unique('dosen')->ignore($this->id, 'nip')],
                'namauniv' => ['required', 'string', 'max:255'],
                'kode_dosen' => ['required', 'string', 'max:5'],
                'namaprodi' => ['required', 'string','max:255'],
                'namadosen' => ['required', 'string', 'max:15'],
                'nohpdosen' => ['required', 'string', ],
                'emaildosen' => ['required', 'string', 'max:255'],
                // 'status' => ['required', 'boolean', 'default:true'],
            ];    
        }  
        return [
            'nip' => ['required', 'integer', 'unique:dosen'],
            'namauniv' => ['required', 'string', 'max:255'],
            'kode_dosen' => ['required', 'string', 'max:5'],
            'namaprodi' => ['required', 'string','max:255'],
            'namadosen' => ['required', 'string', 'max:15'],
            'nohpdosen' => ['required', 'numeric', ],
            'emaildosen' => ['required', 'string', 'max:255'],
            // 'status' => ['required', 'boolean', 'default:true'],
        ];
    }           
    public function messages(): array
    {
        return [
            'nip.required' => 'NIP already exist',
            'namauniv.required' => 'University name must be filled',
            'kode_dosen.required' => 'Kode Dosen must be filled',
            'kode_dosen.max' => 'Ga boleh lebih dari 5',
            'namaprodi.required' => 'The name of Prodi must be filled',
            'namadosen.required' => 'The name of Dosen must be filled',
            'nohpdosen.required' => 'The phone number must be filled',
            'nohpdosen.numeric' => 'The phone number must be number',
            'nohpdosen.digits' => 'The phone number must be 12 digits',
            'emaildosen' => 'The Email must be filled'
        ];
    }
}
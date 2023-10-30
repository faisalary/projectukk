<?php

namespace App\Http\Requests;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class DosenRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
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
                'kodedosen' => ['required', 'string', 'max:255'],
                'namaprodi' => ['required', 'string', 'max:15'],
                'namadosen' => ['required', 'string', 'max:15'],
                'nohpdosen' => ['required', 'numeric', 'digits:12'],
                'emaildosen' => ['required', 'string', 'max:255'],
                // 'status' => ['required', 'boolean', 'default:true'],
            ];    
        }  
        return [
            'nip' => ['required', 'integer', 'unique:dosen', 'unique:dosen'],
            'namauniv' => ['required', 'string', 'max:255'],
            'kodedosen' => ['required', 'string', 'max:255'],
            'namaprodi' => ['required', 'string', 'max:15'],
            'namadosen' => ['required', 'string', 'max:15'],
            'nohpdosen' => ['required', 'numeric', 'digits:12'],
            'emaildosen' => ['required', 'string', 'max:255'],
            // 'status' => ['required', 'boolean', 'default:true'],
        ];
    }           
    public function messages(): array
    {
        return [
            'nip.unique' => 'NIP already exist',
            'namauniv.required' => 'University name must be filled',
            'kodedosen.required' => 'Kode Dosen must be filled',
            'namaprodi.required' => 'The name of Prodi must be filled',
            'namadosen.required' => 'The name of Dosen must be filled',
            'nohpdosen.required' => 'The phone number must be filled',
            'nohpdosen.numeric' => 'The phone number must be number',
            'nohpdosen.digits' => 'The phone number must be 12 digits',
            'emaildosen' => 'The Email must be filled'
        ];
    }
}
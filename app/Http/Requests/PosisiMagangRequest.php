<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PosisiMagangRequest extends FormRequest
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
                'name' => ['required', 'string', Rule::unique('posisi_magang')->ignore($this->id, 'id_posisi_magang')]    
            ];
        }
       

        return [
            'name' => ['required', 'string', 'unique:posisi_magang,name']  
        ];
    }

    public function messages(): array
    {
        return [            
            'name.required' => 'Nama posisi magang tidak boleh kosong',           
            'name.unique' => 'Nama posisi magang sudah ada',           
        ];
    }
}

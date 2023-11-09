<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class KomponenNilaiRequest extends FormRequest
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
        if (isset($this->id)){
            return [
                'jenismagang' => ['required',''],
                'halo1.*.namakomponen' => ['required'],
                // 'halo1.*. tipe' => 1,
                'halo1.*.bobot'=>['required'],
                'halo1.*.scoredby'=>['required'],
               
            ];
        }
        return [
          
            'jenismagang' => ['required',''],
            'halo1.*.namakomponen' => ['required'],
            // 'halo1.*. tipe' => 1,
            'halo1.*.bobot'=>['required'],
            'halo1.*.scoredby'=>['required'],
    ];
    }
}

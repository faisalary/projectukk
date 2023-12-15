<?php

namespace App\Http\Requests;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class LowonganMagangRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        if (isset($this->id)) {
            return [
                'posisi' => ['required', 'string','max:255'],
                'tahun' => ['required', 'string','max:255'],
                'durasimagang' => ['required', 'integer'],
            ];
        }
        return [
                'posisi' => ['required', 'string','max:255'],
                'fakultas' => ['required', 'string', 'max:255'],
                'prodi' => ['required', 'string', 'max:255'],
                'tahun' => ['required', 'string','max:255'],
                'durasimagang' => ['required', 'integer'],
        ];
    }
    public function messages(): array
    {
        return [
            'posisi.required' => 'Position must be filled',
            'fakultas.required' => 'Fakultas must be filled',
            'prodi.required' => 'Prodi must be filled',
            'tahun.required' => 'School year must be filled',
            'durasimagang.required' => 'Duration of internship must be filled',
        ];
    }
}

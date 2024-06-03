<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class JenisMagangRequest extends FormRequest
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
                'jenis' => ['required', 'string', 'max:255'],
                'durasimagang' => ['required'],
                'tahunakademik' => ['required'],
            ];
        }
        return [
            'jenis' => ['required', 'string', 'max:255'],
            'durasimagang' => ['required'],
            'tahunakademik' => ['required'],
        ];
    }

    public function messages(): array
    {
        return [
            'jenis.required' => 'Jenis Magang harus diisi!',
            'jenis.string' => 'Jenis Magang harus huruf!',
            'durasimagang.required' => 'Durasi Magang harus diisi!',
            'tahunakademik.required' => 'Tahun Akademik harus diisi!',

        ];
    }
}

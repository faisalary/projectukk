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
                'kuota' => ['required', 'integer'],
                'deskripsi' => ['required', 'string','max:255'],
            ];
        }
        return [
                'posisi' => ['required', 'string','max:255'],
                'kuota' => ['required', 'integer'],
                'deskripsi' => ['required', 'string','max:255'],
        ];
    }
    public function messages(): array
    {
        return [
            'posisi.required' => 'Posisi  magang wajib diisi',
            'kuota.required' => 'Kuota wajib di isi',
            'deskripsi.required' => 'Deskripsi wajib di isi',
            'posisi.string' => 'format tidak valid',
            'kuota.integer' => 'Kuota harus berupa angka',
            'deskripsi.string' => 'Format deskripsi tidak valid',
            
        ];
    }
}

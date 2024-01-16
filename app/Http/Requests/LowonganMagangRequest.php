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
                // 'requirements' => ['required', 'text', 'max:255'],

            ];
        }
        return [
                'posisi' => ['required', 'string','max:255'],
                'kuota' => ['required', 'integer'],
                'deskripsi' => ['required', 'string','max:255'],
                // 'requirements' => ['required', 'text', 'max:255'],
        ];
    }
    public function messages(): array
    {
        return [
            'posisi.required' => 'Position must be filled',
            'kuota.required' => 'The kuota must be an integer.',
            'deskripsi.required' => 'Description must be filled',
            // 'requirements.required' => 'Qualification must be filled',
        ];
    }
}

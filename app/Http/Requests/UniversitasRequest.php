<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UniversitasRequest extends FormRequest
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
                'namauniv' => ['required', 'string', 'max:255', Rule::unique('universitas')->ignore($this->id, 'id_univ')],
                'jalan' => ['required', 'string', 'max:255'],
                'kota' => ['required', 'string', 'max:255'],
                'telp' => ['required', 'numeric', 'digits:12'],
            ];
        }
        return [
            'namauniv' => ['required', 'string', 'max:255', 'unique:universitas'],
            'jalan' => ['required', 'string', 'max:255'],
            'kota' => ['required', 'string', 'max:255'],
            'telp' => ['required', 'numeric', 'digits:12'],
        ];
    }

    public function messages(): array
    {
        return [
            'namauniv.unique' => 'A University with the name already exist',
            'namauniv.required' => 'University name must be filled',
            'jalan.required' => 'The address must be filled',
            'kota.required' => 'The name of City must be filled',
            'telp.required' => 'The phone number must be filled',
            'telp.numeric' => 'The phone number must be number',
            'telp.digits' => 'The phone number must be 12 digits'
        ];
    }
}

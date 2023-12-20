<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProdiRequest extends FormRequest
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
            'pilihfakultas' => ['required'],
            'pilihuniversitas' => ['required'],
            'namaprodi' => ['required', 'string', 'max:255'],
        ];
    }
    return [
        'pilihfakultas' => ['required'],
        'pilihuniversitas' => ['required'],
        'namaprodi' => ['required', 'string', 'max:255'],
    ];
    }

    public function messages()
    {
        return [
            'pilihfakultas.required' => 'Faculty must be filled',
            'pilihuniversitas.required' => 'University must be filled',
            'namaprodi.required' => 'Study Program must be filled'
        ];
    }
}
<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class SeleksiRequest extends FormRequest
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
                'tahap' => ['required'],
                'waktu' => ['required'],
                'subjek' => ['required'],
            ];
        }
        return [
            'tahap' => ['required'],
            'mulai' => ['required'],
            'subjek' => ['required'],
        ];
    }

    public function messages()
    {
       return [
            'tahap.required' => 'Tahap must be filled',
            'mulai.required' =>'Date must be filled',
            'subjek.required' => 'Email subject must be filled'
        ];
    }
}

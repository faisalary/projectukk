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
                'nama' => ['required'],
                'pelaksanaan' => ['required'],
                'mulai' => ['required'],
                'waktu' => ['required'],
                'tempat' => ['required'],
            ];
        }
        return [
            'nama' => ['required'],
            'pelaksanaan' => ['required'],
            'mulai' => ['required'],
            'waktu' => ['required'],
            'tempat' => ['required'],
        ];
    }

    public function messages()
    {
       return [
            'nama.required' => 'Name must be filled',
            'pelaksanaan.required' =>'Place must be filled',
            'mulai.required' =>'Start Date must be filled',
            'waktu.required' => 'Start Time must be filled',
            'tempat.required' => 'Location details must be filled'
        ];
    }
}

<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class IndustriRequest extends FormRequest
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
                'namaindustri' => ['required', 'string', 'max:255', 'unique:industri'],
                'notelepon' => ['required', 'numeric', 'digits:12'],
                'alamatindustri' => ['required', 'string', 'max:255'],
                'kategorimitra' => ['required'],
                'statuskerjasama' => ['required'],
            ];
        }
        return [
                'namaindustri' => ['required', 'string', 'max:255', 'unique:industri'],
                'notelepon' => ['required', 'numeric', 'digits:12'],
                'alamatindustri' => ['required', 'string', 'max:255'],
                'kategorimitra' => ['required'],
                'statuskerjasama' => ['required'],
        ];
    }

    public function messages()
    {
        return[
            'namaindustri.required' => 'Industri name must be filled',
            'notelepon.required' => 'The phone number must be filled',
            'notelepon.numeric' => 'The phone number must be number',
            'notelepon.digits' => 'The phone number must be 12 digits',
            'alamatindustri.required' => 'The industrial address must be filled',
            'kategorimitra.required' => 'The partner category must be filled',
            'statuskerjasama' => 'The cooperation status must be filled',
        ];
    }
}


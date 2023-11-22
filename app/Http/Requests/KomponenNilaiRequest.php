<?php

namespace App\Http\Requests;

use App\Models\JenisMagang;
use Illuminate\Validation\Rule;
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
        if (isset($this->id)) {
            return [
                'jenismagang' => ['required'],
                'halo1.*.namakomponen' => ['required', 'string', 'max:255'],
                'halo1.*.bobot' => ['required', 'numeric', 'max:100'],
                'halo1.*.scoredby' => ['required', 'string', 'max:255']

            ];
        }
        return [

            'jenismagang' => ['required'],
            'halo1.*.namakomponen' =>  ['required', 'string', 'max:255'],
            'halo1.*.bobot' => ['required', 'numeric', 'max:100'],
            'halo1.*.scoredby' =>  ['required', 'string', 'max:255'],
        ];
    }

    public function messages()
    {
        return [
            'jenismagang.required' => 'Type of internship must be filled',
            'halo1.*.namakomponen.required' => 'Component name must be filled',
            'halo1.*.bobot.required' => 'Score must be filled',
            'halo1.*.bobot.numeric' => 'Score must be number',
            'halo1.*.bobot.max' => 'Maximum score is only 100',
            'halo1.*.scoredby.required' => '"Assessed by" must be filled',

        ];
    }
}

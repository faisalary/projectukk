<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class PegawaiIndustriRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
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
                'namaperusahaan' => ['required'],
                'namapeg' => ['required', 'string', 'max:255', Rule::unique('pegawai_industri')->ignore($this->id, 'id_peg_industri')],
                'nohppeg' => ['required', 'numeric', 'digits:12'],
                'emailpeg' => ['required', 'string', 'max:255'],
                'jabatan' => ['required', 'string', 'max:255'],
                'unit' => ['required', 'string', 'max:255'],
            ];
        }
        return [
            'namaperusahaan' => ['required'],
            'namapeg' => ['required', 'string', 'max:255'],
            'nohppeg' => ['required', 'numeric', 'digits:12'],
            'emailpeg' => ['required', 'string', 'max:255'],
            'jabatan' => ['required', 'string', 'max:255'],
            'unit' => ['required', 'string', 'max:255'],
        ];
    }

    public function messages()
    {
        return[
            'namaperusahaan.required' => 'Program Studin name must be filled',
            'namapeg.required' => 'Program Studi name must be filled',
            'nohppeg.required' => 'The phone number must be filled',
            'nohppeg.numeric' => 'The phone number must be number',
            'nohppeg.digits' => 'The phone number must be 12 digits',
            'emailpeg.required' => 'The e-mail must be filled',
            'jabatan.required' => 'The position must be filled',
            'unit.required' => 'The units must be filled Studi',
        ];
    }
}

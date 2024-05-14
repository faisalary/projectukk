<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class TahunAkademikRequest extends FormRequest
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

        return [
        'tahun' => 'required|string|max:255',
        'semester' => 'required|string|max:255',
        'startdate_daftar' => 'required|date_format:Y-m-d',
        'enddate_daftar' => 'required|date_format:Y-m-d',
        'startdate_pengumpulan_berkas' => 'required|date_format:Y-m-d',
        'enddate_pengumpulan_berkas' => 'required|date_format:Y-m-d',
        ];
    }

    public function messages(): array
    {
        return [
            'tahun.required' => 'Academic year must be filled',
            'tahun.numeric' => 'Academic year must be number',
            'semester.required' => 'Semester must be filled'
        ];
    }
}
<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class JenisMagangRequest extends FormRequest
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
            'jenis' => ['required','string','max:255'],
            'durasi' => ['required',''],
            'dokumen' => ['required'],
            'review' => ['required'],
            'type' => ['required'],
        ];
    }
    return [
        'jenis' => ['required','string','max:255'],
        'durasi' => ['required',''],
        'dokumen' => ['required'],
        'review' => ['required'],
        'type' => ['required'],
    ];
    }

    public function messages()
    {
       return [
            'jenis.required' => 'The Type of Internship must be filled',
            'durasi.required' =>'The Duration of Intership must be filled',
            'dokumen.required' =>'Document must be filled',
            'review.required' => 'Review must be filled',
            'type.required' => 'Type must be filled'
        ];
    }
}

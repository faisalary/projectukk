<?php

namespace App\Http\Requests;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class FakultasRequest extends FormRequest
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
                
                'namauniv' => ['required', 'string', 'max:255'],
                'namafakultas' => ['required', 'string','max:255'],
                // 'status' => ['required', 'boolean', 'default:true'],
            ];    
        }  
        return [
            'namauniv' => ['required', 'string', 'max:255'],
            'namafakultas' => ['required', 'string','max:255'],
            // 'status' => ['required', 'boolean', 'default:true'],
        ];
    }           
    public function messages(): array
    {
        return [
            
            'namauniv.required' => 'University name must be filled',
            'namafakultas.required' => 'Fakultas name must be filled',
        ];
    }
}
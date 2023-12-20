<?php

namespace App\Http\Requests;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\File;


class MasterEmailRequest extends FormRequest
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
                'subject_email' => ['required', 'string'],
                'headline_email' => ['required', 'string'],
                'content_email' => ['required', 'string','max:255'],
                'attachment' => ['nullable', File::types(['doc', 'docx','xlsx'])->max(2000)],
            ];    
        }  
        return [
            'subject_email' => ['required', 'string'],
            'headline_email' => ['required', 'string'],
            'content_email' => ['required', 'string','max:255'],
            'attachment' => ['required'],
        ];
    }          
    
    
    public function messages(): array
    {
        return [
            'subject_email.required' => 'Subject must be filled',
            'headline_email.required' => 'Headline must be filled',
            'content_email.required' => 'Content must be filled',
            'attachment.required' => 'Attachment must be filled'
        ];
    }
}
<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use PDO;

class ConfigNilaiAkhirReq extends FormRequest
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
        $validate = [
            'id_prodi' => ['required', 'exists:program_studi,id_prodi', 'unique:config_nilai_akhir,id_prodi'],
            'nilai_pemb_lap' => ['required', 'min:1', 'max:100', function ( $attribute, $value, $fail) {
                if (($value + $this->nilai_pemb_akademik) > 100) $fail('Nilai pembimbing lapangan + pembimbing akademik tidak boleh melebihi 100');
            }],
            'nilai_pemb_akademik' => ['required', 'min:1', 'max:100', function ( $attribute, $value, $fail) {
                if (($value + $this->nilai_pemb_lap) > 100) $fail('Nilai pembimbing lapangan + pembimbing akademik tidak boleh melebihi 100');
            }]
        ];

        return $validate;
    }
}

<?php

namespace App\Http\Requests;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Foundation\Http\FormRequest;

class LowonganMagangRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $validate = [
            'data_step' => ['required']
        ];

        if (isset($this->data_step)) {
            $dataStep = Crypt::decryptString($this->data_step);
            switch ($dataStep) {
                case 3:
                    $addValidate = [
                        'proses_seleksi.*.tahap' => ['required'],
                        'proses_seleksi.*.deskripsi' => ['required'],
                        'proses_seleksi.*.tgl_mulai' => ['required'],
                        'proses_seleksi.*.tgl_akhir' => ['required'],
                    ];
                    $validate = array_merge($validate, $addValidate);
                case 2:
                    $addValidate = [
                        'requirements' => ['required'],
                        'gender' => ['required', 'in:Laki-Laki,Perempuan,Laki-Laki & Perempuan'],
                        'jenjang' => ['required', 'array', 'min:1', 'in:D3,D4,S1'],
                        'keterampilan' => ['required', 'array', 'min:1'],
                        'pelaksanaan' => ['required', 'in:Online,Onsite,Hybrid'],
                        'gaji' => ['required', 'in:1,0'],
                        'nominal_salary' => ['required_if:gaji,1'],
                        'benefitmagang' => ['nullable', 'string'],
                        'lokasi' => ['required', 'array', 'min:1'],
                        'startdate' => ['required'],
                        'enddate' => ['required'],
                        'tahapan_seleksi' => ['required', 'in:0,1,2'],
                    ];
                    $validate = array_merge($validate, $addValidate);
                case 1:
                    $addValidate = [
                        'id_jenismagang' => ['required', 'exists:jenis_magang,id_jenismagang'],
                        'intern_position' => ['required'],
                        'kuota' => ['required', 'integer', 'min:1'],
                        'deskripsi' => ['required'],
                        'durasimagang' => ['required', 'array', 'min:1', 'in:1 Semester,2 Semester'],
                    ];
                    $validate = array_merge($validate, $addValidate);
                
                default:
                    break;
            }
        }

        return $validate;
    }
    public function messages(): array
    {
        return [
            // step 1
            'id_jenismagang.required' => 'Pilih Jenis Magang terlebih dahulu.',
            'id_jenismagang.exists' => 'Jenis Magang tidak valid.',
            'intern_position.required' => 'Posisi Magang wajib diisi',
            'kuota.required' => 'Kuota wajib di isi',
            'kuota.integer' => 'Kuota harus berupa angka',
            'kuota.min' => 'Kuota minimal 1',
            'deskripsi.required' => 'Deskripsi wajib di isi',
            'deskripsi.string' => 'Format deskripsi tidak valid',
            // step 2
            'requirements.required' => 'Kualifikasi Magang wajib diisi',
            'gender.required' => 'Jenis Kelamin wajib dipilih',
            'gender.in' => 'Jenis Kelamin tidak valid',
            'jenjang.required' => 'Jenjang wajib dipilih',
            'jenjang.min' => 'Jenjang wajib dipilih',
            'jenjang.in' => 'Jenjang tidak valid',
            'keterampilan.required' => 'Keterampilan wajib diisi',
            'keterampilan.min' => 'Keterampilan wajib diisi',
            'pelaksanaan.required' => 'Pelaksanaan Magang wajib dipilih',
            'pelaksanaan.in' => 'Pelaksanaan Magang tidak valid',
            'gaji.required' => 'Gaji wajib dipilih',
            'gaji.in' => 'Gaji tidak valid',
            'nominal_salary.required_if' => 'Nominal Gaji wajib diisi',
            'benefitmagang.string' => 'Format benefit tidak valid',
            'lokasi.required' => 'Lokasi Magang wajib diisi',
            'lokasi.min' => 'Lokasi Magang wajib diisi',
            'startdate.required' => 'Waktu Mulai Magang wajib diisi',
            'enddate.required' => 'Waktu Akhir Magang wajib diisi',
            'durasimagang.required' => 'Durasi Magang wajib dipilih',
            'durasimagang.min' => 'Durasi Magang wajib dipilih',
            'durasimagang.in' => 'Durasi Magang tidak valid',
            'tahapan_seleksi.required' => 'Tahapan Magang wajib dipilih',
            'tahapan_seleksi.in' => 'Tahapan Magang tidak valid',
            // step 3
            'proses_seleksi.*.deskripsi.required' => 'Deskripsi Seleksi harus diisi.',
            'proses_seleksi.*.tgl_mulai.required' => 'Pilih tanggal mulai pelaksanaan.',
            'proses_seleksi.*.tgl_akhir.required' => 'Pilih tanggal akhir pelaksanaan.',
            
        ];
    }
}

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
                        'jenjang.*' => ['required', 'in:D3,D4,S1'],
                        'keterampilan.*' => ['required', 'string'],
                        'pelaksanaan' => ['required', 'in:Online,Onsite,Hybrid'],
                        'gaji' => ['required', 'in:1,0'],
                        'nominal_salary' => ['required_if:gaji,1'],
                        'benefitmagang' => ['nullable', 'string'],
                        'lokasi.*' => ['required'],
                        'startdate' => ['required'],
                        'enddate' => ['required'],
                        'durasimagang.*' => ['required', 'in:1 Semester,2 Semester'],
                        'tahapan_seleksi' => ['required', 'in:0,1,2'],
                    ];
                    $validate = array_merge($validate, $addValidate);
                case 1:
                    $addValidate = [
                        'id_jenismagang' => ['required', 'exists:jenis_magang,id_jenismagang'],
                        'intern_position' => ['required'],
                        'kuota' => ['required', 'integer', 'min:1'],
                        'deskripsi' => ['required'],
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
            'jenismagang.required' => 'Pilih Jenis Magang terlebih dahulu.',
            'jenismagang.exists' => 'Jenis Magang tidak valid.',
            'posisi.required' => 'Posisi Magang wajib diisi',
            'kuota.required' => 'Kuota wajib di isi',
            'kuota.integer' => 'Kuota harus berupa angka',
            'kuota.min' => 'Kuota minimal 1',
            'deskripsi.required' => 'Deskripsi wajib di isi',
            'deskripsi.string' => 'Format deskripsi tidak valid',
            // step 2
            'kualifikasi.required' => 'Kualifikasi Magang wajib diisi',
            'jenis_kelamin.required' => 'Jenis Kelamin wajib dipilih',
            'jenis_kelamin.in' => 'Jenis Kelamin tidak valid',
            'jenjang.*.required' => 'Jenjang wajib dipilih',
            'jenjang.*.in' => 'Jenjang tidak valid',
            'fakultas.required' => 'Fakultas wajib dipilih',
            'fakultas.exists' => 'Fakultas tidak valid',
            'id_prodi.required' => 'Program Studi wajib dipilih',
            'id_prodi.exists' => 'Program Studi tidak valid',
            'keterampilan.*.required' => 'Keterampilan wajib diisi',
            'keterampilan.*.string' => 'Format keterampilan tidak valid',
            'pelaksanaan.required' => 'Pelaksanaan Magang wajib dipilih',
            'pelaksanaan.in' => 'Pelaksanaan Magang tidak valid',
            'gaji.required' => 'Gaji wajib dipilih',
            'gaji.in' => 'Gaji tidak valid',
            'nominal.required_if' => 'Nominal Gaji wajib diisi',
            'benefit.string' => 'Format benefit tidak valid',
            'lokasi.*.required' => 'Lokasi Magang wajib diisi',
            'tanggal.required' => 'Waktu Mulai Magang wajib diisi',
            'tanggalakhir.required' => 'Waktu Akhir Magang wajib diisi',
            'durasimagang.*.required' => 'Durasi Magang wajib dipilih',
            'durasimagang.*.in' => 'Durasi Magang tidak valid',
            'tahapan.required' => 'Tahapan Magang wajib dipilih',
            'tahapan.in' => 'Tahapan Magang tidak valid',
            // step 3
            'proses_seleksi.*.deskripsiseleksi.required' => 'Deskripsi Seleksi harus diisi.',
            'proses_seleksi.*.mulai.required' => 'Pilih tanggal mulai pelaksanaan.',
            'proses_seleksi.*.akhir.required' => 'Pilih tanggal akhir pelaksanaan.',
            
        ];
    }
}

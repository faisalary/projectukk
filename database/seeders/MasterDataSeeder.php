<?php

namespace Database\Seeders;

use App\Http\Controllers\DokumenSyaratController;
use App\Models\Universitas;
use App\Models\Fakultas;
use App\Models\ProgramStudi;
use App\Models\TahunAkademik;
use App\Models\JenisMagang;
use App\Models\NilaiMutu;
use App\Models\DocumentSyarat;
use App\Models\KomponenNilai;
use App\Models\Dosen;
use App\Models\Mahasiswa;
use App\Models\PegawaiIndustri;
use App\Models\PembimbingLapanganMandiri;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class MasterDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $Universitas = [
            'namauniv' => 'Telkom University',
            'jalan' => 'Jl. Telekomunikasi. 1, Terusan Buah Batu',
            'kota' => 'Bandung',
            'telp' => '022-7564108',
            'status' => 1,
        ];
        $id_univ = Universitas::updateOrCreate(['namauniv' => $Universitas['namauniv']], $Universitas)->id_univ;


        $Fakultas = [
            'namafakultas' => 'Fakultas Ilmu Terapan',
            'id_univ' => $id_univ,
            'status' => 1,
        ];
        $id_fakultas = Fakultas::updateOrCreate(['namafakultas' => $Fakultas['namafakultas']], $Fakultas)->id_fakultas;


        $NamaProgramStudi = [
            'Teknologi Telekomunikasi',
            'Rekayasa Perangkat Lunak Aplikasi',
            'Sistem Informasi',
            'Sistem Informasi Akuntansi',
            'Teknologi Komputer',
            'Manajemen Pemasaran',
            'Perhotelan',
            'Terapan Teknologi Rekayasa Multimedia',
        ];
        foreach($NamaProgramStudi as $value){
            ProgramStudi::updateOrCreate(['namaprodi' => $value] ,[
                'id_fakultas' => $id_fakultas,
                'status' => 1,
                'id_univ' => $id_univ,
            ]);
        }


        $TahunAkademik = ['2020/2021', '2021/2022', '2022/2023','2023/2024','2024/2025'];
        for($i = 0; $i < count($TahunAkademik)*2; $i++){
            $i%2 == 0 ? $semester = 'Genap' : $semester = 'Ganjil';
            TahunAkademik::updateOrCreate(
                [
                    'tahun' => $TahunAkademik[$i/2],
                    'semester' => $semester
                ],[
                    'status' => 1,
                ]
            );
        }


        $JenisMagang = [
            ['namajenis' => 'Magang Fakultas', 'durasimagang' => '1 Semester'], 
            ['namajenis' => 'Magang Fakultas', 'durasimagang' => '2 Semester'], 
            ['namajenis' => 'Magang Mandiri', 'durasimagang' => '1 Semester'], 
            ['namajenis' => 'Magang Startup', 'durasimagang' => '1 Semester'], 
            ['namajenis' => 'Magang Kerja', 'durasimagang' => '1 Semester'],
            ['namajenis' => 'Magang MKBM - Kampus Merdeka', 'durasimagang' => '1 Semester'], 
        ];
        foreach($JenisMagang as $value){
            JenisMagang::updateOrCreate(['namajenis' => $value['namajenis'], 'durasimagang' => $value['durasimagang']], ['status' => 1]);
        }
        

        $NilaiMutu = [
            ['nilaimin' => 0, 'nilaimax' => 39, 'nilaimutu' => 'E'],
            ['nilaimin' => 40, 'nilaimax' => 49, 'nilaimutu' => 'D'],
            ['nilaimin' => 50, 'nilaimax' => 59, 'nilaimutu' => 'C'],
            ['nilaimin' => 60, 'nilaimax' => 64, 'nilaimutu' => 'BC'],
            ['nilaimin' => 65, 'nilaimax' => 69, 'nilaimutu' => 'B'],
            ['nilaimin' => 70, 'nilaimax' => 79, 'nilaimutu' => 'AB'],
            ['nilaimin' => 80, 'nilaimax' => 100, 'nilaimutu' => 'A'],
        ];
        foreach($NilaiMutu as $value){
            NilaiMutu::updateOrCreate([
                'nilaimutu' => $value['nilaimutu']
            ],[
                'nilaimin' => $value['nilaimin'],
                'nilaimax' => $value['nilaimax'],
                'status' => 1]
            );
        }


        $DokumenPersyaratan = [
            'Magang Fakultas' => ['Transkrip NIlai', 'Sertifikasi', 'Eprt', 'TAK', 'CV', 'Portofolio']
        ];

        foreach($DokumenPersyaratan as $magang => $documents){
            $id_jenismagang = JenisMagang::where('namajenis', $magang)->first()->id_jenismagang;
            foreach($documents as $val){
                DocumentSyarat::updateOrCreate([
                    'namadocument' => $val,
                    'id_jenismagang' => $id_jenismagang
                ],[
                    'status' => 1
                ]);
            }
        }

        $KomponenNilai = [
            'Magang Fakultas' => [[
                    'aspek_penilaian' => 'Komunikasi, Adaptasi, Kerjasama',
                    'deskripsi_penilaian' => 'Penilaian dalam magang mencakup kemampuan berkomunikasi dengan jelas, beradaptasi dengan perubahan, dan bekerja sama dalam tim untuk mencapai tujuan bersama.',
                    'scored_by' => '1',
                    'nilai_max' => '30'
                ],[
                    'aspek_penilaian' => 'Disiplin dan Tanggung Jawab dalam pengerjaan tugas',
                    'deskripsi_penilaian' => 'Kemampuan untuk mengikuti aturan dan tenggat waktu dengan konsisten serta menyelesaikan tugas sesuai standar yang ditetapkan.',
                    'scored_by' => '1',
                    'nilai_max' => '30'
                ],[
                    'aspek_penilaian' => 'Kemampuan/Skill Mahasiswa Sesuai (memenuhi) posisi magang',
                    'deskripsi_penilaian' => 'Mahasiswa memiliki kemampuan yang sesuai dengan posisi magang yang ditawarkan, memenuhi persyaratan yang diperlukan untuk berhasil dalam peran tersebut.',
                    'scored_by' => '1',
                    'nilai_max' => '40'
                ],[
                    'aspek_penilaian' => "Buku Laporan Akhir\n - Penulisan dan Tata Bahasa\n - Latar Belakang dan Tujuan\n - Uraian Mengenai Permasalahan dan Solusinya",
                    'deskripsi_penilaian' => 'Evaluasi kemampuan magang dalam menyampaikan ide, bertanya, dan menjelaskan secara jelas dan efektif.',
                    'scored_by' => '2',
                    'nilai_max' => '70'
                ],[
                    'aspek_penilaian' => "Presentasi dan Tanya Jawab\n - Mahasiswa Mempresentasikan Ruang Lingkup Pekerjaan selama Magang\n - Dosen memberi nilai terkait tingkat kesulitan dan ruang lingkup magang untuk dijadikan dasar penilaian",
                    'deskripsi_penilaian' => 'Evaluasi kemampuan magang dalam menyampaikan ide, bertanya, dan menjelaskan secara jelas dan efektif.',
                    'scored_by' => '2',
                    'nilai_max' => '30'
            ]]
        ];
        foreach($KomponenNilai as $magang => $komponen){
            $id_jenismagang = JenisMagang::where('namajenis', $magang)->first()->id_jenismagang;
            foreach($komponen as $value){
                KomponenNilai::updateOrCreate([
                    'id_jenismagang' => $id_jenismagang,
                    'aspek_penilaian' => $value['aspek_penilaian'],
                    'scored_by' => $value['scored_by'],
                ],[
                    'deskripsi_penilaian' => $value['deskripsi_penilaian'],
                    'nilai_max' => $value['nilai_max'],
                    'status' => 1
                ]);
            }
        }
    }
}
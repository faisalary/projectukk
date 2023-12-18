<?php

namespace App\Imports;

use App\Models\Mahasiswa;
use App\Models\Universitas;
use App\Models\Fakultas;
use App\Models\ProgramStudi;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToModel;

class MhsImport implements ToModel
{
    public function model(array $row)
    {
        return new Mahasiswa([
            'id_univ' => Universitas::where('namauniv', $row[0])->pluck('id_univ')->first(),
            'id_prodi' => ProgramStudi::where('namaprodi', $row[1])->pluck('id_prodi')->first(),
            'id_fakultas' => Fakultas::where('namafakultas', $row[2])->pluck('id_fakultas')->first(),
            'nim' => $row[3],
            'angkatan' => $row[4],
            'namamhs' => $row[5],
            'nohpmhs' => $row[6],
            'emailmhs' => $row[7],
            'alamatmhs' => $row[8], 
        ]);
    }
}
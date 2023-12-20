<?php

namespace App\Imports;

use App\Models\Dosen;
use App\Models\Universitas;
use App\Models\Fakultas;
use App\Models\ProgramStudi;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToModel;

class DosenImport implements ToModel
{
    public function model(array $row)
    {
        return new Dosen([
            'id_univ' => Universitas::where('namauniv', $row[0])->pluck('id_univ')->first(),
            'id_prodi' => ProgramStudi::where('namaprodi', $row[1])->pluck('id_prodi')->first(),
            'prodi.fakultas.id_fakultas' => Fakultas::where('namafakultas', $row[2])->pluck('id_fakultas')->first(),
            'nip' => $row[3],
            'kode_dosen' => $row[4],
            'namadosen' => $row[5],
            'nohpdosen' => $row[6],
            'emaildosen' => $row[7],
        ]);
    }
}
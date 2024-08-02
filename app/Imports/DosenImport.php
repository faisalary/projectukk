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
    public function __construct($id_univ, $id_fakultas) {
        $this->id_univ = $id_univ;
        $this->id_fakultas = $id_fakultas;
    }

    public function model(array $row)
    {
        return new Dosen([
            'id_univ' => Universitas::find($this->id_univ)->pluck('id_univ')->first(),
            'id_fakultas' => Fakultas::find($this->id_fakultas)->pluck('id_fakultas')->first(),
            'id_prodi' => ProgramStudi::where('namaprodi', $row[0])->pluck('id_prodi')->first(),
            'nip' => $row[1],
            'kode_dosen' => $row[2],
            'namadosen' => $row[3],
            'nohpdosen' => $row[4],
            'emaildosen' => $row[5],
        ]);
    }
}

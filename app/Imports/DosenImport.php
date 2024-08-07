<?php
namespace App\Imports;

use App\Models\Dosen;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class DosenImport implements ToModel, WithBatchInserts, WithChunkReading, WithHeadingRow, WithValidation, SkipsEmptyRows
{
    protected $id_univ;
    protected $id_fakultas;
    protected $id_prodi;
    protected $existingNip;

    public function __construct($id_univ, $id_fakultas, $id_prodi) {
        $this->id_univ = $id_univ;
        $this->id_fakultas = $id_fakultas;
        $this->id_prodi = $id_prodi;
        $this->existingNip = $this->getAllExistingNip();
    }

    private function getAllExistingNip()
    {
        $existingNip = [];
        Dosen::chunk(100, function ($dosens) use (&$existingNip) {
            foreach ($dosens as $dosen) {
                $existingNip[] = $dosen->nip;
            }
        });
        return $existingNip;
    }

    public function model(array $row)
    {
        // Debugging: Log the row to verify data
        // dd($row, $row['nip']);

        $nip = $row['nip'];

        if (in_array($nip, $this->existingNip)) {
            return null;
        }

        $this->existingNip[] = $nip;

        return new Dosen([
            'id_univ' => $this->id_univ,
            'id_fakultas' => $this->id_fakultas,
            'id_prodi' => $this->id_prodi,
            'nip' => $nip,
            'kode_dosen' => $row['kode_dosen'],
            'namadosen' => $row['nama_dosen'],
            'nohpdosen' => $row['no_telp'],
            'emaildosen' => $row['email'],
        ]);
    }

    public function batchSize(): int
    {
        return 100;
    }

    public function chunkSize(): int
    {
        return 100;
    }

    public function rules(): array
    {
        return [
            '*.nip' => 'required|numeric|digits_between:1,18',
            '*.kode_dosen' => 'required|string|max:5',
            '*.nama_dosen' => 'required|string|max:255',
            '*.no_telp' => 'required|numeric|digits_between:1,15',
            '*.email' => 'required|string|email|max:255',
        ];
    }
}

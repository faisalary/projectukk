<?php

namespace App\Imports;

use App\Models\Dosen;
use App\Models\Fakultas;
use App\Models\ProgramStudi;
use App\Models\Universitas;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\HeadingRowImport;

class DosenImport implements ToCollection, WithHeadingRow
{
    use Importable;
    protected Universitas $id_univ;
    protected Fakultas $id_fakultas;
    protected ProgramStudi $id_prodi;
    protected string $primaryKey = "nip";
    protected string $model = Dosen::class;
    protected array $fields = [
        'nip' => 'nip', 
        'kode_dosen' => 'kode_dosen', 
        'namadosen' => 'nama_dosen', 
        'nohpdosen' => 'no_telp', 
        'emaildosen' => 'email'
    ];
    protected $dataCleaning;
    protected $newData;
    protected $duplicatedData;
    protected $failedData;

    public function __construct($id_univ, $id_fakultas, $id_prodi)
    {
        $this->id_univ = Universitas::findOrFail($id_univ, ['id_univ', 'namauniv']);
        $this->id_fakultas = Fakultas::findOrFail($id_fakultas, ['id_fakultas', 'namafakultas']);
        $this->id_prodi = ProgramStudi::findOrFail($id_prodi, ['id_prodi', 'namaprodi']);
        $this->dataCleaning = new DataCleaning(
            'nip',
            $this->model,
            array_values($this->fields),
            array_keys($this->fields),
            [
                'nip' => 'required|string|max:18',
                'kode_dosen' => 'required|string|max:5',
                'namadosen' => 'required|string|max:255',
                'nohpdosen' => 'required|string|max:15',
                'emaildosen' => 'required|string|email',
            ],
            [
                '*.required' => 'Data Kosong',
                '*.numeric' => 'Data Tidak Sesuai',
                '*.integer' => 'Data Tidak Sesuai',
                '*.between' => 'Data Tidak Sesuai',
                '*.string' => 'Data Tidak Sesuai',
                '*.email' => 'Data Tidak Sesuai',
                'nip.max' => 'NIP maksimal 18 karakter',
                'kode_dosen.max' => 'Kode Dosen maksimal 5 karakter',
                'namadosen.max' => 'Nama Dosen maksimal 255 karakter',
                'nohpdosen.max' => 'No Telp maksimal 15 karakter',
                'emaildosen.max' => 'Email maksimal 255 karakter',
            ]
        );
        $this->newData = collect();
        $this->duplicatedData = collect();
        $this->failedData = collect();
    }

    public function collection(Collection $rows)
    {
        $this->dataCleaning->collection($rows);
        $this->dataCleaning->cleanDuplicateData();
        $this->newData = $this->dataCleaning->getNewData();
        $this->duplicatedData = $this->dataCleaning->getDuplicatedData();
        $this->failedData = $this->dataCleaning->getFailedData();
    }

    public function getNewData()
    {
        return $this->newData;
    }

    public function getDuplicatedData()
    {
        return $this->duplicatedData/*->groupBy('primarykey')*/;
    }

    public function getFailedData()
    {
        return $this->failedData;
    }

    public function checkHeaders($filePath)
    {
        $data = (new HeadingRowImport())->toArray($filePath);
        $headers = array_slice($data[0][0], 0, count($this->fields));
        return $headers === array_values($this->fields);
    }

    public function getResults(): array
    {
        return [
            'newData' => $this->newData,
            'duplicatedData' => $this->duplicatedData,
            'failedData' => $this->failedData,
            'univ' => $this->id_univ,
            'fakultas' => $this->id_fakultas,
            'prodi' => $this->id_prodi,
        ];
    }
}

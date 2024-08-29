<?php

namespace App\Imports;

use App\Models\Dosen;
use App\Models\Fakultas;
use App\Models\Mahasiswa;
use App\Models\ProgramStudi;
use App\Models\Universitas;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\HeadingRowImport;

class MhsImport implements ToCollection, WithHeadingRow
{
    use Importable;
    protected Universitas $id_univ;
    protected ProgramStudi $id_prodi;
    protected Fakultas $id_fakultas;
    protected Dosen $kode_dosen;
    protected string $primaryKey = "nim";
    protected string $model = Mahasiswa::class;
    protected array $fields = [
        'nim' => 'nim',
        'tunggakan_bpp' => 'tunggakan_bpp',
        'ipk' => 'ipk',
        'eprt' => 'eprt',
        'tak' => 'tak',
        'angkatan' => 'angkatan',
        'namamhs' => 'nama_mahasiswa',
        'nohpmhs' => 'no_hp',
        'emailmhs' => 'email',
        'alamatmhs' => 'alamat'
    ];
    protected $dataCleaning;
    protected $newData;
    protected $duplicatedData;
    protected $failedData;

    public function __construct($id_univ, $id_fakultas, $id_prodi, $kode_dosen)
    {
        $this->id_univ = Universitas::findOrFail($id_univ, ['id_univ', 'namauniv']);
        $this->id_fakultas = Fakultas::findOrFail($id_fakultas, ['id_fakultas', 'namafakultas']);
        $this->id_prodi = ProgramStudi::findOrFail($id_prodi, ['id_prodi', 'namaprodi']);
        $this->kode_dosen = Dosen::where('kode_dosen', $kode_dosen)->firstOrFail(['kode_dosen', 'namadosen']);
        $this->dataCleaning = new DataCleaning(
            $this->primaryKey,
            $this->model,
            array_values($this->fields),
            array_keys($this->fields),
            [
                'nim' => 'required',
                'tunggakan_bpp' => ['required', function ($attribute, $value, $fail) {
                    if (!in_array(strtolower($value), ['iya', 'tidak'])) {
                        $fail('Tunggakan BPP harus diisi dengan Iya atau Tidak');
                    }
                }],
                'ipk' => 'required|numeric|between:0,4.00',
                'eprt' => 'required|integer|between:310,677',
                'tak' => 'required|integer',
                'angkatan' => 'required|integer',
                'namamhs' => 'required|string',
                'nohpmhs' => 'required|string',
                'emailmhs' => 'required|string|email',
                'alamatmhs' => 'required|string'
            ],
            [
                '*.required' => 'Data Kosong',
                '*.numeric' => 'Data Tidak Sesuai',
                '*.integer' => 'Data Tidak Sesuai',
                '*.between' => 'Data Tidak Sesuai',
                '*.string' => 'Data Tidak Sesuai',
                '*.email' => 'Data Tidak Sesuai',
                '*.tunggakan_bpp.in' => 'Tunggakan BPP harus diisi dengan Iya atau Tidak',
                '*.ipk.between' => 'IPK harus di antara 0 hingga 4.00', // Pesan khusus untuk IPK
                '*.eprt.between' => 'EPRT harus di antara 310 hingga 677', // Pesan khusus untuk EPRT
            ],
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
            'dosen_wali' => $this->kode_dosen,
        ];
    }
}

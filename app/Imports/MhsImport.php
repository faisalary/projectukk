<?php
namespace App\Imports;

use App\Models\Dosen;
use App\Models\Fakultas;
use App\Models\Mahasiswa;
use App\Models\ProgramStudi;
use App\Models\Universitas;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\HeadingRowImport;
use Maatwebsite\Excel\Validators\Failure;

class MhsImport implements ToCollection, WithBatchInserts, WithChunkReading, WithHeadingRow, WithValidation, SkipsEmptyRows, SkipsOnFailure
{
    protected $id_univ;
    protected $id_prodi;
    protected $id_fakultas;
    protected $kode_dosen;
    protected $existingNim;    
    public $duplicates;
    public $newRecords;
    public $validationErrors;
    public $fields = [
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

    public function __construct($id_univ, $id_fakultas, $id_prodi, $kode_dosen)
    {        
        $this->id_univ = Universitas::findOrFail($id_univ, ['id_univ', 'namauniv']);
        $this->id_fakultas = Fakultas::findOrFail($id_fakultas, ['id_fakultas', 'namafakultas']);
        $this->id_prodi = ProgramStudi::findOrFail($id_prodi, ['id_prodi', 'namaprodi']);
        $this->kode_dosen = Dosen::where('kode_dosen', $kode_dosen)->firstOrFail(['kode_dosen', 'namadosen']);
        $this->existingNim = $this->getAllExistingNim();
        $this->duplicates = [];
        $this->newRecords = [];
        $this->validationErrors = [];
    }

    private function getAllExistingNim()
    {
        $existingNim = [];
        Mahasiswa::chunk(1000, function ($mahasiswas) use (&$existingNim) {
            foreach ($mahasiswas as $mahasiswa) {
                $existingNim[$mahasiswa->nim] = $mahasiswa->toArray();
            }
        });
        return $existingNim;
    }

    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {
            $nim = $row['nim'];
        
            if (array_key_exists($nim, $this->existingNim)) {
                $existingRowData = $this->existingNim[$nim];
                if (!$this->isSameRecord($existingRowData, $row)) {
                    if (!array_key_exists($nim, $this->duplicates)) {
                        $this->duplicates[$nim] = [
                            'existing' => $existingRowData,
                            'new' => []
                        ];
                    }
                    $this->duplicates[$nim]['new'][] = $row->toArray();
                }
            } else {
                $this->newRecords[] = $row->toArray();
                $this->existingNim[$nim] = $row->toArray();
            }
        }
    }

    public function batchSize(): int
    {
        return 1000;
    }

    public function chunkSize(): int
    {
        return 1000;
    }

    public function rules(): array
    {
        return [
            '*.nim' => 'required',
            '*.tunggakan_bpp' => 'required',
            '*.ipk' => 'required|numeric|between:0,4.00',
            '*.eprt' => 'required|integer|between:310,677',
            '*.tak' => 'required|integer',
            '*.angkatan' => 'required|integer',
            '*.nama_mahasiswa' => 'required',
            '*.no_hp' => 'required',
            '*.email' => 'required|string|email',
            '*.alamat' => 'required'
        ];
    }

    public function customValidationMessages()
    {
        return [
            '*.nim.required' => 'Data Kosong',
            '*.tunggakan_bpp.required' => 'Data Kosong',
            '*.ipk.required' => 'Data Kosong',
            '*.ipk.numeric' => 'Data Tidak Sesuai',
            '*.ipk.between' => 'Data Tidak Sesuai',
            '*.eprt.required' => 'Data Kosong',
            '*.eprt.integer' => 'Data Tidak Sesuai',
            '*.eprt.between' => 'Data Tidak Sesuai, harus antara 310 dan 677',
            '*.tak.required' => 'Data Kosong',
            '*.tak.integer' => 'Data Tidak Sesuai',
            '*.angkatan.required' => 'Data Kosong',
            '*.angkatan.integer' => 'Data Tidak Sesuai',
            '*.nama_mahasiswa.required' => 'Data Kosong',
            '*.no_hp.required' => 'Data Kosong',
            '*.email.required' => 'Data Kosong',
            '*.email.string' => 'Data Tidak Sesuai',
            '*.email.email' => 'Data Tidak Sesuai',
            '*.alamat.required' => 'Data Kosong',
        ];
    }

    private function isSameRecord($existingRecord, $newRecord): bool
    {
        foreach ($this->fields as $existingField => $newField) {
            if ($existingRecord[$existingField] != $newRecord[$newField]) {
                return false;
            }
        }
        return true;
    }

    public function onFailure(Failure ...$failures)
    {
        foreach ($failures as $failure) {
            $key = $failure->row();

            if (!array_key_exists($key, $this->validationErrors)) {
                $this->validationErrors[$key] = [
                    'row' => $key,
                    'values' => $failure->values(),
                    'attributes' => []
                ];
            }

            $this->validationErrors[$key]['attributes'][$failure->attribute()] = [
                'attribute' => $failure->attribute(),
                'errors' => $failure->errors()
            ];
        }
    }

    public function checkHeaders($filePath, $expectedHeaders)
    {
        $data = (new HeadingRowImport())->toArray($filePath);
        $headers = $data[0][0];
        return $headers === $expectedHeaders;
    }

    public function getResults() {
        return [
            'duplicates' => $this->duplicates,
            'newRecords' => $this->newRecords,
            'validationErrors' => $this->validationErrors,
            'univ' => $this->id_univ,
            'fakultas' => $this->id_fakultas,
            'prodi' => $this->id_prodi,
            'dosen_wali' => $this->kode_dosen,
        ];
    }
}


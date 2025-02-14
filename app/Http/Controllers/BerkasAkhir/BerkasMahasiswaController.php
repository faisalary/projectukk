<?php

namespace App\Http\Controllers\BerkasAkhir;

use App\Enums\BerkasAkhirMagangStatus;
use App\Helpers\Response;
use App\Models\BerkasMagang;
use Illuminate\Http\Request;
use App\Models\BerkasAkhirMagang;
use App\Models\PendaftaranMagang;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Enums\PendaftaranMagangStatusEnum;

class BerkasMahasiswaController extends BerkasAkhirMagangController
{
    public function viewBerkasMahasiswa() {
        $data['berkas_akhir'] = $this->getMyBerkasMagang()->my_berkas_akhir;
        return view('kegiatan_saya.berkas_akhir.index', $data);
    }

    public function storeBerkasMahasiswa($id, Request $request) {
        $request->validate([
            'file' => 'required|mimes:pdf|max:2048',
        ], [
            'file.required' => 'Berkas tidak boleh kosong',
            'file.mimes' => 'File harus berupa pdf',
            'file.max' => 'File terlalu besar',
        ]);

        try {
            $pendaftaranMagang = $this->getMyMagang(function ($q) {
                return $q->select('mhs_magang.id_mhsmagang')->join('mhs_magang', 'mhs_magang.id_pendaftaran', '=', 'pendaftaran_magang.id_pendaftaran');
            })->pemagang->first();

            $berkasMagang = BerkasMagang::where('id_berkas_magang', $id)->first();
            if (!$berkasMagang) return Response::error(null, 'Berkas Magang not found');
            $berkasAkhirMagang = BerkasAkhirMagang::where('id_mhsmagang', $pendaftaranMagang->id_mhsmagang)
            ->where('id_berkas_magang', $berkasMagang->id_berkas_magang)->first();

            $file = null;
            if ($request->hasFile('file')) {
                if (isset($berkasAkhirMagang) && Storage::exists($berkasAkhirMagang->berkas_file)) {
                    Storage::delete($berkasAkhirMagang->berkas_file);
                }
                $file = $request->file('file');
                $file = Storage::put('berkas_akhir_magang', $file);
            }

            if (!isset($berkasAkhirMagang)) {
                BerkasAkhirMagang::create([
                    'id_mhsmagang' => $pendaftaranMagang->id_mhsmagang,
                    'id_berkas_magang' => $berkasMagang->id_berkas_magang,
                    'berkas_file' => $file,
                    'berkas_magang' => $berkasMagang->nama_berkas,
                    'status_berkas' => 'pending',
                    'tgl_upload' => now(),
                ]);
            } else {
                $berkasAkhirMagang->berkas_file = $file;
                $berkasAkhirMagang->status_berkas = BerkasAkhirMagangStatus::PENDING;
                $berkasAkhirMagang->save();
            }

            $berkasMagang = $this->getMyBerkasMagang()->my_berkas_akhir;
            return Response::success([
                'view_card' => view('kegiatan_saya/berkas_akhir/components/card', ['berkas_akhir' => $berkasMagang])->render()
            ], 'Success');
        } catch (\Exception $e) {
            return Response::errorCatch($e);
        }
    }

    private function getMyBerkasMagang($additional = null) 
    {
        $pendaftaranMagang = $this->getMyMagang(function ($q) {
            return $q->select('lowongan_magang.id_jenismagang', 'mhs_magang.id_mhsmagang')->join('mhs_magang', 'mhs_magang.id_pendaftaran', '=', 'pendaftaran_magang.id_pendaftaran');
        })->pemagang->first();

        if (!$pendaftaranMagang) return abort(403);

        $this->my_berkas_akhir = BerkasMagang::select(
            'berkas_magang.*', 'berkas_akhir_magang.berkas_file', 'berkas_akhir_magang.berkas_magang', 
            'berkas_akhir_magang.status_berkas', 'berkas_akhir_magang.tgl_upload', 'berkas_akhir_magang.rejected_reason',
            'berkas_akhir_magang.id_mhsmagang'
        )
        ->leftJoin('berkas_akhir_magang', function($join) use ($pendaftaranMagang) {
            $join->on('berkas_akhir_magang.id_berkas_magang', '=', 'berkas_magang.id_berkas_magang')
                ->where(function($query) use ($pendaftaranMagang) {
                    $query->where('berkas_akhir_magang.id_mhsmagang', '=', $pendaftaranMagang->id_mhsmagang)
                        ->orWhereNull('berkas_akhir_magang.id_mhsmagang');
                });
        })
        ->where('id_jenismagang', $pendaftaranMagang->id_jenismagang);
        if ($additional != null) $additional($this->my_berkas_akhir);
        $this->my_berkas_akhir = $this->my_berkas_akhir->get();

        return $this;
    }

    private function getMyMagang($additional = null)
    {
        $user = auth()->user();
        $mahasiswa = $user->mahasiswa;

        $this->getPemagang(function ($q) use ($mahasiswa, $additional) {
            $q = $q->where('nim', $mahasiswa->nim);
            if ($additional != null) $q = $additional($q);
            return $q;
        });

        return $this;
        // mengembalikan nilai di $this->pemagang
    }
}

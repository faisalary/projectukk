<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Enums\PendaftaranMagangStatusEnum;

class ApprovalMahasiswaKaprodiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        return view('approval_mahasiswa/index');
    }

    /**
     * Get data for datatable.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function getData(Request $request) {
        // Validate the request
        $request->validate(['section' => 'required|in:approval,sudah-approval']);

        // Get the authenticated user's dosen
        $dosen = auth()->user()->dosen;

        // Mengirim query ke database untuk mendapatkan data
        $data = Mahasiswa::select(
            'mahasiswa.nim', 'mahasiswa.namamhs', 'pendaftaran_magang.tanggaldaftar', 'industri.namaindustri', 
            'lowongan_magang.intern_position', 'mahasiswa.nohpmhs', 'users.email', 'pendaftaran_magang.current_step',
            'pendaftaran_magang.id_pendaftaran', 'mahasiswa.kode_dosen'
        )
        ->join('pendaftaran_magang', 'mahasiswa.nim', '=', 'pendaftaran_magang.nim')
        ->join('lowongan_magang', 'lowongan_magang.id_lowongan', '=', 'pendaftaran_magang.id_lowongan')
        ->join('industri', 'industri.id_industri', '=', 'lowongan_magang.id_industri')
        ->join('users', 'mahasiswa.id_user', '=', 'users.id')
        ->where('mahasiswa.kode_dosen', $dosen->kode_dosen);

        // Filter data berdasarkan parameter tiap bagian/section
        if ($request->section == 'sudah-approval') $data = $data->where('pendaftaran_magang.current_step', PendaftaranMagangStatusEnum::APPROVED_BY_DOSWAL);
        if ($request->section == 'sudah-approval') $data = $data->where('pendaftaran_magang.current_step', PendaftaranMagangStatusEnum::APPROVED_BY_KAPRODI);
        if ($request->section == 'belum-approval') $data = $data->where('pendaftaran_magang.current_step', PendaftaranMagangStatusEnum::REJECTED_BY_KAPRODI);

        // Mengembalikan data dalam format tabel
        return datatables()->of($data->get())
        ->addIndexColumn()
        ->editColumn('namamhs', function ($data) {
            // Format the 'namamhs' column
            $result = '<div class="text-unwrap">';
            $result .= '<span class="fw-bolder text-unwrap">' .$data->namamhs. '</span><br>';
            $result .= '<span>' .$data->nim. '</span><br>';
            $result .= '<small>' .$data->email. '</small>';
            $result .= '</div>';

            return $result;
        })
        ->editColumn('tanggaldaftar', fn ($data) => '<div class="text-center">' . Carbon::parse($data->tanggaldaftar)->format('d M Y') . '</div>')
        ->editColumn('current_step', function ($data) {
            // Format the 'current_step' column
            $result = '<div class="text-center">';
            if ($data->current_step == PendaftaranMagangStatusEnum::APPROVED_BY_DOSWAL) {
                $result .= '<span class="badge bg-label-secondary">Sudah Approval Tahap 1</span>';
            } elseif ($data->current_step == PendaftaranMagangStatusEnum::APPROVED_BY_KAPRODI) {
                $result .= '<span class="badge bg-label-warning">Sudah Approval Tahap 2</span>';
            } elseif ($data->current_step == PendaftaranMagangStatusEnum::REJECTED_BY_KAPRODI) {
                $result.= '<span class="badge bg-label-primary">Belum Approval Tahap 2</span>';
            }
            $result .= '</div>';
            return $result;
        })
        ->addColumn('action', function ($data) {
            // Format the 'action' column
            $result = '<div class="d-flex justify-content-center">';
            $result .= "<a class='mx-1 text-primary cursor-pointer' data-id='$data->id_pendaftaran'><i class='ti ti-file-invoice'></i></a>";
            if ($data->current_step == PendaftaranMagangStatusEnum::APPROVED_BY_DOSWAL) {
                $result .= "<a onclick='approved($(this))' class='mx-1 text-success cursor-pointer' data-id='$data->id_pendaftaran'><i class='ti ti-file-check'></i></a>";
                $result .= "<a onclick='rejected($(this))' class='mx-1 text-danger cursor-pointer' data-id='$data->id_pendaftaran'><i class='ti ti-file-x'></i></a>";
            }
            $result .= '</div>';

            return $result;
        })
        ->rawColumns(['namamhs', 'tanggaldaftar', 'current_step', 'action'])
        ->make(true);
    }
}
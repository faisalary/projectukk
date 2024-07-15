<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Enums\PendaftaranMagangStatusEnum;

class ApprovalMahasiswaController extends Controller
{
    public function index() {
        return view('approval_mahasiswa/index');
    }

    public function getData(Request $request) {
        $request->validate(['section' => 'required|in:approval,sudah-approval']);

        $data = Mahasiswa::select(
            'mahasiswa.nim', 'mahasiswa.namamhs', 'pendaftaran_magang.tanggaldaftar', 'industri.namaindustri', 
            'lowongan_magang.intern_position', 'mahasiswa.nohpmhs', 'users.email', 'pendaftaran_magang.current_step'
        )
        ->join('pendaftaran_magang', 'mahasiswa.nim', '=', 'pendaftaran_magang.nim')
        ->join('lowongan_magang', 'lowongan_magang.id_lowongan', '=', 'pendaftaran_magang.id_lowongan')
        ->join('industri', 'industri.id_industri', '=', 'lowongan_magang.id_industri')
        ->join('users', 'mahasiswa.id_user', '=', 'users.id')
        ->where('pendaftaran_magang.current_step', PendaftaranMagangStatusEnum::PENDING)
        ->get();

        return datatables()->of($data)
        ->addIndexColumn()
        ->editColumn('namamhs', function ($data) {
            $result = '<span class="fw-bolder">' .$data->namamhs. '</span><br>';
            $result .= '<span class="fw-semibold">' .$data->nim. '</span><br>';
            $result .= '<small>' .$data->email. '</small>';

            return $result;
        })
        ->editColumn('tanggaldaftar', fn ($data) => '<div class="text-center">' . Carbon::parse($data->tanggaldaftar)->format('d M Y') . '</div>')
        ->editColumn('current_step', function ($data) {
            $result = '<div class="text-center">';
            $result .= '<span class="badge bg-label-primary">Primary</span>';
            $result .= '</div>';

            return $result;
        })
        ->addColumn('action', function ($data) {
            $result = '<div class="d-flex justify-content-center">';
            $result .= '</div>';

            return $result;
        })
        ->rawColumns(['namamhs', 'tanggaldaftar', 'current_step', 'action'])
        ->make(true);
    }
}

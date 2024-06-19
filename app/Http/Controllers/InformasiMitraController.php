<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use App\Models\Industri;
use App\Models\Permission;
use Illuminate\Http\Request;
use App\Models\LowonganMagang;
use Illuminate\Support\Carbon;
use App\Models\PendaftaranMagang;
use Illuminate\Support\Http\Hash;
use Illuminate\Support\Http\Storage;
use Illuminate\Support\Http\Validator;
use Yajra\DataTables\Facades\DataTables;

class InformasiMitraController extends Controller
{

    public function __construct()
    {
        // $this->middleware('permission:only.lkm,', ['only' => ['index']]);
    }

    public function index()
    {
        $mitra = LowonganMagang::all();
        return view('lowongan_magang.informasi_lowongan.informasi_mitra', compact('mitra'));
    }

    public function show()
    {
        $mitra = Industri::with('total_lowongan')->get();

        return DataTables::of($mitra)
            ->addIndexColumn()
            ->addColumn('status', function ($mitra) {
                if ($mitra->statuskerjasama == "Ya") {
                    return "<span class='badge bg-label-success me-1'>Ya</span>";
                } else if ($mitra->statuskerjasama == "Tidak") {
                    return "<span class='badge bg-label-secondary me-1'>Tidak</span>";
                } else {
                    return "<span class='badge bg-label-info me-1'>Internal Telyu</span>";
                }
            })
            ->addColumn('action', function ($row) {
                return "<a href='" .route('lowongan.informasi.detail', ['id' => $row->id_industri]). "' class='text-success cursor-pointer'><i class='tf-icons ti ti-file-invoice'></a>";
            })
            ->editColumn('total_lowongan', function ($row) {
                return $row->total_lowongan->count();
            })
            ->editColumn('total_pelamar', function ($row) {
                return PendaftaranMagang::leftJoin('lowongan_magang', 'lowongan_magang.id_lowongan', '=', 'pendaftaran_magang.id_lowongan')
                    ->where('id_industri', $row->id_industri)
                    ->count();
            })

            ->rawColumns(['action', 'status'])

            ->make(true);
    }

    public function detail(Request $request, $id)
    {
        if ($request->ajax() && $request->component == "card") {
            $lowongan = LowonganMagang::where('id_industri', $id)->get();
            $industri = Industri::where('id_industri', $id)->first();

            $picture = $industri?->image ? url('assets/images/' . $industri->image) : '\assets\images\no-pictures.png';

            $lowongan->transform(function ($item) {
                $now = Carbon::now();
                if ($now->lessThan($item->enddate) && $now->greaterThan($item->startdate)) {
                    $item->status = true;
                } elseif ($now->greaterThan($item->enddate)) {
                    $item->status = false;
                }

                if ($item->status == 'true') {
                    $item->status = 'Aktif';
                    $item->color = 'success';
                } else {
                    $item->status = 'Non-aktif';
                    $item->color = 'danger';
                }

                $item->kandidat = $item->total_pelamar->count();
                $item->screening = $item->total_pelamar->where('current_step', 'screening')->count();
                $item->penawaran = $item->total_pelamar->where('current_step', 'penawaran')->count();
                $item->diterima = $item->total_pelamar->where('current_step', 'diterima')->count();
                $item->ditolak = $item->total_pelamar->where('current_step', 'ditolak')->count();

                return $item;
            });


            return view('lowongan_magang.informasi_lowongan.lowongan_card', compact('lowongan', 'img'))->render();
        }

        $lowongan = LowonganMagang::where('id_industri', $id)->get();
        $magang = LowonganMagang::where('id_industri', $id)->with('industri')->first();

        $industri = Industri::where('id_industri', $id)->with('total_lowongan')->first();
        $pelamar = PendaftaranMagang::where('id_lowongan', $magang->id_lowongan ?? "")->with('lowongan_magang')->first();
        $lowongan_count = $lowongan->count();
        $pendaftar_count = $pelamar?->count() ?? "0";
        $urlGetCard = url('informasi/lowongan', $id);
        $urlBack = route('lowongan.informasi');

        return view('lowongan_magang.informasi_lowongan.informasi_lowongan', compact(
            'industri', 
            'urlGetCard', 
            'lowongan_count', 
            'pendaftar_count', 
            'magang', 
            'lowongan',
            'urlBack'
        ));
    }
}

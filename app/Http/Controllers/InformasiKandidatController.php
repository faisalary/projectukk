<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Fakultas;
use App\Models\Industri;
use App\Models\Mahasiswa;
use App\Models\Universitas;
use App\Models\ProgramStudi;
use Illuminate\Http\Request;
use App\Models\LowonganMagang;
use App\Models\PendaftaranMagang;
use Yajra\DataTables\Facades\DataTables;

class InformasiKandidatController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, $id)
    {
        $pendaftar = PendaftaranMagang::where('id_lowongan', $id)->with('lowonganMagang')->first();
        $pelamar = PendaftaranMagang::where('id_lowongan', $id)->get();
        $total = [
            'kandidat' => $pelamar->count(),
            'screening' => $pelamar->where('applicant_status', 'screening')->count(),
            'tahap1' => $pelamar->where('applicant_status', 'tahap1')->count(),
            'tahap2' => $pelamar->where('applicant_status', 'tahap2')->count(),
            'tahap3' => $pelamar->where('applicant_status', 'tahap3')->count(),
            'penawaran' => $pelamar->where('applicant_status', 'penawaran')->count(),
            'diterima' => $pelamar->where('applicant_status', 'diterima')->count(),
            'ditolak' => $pelamar->where('applicant_status', 'ditolak')->count()
        ];
        $lowongan = LowonganMagang::where('id_lowongan', $id)->first();

        return view('lowongan_magang.informasi_lowongan.detail', compact('pendaftar', 'lowongan', 'total'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, $id_lowongan)
    {

        $pendaftar = PendaftaranMagang::where('id_lowongan', $id_lowongan);

        if ($request->type == "kandidat") {
            $pendaftar = $pendaftar->with("mahasiswa", "mahasiswa.prodi", "mahasiswa.fakultas", "mahasiswa.univ");
        } else if ($request->type) {
            $pendaftar = $pendaftar->where('applicant_status', $request->type)->with("mahasiswa", "mahasiswa.prodi", "mahasiswa.fakultas", "mahasiswa.univ");
        }

        return DataTables::of($pendaftar->get())
            ->addColumn('check', function ($row) {
                // return '<div class="form-check form-check-inline"><input class="form-check-input student" type="checkbox" value="' . $row['id'] . '" name="student[]" /></div>';

                // $box = '<input type="checkbox" value="' . $row['id_pendaftaran'] . '" class="form-check-inline form-check-input pendaftar">';
                $box = '<div class="form-check form-check-inline"><input class="form-check-input pendaftar" type="checkbox" value="' . $row['id_pendaftaran'] . '" name="pendaftar[]" /></div>';
                return $box;
            })
            ->addIndexColumn()
            ->editColumn('status', function ($pendaftar) {
                if ($pendaftar->applicant_status == "kandidat") {
                    return "<span class='badge bg-label-secondary me-1'>Belum Proses</span>";
                } else if ($pendaftar->applicant_status == "screening") {
                    return "<span class='badge bg-label-warning me-1'>Screening</span>";
                } else if ($pendaftar->applicant_status == "tahap1") {
                    return "<span class='badge bg-label-primary me-1'>Tahap 1</span>";
                } else if ($pendaftar->applicant_status == "tahap2") {
                    return "<span class='badge bg-label-primary me-1'>Tahap 2</span>";
                } else if ($pendaftar->applicant_status == "tahap3") {
                    return "<span class='badge bg-label-primary me-1'>Tahap 3</span>";
                } else if ($pendaftar->applicant_status == "diterima") {
                    return "<span class='badge bg-label-success me-1'>Diterima</span>";
                } else if ($pendaftar->applicant_status == "ditolak") {
                    return "<span class='badge bg-label-danger me-1'>Ditolak</span>";
                } else if ($pendaftar->applicant_status == "penawaran") {
                    return "<span class='badge bg-label-info me-1'>Penawaran</span>";
                }
                return null;
            })
            ->addColumn('action', function ($row) {

                $btn = "<a href='/informasi/kandidat/detail/{$row->id_pendaftaran}' class='btn-icon text-success waves-effect waves-light'><i class='tf-icons ti ti-file-invoice' ></i>";

                return $btn;
            })

            ->rawColumns(['action', 'status', 'check'])

            ->make(true);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Update status.
     */
    public function status(Request $request)
    {
        try {
            $id = $request->input('id');
            // dd($request->status);

            if (is_array($request->input('id')) || is_object($request->input('id'))) {
                foreach ($id as $key => $value) {
                    // Ambil data berdasarkan ID

                    $selected = PendaftaranMagang::where('id_pendaftaran', $value)->first();

                    $selected->applicant_status = $request->input('status');
                    $selected->save();
                }
            }

            return response()->json([
                'error' => false,
                'message' => 'Status kandidat berhasil diubah!',
                'modal' => '.targetDiv',
                'table' => '.tab1c',
            ]);
        } catch (Exception $e) {
            return response()->json([
                'error' => true,
                'message' => $e->getMessage(),
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function detail(Request $request, $id)
    {
        $pendaftar = PendaftaranMagang::where('id_pendaftaran', $id)->with('lowonganMagang', 'mahasiswa', 'mahasiswa.prodi', 'mahasiswa.fakultas', 'mahasiswa.univ')->first();

        $lowongan = LowonganMagang::where('id_lowongan', $pendaftar->id_lowongan)->first();

        return view('lowongan_magang.informasi_lowongan.detail_mahasiswa', compact('pendaftar', 'lowongan'));
    }
}

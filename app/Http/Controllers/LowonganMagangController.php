<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\LowonganMagang;
use Illuminate\Http\Request;
use App\Http\Requests\LowonganMagangRequest;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use App\Models\Fakultas;
use App\Models\ProgramStudi;
use App\Models\TahunAkademik;
use App\Models\JenisMagang;
use App\Models\Industri;
use App\Models\Lokasi;
use App\Models\PendaftaranMagang;
use Illuminate\Routing\Route;

class LowonganMagangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $lowonganmagang = LowonganMagang::all();
        $prodi = ProgramStudi::all();
        $fakultas = Fakultas::all();
        $tahun = TahunAkademik::all();
        $jenismagang = JenisMagang::all();
        $industri = Industri::all();
        $lokasi = Lokasi::all();
        $pendaftar = PendaftaranMagang::all();
        return view('lowongan_magang.kelola_lowongan_magang_admin.halaman_lowongan_magang', compact('lowonganmagang','prodi','fakultas','tahun','jenismagang','industri','lokasi','pendaftar'));
    }

     /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $prodi = ProgramStudi::all();
        $fakultas = Fakultas::all();
        $tahun = TahunAkademik::all();
        $jenismagang = JenisMagang::all();
        $industri = Industri::all();
        $lokasi = Lokasi::all();
        $pendaftar = PendaftaranMagang::all();
        return view('lowongan_magang.kelola_lowongan_magang_admin.tambah_lowongan_magang', compact('prodi','fakultas','tahun','jenismagang','industri','lokasi','pendaftar'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(LowonganMagangRequest $request)
    {
        try {
        $lowonganmagang = LowonganMagang::create([
            'id_jenismagang' => $request->jenismagang,
            'intern_position' => $request->posisi,
            'kuota' => $request->kuota,
            'deskripsi' => $request->deskripsi,
            'requirements' => $request->kualifikasi,
            'jenjang' => $request->Jenjang,
            'bidang' => $request->bidang,
            'keterampilan' => $request->keterampilan,
            'paid' => $request->gaji,
            'benefitmagang' => $request->benefit,
            'id_lokasi' => $request->lokasi,
            'startdate' => $request->tanggalmulai,
            'enddate' => $request->tanggalakhir,
            'durasimagang' => $request->durasimagang,
            'tahapan_seleksi' => $request->tahapan,
            // 'created_by' => $request->created_by,
            // 'created_at' => $request->created_at,
            // 'date_confirm_closing' => $request->tanggalkonfirmasi,
            // 'pelaksaan' => $request->pelaksanaan,
            // 'applicant_status' => $request->pendaftar,
            // 'id_prodi' => $request->prodi,
            // 'id_fakultas' => $request->fakultas,

        ]);

        return response()->json([
            'error' => false,
            'massage' => 'Data Created!',
            'modal' => '#modalTambahLowongan',
            // 'table' => '#table_kelola_lowtedongan'
        ]);
        } catch (Exception $e) {
            return response()->json([
                'error' => true,
                'message' => $e->getMessage(),
            ]);
        }
    }

        /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
        // $lowonganmagang = LowonganMagang::query();
        // if($request->type){
        //     if ($request->fakultas != null) {
        //         $lowonganmagang->where("id_fakultas", $request->fakultas, $request->type);
        //     } else if ($request->prodi !=null) {
        //         $lowonganmagang->where("id_prodi", $request->prodi, $request->type);
        //     } else if ($request->tahun != null) {
        //         $lowonganmagang->where("id_year_Akademik", $request->tahun, $request->type);
        //     } else if ($request->jenismagang != null) {
        //         $lowonganmagang->where("id_jenismagang", $request->jenismagang, $request->type);
        //     } else if ($request->industri != null) {
        //         $lowonganmagang->where("id_industri", $request->industri, $request->type);
        //     } else if ($request->lokasi != null) {
        //         $lowonganmagang->where("id_lokasi", $request->lokasi, $request->type);
        //     }
        //     $lowonganmagang = $lowonganmagang->with("fakultas", "prodi",  "tahun", "jenismagang", "industri", "lokasi")->orderBy('id_fakultas', 'desc');
        // }

        return DataTables::of($lowonganmagang->get())
            ->addIndexColumn()
            ->editColumn('status', function ($row) {
                if ($row->status == 1) {
                    return "<div class='text-center'><div class='badge rounded-pill bg-label-success'>" . "Active" . "</div></div>";
                } else {
                    return "<div class='text-center'><div class='badge rounded-pill bg-label-danger'>" . "Inactive" . "</div></div>";
                }
            })
            ->addColumn('action', function ($row) {
                $icon = ($row->status) ? "ti-circle-x" : "ti-circle-check";
                $color = ($row->status) ? "danger" : "success";

                $btn = "<a data-bs-toggle='modal' data-id='{$row->id}' data-url='kelola/lowongan/admin/edit' onclick=edit($(this)) class='btn-icon text-warning waves-effect waves-light'><i class='tf-icons ti ti-edit' ></i>
                <a data-status='{$row->status}' data-id='{$row->id}' data-url='lowongan-magang/status' class='btn-icon update-status text-{$color} waves-effect waves-light'><i class='tf-icons ti {$icon}'></i></a>";

                return $btn;
            })
            ->rawColumns(['action', 'status'])

            ->make(true);
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        return view('lowongan_magang.kelola_lowongan_magang_admin.edit_lowongan_magang');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try {
            $lowonganmagang = LowonganMagang::where();

            $lowonganmagang->id_jenismagang = $request->jenismagang;
            $lowonganmagang->intern_position = $request->posisi;
            $lowonganmagang->kuota = $request->kuota;
            $lowonganmagang->deskripsi = $request->deskripsi;
            $lowonganmagang->requirements = $request->kualifikasi;
            $lowonganmagang->jenjang = $request->jenjang;
            $lowonganmagang->bidang = $request->bidang;
            $lowonganmagang->keterampilan = $request->keterampilan;
            $lowonganmagang->paid = $request->gaji;
            $lowonganmagang->benefitmagang = $request->benefit;
            $lowonganmagang->id_lokasi = $request->lokasi;
            $lowonganmagang->startdate = $request->tanggalmulai;
            $lowonganmagang->enddate = $request->tanggalakhir;
            $lowonganmagang->durasimagang = $request->durasimagang;
            $lowonganmagang->tahapan_seleksi = $request->tahapan;
            // $lowonganmagang->created_by = $request->created_by;
            // $lowonganmagang->created_at = $request->created_at;
            // $lowonganmagang->date_confirm_closing = $request->tanggalkonfirmasi;
            // $lowonganmagang->id_prodi = $request->prodi;
            // $lowonganmagang->id_fakultas = $request->fakultas;
            // $lowonganmagang->pelaksaan = $request->pelaksanaan;
            // $lowonganmagang->applicant_status = $request->pendaftar;
            $lowonganmagang->save();

            return response()->json([
                'error' => false,
                'message' => 'lowongan magang successfully Updated!',
                'modal' => '#modalTambahLowongan',
                // 'table' => '#table_kelola_lowongan'
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
    public function status($id)
    {
        try {
            $lowonganmagang = LowonganMagang::where($id)->first();
            $lowonganmagang->status = ($lowonganmagang->status) ? false : true;
            $lowonganmagang->save();

            return response()->json([
                'error' => false,
                'message' => 'Status Lowongan Magang successfully Updated!',
                'modal' => '#modalTambahLowongan',
                // 'table' => '#table_kelola_lowongan'
            ]);
        } catch (Exception $e) {
            return response()->json([
                'error' => true,
                'message' => $e->getMessage(),
            ]);
        }
    }

}

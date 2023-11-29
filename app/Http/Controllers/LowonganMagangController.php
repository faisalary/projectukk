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
        return view('masters.lowongan-magang.index', compact('lowonganmagang','prodi','fakultas','tahun','jenismagang'));
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
    public function store(LowonganMagangRequest $request)
    {
        try {

        $lowonganmagang = LowonganMagang::create([
            'id_industri' => $request->mitra,
            'id_year_Akademik' => $request->tahunajaran,
            'created_by' => $request->now(),
            'id_jenismagang' => $request->jenismagang,
            'created_at' => $request->now(),
            'intern_position' => $request->posisi,
            'bidang' => $request->bidang,
            'durasimagang' => $request->durasi,
            'deskripsi' => $request->deskripsi,
            'requirements' => $request->kualifikasi,
            'id_lokasi' => $request->lokasi,
            'kuota' => $request->kuotapenerimaan,
            'benefitmagang' => $request->benefits,
            'startdate' => $request->tanggalmulai,
            'enddate' => $request->tanggalakhir,
            'tahapan_seleksi' => $request->tahapan,
            'date_confirm_closing' => $request->informasilowongan,
            'id_prodi' => $request->programstudi,
            'id_fakultas' => $request->fakultas,
            'status' => true,
        ]);

        return response()->json([
            'error' => false,
            'massage' => 'Data Created!',
            'modal' => '#modal-lowonganmagang',
            'table' => '#table-master-mahasiswa'
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
        $lowonganmagang = LowonganMagang::query();
        if ($request->fakultas != null) {
            $lowonganmagang->where("id_fakultas", $request->fakultas);
        } else if ($request->univ !=null) {
            $lowonganmagang->where("id_univ", $request->univ);
        }
        $lowonganmagang = $lowonganmagang->with("univ", "prodi","fakultas")->orderBy('nim', "asc")->get();

        return DataTables::of($lowonganmagang)
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

            $lowonganmagang->id_industri = $request->mitra;
            $lowonganmagang->id_year_Akademik = $request->tahunajaran;
            $lowonganmagang->created_by = $request->now();
            $lowonganmagang->id_jenismagang = $request->jenismagang;
            $lowonganmagang->created_at = $request->now();
            $lowonganmagang->intern_position = $request->posisi;
            $lowonganmagang->bidang = $request->bidang;
            $lowonganmagang->durasimagang = $request->durasi;
            $lowonganmagang->deskripsi = $request->deskripsi;
            $lowonganmagang->requirements = $request->kualifikasi;
            $lowonganmagang->id_lokasi = $request->lokasi;
            $lowonganmagang->kuota = $request->kuotapenerimaan;
            $lowonganmagang->benefitmagang = $request->benefit;
            $lowonganmagang->startdate = $request->tanggalmulai;
            $lowonganmagang->enddate = $request->tanggalakhir;
            $lowonganmagang->tahapan_seleksi = $request->tahapan;
            $lowonganmagang->date_confirm_closing = $request->informasilowongan;
            $lowonganmagang->id_prodi = $request->programstudi;
            $lowonganmagang->id_fakultas = $request->fakultas;
            $lowonganmagang->save();

            return response()->json([
                'error' => false,
                'message' => 'lowongan magang successfully Updated!',
                'modal' => '#modal-lowonganmagang',
                'table' => '#table-master-mahasiswa'
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

    }

}

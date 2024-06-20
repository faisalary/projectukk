<?php

namespace App\Http\Controllers;

use Exception;
use Carbon\Carbon;
use App\Models\Universitas;
use Illuminate\Http\Request;
use App\Models\TahunAkademik;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Requests\TahunAkademikRequest;

class TahunAkademikController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tahun = TahunAkademik::all();

        return view('masters.tahun_akademik.index', compact('tahun'));
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
    public function store(TahunAkademikRequest $request)
    {

        try {
            
            $tahun = TahunAkademik::create([
                'tahun' => $request->tahun,
                'semester' => $request->semester,
                'startdate_daftar' => $request->startdate_daftar,
                'enddate_daftar' => $request->enddate_daftar,
                'startdate_pengumpulan_berkas' => $request->startdate_pengumpulan_berkas,
                'enddate_pengumpulan_berkas' => $request->enddate_pengumpulan_berkas,
                'status' => true,
            ]);

            return response()->json([
                'error' => false,
                'message' => 'Tahun Akademik successfully Created!',
                'modal' => '#modal-thn-akademik',
                'table' => '#table-master-tahun-akademik'
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
    public function show()
    {
        $tahun = TahunAkademik::orderBy('tahun', 'asc')->get();

        return DataTables::of($tahun)
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

                $url = route('tahun-akademik.status', $row->id_year_akademik);
                $btn = "<a data-bs-toggle='modal' data-id='{$row->id_year_akademik}' onclick=edit($(this)) class='btn-icon text-warning waves-effect waves-light'><i class='tf-icons ti ti-edit' ></i>
                <a data-url='{$url}' class='btn-icon update-status text-{$color} waves-effect waves-light'><i class='tf-icons ti {$icon}'></i></a>";

                return $btn;
            })
            ->rawColumns(['action', 'status'])

            ->make(true);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $tahun = TahunAkademik::where('id_year_akademik', $id)->first();
        return $tahun;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TahunAkademikRequest $request, string $id)
    {
        try {
            // $validated = $request->validated();

            $tahun = TahunAkademik::where('id_year_akademik', $id)->first();

            $tahun->tahun = $request->tahun;
            $tahun->semester = $request->semester;
            $tahun->startdate_daftar = Carbon::parse($request->startdate_daftar)->format('Y-m-d');
            $tahun->enddate_daftar = Carbon::parse($request->enddate_daftar)->format('Y-m-d');
            $tahun->startdate_pengumpulan_berkas = Carbon::parse($request->startdate_pengumpulan_berkas)->format('Y-m-d');
            $tahun->enddate_pengumpulan_berkas = Carbon::parse($request->enddate_pengumpulan_berkas)->format('Y-m-d');
            $tahun->save();

            return response()->json([
                'error' => false,
                'message' => 'Tahun Akademik successfully Updated!',
                'modal' => '#modal-thn-akademik',
                'table' => '#table-master-tahun-akademik'
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
    public function status(string $id)
    {
        try {
            $tahun = TahunAkademik::where('id_year_akademik', $id)->first();
            $tahun->status = ($tahun->status) ? false : true;
            $tahun->save();

            return response()->json([
                'error' => false,
                'message' => 'Status Tahun Akademik successfully Updated!',
                'modal' => '#modal-thn-akademik',
                'table' => '#table-master-tahun-akademik'
            ]);
        } catch (Exception $e) {
            return response()->json([
                'error' => true,
                'message' => $e->getMessage(),
            ]);
        }
    }
}
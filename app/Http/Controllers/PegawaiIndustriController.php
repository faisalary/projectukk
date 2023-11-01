<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Exception;
use App\Models\PegawaiIndustri;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use App\Models\Industri;

class PegawaiIndustriController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

    $industri = Industri::all();
    $pegawai_industri = PegawaiIndustri::all();
    return view('masters.pegawai_industri.index', compact('pegawai_industri', 'industri'));
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
    public function store(PegawaiIndustriRequest $request)
    {
        try{
            $request->validate(
            [
                'namaperusahaan' => ['required'],
                'namapeg' => ['required', 'string', 'max:255', 'unique:pegawai_industri'],
                'nohppeg' => ['required', 'string', 'max:255'],
                'emailpeg' => ['required', 'string', 'max:255'],
                'jabatan' => ['required', 'string', 'max:255'],
                'unit' => ['required', 'string', 'max:255'],
                // 'status' => ['required', 'boolean', 'default:true'],
            ],
            [
                'namapeg.unique' => 'A Pegawai Industri with the name already exist'
            ]
        );

        $pegawai_industri = PegawaiIndustri::create([
            'id_industri' => $request->namaperusahaan,
            'namapeg' => $request->namapeg,
            'nohppeg' => $request->nohppeg,
            'emailpeg' => $request->emailpeg,
            'jabatan' => $request->jabatan,
            'unit' => $request->unit,
            'statuspeg' => true,
        ]);

        return response()->json([
            'error' => false,
            'message' => 'Pegawai Industri successfully Created!',
            'modal' => '#modalTambahPegawai',
            'table' => '#table-master-pegawai'
        ]);
    } catch (Exception $e) {
        return response()->json([
            'error' => true,
            'message' => $e->getMessage(),
        ]);
    }
}

    /**
     * Display the spesified resource.
     */
    public function show()
    {
        $pegawai_industri = PegawaiIndustri::with("industri")->orderBy('id_peg_industri', 'asc')->get();
        return DataTables::of($pegawai_industri)
            ->addIndexColumn()
            ->editColumn('status', function ($row) {
                if ($row->statuspeg == 1) {
                    return "<div class='text-center'><div class='badge rounded-pill bg-label-success'>" . "Active" . "</div></div>";
                } else {
                    return "<div class='text-center'><div class='badge rounded-pill bg-label-danger'>" . "Inactive" . "</div></div>";
                }
            })
            ->addColumn('action', function ($row) {
                $icon = ($row->statuspeg) ? "ti-circle-x" : "ti-circle-check";
                $color = ($row->statuspeg) ? "danger" : "success";

                $btn = "<a data-bs-toggle='modal' data-id='{$row->id_peg_industri}' onclick= edit($(this)) class='btn-icon text-warning waves-effect waves-light'><i class='tf-icons ti ti-edit' ></i>
                <a onclick = status($(this)) data-status='{$row->statuspeg}' data-id='{$row->id_peg_industri}'  class='btn-icon text-{$color} waves-effect waves-light'><i class='tf-icons ti {$icon}'></i></a>";

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
        $pegawai_industri = PegawaiIndustri::where('id_peg_industri', $id)->first();
        return $pegawai_industri;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try{
            $pegawai_industri = PegawaiIndustri::where('id_peg_industri', $id)->first();

            $pegawai_industri->id_industri = $request->namaperusahaan;
            $pegawai_industri->namapeg = $request->namapeg;
            $pegawai_industri->nohppeg = $request->nohppeg;
            $pegawai_industri->emailpeg = $request->emailpeg;
            $pegawai_industri->jabatan = $request->jabatan;
            $pegawai_industri->unit = $request->unit;
            $pegawai_industri->save();

            return response()->json([
                'error' => false,
                'message' => 'Pegawai Industri successfully Updated!',
                'modal' => '#modalTambahPegawai',
                'table' => '#table-master-pegawai'
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
    public function destory(string $id)
    {
        try{
            $pegawai_industri = PegawaiIndustri::where('id_peg_industri', $id)->first();
            $pegawai_industri->statuspeg = ($pegawai_industri->statuspeg) ? false : true;
            $pegawai_industri->save();

            return response()->json([
                'error' => false,
                'message' => 'Pegawai Industri successfully Deactived!',
                'modal' => '#modalTambahPegawai',
                'table' => '#table-master-pegawai'
            ]);
        } catch (Exception $e) {
            return response()->json([
                'error' => true,
                'message' => $e->getMessage(),
            ]);
        }
    }
}





<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\User;
use App\Models\Fakultas;
use App\Helpers\Response;
use App\Models\Mahasiswa;
use App\Imports\MhsImport;
use App\Models\Universitas;
use Illuminate\Support\Str;
use App\Models\ProgramStudi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Requests\MahasiswaRequest;
use Yajra\DataTables\Facades\DataTables;

class mahasiswaController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:mahasiswa.view');
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->type) {
            switch ($request->type) {
                case 'id_fakultas':
                    $data = Fakultas::select('namafakultas as text', 'id_fakultas as id')->where('id_univ', $request->selected)->get();
                    break;
                case 'id_prodi':
                    $data = ProgramStudi::select('namaprodi as text', 'id_prodi as id')->where('id_fakultas', $request->selected)->get();
                    break;
                default:
                    # code...
                    break;
            }
            return Response::success($data, 'Success');
        }

        $universitas = Universitas::all();
        return view('masters.mahasiswa.index', compact('universitas'));
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
    public function store(MahasiswaRequest $request)
    {
        try {
            DB::beginTransaction();
            $mahasiswa = Mahasiswa::create($request->validated());

            $code = Str::random(60);

            $passwordResetToken = DB::table('password_reset_tokens')->where('email', $mahasiswa->emailmhs)->first();
            if ($passwordResetToken) {
                DB::table('password_reset_tokens')->where('email', $mahasiswa->emailmhs)->delete();
            }

            DB::table('password_reset_tokens')->insert([
                'email' => $mahasiswa->emailmhs,
                'token' => $code,
                'created_at' => now(),
            ]);

            DB::commit();
            return Response::success(null, 'Data Created!');
        } catch (Exception $e) {
            DB::rollBack();
            return Response::errorCatch($e);
        }
    }


    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
        $mahasiswa = Mahasiswa::leftJoin('universitas', 'universitas.id_univ', '=', 'mahasiswa.id_univ')
        ->leftJoin('program_studi', 'program_studi.id_prodi', '=', 'mahasiswa.id_prodi')
        ->leftJoin('fakultas', 'fakultas.id_fakultas', '=', 'mahasiswa.id_fakultas');
        if ($request->fakultas != null) {
            $mahasiswa->where("mahasiswa.id_fakultas", $request->fakultas);
        } else if ($request->univ !=null) {
            $mahasiswa->where("mahasiswa.id_univ", $request->univ);
        }
        $mahasiswa = $mahasiswa->with("univ", "prodi","fakultas")->orderBy('nim', "asc")->get();

        return DataTables::of($mahasiswa)
            ->addIndexColumn()
            ->addColumn('name', function ($data) {
                $result = "<span class='text-nowrap fw-bolder mb-2'>$data->namamhs</span><br>";
                $result .= "<small class='text-muted'>$data->nim</small>";
                return $result;
            })
            ->addColumn('univ_fakultas', function ($data) {
                $result = "<span class='text-nowrap fw-bolder mb-2'>$data->namauniv</span><br>";
                $result .= "<span class='text-nowrap mb-2'>$data->namafakultas</span><br>";
                $result .= "<small class='text-nowrap text-muted'>$data->namaprodi</small>";

                return $result;
            })
            ->editColumn('tunggakan_bpp', fn ($data) => "<div class='text-center'>$data->tunggakan_bpp</div>")
            ->editColumn('ipk', fn ($data) => "<div class='text-center'>$data->ipk</div>")
            ->editColumn('eprt', fn ($data) => "<div class='text-center'>$data->eprt</div>")
            ->editColumn('tak', fn ($data) => "<div class='text-center'>$data->tak</div>")
            ->editColumn('angkatan', fn ($data) => "<div class='text-center'>$data->angkatan</div>")
            ->addColumn('contact', function ($data) {
                $result = "<span class='fw-bolder mb-2'>$data->nohpmhs</span><br>";
                $result .= "<small>$data->emailmhs</small>";
                return $result;
            })
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

                $url = route('mahasiswa.status', $row->nim);
                $btn = "<a data-bs-toggle='modal' data-id='{$row->nim}' onclick=edit($(this)) class='btn-icon text-warning waves-effect waves-light'><i class='tf-icons ti ti-edit' ></i>
                <a data-url='{$url}' class='btn-icon update-status text-{$color} waves-effect waves-light'><i class='tf-icons ti {$icon}'></i></a>";

                return $btn;
            })
            ->rawColumns([
                'action', 'status', 'name', 'univ_fakultas', 'tunggakan_bpp', 
                'ipk', 'eprt', 'tak', 'angkatan', 'contact'
            ])
            ->make(true);
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $mahasiswa = Mahasiswa::where('nim', $id)->first();
        return $mahasiswa;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try {
            $mahasiswa = Mahasiswa::where('nim', $id)->first();
            $mahasiswa->update($request->all());
            
            return Response::success(null, 'Komponen Nilai successfully Add!');
        } catch (Exception $e) {
            return Response::errorCatch($e);
        }
    }
    

    /**
     * Remove the specified resource from storage.
     */
    public function status($id)
    {
        try {
            $mahasiswa = Mahasiswa::where('nim', $id)->first();
            $mahasiswa->status = ($mahasiswa->status) ? false : true;
            $mahasiswa->save();

            return Response::success(null, 'Status Mahasiswa successfully Updated!');
        } catch (Exception $e) {
            return Response::errorCatch($e);
        }
    }

    public function import (Request $request){
        $data = $request->file('import');
        $namafile = $data-> getClientOriginalName();
        $data->move('MhsData', $namafile);
        Excel::import(new MhsImport, \public_path('/MhsData/'.$namafile));
        return \redirect()->back();
    }
}
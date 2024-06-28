<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Fakultas;
use App\Helpers\Response;
use App\Models\Universitas;
use App\Models\ProgramStudi;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use App\Http\Requests\ProdiRequest;
use Yajra\DataTables\Facades\DataTables;

class ProdiController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:program_studi.view');
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->selected) {
            $fakultas = Fakultas::where('id_univ', $request->selected)->get();
            return Response::success($fakultas, 'Success');
        }

        $universitas = Universitas::all();
        return view('masters.prodi.index', compact('universitas'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProdiRequest $request)
    {
        try {
            $prodi = ProgramStudi::create([
                'id_fakultas' => $request->id_fakultas,
                'id_univ' => $request->id_univ,
                'namaprodi' => $request->namaprodi,
            ]);
    
            return Response::success(null, 'Data Created!');
        } catch (\Exception $e) {
            return Response::errorCatch($e);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {

        $prodi = ProgramStudi::query();
        if ($request->fakultas != null) {
            $prodi->where("id_fakultas", $request->fakultas);
        } else if ($request->univ != null) {
            $prodi->where("id_univ", $request->univ);
        } else if ($request->prodi != null) {
            $prodi->where("id_prodi", $request->prodi);
        }

        $prodi = $prodi->with("univ", "fakultas")->orderBy('id_prodi', "asc")->get();

        return DataTables::of($prodi)
            ->addIndexColumn()
            ->editColumn('status', function ($prodi) {
                if ($prodi->status == 1) {
                    return "<div class='text-center'><div class='badge rounded-pill bg-label-success'>Active</div></div>";
                } else {
                    return "<div class='text-center'><div class='badge rounded-pill bg-label-danger'>Inactive</div></div>";
                }
            })
            ->addColumn('action', function ($prodi) {
                $icon = ($prodi->status) ? "ti-circle-x" : "ti-circle-check";
                $color = ($prodi->status) ? "danger" : "success";

                $url = route('prodi.status', $prodi->id_prodi);
                $btn = "<a data-bs-toggle='modal' data-id='{$prodi->id_prodi}' onclick=edit($(this)) class='cursor-pointer text-warning'><i class='tf-icons ti ti-edit' ></i>
                <a data-url='{$url}' data-function='afterUpdateStatus' class='update-status cursor-pointer text-{$color}'><i class='tf-icons ti {$icon}'></i></a>";

                return $btn;
            })
            ->rawColumns(['status', 'action'])

            // ->json();
            ->make(true);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $prodi = ProgramStudi::where('id_prodi', $id)->first();
        return $prodi;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProdiRequest $request, $id)
    {
        try {
            $prodi = ProgramStudi::where('id_prodi', $id)->first();

            $prodi->id_univ = $request->id_univ;
            $prodi->id_fakultas = $request->id_fakultas;
            $prodi->namaprodi = $request->namaprodi;
            $prodi->save();

            return Response::success(null, 'Data successfully Updated!');
        } catch (Exception $e) {
            return Response::errorCatch($e);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function status(string $id)
    {
        try {
            $prodi = ProgramStudi::where('id_prodi', $id)->first();
            if (!$prodi) return Response::error(null, 'Data not found!');

            $prodi->status = !$prodi->status;
            $prodi->save();

            return Response::success(null, 'Status successfully changed!');
        } catch (Exception $e) {
            return Response::errorCatch($e);
        }
    }
}
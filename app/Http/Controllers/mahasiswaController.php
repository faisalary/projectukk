<?php

namespace App\Http\Controllers;

use App\Exports\DataFailedExport;
use Exception;
use App\Models\User;
use App\Models\Dosen;
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
        $this->middleware('permission:igracias.view');
    }

    /**
     * Display a listing of the resource.
     */
    // public function index(Request $request)
    // {
    //     if ($request->type) {
    //         switch ($request->type) {
    //             case 'id_fakultas':
    //                 $data = Fakultas::select('namafakultas as text', 'id_fakultas as id')->where('id_univ', $request->selected)->get();
    //                 break;
    //             case 'id_prodi':
    //                 $data = ProgramStudi::select('namaprodi as text', 'id_prodi as id')->where('id_fakultas', $request->selected)->get();
    //                 break;
    //             case 'kode_dosen':
    //                 $data = Dosen::where('id_prodi', $request->selected)->get()->transform(function ($item) {
    //                     $result = new \stdClass();
    //                     $result->text = $item->kode_dosen . ' | ' . $item->namadosen;
    //                     $result->id = $item->kode_dosen;
    //                     return $result;
    //                 });
    //                 break;
    //             default:
    //                 # code...
    //                 break;
    //         }
    //         return Response::success($data, 'Success');
    //     }

    //     $universitas = Universitas::all();
    //     return view('masters.mahasiswa.index', compact('universitas'));
    // }

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
            Mahasiswa::create($request->validated());
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
        $mahasiswa = Mahasiswa::select(
            'mahasiswa.*', 'universitas.namauniv', 'fakultas.namafakultas', 'program_studi.namaprodi'
        )
        ->leftJoin('universitas', 'universitas.id_univ', '=', 'mahasiswa.id_univ')
        ->leftJoin('program_studi', 'program_studi.id_prodi', '=', 'mahasiswa.id_prodi')
        ->leftJoin('fakultas', 'fakultas.id_fakultas', '=', 'mahasiswa.id_fakultas');
        if ($request->id_prodi != null) {
            $mahasiswa->where("mahasiswa.id_prodi", $request->id_prodi);
        } else if ($request->id_fakultas != null) {
            $mahasiswa->where("mahasiswa.id_fakultas", $request->id_fakultas);
        } else if ($request->id_univ !=null) {
            $mahasiswa->where("mahasiswa.id_univ", $request->id_univ);
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
                    return "<div class='text-center'><div class='badge rounded-pill bg-label-primary'>Active</div></div>";
                } else {
                    return "<div class='text-center'><div class='badge rounded-pill bg-label-danger'>Inactive</div></div>";
                }
            })
            ->addColumn('action', function ($row) {
                $icon = ($row->status) ? "ti-circle-x" : "ti-circle-check";
                $color = ($row->status) ? "danger" : "primary";

                $url = route('igracias.mahasiswa.status', $row->nim);
                $btn = "<div class='d-flex justify-content-center'><a data-bs-toggle='modal' data-id='{$row->nim}' onclick=edit($(this)) class='cursor-pointer mx-1 text-warning'><i class='tf-icons ti ti-edit' ></i>
                <a data-url='{$url}' class='cursor-pointer mx-1 update-status text-{$color}' data-function='afterUpdateStatus'><i class='tf-icons ti {$icon}'></i></a></div>";

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
    public function update(MahasiswaRequest $request, $id)
    {
        try {
            DB::beginTransaction();
            $mahasiswa = Mahasiswa::where('nim', $id)->first();
            if (!$mahasiswa) return Response::error(null, 'Mahasiswa not found!');
            $mahasiswa->update($request->all());
            $mahasiswa->user()->update([
                'name' => $request->namamhs,
                'email' => $request->emailmhs
            ]);

            DB::commit();
            return Response::success(null, 'Mahasiswa successfully Add!');
        } catch (Exception $e) {
            DB::rollBack();
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

    public function import(Request $request)
    {
        $validRequest = $request->validate([
            'import' => 'required',
            'id_univ' => 'required',
            'id_fakultas' => 'required',
            'id_prodi' => 'required',
            'kode_dosen' => 'required',
        ], [
            'import.required' => 'File impor wajib diunggah.',
            'id_univ.required' => 'Universitas wajib dipilih.',
            'id_fakultas.required' => 'Fakultas wajib dipilih.',
            'id_prodi.required' => 'Prodi wajib dipilih.',
            'kode_dosen.required' => 'Dosen Wali wajib dipilih.',
        ]);

        $data = $request->file('import');
        $namafile = $data->getClientOriginalName();
        $data->move('MhsData', $namafile);
        $import = new MhsImport(...array_slice($validRequest, 1, count($validRequest) - 1));
        $filePath = public_path('/MhsData/' . $namafile);

        if (!$import->checkHeaders($filePath)) {

            if (file_exists($filePath)) {
                unlink($filePath);
            }

            return response()->json([
                'message' => 'Header tidak sesuai. Mohon untuk menggunakan template yang telah disediakan.',
                'error' => true
            ], 400);
        }

        ($import)->import($filePath);

        $data = $import->getResults();

        // dd($data);

        if ($data['newData']->isEmpty() && $data['duplicatedData']->isEmpty() && $data['failedData']->isEmpty()) {

            if (file_exists($filePath)) {
                unlink($filePath);
            }

            return response()->json([
                'message' => 'File yang diimpor kosong atau tidak ada data yang valid. Mohon impor data dengan isian yang benar.',
                'error' => true
            ], 400);
        }

        session(['import_results' => $data]);
        return response()->json([
            'message' => 'Sebelum disimpan, data di preview',
            'error' => false,
            'url' => route('igracias.mahasiswa.preview'),
            'showConfirmButton' => false,
            'icon' => 'info',
            'title' => 'Informasi'
        ], 200);
    }

    public function preview()
    {
        $data = session('import_results');                
        if (!$data) return redirect()->route('igracias.mahasiswa');

        return view('masters.mahasiswa.preview', compact('data'));
    }

    public function storeImport(Request $request)
    {
        try {
            $records = json_decode($request->newData, true);

            if (isset($request->duplicatedData)) {
                $duplicates = [json_decode($request->duplicatedData, true)];
                $records = array_merge($records, $duplicates);
            }

            foreach ($records as $record) {
                Mahasiswa::updateOrCreate(
                    ['nim' => $record['nim']],
                    [
                        ...$record,
                        'id_univ' => $request->input('univ'),
                        'id_fakultas' => $request->input('fakultas'),
                        'id_prodi' => $request->input('prodi'),
                        'kode_dosen' => $request->input('dosen_wali')
                    ]
                );
            }

            return response()->json([
                'message' => 'Import data mahasiswa berhasil',
                'error' => false,
                'url' => route('igracias'),
                'showConfirmButton' => false,
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Terjadi kesalahan saat mengimport data',
                'error' => true,
                'details' => $e->getMessage(),
                'showConfirmButton' => true,
            ], 500);
        }
    }

    public function download_failed_data(Request $request)
    {
        $failedData = json_decode($request->failedData, true);
        $export = new DataFailedExport('Template_Import_Mahasiswa', $failedData, 'data_failed_import_mahasiswa');
        return $export->download();
    }
}
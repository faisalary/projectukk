<?php

namespace App\Http\Controllers;

use Exception;
use App\Helpers\Response;
use App\Models\JenisMagang;
use App\Models\BerkasMagang;
use Illuminate\Http\Request;
use App\Models\TahunAkademik;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Crypt;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Requests\JenisMagangRequest;
use Illuminate\Support\Facades\Storage;

class JenisMagangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('masters.jenis_magang.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $tahun = TahunAkademik::all();
        $berkas = BerkasMagang::all();
        $urlBack = route('jenismagang');
        return view('masters.jenis_magang.modal', compact('tahun', 'berkas', 'urlBack'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(JenisMagangRequest $request)
    {
        try {
            $dataStep = Crypt::decryptString($request->data_step);
            if ($dataStep == '1') {
                return Response::success([
                    'ignore_alert' => true,
                    'data_step' => (int) ($dataStep + 1),
                ], 'Valid data!');
            }

            DB::beginTransaction();
            $kategori = JenisMagang::create([
                'namajenis' => $request->namajenis,
                'durasimagang' => $request->durasimagang,
                'id_year_akademik' => $request->id_year_akademik,
                'status' => true,
            ]);

            foreach ($request->berkas as $key => $value) {
                if ($value['template'] != null) {
                    $file = Storage::put('template_berkas_magang', $value['template']);
                }

                BerkasMagang::create([
                    'id_jenismagang' => $kategori->id_jenismagang,
                    'nama_berkas' => $value['namaberkas'],
                    'template' => $file,
                    'status_upload' => $value['statusupload'],
                ]);
            }

            DB::commit();

            return Response::success(null, 'Data successfully Created!');
        } catch (Exception $e) {
            DB::rollBack();
            return Response::errorCatch($e);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
        $berkas = JenisMagang::with('berkas_magang')->orderBy('id_jenismagang', 'asc');

        return DataTables::of($berkas->get())
            ->addIndexColumn()
            ->editColumn('status', function ($jenismagang) {
                if ($jenismagang->status == 1) {
                    return "<div class='text-center'><div class='badge rounded-pill bg-label-success'>Active</div></div>";
                } else {
                    return "<div class='text-center'><div class='badge rounded-pill bg-label-danger'>Inactive</div></div>";
                }
            })
            ->editColumn('status_upload', function ($row) {
                $result = '';
                $file = $row->berkas_magang;
                if ($row->berkas_magang) {
                    foreach ($file as $item) {
                        if ($item->status_upload == 1) {
                            $result .= '<span> <i class="bi bi-dot"></i> Wajib Upload </span><br>';
                        } else {
                            $result .= '<span> <i class="bi bi-dot"></i> Tidak Wajib Upload </span><br>';
                        }
                    }
                }
                return $result;
            })
            ->addColumn('berkas_magang', function ($row) {

                $result = '';
                $file = $row->berkas_magang;
                if ($row->berkas_magang) {
                    foreach ($file as $item) {
                        $result .= '<span> <i class="bi bi-dot"></i>' . $item->nama_berkas . '</span><br>';
                    }
                }
                return $result;
            })
            ->addColumn('action', function ($jenismagang) {
                $icon = ($jenismagang->status) ? "ti-circle-x" : "ti-circle-check";
                $color = ($jenismagang->status) ? "danger" : "success";

                $url = route('jenismagang.status', $jenismagang->id_jenismagang);
                $btn = "<div class='d-flex justify-content-center'><a href='jenis-magang/edit/{$jenismagang->id_jenismagang}' class='btn-icon text-warning'><i class='tf-icons ti ti-edit' ></i>
                <a data-url='{$url}' class='update-status btn-icon text-{$color}' data-function='afterUpdateStatus'><i class='tf-icons ti {$icon}'></i></a></div>";

                return $btn;
            })
            ->rawColumns(['status', 'action', 'berkas_magang', 'status_upload'])
            ->make(true);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {

        $jenismagang = JenisMagang::where('id_jenismagang', $id)->first();
        $tahun = TahunAkademik::all();

        return view('masters.jenis_magang.modal', compact('jenismagang', 'tahun'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(JenisMagangRequest $request, $id)
    {
        try {
            $jenismagang = JenisMagang::with('berkas_magang')->where('id_jenismagang', $id)->first();
            if (!$jenismagang) return Response::error(null, 'Jenis Magang not found!', 404);

            $dataStep = Crypt::decryptString($request->data_step);
            if ($dataStep == '1') {
                return Response::success([
                    'ignore_alert' => true,
                    'data_step' => (int) ($dataStep + 1),
                    'content' => view('masters/jenis_magang/step/detail_berkas_magang', [
                        'berkas_magang' => $jenismagang->berkas_magang
                    ])->render(),
                ], 'Valid data!');
            }

            DB::beginTransaction();

            $jenismagang->namajenis = $request->namajenis;
            $jenismagang->durasimagang = $request->durasimagang;
            $jenismagang->id_year_akademik = $request->id_year_akademik;
            $jenismagang->save();

            $berkasToDelete = $jenismagang->berkas_magang()->whereNotIn('id_berkas_magang', collect($request->berkas)->pluck('id_berkas_magang')->toArray())->get();
            foreach ($berkasToDelete as $key => $value) {
                Storage::delete($value->template);
                $value->delete();
            }

            foreach ($request->berkas as $key => $l) {
                if (isset($l['id_berkas_magang']) && $l['id_berkas_magang'] != null) {
                    $berkas_magang = $jenismagang->berkas_magang->where('id_berkas_magang', $l['id_berkas_magang'])->first();
                    $file = $berkas_magang->template;
                    if (isset($l['template']) && $l['template'] != null) {
                        if ($berkas_magang) {
                            Storage::delete($berkas_magang->template);
                        }
                        $file = Storage::put('template_berkas_magang', $l['template']);
                    }

                    $berkas_magang->update([
                        'nama_berkas' => $l['namaberkas'],
                        'template' => $file,
                        'status_upload' => $l['statusupload'],
                    ]);
                } else {
                    $file = null;
                    if ($l['template'] != null) {
                        $file = Storage::put('template_berkas_magang', $l['template']);
                    }
                    BerkasMagang::create([
                        'id_jenismagang' => $jenismagang->id_jenismagang,
                        'nama_berkas' => $l['namaberkas'],
                        'template' => $file,
                        'status_upload' => $l['statusupload'],
                    ]);
                }
            }

            DB::commit();
            return Response::success(null, 'Data successfully Updated!');
        } catch (Exception $e) {
            DB::rollBack();
            return Response::errorCatch($e);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function status(string $id)
    {
        try {
            $jenismagang = JenisMagang::where('id_jenismagang', $id)->first();
            if (!$jenismagang) return Response::error(null, 'Jenis Magang not found!');

            $jenismagang->status = !$jenismagang->status;
            $jenismagang->save();

            return Response::success(null, 'Status successfully Updated!');
        } catch (Exception $e) {
            return Response::errorCatch($e);
        }
    }
}

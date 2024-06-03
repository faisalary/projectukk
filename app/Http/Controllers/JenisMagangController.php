<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\JenisMagang;
use App\Models\BerkasMagang;
use Illuminate\Http\Request;
use App\Models\TahunAkademik;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\BerkasRequest;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Requests\JenisMagangRequest;

class JenisMagangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $jenismagang = JenisMagang::all();
        $tahun = TahunAkademik::all();
        $berkas = BerkasMagang::all();
        return view('masters.jenis_magang.index', compact('jenismagang', 'tahun', 'berkas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $jenismagang = JenisMagang::all();
        $tahun = TahunAkademik::all();
        $berkas = BerkasMagang::all();
        return view('masters.jenis_magang.modal', compact('jenismagang', 'tahun', 'berkas'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(JenisMagangRequest $request, BerkasRequest $request2)
    {
        DB::beginTransaction();
        try {
            $kategori = JenisMagang::create([
                'namajenis' => $request->jenis,
                'durasimagang' => $request->durasimagang,
                'id_year_akademik' => $request->tahunakademik,
                'status' => true,
            ]);

            foreach ($request2->berkas as $key => $value) {
                BerkasMagang::create([
                    'id_jenismagang' => $kategori->id_jenismagang,
                    'nama_berkas' => $value['namaberkas'],
                    'template' => $value['template']->store('post'),
                    'status_upload' => $value['statusupload'],
                ]);
            }

            DB::commit();

            return response()->json([
                'error' => false,
                'message' => 'Data successfully Created!',
                'url' => url('master/jenis-magang/'),
                'table' => '#table-master-jenis_magang'
            ]);
        } catch (Exception $e) {
            DB::rollBack();
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
        $berkas = JenisMagang::with('berkas_magang')->orderBy('id_jenismagang', 'asc');

        return DataTables::of($berkas->get())
            ->addIndexColumn()
            ->editColumn('status', function ($jenismagang) {
                if ($jenismagang->status == 1) {
                    return "<div class='text-center'><div class='badge rounded-pill bg-label-success'>" . "Active" . "</div></div>";
                } else {
                    return "<div class='text-center'><div class='badge rounded-pill bg-label-danger'>" . "Inactive" . "</div></div>";
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

                $btn = "<a  href='jenis-magang/edit/{$jenismagang->id_jenismagang}' class='btn-icon text-warning waves-effect waves-light'><i class='tf-icons ti ti-edit' ></i>
                <a data-status='{$jenismagang->status}' data-id='{$jenismagang->id_jenismagang}' data-url='jenis-magang/status' class='update-status btn-icon text-{$color} waves-effect waves-light'><i class='tf-icons ti {$icon}'></i></a>";

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

        $jenismagang = JenisMagang::findOrFail($id);
        $tahun = TahunAkademik::all();
        $berkas = BerkasMagang::where('id_jenismagang', $id)->get();
        return view('masters.jenis_magang.edit', compact('jenismagang', 'tahun', 'berkas'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(JenisMagangRequest $request, $id, BerkasRequest $request2)
    {

        try {

            $jenismagang = JenisMagang::where('id_jenismagang', $id)->first();
            $berkas = BerkasMagang::where('id_jenismagang', $id)->pluck('id_berkas_magang')->toArray();
            $berkas2 = BerkasMagang::where('id_jenismagang', $id)->pluck('template')->toArray();

            $jenismagang->namajenis = $request->jenis;
            $jenismagang->durasimagang = $request->durasimagang;
            $jenismagang->id_year_akademik = $request->tahunakademik;
            $jenismagang->save();

            $arr = [];
            foreach ($request2->berkas as $key => $item) {
                $arr[] .= $item['id_berkas'];
            }

            foreach ($berkas as $key => $value) {
                if (!in_array($value, $arr)) {
                    BerkasMagang::where('id_berkas_magang', $value)->delete();
                }
            }

            if (in_array(null, $berkas2)) {

                if (isset($request2['template'])) {
                    $data2[] = [
                        'template' => $request2['template']->store('post')
                    ];
                }
                return response()->json([
                    'error' => false,
                    'message' => 'Data successfully Updated!',
                    'url' => url('master/jenis-magang/'),
                    'table' => '#table-master-jenis_magang'
                ]);
            } else {

                $data2 = [
                    'id_berkas_magang' => $request2['id_berkas'],
                    'nama_berkas' => $request2['namaberkas'],
                    'status_upload' => $request2['statusupload'],
                ];
            }

            foreach ($request2->berkas as $key => $l) {
                BerkasMagang::updateOrCreate(
                    [
                        'id_berkas_magang' => $l['id_berkas'],
                        'id_jenismagang' => $jenismagang->id_jenismagang,

                    ],
                    [
                        'id_berkas_magang' => $l['id_berkas'],
                        'nama_berkas' => $l['namaberkas'],
                        'status_upload' => $l['statusupload'],

                    ]

                );
            }

            return response()->json([
                'error' => false,
                'message' => 'Data successfully Updated!',
                'url' => url('master/jenis-magang/'),
                'table' => '#table-master-jenis_magang'
            ]);
        } catch (Exception $e) {
            return response()->json([
                'error' => true,
                'message' => $e->getMessage()
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function status(string $id)
    {
        try {
            $jenismagang = JenisMagang::where('id_jenismagang', $id)->first();
            $jenismagang->status = ($jenismagang->status) ? false : true;
            $jenismagang->save();

            return response()->json([
                'error' => false,
                'message' => 'Status successfully updated!',
                'modal' => '#modalTambahJenisMagang',
                'table' => '#table-master-jenis_magang'
            ]);
        } catch (Exception $e) {
            return response()->json([
                'error' => true,
                'message' => $e->getMessage(),
            ]);
        }
    }
}

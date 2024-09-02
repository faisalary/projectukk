<?php

namespace App\Http\Controllers;
use Exception;
use App\Helpers\Response;
use Illuminate\Http\Request;
use App\Models\EmailTemplate;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Requests\MasterEmailRequest;
use App\Enums\TemplateEmailListProsesEnum;
use SebastianBergmann\CodeCoverage\Report\Xml\Project;

class MasterEmailController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('company.master_email.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $request->validate([
            'proses' => 'required|in:' . implode(',', TemplateEmailListProsesEnum::getConstants()),
        ]);

        $listTag = [
            ['title' => 'Nama Peserta', 'shortCode' => '[[NamaPeserta]]'],
            ['title' => 'NIM', 'shortCode' => '[[NIM]]'],
            ['title' => 'Perusahaan', 'shortCode' => '[[Perusahaan]]'],
            ['title' => 'Tahap Seleksi', 'shortCode' => '[[TahapSeleksi]]'],
            ['title' => 'Posisi Magang', 'shortCode' => '[[PosisiMagang]]']
        ];

        $data['list_tag'] = $listTag;
        $data['proses'] = $request->proses;
        $data['proses_name'] = TemplateEmailListProsesEnum::getWithLabel($request->proses)['title'];

        $data['existing'] = EmailTemplate::where('proses', $request->proses)->first();

        return view('company/master_email/form', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(MasterEmailRequest $request)
    {
        try {
            $user = auth()->user();
            $peg_industri = $user->pegawai_industri;

            $email = EmailTemplate::updateOrCreate(
            [
                'proses' => $request->proses,
                'id_industri' => $peg_industri->id_industri,
            ],
            [
                'subject_email' => $request->subject_email,
                'headline_email' => TemplateEmailListProsesEnum::getWithLabel($request->proses)['title'],
                'content_email' => $request->content_email,
            ]);

            return Response::success(null, 'Berhasil menyimpan template email.');
        } catch (Exception $e) {
            return Response::errorCatch($e);
        }

        
    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
        $user = auth()->user();
        $peg_industri = $user->pegawai_industri;

        $email = EmailTemplate::where('id_industri', $peg_industri->id_industri)->get();
        $listProses = TemplateEmailListProsesEnum::getConstants();
        $listProses = array_values($listProses);
        $listProses = collect($listProses)->map(function ($x) use ($email) {
            $get = $email->where('proses', $x)->first();

            $result = [
                'proses' => $x,
                'subject_email' => $get?->subject_email
            ];

            return (object) $result;
        });

        return datatables()->of($listProses)
            ->addIndexColumn()
            ->editColumn('proses', function ($x) {
                return TemplateEmailListProsesEnum::getWithLabel($x->proses)['title'];
            })
            ->editColumn('subject_email', function ($x) {
                return $x->subject_email ?? '<span class="fst-italic">- Not Yet Set -</span>';
            })
            ->addColumn('aksi', function ($x) {
                $result = '<div class="d-flex justify-content-center">';
                $result .= '<a class="cursor-pointer mx-1 text-warning" href="'.route('template_email.create', ['proses' => $x->proses]).'"><i class="ti ti-edit"></i></a>';
                $result .= '</div>';
                return $result;
            })
            ->rawColumns(['proses', 'subject_email', 'aksi'])
            ->make(true);
    }
}
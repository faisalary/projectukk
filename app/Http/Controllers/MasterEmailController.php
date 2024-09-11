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
        if ($request->ajax()) {
            if (in_array($request->proses, array_values(TemplateEmailListProsesEnum::getConstants()))) {
                $listTag = TemplateEmailListProsesEnum::getListTag($request->proses);
                $data['list_tag'] = $listTag;
                $result = view('company/master_email/components/list_tag', $data)->render();
            }

            return Response::success($result, 'Success.');
        }

        $data['proses'] = TemplateEmailListProsesEnum::_getWithLabel();
        $data['urlAction'] = route('template_email.store');

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

            $email = EmailTemplate::create(
            [
                'proses' => $request->proses,
                'id_industri' => $peg_industri->id_industri,
                'subject_email' => $request->subject_email,
                'headline_email' => TemplateEmailListProsesEnum::_getWithLabel($request->proses)['title'],
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

        return datatables()->of($email)
            ->addIndexColumn()
            ->editColumn('proses', function ($x) {
                return TemplateEmailListProsesEnum::_getWithLabel($x->proses)['title'];
            })
            ->editColumn('subject_email', function ($x) {
                return $x->subject_email ?? '<span class="fst-italic">- Not Yet Set -</span>';
            })
            ->addColumn('aksi', function ($x) {
                $result = '<div class="d-flex justify-content-center">';
                $result .= '<a class="cursor-pointer mx-1 text-warning" href="'.route('template_email.edit', ['id' => $x->id_email_template]).'"><i class="ti ti-edit"></i></a>';
                $result .= '</div>';
                return $result;
            })
            ->rawColumns(['proses', 'subject_email', 'aksi'])
            ->make(true);
    }

    public function edit($id) {
        $user = auth()->user();
        $peg_industri = $user->pegawai_industri;

        $data['existing'] = EmailTemplate::where('id_email_template', $id)
        ->where('id_industri', $peg_industri->id_industri)->first();
        $data['proses'] = TemplateEmailListProsesEnum::_getWithLabel();
        $data['urlAction'] = route('template_email.update', $id);

        return view('company/master_email/form', $data);
    }

    public function update(MasterEmailRequest $request, $id)
    {
        try {
            $user = auth()->user();
            $peg_industri = $user->pegawai_industri;

            $email = EmailTemplate::where('id_email_template', $id)->where('id_industri', $peg_industri->id_industri)->first();
            if ($email) {
                $email->update([
                    'proses' => $request->proses,
                    'subject_email' => $request->subject_email,
                    'headline_email' => TemplateEmailListProsesEnum::_getWithLabel($request->proses)['title'],
                    'content_email' => $request->content_email
                ]);
            }

            return Response::success(null, 'Berhasil mengupdate template email.');
        } catch (\Exception $e) {
            return Response::errorCatch($e);
        }
    }
}
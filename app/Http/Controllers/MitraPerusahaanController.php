<?php

namespace App\Http\Controllers;

use App\Enums\LowonganMagangStatusEnum;
use App\Models\Industri;
use App\Helpers\Response;
use Illuminate\Http\Request;
use App\Models\LowonganMagang;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class MitraPerusahaanController extends Controller
{
    protected $page_per = 9; // jumlah data per halaman
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        $data['industries'] = Industri::withCount(['lowongan_magang' => function ($q) {
            $q->where('status', 1)->where('statusaprove', LowonganMagangStatusEnum::APPROVED);
        }])->where('statusapprove', 1);

        if ($request->name) {
            $data['industries'] = $data['industries']->where('namaindustri', 'like', '%' . $request->name . '%');
        }

        if ($request->location) {
            $data['industries'] = $data['industries']->where('alamatindustri', 'like', '%' . $request->location . '%');
        }

        $data['industries'] = $data['industries']->paginate($this->page_per)->toJson();
        $data['pagination'] = json_decode($data['industries'], true);
        $data['industries'] = $data['pagination']['data'];

        if ($request->ajax()) {
            return Response::success([
                'pagination' => view('perusahaan/components/pagination', $data)->render(),
                'view' => view('perusahaan/components/card_perusahaan', $data)->render(),
            ]);
        }

        $data['regencies'] = DB::table('reg_regencies')->get();

        return view('perusahaan.daftar_perusahaan', $data);
    }

    public function show(Request $request, $id)
    {
        $data['detail'] = Industri::where('id_industri', $id)->first();
        $data['lowongan'] = LowonganMagang::where('id_industri', $id)->where('statusaprove', LowonganMagangStatusEnum::APPROVED);

        if ($request->name) {
            $data['lowongan'] = $data['lowongan']->where('intern_position', 'like', '%' .$request->name. '%');
        }

        $data['lowongan'] = $data['lowongan']->paginate(5)->toJson();
        $data['pagination'] = json_decode($data['lowongan'], true);
        $data['lowongan'] = $data['pagination']['data'];

        if (request()->ajax()) {
            return Response::success([
                'pagination' => view('perusahaan/components/pagination', $data)->render(),
                'view' => view('perusahaan/components/card_lowongan', $data)->render(),
            ]);
        }

        $data['urlBack'] = route('daftar_perusahaan');
        if ($request->url_back) {
            $data['urlBack'] = $request->url_back;
        }

        return view('perusahaan.detail_perusahaan', $data);
    }

    public function filter()
    {
        $industries = Industri::where('statusapprove', 1);
        if(request()->name != null){
            $industries = $industries->where('namaindustri', 'like', '%'.request()->name.'%');
        }
        $data['industries'] = $industries->get();
        $data['page_per'] = $this->page_per;
        return view('perusahaan.list_perusahaan', $data)->render();
    }

}
<?php

namespace App\Http\Controllers;
use App\Models\Industri;
use App\Http\Controllers\Controller;
use App\Models\LowonganMagang;


class MitraPerusahaanController extends Controller
{
    protected $page_per = 12; // jumlah data per halaman
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['industries'] = Industri::where('statusapprove', 1)->get();
        $data['page_per'] = $this->page_per;
        return view('perusahaan.daftar_perusahaan', $data);
    }

    public function show($id)
    {
        $data['detail'] = Industri::where('id_industri', $id)->first();
        $data['lowongan'] = LowonganMagang::where('id_industri', $id)->get();
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
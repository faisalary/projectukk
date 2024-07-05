<?php

namespace App\Http\Controllers;

use App\Models\Industri;
use App\Models\JenisMagang;
use Illuminate\Http\Request;
use App\Models\LowonganMagang;
use Illuminate\Support\Carbon;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {

        if ($request->component) {
            return self::getComponent($request->component);
        }

        $jenisMagang = JenisMagang::all();
        return view('landingpage.landingpage', compact('jenisMagang'));
    }


    public function detailLowongan($id) {
        $lowongan = LowonganMagang::select(
            'id_lowongan', 'intern_position', 'industri.namaindustri', 'industri.image', 'industri.description as deskripsi_industri',
            'pelaksanaan', 'durasimagang', 'lokasi', 'nominal_salary', 'created_at', 'jenjang',
            'gender', 'statusaprove', 'keterampilan', 'deskripsi', 'requirements', 'benefitmagang',
            'tahapan_seleksi'
        )
        ->join('industri', 'industri.id_industri', '=', 'lowongan_magang.id_industri')
        ->where('id_lowongan', $id)->first()->dataTambahan('program_studi');
        if (!$lowongan) abort(404);

        $urlBack = route('dashboard');

        return view('program_magang.detail_lowongan', compact('lowongan', 'urlBack'));
    }


    // any private function 

    private static function getComponent($type) 
    {
        if ($type == 'container-lowongan-magang') {
            $lowongan = LowonganMagang::select(
                'id_lowongan', 'intern_position', 'industri.namaindustri', 'industri.image', 
                'created_at', 'lokasi', 'nominal_salary', 'durasimagang', 'gender'
            )
            ->join('industri', 'industri.id_industri', '=', 'lowongan_magang.id_industri');

            // pending dulu untuk yang terpopuler
            // $lowonganTerpopuler = $lowongan->
            // ------------------------------------

            $lowonganTerbaru = $lowongan->limit(6)->orderBy('created_at', 'desc')->get()->transform(function ( $item, $key) {
                $item->created_at = Carbon::parse($item->created_at)->diffForHumans(Carbon::now());
                $item->durasimagang = implode(' dan ', json_decode($item->durasimagang));
                $item->lokasi = implode(', ', json_decode($item->lokasi));
                $item->image = url('storage/' . $item->image);
                return $item;
            });

            return view('landingpage/components/lowongan', compact('lowonganTerbaru'))->render();
        } else if ('container-mitra') {
            $mitra = Industri::limit(6)->get()->transform(function ( $item, $key) {

                $item->image = url('storage/' . $item->image);

                return $item;
            });

            $urlBack = route('dashboard');
            return view('landingpage/components/mitra', compact('mitra', 'urlBack'))->render();
        }

    }
}

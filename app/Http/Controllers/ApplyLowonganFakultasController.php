<?php

namespace App\Http\Controllers;

use Exception;
use Carbon\Carbon;
use App\Models\Industri;
use App\Helpers\Response;
use App\Models\Education;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use App\Models\LowonganProdi;
use App\Models\LowonganMagang;
use App\Models\InformasiPribadi;
use App\Models\PendaftaranMagang;
use Illuminate\Support\Facades\Auth;

class ApplyLowonganFakultasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $data['lowongan'] = LowonganMagang::select(
            'lowongan_magang.*', 'industri.image', 'industri.namaindustri'
        )
        ->join('industri', 'lowongan_magang.id_industri', '=', 'industri.id_industri')->where('statusaprove', 'diterima');

        $data = self::filterData($data, $request);

        $data['lowongan'] = $data['lowongan']->paginate(3)->toJson();
        $data['pagination'] = json_decode($data['lowongan'], true);
        $data['lowongan'] = $data['pagination']['data'];

        if ($request->ajax()) {
            return Response::success([
                'pagination' => view('perusahaan/components/pagination', $data)->render(),
                'view' => view('perusahaan/components/card_lowongan_fp', $data)->render(),
            ]);
        }

        $data['perusahaan'] = Industri::where('statusapprove', 1)->get();

        return view('perusahaan.lowongan', $data);
    }

    public function show($id)
    {
        $detailLowongan = LowonganMagang::select(
            'lowongan_magang.*', 'industri.image', 'industri.namaindustri',
            'industri.description as deskripsi_industri'
        )
        ->join('industri', 'lowongan_magang.id_industri', '=', 'industri.id_industri')
        ->where('id_lowongan', $id)
        ->where('statusaprove', 'diterima')->first()->dataTambahan('jenjang_pendidikan', 'program_studi');

        if (!$detailLowongan) return Response::error(null, 'Lowongan Not Found', 404);
        $data = view('perusahaan/components/detail_lowongan_fp', compact('detailLowongan'))->render();

        return Response::success($data, 'Success');
    }

    // Detail Lowongan 
    public function lamar(Request $request, $id)
    {
        $nim = Auth::user()->nim;

        $profilemhs = InformasiPribadi::where('nim', $nim)->first();
        $mahasiswaprodi = Mahasiswa::with('prodi', 'fakultas', 'univ', 'informasiprib')->first();
        $mahasiswa = auth()->user()->mahasiswa;
        $persentase = $this->persentase($nim);
        $lowongandetail = LowonganMagang::where('id_lowongan', $id)->with('industri', 'fakultas', 'seleksi', 'mahasiswa')->first();

        $pendaftaran = PendaftaranMagang::where('id_lowongan', $id)->with('lowongan_magang', 'mahasiswa')->get();
        $magang = $pendaftaran->where('nim', $nim)->first();

        return view('apply.apply', compact('persentase', 'lowongandetail', 'mahasiswa', 'mahasiswaprodi', 'profilemhs', 'nim', 'pendaftaran', 'magang'));
    }

    // Apply Lamran / Kirim Lamaran
    public function apply(Request $request, $id)
    {
        try {
            $nim = Auth::user()->nim;

            PendaftaranMagang::create([
                'id_lowongan' => $id,
                'nim' => $nim,
                'tanggaldaftar' => Carbon::parse(now()),
                'current_step' => 'screening',
                'portofolio' =>  $request->porto?->store('post'),
            ]);

            return response()->json([
                'error' => false,
                'message' => 'Lamaran berhasil dikirim!',
                'url' => `{{url('apply-lowongan/lamar')}} /${id}`,
            ]);
        } catch (Exception $e) {
            return response()->json([
                'error' => true,
                'message' => $e->getMessage(),
            ]);
        }
    }

    // Persentase profile
    public function persentase($id)
    {
        $mahasiswa = Mahasiswa::find($id);
        $informasiprib = InformasiPribadi::where('nim', $id)->first();
        $pendidikan = Education::where('nim', $id)->first();
        if ($mahasiswa && $pendidikan && $informasiprib) {
            $filledColumns = 0;

            $mahasiswaColumns = [
                'nim', 
                'angkatan', 
                'id_prodi', 
                'id_univ', 
                'id_fakultas', 
                'namamhs', 
                'alamatmhs', 
                'emailmhs', 
                'nohpmhs', 
                'status',
                'eprt',
                'ipk',
                'tak',
                'lok_magang',
                'skills',
                'tunggakan_bpp'
            ];

            $infropribcolumns = [
                'tgl_lahir',
                'headliner',
                'deskripsi_diri',
                'profile_picture',
                'gender',
            ];
            
            $pendidikanColumns = [
                'name_intitutions',
                'tingkat',
                'nilai',
                'startdate',
                'enddate',
            ];

            $totalColumns = count($mahasiswaColumns) + count($pendidikanColumns) + count($infropribcolumns);

            foreach ($mahasiswaColumns as $column) {
                if (!is_null($mahasiswa->$column) && $mahasiswa->$column !== '') {
                    $filledColumns++;
                }
            }

            foreach ($infropribcolumns as $column) {
                if (!is_null($informasiprib->$column) && $informasiprib->$column !== '') {
                    $filledColumns++;
                }
            }

            foreach ($pendidikanColumns as $column) {
                if (!is_null($pendidikan->$column) && $pendidikan->$column !== '') {
                    $filledColumns++;
                }
            }
            $persentase = ($filledColumns / $totalColumns) * 100;
            
        } else {
            $persentase = 0;
        }

        return $persentase;
    }

    private static function filterData($data, $request) {
        if ($request->lowongan) {
            $data['lowongan'] = $data['lowongan']->where('intern_position', 'like', '%'.$request->lowongan.'%');
        }

        if ($request->location) {
            $data['lowongan'] = $data['lowongan']->where('lokasi', 'like', '%'.$request->location.'%');
        }
        if ($request->start_date && $request->end_date) {
            $start = Carbon::parse($request->start_date)->format('Y-m-d');
            $end = Carbon::parse($request->end_date)->format('Y-m-d');
            $data['lowongan'] = $data['lowongan']->whereBetween('lowongan_magang.created_at', [$start, $end]);
        }

        if ($request->perusahaan) {
            $data['lowongan'] = $data['lowongan']->whereIn('lowongan_magang.id_industri', $request->perusahaan);
        }

        if ($request->paymentType) {
            if ($request->paymentType == 'berbayar' && $request->nominal_minimal) {
                $data['lowongan'] = $data['lowongan']->where('nominal_salary', '>=', $request->nominal_minimal);
            } else {
                $data['lowongan'] = $data['lowongan']->whereNull('nominal_salary');
            }
        }

        if ($request->type_magang) {
            $data['lowongan'] = $data['lowongan']->where(function ($query) use ($request) {
                foreach ($request->type_magang as $key => $value) {
                    $query->orWhere('durasimagang', 'like', '%' . $value . '%');
                }
            });
        }

        if ($request->pelaksanaan) {
            $data['lowongan'] = $data['lowongan']->where(function ($query) use ($request) {
                foreach ($request->pelaksanaan as $key => $value) {
                    $query->orWhere('pelaksanaan', $value);
                }
            });
        }

        return $data;
    }
}

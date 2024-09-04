<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\User;
use Ramsey\Uuid\Uuid;
use App\Models\Industri;
use App\Helpers\Response;
use App\Jobs\SendMailJob;
use App\Mail\VerifyEmail;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Requests\CompanyReg;
use Illuminate\Support\Facades\DB;
use App\Mail\RejectionNotification;
use App\Http\Controllers\Controller;
use App\Models\PegawaiIndustri;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Yajra\DataTables\Facades\DataTables;

class KelolaMitraController extends Controller
{

    public function __construct()
    {
        $this->middleware('permission:kelola_mitra.view');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('company.kelola_mitra.index');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CompanyReg $request)
    {
        try{
            DB::beginTransaction();
            $code = Str::random(64);

            $passwordResetToken = DB::table('password_reset_tokens')->where('email', $request->email)->first();
            if ($passwordResetToken) {
                DB::table('password_reset_tokens')->where('email', $request->email)->delete();
            }

            DB::table('password_reset_tokens')->insert([
                'email' => $request->email,
                'token' => $code,
                'created_at' => now(),
            ]);

            $admin = User::create([
                'name' => $request->namaindustri,
                'username' => $request->namaindustri,
                'email' => $request->email,
                'password' => Hash::make(Str::random(12)),
            ]);
            $admin->assignRole('Mitra');

            $industri = Industri::create([
                'namaindustri' => $request->namaindustri,
                'alamatindustri'=> $request->alamat,
                'description'=> $request->deskripsi,
                'kategori_industri' => $request->kategori_industri,
                'statuskerjasama' => $request->statuskerjasama,
                'statusapprove' => 1,
            ]);

            $administratorIndustri = PegawaiIndustri::create([
                'id_industri' => $industri->id_industri,
                'namapeg' => $request->penanggung_jawab,
                'nohppeg' => $request->contact_person,
                'emailpeg' => $request->email,
                'jabatan' => 'Administrator',
                'statuspeg' => true,
                'id_user' => $admin->id
            ]);

            $industri->penanggung_jawab = $administratorIndustri->id_peg_industri;
            $industri->save();

            $url = route('register.set-password', ['token' => $code]);
            dispatch(new SendMailJob($request->email, new VerifyEmail($url)));
            
            DB::commit();
            return Response::success(null, 'Industri successfully Created!');
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
        $industri = Industri::with('penanggungJawab');
        $status = $request->status;

        if ($status == 'pending') $industri->where('statusapprove', 0);
        elseif ($status == 'verified') $industri->where('statusapprove', 1);
        elseif ($status == 'rejected') $industri->where('statusapprove', 2);

        return DataTables::of($industri->get())
            ->addIndexColumn()
            ->addColumn('aksi', function ($id) use ($status) {
                $btn = "<div class='d-flex justify-content-center'>";
                if ($status == 'pending') {
                    $btn .= "<a onclick='approved($(this))' class='mx-1 text-success cursor-pointer' data-id='{$id->id_industri}'><i class='ti ti-file-check'></i></a>";
                    $btn .= "<a onclick='rejected($(this))' class='mx-1 text-danger cursor-pointer' data-id='{$id->id_industri}'><i class='ti ti-file-x'></i></a>";
                }
                $btn .= "<a data-bs-toggle='modal' data-id='{$id->id_industri}' onclick=edit($(this)) class='mx-1 text-warning cursor-pointer'><i class='ti ti-edit' ></i>";
                $btn .= "</div>";

                return $btn;
            })
            ->editColumn('namaindustri', function ($data) {
                $x = '<div class="d-flex flex-column align-items-start">';
                $x .= '<span class="fw-bolder">' . $data->namaindustri . '</span>';
                $x .= '<small>' . $data->email . '</small>';
                $x .= '<small>' . $data->notelpon . '</small>';
                $x .= '</div>';
                return $x;
            })
            ->editColumn('penanggung_jawab', function ($data) {
                $data = $data->penanggungJawab;
                $x = '<div class="d-flex flex-column align-items-start">';
                $x .= '<span class="fw-bolder">' . $data->namapeg . '</span>';
                $x .= '<small>' . $data->emailpeg . '</small>';
                $x .= '<small>' . $data->nohppeg . '</small>';
                $x .= '</div>';
                return $x;
            })
            ->rawColumns(['aksi', 'namaindustri', 'penanggung_jawab'])
            ->make(true);
    }

    public function approved($id)
    {
        try {
            DB::beginTransaction(); 
            $data = Industri::find($id);
            if (!$data) return Response::error(null, 'Not Found.');
            if ($data->statusapprove != 0) return Response::error(null, 'Mitra sudah diapprove.');
            $pegawaiIndustri = PegawaiIndustri::where('id_peg_industri', $data->penanggung_jawab)->first();
            if (!$pegawaiIndustri) return Response::error(null, 'Not Found.');

            $data->statusapprove = 1;
            $data->save();

            $user = User::create([
                'name' => $pegawaiIndustri->namapeg,
                'username' => $pegawaiIndustri->namapeg,
                'email' => $pegawaiIndustri->emailpeg,
                'password' => Hash::make(Str::random(12)),
            ])->assignRole('Mitra');

            $pegawaiIndustri->update(['id_user' => $user->id]);

            $code = Str::random(60);

            $passwordResetToken = DB::table('password_reset_tokens')->where('email', $pegawaiIndustri->emailpeg)->first();
            
            if ($passwordResetToken) {
                DB::table('password_reset_tokens')->where('email', $pegawaiIndustri->emailpeg)->delete();
            }

            DB::table('password_reset_tokens')->insert([
                'email' => $pegawaiIndustri->emailpeg,
                'token' => $code,
                'created_at' => now(),
            ]);
            
            $url = route('register.set-password', ['token' => $code]);
            dispatch(new SendMailJob($pegawaiIndustri->emailpeg, new VerifyEmail($url)));
            DB::commit();

            return Response::success(null, 'Persetujuan berhasil.');
        } catch (\Exception $e) {
            DB::rollBack();
            return Response::errorCatch($e);
        }
    }
    public function rejected($id, Request $request)
    {
        $data=Industri::find($id);
        $data->statusapprove='2';
        $data->save();
        $alasan = $request->input('alasan');
        dispatch(new SendMailJob($data->email, new RejectionNotification($alasan)));
        return redirect()->back();
    }
    

    public function edit(string $id)
    {
        $industri = Industri::with('penanggungJawab')->where('id_industri', $id)->first();
        $industri->penanggung_jawab = $industri->penanggungJawab->namapeg;
        $industri->email = $industri->penanggungJawab->emailpeg;
        $industri->contact_person = $industri->penanggungJawab->nohppeg;

        unset($industri->penanggungJawab);
        return $industri;
    }

    public function update(CompanyReg $request, $id)
    {
        try {
            DB::beginTransaction();

            $industri = Industri::where('id_industri', $id)->first();
            if (!$industri) return Response::error(null, 'Not Found.');
            $penanggungJawab = PegawaiIndustri::where('id_peg_industri', $industri->penanggung_jawab)->first();
            $user = User::where('id', $penanggungJawab->id_user)->first();


            $user->name = $request->namaindustri;
            $user->username = $request->namaindustri;
            $user->email = $request->email;
            $user->save();

            $industri->namaindustri = $request->namaindustri;
            $industri->alamatindustri = $request->alamat;
            $industri->description = $request->deskripsi;
            $industri->kategori_industri = $request->kategori_industri;
            $industri->statuskerjasama = $request->statuskerjasama;
            $industri->save();

            $penanggungJawab->namapeg = $request->penanggung_jawab;
            $penanggungJawab->nohppeg = $request->contact_person;
            $penanggungJawab->emailpeg = $request->email;
            $penanggungJawab->save();

            DB::commit();
            return Response::success(null, 'Data Successfully Updated!');
        } catch (Exception $e) {
            DB::rollBack();
            return Response::errorCatch($e);
        }
    }

    public function status($id)
    {
        try {
            $industri = Industri::where('id_industri', $id)->first();
            $industri->status = ($industri->status) ? false : true;
            $industri->save();

            return response()->json([
                'error' => false,
                'message' => 'Status successfully Updated!',
                'table' => '#table-kelola-mitra3'
            ]);
        
        } catch (Exception $e) {
            return response()->json([
                'error' => true,
                'message' => $e->getMessage(),
            ]);
        }
    }

}
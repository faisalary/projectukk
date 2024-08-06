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
use App\Models\WilayahKota;
use App\Models\WilayahNegara;
use App\Models\WilayahProvinsi;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Yajra\DataTables\Facades\DataTables;

class WilayahController extends Controller
{

    public function __construct()
    {
        $this->middleware('permission:wilayah.view');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('masters.wilayah.index');
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
        if($request->type == 'provinces'){
            $wilayah = WilayahProvinsi::with('negara');
        }elseif($request->type == 'cities'){
            $wilayah = WilayahKota::with('provinsi');
        }else{
            $wilayah = new WilayahNegara();
        }

        $datatables = DataTables::of($wilayah->get())
        ->addIndexColumn()
        ->addColumn('aksi', function ($id){
            $btn = "<div class='d-flex justify-content-center'>";
            $btn .= "<a data-bs-toggle='modal' data-id='{$id->id_industri}' onclick=edit($(this)) class='mx-1 text-warning cursor-pointer'><i class='ti ti-edit' ></i>";
            $btn .= "</div>";

            return $btn;
        });

        if($request->type == 'provinces'){
            $datatables->addColumn('parent', function($provinsi){
                return $provinsi->negara->name;
            });
        }elseif($request->type == 'cities'){
            $datatables->addColumn('parent', function($kota){
                return $kota->provinsi->name;
            });
        }

        return $datatables->rawColumns(['aksi'])
        ->make(true);
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
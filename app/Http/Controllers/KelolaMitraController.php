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
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Yajra\DataTables\Facades\DataTables;

class KelolaMitraController extends Controller
{
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
            $industri = Industri::create([
                'namaindustri' => $request->namaindustri,
                'email' => $request->email,
                'notelpon' => $request->contact_person,
                'penanggung_jawab' => $request->penanggung_jawab,
                'alamatindustri'=> $request->alamat,
                'description'=> $request->deskripsi,
                'kategori_industri' => $request->kategori_industri,
                'statuskerjasama' => $request->statuskerjasama,
                'status' => true,
            ]);
        
            $code = Str::random(64);
            $admin = User::create([
                'name' => 'Mitra',
                'username' => $request->namaindustri,
                'email' => $request->email,
                'password' => Hash::make($industri->penanggung_jawab),
            ]);
            $admin->assignRole('admin');
                
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
        $industri = Industri::query();
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
            ->rawColumns(['aksi',])
            ->make(true);
    }

    public function approved($id)
    {
        try {
            DB::beginTransaction(); 
            $data = Industri::find($id);
            if (!$data) return Response::error(null, 'Not Found.');
            if ($data->statusapprove != 0) return Response::error(null, 'Mitra sudah diapprove.');

            $data->statusapprove = 1;
            $data->save();

            $user = User::create([
                'name' => $data->penanggung_jawab,
                'username' => $data->penanggung_jawab,
                'email' => $data->email,
                'password' => Hash::make(Str::random(12)),
            ])->assignRole('Mitra');

            $code = Str::random(60);

            $passwordResetToken = DB::table('password_reset_tokens')->where('email', $data->email)->first();
            
            if ($passwordResetToken) {
                DB::table('password_reset_tokens')->where('email', $data->email)->delete();
            }

            DB::table('password_reset_tokens')->insert([
                'email' => $data->email,
                'token' => $code,
                'created_at' => now(),
            ]);
            
            $url = route('register.set-password', ['token' => $code]);
            dispatch(new SendMailJob($data->email, new VerifyEmail($url)));
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
        Mail::to($data->email)->send(new RejectionNotification($alasan));
        return redirect()->back();
    }
    

    public function edit(string $id)
    {
        $industri = Industri::where('id_industri', $id)->first();
        return $industri;
    }

    public function update(CompanyReg $request, $id)
    {
        try {
            $industri = Industri::where('id_industri', $id)->first();       
            $industri->namaindustri = $request->namaindustri;
            $industri->email = $request->email;
            $industri->notelpon = $request->contact_person;
            $industri->penanggung_jawab = $request->penanggung_jawab;
            $industri->alamatindustri = $request->alamat;
            $industri->description = $request->deskripsi;
            $industri->kategori_industri = $request->kategori_industri;
            $industri->statuskerjasama = $request->statuskerjasama;
            $industri->save();

            return Response::success(null, 'Data Successfully Updated!');
        } catch (Exception $e) {
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
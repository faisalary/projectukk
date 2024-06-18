<?php

namespace App\Http\Controllers;

use App\Helpers\Response;
use App\Http\Controllers\Controller;
use App\Http\Requests\CompanyReg;
use App\Mail\RejectionNotification;
use Illuminate\Http\Request;
use App\Models\Industri;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use App\Mail\VerifyEmail;
use Illuminate\Support\Facades\Mail;
use Ramsey\Uuid\Uuid;

class KelolaMitraController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $industri = Industri::all();
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
                'remember_token' => $code,
                'isAdmin'=>1,
                'id_industri' => $industri->id_industri,
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
            

            if (!$data) {
                throw new \Exception('Industri data not found.');
            }
            $data->statusapprove = 1;
            $data->save();
            
            $user = User::where('email', $data->email)->first();
            $url = url('/company/set-password/' . $user->remember_token);
            Mail::to($data->email)->send(new VerifyEmail($url));
            DB::commit();

            return response()->json([
                'error' => false,
                'message' => 'Persetujuan berhasil.',
            ]);
            } catch (\Exception $e) {
                DB::rollBack();

                return response()->json([
                    'error' => true,
                    'message' => $e->getMessage(),
            ]);
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

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        
        try {
            $industri = Industri::where('id_industri', $id)->first();
            
            $industri->namaindustri = $request->namaindustri;
            $industri->email = $request->email;
            if($request->alamatindustri){
                $industri->alamatindustri = $request->alamatindustri;               
            }
            if($request->description){
                $industri->description = $request->description;
            }
            if($request->notelpon){
               $industri->notelpon = $request->notelpon;
           }
           if($request->kategori_industri){
               $industri->kategori_industri = $request->kategori_industri;
           }
           if($request->statuskerjasama){
            $industri->statuskerjasama = $request->statuskerjasama;
           }

            if (!empty($request->image)) {
                $industri->image = $request->image->store('post');
            }
            
            $industri->save();

            return response()->json([
                'error' => false,
                'message' => 'Data Successfully Updated!',
            ]);
        } catch (Exception $e) {
            return response()->json([
                'error' => true,
                'message' => $e->getMessage(),
            ]);
        }
    }

    public function status(string $id)
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
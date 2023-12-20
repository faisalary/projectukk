<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
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
    public function __construct()
    {
       
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $industri = Industri::all();
        return view('company.kelola_mitra.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'namaindustri' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
        ]);
        try{
            DB::beginTransaction();
            $industri = Industri::create([
            'namaindustri' => $request->namaindustri,
            'email' => $request->email,
            'kategori_industri' => $request->kategori_industri,
            'statuskerjasama' => $request->statuskerjasama,
            'status' => true,
        ]);

        
        $code = Str::random(64);
        $defaultPassword = '12345678';
        $admin = User::create([
            'name' => 'mitra',
            'username' => $request->namaindustri,
            'email' => $request->email,
            'password' => Hash::make($defaultPassword),
            'remember_token' => $code,
            'isAdmin'=>1,
            'id_industri' => $industri->id_industri,
        ]);
        $admin->assignRole('admin');
        $url=url('/admin/set-password/'.$code);

        if ($admin) {
        Mail::to($admin->email)->send(new VerifyEmail($url));
        }
        
        DB::commit();
        
        return response()->json([
            'error' => false,
            'message' => 'Industri successfully Created!',
            'modal' => '#modalTambahMitra',
            'table' => '#table-kelola-mitra1'
        ]);

        } catch (Exception $e) {
            DB::rollBack();
            
            return response()->json([
                'error' => true,
                'message' => $e->getMessage(),
            ]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($statusapprove)
    {
        $industri = Industri::where('statusapprove',$statusapprove)->orderBy('namaindustri')->get();

        return DataTables::of($industri)
            ->addIndexColumn()
            ->editColumn('status', function ($industri) {
                if ($industri->status == 1) {
                    return "<div class='text-center'><div class='badge rounded-pill bg-label-success'>" . "Active" . "</div></div>";
                } else {
                    return "<div class='text-center'><div class='badge rounded-pill bg-label-danger'>" . "Inactive" . "</div></div>";
                }
            })
            ->addColumn('action', function ($row) {
                $icon = ($row->status) ? "ti-circle-x" : "ti-circle-check";
                $color = ($row->status) ? "danger" : "success";

                $btn = "<a data-bs-toggle='modal' data-bs-target='#modalTambahMitra' data-id='{$row->id_industri}' onclick=edit($(this)) class='btn-icon text-warning waves-effect waves-light'><i class='tf-icons ti ti-edit' ></i>
                <a data-status='{$row->status}' data-id='{$row->id_industri}' data-url='kelola-mitra/status' class='btn-icon update-status text-{$color} waves-effect waves-light'><i class='tf-icons ti {$icon}'></i></a>";

                return $btn;
            })
            
            ->addColumn('aksi', function ($id) {
                $btn = "<a data-bs-toggle='modal' data-bs-target='#modalreject' class='btn-icon' data-id='{$id->id_industri}'>
                    <i class='btn-icon ti ti-file-check text-success' onclick='approved({$id->statusapprove})'></i>
                    <i class='btn-icon ti ti-file-x text-danger' onclick='rejected({$id->statusapprove})'></i></a>";
                    // data-bs-target='#modalreject'
                return $btn;
            })
            ->rawColumns(['action','status','aksi'])
            ->make(true);
    }

    public function approved($id)
    {
        $data=Industri::find($id);
        $data->statusapprove='1';
        $data->save();
        return redirect()->back();
    }
    public function rejected($id)
    {
        $data=Industri::find($id);
        $data->statusapprove='2';
        $data->save();
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
            $industri->kategori_industri = $request->kategori_industri;
            $industri->statuskerjasama = $request->statuskerjasama;
            $industri->save();

            return response()->json([
                'error' => false,
                'message' => 'Mitra successfully Updated!',
                'modal' => '#modalTambahMitra',
                'table' => '#table-kelola-mitra3'
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
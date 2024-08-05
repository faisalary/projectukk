<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\User;
use App\Helpers\Response;
use App\Jobs\SendMailJob;
use App\Mail\VerifyEmail;
use Illuminate\Support\Str;
use App\Models\PegawaiIndustri;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Requests\PegawaiIndustriRequest;

class PegawaiIndustriController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:anggota_tim.view');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('company.pegawai_industri.index');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PegawaiIndustriRequest $request)
    {
        try{
            DB::beginTransaction();

            $user = auth()->user();

            $userCreated = User::create([
                'name' => $request->namapeg,
                'username' => $request->namapeg,
                'email' => $request->emailpeg,
                'password' => Hash::make(Str::random(12)),
            ])->assignRole('Pembimbing Lapangan');

            $pegawai_industri = PegawaiIndustri::create([
                'id_industri' => $user->pegawai_industri->id_industri,
                'id_user'=> $userCreated->id,
                'namapeg'=> $request->namapeg,
                'nohppeg' => $request->nohppeg,
                'emailpeg' => $request->emailpeg,
                'jabatan' => $request->jabatan,
                'statuspeg' => true,
            ]);

            $code = Str::random(60);
            $passwordResetToken = DB::table('password_reset_tokens')->where('email', $request->emailpeg)->first();
            if ($passwordResetToken) {
                DB::table('password_reset_tokens')->where('email', $request->emailpeg)->delete();
            }
            DB::table('password_reset_tokens')->insert([
                'email' => $request->emailpeg,
                'token' => $code,
                'created_at' => now(),
            ]);
            
            $url = route('register.set-password', ['token' => $code]);
            dispatch(new SendMailJob($request->emailpeg, new VerifyEmail($url)));
            DB::commit();

            return Response::success(null, 'Anggota Tim successfully Created!');
        } catch (Exception $e) {
            DB::rollBack();
            return Response::errorCatch($e);
        }
    }

    /**
     * Display the spesified resource.
     */
    public function show()
    {
        $user = auth()->user();
        $pegawai_industri = $user->pegawai_industri;

        $pegawai_industri = PegawaiIndustri::with('user')->where('id_industri', $pegawai_industri->id_peg_industri)->orderBy('namapeg', 'asc')->get();
        return DataTables::of($pegawai_industri)
            ->addIndexColumn()
            ->editColumn('status', function ($row) {
                if ($row->statuspeg == 1) {
                    return "<div class='text-center'><div class='badge rounded-pill bg-label-success'>Active</div></div>";
                } else {
                    return "<div class='text-center'><div class='badge rounded-pill bg-label-danger'>Inactive</div></div>";
                }
            })
            ->addColumn('action', function ($row) {
                $icon = ($row->statuspeg) ? "ti-circle-x" : "ti-circle-check";
                $color = ($row->statuspeg) ? "danger" : "primary";

                $url = route('pegawaiindustri.status', $row->id_peg_industri);

                $btn = "<a data-bs-toggle='modal' data-id='{$row->id_peg_industri}' onclick= edit($(this)) class='cursor-pointer text-warning'><i class='tf-icons ti ti-edit' ></i>
                <a data-url='{$url}' class='update-status cursor-pointer text-{$color}' data-function='afterUpdateStatus'><i class='tf-icons ti {$icon}'></i></a>";

                return $btn;
            })
            ->addColumn('pegawai_industri', function ($row) {
                return $row->namapeg.'<br>'.$row->industri->namaindustri;
            })
            ->addColumn('kontak', function ($row) {
                return $row->nohppeg.'<br>'.$row->emailpeg;
            })
            ->addColumn('role', fn ($data) => $data->user->roles->pluck('name')->first())
            ->rawColumns(['action', 'status','pegawai_industri','kontak'])

            ->make(true);
     }

     /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $pegawai_industri = PegawaiIndustri::where('id_peg_industri', $id)->first();
        return $pegawai_industri;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PegawaiIndustriRequest $request, string $id)
    {
        try{
            DB::beginTransaction();
            $pegawai_industri = PegawaiIndustri::where('id_peg_industri', $id)->first();
            $pegawai_industri->namapeg = $request->namapeg;
            $pegawai_industri->nohppeg = $request->nohppeg;
            $pegawai_industri->emailpeg = $request->emailpeg;
            $pegawai_industri->jabatan = $request->jabatan;
            $pegawai_industri->save();
            if (isset($pegawai_industri->user)) {
                $user = $pegawai_industri->user;
                $user->name = $request->namapeg;
                $user->email = $request->emailpeg;
                $user->save();
            }

            DB::commit();
            return Response::success(null, 'Pegawai Industri successfully Updated!');
        } catch (Exception $e) {
            return Response::errorCatch($e);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function status(string $id)
    {
        try{
            $pegawai_industri = PegawaiIndustri::where('id_peg_industri', $id)->first();
            if (!$pegawai_industri) return Response::error(null, 'Pegawai industri not found!');

            $pegawai_industri->statuspeg = ($pegawai_industri->statuspeg) ? false : true;
            $pegawai_industri->save();

            return Response::success(null, 'Pegawai Industri successfully Updated!');
        } catch (Exception $e) {
            return Response::errorCatch($e);
        }
    }
}

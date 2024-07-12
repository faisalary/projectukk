<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Helpers\Response;
use App\Jobs\SendMailJob;
use App\Mail\VerifyEmail;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class KelolaPenggunaController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:kelola_pengguna.view');
    }

    public function index()
    {
        return view('admin.kelola-pengguna.index');
    }

    public function getData(Request $request) {
        $roles = ['LKM', 'Pembimbing Akademik', 'Dosen Wali', 'Kaprodi', 'Dosen'];
        $user = User::with('roles')->whereHas('roles', function ($query) use ($roles) {
            $query->whereIn('name', $roles);
        })->get();

        return datatables()->of($user)
        ->addIndexColumn()
        ->editColumn('roles', function ($data) {
            return '<div class="text-center">' .$data->roles[0]->name. '</div>';
        })
        ->addColumn('action', function ($data) {
            $result = '<div class="d-flex justify-content-center">';
            $result .= '<a class="cursor-pointer text-warning" onclick="edit($(this))" data-id="' .$data->id. '"><i class="ti ti-edit"></i></a>';
            $result .= '</>';
            return $result;
        })
        ->rawColumns(['roles', 'action'])
        ->make(true);
    }

    public function store(Request $request) {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email'
        ], [
            'name.required' => 'Nama harus diisi.',
            'email.required' => 'Email harus diisi.',
            'email.email' => 'Email tidak valid.',
            'email.unique' => 'Email sudah terdaftar.'
        ]);

        try {
            DB::beginTransaction();

            $user = User::create([
                'name' => $request->name,
                'username' => $request->name,
                'email' => $request->email,
                'password' => Hash::make(Str::random(12)),
            ])->assignRole('LKM');

            $code = Str::random(60);
            DB::table('password_reset_tokens')->insert([
                'email' => $request->email,
                'token' => $code,
                'created_at' => now(),
            ]);

            $url = route('register.set-password', ['token' => $code]);
            dispatch(new SendMailJob($request->email, new VerifyEmail($url)));

            DB::commit();
            return Response::success(null, 'LKM successfully created! Please check his/her email for verification.');
        } catch (\Exception $e) {
            DB::rollBack();
            return Response::errorCatch($e);
        }
    }

    public function edit($id) {
        $user = User::where('id', $id)->first();
        if (!$user) return Response::error(null, 'User not found!');
        return Response::success($user, 'Success');
    }

    public function update(Request $request, $id) {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $id . ',id'
        ], [
            'name.required' => 'Nama harus diisi.',
            'email.required' => 'Email harus diisi.',
            'email.email' => 'Email tidak valid.',
            'email.unique' => 'Email sudah terdaftar.'
        ]);

        try {
            $user = User::where('id', $id)->first();
            if (!$user) return Response::error(null, 'User not found!');
            $user->name = $request->name;
            $user->email = $request->email;
            $user->save();

            return Response::success(null, 'User successfully updated!');
        } catch (\Exception $e) {
            return Response::errorCatch($e);
        }
    }
}

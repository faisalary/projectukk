<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use App\Models\Role;
use App\Models\Permission;
use Illuminate\Support\Facades\Validator;
use LDAP\Result;
use Yajra\DataTables\Contracts\DataTable;
use Yajra\DataTables\Facades\DataTables;

class KonfigurasiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
         $this->middleware('permission:superadmin|role-list|role-create|role-edit|role-delete', ['only' => ['index','store']]);
         $this->middleware('permission:superadmin|role-create', ['only' => ['create','store']]);
         $this->middleware('permission:superadmin|role-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:superadmin|role-delete', ['only' => ['destroy']]);
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request){
        $permissions = Permission::get();
        $role = Role::latest()->get();
        return view('konfigurasi.konfigurasi', compact('role', 'permissions'));
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Request $id)
    {
        $role = Role::orderBy('name', 'asc')
            ->get();
            return DataTables::of($role)
            ->addIndexColumn()
            ->editColumn('status', function ($role) {
                if ($role->status == 1) {
                    return "<div class='text-center'><div class='badge rounded-pill bg-label-success'>" . "Active" . "</div></div>";
                } else {
                    return "<div class='text-center'><div class='badge rounded-pill bg-label-danger'>" . "Inactive" . "</div></div>";
                }
            })
            ->addColumn('action', function ($row) {
                $icon = ($row->status) ? "ti-circle-x" : "ti-circle-check";
                $color = ($row->status) ? "danger" : "success";
    
                $btn = "<a data-bs-toggle='modal' data-bs-target='#modal-konfigurasi' data-id='{$row->name}' onclick=edit($(this)) class='btn-icon text-warning waves-effect waves-light'><i class='tf-icons ti ti-edit' ></i>
                <a data-status='{$row->status}' data-id='{$row->name}' data-url='konfigurasi/status' class='btn-icon update-status text-{$color} waves-effect waves-light'><i class='tf-icons ti {$icon}'></i></a>";
    
                return $btn;
            })
            ->rawColumns(['action','status'])
            ->make(true);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        //
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->only('name', 'permission_id');
        $validatedData = Validator::make($data, [
            'name' => 'required|max:191|unique:roles'
        ]);
        if ($validatedData->fails()) {
            $messages = $validatedData->getMessageBag()->get('name');
            return response()->json(['error' => true, 'message' => $messages[0]], 400);
        }

        $permission_id = $request->permission_id;

        $result = Role::create([
            'name' => $request->name,
            'guard_name' => 'web'
        ]);

        foreach ($permission_id as $key => $value) {
            $prevent = RoleHas::where('permission_id', $value)->where('role_id', $result->id);

            if ($prevent->get()->isEmpty()) {
                $rhp = new RoleHas();
                $rhp->permission_id = $value;
                $rhp->role_id = $result->id;
                $rhp->save();
            } else {
                $already = $prevent->first();
                $already->save();
            }
        }

        Artisan::call('cache:clear');

        return response()->json(["error" => false, "message" => "Successfully Added Role!"], 201);
    }
}

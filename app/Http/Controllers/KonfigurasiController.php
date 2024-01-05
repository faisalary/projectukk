<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\RoleHasPermissions;
use Illuminate\Support\Facades\Validator;
use LDAP\Result;

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
        $roles = Role::latest()->get();
        return view('konfigurasi.konfigurasi', compact('roles', 'permissions'));

        // $roles = Role::orderBy('uuid','DESC')->paginate(5);
        // return view('konfigurasi.konfigurasi',compact('roles'))
        //     ->with('i', ($request->input('page', 1) - 1) * 5);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        //
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

        $role = Role::create(['name' => $request->input('name')]);
        $role->syncPermissions($request->input('permission'));
    
        return redirect()->route('roles.index')
                         ->with('success','Role created successfully');
        
        Artisan::call('cache:clear');

        return response()->json(["error" => false, "message" => "Successfully Added Role!"], 201);
       
    }
}

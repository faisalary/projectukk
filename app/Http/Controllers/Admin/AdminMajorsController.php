<?php

namespace App\Http\Controllers\Admin;

use App\MasterMajor;
use Illuminate\Http\Request;
use Froiden\Envato\Helpers\Reply;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;

class AdminMajorsController extends AdminBaseController
{
    public function __construct()
    {
        parent::__construct();
        $this->pageTitle = __('Majors');
        $this->pageIcon = 'icon-location-pin';
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        abort_if(! $this->user->can('manage_master_data'), 403);

        return view('admin.majors.index', $this->data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        abort_if(! $this->user->can('manage_master_data'), 403);

        return view('admin.majors.create', $this->data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        abort_if(! $this->user->can('manage_master_data'), 403);

        $names = $request->majors;

        if (trim($names[0]) == '') {
            return Reply::error(__('errors.addMajor'));
        }

        foreach ($names as $name) {
            if (is_null($name)) {
                return Reply::error(__('errors.addMajor'));
            }
        }

        foreach ($names as $key => $name):
            if(!is_null($name)){
                MasterMajor::create(['major' => $name]);
            }
        endforeach;

        return Reply::redirect(route('admin.majors.index'), __('menu.masterMajors').' '.__('messages.createdSuccessfully'));
    }

    public function data() {
        abort_if(! $this->user->can('manage_master_data'), 403);

        $major = MasterMajor::all();

        return DataTables::of($major)
            ->addColumn('action', function ($row) {
                $action = '';

                if( $this->user->can('manage_master_data')){
                    $action.= '<a href="' . url('admin/majors/'.$row->master_major_id.'/edit') . '" class="btn btn-primary btn-circle"
                      data-toggle="tooltip" data-original-title="'.__('app.edit').'"><i class="fa fa-pencil" aria-hidden="true"></i></a>';
                }

                if( $this->user->can('manage_master_data')){
                    $action.= ' <a href="javascript:;" class="btn btn-danger btn-circle sa-params"
                      data-toggle="tooltip" data-row-id=' . $row->master_major_id . ' data-original-title="'.__('app.delete').'"><i class="fa fa-times" aria-hidden="true"></i></a>';
                }
                return $action;
            })
            ->editColumn('major', function ($row) {
                return ucwords($row->major);
            })
            ->addIndexColumn()
            ->make(true);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        abort_if(! $this->user->can('manage_master_data'), 403);

        $this->majors = MasterMajor::find($id);
        return view('admin.majors.edit', $this->data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        abort_if(! $this->user->can('manage_master_data'), 403);

        $request->validate([
            'major_name' => 'required',
        ]);

        $masterMajor = MasterMajor::where('master_major_id',$id)->update([
            'major' => $request->major_name,
        ]);

        return Reply::redirect(route('admin.majors.index'), __('menu.masterMajors').' '.__('messages.updatedSuccessfully'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        abort_if(! $this->user->can('manage_master_data'), 403);

        MasterMajor::where('master_major_id',$id)->delete();

        return Reply::success(__('messages.recordDeleted'));
    }
}

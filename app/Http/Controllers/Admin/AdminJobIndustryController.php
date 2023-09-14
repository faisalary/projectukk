<?php

namespace App\Http\Controllers\Admin;

use App\Helper\Reply;
use App\Http\Requests\StoreJobCategory;
use App\JobIndustry;
use Yajra\DataTables\Facades\DataTables;

class AdminJobIndustryController extends AdminBaseController
{

    public function __construct()
    {
        parent::__construct();
        $this->pageTitle = __('menu.jobIndustries');
        $this->pageIcon = 'icon-grid';
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        abort_if(! $this->user->can('manage_master_data'), 403);

        return view('admin.job-industry.index', $this->data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        abort_if(! $this->user->can('manage_master_data'), 403);

        return view('admin.job-industry.create', $this->data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreJobCategory $request)
    {
        abort_if(! $this->user->can('manage_master_data'), 403);

        $names = $request->name;

        if (trim($names[0]) == '') {
            return Reply::error(__('errors.addIndustry'));
        }

        foreach ($names as $name) {
            if (is_null($name)) {
                return Reply::error(__('errors.addIndustry'));
            }
        }

        foreach ($names as $key => $name):
            if(!is_null($name)){
                JobIndustry::create(['name' => $name]);
            }
        endforeach;

        return Reply::redirect(route('admin.job-industries.index'), __('menu.jobIndustries').' '.__('messages.createdSuccessfully'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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

        $this->industry = JobIndustry::find($id);
        return view('admin.job-industry.edit', $this->data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreJobCategory $request, $id)
    {
        abort_if(! $this->user->can('manage_master_data'), 403);

        $industry = JobIndustry::find($id);
        $industry->name = $request->name;
        $industry->save();

        return Reply::redirect(route('admin.job-industries.index'), __('menu.jobIndustries').' '.__('messages.updatedSuccessfully'));
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

        JobIndustry::destroy($id);
        return Reply::success(__('messages.recordDeleted'));
    }

    public function data() {
        abort_if(! $this->user->can('manage_master_data'), 403);

        $industries = JobIndustry::all();

        return DataTables::of($industries)
            ->addColumn('action', function ($row) {
                $action = '';

                if( $this->user->can('manage_master_data')){
                    $action.= '<a href="' . route('admin.job-industries.edit', [$row->id]) . '" class="btn btn-primary btn-circle"
                      data-toggle="tooltip" data-original-title="'.__('app.edit').'"><i class="fa fa-pencil" aria-hidden="true"></i></a>';
                }

                if( $this->user->can('manage_master_data')){
                    $action.= ' <a href="javascript:;" class="btn btn-danger btn-circle sa-params"
                      data-toggle="tooltip" data-row-id="' . $row->id . '" data-original-title="'.__('app.delete').'"><i class="fa fa-times" aria-hidden="true"></i></a>';
                }
                return $action;
            })
            ->editColumn('name', function ($row) {
                return ucfirst($row->name);
            })
            ->addIndexColumn()
            ->make(true);
    }
}

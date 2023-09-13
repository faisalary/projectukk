<?php

namespace App\Http\Controllers\Admin;

use App\ApplicationStatus;
use App\Helper\Files;
use App\Helper\Reply;
use App\Company;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Requests\Company\StoreCompany;
use App\Job;
use App\JobApplication;
use Illuminate\Http\Request;

class AdminCompanyController extends AdminBaseController
{

    public function __construct()
    {
        parent::__construct();
        $this->pageTitle = __('menu.companies');
        $this->pageIcon = 'icon-film';
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        abort_if(!$this->user->can('manage_master_data'), 403);

        $this->totalCompanies = Company::count();
        $this->activeCompanies = Company::where('status', 'active')->count();
        $this->inactiveCompanies = Company::where('status', 'inactive')->count();
        return view('admin.company.index', $this->data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        abort_if(!$this->user->can('manage_master_data'), 403);
        return view('admin.company.create', $this->data);
    }

    /**
     * @param StoreCompany $request
     * @return array
     * @throws \Exception
     */
    public function store(StoreCompany $request)
    {
        abort_if(!$this->user->can('manage_master_data'), 403);
        $data = $request->all();

        if ($request->hasFile('logo')) {
            $data['logo'] = Files::upload($request->logo, 'company-logo');
        }else{
            unset($data['logo']);
        }

        Company::create($data);

        return Reply::redirect(route('admin.company.index'), __('menu.companies') . ' ' . __('messages.createdSuccessfully'));
    }

    public function edit($id)
    {
        abort_if(!$this->user->can('manage_master_data'), 403);

        $this->company = Company::find($id);
        return view('admin.company.edit', $this->data);
    }

    /**
     * @param StoreCompany $request
     * @param $id
     * @return array
     * @throws \Exception
     */
    public function update(StoreCompany $request, $id)
    {
        abort_if(!$this->user->can('manage_master_data'), 403);

        $data =  $request->all();

        $setting = Company::findOrFail($id);

        if ($request->hasFile('logo')) {
            $data['logo'] = Files::upload($request->logo, 'company-logo');
        }else{
            unset($data['logo']);
        }

        $setting->update($data);

        //update company's jobs status
        if($setting->status != $request->input('status')) {
            Job::where('company_id', $id)->update(['status' => $request->status]);
        }

        return Reply::redirect(route('admin.company.index'), __('menu.companies') . ' ' . __('messages.updatedSuccessfully'));
    }

    /**
     * @param $id
     * @return array
     */
    public function destroy($id)
    {
        abort_if(!$this->user->can('manage_master_data'), 403);

        Company::destroy($id);
        return Reply::success(__('messages.recordDeleted'));
    }

    public function data(Request $request)
    {
        abort_if(!$this->user->can('manage_master_data'), 403);

        $categories = Company::all();
        $urlEdit = $request->segment(2);

        return DataTables::of($categories)
            ->editColumn('company_name', function ($row) {
                return ucfirst($row->company_name);
            })
            ->editColumn('status', function ($row) {
                if($row->status == 'active'){
                    return '<label class="badge bg-success">'.__('app.active').'</label>';
                }
                if($row->status == 'inactive'){
                    return '<label class="badge bg-danger">'.__('app.inactive').'</label>';
                }
             })
             ->addColumn('total_jobs', function ($row) {
                return count($row->jobs);
             })
             ->addColumn('total_applicants', function ($row) {
                return count($row->job_applications);
             })
            ->addColumn('action', function ($row) use($urlEdit) {
                $action = '';

                if ($this->user->can('manage_master_data')) {
                    $action .= '<a href="' . route('admin.company.show', [$row->id]) . '" class="btn btn-primary btn-circle"
                        data-toggle="tooltip" data-original-title="' . __('app.allJobs') . '"><i class="fa fa-list" aria-hidden="true"></i></a>';
                }
                
                if ($this->user->can('manage_master_data')) {
                    $action .= '<a href="' . route('admin.'.$urlEdit.'.edit', [$row->id]) . '" class="ml-1 btn btn-warning btn-circle"
                      data-toggle="tooltip" data-original-title="' . __('app.edit') . '"><i class="fa fa-pencil" aria-hidden="true"></i></a>';
                }

                if ($this->user->can('manage_master_data')) {
                    $action .= ' <a href="javascript:;" class="btn btn-danger btn-circle sa-params"
                      data-toggle="tooltip" data-row-id="' . $row->id . '" data-original-title="' . __('app.delete') . '"><i class="fa fa-trash-o" aria-hidden="true"></i></a>';
                }
                return $action;
            })
            ->addIndexColumn()
            ->rawColumns(['logo', 'action', 'status'])
            ->make(true);
    }

    public function show($id)
    {
        abort_if(!$this->user->can('manage_master_data'), 403);

        $this->company = Company::find($id);
        if(Company::find($id) == null){
            return redirect(route('admin.company.index'));
        }
        return view('admin.company.show', $this->data);
    }

    public function dataJobs($id)
    {
        abort_if(!$this->user->can('manage_master_data'), 403);

        $company = Company::find($id);
        if(Company::find($id) == null){
            return redirect(route('admin.company.index'));
        }
        $jobs = Job::where('company_id', $company->id)->get();

        return DataTables::of($jobs)
            ->addColumn('category_name', function ($row) {
                return $row->category->name;
            })
            ->addColumn('jobs', function ($row) use($company) {
                $html = '<a href="'.route('admin.company.job-applications', [$company->id, $row->id]).'">'.
                '<div class="card">'.
                            '<div class="card-body">'.
                                '<div class="w-100">'.
                                    '<div class="row mx-2">'.
                                        '<div>'.
                                            '<h4 class="title mb-0" style="font-size: 20px;">'.$row->title.'</h4>'.
                                            '<p>'.$row->category->name.'</p>'.
                                        '</div>'.
                                        '<div class="ml-auto">';
                if($row->status == 'active'){
                    $html .= '<label class="badge bg-success" style="font-size: 15px;">'.$row->status.'</label>';
                }
                else{
                    $html .= '<label class="badge bg-danger" style="font-size: 15px;">'.$row->status.'</label>';
                }
                $html .= '</div>'.
                                    '</div>'.
                                '</div>'.
                                '<div class="w-100 mt-4 mb-5">'.
                                    '<div class="row d-flex align-content-center justify-content-center">'.
                                        '<div class="col-lg-2 col-md-4 col-sm-6">'.
                                            '<div class="info-box-content">'.
                                                '<span class="info-box-number d-flex align-content-center justify-content-center" style="font-size: 20px;">'.count($row->applications).'</span>'.
                                                '<span class="info-box-text d-flex align-content-center justify-content-center">total</span>'.
                                            '</div>'.
                                        '</div>';

                $status = ApplicationStatus::all();
                foreach ($status as $value) {
                    $status_total = JobApplication::where([['job_id', $row->id],['status_id', $value->id]])->count();

                    $html .= '<div class="col-lg-2 col-md-4 col-sm-6">'.
                                '<div class="info-box-content">'.
                                    '<span class="info-box-number d-flex align-content-center justify-content-center" style="font-size: 20px;">'.$status_total.'</span>'.
                                    '<span class="info-box-text d-flex align-content-center justify-content-center">'.$value->status.'</span>'.
                                '</div>'.
                            '</div>';
                }
                $html .=        '</div>'.
                            '</div>'.
                            '<div class="row mx-2">'.
                                '<div>'.
                                    '<div class="w-100 d-flex align-content-center">'.
                                        '<i class="material-symbols-outlined" style="font-size: 20px;">person</i>'.
                                        '<span class="mx-2"> Required: '.$row->total_positions.' person</span>'.
                                    '</div>'.
                                    '<div class="w-100 d-flex align-content-center">'.
                                        '<i class="material-symbols-outlined" style="font-size: 20px;">date_range</i>'.
                                        '<span class="mx-2">'.$row->start_date->format('d M Y').' - '.$row->end_date->format('d M Y').'</span>'.
                                    '</div>'.
                                '</div>'.
                                '<div class="ml-auto d-flex">'.
                                    '<a href="'.route('admin.company.job-applications', [$company->id, $row->id]).'" style="display: flex; align-items: center; justify-content: center;">'.
                                        '<button type="button" class="btn d-flex align-content-center justify-content-center" style="background-color: #EFEFEF; font-size: 13px;">'.
                                        'Details'.
                                        '</button>'.
                                    '</a>'.
                                '</div>'.
                            '</div>'.
                        '</div>'.
                    '</div>'.'</a>';

                return $html;
            })
            ->rawColumns(['jobs'])
            ->make(true);
    }
}

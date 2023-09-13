<?php

namespace App\Http\Controllers\Admin;

use App\ProfileUser;
use Yajra\DataTables\Facades\DataTables;
use App\User;
use Illuminate\Http\Request;

class AdminCandidateDatabaseController extends AdminBaseController
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
        $this->users = User::whereHas(
                            'roles', function($q){
                                $q->where('name', 'applicant');
                            }
                        )->get();
        return view('admin.candidate.index', $this->data);
    }

    public function data() {
        $users = User::whereHas(
                    'roles', function($q){
                        $q->where('name', 'applicant');
                    }
                )->get();

        return DataTables::of($users)
            ->addColumn('action', function ($row) {
                if($row->profile){
                    return '<a href="' . route('admin.candidate.show', [$row->profile->id]) . '" class="btn btn-primary btn-circle"
                    data-toggle="tooltip" data-original-title="' . 'Details' . '"><i class="fa fa-list" aria-hidden="true"></i></a>';
                }
                else{
                    return '-';
                }
            })
            ->addColumn('location', function ($row) {
                if($row->profile){
                    return $row->profile->city.', '.$row->profile->country;
                }
                else{
                    return '-';
                }
            })
            ->editColumn('name', function ($row) {
                return '<div class="image-container"><div class="image"><img src='.$row->profile_image_url.' /></div>'.ucwords($row->name).'</div>';
            })
            ->addColumn('skills', function ($row) {
                if($row->profile){
                    $skills = $row->profile->skills;
                    $html = '<div class="row">'.
                                '<div class="col-12">'.
                                    '<div>';
                    if($skills && count($skills) > 0){
                        foreach($skills as $key => $skill){
                            $html .= '<label class="m-1 badge bg-primary" style="font-size: 14px;">'.$skill->skill->name.'</label>';
                        }
                    }
                    else{
                        $html .= '<div class="w-100">Empty</div>';
                    }
                    $html .= '</div>'.
                                '</div>'.
                            '</div>';
                    return $html;
                }
                else{
                    return '-';
                }
            })
            ->addColumn('experience', function ($row) {
                if($row->profile){
                    return ($row->profile->experiences && count($row->profile->experiences) > 0) ? 'Experienced' : 'Unexperienced';
                }
                else{
                    return '-';
                }
                
            })
            ->rawColumns(['name', 'location', 'skills', 'experience', 'action'])
            ->addIndexColumn()
            ->make(true);
    }

    public function show($id)
    {
        $this->application = ProfileUser::with(['user', 'experiences', 'educations', 'skills'])->find($id);

        return view('admin.candidate.show', $this->data);
    }
}

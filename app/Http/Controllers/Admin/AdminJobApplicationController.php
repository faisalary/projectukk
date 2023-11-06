<?php

namespace App\Http\Controllers\Admin;

use App\Job;
use App\User;
use App\Skill;
use Carbon\Carbon;
use App\JobIndustry;
use App\JobLocation;
use App\MasterMajor;
use App\Helper\Files;
use App\Helper\Reply;
use App\JobApplication;
use App\ApplicationStatus;
use App\InterviewSchedule;
use App\ApplicationSetting;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use App\JobApplicationAnswer;
use App\JobApplicationEducation;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\JobApplicationExport;
use Illuminate\Support\Facades\Storage;
use App\Notifications\ScheduleInterview;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Requests\StoreJobApplication;
use Maatwebsite\Excel\Excel as ExcelExcel;
use App\Http\Requests\UpdateJobApplication;
use App\Notifications\CandidateStatusChange;
use Illuminate\Support\Facades\Notification;
use App\Notifications\CandidateScheduleInterview;
use App\Http\Requests\InterviewSchedule\StoreRequest;
use App\ProfileUser;

class AdminJobApplicationController extends AdminBaseController
{
    public function __construct()
    {
        parent::__construct();
        $this->pageTitle = __('menu.jobApplications');
        $this->pageIcon = 'icon-user';
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function table(Request $request, $company_id = null, $job_id = null)
    {
        abort_if(!$this->user->can('view_job_applications'), 403);

        $this->company_id = $company_id;
        $this->job_id = $job_id;

        $this->boardColumns = ApplicationStatus::all();
        $this->locations = JobLocation::all();
        $this->jobs = Job::all();
        $this->skills = Skill::all();
        return view('admin.job-applications.index', $this->data);
    }

    public function data(Request $request, $company_id = null, $job_id = null)
    {
        abort_if(!$this->user->can('view_job_applications'), 403);

        $jobApplications = JobApplication::select('id', 'user_id', 'job_id', 'status_id')
            ->with([
                'user:id,name',
                'job:id,location_id,title',
                'job.skills',
                'job.location:id,location',
                'status:id,status'
            ])
            ->where('job_id', $job_id);
        
        // // Filter by status
        // if ($request->status != 'all' && $request->status != '') {
        //     $jobApplications = $jobApplications->where('status_id', $request->status);
        // }

        // // Filter By jobs
        // if ($request->jobs != 'all' && $request->jobs != '') {
        //     $jobApplications = $jobApplications->where('job_id', $request->jobs);
        // }

        // // Filter By skills
        // if ($request->skill != 'all' && $request->skill != '') {
        //     foreach (explode(',', $request->skill) as $key => $skill) {
        //         if ($key == 0) {
        //             $jobApplications = $jobApplications->whereJsonContains('skills', $skill);
        //         }
        //         else {
        //             $jobApplications = $jobApplications->orWhereJsonContains('skills', $skill);
        //         }
        //     }
        // }
        
        // // Filter by location
        // if ($request->location != 'all' && $request->location != '') {
        //     $jobApplications = $jobApplications->whereHas('job.location', function ($query) use ($request)
        //     {
        //         $query->where('location', $request->location);
        //     });
        // }

        // // Filter by StartDate
        // if ($request->startDate != null && $request->startDate != '') {
        //     $jobApplications = $jobApplications->whereDate('created_at', '>=', $request->startDate);
        // }

        // // Filter by EndDate
        // if ($request->endDate != null && $request->endDate != '') {
        //     $jobApplications = $jobApplications->whereDate('created_at', '<=', $request->endDate);
        // }

        // //Filter by grad year
        // if ($request->startYear != '') {
        //     $jobApplications = $jobApplications->where('grad_year', '>=', $request->startYear);
        // }
        // if ($request->endYear != '') {
        //     $jobApplications = $jobApplications->where('grad_year', '<=', $request->endYear);
        // }
        // //Filter by gpa
        // if ($request->startGpa != '') {
        //     $jobApplications = $jobApplications->where('gpa', '>=', $request->startGpa);
        // }
        // if ($request->endGpa != '') {
        //     $jobApplications = $jobApplications->where('gpa', '<=', $request->endGpa);
        // }

        $jobApplications = $jobApplications->get();
        $boardColumns = ApplicationStatus::all();
        $appStatus = '';
        foreach ($boardColumns as $status) {
            $appStatus .= '<option value="' . $status->id . '"' . ($request->status == $status->id ? 'selected' : '') . '>' . ucwords($status->status) . '</option>';
        }

        return DataTables::of($jobApplications)
            // ->addColumn('action', function ($row) {
            //     $action = '';
                
            //     if ($this->user->can('view_job_applications')) {
            //         $action .= '<a href="javascript:;" class="btn btn-success btn-circle show-document"
            //           data-toggle="tooltip" data-row-id="' . $row->id . '" data-modal-name="' . '\\' . get_class($row) . '" data-original-title="' . __('modules.jobApplication.viewDocuments') . '"><i class="fa fa-search" aria-hidden="true"></i></a>';
            //         $action .= ' <a href="javascript:;" class="btn btn-secondary btn-circle show-exp"
            //           data-toggle="tooltip" data-row-id="' . $row->id . '" data-modal-name="' . '\\' . get_class($row) . '" data-original-title="' . __('modules.jobApplication.viewExp') . '"><i class="fa fa-laptop" aria-hidden="true"></i></a>';
            //     }

            //     // if ($this->user->can('edit_job_applications')) {
            //     //     $action .= ' <a href="' . route('admin.job-applications.edit', [$row->id]) . '" class="btn btn-primary btn-circle"
            //     //       data-toggle="tooltip" data-original-title="' . __('app.edit') . '"><i class="fa fa-pencil" aria-hidden="true"></i></a>';
            //     // }

            //     if ($this->user->can('delete_job_applications')) {
            //         $action .= ' <a href="javascript:;" class="btn btn-danger btn-circle sa-params"
            //           data-toggle="tooltip" data-row-id="' . $row->id . '" data-original-title="' . __('app.delete') . '"><i class="fa fa-times" aria-hidden="true"></i></a>';
            //     }
            //     return $action;
            // })
            ->editColumn('name', function ($row) use ($company_id, $job_id) {
                return '<a href="javascript:;" class="show-detail" data-widget="control-sidebar" data-slide="true" data-row-id="' . $row->id . '" data-company-id="' . $company_id . '" data-job-id="' . $job_id . '">' . ucwords($row->user->name) . '</a>';
            })
            ->editColumn('title', function ($row) {
                return ucfirst($row->job->title);
            })
            ->editColumn('location', function ($row) {
                return ucwords($row->job->location->location);
            })
            ->editColumn('status', function ($row) {
                return ucwords($row->status->status);
            })
            ->rawColumns(['action', 'name', 'status'])
            ->addIndexColumn()
            ->make(true);
    }

    public function index(Request $request, $company_id = null, $job_id = null)
    {
        abort_if(!$this->user->can('view_job_applications'), 403);

        $date = Carbon::now();
        $startDate = $date->subDays(30)->format('Y-m-d');
        $endDate = Carbon::now()->format('Y-m-d');
        // $this->jobs = Job::all();
        $this->company_id = $company_id;
        $this->job_id = $job_id;
        $this->language_names = json_decode(file_get_contents(public_path('/json/languages.json')), true)['results'];

        $boardColumns = ApplicationStatus::with(['applications' => function ($q) use ($startDate, $endDate, $request, $job_id) {

            if($job_id) {
                if(!Job::find($job_id)){
                    return view('admin.company.index');
                }
                $q = $q->where('job_applications.job_id', $job_id);
            }

            // filter education
            if ($request->filter_degree !=null && $request->filter_degree != '') {
                $q = $q->whereHas('educations', function ($query) use ($request) {
                    $query->where('degree', $request->filter_degree);
                });
            }

            // filter industries
            if ($request->filter_industri !=null && $request->filter_industri != '') {
                $q = $q->whereHas('experiences', function ($query) use ($request) {
                    $query->where('industry_id', $request->filter_industri);
                });
            }

            // filter language 
            if ($request->filter_language !=null && $request->filter_language != '') {
                // $q = $q->whereHas('languages', function ($query) use ($request) {
                //     $query->where('name', $request->filter_language);
                // });

                $language = explode(",",$request->filter_language);

                $q = $q->whereHas('languages', function ($query) use ($request,$language) {
                    $query = $query->where('name', $language[0]);
                    foreach ($language as $key => $value) {
                        if($key != 0){
                            $query = $query->orWhere('name', $language[$key]);
                        }
                    }
                });
            }

            //filter min salary & max salary
            if ($request->filter_min_salary !=null && $request->filter_min_salary != '') {
                
                $profile = ProfileUser::whereHas('information', function ($query) use ($request){
                    $query->where('expected_salary_value','>=', doubleval($request->filter_min_salary));
                })->get();

                $q = $q->whereIn('user_id', $profile->pluck('user_id'));

            }
            if ($request->filter_max_salary !=null && $request->filter_max_salary != '') {
                $profile2 = ProfileUser::whereHas('information', function ($query) use ($request){
                    $query->where('expected_salary_value','<=', doubleval($request->filter_max_salary));
                })->get();
                $noInformationProfile = ProfileUser::whereDoesntHave('information')->get();
                $q = $q->whereIn('user_id', $profile2->pluck('user_id')->merge($noInformationProfile->pluck('user_id')));
            }

            // filter by skill 
            if ($request->filter_skill !=null && $request->filter_skill != '') {
                $skill = explode(",",$request->filter_skill);

                $q = $q->whereHas('skills', function ($query) use ($request,$skill) {
                    $query = $query->where('skill_id', $skill[0]);
                    foreach ($skill as $key => $value) {
                        if($key != 0){
                            $query = $query->orWhere('skill_id', $skill[$key]);
                        }
                    }
                });
            }

            // filter by major 
            if($request->filter_major != null && $request->filter_major != ''){
                $major = explode(",",$request->filter_major);

                $q = $q->whereHas('educations', function ($query) use ($request,$major) {
                    $query = $query->where('study',"like", '%'.$major[0].'%');
                    foreach ($major as $key => $value) {
                        if($key != 0){
                            $query = $query->orWhere('study',"like",'%'.$major[$key].'%');
                        }
                    }
                });
            }

            // filter by area 
            if($request->filter_areas != null && $request->filter_areas != ''){
                $q = $q->whereHas('user.profile.information', function ($query) use ($request) {
                    $query->where('preferred_city','like','%'.$request->filter_areas.'%');
                });


            }

            // filter experience 
            if ($request->filter_experience !=null && $request->filter_experience != '') {
                if ($request->filter_experience == 'experienced'){
                    $q = $q->whereHas('experiences');
                }elseif ($request->filter_experience == 'unexperienced'){
                    $q = $q->whereDoesntHave('experiences');
                }
            }
            
            if ($request->startDate !== null && $request->startDate != 'null' && $request->startDate != '') {
                $q = $q->where(DB::raw('DATE(job_applications.`created_at`)'), '>=', $request->startDate);
            } 
            // else {
            //     $q = $q->where(DB::raw('DATE(job_applications.`created_at`)'), '>=', $startDate);
            // }

            if ($request->endDate !== null && $request->endDate != 'null' && $request->endDate != '') {
                $q = $q->where(DB::raw('DATE(job_applications.`created_at`)'), '<=', $request->endDate);
            } else {
                $q = $q->where(DB::raw('DATE(job_applications.`created_at`)'), '<=', $endDate);
            }

            // Filter By jobs
            if ($request->jobs != 'all' && $request->jobs != '') {
                $q = $q->where('job_applications.job_id', $request->jobs);
            }
            // Filter by EndDate
            if ($request->search != null && $request->search != '') {
                $q = $q->whereHas("user", function ($query) use ($request) {
                    return $query->where('name', 'LIKE', '%' . $request->search . '%');
                });
            }
            //Filter by grad year
            if ($request->startYear != '') {
                $q = $q->where('grad_year', '>=', $request->startYear);
            }
            if ($request->endYear != '') {
                $q = $q->where('grad_year', '<=', $request->endYear);
            }
            //Filter by gpa
            if ($request->startGpa != '') {
                $q = $q->where('gpa', '>=', $request->startGpa);
            }
            if ($request->endGpa != '') {
                $q = $q->where('gpa', '<=', $request->endGpa);
            }

        }, 'applications.schedule']);

        // Filter by status 
        if ($request->filter_status != '') {
            $boardColumns = $boardColumns->where('id',$request->filter_status);
        }
        $this->boardColumns = $boardColumns->orderBy('position')->get();

        $boardStracture = [];
        foreach ($this->boardColumns as $key => $column) {
            $boardStracture[$column->id] = [];
            foreach ($column->applications as $application) {
                $boardStracture[$column->id][] = $application->id;
            }
        }
        $this->boardStracture = json_encode($boardStracture);
        $this->currentDate = Carbon::now()->timestamp;

        $this->startDate = $startDate;
        $this->endDate = $endDate;

        $jobApplication = JobApplication::with(['educations' => function($q){
            $q->orderBy('end_date','desc');
        }])->where('job_id',$job_id)->get();

        // dd($jobApplication);

        if ($request->ajax()) {
            $view = view('admin.job-applications.board-data', $this->data , compact('jobApplication'))->render();
            return Reply::dataOnly(['view' => $view]);
        }

        $this->mailSetting = ApplicationSetting::select('id', 'mail_setting')->first();

        $this->majors = MasterMajor::all();
        $this->skills = Skill::all();
        $this->industries = JobIndustry::all();
        $this->areas = JobLocation::all();

        return view('admin.job-applications.board', $this->data);
    }

    public function create()
    {
        abort_if(!$this->user->can('add_job_applications'), 403);

        $this->jobs = Job::activeJobs();
        $this->gender = [
            'male' => __('modules.front.male'),
            'female' => __('modules.front.female'),
            'others' => __('modules.front.others')
        ];
        return view('admin.job-applications.create', $this->data);
    }

    /**
     * @param $jobID
     * @return mixed
     * @throws \Throwable
     */
    public function jobQuestion($jobID, $applicationId = null)
    {        
        $this->job = Job::findOrFail($jobID);
        $this->jobQuestion = $this->job->questions()->with([
            'answers' => function ($query) use ($jobID, $applicationId){
                $query->where(['job_application_id' => $applicationId, 'job_id' => $jobID]);
            }
        ])->get();
        $this->gender = [
            'male' => __('modules.front.male'),
            'female' => __('modules.front.female'),
            'others' => __('modules.front.others')
        ];

        $view = view('admin.job-applications.job-question', $this->data)->render();
        
        $options = ['job' => $this->job, 'gender' => $this->gender];
        $sections = ['section_visibility' => $this->job->section_visibility];

        if ($applicationId) {
            $application = JobApplication::select('id', 'gender', 'dob', 'country', 'state', 'city', 'cover_letter')->where('id', $applicationId)->first();

            $options = Arr::add($options, 'application', $application);
            $sections = Arr::add($sections, 'application', $application);
        }

        $requiredColumnsView = view('admin.job-applications.required-columns', $options)->render();
        $requiredSectionsView = view('admin.job-applications.required-sections', $sections)->render();
        
        $count = count($this->jobQuestion);
        
        $data = ['status' => 'success', 'view' => $view, 'requiredColumnsView' => $requiredColumnsView, 'requiredSectionsView' => $requiredSectionsView, 'count' => $count];
        
        if ($applicationId) {
            $data = Arr::add($data, 'application', $application);
        }

        return Reply::dataOnly($data);
    }


    public function edit($id)
    {
        abort_if(!$this->user->can('edit_job_applications'), 403);

        $this->statuses = ApplicationStatus::all();
        $this->application = JobApplication::find($id);
        $this->jobQuestion = $this->application->job->questions;
        $this->jobs = Job::select('id', 'title', 'location_id', 'status', 'start_date', 'end_date', 'section_visibility')->with('location:id,location')->get();

        return view('admin.job-applications.edit', $this->data);
    }

    public function createSchedule(Request $request, $id)
    {
        abort_if(!$this->user->can('add_schedule'), 403);
        $this->candidates = JobApplication::all();
        $this->users = User::all();
        $this->scheduleDate = $request->date;
        $this->currentApplicant = JobApplication::findOrFail($id);
        return view('admin.job-applications.interview-create', $this->data)->render();
    }

    public function storeSchedule(StoreRequest $request)
    {
        abort_if(!$this->user->can('add_schedule'), 403);

        $dateTime = $request->scheduleDate . ' ' . $request->scheduleTime;
        $dateTime = Carbon::createFromFormat('Y-m-d H:i', $dateTime);

        // store Schedule
        $interviewSchedule = new InterviewSchedule();
        $interviewSchedule->job_application_id = $request->candidates[0];
        $interviewSchedule->schedule_date = $dateTime;
        $interviewSchedule->save();

        // Update Schedule Status
        $status = ApplicationStatus::where('status', 'interview')->first();
        $jobApplication = $interviewSchedule->jobApplication;
        $jobApplication->status_id = $status->id;
        $jobApplication->save();

        if($request->comment){
            $scheduleComment = [
                'interview_schedule_id' => $interviewSchedule->id,
                'user_id' => $this->user->id,
                'comment' => $request->comment
            ];

            $interviewSchedule->comments()->create($scheduleComment);
        }

        if (!empty($request->employees)) {
            $interviewSchedule->employees()->attach($request->employees);

            // Mail to employee for inform interview schedule
            Notification::send($interviewSchedule->employees, new ScheduleInterview($jobApplication));
        }

        // mail to candidate for inform interview schedule
        Notification::send($jobApplication, new CandidateScheduleInterview($jobApplication, $interviewSchedule));

        return Reply::redirect(route('admin.interview-schedule.index'), __('menu.interviewSchedule') . ' ' . __('messages.createdSuccessfully'));
    }


    public function store(StoreJobApplication $request)
    {
        abort_if(!$this->user->can('add_job_applications'), 403);

        $jobApplication = new JobApplication();
        $jobApplication->full_name = $request->full_name;
        $jobApplication->job_id = $request->job_id;
        $jobApplication->status_id = 1; //applied status id
        $jobApplication->email = $request->email;
        $jobApplication->phone = $request->phone;
        $jobApplication->cover_letter = $request->cover_letter;
        $jobApplication->column_priority = 0;

        if ($request->has('gender')) {
            $jobApplication->gender = $request->gender;
        }
        if ($request->has('dob')) {
            $jobApplication->dob = $request->dob;
        }
        if ($request->has('country')) {
            $countriesArray = json_decode(file_get_contents(public_path('country-state-city/countries.json')), true)['countries'];
            $statesArray = json_decode(file_get_contents(public_path('country-state-city/states.json')), true)['states'];

            $jobApplication->country = $this->getName($countriesArray, $request->country);
            $jobApplication->state = $this->getName($statesArray, $request->state);
            $jobApplication->city = $request->city;
        }

        if ($request->hasFile('photo')) {
            $jobApplication->photo = Files::upload($request->photo, 'candidate-photos', null, null, false);
        }
        $jobApplication->save();

        if ($request->hasFile('resume')) {
            $hashname = Files::upload($request->resume, 'documents/'.$jobApplication->id, null, null, false);
            $jobApplication->documents()->create([
                'name' => 'Resume',
                'hashname' => $hashname
            ]);
        }

        // Job Application Answer save
        if (isset($request->answer) && !empty($request->answer)) {
            foreach ($request->answer as $key => $value) {
                $answer = new JobApplicationAnswer();
                $answer->job_application_id = $jobApplication->id;
                $answer->job_id = $request->job_id;
                $answer->question_id = $key;
                $answer->answer = $value;
                $answer->save();
            }
        }

        return Reply::redirect(route('admin.job-applications.index'), __('menu.jobApplications') . ' ' . __('messages.createdSuccessfully'));
    }

    public function update(UpdateJobApplication $request, $id)
    {
        abort_if(!$this->user->can('edit_job_applications'), 403);

        $mailSetting = ApplicationSetting::select('id', 'mail_setting')->first()->mail_setting;

        $jobApplication = JobApplication::with(['documents'])->findOrFail($id);
        $jobApplication->full_name = $request->full_name;
        $jobApplication->job_id = $request->job_id;
        $jobApplication->status_id = $request->status_id;
        $jobApplication->email = $request->email;
        $jobApplication->phone = $request->phone;
        $jobApplication->grad_year = $request->grad_year;
        $jobApplication->gpa = $request->gpa;
        $jobApplication->marital_stat = $request->marital_stat;
        $jobApplication->cover_letter = $request->cover_letter;

        if ($request->has('gender')) {
            $jobApplication->gender = $request->gender;
        }
        if ($request->has('dob')) {
            $jobApplication->dob = $request->dob;
        }
        if ($request->has('country')) {
            $countriesArray = json_decode(file_get_contents(public_path('country-state-city/countries.json')), true)['countries'];
            $statesArray = json_decode(file_get_contents(public_path('country-state-city/states.json')), true)['states'];

            $jobApplication->country = $this->getName($countriesArray, $request->country);
            $jobApplication->state = $this->getName($statesArray, $request->state);
            $jobApplication->city = $request->city;
        }

        if ($request->hasFile('photo')) {
            $jobApplication->photo = Files::upload($request->photo, 'candidate-photos', null, null, false);
        }

        $isStatusDirty = $jobApplication->isDirty('status_id');

        $jobApplication->save();

        if ($request->hasFile('resume')) {
            Files::deleteFile($jobApplication->resumeDocument->hashname, 'documents/'.$jobApplication->id);
            $hashname = Files::upload($request->resume, 'documents/'.$jobApplication->id, null, null, false);
            $jobApplication->documents()->updateOrCreate([
                'documentable_type' => JobApplication::class,
                'documentable_id' => $jobApplication->id,
                'name' => 'Resume'
            ],
            [
                'hashname' => $hashname
            ]);
        }
        // Job Application Answer save
        if (isset($request->answer) && count($request->answer) > 0) {
            foreach ($request->answer as $key => $value) {
                JobApplicationAnswer::updateOrCreate([
                    'job_application_id' => $jobApplication->id,
                    'job_id' => $jobApplication->job_id,
                    'question_id' => $key
                ], ['answer' => $value]);
            }
        }

        if ($mailSetting[$request->status_id]['status'] && $isStatusDirty) {
            Notification::send($jobApplication, new CandidateStatusChange($jobApplication));
        }

        return Reply::redirect(route('admin.job-applications.table'), __('menu.jobApplications') . ' ' . __('messages.updatedSuccessfully'));
    }

    public function destroy($id)
    {
        abort_if(!$this->user->can('delete_job_applications'), 403);

        $jobApplication = JobApplication::findOrFail($id);

        if ($jobApplication->photo) {
            Storage::delete('candidate-photos/'.$jobApplication->photo);
        }

        $jobApplication->forceDelete();

        return Reply::success(__('messages.recordDeleted'));
    }

    public function show($company_id = null, $job_id = null, $application_id)
    {
        $this->company_id = $company_id;
        $this->job_id = $job_id;
        $this->status = ApplicationStatus::all();

        $this->application = JobApplication::with(['user', 'languages', 'experiences', 'educations', 'skills', 'schedule','notes','onboard', 'status', 'schedule.employee', 'schedule.comments.user'])->find($application_id);
        if(JobApplication::find($application_id) == null){
            return redirect(route('admin.company.job-applications', ['company_id' => $company_id, 'job_id' => $job_id]));
        }

        $this->answers = JobApplicationAnswer::with(['question'])
            ->where('job_id', $this->application->job_id)
            ->where('job_application_id', $this->application->id)
            ->get();


        $view = view('admin.job-applications.show', $this->data)->render();
        return Reply::dataOnly(['status' => 'success', 'view' => $view]);
    }

    public function updateIndex(Request $request)
    {
        $taskIds = $request->applicationIds;
        $boardColumnIds = $request->boardColumnIds;
        $priorities = $request->has('table') ? array(1) : $request->prioritys;
        $mailSetting = ApplicationSetting::select('id', 'mail_setting')->first()->mail_setting;

        $date = Carbon::now();
        $startDate = $request->startDate ?: $date->subDays(30)->format('Y-m-d');
        $endDate = $request->endDate ?: $date->format('Y-m-d');
        
        if ($request->has('applicationIds')) {
            foreach ($taskIds as $key => $taskId) {
                if (!is_null($taskId)) {

                    $task = JobApplication::find($taskId);
                    $task->column_priority = $priorities[$key];
                    $task->status_id = $boardColumnIds[$key];

                    $task->save();
                }
            }

            // Send notification to candidate on update status
            if($mailSetting[$boardColumnIds[0]]['status'] && $request->draggedTaskId != 0){
                $jobApplication = JobApplication::findOrFail($request->draggedTaskId);
                Notification::send($jobApplication, new CandidateStatusChange($jobApplication));
            }
        }

        $columnCountByIds = ApplicationStatus::select('id', 'color')
            ->withCount([
                'applications as status_count' => function ($query) use($startDate, $endDate, $request) {
                    $query->withoutTrashed();
                    // $query->whereDate('created_at', '>=', $startDate)->whereDate('created_at', '<=', $endDate);
                    if ($request->jobs != 'all' && $request->jobs != '') {
                        $query->where('job_id', $request->jobs);
                    }
                    if ($request->search != '') {
                        $query->where('full_name', 'LIKE', '%' . $request->search . '%');
                    }
                }
            ])
            ->get()
            ->toArray();

        return Reply::dataOnly(['status' => 'success','columnCountByIds' => $columnCountByIds]);
    }

    public function updateStatus(Request $request)
    {
        $jobApplication = JobApplication::findOrFail($request->id);
        $jobApplication->status_id = $request->status_id;
        $jobApplication->save();

        return Reply::success(__('messages.updatedSuccessfully'));
    }

    public function ratingSave(Request $request, $id)
    {
        abort_if(!$this->user->can('edit_job_applications'), 403);

        $application = JobApplication::withTrashed()->findOrFail($id);
        $application->rating = $request->rating;
        $application->save();

        return Reply::success(__('messages.updatedSuccessfully'));
    }

    // Job Applications data Export
    public function export($status, $location, $startDate, $endDate, $jobs)
    {
        $filters = [
            'status' => $status,
            'location' => $location,
            'startDate' => $startDate,
            'endDate' => $endDate,
            'jobs' => $jobs,
        ];

        $data = [
            'company' => $this->companyName
        ];

        return Excel::download(new JobApplicationExport($filters, $data), 'job-applications.xlsx', ExcelExcel::XLSX);
    }

    public function getName($arr, $id)
    {
        $result = array_filter($arr, function ($value) use ($id) {
            return $value['id'] == $id;
        });
        return current($result)['name'];
    }

    public function archiveJobApplication(Request $request, JobApplication $application)
    {
        abort_if(!$this->user->can('delete_job_applications'), 403);

        $application->delete();

        return Reply::success(__('messages.applicationArchivedSuccessfully'));
    }

    public function unarchiveJobApplication(Request $request, $application_id)
    {
        abort_if(!$this->user->can('delete_job_applications'), 403);

        $application = JobApplication::select('id', 'deleted_at')->withTrashed()->where('id', $application_id)->first();
        
        $application->restore();

        return Reply::success(__('messages.applicationUnarchivedSuccessfully'));
    }

    public function addSkills(Request $request, $applicationId)
    {
        abort_if(!$this->user->can('edit_job_applications'), 403);

        $application = JobApplication::withTrashed()->findOrFail($applicationId);

        $application->skills = $request->skills;
        $application->save();

        return Reply::success(__('messages.skillsSavedSuccessfully'));
    }

    public function showExperience()
    {
        abort_if(!$this->user->can('view_job_applications'), 403);

        return view('admin.job-applications.exp', ['_type' => request()->type, '_id' => request()->id]);
    }

    public function getExperience(Request $request)
    {
        abort_if(!$this->user->can('view_job_applications'), 403);

        $exps = $request->_type::find($request->_id)->experiences;

        return DataTables::of($exps)
            ->addIndexColumn()
            ->make(true);
    }
}

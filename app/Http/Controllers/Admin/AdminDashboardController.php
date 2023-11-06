<?php

namespace App\Http\Controllers\Admin;

use App\Models\EmailSetting;
use App\Models\InterviewSchedule;
use App\Models\Job;
use App\Models\JobApplication;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use App\Models\Company;
use App\Models\SmsSetting;

class AdminDashboardController extends AdminBaseController
{
    public function __construct()
    {
        parent::__construct();
        
        $this->pageIcon = 'icon-speedometer';
        $this->pageTitle = __('menu.dashboard');
    }

    public function index()
    {
        $this->smsSettings = SmsSetting::first();
        $this->totalOpenings = Job::activeJobsCount();
        $this->totalCompanies = Company::count();
        $this->totalApplications = JobApplication::count();
        $this->totalHired = JobApplication::join('application_status', 'application_status.id', '=', 'job_applications.status_id')
            ->where('application_status.status', 'hired')
            ->count();
        $this->totalRejected = JobApplication::join('application_status', 'application_status.id', '=', 'job_applications.status_id')
            ->where('application_status.status', 'rejected')
            ->count();
        $this->newApplications = JobApplication::join('application_status', 'application_status.id', '=', 'job_applications.status_id')
            ->where('application_status.status', 'unprocessed')
            ->count();
        $this->shortlisted = JobApplication::join('application_status', 'application_status.id', '=', 'job_applications.status_id')
            ->where('application_status.status', 'screening')
            ->orWhere('application_status.status', 'interview')
            ->count();

        $currentDate = Carbon::now()->format('Y-m-d');

        $this->totalTodayInterview = InterviewSchedule::where(DB::raw('DATE(`schedule_date`)'), "$currentDate")
            ->count();

        $this->progressPercent = $this->progressbarPercent();
        $this->todoItemsView = $this->generateTodoView();

        $currentDate = Carbon::now()->format('Y-m-d'); // Current Date

        // Get All schedules
        $this->schedules = InterviewSchedule::
            select('id', 'job_application_id', 'schedule_date', 'status')
            ->with(['employees', 'jobApplication:id,job_id,user_id', 'jobApplication.job:id,title', 'jobApplication.user:id,name'])
            ->where('status', 'pending')
            ->orderBy('schedule_date')
            ->get();

        // Filter upcoming schedule
        $upComingSchedules = $this->schedules->filter(function ($value, $key)use($currentDate) {
            return $value->schedule_date >= $currentDate;
        });

        $upcomingData = [];

        // Set array for upcoming schedule
        foreach($upComingSchedules as $upComingSchedule){
            $dt = $upComingSchedule->schedule_date->format('Y-m-d');
            $upcomingData[$dt][] = $upComingSchedule;
        }

        $this->upComingSchedules = $upcomingData;

        return view('admin.dashboard.index', $this->data);
    }

    private function progressbarPercent()
    {
        $totalItems = 4;
        $completedItem = 1;
        $progress = [];
        $progress['progress_completed'] = false;

        $smtpSetting = EmailSetting::first();
        if ($this->global->company_email != 'company@example.com') {
            $completedItem++;
            $progress['company_setting_completed'] = true;
        }

        if ($smtpSetting->verified !== 0 || $smtpSetting->mail_driver == 'mail') {
            $progress['smtp_setting_completed'] = true;

            $completedItem++;
        }

        if ($this->user->email != 'admin@example.com') {
            $progress['profile_setting_completed'] = true;

            $completedItem++;
        }


        if ($totalItems == $completedItem) {
            $progress['progress_completed'] = true;
        }

        $this->progress = $progress;


        return ($completedItem / $totalItems) * 100;

    }
}

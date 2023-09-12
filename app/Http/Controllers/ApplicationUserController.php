<?php

namespace App\Http\Controllers;

use App\Models\ApplicationStatus;
use App\Http\Controllers\Controller;
use App\Models\JobApplication;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Helper\Reply;

class ApplicationUserController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();
        $this->totalJobApplications = JobApplication::where('user_id', $user->id);
        $this->jobApplications = JobApplication::where('user_id', $user->id);
        if ($request->has('filter_year') && $request->filter_year != '') {
            $this->jobApplications = $this->jobApplications->whereYear('created_at', $request->filter_year);
            $this->totalJobApplications = $this->totalJobApplications->whereYear('created_at', $request->filter_year);
        }
        if ($request->has('filter_status') && $request->filter_status != '') {
            $this->jobApplications = $this->jobApplications->where('status_id', $request->filter_status);
        }
        $this->jobApplications = $this->jobApplications->get();
        $this->totalJobApplications = $this->totalJobApplications->count();

        $this->status = ApplicationStatus::with(['applications' => function ($q) use ($request, $user) {
            $q = $q->where('user_id', $user->id);
            if ($request->has('filter_year') && $request->filter_year != '') {
                $q = $q->whereYear('created_at', $request->filter_year);
            }
        }])->get();

        if ($request->ajax()) {
            $dataView = view('profile-user.application-data', $this->data)->render();
            $statisticsView = view('profile-user.application-statistics', $this->data)->render();
            return Reply::dataOnly(['dataView' => $dataView, 'statisticsView' => $statisticsView]);
        }

        return view('profile-user.application', $this->data);
    }
}

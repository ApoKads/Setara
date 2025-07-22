<?php

namespace App\Http\Controllers;

use App\Models\Job;
use App\Models\JobType;
use App\Models\Disability;
use App\Models\Applicant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class JobListPageController extends Controller
{
    //
    public function index(){
        return view('ListJob.listjob',[
            'disabilities'=>Disability::orderBy('name', 'asc')->get(),
            'jobCard'=> Job::filter(request(['search','disability','job_type','salary','work_mode','location','education_level']))->latest()->paginate(9)->withQueryString(), 
            'JobType'=> JobType::orderBy('name','asc')->get()
        ]);
    }

    public function show(Job $job){
        // dd("test");
        $hasApplied = false;
        
        // Check if user is authenticated and has applied for this job
        if (Auth::check() && Auth::user()->profile) {
            $hasApplied = Applicant::where('user_profile_id', Auth::user()->profile->id)
                ->where('job_id', $job->id)
                ->exists();
        }

        return view('ListJob.jobdetail', [
            'detail' => $job,
            'jobCard' => Job::where('id', '!=', $job->id)->latest()->take(6)->get(),
            'hasApplied' => $hasApplied
        ]);
    }
}

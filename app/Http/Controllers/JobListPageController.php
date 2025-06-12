<?php

namespace App\Http\Controllers;

use App\Models\Job;
use App\Models\JobType;
use App\Models\Disability;
use Illuminate\Http\Request;


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
        return view('ListJob.jobdetail',['detail'=>$job]);
    }
}

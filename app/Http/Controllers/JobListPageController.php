<?php

namespace App\Http\Controllers;

use App\Models\Job;
use App\Models\Disability;
use Illuminate\Http\Request;

class JobListPageController extends Controller
{
    //
    public function index(){
        return view('ListJob.listjob',[
            'disabilities'=>Disability::orderBy('name', 'asc')->get(),
            'card'=>Job::first(), 
        ]);
    }

    public function show(Job $job){
        return view('ListJob.jobdetail',['detail'=>$job]);
    }
}

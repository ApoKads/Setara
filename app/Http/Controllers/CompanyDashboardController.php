<?php

namespace App\Http\Controllers;

use App\Models\Job;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CompanyDashboardController extends Controller
{
    //
    public function index(){
        $company = Auth::user()->company()->first();
        return view('CompanySide.company', [
            'company' => $company
        ]);
    }

    public function show(Job $job){
        return view('ListJob.jobdetail',['detail'=>$job]);
    }
}

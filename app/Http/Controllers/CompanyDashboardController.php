<?php

namespace App\Http\Controllers;

use App\Models\Job;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CompanyDashboardController extends Controller
{
    //
    public function index(Request $request){ // Tambahkan Request $request di sini
        $company = Auth::user()->company()->first();

        // dd($request->all());
        $jobs = Job::where('company_id', $company->id)
                   ->filter(request(['search','sort'])) // Menerapkan scopeFilter untuk 'search'
                   ->get(); // Atau paginate() jika Anda ingin pagination

        return view('CompanySide.dashboard', [
            'company' => $company,
            'jobs' => $jobs // Kirim data lowongan pekerjaan ke view
        ]);
    }

    public function show(Job $job){
        return view('CompanySide.companyJobDetails',['detail'=>$job]);
    }

    public function applicant(Job $job){
        return view('CompanySide.applicant',['detail'=>$job]);
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Job;
use App\Models\Applicant;
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
    // Filter hanya applicant dengan status 'Pending'
        $job->load(['applicant' => function ($query) {
            $query->where('status', 'Pending');
        }]);

        return view('CompanySide.applicant', ['detail' => $job]);
    }


    public function applicantDetail(Applicant $applicant){
        // dd($applicant);

        $profile = $applicant->profile()->first();
        $user = $profile->user()->first();

        $lastCareer = $user->profile->careerHistories->sortByDesc('end_date')->first();
        $lastCareerString = $lastCareer ? $lastCareer->company_name : 'Belum ada riwayat karier';
        return view('CompanySide.user-profile', compact('user', 'lastCareerString','applicant'));
    }

    public function accept(Applicant $applicant)
    {
        $applicant->status = 'Accepted';
        $applicant->save();

        return redirect()->route('company.applicant', $applicant->job_id)
                        ->with('status', 'Accepted')
                        ->with('message', 'Lamaran berhasil diterima.');
    }

    public function reject(Applicant $applicant)
    {
        $applicant->status = 'Rejected';
        $applicant->save();

        return redirect()->route('company.applicant', $applicant->job_id)
                        ->with('status', 'Rejected')
                        ->with('message', 'Lamaran berhasil ditolak.');
    }


}

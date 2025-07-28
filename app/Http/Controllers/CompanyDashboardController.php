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

    public function history(Request $request)
    {
        $company = Auth::user()->company()->first();
        $jobIds = $company->jobs()->pluck('id');

        $applicants = Applicant::whereIn('job_id', $jobIds)
            ->whereIn('status', ['accepted', 'rejected'])
            ->filter($request->only(['search', 'sort', 'status'])) // Tambahkan filter
            ->with(['profile.user', 'job'])
            ->get();

        return view('CompanySide.history', [
            'company' => $company,
            'applicants' => $applicants,
        ]);
    }


    public function show(Job $job){
        return view('CompanySide.companyJobDetails',['detail'=>$job]);
    }

    public function applicant(Job $job){
    // Filter hanya applicant dengan status 'Pending'
        $job->load(['applicant' => function ($query) {
            $query->where('status', 'pending');
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
        // Ambil job dari applicant
        $job = $applicant->job;

        // Cek apakah job tidak ada atau slot penuh
        if (!$job || $job->slot <= 0) {
            return redirect()->route('company.history')
                            ->with('status', 'failed')
                            ->with('message', 'Lamaran gagal diterima karena slot sudah penuh.');
        }

        // Cek apakah status sebelumnya bukan 'accepted'
        if ($applicant->status !== 'accepted') {
            // Kurangi slot job
            $job->slot -= 1;
            $job->save();
        }

        // Update status
        $applicant->status = 'accepted';
        $applicant->save();

        return redirect()->route('company.history')
                        ->with('status', 'accepted')
                        ->with('message', 'Lamaran berhasil diterima.');
    }



    public function reject(Applicant $applicant)
    {
        // Cek jika sebelumnya status-nya adalah 'accepted'
        if ($applicant->status === 'accepted') {
            $job = $applicant->job;
            if ($job) {
                $job->slot += 1;
                $job->save();
            }
        }

        // Update status ke 'rejected'
        $applicant->status = 'rejected';
        $applicant->save();

        return redirect()->route('company.history')
                        ->with('status', 'rejected')
                        ->with('message', 'Lamaran berhasil ditolak.');
    }




}

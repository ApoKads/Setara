<?php

namespace App\Http\Controllers;

use App\Models\Job;
use App\Models\Applicant;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB; // <-- PERBAIKAN: Tambahkan DB facade

class JobApplicationController extends Controller
{
    /**
     * Show the job application form
     */
    public function show(Job $job)
    {
        $job->load(['company', 'seniority', 'JobType', 'location', 'EducationLevel']);

        $user = Auth::user();

        if ($user && $user->profile) {
            $existingApplication = Applicant::where('user_profile_id', $user->profile->id)
                ->where('job_id', $job->id)
                ->first();

            if ($existingApplication) {
                return redirect()->route('job.show', $job->id)
                    ->with('info', 'You have already applied for this position.');
            }
        }

        return view('ListJob.jobapplication', compact('job'));
    }

    /**
     * Store the job application
     */
    public function store(Request $request, Job $job)
    {
        $request->validate([
            'application_reason' => 'required|string|max:1000',
        ]);

        $user = Auth::user();

        if (!$user->profile) {
            return redirect()->back()->with('error', 'Please complete your profile before applying for jobs.');
        }

        $existingApplication = Applicant::where('user_profile_id', $user->profile->id)
            ->where('job_id', $job->id)
            ->first();

        if ($existingApplication) {
            return redirect()->back()->with('error', 'You have already applied for this position.');
        }

        // PERBAIKAN FINAL: Menggunakan Query Builder untuk memastikan data tersimpan dengan benar
        DB::table('applicants')->insert([
            'user_profile_id' => $user->profile->id,
            'job_id' => $job->id,
            'note' => $request->application_reason,
            'slug' => Str::uuid(),
            'status' => 'pending',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->route('job.show', $job->id)
            ->with('success', 'Your application has been submitted successfully!');
    }
}

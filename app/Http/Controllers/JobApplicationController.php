<?php

namespace App\Http\Controllers;

use App\Models\Job;
use App\Models\Applicant;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class JobApplicationController extends Controller
{
    /**
     * Show the job application form
     */
    public function show(Job $job)
    {
        $job->load(['company', 'seniority', 'JobType', 'location', 'EducationLevel']);

        $user = Auth::user();

        // Check if user has already applied for this job
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

        // Check if user has a profile
        if (!$user->profile) {
            return redirect()->back()->with('error', 'Please complete your profile before applying for jobs.');
        }

        // Check if user has already applied for this job
        $existingApplication = Applicant::where('user_profile_id', $user->profile->id)
            ->where('job_id', $job->id)
            ->first();

        if ($existingApplication) {
            return redirect()->back()->with('error', 'You have already applied for this position.');
        }

        // Create the application
        Applicant::create([
            'user_profile_id' => $user->profile->id,
            'job_id' => $job->id,
            'note' => $request->application_reason,
            'slug' => Str::uuid(),
        ]);

        return redirect()->route('job.show', $job->id)
            ->with('success', 'Your application has been submitted successfully!');
    }
}

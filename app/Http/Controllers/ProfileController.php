<?php

namespace App\Http\Controllers;

use App\Models\Skill;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\Applicant; // Pastikan model Applicant diimpor
use App\Models\UserProfile; // Pastikan model UserProfile diimpor (sudah ada, tapi untuk kejelasan)
use App\Models\Job; // Pastikan model Job diimpor
use App\Models\Company; // Pastikan model Company diimpor

class ProfileController extends Controller
{
    public function show()
    {
        $user = Auth::user()->load('profile.careerHistories', 'profile.skills');
        $lastCareer = $user->profile->careerHistories->sortByDesc('end_date')->first();
        $lastCareerString = $lastCareer ? $lastCareer->company_name : 'Belum ada riwayat karier';

        return view('UserSide.userProfile', compact('user', 'lastCareerString'));
    }

    public function edit()
    {
        $user = Auth::user()->load('profile.careerHistories', 'profile.skills');

        $lastCareer = $user->profile->careerHistories->sortByDesc('end_date')->first();
        $lastCareerString = $lastCareer ? $lastCareer->company_name : 'Belum ada riwayat karier';

        return view('UserSide.editSkillsCareers', [
            'user' => $user,
            'lastCareerString' => $lastCareerString,
        ]);
    }

    public function track()
    {

        $user = Auth::user();

        if (!$user->profile) {
            return redirect()->back()->with('error', 'Profil pengguna tidak ditemukan. Silakan lengkapi profil Anda.');
        }
        $userProfileId = $user->profile->id;
        $applicants = Applicant::where('user_profile_id', $userProfileId)
            ->with(['job.company'])
            ->orderBy('created_at', 'desc')
            ->get();
        $pendingApplicants = $applicants->where('status', 'pending');
        $acceptedApplicants = $applicants->where('status', 'accepted');
        $rejectedApplicants = $applicants->where('status', 'rejected');
        $historyApplicants = $applicants->whereIn('status', ['accepted', 'rejected']);

        return view('UserSide.userProfileTrack', [
            'applicants' => $applicants,
            'pendingApplicants' => $pendingApplicants,
            'acceptedApplicants' => $acceptedApplicants,
            'rejectedApplicants' => $rejectedApplicants,
            'historyApplicants' => $historyApplicants,
            'userProfile' => $user->profile
        ]);
    }

    public function update(Request $request)
    {
        $user = Auth::user();
        $profile = $user->profile;

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'job_status' => 'required|string|max:255',
            'quote' => 'nullable|string|max:255',
            'about' => 'nullable|string',
            'age' => 'nullable|integer|min:16',
            'profile_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'description' => 'nullable|string'
        ]);

        if ($request->hasFile('profile_image')) {
            if ($profile->profile_image && $profile->profile_image !== 'default.jpg') {
                Storage::disk('public')->delete('profile_images/' . $profile->profile_image);
            }
            $imageName = time() . '.' . $request->profile_image->extension();
            $request->profile_image->storeAs('profile_images', $imageName, 'public');
            $validated['profile_image'] = $imageName;
        }
        // dd($validated);   
        $profile->update($validated);

        return redirect()->route('profile.show')->with('success', 'Profile updated successfully!');
    }
}

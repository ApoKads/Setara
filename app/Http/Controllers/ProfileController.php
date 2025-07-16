<?php

namespace App\Http\Controllers;

use App\Models\Skill;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function show()
    {
        $user = Auth::user()->load('profile.careerHistories', 'profile.skills');

        // Ambil riwayat karier terakhir (jika ada)
        // Asumsi 'careerHistories' adalah koleksi dan Anda ingin yang paling baru
        // Anda mungkin perlu menyesuaikan berdasarkan cara data careerHistories Anda diurutkan
        $lastCareer = $user->profile->careerHistories->sortByDesc('end_date')->first();
        $lastCareerString = $lastCareer ? $lastCareer->company_name : 'Belum ada riwayat karier';
        // Atau jika Anda ingin nama posisi: $lastCareer->position_name

        return view('UserSide.userProfile', compact('user', 'lastCareerString'));
    }

    public function edit()
    {
        $user = Auth::user()->load('profile.careerHistories', 'profile.skills');

        // Ambil riwayat karier terakhir (jika ada) untuk halaman edit juga
        $lastCareer = $user->profile->careerHistories->sortByDesc('end_date')->first();
        $lastCareerString = $lastCareer ? $lastCareer->company_name : 'Belum ada riwayat karier';

        return view('UserSide.editSkillsCareers', [
            'user' => $user,
            'lastCareerString' => $lastCareerString, // Teruskan juga ke view edit
        ]);
    }

    // public function track()
    // {


    //     return view('UserSide.userProfileTrack', [

    //     ]);
    // }

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

        $profile->update($validated);

        return redirect()->route('profile.show')->with('success', 'Profile updated successfully!');
    }
}
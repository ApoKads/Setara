<?php

namespace App\Http\Controllers;

use App\Models\Skill; // <-- TAMBAHKAN IMPORT INI
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    // Menampilkan profil pengguna (FUNGSI ANDA, TIDAK BERUBAH)
    public function show()
    {
        // Eager load semua relasi yang dibutuhkan untuk halaman tampilan profil
        $user = Auth::user()->load('profile.careerHistories', 'profile.skills');
        return view('UserSide.userProfile', compact('user'));
    }

    // FUNGSI BARU: Menampilkan halaman form untuk mengedit profil
    public function edit()
    {
        // Ambil data user yang sedang login beserta relasinya
        $user = Auth::user()->load('profile.careerHistories', 'profile.skills');

        // Ambil semua skill dari database untuk ditampilkan di dropdown
        $allSkills = Skill::orderBy('name')->get();

        // Tampilkan view 'profile.edit' dan kirim data yang dibutuhkan
        return view('UserSide.editSkillsCareers', [
            'user' => $user,
            'allSkills' => $allSkills,
        ]);
    }

    // Mengupdate profil pengguna (FUNGSI ANDA, TIDAK BERUBAH)
    public function update(Request $request)
    {
        $user = Auth::user();
        $profile = $user->profile;

        // Validasi semua input yang bisa diubah
        $request->validate([
            'name' => 'required|string|max:255',
            'job_status' => 'required|string|max:255',
            'quote' => 'nullable|string|max:255',
            'about' => 'nullable|string',
            'age' => 'nullable|integer|min:16',
            'profile_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'description' => 'nullable|string'
        ]);

        // Proses update gambar jika ada file baru yang diunggah
        if ($request->hasFile('profile_image')) {
            if ($profile->profile_image && $profile->profile_image !== 'default.jpg') {
                Storage::delete('public/profile_images/' . $profile->profile_image);
            }
            $imageName = time() . '.' . $request->profile_image->extension();
            $request->profile_image->storeAs('profile_images', $imageName, 'public');
            $profile->profile_image = $imageName;
        }

        // Update data teks
        $profile->name = $request->input('name');
        $profile->job_status = $request->input('job_status');
        $profile->quote = $request->input('quote');
        $profile->about = $request->input('about');
        $profile->age = $request->input('age');
        $profile->description = $request->input('description');
        $profile->save();

        return redirect()->route('profile.show')->with('success', 'Profile updated successfully!');
    }
}

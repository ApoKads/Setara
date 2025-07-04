<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage; // Import Storage facade

class ProfileController extends Controller
{
    // Menampilkan profil pengguna
    public function show()
    {
        $user = Auth::user()->load('profile.careerHistories'); // Eager load relasi
        return view('UserSide.userProfile', compact('user'));
    }

    // Mengupdate profil pengguna
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
            // Hapus gambar lama jika ada
            if ($profile->profile_image) {
                Storage::delete('public/profile_images/' . $profile->profile_image);
            }

            // Simpan gambar baru dan dapatkan path-nya
            $imageName = time() . '.' . $request->profile_image->extension();
            $request->profile_image->storeAs('profile_images', $imageName, 'public');

            // Simpan nama file baru ke properti model
            $profile->profile_image = $imageName;
        }

        // Update data teks dari request ke model Profile
        $profile->name = $request->input('name');
        $profile->job_status = $request->input('job_status');
        $profile->quote = $request->input('quote');
        $profile->about = $request->input('about');
        $profile->age = $request->input('age');
        $profile->description = $request->input('description');

        // Simpan semua perubahan pada model Profile
        $profile->save();

        // Mengarahkan kembali ke halaman profil dengan pesan sukses
        return redirect()->route('profile.show')->with('success', 'Profile updated successfully!');
    }
}
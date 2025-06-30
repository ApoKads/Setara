<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    // Menampilkan profil pengguna
    public function show()
    {
        $user = Auth::user();  // Mengambil data pengguna yang sedang login
        return view('UserSide.userProfile', compact('user'));  // Mengirim data user ke view
    }

    // Mengupdate profil pengguna (termasuk gambar profil)
    public function update(Request $request)
    {
        // Validasi input untuk gambar profil
        $request->validate([
            'profile_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validasi jenis gambar dan ukuran
        ]);

        $user = Auth::user();  // Mengambil pengguna yang sedang login

        // Mengecek jika ada file gambar yang diunggah
        if ($request->hasFile('profile_image')) {
            // Menghasilkan nama gambar unik berdasarkan waktu dan ekstensi file
            $imageName = time() . '.' . $request->profile_image->extension();

            // Menyimpan gambar di direktori 'public/profile_images'
            $request->profile_image->storeAs('public/profile_images', $imageName);

            // Mengupdate gambar profil di tabel user_profiles
            $user->profile->profile_image = $imageName;
            $user->profile->save();
        }

        // Simpan perubahan di tabel users
        $user->save();

        // Mengarahkan kembali ke halaman profil dengan pesan sukses
        return redirect()->route('profile.show')->with('success', 'Profile updated successfully!');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserProfile;
use App\Models\Company; // Pastikan model Company di-import jika Anda menggunakannya
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB; // Untuk transaksi database

class SignupController extends Controller
{
    public function showUserSignupForm()
    {
        return view('auth.signup'); // Menampilkan signup.blade.php
    }

    // Method untuk menampilkan form company
    public function showCompanySignupForm()
    {
        // Ini adalah halaman yang akan menampilkan form pendaftaran perusahaan DAN pop-up
        return view('auth.signup-company'); // Menampilkan signup-company.blade.php
    }

    // Proses signup
    public function signup(Request $request)
    {
        // Validasi input signup
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed',
            'role' => 'required|in:user,company,admin', // Memastikan role yang valid
        ]);

        try {
            DB::beginTransaction(); // Memulai transaksi database

            // Membuat user baru
            $user = new User([
                'email' => $validatedData['email'],
                'password' => Hash::make($validatedData['password']),
                'role' => $validatedData['role'],
                // PERUBAHAN UTAMA: Set is_active ke false untuk perusahaan yang perlu verifikasi
                'is_active' => ($validatedData['role'] === 'company') ? false : true,
            ]);
            $user->save();

            // Membuat profil atau entitas terkait berdasarkan role
            if ($validatedData['role'] === 'company') {
                // Asumsi Anda memiliki model Company yang terhubung ke User
                Company::create([
                    'user_id' => $user->id,
                    'name' => $validatedData['name'],
                    'is_verified' => false, // Menandai perusahaan belum diverifikasi
                    // Tambahkan kolom lain yang relevan untuk perusahaan jika ada
                ]);
            } else { // Untuk role 'user' atau 'admin'
                $user->profile()->create([
                    'name' => $validatedData['name'],
                    'job_status' => 'dan siap untuk bekerja!',
                    'profile_image' => 'default.jpg',
                    'quote' => 'This is a default quote',
                    'slug' => Str::slug($validatedData['name'], '-') ?: 'default-slug'
                ]);
            }

            DB::commit(); // Commit transaksi jika semua berhasil

            // PERUBAHAN UTAMA: Logika redirect setelah pendaftaran
            if ($validatedData['role'] === 'company') {
                // Redirect kembali ke halaman pendaftaran perusahaan dengan flash message
                return redirect()->route('signup.company.form')->with('status', 'pending_approval');
            } else {
                // Untuk user atau admin, langsung login dan redirect seperti biasa
                Auth::login($user);
                return $this->authenticatedRedirect($user);
            }

        } catch (\Exception $e) {
            DB::rollBack(); // Rollback transaksi jika ada error
            // Anda bisa log errornya di sini untuk debugging lebih lanjut
            // \Log::error("Signup failed: " . $e->getMessage());
            return back()->withErrors(['error' => 'Terjadi kesalahan saat pendaftaran. Silakan coba lagi.'])->withInput();
        }
    }

    // Redirect setelah login atau signup
    protected function authenticatedRedirect($user)
    {
        return match ($user->role) {
            'admin' => redirect()->intended('/admin/dashboard'),
            'company' => redirect()->intended('/company/dashboard'), // Ini tidak akan terpanggil lagi untuk pendaftaran awal perusahaan
            'user' => redirect()->intended('/home'),
            default => redirect('/'),
        };
    }
}

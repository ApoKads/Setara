<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str; // Pastikan Str digunakan untuk membuat slug

class SignupController extends Controller
{
    // Menampilkan halaman signup
    public function showSignupForm()
    {
        return view('auth.signup');
    }

    // Proses signup
    public function signup(Request $request)
    {
        // Validasi input signup
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed',
            'role' => 'required|in:user,company,admin',
        ]);

        // dd($validatedData['name']);

        // Membuat user baru
        $user = new User([
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password']),
            'role' => $validatedData['role'],
        ]);
        $user->save();


        // dd($user->name);

        // Membuat user profile secara otomatis
        $user->profile()->create([
            'name' => $validatedData['name'],
            'job_status' => 'dan siap untuk bekerja!',
            'profile_image' => 'default.jpg',
            'quote' => 'This is a default quote',
            'slug' => Str::slug($validatedData['name'], '-') ?: 'default-slug'
        ]);
        $user->save();

        Auth::login($user);

        return $this->authenticatedRedirect($user);
    }


    // Redirect setelah login atau signup
    protected function authenticatedRedirect($user)
    {
        return match ($user->role) {
            'admin' => redirect()->intended('/admin/dashboard'),
            'company' => redirect()->intended('/company/dashboard'),
            'user' => redirect()->intended('/home'),
            default => redirect('/'),
        };
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserProfile;
use App\Models\Company; // Pastikan model Company di-import
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log; // Untuk logging error

class SignupController extends Controller
{
    public function showUserSignupForm()
    {
        return view('auth.signup');
    }

    public function showCompanySignupForm()
    {
        return view('auth.signup-company');
    }

    public function signup(Request $request)
    {
        // Validasi input signup
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed',
            'role' => 'required|in:user,company,admin',
        ]);

        try {
            DB::beginTransaction();

            $user = new User([
                'email' => $validatedData['email'],
                'password' => Hash::make($validatedData['password']),
                'role' => $validatedData['role'],
                'is_active' => ($validatedData['role'] === 'company') ? false : true,
            ]);
            $user->save();

            if ($validatedData['role'] === 'company') {
                Company::create([
                    'user_id' => $user->id,
                    'name' => $validatedData['name'],
                    'is_verified' => false,
                ]);
            } else {
                $user->profile()->create([
                    'name' => $validatedData['name'],
                    'job_status' => 'dan siap untuk bekerja!',
                    'profile_image' => 'default.jpg',
                    'quote' => 'This is a default quote',
                    'slug' => Str::slug($validatedData['name'], '-') ?: 'default-slug'
                ]);
            }

            DB::commit();

            // PERUBAHAN UTAMA: Respon untuk permintaan AJAX vs. permintaan form biasa
            if ($request->expectsJson()) {
                // Jika ini adalah permintaan AJAX, kembalikan JSON
                if ($validatedData['role'] === 'company') {
                    return response()->json(['status' => 'pending_approval', 'message' => 'Pendaftaran berhasil! Menunggu verifikasi admin.']);
                } else {
                    // Untuk user atau admin, bisa langsung login dan kembalikan JSON sukses
                    Auth::login($user);
                    return response()->json(['status' => 'success', 'redirect' => $this->authenticatedRedirect($user)->getTargetUrl()]);
                }
            } else {
                // Jika ini adalah permintaan form biasa (fallback), redirect seperti sebelumnya
                if ($validatedData['role'] === 'company') {
                    return redirect()->route('signup.company.form')->with('status', 'pending_approval');
                } else {
                    Auth::login($user);
                    return $this->authenticatedRedirect($user);
                }
            }

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error("Signup failed: " . $e->getMessage());

            if ($request->expectsJson()) {
                return response()->json(['status' => 'error', 'message' => 'Terjadi kesalahan saat pendaftaran. Silakan coba lagi.'], 500);
            } else {
                return back()->withErrors(['error' => 'Terjadi kesalahan saat pendaftaran. Silakan coba lagi.'])->withInput();
            }
        }
    }

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

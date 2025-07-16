<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserProfile;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str; // Pastikan ini diimpor
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

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
                // Pastikan slug dibuat dan disertakan di sini
                $company = Company::create([
                    'user_id' => $user->id,
                    'name' => $validatedData['name'],
                    'slug' => Str::slug($validatedData['name']) . '-' . Str::random(5), // FIX: Menambahkan slug
                    'status' => 'pending',
                    'location' => 'Not Available', // Pastikan ini juga ada jika kolomnya NOT NULL
                    'description' => 'Perusahaan baru mendaftar.', // Pastikan ini juga ada jika kolomnya NOT NULL
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

            if ($request->expectsJson()) {
                if ($validatedData['role'] === 'company') {
                    return response()->json([
                        'status' => 'pending_approval',
                        'message' => 'Pendaftaran berhasil! Menunggu verifikasi admin.',
                        'company_status_id' => $company->id
                    ]);
                } else {
                    Auth::login($user);
                    return response()->json(['status' => 'success', 'redirect' => $this->authenticatedRedirect($user)->getTargetUrl()]);
                }
            } else {
                if ($validatedData['role'] === 'company') {
                    return redirect()->route('signup.company.form')->with('status', 'pending_approval')->with('company_status_id', $company->id);
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

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Company;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            // Jika peran pengguna adalah 'company', lakukan validasi status
            if ($user->role === 'company') {
                $company = $user->company;

                if (!$company) {
                    Auth::logout();
                    $request->session()->invalidate();
                    $request->session()->regenerateToken();
                    if ($request->expectsJson()) {
                        return response()->json(['status' => 'error', 'message' => 'Akun perusahaan tidak ditemukan atau belum lengkap. Silakan hubungi admin.'], 403);
                    }
                    return back()->withErrors([
                        'email' => 'Akun perusahaan tidak ditemukan atau belum lengkap. Silakan hubungi admin.',
                    ])->onlyInput('email');
                }

                if ($company->status === 'pending') {
                    Auth::logout();
                    $request->session()->invalidate();
                    $request->session()->regenerateToken();
                    if ($request->expectsJson()) {
                        return response()->json(['status' => 'error', 'message' => 'Akun perusahaan Anda masih menunggu persetujuan admin.'], 403);
                    }
                    return back()->withErrors([
                        'email' => 'Akun perusahaan Anda masih menunggu persetujuan admin.',
                    ])->onlyInput('email');
                }

                if ($company->status === 'rejected') {
                    Auth::logout();
                    $request->session()->invalidate();
                    $request->session()->regenerateToken();
                    if ($request->expectsJson()) {
                        return response()->json(['status' => 'error', 'message' => 'Akun perusahaan Anda telah ditolak. Silakan hubungi admin.'], 403);
                    }
                    return back()->withErrors([
                        'email' => 'Akun perusahaan Anda telah ditolak. Silakan hubungi admin.',
                    ])->onlyInput('email');
                }
            }

            // Jika semua validasi lolos, regenerasi session
            $request->session()->regenerate();

            // Tentukan URL redirect
            $redirectUrl = $this->authenticatedRedirect($user)->getTargetUrl();

            // Jika ini adalah permintaan AJAX, kembalikan JSON dengan URL redirect
            if ($request->expectsJson()) {
                return response()->json(['status' => 'success', 'redirect' => $redirectUrl]);
            }

            // Jika bukan AJAX, lakukan redirect standar
            return redirect()->intended($redirectUrl);
        }

        // Jika Auth::attempt gagal
        if ($request->expectsJson()) {
            return response()->json(['status' => 'error', 'message' => 'Email atau password salah.'], 401);
        }
        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ])->onlyInput('email');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }

    protected function authenticatedRedirect($user)
    {
        return match ($user->role) {
            'admin' => redirect()->intended('/admin/dashboard'),
            'company' => redirect()->intended('/company/dashboard'),
            'user' => redirect()->intended('/home'),
            default => redirect('/')
        };
    }
}

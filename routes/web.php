<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\JobController;
use App\Http\Middleware\UserMiddleware;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Middleware\GuestMiddleware;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\SignupController;
use App\Http\Middleware\CompanyMiddleware;
use App\Http\Controllers\JobListPageController;
use App\Http\Controllers\CompanyListPageController;
use App\Http\Controllers\CompanyDashboardController;
use App\Http\Controllers\ProfileController;

Route::controller(LoginController::class)->group(function () {
    Route::get('/login', 'showLoginForm')->name('login');
    Route::post('/login', 'login');
    Route::post('/logout', 'logout')->name('logout');
});
;

// Route untuk signup
Route::controller(SignupController::class)->group(function () {
    Route::get('/signup', 'showSignupForm')->name('signup.form');
    Route::post('/signup', 'signup')->name('signup');
});

Route::get('/', function () {
    return view('auth/login');
})->middleware(GuestMiddleware::class);


// Admin Route
Route::middleware(['auth', AdminMiddleware::class])->prefix('admin')->group(function () {
    Route::get('/dashboard', function () {
        return view('AdminSide.admin');
    });

    Route::get('/companyform', function () {
        return view('AdminSide.companyform');
    });

    Route::post('/companyform', [CompanyController::class, 'store'])->name('company.store');

});


// Company Route
Route::middleware(['auth', CompanyMiddleware::class])->prefix('company')->group(function () {
    Route::controller(CompanyDashboardController::class)->group(function () {
        Route::get('/dashboard', 'index');
        Route::get('/dashboard/{job:id}', 'show')->name('companyJob.show');
    });

    Route::controller(JobController::class)->group(function () {
        route::delete('/dashboard/{job:id}', 'destroy');
    });

    Route::get('/dashboard/profile', function () {
        return view('CompanySide.companyProfile', [
            'company' => Auth::user()->company()->first()
        ]);
    });

});


// User Route
Route::middleware(['auth', UserMiddleware::class])->group(function () {
    // Route untuk halaman profil (menggunakan controller)
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');

    // Route untuk update profil
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update'); // Menambahkan route update profile


    // Home Route
    Route::get('/home', function () {
        return view('home', [
            'profile' => Auth::user()->profile()->first()
        ]);
    })->name('home');

    // CompanyListPage
    Route::controller(CompanyListPageController::class)->group(function () {
        Route::get('/company', 'index')->name('companies');
        Route::get('/company/{company:slug}', 'show')->name('companies.show');
    });

    // JobListPage
    Route::controller(JobListPageController::class)->group(function () {
        Route::get('/job', 'index')->name('jobs');
        Route::get('/job/{job:slug}', 'show')->name('job.show');
    });
});
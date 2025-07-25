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
use App\Http\Controllers\JobApplicationController;
use App\Http\Controllers\CompanyListPageController;
use App\Http\Controllers\CompanyDashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\CareerHistoryController;
use App\Http\Controllers\ProfileSkillController;
use App\Http\Controllers\AdminActivityController;
use App\Models\Job;
use App\Models\Company;
use App\Models\CompanyStatus;

Route::controller(LoginController::class)->group(function () {
    Route::get('/login', 'showLoginForm')->name('login');
    Route::post('/login', 'login');
    Route::post('/logout', 'logout')->name('logout');
});

Route::controller(SignupController::class)->group(function () {
    Route::get('/signup', 'showUserSignupForm')->name('signup.user.form');
    Route::get('/signup/company', 'showCompanySignupForm')->name('signup.company.form');
    Route::post('/signup', 'signup')->name('signup');
});

Route::get('/', function () {
    return view('auth/login');
})->middleware(GuestMiddleware::class);

Route::middleware(['auth', AdminMiddleware::class])->prefix('admin')->group(function () {
    Route::get('/dashboard', [CompanyController::class, 'index'])->name('admin.dashboard');

    Route::get('/companyform', [CompanyController::class, 'create'])->name('company.create');
    Route::post('/companyform', [CompanyController::class, 'store'])->name('company.store');

    Route::get('/company/{id}', [CompanyController::class, 'show'])->name('company.shows');
    Route::get('/company/{id}/edit', [CompanyController::class, 'edit'])->name('company.edit');
    Route::put('/company/{id}', [CompanyController::class, 'update'])->name('company.update');
    Route::delete('/company/{id}', [CompanyController::class, 'destroy'])->name('company.destroy');

    Route::get('/activity', [AdminActivityController::class, 'activityPage'])->name('admin.activity');
    Route::post('/company/{id}/approve', [AdminActivityController::class, 'approveCompany'])->name('admin.approveCompany');
    Route::post('/company/{id}/reject', [AdminActivityController::class, 'rejectCompany'])->name('admin.rejectCompany');
});

Route::middleware(['auth', CompanyMiddleware::class])->prefix('company')->group(function () {
    Route::controller(JobController::class)->group(function () {
        Route::get('/dashboard/create', 'create')->name('job.create');
        Route::post('/dashboard/store', 'store')->name('job.store');
        Route::get('/dashboard/edit/{job:id}', 'edit')->name('job.edit');
        Route::put('/dashboard/edit/{job:id}', 'update')->name('job.update');
        route::delete('/dashboard/{job:id}', 'destroy');
    });
    Route::controller(CompanyDashboardController::class)->group(function () {
        Route::get('/dashboard', 'index')->name('companyJob.index');
        Route::get('/dashboard/history', 'history')->name('company.history');
        Route::get('/dashboard/{job:id}', 'show')->name('companyJob.show');
        Route::get('/dashboard/details/{job:id}', 'applicant')->name('company.applicant');
        Route::get('/dashboard/applicant/{applicant:id}', 'applicantDetail')->name('company.applicantDetails');
        Route::post('/dashboard/applicant/{applicant:id}/accept', 'accept')->name('company.applicantAccept');
        Route::post('/dashboard/applicant/{applicant:id}/reject', 'reject')->name('company.applicantReject');

    });
    Route::get('/dashboard/profile', function () {
        return view('CompanySide.companyProfile', [
            'company' => Auth::user()->company()->first()
        ]);
    });
    Route::get('/api/company-status-check/{id}', [AdminActivityController::class, 'checkCompanyStatusApi'])->name('api.company.status.check');
});

Route::middleware(['auth', UserMiddleware::class])->group(function () {
    Route::get('/home', function () {
        $profile = Auth::user()->profile()->first();
        $featuredJobs = Job::latest()->take(6)->get();
        return view('UserSide/home', compact('profile', 'featuredJobs'));
    })->name('home');

    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::get('/profile/track', [ProfileController::class, 'track'])->name('profile.track');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');

    Route::resource('career-histories', CareerHistoryController::class)->only(['store', 'update', 'destroy']);
    Route::post('profile/skills', [ProfileSkillController::class, 'store'])->name('profile.skills.store');
    Route::delete('profile/skills/{skill}', [ProfileSkillController::class, 'destroy'])->name('profile.skills.destroy');

    Route::controller(CompanyListPageController::class)->group(function () {
        Route::get('/company', 'index')->name('companies');
        Route::get('/company/{company:slug}', 'show')->name('companies.show');
    });

    Route::controller(JobListPageController::class)->group(function () {
        Route::get('/job', 'index')->name('jobs');
        Route::get('/job/{job:id}', 'show')->name('job.show');
    });

    Route::controller(JobApplicationController::class)->group(function () {
        Route::get('/job/{job:id}/apply', 'show')->name('job.apply');
        Route::post('/job/{job:id}/apply', 'store')->name('job.apply.submit');
    });
});

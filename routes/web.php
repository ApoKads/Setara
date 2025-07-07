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
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\CareerHistoryController;
use App\Http\Controllers\ProfileSkillController;

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
    Route::get('/companyform', function () {
        return view('AdminSide.companyform'); });
    Route::post('/companyform', [CompanyController::class, 'store'])->name('company.store');
    Route::get('/company/{id}', [CompanyController::class, 'show'])->name('company.show');
    Route::get('/company/{id}/edit', [CompanyController::class, 'edit'])->name('company.edit');
    Route::delete('/company/{id}', [CompanyController::class, 'destroy'])->name('company.destroy');
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
        Route::get('/dashboard/{job:id}', 'show')->name('companyJob.show');
        Route::get('/dashboard/details/{job:id}', 'applicant')->name('company.applicant');
    });
    Route::get('/dashboard/profile', function () {
        return view('CompanySide.companyProfile', [
            'company' => Auth::user()->company()->first()
        ]);
    });
});

Route::middleware(['auth', UserMiddleware::class])->group(function () {
    Route::get('/home', function () {
        return view('home', ['profile' => Auth::user()->profile()->first()]);
    })->name('home');

    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');

    Route::resource('career-histories', CareerHistoryController::class)->except(['index', 'show', 'create', 'edit']);

    Route::post('profile/skills', [ProfileSkillController::class, 'store'])->name('profile.skills.store');
    Route::delete('profile/skills/{skill}', [ProfileSkillController::class, 'destroy'])->name('profile.skills.destroy');

    Route::controller(CompanyListPageController::class)->group(function () {
        Route::get('/company', 'index')->name('companies');
        Route::get('/company/{company:slug}', 'show')->name('companies.show');
    });

    Route::controller(JobListPageController::class)->group(function () {
        Route::get('/job', 'index')->name('jobs');
        Route::get('/job/{job:slug}', 'show')->name('job.show');
    });
});

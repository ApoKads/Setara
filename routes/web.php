<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\UserMiddleware;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Middleware\GuestMiddleware;
use App\Http\Controllers\LoginController;
use App\Http\Middleware\CompanyMiddleware;

Route::controller(LoginController::class)->group(function () {
    Route::get('/login', 'showLoginForm')->name('login');
    Route::post('/login', 'login');
    Route::post('/logout', 'logout')->name('logout');
});

Route::get('/',function(){
    return view('login');
})->middleware(GuestMiddleware::class);


// Admin Route
Route::middleware(['auth', AdminMiddleware::class])->prefix('admin')->group(function () {
    Route::get('/dashboard', function () {
        return view('admin');
    });
    
});


// Company Route
Route::middleware(['auth', CompanyMiddleware::class])->prefix('company')->group(function () {
    Route::get('/dashboard', function () {
        return view('company', [
            'company' => Auth::user()->company()->first()
        ]);
    });
    
    Route::get('/dashboard/profile', function () {
        return view('companyProfile', [
            'company' => Auth::user()->company()->first()
        ]);
    });
    
});


// User Route
Route::middleware(['auth', UserMiddleware::class])->group(function () {
    Route::get('/home', function () {
        return view('home', [
            'profile' => Auth::user()->profile()->first()
        ]);
    });
    
});
<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\UserMiddleware;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Controllers\LoginController;
use App\Http\Middleware\CompanyMiddleware;

Route::controller(LoginController::class)->group(function () {
    Route::get('/login', 'showLoginForm')->name('login');
    Route::post('/login', 'login');
    Route::post('/logout', 'logout')->name('logout');
});

Route::get('/',function(){
    return view('login');
});


Route::get('admin/dashboard',function(){
    return view('admin');
})->middleware(AdminMiddleware::class);

Route::get('company/dashboard',function(){
    return view('company',[
        'company'=>Auth::user()->company()->first()
    ]);
})->middleware(CompanyMiddleware::class);

Route::get('company/dashboard/profile',function(){
    return view('companyProfile',[
        'company'=>Auth::user()->company()->first()
    ]);
})->middleware(CompanyMiddleware::class);

Route::get('/home', function () {
    return view('home',[
        'profile'=> Auth::user()->profile()->first()
    ]);
})->middleware(UserMiddleware::class);

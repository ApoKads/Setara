<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;

Route::controller(LoginController::class)->group(function () {
    Route::get('/login', 'showLoginForm')->name('login');
    Route::post('/login', 'login');
    Route::post('/logout', 'logout')->name('logout');
});

Route::get('/', function () {
    return view('home');
});

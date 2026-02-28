<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

Route::get('/', function () {
    return view('pages.dashboard');
});

Route::controller(AuthController::class)->name('register')->group(function () {
    Route::get('/register', 'register');
    Route::post('/register', 'registerPost')->name('.post');
});

Route::controller(AuthController::class)->name('login')->group(function () {
    Route::get('/login', 'login');
    Route::post('/login', 'loginPost')->name('.post');
});

Route::middleware('auth')->group(function () {
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::middleware('check_role:admin')->group(function () {
        Route::get('/users', [App\Http\Controllers\User\UserController::class, 'index'])->name('users.index');
    });
    Route::middleware('check_role:admin,staff')->group(function () {
        Route::get('/dashboard', fn() => view('pages.dashboard'))->name('dashboard');
    });

    Route::middleware('check_role:admin,staff,customer')->group(function () {
        Route::get('/customer', fn() => view('pages.customer'))->name('customer');
    });
});

<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

Route::get('/', function () {
    return view('pages.dashboard');
});
Route::middleware('guest')->group(function () {

    Route::controller(AuthController::class)->name('register')->group(function () {
        Route::get('/register', 'register');
        Route::post('/register', 'registerPost')->name('.post');
    });

    Route::prefix('auth/google')->name('auth.google.')->group(function () {
        Route::get('redirect', [AuthController::class, 'googleRedirect'])->name('redirect');
        Route::get('callback', [AuthController::class, 'googleCallback'])->name('callback');
    });

    Route::controller(AuthController::class)->name('login')->group(function () {
        Route::get('/login', 'login');
        Route::post('/login', 'loginPost')->name('.post');
    });
});
Route::middleware('auth')->group(function () {

    Route::middleware('check_status')->group(function () {
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

    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::controller(App\Http\Controllers\VerificationController::class)
        ->name('verification.')->group(function () {
            Route::get('/verify', 'create')->name('create');
            Route::post('/verify', 'store')->name('store');
            Route::get('/verify/{unique_id}', 'edit')->name('edit');
            Route::put('/verify/{unique_id}', 'update')->name('update');
        });
});

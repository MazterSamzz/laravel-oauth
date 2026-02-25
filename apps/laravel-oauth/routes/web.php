<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

Route::get('/', function () {
    return view('pages.dashboard');
});

Route::controller(AuthController::class)->name('login')->group(function () {
    Route::get('/login', 'index');
    Route::post('/login', 'login')->name('.post');
});
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/dashboard', fn() => view('pages.dashboard'))->name('dashboard');

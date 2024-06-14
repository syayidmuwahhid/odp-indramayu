<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('layouts.app');
});

Route::get('/login', [AuthController::class, 'index']);
Route::post('/login', [AuthController::class, 'signin'])->name('login');
Route::get('/register', [AuthController::class, 'register']);
Route::post('/register', [AuthController::class,'signup'])->name('register');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

Route::name('admin.')->group(function() {
    Route::get('/', function () {
        return view('layouts.app');
    })->name('dashboard');

    Route::resource('user', UserController::class);
});

Route::get('/slider', function () {
    return view('slider.index');
})->name('slider');
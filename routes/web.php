<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    // return view('layouts.app');
    return redirect()->route('admin.dashboard');
});

Route::get('/login', [AuthController::class, 'index']);
Route::post('/login', [AuthController::class, 'authenticate'])->name('login');
Route::get('/register', [AuthController::class, 'register']);
Route::post('/register', [AuthController::class,'signup'])->name('register');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

Route::name('admin.')->prefix('admin')->middleware('auth')->group(function() {
    Route::get('/', function () {
        return view('layouts.app');
    })->name('dashboard');

    Route::name('user.')->prefix('user')->group(function() {
        Route::get('/', function () {
            $resp = [
                'title' => 'User Management',
            ];

            return view('user.index', $resp);
        })->name('index');
    });

    Route::get('/slider', function () {
        return view('slider.index');
    })->name('slider');
});


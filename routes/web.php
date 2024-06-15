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

    Route::resource('user', UserController::class)->except('show', 'update');
    Route::post('/user/{id}', [UserController::class, 'update'])->name('user.update');
    Route::get('/user/get-data', [UserController::class, 'getDatas']);
    Route::get('/user/get-data/{id}', [UserController::class, 'getData']);
});


Route::get('/tes', function (){
    return csrf_token();
});

Route::get('/slider', function () {
    return view('slider.index');
})->name('slider');

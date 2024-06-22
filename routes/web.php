<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/login', [AuthController::class, 'index']);
Route::post('/login', [AuthController::class, 'authenticate'])->name('login');
Route::get('/register', [AuthController::class, 'register']);
Route::post('/register', [AuthController::class, 'signup'])->name('register');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

Route::name('admin.')->prefix('admin')->middleware('auth')->group(function () {
    Route::get('/', fn() => view('admin.dashboard'))->name('dashboard');

    Route::get('/user', fn () => view('admin.user.index'))->name('user.index');
    Route::get('/profile', fn () => view('admin.profile.index'))->name('profile.index');
    Route::get('/category', fn () => view('admin.category.index'))->name('category.index');
    Route::get('/tag', fn () => view('admin.tag.index'))->name('tag.index');

    Route::get('/article', fn () => view('admin.article.index'))->name('article.index');
    Route::get('/article/form', fn () => view('admin.article..form'))->name('article.form');
    Route::get('/article/{id}/edit', fn($id) => view('admin.article.update', ['id' => $id]))->name('article.update');


    Route::get('/slider', fn () => view('admin.slider.index'))->name('slider');
    Route::get('/video', fn () => view('admin.video.index'))->name('video');
});


Route::get('/', fn ()  => view('landing-page'))->name('landing-page');
Route::get('/about', fn () => view('about'))->name('about');

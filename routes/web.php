<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/login', [AuthController::class, 'index']);
Route::post('/login', [AuthController::class, 'authenticate'])->name('login');
// Route::get('/register', [AuthController::class, 'register']);
// Route::post('/register', [AuthController::class, 'signup'])->name('register');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

Route::name('admin.')->prefix('admin')->middleware('auth')->group(function () {
    Route::get('/', fn() => view('admin.dashboard'))->name('dashboard');

    Route::get('/user', fn () => view('admin.user.index'))->name('user.index');
    Route::get('/setting', fn () => view('admin.setting.index'))->name('setting.index');
    Route::get('/category', fn () => view('admin.category.index'))->name('category.index');
    Route::get('/tag', fn () => view('admin.tag.index'))->name('tag.index');

    Route::get('/article', fn () => view('admin.article.index'))->name('article.index');
    Route::get('/article/form', fn () => view('admin.article.form'))->name('article.form');
    Route::get('/article/{id}/edit', fn($id) => view('admin.article.update', ['id' => $id]))->name('article.update');

    Route::get('/slider', fn () => view('admin.slider.index'))->name('slider.index');

    Route::get('/document', fn () => view('admin.document.index'))->name('document.index');
    Route::get('/document/form', fn () => view('admin.document.form'))->name('document.form');
    Route::get('/document/{id}/edit', fn ($id) => view('admin.document.edit', ['id' => $id]))->name('document.edit');

});


Route::get('/', fn ()  => view('landing-page'))->name('landing-page');

Route::get('/article', fn ()  => view('article'))->name('article');
Route::get('/article/{id}', fn($id) => view('article-detail', ['id' => $id]))->name('article.{id}');

Route::get('/about', fn () => view('about'))->name('about');
Route::get('/contact', fn () => view('contact'))->name('contact');


<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\TagsController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VideoController;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::apiResource('user', UserController::class)->except('update');
Route::post('/user/{user}', [UserController::class, 'update'])->name('user.update');

Route::apiResource('article', ArticleController::class);

Route::apiResource('tags', TagsController::class)->except('update');
Route::post('/tags/{tags}', [TagsController::class, 'update'])->name('tags.update');

Route::apiResource('category', Category::class)->except('update');
Route::post('/category/{category}', [CategoryController::class, 'update'])->name('category.update');

Route::apiResource('video', VideoController::class);

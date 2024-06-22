<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SliderController;
use App\Http\Controllers\TagsController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VideoController;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

Route::apiResource('user', UserController::class);
// Route::post('/user/{user}', [UserController::class, 'update'])->name('user.update');

Route::apiResource('article', ArticleController::class);

Route::apiResource('profile', ProfileController::class);

Route::get('/tags/list/category', [TagsController::class, 'listByCategory'])->name('tags.list.category');
Route::apiResource('tags', TagsController::class);

Route::get('/category/list', [CategoryController::class, 'list'])->name('category.list');
Route::apiResource('category', CategoryController::class);

Route::apiResource('video', VideoController::class);

Route::apiResource('slider', SliderController::class);

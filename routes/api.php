<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SliderController;
use App\Http\Controllers\TagsController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VideoController;
use App\Mail\ContactMail;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

Route::apiResource('user', UserController::class);

Route::apiResource('article', ArticleController::class);

Route::apiResource('profile', ProfileController::class)->only('index', 'update');

Route::get('/tags/list/category', [TagsController::class, 'listByCategory'])->name('tags.list.category');
Route::apiResource('tags', TagsController::class);

Route::get('/category/list', [CategoryController::class, 'list'])->name('category.list');
Route::apiResource('category', CategoryController::class);

Route::apiResource('video', VideoController::class);

Route::apiResource('slider', SliderController::class);

Route::post('/send-email', function (Request $request) {
    $resp = [
        'status' => false,
    ];
    $code = 500;

    try {
        $data = [
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'message' => $request->input('message'),
        ];

        Mail::to('muwahhidsyayid@gmail.com')->send(new ContactMail($data));

        $resp['data'] = $request->all();
        $resp['status'] = true;
        $resp['message'] = 'Berhasil Mengirim Pesan!';
        $code = 200;
    } catch (\Throwable $th) {
        $resp['message'] = $th->getMessage();
    }
    return response()->json($resp, $code);
});

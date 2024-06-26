<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CounterController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SliderController;
use App\Http\Controllers\TagsController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VideoController;
use App\Mail\ContactMail;
use App\Models\Article;
use App\Models\Category;
use App\Models\Counter;
use App\Models\Document;
use App\Models\User;
use Carbon\Month;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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

Route::apiResource('document', DocumentController::class);

Route::apiResource('counter', CounterController::class)->only('store');

Route::get('dashboard', function (Request $request) {
    $resp = [
        'status' => false,
    ];
    $code = 500;

    try {
        $data = [
            'user_count' => User::count() - 1,
            'article_count' => Article::count(),
            'category_count' => Category::count(),
            'document_count' => Document::count(),
            'last_article' => Article::orderBy('id', 'desc')->first(),
            'monthly_article' => Article::select(DB::raw('count(id) as total_count'), DB::raw('MONTH(date) as month'))
                        ->whereYear('date', now()->year)
                        ->groupBy(DB::raw('MONTH(date)'))
                        ->get()
        ];

        $resp['status'] = true;
        $resp['message'] = 'Berhasil mengambil data';
        $resp['data'] = $data;
        $code = 200;
    } catch (\Throwable $th) {
        $resp['message'] = $th->getMessage();
    }
    return response()->json($resp, $code);
});

// Route::post('/send-email', function (Request $request) {
//     $resp = [
//         'status' => false,
//     ];
//     $code = 500;

//     try {
//         $data = [
//             'name' => $request->input('name'),
//             'email' => $request->input('email'),
//             'message' => $request->input('message'),
//         ];

//         Mail::to('muwahhidsyayid@gmail.com')->send(new ContactMail($data));

//         $resp['data'] = $request->all();
//         $resp['status'] = true;
//         $resp['message'] = 'Berhasil Mengirim Pesan!';
//         $code = 200;
//     } catch (\Throwable $th) {
//         $resp['message'] = $th->getMessage();
//     }
//     return response()->json($resp, $code);
// });

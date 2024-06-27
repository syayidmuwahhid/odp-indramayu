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
        $topRate = Counter::select(
            DB::raw('MONTH(counter.created_at) AS bulan'),
            DB::raw('(
                SELECT COUNT(sub.table_id)
                FROM counter AS sub
                WHERE MONTH(sub.created_at) = MONTH(counter.created_at)
                GROUP BY sub.table_id
                ORDER BY COUNT(sub.table_id) DESC
                LIMIT 1
            ) as jumlah_pembaca'),
            DB::raw('(
                SELECT table_id
                FROM counter AS sub2
                WHERE MONTH(sub2.created_at) = MONTH(counter.created_at)
                GROUP BY sub2.table_id
                ORDER BY COUNT(sub2.table_id) DESC
                LIMIT 1
            ) as table_id_2'),
            'table_name',
            // 'article.title'
        )
        // ->join('article', 'article.id', 'table_id')
        ->groupBy('bulan', 'jumlah_pembaca', 'table_name', 'table_id_2')
        ->having('table_name', 'article')
        ->whereYear('counter.created_at', now()->year)
        ->get();

        $result = [];
        $seen_months = [];

        foreach ($topRate as $entry) {
            if (!in_array($entry['bulan'], $seen_months)) {
                $result[] = $entry;
                $seen_months[] = $entry['bulan'];
            }
        }

        for ($i=0; $i<count($result); $i++) {
            $result[$i]['article_title'] = Article::select('article.title')
                ->where('id', $result[$i]->table_id_2)
                ->first()->title;
        }


        $data = [
            'user_count' => User::count() - 1,
            'article_count' => Article::count(),
            'category_count' => Category::count(),
            'document_count' => Document::count(),
            'last_article' => Article::orderBy('id', 'desc')->first(),
            'monthly_article' => Article::select(DB::raw('count(id) as total_count'), DB::raw('MONTH(date) as month'))
                        ->whereYear('date', now()->year)
                        ->groupBy(DB::raw('MONTH(date)'))
                        ->get(),
            'top_rate_article' => $result

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

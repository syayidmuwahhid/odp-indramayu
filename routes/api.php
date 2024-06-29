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

Route::get('/document/get', [DocumentController::class, 'getDocument']);
Route::apiResource('document', DocumentController::class);

Route::apiResource('counter', CounterController::class)->only('store');

Route::get('dashboard', function (Request $request) {
    $resp = [
        'status' => false,
    ];
    $code = 500;

    try {
        // $topRate = Counter::select(
        //     DB::raw('MONTH(counter.created_at) AS month'),
        //     DB::raw('(
        //         SELECT COUNT(sub.table_id)
        //         FROM counter AS sub
        //         WHERE MONTH(sub.created_at) = MONTH(counter.created_at)
        //         GROUP BY sub.table_id
        //         ORDER BY COUNT(sub.table_id) DESC
        //         LIMIT 1
        //     ) as visit'),
        //     DB::raw('(
        //         SELECT table_id
        //         FROM counter AS sub2
        //         WHERE MONTH(sub2.created_at) = MONTH(counter.created_at)
        //         GROUP BY sub2.table_id
        //         ORDER BY COUNT(sub2.table_id) DESC
        //         LIMIT 1
        //     ) as table_id_2'),
        //     'table_name',
        //     // 'article.title'
        // )
        // // ->join('article', 'article.id', 'table_id')
        // ->groupBy('month', 'visit', 'table_name', 'table_id_2')
        // ->having('table_name', 'article')
        // ->whereYear('counter.created_at', now()->year)
        // ->get();

        // $result = [];
        // $seen_months = [];

        // foreach ($topRate as $entry) {
        //     if (!in_array($entry['month'], $seen_months)) {
        //         $result[] = $entry;
        //         $seen_months[] = $entry['month'];
        //     }
        // }

        // for ($i=0; $i<count($result); $i++) {
        //     $result[$i]['article_title'] = Article::select('article.title')
        //         ->where('id', $result[$i]->table_id_2)
        //         ->first()->title;
        // }

        $articles = Article::select('article.*', 'users.name as user_name', 'users.email as user_email', 'category.name as category_name')
            ->join('users', 'users.id', 'user_id')
            ->join('category', 'category.id', 'category_id')
            ->orderBy('id', 'desc')->orderBy('date', 'desc')->limit(5)->get();

        foreach($articles as $article) {
            $article['visit'] = Counter::where('table_id', $article->id)->groupBy('table_id')->count();
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
            // 'top_rate_article' => $result,
            'articles' => $articles,
            'documents' => Document::orderBy('id', 'desc')->orderBy('date', 'desc')->limit(5)->get(),
            'visitor' => Counter::select(DB::raw('DAY(created_at) as day'), DB::raw('WEEKDAY(created_at) as day_of_week'), DB::raw('count(table_id) as visitor'), 'table_name')
                ->groupBy('day', 'day_of_week', 'table_name')
                ->having('table_name', 'app')
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

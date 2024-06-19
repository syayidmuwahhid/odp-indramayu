<?php

namespace App\Http\Controllers\Vue;

use App\Http\Controllers\Controller;
use App\Models\Article;
use Illuminate\Http\Request;
use Inertia\Inertia;

class HomeController extends Controller
{
    public function index()
    {
        $articles = Article::all();
        // $articles = [
        //     [
        //         'id' => 1,
        //         'title' => 'article baru',
        //         'content' => 'text article baru',
        //         'isFeature' => true,
        //     ],
        //     [
        //         'id' => 2,
        //         'title' => 'article kedua',
        //         'content' => 'text article kedua',
        //         'isFeature' => false,
        //     ],
        //     [
        //         'id' => 3,
        //         'title' => 'article ketiga',
        //         'content' => 'text article ketiga',
        //         'isFeature' => false,
        //     ],
        // ];

        return Inertia::render('Homepage', compact('articles'));
    }
}

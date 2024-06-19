<?php

namespace App\Http\Controllers\Vue;

use App\Http\Controllers\Controller;
use App\Models\Article;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Article/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'title' => 'required',
            'description' => 'required',
            "thumbnail" => 'nullable|image|mimes:png,jpg',
        ]);

        $article = Article::create($validateData);

        if($request->hasFile('thumbnail')) {
            $filePath = $request->file('thumbnail')->store('articles', 'public');
            $article->thumbnail = $filePath;
        }

        $article->save();

        return redirect()->route('homepage')->with('success', 'Article Berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $article = Article::find($id);
        return Inertia::render('Article/Edit', compact('article'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validateData = $request->validate([
            'title' => 'required',
            'description' => 'required',
            "thumbnail" => 'nullable|image|mimes:png,jpg',
        ]);

        $article = Article::find($id);
        $article->update($validateData);

        if($request->hasFile('thumbnail')) {
            $filePath = $request->file('thumbnail')->store('articles', 'public');
            $article->thumbnail = $filePath;
        }

        // $article->fill($validateData);
        $article->save();

        return redirect()->route('homepage')->with('success', 'Article Berhasil diedit!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $article = Article::find($id);
        $article->delete();
        return redirect()->route('homepage')->with('success', 'Article Berhasil dihapus!');
    }
}

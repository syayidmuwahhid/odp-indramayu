<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\ArticleTag;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Initialize the response data
        $resp = [
            'status' => false,
        ];
        $code = 500;

        DB::beginTransaction();

        try {
            // Fetch all categories from the database
            $article = Article::all();

            // Prepare the success response data
            $resp['status'] = true;
            $resp['message'] = 'Berhasil Mengambil data';
            $resp['data'] = $article;
            $code = 200;

            // Commit the database transaction
            DB::commit();
        } catch (\Throwable $th) {
            // Prepare the error response data
            $resp['message'] = $th->getMessage();

            // Rollback the database transaction in case of any error
            DB::rollBack();
        }

        // Return the response as a JSON response
        return response()->json($resp, $code);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $resp = [
            'status' => false,
        ];
        $code = 500;
        DB::beginTransaction();

        try {
            $payload = $request->validate([
                'category_id' => 'required|integer',
                'date' => 'required|date',
                'image' => 'nullable|mimes:jpeg,png,jpg,gif,svg',
                'video' => 'nullable|mimetypes:video/avi,video/mpeg,video/quicktime,video/mp4',
                'tags' => 'required',
                'title' => 'required|string|max:255',
                'content' => 'required|string',
            ]);

            $payload['user_id'] = $request->user_id;
            // $payload['user_id'] = $request->user()->id;

            $article = Article::create($payload);

            if ($request->hasFile('image')) {
                $filePath = $request->file('image')->store('articles/'.$article->id, 'public');
                $article->image = $filePath;
            }

            if ($request->hasFile('video')) {
                $filePath = $request->file('video')->store('articles/'.$article->id, 'public');
                $article->video = $filePath;
            }

            $article->save();

            //article tag
            $articleTag = new ArticleTag();
            $articleTag->article_id = $article->id;
            $articleTag->save();

            //tags
            $tags = explode(',', $request->tags);

            foreach($tags as $tag) {
                $tagModel = new Tag();
                $tagModel->name = $tag;
                $tagModel->article_tag_id = $articleTag->id;
                $tagModel->save();
            }

            $resp['status'] = true;
            $resp['message'] = 'Berhasil menyimpan data';
            $code = 200;
            DB::commit();
        } catch (\Throwable $th) {
            // Prepare the error response data
            $resp['message'] = $th->getMessage();

            // Rollback the database transaction
            DB::rollBack();
        }
        return response()->json($resp, $code);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Initialize the response data
        $resp = [
            'status' => false,
        ];
        $code = 500;

        DB::beginTransaction();

        try {
            // Find the article by its unique identifier
            $article = Article::find($id);
            $tags = Tag::select('tag.name', 'article_tag.article_id')
                ->join('article_tag', "article_tag.id", "article_tag_id")
                ->having("article_tag.article_id", $id)
                ->get();
            $article['tags'] =  $tags;

            // Prepare the success response data
            $resp['status'] = true;
            $resp['message'] = 'Berhasil Mengambil data';
            $resp['data'] = $article;
            $code = 200;

            // Commit the database transaction
            DB::commit();
        } catch (\Throwable $th) {
            // Prepare the error response data
            $resp['message'] = $th->getMessage();

            // Rollback the database transaction
            DB::rollBack();
        }

        // Return the response as a JSON response
        return response()->json($resp, $code);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        {
            $resp = [
                'status' => false,
            ];
            $code = 500;
            DB::beginTransaction();

            try {
                $payload = $request->validate([
                    'category_id' => 'required|integer',
                    'date' => 'required|date',
                    'image' => 'nullable|mimes:jpeg,png,jpg,gif,svg',
                    'video' => 'nullable|mimetypes:video/avi,video/mpeg,video/quicktime,video/mp4',
                    'tags' => 'required',
                    'title' => 'required|string|max:255',
                    'content' => 'required|string',
                ]);

                $payload['user_id'] = $request->user_id;

                $article = Article::where('id', $id)->update($payload);

                if ($request->hasFile('image')) {
                    $filePath = $request->file('image')->store('articles/'.$article->id, 'public');
                    $article->image = $filePath;
                }

                if ($request->hasFile('video')) {
                    $filePath = $request->file('video')->store('articles/'.$article->id, 'public');
                    $article->video = $filePath;
                }

                $article->save();

                //article tag
                $articleTag = ArticleTag::where('article_id', $id)->first('id');

                //tags
                $tags = explode(',', $request->tags);

                //remove last tags
                Tag::where('article_tag_id', $articleTag->id)->delete();

                foreach($tags as $tag) {
                    $tagModel = new Tag();
                    $tagModel->name = $tag;
                    $tagModel->article_tag_id = $articleTag->id;
                    $tagModel->save();
                }

                $resp['status'] = true;
                $resp['message'] = 'Berhasil merubah data';
                $code = 200;
                DB::commit();
            } catch (\Throwable $th) {
                // Prepare the error response data
                $resp['message'] = $th->getMessage();

                // Rollback the database transaction
                DB::rollBack();
            }
            return response()->json($resp, $code);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Start a database transaction
        DB::beginTransaction();

        // Initialize the response data
        $resp = [
            'status' => false,
        ];
        $code = 500;

        try {
            // Find the user by its unique identifier
            $article = Article::find($id);

            // Delete the user
            $article->delete();

            // Check if the file exists and delete it
            if (File::exists($article->image)) {
                File::delete($article->image);
            }

            if (File::exists($article->video)) {
                File::delete($article->video);
            }

            // Prepare the success response data
            $resp['status'] = true;
            $resp['message'] = 'data berhasil dihapus';
            $code = 200;

            // Commit the database transaction
            DB::commit();
        } catch (\Throwable $th) {
            // Prepare the error response data
            $resp['message'] = $th->getMessage();

            // Rollback the database transaction
            DB::rollBack();
        }

        // Return the response as a JSON response
        return response()->json($resp, $code);
    }
}

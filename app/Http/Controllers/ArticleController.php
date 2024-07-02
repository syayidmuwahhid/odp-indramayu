<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\ArticleTag;
use App\Models\Counter;
use App\Models\Tag;
use Error;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        // Initialize the response data
        $resp = [
            'status' => false,
        ];
        $code = 500;

        // Start a database transaction
        DB::beginTransaction();

        try {
            // Fetch all articles from the database with related category and user data
            $articles = Article::select('article.*', 'category.name as category_name', 'users.name as user_name', 'users.email as user_email')
                ->join('category', 'category.id', 'category_id')
                ->join('users', 'users.id', 'user_id')
                ->get();

            // Fetch tags for each article
            foreach($articles as $article) {
                $article['tags'] = Tag::select('tag.name', 'article_tag.article_id')
                    ->join('article_tag', "article_tag.id", "article_tag_id")
                    ->where("article_tag.article_id", $article->id)
                    ->get();
            }

            // Prepare the success response data
            $resp['status'] = true;
            $resp['message'] = 'Berhasil Mengambil data';
            $resp['data'] = $articles;
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
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     * @throws \Exception
     */
    public function store(Request $request)
    {
        // Initialize the response data
        $resp = [
            'status' => false,
        ];
        $code = 500;

        // Start a database transaction
        DB::beginTransaction();

        try {
            // Validate and retrieve the request data
            $payload = $request->validate([
                'category_id' => 'required|integer',
                'date' => 'required|date',
                'image' => 'nullable|mimes:jpeg,png,jpg,gif,svg|file|max:8192',
                'video' => 'nullable|mimes:avi,mpeg,quicktime,mp4|file|max:8192',
                'tags' => 'required',
                'title' => 'required|string|max:255',
                'content' => 'required|string',
                'slug' => 'required|string',
            ]);

            //check duplicate article
            $dup = Article::where('title', $payload['title'])->count();

            if ($dup > 0) {
                throw new Error("Judul sudah digunakan!");
            }

            // Assign the user_id from the request to the payload
            $payload['user_id'] = $request->user_id;

            // Create a new article using the validated payload
            $article = Article::create($payload);

            // If an image file is present in the request, store it and update the article's image attribute
            if ($request->hasFile('image')) {
                $filePath = $request->file('image')->store('articles/'.$article->id, 'public');
                $article->image = 'storage/' . $filePath;
            }

            // If a video file is present in the request, store it and update the article's video attribute
            if ($request->hasFile('video')) {
                $filePath = $request->file('video')->store('articles/'.$article->id, 'public');
                $article->video = 'storage/' . $filePath;
            }

            // Save the updated article
            $article->save();

            // Create a new ArticleTag instance
            $articleTag = new ArticleTag();
            // Assign the article's id to the article_tag's article_id attribute
            $articleTag->article_id = $article->id;
            // Save the article_tag
            $articleTag->save();

            // Split the tags string by comma and create new Tag instances for each tag
            $tags = explode(',', $request->tags);
            foreach($tags as $tag) {
                $tagModel = new Tag();
                $tagModel->name = $tag;
                $tagModel->article_tag_id = $articleTag->id;
                $tagModel->save();
            }

            // Prepare the success response data
            $resp['status'] = true;
            $resp['message'] = 'Berhasil menyimpan data';
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
     * Display the specified resource.
     *
     * @param string $id The unique identifier of the article to be displayed.
     * @return \Illuminate\Http\JsonResponse The response containing the status, message, and data of the article.
     *
     * @throws \Exception In case of any database transaction errors.
     */
    public function show(string $id)
    {
        // Initialize the response data
        $resp = [
            'status' => false,
        ];
        $code = 500;

        // Start a database transaction
        DB::beginTransaction();

        try {
            // Find the article by its unique identifier
            $article = Article::find($id);
            $article->User; // Eager loading the related user data

            // Fetch tags for the article
            $tags = Tag::select('tag.name', 'article_tag.article_id')
                ->join('article_tag', "article_tag.id", "article_tag_id")
                ->where("article_tag.article_id", $id)
                ->get();

            // Attach the fetched tags to the article
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

            // Rollback the database transaction in case of any error
            DB::rollBack();
        }

        // Return the response as a JSON response
        return response()->json($resp, $code);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request The incoming request containing the updated article data.
     * @param string $id The unique identifier of the article to be updated.
     *
     * @return \Illuminate\Http\JsonResponse The response containing the status, message, and HTTP status code.
     *
     * @throws \Exception In case of any database transaction errors.
     */
    public function update(Request $request, string $id)
    {
        // Initialize the response data
        $resp = [
            'status' => false,
        ];
        $code = 500;

        // Start a database transaction
        DB::beginTransaction();

        try {
            // Validate and retrieve the request data
            $payload = $request->validate([
                'category_id' => 'required|integer',
                'date' => 'required|date',
                'image' => 'nullable|mimes:jpeg,png,jpg,gif,svg|file|max:8192',
                'video' => 'nullable|mimes:avi,mpeg,quicktime,mp4|file|max:8192',
                'tags' => 'required',
                'title' => 'required|string|max:255',
                'content' => 'required|string',
                'slug' => 'required|string',
            ]);

            // Find the article by its unique identifier
            $article = Article::find($id);
            $oldTitle = $article->title;

            if ($oldTitle != $payload['title']) {
                //check duplicate article
                $dup = Article::where('title', $payload['title'])->count();

                if ($dup > 0) {
                    throw new Error("Judul sudah digunakan!");
                }
            }

            // Store the old image and video paths for deletion
            $oldImg = $article->image;
            $oldVideo = $article->video;

            // Fill the article with the validated payload
            $article->fill($payload);

            // If an image file is present in the request, store it and update the article's image attribute
            if ($request->hasFile('image')) {
                $filePath = $request->file('image')->store('articles/'.$article->id, 'public');
                $article->image = 'storage/' . $filePath;
            }

            // If a video file is present in the request, store it and update the article's video attribute
            if ($request->hasFile('video')) {
                $filePath = $request->file('video')->store('articles/'.$article->id, 'public');
                $article->video = 'storage/' . $filePath;
            }

            // Delete the old image and video files if they exist
            if ($request->hasFile('image') && File::exists($oldImg)) {
                File::delete($oldImg);
            }

            if ($request->hasFile('video') && File::exists($oldVideo)) {
                File::delete($oldVideo);
            }

            // Save the updated article
            $article->save();

            // Fetch the article's article tag
            $articleTag = ArticleTag::where('article_id', $article->id)->first();

            // Split the tags string by comma and create new Tag instances for each tag
            $tags = explode(',', $request->tags);

            // Delete the old tags for the article
            Tag::where('article_tag_id', $articleTag->id)->delete();

            // Create new Tag instances for each tag
            foreach($tags as $tag) {
                $tagModel = new Tag();
                $tagModel->name = $tag;
                $tagModel->article_tag_id = $articleTag->id;
                $tagModel->save();
            }

            // Prepare the success response data
            $resp['status'] = true;
            $resp['message'] = 'Berhasil update data';
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
     * Remove the specified resource from storage.
     *
     * @param string $id The unique identifier of the article to be deleted.
     *
     * @return \Illuminate\Http\JsonResponse The response containing the status, message, and HTTP status code.
     *
     * @throws \Exception In case of any database transaction errors.
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
            // Find the article by its unique identifier
            $article = Article::find($id);

            // Delete the article
            $article->delete();

            // Check if the image file exists and delete it
            if (File::exists($article->image)) {
                File::delete($article->image);
            }

            // Check if the video file exists and delete it
            if (File::exists($article->video)) {
                File::delete($article->video);
            }

            // Fetch the article's article tag
            $articleTag = ArticleTag::where('article_id', $article->id)->first();

            // Delete the tags associated with the article
            Tag::where('article_tag_id', $articleTag->id)->delete();

            // Delete the article tag
            ArticleTag::where('article_id', $article->id)->delete();

            // Prepare the success response data
            $resp['status'] = true;
            $resp['message'] = 'Data berhasil dihapus';
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
     * Get the most popular articles based on visitor count.
     *
     * @return \Illuminate\Http\JsonResponse The response containing the status, message, and data of the popular articles.
     *
     * @throws \Exception In case of any database transaction errors.
     */
    public function popular()
    {
        // Start a database transaction
        DB::beginTransaction();

        // Initialize the response data
        $resp = [
            'status' => false,
        ];
        $code = 500;

        try {
            // Fetch the most visited articles by joining the Counter, Article, Category, and Users tables
            // Group by table_id and table_name, having table_name as 'article'
            // Order by visitor count in descending order and limit the result to 4
            $counter = Counter::select(DB::raw('COUNT(table_id) as visitor'), 'table_id', 'article.title', 'article.content', 'article.image', 'user_id', 'date', 'category_id', 'category.name as category_name', 'users.name as user_name', 'users.email as user_email', 'article.slug')
                ->join('article', 'table_id', 'article.id')
                ->join('category', 'category.id', 'category_id')
                ->join('users', 'users.id', 'user_id')
                ->groupBy('table_id', 'table_name', 'article.title', 'article.content', 'article.image', 'user_id', 'date', 'category_id', 'category.name', 'users.name', 'users.email', 'slug')
                ->having('table_name', 'article')
                ->orderBy('visitor', 'desc')
                ->limit(4)
                ->get();

            // Fetch tags for each article
            foreach($counter as $article) {
                $article['tags'] = Tag::select('tag.name', 'article_tag.article_id')
                    ->join('article_tag', "article_tag.id", "article_tag_id")
                    ->where("article_tag.article_id", $article->table_id)
                    ->get();
            }

            // Attach the fetched tags to the articles
            $resp['data'] = $counter;

            // Prepare the success response data
            $resp['status'] = true;
            $resp['message'] = 'Data berhasil diambil';
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
     * Display the specified resource.
     *
     * @param string $id The unique identifier of the article to be displayed.
     * @return \Illuminate\Http\JsonResponse The response containing the status, message, and data of the article.
     *
     * @throws \Exception In case of any database transaction errors.
     */
    public function showSlug(string $slug)
    {
        // Initialize the response data
        $resp = [
            'status' => false,
        ];
        $code = 500;

        // Start a database transaction
        DB::beginTransaction();

        try {
            // Find the article by its unique identifier
            $article = Article::where('slug', $slug)->first();
            $article->User; // Eager loading the related user data

            // Fetch tags for the article
            $tags = Tag::select('tag.name', 'article_tag.article_id')
                ->join('article_tag', "article_tag.id", "article_tag_id")
                ->where("article_tag.article_id", $article->id)
                ->get();

            // Attach the fetched tags to the article
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

            // Rollback the database transaction in case of any error
            DB::rollBack();
        }

        // Return the response as a JSON response
        return response()->json($resp, $code);
    }
}

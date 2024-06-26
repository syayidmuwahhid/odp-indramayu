<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TagsController extends Controller
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
            // Fetch all tags from the database
            $tags = Tag::all();

            // Eager load related models to optimize the query
            foreach ($tags as $tag) {
                $tag->ArticleTag->Article;
            }

            // Prepare the success response data
            $resp['status'] = true;
            $resp['message'] = 'Berhasil Mengambil Data';
            $resp['data'] = $tags;
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
     */
    public function store(Request $request)
    {
        // Return the incoming request data as JSON response for testing purposes
        return response()->json($request->all());

        // Start a database transaction to ensure data integrity
        DB::beginTransaction();

        // Initialize the response data
        $resp = [
            'status' => false,
        ];
        $code = 500;

        try {
            // Validate the incoming request data
            $request->validate([
                'name' => ['required']
            ]);

            // Prepare the payload for creating a new Tag
            $payload = $request->only('name');

            // Create a new Tag in the database
            Tag::create($payload);

            // Prepare the success response data
            $resp['status'] = true;
            $resp['message'] = 'Berhasil Menambah data';
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
     * @param string $id The unique identifier of the Tag to be displayed.
     * @return \Illuminate\Http\JsonResponse The response containing the status, message, and data of the Tag.
     * @throws \Throwable If any error occurs during the database transaction.
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
            // Find the Tag by its unique identifier
            $tag = Tag::find($id);

            // Prepare the success response data
            $resp['status'] = true;
            $resp['message'] = 'Berhasil Mengambil Data';
            $resp['data'] = $tag;
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
        // Start a database transaction
        DB::beginTransaction();

        // Initialize the response data
        $resp = [
            'status' => false,
        ];
        $code = 500;

        try {
            return response()->json($request->all());
            // Validate the incoming request data
            $request->validate([
                'name' => ['required'],
            ]);

            // Prepare the payload for updating the user
            $payload = $request->only('name');

            // Find the user by its unique identifier
            $tag = Tag::find($id);

            // Update the category with the provided payload
            $tag->fill($payload);
            $tag->save();

            // Prepare the success response data
            $resp['status'] = true;
            $resp['message'] = 'Berhasil diupdate';
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
            return response()->json($id);
            // Find the user by its unique identifier
            $tag = Tag::find($id);

            // Delete the user
            $tag->delete();

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


    public function listByCategory(Request $request) {
        // Start a database transaction
        DB::beginTransaction();

        // Initialize the response data
        $resp = [
            'status' => false,
        ];
        $code = 500;

        try {
            $idCategory = $request->query('id');
            $tags = Tag::select('category.id as category_id', 'tag.name')
                ->join('article_tag', 'article_tag.id', 'article_tag_id')
                ->join('article', 'article_id', 'article.id')
                ->join('category', 'category.id', 'category_id')
                ->where('category.id', $idCategory)
                ->get();

            $resp['status'] = true;
            $resp['message'] = 'Berhasil Mengambil Data';
            $resp['data'] = $tags;
            $code = 200;
        } catch (\Throwable $th) {
            // Prepare the error response data
            $resp['message'] = $th->getMessage();

            // Rollback the database transaction
            DB::rollBack();
        }
        return response()->json($resp, $code);
    }

}

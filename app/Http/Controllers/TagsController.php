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

       try {
           // Fetch all categories from the database
           $tag = Tag::all();

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
    return response()->json($request->all());
       // Start a database transaction
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

           // Prepare the payload for creating a new data
           $payload = $request->only('name');

           // Create a new user in the database
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

           // Rollback the database transaction
           DB::rollBack();
       }

       // Return the response as a JSON response
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

       try {
           // Find the user by its unique identifier
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

}

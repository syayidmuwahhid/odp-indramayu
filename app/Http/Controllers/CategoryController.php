<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
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
            $category = Category::all();

            // Prepare the success response data
            $resp['status'] = true;
            $resp['message'] = 'Berhasil Mengambil data';
            $resp['data'] = $category;
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
     * @throws \Throwable
     */
    public function store(Request $request)
    {
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
            Category::create($payload);

            // Prepare the success response data
            $resp['status'] = true;
            $resp['message'] = 'Berhasil Menambah Data';
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
     *
     * @param string $id The unique identifier of the category to be displayed.
     *
     * @return \Illuminate\Http\JsonResponse The response containing the status, message, and data of the category.
     *
     * @throws \Throwable If any error occurs during the database transaction.
     */
    public function show(string $id)
    {
        // Initialize the response data
        $resp = [
            'status' => false,
        ];
        $code = 500;

        try {
            // Find the category by its unique identifier
            $category = Category::find($id);

            // Prepare the success response data
            $resp['status'] = true;
            $resp['message'] = 'Berhasil Mengambil data';
            $resp['data'] = $category;
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
     *
     * @param Request $request The incoming request containing the updated data.
     * @param string $id The unique identifier of the category to be updated.
     *
     * @return \Illuminate\Http\JsonResponse The response containing the status, message, and updated data.
     *
     * @throws \Illuminate\Validation\ValidationException If the incoming request data is not valid.
     * @throws \Throwable If any error occurs during the database transaction.
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
            // Validate the incoming request data
            $request->validate([
                'name' => ['required'],
            ]);

            // Prepare the payload for updating the category
            $payload = $request->only('name');

            // Find the category by its unique identifier
            $category = Category::find($id);

            // Update the category with the provided payload
            $category->fill($payload);
            $category->save();

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
     *
     * @param string $id The unique identifier of the category to be deleted.
     *
     * @return \Illuminate\Http\JsonResponse The response containing the status, message, and deletion result.
     *
     * @throws \Throwable If any error occurs during the database transaction.
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
            // Find the category by its unique identifier
            $category = Category::find($id);

            // Delete the category
            $category->delete();

            // Prepare the success response data
            $resp['status'] = true;
            $resp['message'] = 'Data berhasil dihapus';
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

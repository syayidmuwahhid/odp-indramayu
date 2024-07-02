<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MenuController extends Controller
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
            // Fetch the all menu record
            $menu = Menu::all();

            // Prepare the success response data
            $resp['status'] = true;
            $resp['message'] = 'Berhasil Mengambil Data';
            $resp['data'] = $menu;
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
     * Store a newly created resource in storage.
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
            $payload = $request->validate([
                'title' => 'required',
                'description' => 'required',
                'url' => 'required',
                'status' => 'required',
            ]);

            // Create a new menu in the database
            Menu::create($payload);

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
            // Fetch the all menu record
            $menu = Menu::find($id);

            // Prepare the success response data
            $resp['status'] = true;
            $resp['message'] = 'Berhasil Mengambil Data';
            $resp['data'] = $menu;
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
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
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
             // Validate the incoming request data
             $payload = $request->validate([
                 'title' => 'required',
                 'description' => 'required',
                 'url' => 'required',
                 'status' => 'required',
             ]);

             // Create a new menu in the database
             Menu::where('id', $id)->update($payload);

             // Prepare the success response data
             $resp['status'] = true;
             $resp['message'] = 'Berhasil Meubah Data';
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
             // Find the menu by its unique identifier
             $menu = Menu::find($id);

             // Delete the slider
             $menu->delete();

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

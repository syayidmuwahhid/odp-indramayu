<?php

namespace App\Http\Controllers;

use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SliderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    function index() {
        // Initialize the response data
        $resp = [
            'status' => false,
        ];
        $code = 500;

        DB::beginTransaction();
        try {
            // Fetch all users except superadmin
            $slider = Slider::all();

            // Prepare the success response data
            $resp['status'] = true;
            $resp['message'] = 'Berhasil Mengambil Data';
            $resp['data'] = $slider;
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
            $request->validate([
                'name' => ['required'],
                'file' => ['required'],
                'description' => ['required'],
            ]);

            // Prepare the file path
            $path = "storage/slider/";

            // Generate a unique name for the file
            $img_name = time(). $request->file('file')->hashName();

            // Move the uploaded file to the specified location
            $request->file('file')->move($path, $img_name);

            // Prepare the full file path
            $filename = $path. $img_name;

            $payload = $request->only('name', 'description');
            $payload['location'] = $filename;

            // Create a new user in the database
            Slider::create($payload);

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

        DB::beginTransaction();

        try {
            // Find the category by its unique identifier
            $slider= Slider::find($id);

            // Prepare the success response data
            $resp['status'] = true;
            $resp['message'] = 'Berhasil Mengambil data';
            $resp['data'] = $slider;
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
        return response()->json($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        return response()->json($request->all());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        return response()->json($id);
    }
}

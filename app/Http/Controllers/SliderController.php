<?php

namespace App\Http\Controllers;

use App\Models\Slider;
use Error;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

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
                'title' => 'required',
                'file' => 'required|mimes:jpeg,png,jpg,gif,svg,avi,mpeg,quicktime,mp4|file|max:8192',
                'description' => 'required',
            ]);

            $ext = $request->file('file')->extension();

            // Prepare the file path
            $path = "storage/slider/";

            // Generate a unique name for the file
            $img_name = time(). $request->file('file')->hashName();

            // Move the uploaded file to the specified location
            $request->file('file')->move($path, $img_name);

            // Prepare the full file path
            $filename = $path. $img_name;

            //setup data
            $payload = $request->only('title', 'description');
            $payload['location'] = $filename;

            $payload['type'] = $ext == 'png' || $ext == 'jpeg' || $ext == 'jpg' || $ext == 'gif' || $ext == 'svg' ? 'image' : 'video';

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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $id
     * @return \Illuminate\Http\JsonResponse
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
            // Find the slider by its unique identifier
            $slider = Slider::find($id);

            // Store the old image location
            $oldSliderImg = $slider->location;

            // Validate the incoming request data
            $request->validate([
                'title' => 'required',
                'description' => 'required',
                'file' => 'nullable|mimes:jpeg,png,jpg,gif,svg,avi,mpeg,quicktime,mp4|file|max:8192',
            ]);


            // Prepare the data to be updated
            $payload = $request->only('title', 'description');

            // Prepare the file path
            $path = "storage/slider/";

            // If a new file is uploaded
            if ($request->hasFile('file')) {
                $ext = $request->file('file')->extension();
                $payload['type'] = $ext == 'png' || $ext == 'jpeg' || $ext == 'jpg' || $ext == 'gif' || $ext == 'svg' ? 'image' : 'video';

                // Generate a unique name for the file
                $img_name = time(). $request->file('file')->hashName();

                // Move the uploaded file to the specified location
                $request->file('file')->move($path, $img_name);

                // Prepare the full file path
                $payload['location'] = $path . $img_name;
            }


            // Update the slider data
            $slider->fill($payload);
            $slider->save();

            // If a new file is uploaded and the old file exists, delete the old file
            if ($request->hasFile('file') && File::exists($oldSliderImg)) {
                File::delete($oldSliderImg);
            }

            // Prepare the success response data
            $resp['message'] = 'Berhasil update data';
            $resp['status'] = true;
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
            // Find the user by its unique identifier
            $slider = Slider::find($id);

            // Delete the user
            $slider->delete();

            // Check if the file exists and delete it
            if (File::exists($slider->location)) {
                File::delete($slider->location);
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

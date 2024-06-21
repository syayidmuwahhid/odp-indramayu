<?php

namespace App\Http\Controllers;

use App\Models\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class VideoController extends Controller
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
            // Fetch all users except superadmin
            $video = Video::all();

            // Prepare the success response data
            $resp['status'] = true;
            $resp['message'] = 'Berhasil Mengambil Data';
            $resp['data'] = $video;
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
                'title' => ['required'],
                'file' => ['required'],
                'description' => ['required'],
            ]);
            
            $payload = $request->only('title', 'description');
            
            // Prepare the file path
            $path = "storage/video/" . $request->title . "/";
            
            // Generate a unique name for the file
            $video_name = time(). $request->file('file')->hashName();
            
            // Move the uploaded file to the specified location
            $request->file('file')->move($path, $video_name);

            // Prepare the full file path
            $payload['location'] = $path . $video_name;
            $payload['thumbnail'] = 'https://static.vecteezy.com/system/resources/previews/002/162/107/original/camera-video-illustration-hand-drawing-vector.jpg';

            if ($request->hasFile('thumbnail')) {
                // Generate a unique name for the file
                $img_name = time(). $request->file('thumbnail')->hashName();
                
                // Move the uploaded file to the specified location
                $request->file('thumbnail')->move($path, $img_name);

                // Prepare the full file path
                $payload['thumbnail'] = $path . $img_name;
            }
            
            // Create a new user in the database
            Video::create($payload);
            
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
            $video= Video::find($id);

            // Prepare the success response data
            $resp['status'] = true;
            $resp['message'] = 'Berhasil Mengambil data';
            $resp['data'] = $video;
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
            // Validate the incoming request data
            $request->validate([
                'title' => ['required'],
                'description' => ['required'],
            ]);

            $video = Video::find($id);
            $oldVideo = $video->location;
            $oldThumbnail = $video->thumbnail;

            $payload = $request->only('title', 'description');

            // Prepare the file path
            $path = "storage/video/" . $request->title . "/";

            if ($request->hasFile('file')) {
                // Generate a unique name for the file
                $video_name = time(). $request->file('file')->hashName();

                // Move the uploaded file to the specified location
                $request->file('file')->move($path, $video_name);

                // Prepare the full file path
                $payload['location'] = $path . $video_name;
            }

            if ($request->hasFile('thumbnail')) {
                 // Generate a unique name for the file
                $img_name = time(). $request->file('thumbnail')->hashName();

                // Move the uploaded file to the specified location
                $request->file('thumbnail')->move($path, $img_name);

                // Prepare the full file path
                $payload['thumbnail'] = $path . $img_name;
            }

            // Create a new user in the database
            $video->fill($payload);
            $video->save();

            // If a new file is uploaded and the old file exists, delete the old file
            if ($request->hasFile('file') && File::exists($oldVideo)) {
                File::delete($oldVideo);
            }

            // If a new file is uploaded and the old file exists, delete the old file
            if ($request->hasFile('thumbnail') && File::exists($oldThumbnail)) {
                File::delete($oldThumbnail);
            }

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
            $video = Video::find($id);

            // Delete the user
            $video->delete();

            // Check if the file exists and delete it
            if (File::exists($video->location)) {
                File::delete($video->location);
            }

            // Check if the file exists and delete it
            if (File::exists($video->thumbnail)) {
                File::delete($video->thumbnail);
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

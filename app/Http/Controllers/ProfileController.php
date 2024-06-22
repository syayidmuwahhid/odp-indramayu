<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class ProfileController extends Controller
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
            $profile = Profile::first();

            // Prepare the success response data
            $resp['status'] = true;
            $resp['message'] = 'Berhasil Mengambil Data';
            $resp['data'] = $profile;
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
        // Initialize the response data
        $resp = [
            'status' => false,
        ];
        $code = 500;

        // Start a database transaction
        DB::beginTransaction();

        try {
            // Validate the incoming request data
            $payload = $request->validate([
                'app_name' => 'required',
                'banner' => 'nullable|mimes:jpeg,png,bmp,gif,svg,webp',
                'facebook' => 'required',
                'history' => 'required',
                'icon' => 'nullable|mimes:jpeg,png,bmp,gif,svg,webp',
                'instagram' => 'required',
                'description' => 'required',
                'keywords' => 'required',
                'tags' => 'required',
                'title' => 'required',
                'x' => 'required',
                'youtube' => 'required',
            ]);

            // Find the slider by its unique identifier
            $profile = Profile::find(1);
            $oldBanner = $profile->banner;
            $oldIcon = $profile->icon;

            $profile::where('id', 1)->update($payload);

            if ($request->hasFile('banner')) {
                $filePath = $request->file('banner')->store('profile', 'public');
                $profile->banner = 'storage/' . $filePath;
            }

            if ($request->hasFile('icon')) {
                $filePath = $request->file('icon')->store('profile', 'public');
                $profile->icon = 'storage/' . $filePath;
            }

            $profile->save();

            // If a new file is uploaded and the old file exists, delete the old file
            if ($request->hasFile('banner') && File::exists($oldBanner)) {
                File::delete($oldBanner);
            }

            if ($request->hasFile('icon') && File::exists($oldIcon)) {
                File::delete($oldIcon);
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
        //
    }
}

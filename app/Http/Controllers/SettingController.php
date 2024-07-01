<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class SettingController extends Controller
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
            // Fetch the first profile record
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
            // Validate the incoming request data
            $payload = $request->validate([
                'app_name' => 'required',
                'facebook' => 'required',
                'icon' => 'nullable|mimes:jpeg,png,bmp,gif,svg,webp|file|max:8192',
                'instagram' => 'required',
                'description' => 'required',
                'keywords' => 'required',
                'tags' => 'required',
                'title' => 'required',
                'x' => 'required',
                'youtube' => 'required',
                'visi' => 'required',
                'misi' => 'required',
                'history' => 'required',
                'geografi' => 'required',
                'demografi' => 'required',
            ]);

            // Find the slider by its unique identifier
            $profile = Profile::find(1);
            $oldBanner = $profile->banner;
            $oldIcon = $profile->icon;

            // Update the profile record
            $profile::where('id', 1)->update($payload);

            // If a new icon is provided, store it and update the profile record
            if ($request->hasFile('icon')) {
                $filePath = $request->file('icon')->store('profile', 'public');
                $profile->icon = 'storage/' . $filePath;
            }

            // Save the profile record
            $profile->save();

            // If a new icon is provided and the old icon exists, delete the old icon
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
}

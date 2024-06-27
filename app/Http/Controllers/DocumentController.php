<?php

namespace App\Http\Controllers;

use App\Models\Document;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class DocumentController extends Controller
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
            // Fetch all categories from the database
            $documents = Document::select('document.*', 'users.name as user_name', 'users.email as user_email')
                ->join('users', 'users.id', 'user_id')
                ->get();

            // Prepare the success response data
            $resp['status'] = true;
            $resp['message'] = 'Berhasil Mengambil data';
            $resp['data'] = $documents;
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
        $resp = [
            'status' => false,
        ];
        $code = 500;
        DB::beginTransaction();

        try {
            $payload = $request->validate([
                'title' => 'required',
                'date' => 'required|date',
                'author' => 'required',
                'type' => 'required',
                'file' => 'nullable|mimes:pdf',
                'link' => 'nullable',
            ]);

            $payload['user_id'] = $request->user_id;
            $payload['location'] = '';

            $document = Document::create($payload);

            if ($payload['type'] == 'Upload') {
                $filePath = $request->file('file')->store('documents/'.$document->id, 'public');
                $document->location = 'storage/' . $filePath;
            } else {
                $document->location = $payload['link'];
            }

            $document->save();

            $resp['status'] = true;
            $resp['message'] = 'Berhasil menyimpan data';
            $code = 200;
            DB::commit();
        } catch (\Throwable $th) {
            // Prepare the error response data
            $resp['message'] = $th->getMessage();

            // Rollback the database transaction
            DB::rollBack();
        }
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
            // Fetch all categories from the database
            $document = Document::find($id);

            // Prepare the success response data
            $resp['status'] = true;
            $resp['message'] = 'Berhasil Mengambil data';
            $resp['data'] = $document;
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
     */
    public function update(Request $request, string $id)
    {
        $resp = [
            'status' => false,
        ];
        $code = 500;
        DB::beginTransaction();

        try {
            $payload = $request->validate([
                'title' => 'required',
                'date' => 'required|date',
                'author' => 'required',
                'type' => 'required',
                'file' => 'nullable|mimes:pdf',
                'link' => 'nullable',
            ]);

            $document = Document::find($id);
            $oldFile = $document->location;
            $document->fill($payload);

            if ($payload['type'] == 'Upload' && $request->hasFile('file')) {
                $filePath = $request->file('file')->store('documents/'.$document->id, 'public');
                $document->location = 'storage/' . $filePath;
            }

            if ($payload['type'] == 'Link'){
                $document->location = $payload['link'];
            }

            if ($payload['type'] == 'Upload' && $request->hasFile('file') && File::exists($oldFile)) {
                File::delete($oldFile);
            }

            $document->save();

            $resp['status'] = true;
            $resp['message'] = 'Berhasil merubah data';
            $code = 200;
            DB::commit();
        } catch (\Throwable $th) {
            // Prepare the error response data
            $resp['message'] = $th->getMessage();

            // Rollback the database transaction
            DB::rollBack();
        }
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
            $document = Document::find($id);

            // Delete the user
            $document->delete();

            // Check if the file exists and delete it
            if (File::exists($document->location)) {
                File::delete($document->location);
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

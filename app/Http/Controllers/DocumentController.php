<?php

namespace App\Http\Controllers;

use App\Models\Document;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class DocumentController extends Controller
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
            // Fetch all documents from the database along with user details
            $documents = Document::select('document.*', 'users.name as user_name', 'users.email as user_email')
                ->join('users', 'users.id', 'user_id')
                ->get();

            // Prepare the success response data
            $resp['status'] = true;
            $resp['message'] = 'Successfully fetched data';
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
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     * @throws \Throwable
     */
    public function store(Request $request)
    {
        // Initialize the response data
        $resp = [
            'status' => false,
        ];
        $code = 500;

        // Start a database transaction
        DB::beginTransaction();

        try {
            // Validate and retrieve the request data
            $payload = $request->validate([
                'title' => 'required',
                'date' => 'required|date',
                'author' => 'required',
                'type' => 'required',
                'status' => 'required',
                'file' => 'nullable|mimes:pdf|file|max:8192',
                'link' => 'nullable',
            ]);

            // Prepare the data for the new document
            $payload['user_id'] = $request->user_id;
            $payload['location'] = '';

            // Create a new document in the database
            $document = Document::create($payload);

            // If the document type is 'Upload', store the file and update the document location
            if ($payload['type'] == 'Upload') {
                $filePath = $request->file('file')->store('documents/'.$document->id, 'public');
                $document->location = 'storage/' . $filePath;
            } else {
                // If the document type is 'Link', update the document location with the provided link
                $document->location = $payload['link'];
            }

            // Save the updated document
            $document->save();

            // Prepare the success response data
            $resp['status'] = true;
            $resp['message'] = 'Berhasil menyimpan data';
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
     * @param string $id The unique identifier of the document to be displayed.
     *
     * @return \Illuminate\Http\JsonResponse The JSON response containing the status, message, and data of the document.
     *
     * @throws \Throwable If any error occurs during the database transaction or document retrieval.
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
            // Fetch the document from the database using its unique identifier
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
     *
     * @param Request $request The incoming request containing the updated document data.
     * @param string $id The unique identifier of the document to be updated.
     *
     * @return \Illuminate\Http\JsonResponse The JSON response containing the status, message, and updated document data.
     *
     * @throws \Illuminate\Validation\ValidationException If the incoming request data fails validation.
     * @throws \Throwable If any error occurs during the database transaction or file handling.
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
            // Validate and retrieve the request data
            $payload = $request->validate([
                'title' => 'required',
                'date' => 'required|date',
                'author' => 'required',
                'type' => 'required',
                'status' => 'required',
                'file' => 'nullable|mimes:pdf|file|max:8192',
                'link' => 'nullable',
            ]);

            // Find the document by its unique identifier
            $document = Document::find($id);

            // Store the old file location for deletion if necessary
            $oldFile = $document->location;

            // Fill the document with the updated data
            $document->fill($payload);

            // If the document type is 'Upload' and a new file is provided, store the file and update the document location
            if ($payload['type'] == 'Upload' && $request->hasFile('file')) {
                $filePath = $request->file('file')->store('documents/'.$document->id, 'public');
                $document->location = 'storage/' . $filePath;
            }

            // If the document type is 'Link', update the document location with the provided link
            if ($payload['type'] == 'Link'){
                $document->location = $payload['link'];
            }

            // If the document type is 'Upload' and a new file is provided, delete the old file if it exists
            if ($payload['type'] == 'Upload' && $request->hasFile('file') && File::exists($oldFile)) {
                File::delete($oldFile);
            }

            // Save the updated document
            $document->save();

            // Prepare the success response data
            $resp['status'] = true;
            $resp['message'] = 'Berhasil merubah data';
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
     * @param string $id The unique identifier of the document to be deleted.
     *
     * @return \Illuminate\Http\JsonResponse The JSON response containing the status and message of the deletion operation.
     *
     * @throws \Throwable If any error occurs during the database transaction or file deletion.
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
            // Find the document by its unique identifier
            $document = Document::find($id);

            // Delete the document
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

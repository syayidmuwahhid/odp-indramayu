<?php

namespace App\Http\Controllers;

use App\Models\Document;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

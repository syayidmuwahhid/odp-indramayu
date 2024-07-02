<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Counter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CounterController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     *
     * @throws \Throwable
     */
    public function store(Request $request) {
        // Initialize response array with default status as false
        $resp = [
            'status' => false,
        ];
        // Initialize HTTP status code with default value 500
        $code = 500;

        // Start database transaction
        DB::beginTransaction();
        try {
            // Get only necessary fields from request
            $payload = $request->only('table_name', 'table_id');

            if ($payload['table_name'] == 'article') {
                $article = Article::where('slug', $payload['table_id'])->first();
                $payload['table_id'] = $article->id;
            }

            // Create a new Counter record
            Counter::create($payload);

            // Update response array with success status and message
            $resp['status'] = true;
            $resp['message'] = 'Berhasil menyimpan data';

            // Update HTTP status code with success value 200
            $code = 200;

            // Commit database transaction
            DB::commit();
        } catch (\Throwable $e) {
            // Update response array with error message
            $resp['message'] = $e->getMessage();

            // Rollback database transaction
            DB::rollBack();
        }

        // Return JSON response with response array and HTTP status code
        return response()->json($resp, $code);
    }
}

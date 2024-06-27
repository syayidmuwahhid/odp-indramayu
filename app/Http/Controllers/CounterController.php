<?php

namespace App\Http\Controllers;

use App\Models\Counter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CounterController extends Controller
{
    public function store(Request $request) {
        $resp = [
            'status' => false,
        ];
        $code = 500;
        DB::beginTransaction();
        try {
            $payload = $request->only('table_name', 'table_id');
            Counter::create($payload);

            $resp['status'] = true;
            $resp['message'] = 'Berhasil menyimpan data';
            $code = 200;
            DB::commit();
        } catch (\Throwable $e) {
            $resp['message'] = $e->getMessage();
            DB::rollBack();
        }
        return response()->json($resp, $code);
    }
}

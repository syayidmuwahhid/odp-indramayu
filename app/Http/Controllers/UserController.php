<?php

namespace App\Http\Controllers;

use App\Models\User;
use Error;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $resp = [
            'title' => 'User Management',
        ];
        return view('user.index', $resp);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $resp = [
            'title' => 'Add User',
        ];
        return view('user.form', $resp);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        DB::beginTransaction();
        $resp = [
            'status' => 'fail',
        ];
        $code = 500;

        try {
            $request->validate([
                'name' => ['required'],
                'email' => ['required', 'email'],
                'password' => ['required', 'min:8'],
            ]);

            $payload = $request->only('name', 'email', 'password');
            $payload['role'] = 1;

            User::create($payload);

            $resp['status'] = 'success';
            $resp['msg'] = 'Berhasil Menambah user';
            $code = 200;
            DB::commit();
        } catch (\Throwable $th) {
            $resp['msg'] = $th->getMessage();
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
        $resp = [
            'title' => 'Edit User',
        ];
        return view('user.edit', $resp);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        DB::beginTransaction();
        $resp = [
            'status' => 'fail',
        ];
        $code = 500;

        try {
            $request->validate([
                'email' => ['email'],
                'password' => ['min:8'],
            ]);

            $payload = $request->only('name', 'email', 'password');

            $user = User::find($id);

            if ($user->role == '0') {
                throw new Error('Superadmin tidak bisa diedit');
            }

            $user->fill($payload);
            $user->save();

            $resp['status'] = 'success';
            $resp['msg'] = 'Berhasil Mengedit user';
            $code = 200;
            DB::commit();
        } catch (\Throwable $th) {
            $resp['msg'] = $th->getMessage();
            DB::rollBack();
        }

        return response()->json($resp, $code);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        DB::beginTransaction();
        $resp = [
            'status' => 'fail',
        ];
        $code = 500;

        try {
            $user = User::find($id);

            if ($user->role == '0') {
                throw new Error('Superadmin tidak bisa dihapus');
            }

            $user->delete();

            $resp['status'] = 'success';
            $resp['msg'] = 'Berhasil Menghapus user';
            $code = 200;
            DB::commit();
        } catch (\Throwable $th) {
            $resp['msg'] = $th->getMessage();
            DB::rollBack();
        }

        return response()->json($resp, $code);
    }
}

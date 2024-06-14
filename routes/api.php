<?php

use App\Http\Middleware\Authenticate;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware(Authenticate::class);

Route::get('/home', function (Request $request) {
    $resp = [
        'message' => 'Hello World!'
    ];

    return response()->json($resp, 200);
});

Route::post('/login', function (Request $request) {
    $resp = [
        'status' => false,
        'data' => '',
        'message' => '',
    ];
    $code = 200;


    $email = $request->email;
    $password = $request->password;

    $user = User::where('email', $email)->first();

    if (!$user) {
        $resp['message'] = 'User not found';
        $code = 401;
        return response()->json($resp, $code);
    }

    $token = $user->createToken(uniqid());

    $resp['status'] = true;
    $resp['message'] = 'Berhail Login';
    $resp['data'] = $token->plainTextToken;
    return response()->json($resp, $code);
});

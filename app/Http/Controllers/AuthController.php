<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('auth.login');
    }

    public function register()
    {
        return view('auth.register');
    }


    public function signin()
    {

    }

    public function signout()
    {

    }

    public function logout()
    {
        return redirect()->route('login');
    }

}

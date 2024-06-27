<?php

namespace App\Http\Controllers;

use App\Models\User;
use Error;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (Auth::check()) {
            return redirect()->route('admin.dashboard');
        }

        return view('admin.auth.login');
    }


    /**
     * Handle an authentication attempt.
     *
     * @param  \Illuminate\Http\Request  $request The incoming request.
     * @return \Illuminate\Http\RedirectResponse The redirect response after authentication.
     */
    public function authenticate(Request $request): RedirectResponse
    {
        // Validate the incoming request data
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        $remember = $request->has('remember') ? true : false;

        // Attempt to authenticate the user with the provided credentials
        if (Auth::attempt($credentials, $remember)) {

            // Regenerate the session ID
            $request->session()->regenerate();

            return redirect()->route('admin.dashboard');

            // Uncomment the following line to redirect to the intended URL
            // return redirect()->intended('dashboard');
        }

        // Return back with an error message and only the email input

        return back()->withErrors([
            'login' => 'Email atau Password Salah.',
        ])->onlyInput('email');
    }

    public function register()
    {
        return view('admin.auth.register');
    }

    public function signup(Request $request)
    {
        // Start a database transaction
        DB::beginTransaction();

        try {
            // Validate the incoming request data
            $request->validate([
                'name' => ['required'],
                'email' => ['required', 'email'],
                'password' => ['required', 'min:8'],
            ]);

            // Get all the request data
            $payload = $request->only('name', 'email', 'password', 'confirm_password');
            $payload['role'] = 1;

            // Check if the password and confirm password match
            if ($payload['password']!= $payload['confirm_password']) {
                throw new Error('Password tidak sama');
            }

            //check if email is registered
            $user = User::where('email', $payload['email'])->count();
            if ($user > 0) {
                throw new Error('Email sudah terdaftar');
            }

            // Create a new user in the database
            User::create($payload);

            // Commit the database transaction
            DB::commit();

            // Set a success flash message and redirect the user to the login page
            session()->flash('success', 'Silakan Login untuk melanjutkan');
            return redirect('/login');

        } catch (\Throwable $th) {
            // Rollback the database transaction in case of any error
            DB::rollBack();

            // Return back with an error message and the input data
            return back()->withErrors([
                'error' => $th->getMessage(),
            ])->withInput();
        }
    }

    public function logout(Request $request)
    {
        // Logout the authenticated user
        Auth::logout();

        // Invalidate all of the current user's sessions...
        $request->session()->invalidate();

        // Regenerate the session ID...
        $request->session()->regenerateToken();

        // Redirect the user to the home page
        return redirect()->route('login');
    }

}

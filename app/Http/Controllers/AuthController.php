<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class AuthController extends Controller
{
    /**
     * Show the login form
     */
    public function showLogin()
    {
        return Inertia::render('Login');
    }

    /**
     * Handle login request
     */
    public function handleLogin(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        $remember = $request->get('remember', false);

        if (Auth::attempt($credentials, $remember)) {
            $request->session()->regenerate();

            return response()->json([
                'success' => true,
                'message' => 'Login successful',
                'redirect' => route('dashboard')
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Invalid credentials. Please try again.',
            'errors' => [
                'email' => ['These credentials do not match our records.']
            ]
        ], 422);
    }

    /**
     * Handle logout
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}

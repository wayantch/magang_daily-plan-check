<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // Login page
    public function login()
    {
        return view('auth.login');
    }

    // Login process
    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            // 🔥 INI KUNCI
            if (auth()->user()->role === 'admin') {
                return redirect()->route('dashboard');
            }

            return redirect()->route('ops.home');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }


    // Register page (optional)
    public function register()
    {
        return view('auth.register');
    }

    // Register process
    // public function store(Request $request)
    // {
    //     dd($request->all());

    //     $data = $request->validate([
    //         'name'     => 'required|string|max:255',
    //         'email'    => 'required|email|unique:users',
    //         'password' => 'required|min:6|confirmed',
    //         'role'     => 'required|in:admin,ops',
    //     ]);

    //     User::create([
    //         'name'      => $data['name'],
    //         'email'     => $data['email'],
    //         'password'  => Hash::make($data['password']),
    //         'role'      => $data['role'],
    //         'is_active' => true
    //     ]);


    //     return redirect()->route('login')->with('success', 'Account created');
    // }


    // Logout
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}

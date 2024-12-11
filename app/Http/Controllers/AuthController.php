<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class AuthController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }

    public function loginPost(Request $request)
    {
        $credentials = $request->validate([
            "username" => "required",
            "password" => "required",
        ]);

        

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->route('welcome');
        }

        // Add flash data for error message
        return redirect()->back()->with('error', 'Invalid credentials')->withInput();
    }

    public function logout()
    {
        Auth::logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();
        return redirect()->route('login');
    }
}

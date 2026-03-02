<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthenticationController extends Controller
{
    public function showLogin()
    {
        return view('auth.signin'); // since your file is signin.blade.php
    }

public function login(Request $request)
{
    $request->validate([
        'email' => 'required',
        'password' => 'required'
    ]);

    /* Admin Login */
    if (Auth::guard('admin')->attempt([
        'adminEmail' => $request->email,
        'password' => $request->password
    ])) {
        $request->session()->regenerate();
        return redirect()->route('admin.dashboard');
    }

    /* Learner Login */
    if (Auth::attempt([
        'userEmail' => $request->email,
        'password' => $request->password
    ])) {
        $request->session()->regenerate();
        return redirect()->route('learner.homepage');
    }

    return back()->with('error', 'Invalid credentials');
}

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
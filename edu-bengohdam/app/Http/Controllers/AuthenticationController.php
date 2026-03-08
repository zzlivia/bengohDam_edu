<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthenticationController extends Controller
{
    public function showLogin()
    {
        return view('auth.signin'); // since file is signin.blade.php
    }

    // add registration functions
    public function showRegister()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:user,userEmail|unique:admin,adminEmail', 
            'password' => 'required|min:6|confirmed',
            'role' => 'required_if:is_admin,on' // if the checkbox is ticked
        ]);

        if ($request->has('is_admin')) {
            \App\Models\Admin::create([
                'adminName'  => $request->name,
                'adminEmail' => $request->email,
                'adminPass'  => bcrypt($request->password),
                'role'       => $request->role, 
            ]);

            return redirect()->route('login')->with('success', 'Admin account created!');
        } else {
            \App\Models\User::create([
                'userName'      => $request->name,
                'userEmail'     => $request->email,
                'userPass'      => bcrypt($request->password),
                'authenticated' => 1
            ]);

            return redirect()->route('login')->with('success', 'Learner account created!');
        }
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
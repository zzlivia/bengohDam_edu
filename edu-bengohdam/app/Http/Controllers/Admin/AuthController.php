<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.signin');
    }

    public function login(Request $request)
    {
        $credentials = [
            'adminEmail' => $request->adminEmail,
            'password' => $request->adminPass
        ];

        if (Auth::guard('admin')->attempt($credentials)) {
            return redirect()->route('admin.dashboard');
        }
        return back()->with('error', 'Invalid credentials');
    }

    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect()->route('admin.login');
    }

    public function requestReset(Request $request)
    {
        DB::table('user')
            ->where('userEmail', $request->userEmail)
            ->update(['reset_request' => 1]);

        return back()->with('success','Password reset request sent.');
    }
}
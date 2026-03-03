<?php

namespace App\Http\Controllers;
use App\Models\User;

use Illuminate\Http\Request;

class AdminController extends Controller
{

    public function dashboard()
    {
        return view('admin.admin_dashboard');
    }
    public function userManagement()
    {
        $users = User::all();

        $totalUsers = $users->count();
        $engagedThisWeek = $users->count(); // can modify later

        return view('admin.user_management', compact(
            'users',
            'totalUsers',
            'engagedThisWeek'
        ));
    }
}

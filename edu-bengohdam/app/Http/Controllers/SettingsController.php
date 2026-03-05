<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class SettingsController extends Controller
{
    //profile settings sections
    public function profile()
    {
        if(!Auth::check()){
            return redirect('/login');
        }
        $user = Auth::user();
        return view('settings.profile', compact('user'));
    }

    public function updateProfile(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email'
        ]);
        $user->name = $request->name;
        $user->email = $request->email;
        if($request->filled('new_password')){
            $user->password = bcrypt($request->new_password);
        }
        $user->save();
        return back()->with('success','Profile updated successfully');
    }

    //notification section
    public function notifications()
    {
        return view('settings.notifications');
    }
    public function saveNotifications(Request $request)
    {
        session([
            'notify_mcq' => $request->notify_mcq,
            'notify_grades' => $request->notify_grades
        ]);
        return back()->with('success','Notification settings saved');
    }

    //preference section
    public function preferences()
    {
        return view('settings.preferences');
    }

    public function savePreferences(Request $request)
    {
        session([
            'listening_mode' => $request->listening_mode,
            'sound_effects' => $request->sound_effects
        ]);
        return back()->with('success','Preferences saved');
    }
}
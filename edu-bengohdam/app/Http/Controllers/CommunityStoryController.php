<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CommunityStoryController extends Controller
{
    public function index()
    {
        return view('view_com_stories');
    }
}

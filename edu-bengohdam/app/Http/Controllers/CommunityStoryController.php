<?php

namespace App\Http\Controllers;

use App\Models\CommunityStory;

class CommunityStoryController extends Controller
{
    public function index()
    {
        $stories = CommunityStory::latest()->get();

        return view('view_com_stories', compact('stories'));
    }
}
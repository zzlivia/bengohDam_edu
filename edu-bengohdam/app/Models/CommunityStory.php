<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CommunityStory extends Model
{
    protected $fillable = [
        'community_name',
        'title',
        'community_story',
        'community_image',
        'is_active'
    ];
}

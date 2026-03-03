<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CommunityStory extends Model
{
    protected $fillable = [
        'adminID',
        'community_name',
        'title',
        'community_story',
        'community_image'
    ];

    public function admin()
    {
        return $this->belongsTo(Admin::class, 'adminID', 'adminID');
    }
}

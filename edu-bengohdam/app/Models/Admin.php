<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Admin extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'admin';
    protected $primaryKey = 'adminID';
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = [
        'adminName',
        'adminEmail',
        'adminPass',
        'adminRole'
    ];

    protected $hidden = [
        'adminPass',
    ];

    protected $casts = [
        'adminPass' => 'hashed',
    ];

    public function getAuthPassword()
    {
        return $this->adminPass;
    }

    public function announcements()
    {
        return $this->hasMany(Announcement::class, 'adminID', 'adminID');
    }

    public function reports()
    {
        return $this->hasMany(Report::class, 'generatedBy', 'adminID');
    }

    public function stories()
    {
        return $this->hasMany(CommunityStory::class, 'adminID', 'adminID');
    }
}
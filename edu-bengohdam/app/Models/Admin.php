<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    protected $table = 'admin';
    protected $primaryKey = 'adminID';

    protected $fillable = [
        'adminName',
        'adminEmail',
        'adminPass',
        'adminRole'
    ];

    public function announcements()
    {
        return $this->hasMany(Announcement::class, 'adminID', 'adminID');
    }

    public function reports()
    {
        return $this->hasMany(Report::class, 'generatedBy', 'adminID');
    }
}
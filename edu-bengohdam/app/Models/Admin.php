<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Admin extends Authenticatable //represents the admin table from db
{
    use HasFactory, Notifiable; //enable factory usage and notifications

    protected $table = 'admin'; //table name
    protected $primaryKey = 'adminID'; //custom primary key
    public $incrementing = true; //auto increment allowed
    protected $keyType = 'int';

    protected $fillable = [ //attributes
        'adminName',
        'adminEmail',
        'adminPass',
        'adminRole'
    ];

    protected $hidden = [ //hidden attributes
        'adminPass',
    ];

    protected $casts = [ //auto hashed
        'adminPass' => 'hashed',
    ];

    public function getAuthPassword() { return $this->adminPass; }

    public function announcements() { return $this->hasMany(Announcements::class, 'adminID', 'adminID'); }

    public function reports() { return $this->hasMany(Reports::class, 'generatedBy', 'adminID'); }

    public function stories() { return $this->hasMany(CommunityStory::class, 'adminID', 'adminID'); }
}
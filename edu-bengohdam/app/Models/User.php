<?php namespace App\Models; 

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable; 

class User extends Authenticatable 
{
    use HasFactory, Notifiable;
    protected $table = 'user';
    protected $primaryKey = 'userID';
    public $incrementing = true;
    protected $keyType = 'int';
    protected $fillable = ['userName', 'userEmail', 'userPass', 'userRePass', 'authenticated', ];
    protected $hidden = [ 'userPass', 'userRePass', ];

    public function enrolments() { return $this->hasMany(Enrollment::class, 'userID', 'userID'); }
    public function progress() { return $this->hasMany(Progress::class, 'userID', 'userID'); }
    public function leaderboard() { return $this->hasOne(Leaderboard::class, 'userID', 'userID'); }
    public function getAuthPassword(){ return $this->userPass; }
    public function assessmentResults(){return $this->hasMany(AssessmentResult::class, 'userID', 'userID');}
}
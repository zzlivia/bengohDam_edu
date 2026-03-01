<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $table = 'course';
    protected $primaryKey = 'courseID';

    protected $fillable = [
        'courseCode',
        'courseName',
        'courseAuthor',
        'courseDesc',
        'courseCategory',
        'courseLevel',
        'courseDuration',
        'isAvailable',
        'courseImg'
    ];

    public function modules()
    {
        return $this->hasMany(Module::class, 'courseID', 'courseID');
    }

    public function feedback()
    {
        return $this->hasMany(Feedback::class, 'courseID', 'courseID');
    }

    public function enrolments()
    {
        return $this->hasMany(Enrollment::class, 'courseID', 'courseID');
    }
}
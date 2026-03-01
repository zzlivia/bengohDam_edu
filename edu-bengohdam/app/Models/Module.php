<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Module extends Model
{
    protected $table = 'module';
    protected $primaryKey = 'moduleID';

    protected $fillable = [
        'moduleName',
        'courseID'
    ];

    public function course()
    {
        return $this->belongsTo(Course::class, 'courseID', 'courseID');
    }

    public function mcqs()
    {
        return $this->hasMany(Mcqs::class, 'moduleID', 'moduleID');
    }
}
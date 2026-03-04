<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lecture extends Model
{
    protected $table = 'lecture';
    protected $primaryKey = 'lectID';

    protected $fillable = [
        'lectName',
        'moduleID',
        'lect_duration'
    ];

    public function module()
    {
        return $this->belongsTo(Module::class, 'moduleID', 'moduleID');
    }

    public function materials()
    {
        return $this->hasMany(LearningMaterials::class, 'lectID', 'lectID');
}

    public function lectures()
    {
        return $this->hasMany(Lecture::class, 'moduleID', 'moduleID');
    }

    public function mcqs()
    {
        return $this->hasMany(Mcqs::class, 'moduleID', 'moduleID');
    }

    public function sections()
    {
        return $this->hasMany(LectureSection::class, 'lectID', 'lectID')
                    ->orderBy('section_order');
    }
}
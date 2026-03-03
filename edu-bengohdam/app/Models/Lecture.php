<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lecture extends Model
{
    protected $table = 'lecture';
    protected $primaryKey = 'lectID';

    protected $fillable = [
        'lectName',
        'moduleID'
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
}
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lecture extends Model
{
    protected $table = 'lecture';
    protected $primaryKey = 'lectID';

    protected $fillable = [
        'lectName',
        'learningMaterialID'
    ];

    public function learningMaterial()
    {
        return $this->hasMany(LearningMaterials::class, 'lectID');
    }
}
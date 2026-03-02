<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LearningMaterials extends Model
{
    protected $table = 'learningmaterials';
    protected $primaryKey = 'learningMaterialID';

    protected $fillable = [
        'lectID',
        'learningMaterialTitle',
        'learningMaterialDesc',
        'learningMaterialType',
        'storagePath'
    ];

    public function lecture()
    {
        return $this->belongsTo(Lecture::class, 'lectID', 'lectID');
    }

    public function video()
    {
        return $this->hasOne(VideoLearning::class, 'learningMaterialID', 'learningMaterialID');
    }

    public function pdf()
    {
        return $this->hasOne(PdfLearning::class, 'learningMaterialID', 'learningMaterialID');
    }
}
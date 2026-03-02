<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LearningMaterials extends Model
{
    protected $table = 'learningmaterials';
    protected $primaryKey = 'learningMaterialID';

    protected $fillable = [
        'learningMaterialTitle',
        'learningMaterialDesc',
        'learningMaterialType',
        'storagePath'
    ];

    public function lecture()
    {
        return $this->hasOne(Lecture::class, 'learningMaterialID', 'learningMaterialID');
    }

    public function video()
    {
        return $this->hasOne(VideoLearning::class, 'learningMaterialID');
    }

    public function pdf()
    {
        return $this->hasOne(PdfLearning::class, 'learningMaterialID');
    }
}
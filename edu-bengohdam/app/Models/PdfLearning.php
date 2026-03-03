<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PdfLearning extends Model
{
    protected $table = 'pdflearning';
    protected $primaryKey = 'pdfLearningID';

    protected $fillable = [
        'learningMaterialID',
        'pdfLearningName',
        'pdfLearningDesc',
        'pdfLearningPages',
        'pdfLearningSizes'
    ];

    public function material()
    {
        return $this->belongsTo(LearningMaterials::class, 'learningMaterialID', 'learningMaterialID');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ModuleAns extends Model
{
    protected $table = 'moduleans';
    protected $primaryKey = 'ansID';

    protected $fillable = [
        'moduleQs_ID',
        'ansID_text',
        'ansCorrect'
    ];

    public function mcq()
    {
        return $this->belongsTo(Mcqs::class, 'moduleQs_ID', 'moduleQs_ID');
    }
}
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AssessmentResult extends Model
{
    protected $primaryKey = 'assResultID';

    protected $fillable = [
        'userID',
        'moduleID',
        'score',
        'status'
    ];

    public $incrementing = true;
    protected $keyType = 'int';
}
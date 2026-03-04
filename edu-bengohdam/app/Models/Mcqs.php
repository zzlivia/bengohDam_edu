<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mcqs extends Model
{
    protected $table = 'mcqs';
    protected $primaryKey = 'moduleQs_ID';

    protected $fillable = [
        'moduleID'
    ];

    public function module()
    {
        return $this->belongsTo(Module::class, 'moduleID', 'moduleID');
    }

    public function answers()
    {
        return $this->hasMany(ModuleAns::class, 'moduleQs_ID', 'moduleQs_ID');
    }
    public function lecture()
    {
        return $this->belongsTo(Lecture::class, 'moduleID', 'moduleID');
    }
}
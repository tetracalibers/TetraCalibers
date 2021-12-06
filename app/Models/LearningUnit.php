<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LearningUnit extends Model
{
    use HasFactory;

    public function subject()
    {
        return $this->belongsTo('App\Models\Subject');
    }

    public function clearnotes()
    {
        return $this->hasMany('App\Models\Clearnote');
    }
}

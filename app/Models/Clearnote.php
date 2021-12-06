<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Clearnote extends Model
{
    use HasFactory;

    public function learningUnit()
    {
        return $this->belongsTo('App\Models\LearningUnit');
    }
}

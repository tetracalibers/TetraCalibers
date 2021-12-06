<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    use HasFactory;

    public function learningUnits()
    {
        return $this->hasMany('App\Models\LearningUnit', 'subject_id', 'id');
    }

    public $incrementing = false; // ← 追加

    protected $keyType = 'string'; // ← 追加
    protected $primaryKey = 'slug';

    public function getRouteKeyName()
    {
        return 'slug';
    }
}

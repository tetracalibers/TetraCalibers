<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class latexbook extends Model
{
    use HasFactory;

    public $incrementing = false; // ← 追加

    protected $keyType = 'string'; // ← 追加
    protected $primaryKey = 'slug';
}

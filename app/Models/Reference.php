<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Blog;
use App\Models\Series;

class Reference extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'type',
        'url'
    ];

    public function blogs()
    {
        return $this->belongsToMany(Blog::class);
    }

    public function series()
    {
        return $this->belongsToMany(Series::class);
    }
}

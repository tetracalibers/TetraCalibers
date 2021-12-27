<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Tag;
use App\Models\Series;
use App\Models\Reference;

class Blog extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'content',
        'structures',
        'metaimage',
        'metadesc'
    ];

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'blog_tag', 'blog_id', 'tag_id', 'id', 'id');
    }

    public function references()
    {
        return $this->belongsToMany(Reference::class);
    }

    public function series()
    {
        return $this->belongsTo(Series::class);
    }
}

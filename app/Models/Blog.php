<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Tag;

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
}

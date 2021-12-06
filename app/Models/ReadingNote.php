<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Tag;

class ReadingNote extends Model
{
    use HasFactory;

    //protected $table = 'reading_note';

    protected $fillable = [
        'title',
        'note',
        'structures'
    ];

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'reading_note_tag', 'reading_note_id', 'tag_id', 'id', 'id');
    }
}

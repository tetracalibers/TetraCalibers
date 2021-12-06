<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Blog;
use App\Models\ReadingNote;

class Tag extends Model
{
    use HasFactory;

    static $levels = [
        -1 => 'ツールとして登録しない',
        0 => '勉強中',
        1 => '読み書きできる',
        2 => 'たまに使う',
        3 => 'バリバリ使う'
    ];

    public function blogs()
    {
        return $this->belongsToMany(Blog::class, 'blog_tag', 'tag_id', 'blog_id', 'id', 'id');
    }

    public function readingNotes()
    {
        return $this->belongsToMany(ReadingNote::class, 'reading_note_tag', 'tag_id', 'reading_note_id', 'id', 'id');
    }

    public $incrementing = false; // ← 追加

    protected $keyType = 'string'; // ← 追加
    protected $primaryKey = 'slug';

    public function getRouteKeyName()
    {
        return 'slug';
    }
}

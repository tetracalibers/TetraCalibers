<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Subject;
use App\Models\LearningUnit;
use App\Models\Clearnote;
use App\Models\latexbook;
use App\Models\Series;
use App\Models\Blog;

class SortController extends Controller
{
    public function save()
    {
        try {
            $json = file_get_contents('php://input');
            $data = json_decode($json, true);

            foreach ($data as $position => $item) {
                if (preg_match('/subject([0-9]+)/', $item, $matches)) {
                    $id = (int)$matches[1];
                    $subject = Subject::where('id', $id)->first();
                    $subject->position = $position;
                    $subject->save();
                } elseif (preg_match('/unit([0-9]+)/', $item, $matches)) {
                    $id = (int)$matches[1];
                    $unit = LearningUnit::where('id', $id)->first();
                    $unit->position = $position;
                    $unit->save();
                } elseif (preg_match('/note([0-9]+)/', $item, $matches)) {
                    $id = (int)$matches[1];
                    $note = Clearnote::where('id', $id)->first();
                    $note->position = $position;
                    $note->save();
                } elseif (preg_match('/latexbook([0-9]+)/', $item, $matches)) {
                    $id = (int)$matches[1];
                    $book = latexbook::where('id', $id)->first();
                    $book->position = $position;
                    $book->save();
                } elseif (preg_match('/article([0-9]+)/', $item, $matches)) {
                    $id = (int)$matches[1];
                    $blog = Blog::where('id', $id)->first();
                    $blog->series_pos = $position;
                    $blog->save();
                }
            }

            return back()->with('message', '並び順を保存しました！');

        } catch(Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }
}

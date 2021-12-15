<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\latexbook;
use App\Models\Subject;
use App\Models\Tag;
use App\Models\Blog;
use App\Models\Top;
use App\Models\Archive;

class TopController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $top = Top::findOrFail(1);
        $archive = Archive::findOrFail(1);
        $books = latexbook::all()->sortBy('position');
        $subjects = Subject::all()->sortBy('position');

        $allTag = Tag::all();
        $tags = array();
        foreach ($allTag as $tag) {
            if ($tag->blogs()->count() > 0) {
                array_push($tags, $tag);
            }
        }

        return view('front.Top.index', compact('top', 'books', 'subjects', 'tags', 'archive'));
    }
}

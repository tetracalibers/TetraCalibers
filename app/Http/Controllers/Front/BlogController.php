<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Blog;
use App\Models\Archive;
use App\Models\Series;
use App\Models\Reference;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $articles = Blog::all();
        $meta = Archive::findOrFail(1);
        $series = Series::all()->pluck('title', 'id')->toArray();
        $articlesBySeries = [];

        foreach ($series as $series_id => $series_title) {
            $articlesBySeries[] = Blog::where('series_id', $series_id)->get()->sortBy('series_pos')->toArray();
        }

        $articlesNotBelongSeries = Blog::where('series_id', null)->get();
        $articlesNotBelongSeries = $articlesNotBelongSeries->merge(Blog::where('series_id', 0)->get())->sortByDesc('created_at')->toArray();

        return view('front.blog.index', compact('articles', 'meta', 'series', 'articlesBySeries', 'articlesNotBelongSeries'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $article = Blog::findOrFail($id)->find($id);
        // 投稿についているタグを取得
        $tags = $article->tags()->pluck('slug', 'name')->toArray();
        $series = $article->series()->pluck('title', 'id')->toArray();
        if ($article->series_id != null) {
            $series = collect([
                'title' => $series[$article->series_id],
                'id' => $article->series_id
            ]);
            $seriesArticles = Blog::where('series_id', $article->series_id)->get()->sortBy('series_pos');
            $next = $seriesArticles->get($article->series_pos + 1);
        } else {
            $series = null;
            $seriesArticles = null;
            $next = null;
        }

        $series_ref = Series::findOrFail($series['id'])->references()->pluck('url', 'title');
        $article_ref = $article->references()->pluck('url', 'title');
        $references = $series_ref->concat($article_ref->whereNotIn('title', $series_ref->keys()))->toArray();

        return view('front.blog.show', compact('article', 'tags', 'series', 'seriesArticles', 'next', 'references'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

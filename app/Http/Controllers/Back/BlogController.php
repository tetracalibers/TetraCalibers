<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\Tag;
use App\Models\Series;
use Illuminate\Http\Request;
use App\Http\Requests\BlogRequest;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $articles = Blog::all()
                    ->sortByDesc('updated_at');

        $series = Series::all()->pluck('title', 'id')->toArray();

        return view('back.blog.index', compact('articles', 'series'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $series = Series::all()->sortBy('created_at');

        $tags = Tag::all()->sortBy('name');
        $tagsJSON = [];

        foreach ($tags as $tag) {
            $tag = $tag->only(['id', 'name', 'logo']);
            array_push($tagsJSON, $tag);
        }

        $tagsJSON = json_encode($tagsJSON);

        return view('back.blog.create', compact('tagsJSON', 'series'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $article = new Blog();

        $article->series_id = $request->series;
        $article->title = $request->title;
        $article->subtitle = $request->subtitle;
        $article->content = $request->content;
        $article->metadesc = $request->metadesc;
        $article->series_pos = Blog::where('series_id', $request->series)->get()->count();

        if ($request->metaimageFile) {
            $file = $request->metaimageFile;
            $name = 'blog' . $article->id . 'meta.' . $file->getClientOriginalExtension();
            $file->move('images/Articles/meta', $name);
            $article->metaimage = url('images/Articles/meta/' . $name);
        } else {
            $article->metaimage = $request->metaimageURL;
        }

        if ($request->file('attachedImage')) {
            $files = $request->file('attachedImage');
            foreach($files as $file) {
                $name = $file->getClientOriginalName();
                $file->move('images/Articles', $name);
            }
        }

        $article->save();

        // 必ずセーブ後に書く
        $article->tags()->attach($request->tags);

        return redirect()->route('back.blog.index')->with('message', '新規ブログ記事を作成しました！');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function show(Blog $blog)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $blog = Blog::findOrFail($id);

        $series = Series::all()->sortBy('created_at');
        $tags = Tag::all()->sortBy('name');

        $tagsJSON = [];

        foreach ($tags as $tag) {
            $tag = $tag->only(['id', 'name', 'logo']);
            array_push($tagsJSON, $tag);
        }

        $tagsJSON = json_encode($tagsJSON);
        $checkedTagsJSON = json_encode(collect($blog->tags()->pluck('tag_id')->toArray()));

        return view('back.blog.edit', compact('blog', 'tagsJSON', 'checkedTagsJSON', 'series'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $article = Blog::find($id);
        $article->tags()->sync($request->tags);

        $article->series_id = $request->series;
        $article->title = $request->title;
        $article->subtitle = $request->subtitle;
        $article->content = $request->content;
        $article->metadesc = $request->metadesc;

        if (!$article->series_pos) {
            $thisSeriesArticles = Blog::where('series_id', $request->series)->get();

            if ($thisSeriesArticles->count() == 1) {
                $article->series_pos = 0;
            } else {
                $allPosNum = collect(range(0, $thisSeriesArticles->count()));
                $noAvailablePosNum = $thisSeriesArticles->whereNotNull('series_pos')->pluck('series_pos');
                $availablePosNum = $allPosNum->diff($noAvailablePosNum);
                $article->series_pos = $availablePosNum->min();
            }
        }

        if ($request->series == 0) {
            $article->series_pos = null;
        }

        if ($request->file('attachedImage')) {
            $files = $request->file('attachedImage');
            foreach($files as $file) {
                $name = $file->getClientOriginalName();
                $file->move('images/Articles', $name);
            }
        }

        if ($request->metaimageFile) {
            $file = $request->metaimageFile;
            $name = 'blog' . $article->id . 'meta.' . $file->getClientOriginalExtension();
            $file->move('images/Articles/meta', $name);
            $article->metaimage = url('images/Articles/meta/' . $name);
        } else {
            $article->metaimage = $request->metaimageURL;
        }

        $article->save();

        return back()->with('message', '記事を更新しました！');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $article = Blog::findOrFail($id);
        $article->delete();

        return redirect()->route('back.blog.index')->with('message', '記事を削除しました。');
    }
}

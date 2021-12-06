<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use App\Models\Tag;
use Illuminate\Http\Request;
use App\Http\Requests\TagRequest;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tags = Tag::all()
                ->sortBy('name');

        return view('back.tags.index', compact('tags'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('back.tags.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TagRequest $request)
    {
        $tag = new Tag();

        $tag->name = $request->name;
        $tag->slug = $request->slug;
        $tag->metadesc = $request->metadesc;
        $tag->level = $request->level;

        if ($request->logoURL) {
            $tag->logo = $request->logoURL;
        } elseif($request->logoFile) {
            $file = $request->logoFile;
            $name = $tag->slug . 'Logo.' . $file->getClientOriginalExtension();
            $file->move('images/Tag', $name);
            $tag->logo = url('images/Tag/' . $name);
        }

        if ($request->metaimageURL) {
            $tag->metaimage = $request->metaimageURL;
        } elseif($request->metaimageFile) {
            $file = $request->metaimageFile;
            $name = $tag->slug . 'metaimage.' . $file->getClientOriginalExtension();
            $file->move('images/Tag/meta', $name);
            $tag->metaimage = url('images/Tag/meta/' . $name);
        }

        $tag->save();
        return redirect()->route('back.tags.index')->with('message', '新たなタグを登録しました！');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
        return view('back.tags.edit', [
            'tag' => Tag::findOrFail($slug)
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function update(TagRequest $request, $slug)
    {
        $tag = Tag::findOrFail($slug);

        $tag->name = $request->name;
        $tag->slug = $request->slug;
        $tag->metadesc = $request->metadesc;
        $tag->level = $request->level;

        if($request->logoFile) {
            $file = $request->logoFile;
            $name = $tag->name . 'Logo' . $file->getClientOriginalExtension();
            $file->move('images/Tag', $name);
            $tag->logo = url('images/Tag/' . $name);
        } elseif ($request->logoURL) {
            $tag->logo = $request->logoURL;
        }

        if($request->metaimageFile) {
            $file = $request->metaimageFile;
            $name = $tag->name . 'metaimage' . $file->getClientOriginalExtension();
            $file->move('images/Tag/meta', $name);
            $tag->metaimage = url('images/Tag/meta/' . $name);
        } elseif ($request->metaimageURL) {
            $tag->metaimage = $request->metaimageURL;
        }

        $tag->save();
        return redirect()->route('back.tags.index')->with('message', 'タグの情報を更新しました！');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function destroy($slug)
    {
        $tag = Tag::findOrFail($slug);
        $tag->delete();

        return redirect()->route('back.tags.index')->with('message', 'タグを削除しました。');
    }
}

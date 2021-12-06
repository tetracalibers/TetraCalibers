<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use App\Models\ReadingNote;
use Illuminate\Http\Request;
use App\Http\Requests\ReadingNoteRequest;
use App\Models\Tag;

class ReadingNoteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $notes = ReadingNote::all()
                ->sortByDesc('updated_at');

        return view('back.readingNote.index', compact('notes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tags = Tag::all()->sortBy('name');
        $tagsJSON = [];

        foreach ($tags as $tag) {
            $tag = $tag->only(['id', 'name', 'logo']);
            array_push($tagsJSON, $tag);
        }

        $tagsJSON = json_encode($tagsJSON);

        return view('back.readingNote.create', compact('tagsJSON'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $note = ReadingNote::create($request->all());
        $note->tags()->attach($request->tags);

        return redirect()->route('back.readingNote.index')->with('message', '新規読書ノートを作成しました！');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ReadingNote  $readingNote
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $note = ReadingNote::findOrFail($id);
        $tags = $note->find($id)->tags()->pluck('name', 'tag_id');

        return view('back.readingNote.show', compact('note', 'tags'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ReadingNote  $readingNote
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $note = ReadingNote::findOrFail($id);
        $tags = Tag::all()->sortBy('name');

        $tagsJSON = [];

        foreach ($tags as $tag) {
            $tag = $tag->only(['id', 'name', 'logo']);
            array_push($tagsJSON, $tag);
        }

        $tagsJSON = json_encode($tagsJSON);
        $checkedTagsJSON = json_encode(collect($note->tags()->pluck('tag_id')->toArray()));

        $structures = $note->structures;
        $needEscapeTags = [
            '<script>', '</script>',
            '<style>', '</style>',
            '<canvas>', '</canvas>',
        ];
        foreach($needEscapeTags as $tag) {
            $structures = str_replace($tag, htmlspecialchars($tag), $structures);
        }

        return view('back.readingNote.edit', compact('note', 'tagsJSON', 'checkedTagsJSON', 'structures'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ReadingNote  $readingNote
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $note = ReadingNote::find($id);

        $note->tags()->sync($request->tags);
        $note->update($request->all());

        return back()->with('message', '読書ノートを更新しました！');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ReadingNote  $readingNote
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $note = ReadingNote::findOrFail($id);
        $note->delete();

        return redirect()->route('back.readingNote.index')->with('message', '読書ノートを削除しました。');
    }
}

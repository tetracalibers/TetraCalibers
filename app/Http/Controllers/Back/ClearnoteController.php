<?php

namespace App\Http\Controllers\Back;

use App\Models\Clearnote;
use App\Models\LearningUnit;
use Illuminate\Http\Request;
use Illuminate\Http\ClearnoteRequest;
use App\Http\Controllers\Controller;

class ClearnoteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($subject_slug, $unit_id)
    {
        $unit = LearningUnit::findOrFail($unit_id);

        return view('back.clearnotes.create', compact('subject_slug', 'unit'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ClearnoteRequest $request)
    {
        $note = new Clearnote();
        $note->title = $request->title;
        $note->link = $request->link;
        $note->learning_unit_id = $request->unit;

        $label = explode('/', parse_url($note->link, PHP_URL_PATH))[3];

        if ($request->thumbnailFile) {
            $file = $request->thumbnailFile;
            $name = 'clearnote' . $label . $file->getClientOriginalExtension();
            $file->move('images/Clearnotes', $name);
            $note->thumbnail = url('images/Clearnotes/'. $name);
        } else {
            $note->thumbnail = $request->thumbnailURL;
        }

        $note->save();
        return redirect()->route('back.subjects.learningUnits.show', [$subject_slug, $unit_id])->with('message', '新しいノートを追加しました！');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Clearnote  $clearnote
     * @return \Illuminate\Http\Response
     */
    public function show(Clearnote $clearnote)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Clearnote  $clearnote
     * @return \Illuminate\Http\Response
     */
    public function edit($subject_slug, $unit_id, $note_id)
    {
        $note = Clearnote::find($note_id);

        return view('back.clearnotes.edit', compact('subject_slug', 'unit_id', 'note'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Clearnote  $clearnote
     * @return \Illuminate\Http\Response
     */
    public function update(ClearnoteRequest $request, $subject_slug, $unit_id, $note_id)
    {
        $note = Clearnote::find($note_id);
        $note->title = $request->title;
        $note->link = $request->link;
        $note->learning_unit_id = $unit_id;

        if ($request->thumbnailFile) {
            $file = $request->thumbnailFile;
            $name = 'clearnote' . $label . $file->getClientOriginalExtension();
            $file->move('images/Clearnotes', $name);
            $note->thumbnail = url('images/Clearnotes/'. $name);;
        } else {
            $note->thumbnail = $request->thumbnailURL;
        }

        $note->save();
        return redirect()->route('back.subjects.learningUnits.show', [$subject_slug, $unit_id])->with('message', 'ノートの情報を更新しました！');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Clearnote  $clearnote
     * @return \Illuminate\Http\Response
     */
    public function destroy($subject_slug, $unit_id, $note_id)
    {
        $note = Clearnote::findOrFail($note_id);
        $note->delete();

        return redirect()->route('back.subjects.learningUnits.show', [$subject_slug, $unit_id])->with('message', 'ノートを削除しました。');
    }
}

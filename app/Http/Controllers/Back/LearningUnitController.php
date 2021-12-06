<?php

namespace App\Http\Controllers\Back;

use App\Models\LearningUnit;
use App\Models\Subject;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\LearningUnitRequest;


class LearningUnitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //return redirect($targetURL);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($subject_slug)
    {
        //return view('back.learningUnits.create', compact('subject_id'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(LearningUnitRequest $request)
    {
        $unit = new LearningUnit();
        $unit->name = $request->name;
        $unit->subject_id = Subject::where('slug', $request->subject)->first()->id;

        $unit->save();

        return redirect()->route('back.subjects.show', ['subject' => $subject_slug])->with('message', '新たな単元を登録しました！');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\LearningUnit  $learningUnit
     * @return \Illuminate\Http\Response
     */
    public function show($subject_slug, $unit_id)
    {
        $unit = LearningUnit::where('id', $unit_id)->first();

        $notes = $unit->find($unit_id)->clearnotes()->get()->sortBy('position');

        return view('back.learningUnits.show', compact('subject_slug', 'unit', 'notes'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\LearningUnit  $learningUnit
     * @return \Illuminate\Http\Response
     */
    public function edit($subject_slug, $unit_id)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\LearningUnit  $learningUnit
     * @return \Illuminate\Http\Response
     */
    public function update(LearningUnitRequest $request, $subject_slug, $unit_id)
    {
        $unit = LearningUnit::find($unit_id);
        $unit->name = $request->name;
        $unit->subject_id = Subject::where('slug', $subject_slug)->first()->id;

        $unit->save();
        return redirect()->route('back.subjects.show', ['subject' => $subject_slug])->with('message', '単元名を変更しました！');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\LearningUnit  $learningUnit
     * @return \Illuminate\Http\Response
     */
    public function destroy($subject_slug, $unit_id)
    {
        $unit = LearningUnit::findOrFail($unit_id);
        $unit->delete();

        return redirect()->route('back.subjects.show', ['subject' => $subject_slug])->with('message', '単元を削除しました。');
    }
}

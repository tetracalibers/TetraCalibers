<?php

namespace App\Http\Controllers\Back;

use App\Models\Subject;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\SubjectRequest;

class SubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $subjects = Subject::all()->sortBy('position');

        return view('back.subjects.index', compact('subjects'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('back.subjects.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SubjectRequest $request)
    {
        $subject = new Subject();
        $subject->name = $request->name;
        $subject->slug = $request->slug;
        $subject->metadesc = $request->metadesc;

        if($request->logoFile) {
            $file = $request->logoFile;
            $name = $subject->slug . 'Logo.' . $file->getClientOriginalExtension();
            $file->move('images/Subjects', $name);
            $subject->logo = url('images/Subjects/'. $name);
        } else {
            $subject->logo = $request->logoURL;
        }

        $subject->save();
        return redirect()->route('back.subjects.index')->with('message', '新たな科目を登録しました！');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $subject = Subject::where('slug', $slug)->first();
        $units = $subject->find($slug)->learningUnits()->get()->sortBy('position')->pluck('name', 'id')->toArray();

        return view('back.subjects.show', compact('subject', 'units'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
        return view('back.subjects.edit', [
            'subject' => Subject::findOrFail($slug)
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function update(SubjectRequest $request, $slug)
    {
        $subject = Subject::find($slug);
        $subject->name = $request->name;
        $subject->slug = $request->slug;
        $subject->metadesc = $request->metadesc;

        if($request->logoFile) {
            $file = $request->logoFile;
            $name = $subject->slug . 'Logo.' . $file->getClientOriginalExtension();
            $file->move('images/Subjects', $name);
            $subject->logo = url('images/Subjects/'. $name);
        } else {
            $subject->logo = $request->logoURL;
        }

        $subject->save();
        return redirect()->route('back.subjects.index')->with('message', '科目の情報を更新しました！');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function destroy($slug)
    {
        $subject = Subject::findOrFail($slug);
        $subject->delete();

        return redirect()->route('back.subjects.index')->with('message', '科目を削除しました。');
    }
}

<?php

namespace App\Http\Controllers\Back;

use App\Models\latexbook;
use App\Http\Requests\LaTeXbookRequest;
use App\Http\Controllers\Controller;

class LaTeXbookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $books = latexbook::all()->sortBy('position');

        return view('back.latexbooks.index', compact('books'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('back.latexbooks.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(LaTeXbookRequest $request)
    {
        $book = new latexbook();

        $book->title = $request->title;
        $book->slug = $request->slug;

        if ($request->thumbnailFile) {
            $file = $request->thumbnailFile;
            $name = $request->slug . 'Logo.' . $file->getClientOriginalExtension();
            $file->move('images/LaTeXbooks', $name);
            $book->thumbnail = url('images/LaTeXbooks/'. $name);
        } else {
            $book->thumbnail = $request->thumbnailURL;
        }

        $book->save();
        return redirect()->route('back.latexbooks.index')->with('message', '新たなデジタル教科書を登録しました！');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\latexbook  $laTeXbook
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $book = latexbook::where('slug', $slug)->first();

        return view('back.latexbooks.show', compact('book'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\latexbook  $laTeXbook
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
        return view('back.latexbooks.edit', [
            'book' => latexbook::findOrFail($slug)
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\latexbook  $laTeXbook
     * @return \Illuminate\Http\Response
     */
    public function update(LaTeXbookRequest $request, $slug)
    {
        $book = latexbook::where('slug', $slug)->first();

        $book->title = $request->title;

        if ($request->thumbnailFile) {
            $file = $request->thumbnailFile;
            $name = $book->slug . 'Logo.' . $file->getClientOriginalExtension();
            $file->move('images/LaTeXbooks' , $name);
            $book->thumbnail = url('images/LaTeXbooks/'. $name);
        } else {
            $book->thumbnail = $request->thumbnailURL;
        }

        $book->save();
        return redirect()->route('back.latexbooks.index')->with('message', 'デジタル教科書の情報を更新しました！');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\latexbook  $laTeXbook
     * @return \Illuminate\Http\Response
     */
    public function destroy($slug)
    {
        $book = latexbook::findOrFail($slug);
        $book->delete();

        return redirect()->route('back.latexbooks.index')->with('message', 'デジタル教科書を削除しました。');
    }
}

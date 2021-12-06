<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Archive;

class ArchiveController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return redirect('/admin/archive/1/edit');
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $info = Archive::findOrFail($id);

        return view('back.archive.edit', compact('info'));
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
        $info = Archive::find($id);
        $info->metadesc = $request->metadesc;

        if ($request->logoFile) {
            $file = $request->logoFile;
            $name = 'archiveLogo.' . $file->getClientOriginalExtension();
            $file->move('images/Archive', $name);
            $info->logo = url('images/Archive/' . $name);
        } else {
            $info->logo = $request->logoURL;
        }

        if ($request->metaimageFile) {
            $file = $request->metaimageFile;
            $name = 'archiveMetaImage.' . $file->getClientOriginalExtension();
            $file->move('images/Archive/meta', $name);
            $info->metaimage = url('images/Archive/meta/' . $name);
        } else {
            $info->metaimage = $request->metaimageURL;
        }

        $info->save();
        return back()->with('message', 'ブログ一覧ページ情報を更新しました！');
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

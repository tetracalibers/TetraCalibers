@extends('back.layouts.base')
@section('title', 'ノートの情報を編集')

@section('main')
    <h1>「{{ $note->title }}」の情報を編集</h1>
    <x-back.formResult />

    <div id="app">
        <form method="post" action="{{ route('back.subjects.learningUnits.clearnotes.update', [$subject_slug, $unit_id, $note->id])}}" enctype="multipart/form-data">
        @csrf
        @method('PATCH')
            <label for="title">タイトル</label>
            <input type="text" name="title" value="{{ old('title', $note->title) }}" class="_width100">

            <label for="link">リンク</label>
            <input type="text" name="link" value="{{ old('link', $note->link) }}" class="_width100">

            <label for="thumbnail">サムネイル</label>
            <div class="selectImageArea">
                <image-url-previewer input-name="thumbnailURL" init-value="{{ old('thumbnail', $note->thumbnail) }}"></image-url-previewer>
                <image-uploader input-name="thumbnailFile"></image-uploader>
            </div>

            <button type="submit" class="_primary">更新</button>
            <a href="{{ route('back.subjects.learningUnits.show', [$subject_slug, $unit_id]) }}">
                <button type="button">一覧へ戻る</button>
            </a>
        </form>
    </div>
@endsection

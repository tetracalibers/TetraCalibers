@extends('back.layouts.base')
@section('title', '新規ノートを登録')

@section('main')
    <h1>新規ノートを登録</h1>

    <x-back.formResult />

    <div id="app">
        <form method="post" action="{{ route('back.subjects.learningUnits.clearnotes.store', [$subject_slug, $unit->id]) }}" enctype="multipart/form-data">
        @csrf
            <label for="title">タイトル</label>
            <input type="text" name="title" class="_width100" value="{{ old('title') }}">

            <label for="link">リンク</label>
            <input type="text" name="link" class="_width100" value="{{ old('link') }}">

            <label for="thumbnail">サムネイル</label>
            <div class="selectImageArea">
                <image-url-previewer input-name="thumbnailURL" init-value="{{ old('thumbnailURL') }}"></image-url-previewer>
                <image-uploader input-name="thumbnailFile"></image-uploader>
            </div>

            <button type="submit" class="_primary">追加</button>
            <a href="{{ route('back.subjects.learningUnits.show', [$subject_slug, $unit->id]) }}">
                <button type="button">一覧へ戻る</button>
            </a>
        </form>
    </div>
@endsection

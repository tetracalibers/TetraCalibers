@extends('back.layouts.base')
@section('title', '新規LaTeX本を登録')

@section('main')
    <h1>新規LaTeX本を登録</h1>

    <x-back.formResult />

    <div id="app">
        <form method="post" action="{{ route('back.latexbooks.store') }}" enctype="multipart/form-data">

            <label for="title">タイトル</label>
            <input type="text" name="title" class="_width100" value="{{ old('title') }}">

            <label for="slug">スラッグ</label>
            <input type="text" name="slug" class="_width100" value="{{ old('slug') }}">

            <label for="thumbnail">サムネイル</label>
            <div class="selectImageArea">
                <image-url-previewer input-name="thumbnailURL" init-value="{{ old('thumbnailURL') }}"></image-url-previewer>
                <image-uploader input-name="thumbnailFile"></image-uploader>
            </div>

            <button type="submit" class="_primary">登録</button>
            <a href="{{ route('back.latexbooks.index') }}">
                <button type="button">一覧へ戻る</button>
            </a>
        </form>
    </div>
@endsection

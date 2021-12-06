@extends('back.layouts.base')
@section('title', '新規科目を追加')

@section('main')
    <h1>新規科目を追加</h1>

    <x-back.formResult />

    <div id="app">
        <form method="post" action="{{ route('back.subjects.store') }}" enctype="multipart/form-data">
        @csrf
            <label for="name">科目名</label>
            <input type="text" name="name" class="_width100" value="{{ old('name') }}">

            <label for="slug">スラッグ</label>
            <input type="text" name="slug" class="_width100" value="{{ old('slug') }}">

            <label for="logo">ロゴ</label>
            <div class="selectImageArea">
                <image-url-previewer input-name="logoURL" init-value="{{ old('logoURL') }}"></image-url-previewer>
                <image-uploader input-name="logoFile"></image-uploader>
            </div>

            <label for="metadesc">og:description</label>
            <input type="text" name="metadesc" class="_width100">

            <button type="submit" class="_primary">登録</button>
            <a href="{{ route('back.subjects.index') }}">
                <button type="button">一覧へ戻る</button>
            </a>
        </form>
    </div>
@endsection

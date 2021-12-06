@extends('back.layouts.base')
@section('title', '登録済みのデジタル教科書の情報を編集')

@section('main')
    <h1>タグ「{{ $book->title }}」のデジタル教科書の情報を編集</h1>

    <x-back.formResult />

    <div id="app">
        <form method="post" action="{{ route('back.latexbooks.update', $book->slug)}}" enctype="multipart/form-data">
        @csrf
        @method('PATCH')
            <label for="title">タイトル</label>
            <input type="text" name="title" value="{{ old('title', $book->title )}}" class="_width100">

            <label for="slug">スラッグ</label>
            <input type="text" name="slug" value="{{ old('slug', $book->slug )}}" class="_width100" readonly>

            <label for="thumbnail">サムネイル</label>
            <div class="selectImageArea">
                <image-url-previewer input-name="thumbnailURL" init-value="{{ old('thumbnail', $book->thumbnail)) }}"></image-url-previewer>
                <image-uploader input-name="thumbnailFile"></image-uploader>
            </div>

            <button type="submit" class="_primary">更新</button>
            <a href="{{ route('back.latexbooks.index') }}">
                <button type="button">一覧へ戻る</button>
            </a>
        </form>
    </div>
@endsection

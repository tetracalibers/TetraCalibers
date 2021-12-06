@extends('back.layouts.base')
@section('title', 'タグを新規作成')

@section('main')
    <h1>新規タグを作成</h1>

    <x-back.formResult />

    <div id="app">
        <form method="post" action="{{ route('back.tags.store') }}" enctype="multipart/form-data">
        @csrf
            <label for="name">タグ名</label>
            <input type="text" name="name" class="_width100" value="{{ old('name') }}">

            <label for="slug">スラッグ</label>
            <input type="text" name="slug" class="_width100" value="{{ old('slug') }}">

            <label for="logo">ロゴ</label>
            <div class="selectImageArea">
                <image-url-previewer input-name="logoURL" init-value="{{ old('logoURL') }}"></image-url-previewer>
                <image-uploader input-name="logoFile"></image-uploader>
            </div>

            <label for="level">使用頻度と習熟度</label>
            <select name="level" class="_width100">
            @foreach (App\Models\Tag::$levels as $num => $str)
                <option value="{{ $num }}">{{ $str }}</option>
            @endforeach
            </select>

            <label for="metaimage">og:image</label>
            <div class="selectImageArea">
                <image-url-previewer input-name="metaimageURL" init-value="{{ old('metaimageURL') }}"></image-url-previewer>
                <image-uploader input-name="metaimageFile"></image-uploader>
            </div>

            <label for="metadesc">og:description</label>
            <input type="text" name="metadesc" class="_width100" value="{{ old('metadesc') }}">

            <button type="submit" class="_primary">登録</button>
            <a href="{{ route('back.tags.index') }}">
                <button type="button">一覧へ戻る</button>
            </a>
        </form>
    </div>
@endsection

@extends('back.layouts.base')
@section('title','プロフィール情報を編集')

@section('main')
    <div class="row">
        <h1 class="col m9">プロフィールページの情報編集</h1>
        <a href="/profile" target="_blank" rel="noopener noreferrer" class="col m3">
            <button class="_info _round _width100">プロフィールページを表示</button>
        </a>
    </div>
    <x-back.formResult />

    <div id="app">
        <form method="post" action="/admin/profile/{{ $info->id }}" enctype="multipart/form-data">
        @csrf
        @method('PATCH')
            <label for="profile">サイトに掲載するプロフィール</label>
            <textarea name="profile" class="_width100">{{ $info->profile }}</textarea>

            <label for="metaimage">og:image</label>
            <div class="selectImageArea">
                <image-url-previewer input-name="metaimageURL" init-value="{{ $info->metaimage }}"></image-url-previewer>
                <image-uploader input-name="metaimageFile"></image-uploader>
            </div>

            <label for="metadesc">og:description</label>
            <input type="text" name="metadesc" class="_width100" value="{{ $info->metadesc }}">

            <button type="submit" class="_primary">更新</button>
        </form>
    </div>
@endsection

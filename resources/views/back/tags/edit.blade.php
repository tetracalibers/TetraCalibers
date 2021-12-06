@extends('back.layouts.base')
@section('title', '登録済みのタグの情報を編集')

@section('main')
    <h1>タグ「{{ $tag->name }}」の情報を編集</h1>

    <x-back.formResult />

    <form method="post" action="/admin/tags/{{ $tag->slug }}" enctype="multipart/form-data">
    @csrf
    @method('PATCH')
        <label for="name">タグ名</label>
        <input type="text" name="name" value="{{ old('name', $tag->name )}}" class="_width100">

        <label for="slug">スラッグ</label>
        <input type="text" name="slug" value="{{ old('slug', $tag->slug )}}" class="_width100">

        <label for="logo">ロゴ</label>
        <input type="url" name="logoURL" value="{{ old('logoURL', $tag->logo )}}" class="_width100">
        <input type="file" name="logoFile" accept="image/png,image/jpg,image/jpeg,image/gif" multiple="false" class="_width100">

        <label for="level">使用頻度と習熟度</label>
        <select name="level" class="_width100">
        @foreach (App\Models\Tag::$levels as $num => $str)
            <option value="{{ $num }}" {{ $tag->level == $num ? ' selected' : '' }}>
                {{ $str }}
            </option>
        @endforeach
        </select>

        <label for="thumbnail">og:image</label>
        <div class="selectImageArea">
            <image-url-previewer input-name="metaimageURL" init-value="{{ old('metaimageURL', $tag->metaimage )}}"></image-url-previewer>
            <image-uploader input-name="metaimageFile"></image-uploader>
        </div>

        <label for="metadesc">og:description</label>
        <input type="text" name="metadesc" value="{{ old('metadesc', $tag->metadesc ) }}" class="_width100">

        <button type="submit" class="_primary">更新</button>
        <a href="{{ route('back.tags.index') }}">
            <button type="button">一覧へ戻る</button>
        </a>
    </form>
@endsection

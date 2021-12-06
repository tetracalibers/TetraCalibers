@extends('back.layouts.base')
@section('title', '科目の情報を編集')

@section('main')
    <h1>科目「{{ $subject->name }}」の情報を編集</h1>
    <x-back.formResult />

    <form method="post" action="/admin/subjects/{{ $subject->slug }}" enctype="multipart/form-data">
    @csrf
    @method('PATCH')
        <label for="name">科目名</label>
        <input type="text" name="name" value="{{ old('name', $subject->name) }}" class="_width100">

        <label for="slug">スラッグ</label>
        <input type="text" name="slug" value="{{ old('slug', $subject->slug) }}" class="_width100">

        <label for="logo">ロゴ</label>
        <div class="selectImageArea">
            <image-url-previewer input-name="logoURL" init-value="{{ old('logo', $subject->logo) }}"></image-url-previewer>
            <image-uploader input-name="logoFile"></image-uploader>
        </div>

        <label for="metadesc">og:description</label>
        <input type="text" name="metadesc" value="{{ old('metadesc', $subject->metadesc) }}" class="_width100">

        <button type="submit" class="_primary">更新</button>
        <a href="{{ route('back.subjects.index') }}">
            <button type="button">一覧へ戻る</button>
        </a>
    </form>
@endsection

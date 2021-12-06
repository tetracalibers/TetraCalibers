@extends('back.layouts.base')
@section('title','トップページの情報編集')

@section('main')
    <div class="row">
        <h1 class="col m9">トップページの情報編集</h1>
        <a href="/" target="_blank" rel="noopener noreferrer" class="col m3">
            <button class="_info _round _width100">トップページを表示</button>
        </a>
    </div>
    <x-back.formResult />

    <form method="post" action="/admin/top/{{ $info->id }}" enctype="multipart/form-data">
    @csrf
    @method('PATCH')
        <label for="metadesc">og:description</label>
        <input type="text" name="metadesc" class="_width100" value="{{ $info->metadesc }}">

        <button type="submit" class="_primary">更新</button>
    </form>
@endsection

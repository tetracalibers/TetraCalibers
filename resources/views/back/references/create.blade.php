@extends('back.layouts.base')
@section('title', '新規参考文献を登録')

@section('main')
    <h1>新規参考文献を登録</h1>

    <x-back.formResult />

    <div>
        <form method="post" action="{{ route('back.references.store') }}" enctype="multipart/form-data">
        @csrf
            <label for="title">タイトル</label>
            <input type="text" name="title" class="_width100" value="{{ old('title') }}">

            <label for="type">種別</label>
            <select name="type" class="_width100">
                <option value="Book">Book</option>
                <option value="Web">Web</option>
            </select>

            <label for="url">URL</label>
            <input type="text" name="url" class="_width100" value="{{ old('url') }}">

            <button type="submit" class="_primary">登録</button>
            <a href="{{ route('back.references.index') }}">
                <button type="button">一覧へ戻る</button>
            </a>
        </form>
    </div>
@endsection

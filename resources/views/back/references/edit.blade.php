@extends('back.layouts.base')
@section('title', '登録済み参考文献の情報編集')

@section('main')
    <h1>シリーズ「{{ $reference->title }}」の情報を編集</h1>

    <x-back.formResult />

    <div>
        <form method="post" action="{{ route('back.references.update', $reference->id) }}" enctype="multipart/form-data">
        @csrf
        @method('PATCH')
            <label for="title">タイトル</label>
            <input type="text" name="title" value="{{ old('title', $reference->title) }}" class="_width100">

            <label for="type">種別</label>
            <select name="type" class="_width100">
                <option value="Book" {{ $reference->type == 'Book' ? 'selected' : '' }}>Book</option>
                <option value="Web" {{ $reference->type == 'Web' ? 'selected' : '' }}>Web</option>
            </select>

            <label for="url">URL</label>
            <input type="text" name="url" class="_width100" value="{{ old('url', $reference->url) }}">

            <button type="submit" class="_primary">更新</button>
            <a href="{{ route('back.references.index') }}">
                <button type="button">参考文献一覧へ戻る</button>
            </a>
        </form>
    </div>
@endsection

@extends('back.layouts.base')
@section('title', '新規シリーズを立ち上げ')

@section('main')
    <h1>新規シリーズを立ち上げ</h1>

    <x-back.formResult />

    <div>
        <form method="post" action="{{ route('back.series.store') }}" enctype="multipart/form-data">
        @csrf
            <label for="title">タイトル</label>
            <input type="text" name="title" class="_width100" value="{{ old('title') }}">

            <label for="references">参考文献</label>
            <select name="references[]" class="_width100" multiple="multiple" style="height: calc(26px * {{ $references->count() }});">
                @foreach ($references as $reference)
                <option value="{{ $reference->id }}">{{ $reference->title }}</option>
                @endforeach
            </select>

            <button type="submit" class="_primary">登録</button>
            <a href="{{ route('back.series.index') }}">
                <button type="button">一覧へ戻る</button>
            </a>
        </form>
    </div>
@endsection

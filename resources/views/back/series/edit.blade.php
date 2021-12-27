@extends('back.layouts.base')
@section('title', '既存シリーズの情報編集')

@section('main')
    <h1>シリーズ「{{ $series->title }}」の情報を編集</h1>

    <x-back.formResult />

    <div>
        <form method="post" action="{{ route('back.series.update', $series->id) }}" enctype="multipart/form-data">
        @csrf
        @method('PATCH')
            <label for="title">タイトル</label>
            <input type="text" name="title" value="{{ old('title', $series->title) }}" class="_width100">

            <label for="references">参考文献</label>
            <select name="references[]" class="_width100" multiple="multiple" style="height: calc(26px * {{ $references->count() }});">
                @foreach ($references as $reference)
                <option value="{{ $reference->id }}" {{ $checkedReferences->keys()->contains($reference->id) ? 'selected' : '' }}>{{ $reference->title }}</option>
                @endforeach
            </select>

            <button type="submit" class="_primary">更新</button>
            <a href="{{ route('back.series.index') }}">
                <button type="button">シリーズ一覧へ戻る</button>
            </a>
        </form>
    </div>
@endsection

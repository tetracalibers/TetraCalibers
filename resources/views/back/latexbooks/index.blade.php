@extends('back.layouts.base')
@section('title', 'LaTeX本一覧')

@section('main')
    <div class="row">
        <h1 class="col m10">LaTeX本一覧</h1>
        <a href="{{ route('back.latexbooks.create') }}" class="col m2">
            <button class="_pink _round _width100">新規追加</button>
        </a>
    </div>
    <x-back.formResult />


    <table class="_width100">
        <thead>
            <tr>
                <th>タイトル</th>
                <th>スラッグ</th>
                <th>サムネイル</th>
                <th>og:description</th>
                <th>{{-- 表示 --}}</th>
                <th>{{-- 編集 --}}</th>
                <th>{{-- 削除 --}}</th>
            </tr>
        </thead>
        <tbody class="sortable">
        @foreach ($books as $book)
            <tr id="latexbook{{$book->id}}">
                <td>{{ $book->title }}</td>
                <td>{{ $book->slug }}</td>
                <td>
                    <img src="{{ $book->thumbnail }}" id="img{{ $book->id }}" class="my_adminLogo modalimg" onclick="openimg('img{{ $book->id }}','imgb')">
                    <div id="imgb" class="modal">
                        <span class="-close"><i class="far fa-times-circle"></i></span>
                        <img class="modal-content">
                        <div class="caption"></div>
                    </div>
                </td>
                <td>{{ $book->metadesc }}</td>
                <td>
                    <a href="{{ url('/latexbook/' . $book->slug) }}" target="_blank" rel="noopener noreferrer">
                        <button class="_info">表示</button>
                    </a>
                </td>
                <td>
                    <a href="{{ route('back.latexbooks.edit', $book->slug) }}">
                        <button class="_primary">編集</button>
                    </a>
                </td>
                <td>
                    <form method="post" action="{{ route('back.latexbooks.destroy', $book->slug)}}" class="_noMargin">
                    @method('DELETE')
                    @csrf
                        <button type="submit" onclick="return confirm('本当に削除しますか？');" class="_danger">削除</button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <button class="_purple" form="{{ route('back.sort.save') }}" id="saveSort">並び順を保存</button>
@endsection

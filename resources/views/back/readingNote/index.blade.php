@extends('back.layouts.base')
@section('title', '読書ノート一覧')

@section('main')
    <div class="row">
        <h1 class="col m10">読書ノート一覧</h1>
        <a href="{{ route('back.readingNote.create') }}" class="col m2">
            <button class="_pink _round _width100">新規追加</button>
        </a>
    </div>

    <x-back.formResult />
    <table class="_width100">
        <thead>
            <tr>
                <th>タイトル</th>
                <th>作成日</th>
                <th>最終更新日</th>
                <th>{{-- 詳細 --}}</th>
                <th>{{-- 編集 --}}</th>
                <th>{{-- 削除 --}}</th>
            </tr>
        </thead>
        <tbody>
        @foreach ($notes as $note)
            <tr>
                <td>{{ $note->title }}</td>
                <td>{{ $note->created_at }}</td>
                <td>{{ $note->updated_at }}</td>
                <td>
                    <a href="{{ route('back.readingNote.show', $note) }}">
                        <button class="_info">表示</button>
                    </a>
                </td>
                <td>
                    <a href="{{ route('back.readingNote.edit', $note) }}">
                        <button class="_primary">編集</button>
                    </a>
                </td>
                <td>
                    <form method="post" action="/admin/readingNote/{{ $note->id }}" class="_noMargin">
                    @method('DELETE')
                    @csrf
                        <button type="submit" onclick="return confirm('本当に削除しますか？');" class="_danger">削除</button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection

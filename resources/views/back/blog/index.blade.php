@extends('back.layouts.base')
@section('title', 'ブログ記事一覧')

@section('main')
    <div class="row">
        <h1 class="col m10">ブログ記事一覧</h1>
        <a href="{{ route('back.blog.create') }}" class="col m2">
            <button class="_pink _round _width100">新規追加</button>
        </a>
    </div>
    <x-back.formResult />
    <table class="_width100">
        <thead>
            <tr>
                <th>タイトル</th>
                <th>公開日</th>
                <th>最終更新日</th>
                <th>og:image</th>
                <th>og:description</th>
                <th>{{-- 表示 --}}</th>
                <th>{{-- 編集 --}}</th>
                <th>{{-- 削除 --}}</th>
            </tr>
        </thead>
        <tbody>
        @foreach ($articles as $article)
            <tr>
                <td>{{ $article->title }}</td>
                <td>{{ $article->created_at }}</td>
                <td>{{ $article->updated_at }}</td>
                <td>
                    <img src="{{ $article->metaimage }}" id="img{{ $article->id }}" class="my_adminLogo modalimg" onclick="openimg('img{{ $article->id }}','imgb')">
                    <div id="imgb" class="modal">
                        <span class="-close"><i class="far fa-times-circle"></i></span>
                        <img class="modal-content">
                        <div class="caption"></div>
                    </div>
                </td>
                <td>{{ $article->metadesc }}</td>
                <td>
                    <a href="/blog/{{ $article->id }}" target="_blank" rel="noopener noreferrer">
                        <button class="_info">表示</button>
                    </a>
                </td>
                <td>
                    <a href="{{ route('back.blog.edit', $article) }}">
                        <button class="_primary">編集</button>
                    </a>
                </td>
                <td>
                    <form method="post" action="/admin/blog/{{ $article->id }}" class="_noMargin">
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

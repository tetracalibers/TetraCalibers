@extends('back.layouts.base')
@section('title', '{{ $series->title }}の記事一覧')

@section('main')
    <x-back.formResult />
    <a href="{{ route('back.series.index', $series->id) }}">
        <button type="button">シリーズ一覧へ戻る</button>
    </a>
    <div class="row">
        <h1 class="col m10">「{{ $series->title }}」の記事一覧</h1>
        <a href="{{ route('back.blog.create') }}" class="col m2">
            <button class="_pink _round _width100">新規記事を作成</button>
        </a>
    </div>
    <x-back.formResult />
    <table class="_width100">
        <thead>
            <tr>
                <th>記事タイトル</th>
                <th>記事サブタイトル</th>
                <th>{{-- 表示 --}}</th>
                <th>{{-- 編集 --}}</th>
            </tr>
        </thead>
        <tbody class="sortable">
        @foreach ($articles as $article)
            <tr id="article{{ $article->id }}">
                <td>{{ $article->title }}</td>
                <td>{{ $article->subtitle }}</td>
                <td>
                    <a href="{{ route('front.blog.show', $article->id) }}" target="_blank" rel="noopener noreferrer">
                        <button type="button" class="_info">表示</button>
                    </a>
                </td>
                <td>
                    <a href="{{ route('back.blog.edit', $article->id) }}">
                        <button class="_primary">編集</button>
                    </a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <button class="_purple" form="sortUpdate" id="saveSort">並び順を保存</button>
@endsection

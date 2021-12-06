@extends('back.layouts.base')
@section('title', 'タグ一覧')

@section('main')
    <div class="row">
        <h1 class="col m10">タグ一覧</h1>
        <a href="{{ route('back.tags.create') }}" class="col m2">
            <button class="_pink _round _width100">新規追加</button>
        </a>
    </div>
    <x-back.formResult />
    <table class="_width100">
        <thead>
            <tr>
                <th>名前</th>
                <th>スラッグ</th>
                <th>使用頻度</th>
                <th>ロゴ</th>
                <th>og:image</th>
                <th>og:description</th>
                <th>{{-- 編集 --}}</th>
            </tr>
        </thead>
        <tbody>
        @foreach ($tags as $tag)
            <tr>
                <td>{{ $tag->name }}</td>
                <td>{{ $tag->slug }}</td>
                <td>
                @if ($tag->level > -1)
                    @for ($i = 1; $i <= $tag->level; $i++)
                    <i class="fas fa-star"></i>
                    @endfor
                    @for ($i = 3; $i > $tag->level; $i--)
                    <i class="far fa-star"></i>
                    @endfor
                @endif
                </td>
                <td>
                    <img src="{{ $tag->logo }}" id="img{{ $tag->id }}" class="my_adminLogo modalimg" onclick="openimg('img{{ $tag->id }}','imgb')">
                    <div id="imgb" class="modal">
                        <span class="-close"><i class="far fa-times-circle"></i></span>
                        <img class="modal-content">
                        <div class="caption"></div>
                    </div>
                </td>
                <td>
                    <img src="{{ $tag->metaimage }}" class="my_adminLogo">
                </td>
                <td>{{ $tag->metadesc }}</td>
                <td>
                    <a href="{{ route('back.tags.edit', $tag->slug) }}">
                        <button class="_primary">編集</button>
                    </a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection

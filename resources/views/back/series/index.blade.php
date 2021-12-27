@extends('back.layouts.base')
@section('title', 'シリーズ一覧')

@section('main')
    <div class="row">
        <h1 class="col m10">シリーズ一覧</h1>
        <a href="{{ route('back.series.create') }}" class="col m2">
            <button class="_pink _round _width100">新規追加</button>
        </a>
    </div>
    <x-back.formResult />
    <table class="_width100">
        <thead>
            <tr>
                <th>シリーズ名</th>
                <th>参考文献</th>
                <th>{{-- 記事一覧へ --}}</th>
                <th>{{-- 編集 --}}</th>
            </tr>
        </thead>
        <tbody>
        @foreach ($series as $s)
            <tr>
                <td>{{ $s->title }}</td>
                <td>
                    @if ($s->references()->count() > 0)
                    <ul>
                        @foreach ($s->references()->pluck('title', 'reference_id') as $ref_id => $ref_title)
                        <li>{{ $ref_title }}</li>
                        @endforeach
                    </ul>
                    @endif
                </td>
                <td>
                    <a href="{{ route('back.series.show', $s->id)}}">
                        <button type="button" class="_info">記事一覧へ</button>
                    </a>
                </td>
                <td>
                    <a href="{{ route('back.series.edit', $s->id) }}">
                        <button class="_primary">編集</button>
                    </a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection

@extends('back.layouts.base')
@section('title', '参考文献の管理')

@section('main')
    <div class="row">
        <h1 class="col m10">参考文献一覧</h1>
        <a href="{{ route('back.references.create') }}" class="col m2">
            <button class="_pink _round _width100">新規登録</button>
        </a>
    </div>
    <x-back.formResult />
    <table class="_width100">
        <thead>
            <tr>
                <th>タイトル</th>
                <th>種別</th>
                <th>URL</th>
                <th>{{-- 編集 --}}</th>
            </tr>
        </thead>
        <tbody>
        @foreach ($references as $reference)
            <tr>
                <td>{{ $reference->title }}</td>
                <td>
                    @if ($reference->type == 'Book')
                    <i class="fas fa-book fa-2x"></i>
                    @elseif ($reference->type == 'Web')
                    <i class="fas fa-laptop-code fa-2x"></i>
                    @endif
                </td>
                <td>
                    <a href="{{ $reference->url }}" target="_blank" rel="noopener noreferrer">
                        <button class="_indigo">確認</button>
                    </a>
                </td>
                <td>
                    <a href="{{ route('back.references.edit', $reference->id) }}">
                        <button class="_primary">編集</button>
                    </a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection

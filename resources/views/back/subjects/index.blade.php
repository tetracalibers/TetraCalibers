@extends('back.layouts.base')
@section('title', '科目一覧')

@section('main')
    <x-back.formResult />

    <div class="row">
        <h1 class="col m10">科目一覧</h1>
        <a href="{{ route('back.subjects.create') }}" class="col m2">
            <button class="_pink _round _width100">新規追加</button>
        </a>
    </div>

    <table class="_width100">
        <thead>
            <tr>
                <th>科目名</th>
                <th>スラッグ</th>
                <th>ロゴ</th>
                <th>og:description</th>
                <th>{{-- 単元一覧 --}}</th>
                <th>{{-- 編集 --}}</th>
            </tr>
        </thead>
        <tbody class="sortable">
        @foreach ($subjects as $subject)
            <tr id="subject{{ $subject->id }}">
                <td>{{ $subject->name }}</td>
                <td>{{ $subject->slug }}</td>
                <td>
                    <img src="{{ $subject->logo }}" id="img{{ $subject->id }}" class="my_adminLogo modalimg" onclick="openimg('img{{ $subject->id }}','imgb')">
                    <div id="imgb" class="modal">
                        <span class="-close"><i class="far fa-times-circle"></i></span>
                        <img class="modal-content">
                        <div class="caption"></div>
                    </div>
                </td>
                <td>{{ $subject->metadesc }}</td>
                <td>
                    <a href="{{ route('back.subjects.show', $subject->slug)}}">
                        <button type="button" class="_info">単元一覧へ</button>
                    </a>
                </td>
                <td>
                    <a href="{{ route('back.subjects.edit', $subject->slug) }}">
                        <button type="button" class="_primary">編集</button>
                    </a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <button class="_purple" form="sortUpdate" id="saveSort">並び順を保存</button>
@endsection

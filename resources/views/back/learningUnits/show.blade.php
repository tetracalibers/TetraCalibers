@extends('back.layouts.base')
@section('title', '{{ $unit->name }}のノート一覧')

@section('main')
    <a href="{{ route('back.subjects.show', [$subject_slug]) }}">
        <button type="button">単元一覧へ戻る</button>
    </a>
    <div class="row">
        <h1 class="col m10">「{{ $unit->name }}」のノート一覧</h1>
        <a href="{{ route('back.subjects.learningUnits.clearnotes.create', [$subject_slug, $unit->id]) }}" class="col m2">
            <button class="_pink _round _width100">新規追加</button>
        </a>
    </div>
    <x-back.formResult />
    <table class="_width100">
        <thead>
            <tr>
                <th>タイトル</th>
                <th>サムネイル</th>
                <th>{{-- 表示 --}}</th>
                <th>{{-- 編集 --}}</th>
            </tr>
        </thead>
        <tbody class="sortable">
        @foreach ($notes as $note)
            <tr id="note{{ $note->id }}">
                <td>{{ $note->title }}</td>
                <td>
                    <img src="{{ $note->thumbnail }}" id="thumbnail{{ $note->id }}" class="my_adminLogo modalimg" onclick="openimg('thumbnail{{ $note->id }}','imgb')">
                    <div id="imgb" class="modal">
                        <span class="-close"><i class="far fa-times-circle"></i></span>
                        <img class="modal-content">
                        <div class="caption"></div>
                    </div>
                </td>
                <td>
                    <a href="{{ $note->link }}" target="_blank" rel="noopener noreferrer">
                        <button type="button" class="_info">表示</button>
                    </a>
                </td>
                <td>
                    <a href="{{ route('back.subjects.learningUnits.clearnotes.edit', [$subject_slug, $unit->id, $note->id]) }}">
                        <button class="_primary">編集</button>
                    </a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <button class="_purple" form="sortUpdate" id="saveSort">並び順を保存</button>
@endsection

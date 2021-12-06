@extends('back.layouts.base')
@section('title', '{{ $subject->name }}の単元一覧')

@section('main')
<x-back.formResult />

    <a href="{{ route('back.subjects.index') }}">
        <button type="button">科目一覧へ戻る</button>
    </a>
    <div class="row">
        <h1 class="col m6">
            {{ $subject->name }}の単元一覧
        </h1>
        <div class="col m6">
            <form method="post" action="{{ route('back.subjects.learningUnits.store', ['subject' => $subject->slug])}}" class="_noMargin">
            @csrf
                <input type="text" name="name" placeholder="新しい単元名" class="col m10" value="{{ old('name') }}">
                <input type="submit" class="col m2 _pink" value="追加">
            </form>
        </div>
    </div>
    <table class="_width100">
        <thead>
            <tr>
                <th>単元名</th>
                <th>{{-- ノート一覧 --}}</th>
                <th>単元名を変更</th>
            </tr>
        </thead>
        <tbody class="sortable">
        @foreach ($units as $id => $unit)
            <tr id="unit{{ $id }}">
                <td>{{ $unit }}</td>
                <td>
                    <a href="{{ route('back.subjects.learningUnits.show', ['subject' => $subject->slug, 'learningUnit' => $id])}}">
                        <button class="_info">ノート一覧へ</button>
                    </a>
                </td>
                <td>
                    <form method="post" action="{{ route('back.subjects.learningUnits.update', [$subject->slug, $id])}}" class="_noMargin">
                    @csrf
                    @method('PATCH')
                        <input type="text" name="name" value="{{ old('name', $unit) }}" />
                        <input type="submit" value="変更" class="_primary">
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <button class="_purple" form="sortUpdate" id="saveSort">並び順を保存</button>
@endsection

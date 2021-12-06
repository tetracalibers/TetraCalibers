@extends('back.layouts.base')
@section('title', 'ログイン')
@section('main')
<h1>ログイン画面</h1>
<x-back.formResult />
<form  method="POST" action="/login">
    @csrf
    <fieldset>
        <label for="name">ユーザー名</label>
        <input name="name" type="text" value="{{old('name')}}"/>
        <label for="password">パスワード</label>
        <input name="password" type="password" />
        <button type="submit">送信</button>
    </fieldset>
</form>
@endsection

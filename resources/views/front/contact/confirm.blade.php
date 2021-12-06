@extends('front.layouts.contact.base')
@section('title', 'お問い合わせ確認画面')

@section('main')
<div class="contactConfirm">
    <div class="confirm_title">内容確認</div>
    <form action="{{ route('front.contact.send') }}" method="POST">
    @csrf
        <p>
            <label for="name">NAME</label><br>
            <p class="inputedContent">{{ $inputs['name'] }}</p>
            <input type="hidden" name="name" value="{{ $inputs['name'] }}" />
        </p>
        <p>
            <label for="email">MAIL-ADRESS</label><br>
            <p class="inputedContent">{{ $inputs['email'] }}</p>
            <input type="hidden" name="email" value="{{ $inputs['email'] }}" />
        </p>
        <p>
            <label for="title">TITLE</label><br>
            <p class="inputedContent">{{ $inputs['title'] }}</p>
            <input type="hidden" name="title" value="{{ $inputs['title'] }}">
        </p>
        <p>
            <label for="contents">CONTENTS</label><br>
            <p class="inputedContent">{!! nl2br(e($inputs['contents'])) !!}</p>
            <input type="hidden" name="contents" value="{{ $inputs['contents'] }}">
        </p>
        <p class="submitWrap">
            <input class="send" type="submit" value="SEND">
        </p>
    </form>
</div>
@endsection

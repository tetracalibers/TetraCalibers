@extends('front.layouts.base')
@section('meta')
<meta property="og:title" content="Profile of tomixy" />
<meta property="og:image" content="{{ $profile->metaimage }}" />
<meta property="og:type" content="article" />
<meta property="og:description" content="{{ $profile->metadesc }}" />
<mata name="description" content="{{ $profile->metadesc }}" />
@endsection
@section('title', 'プロフィール <- TetraCalibers')

@section('main')
<article class="profileContainer">
    <div class="pinkBlock">
        <div class="text">
            <h1>TOMIXY</h1>
            <p>
                2002年生まれ。<wbr>
                プログラミング歴{{ App\Models\Profile::programmingHistory() }}。<br>
                {!! $profile->profile !!}
            </p>
        </div>
    </div>
    <div class="blueBlock">
        <div class="returnButton">
            <a href="{{ url('/') }}">トップに戻る</a>
        </div>
        <div class="text">
            <h1>FREQUENTLY USED TOOLS</h1>
            <p class="programmingIcons">
            @foreach ($tools as $tool)
                <img src="{{ $tool->logo }}" class="level{{ $tool->level }}">
            @endforeach
            </p>
        </div>
    </div>
    <div class="toTopButton"><i class="fas fa-chevron-up fa-2x"></i></div>
</article>
@endsection

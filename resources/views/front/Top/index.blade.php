@extends('front.layouts.base')
@section('meta')
<meta property="og:title" content="TOP PAGE of TetraCalibers" />
<meta property="og:image" content="{{ asset('images/tomixy.gif') }}" />
<meta property="og:type" content="website" />
<meta property="og:description" content="{{ $top->metadesc }}" />
@endsection
@section('title', 'トップ')

@section('main')
<article class="topContainer">
    <div class="top_title">
        <div><span class="siteTitle typed" style="white-space:pre"></span></div>
        <span class="catchcopy markerAnime"><br>理系学問・Webデザイン・<wbr>プログラミング・組版の4方向へ</span>
    </div>
    <div class="fusen top_tabs">
        <ul class="top_menu">
            <div class="box flipRightTop delay-time01">
                <li><a href="/profile">Profile</a></li>
            </div>
            <div class="box flipRightTop delay-time02">
                <li><a href="#clearnotes">Clearnote投稿ノート</a></li>
            </div>
            <div class="box flipRightTop delay-time03">
                <li><a href="#latexbooks">LaTeX製教科書</a></li>
            </div>
            <div class="box flipRightTop delay-time05">
                <li><a href="#blog">VScode住民の探検記</a></li>
            </div>
            <div class="box flipRightTop delay-time04">
                <li><a href="#site">制作サイト</a></li>
            </div>
        </ul>
    </div>
    <div class="top_img">
        <img src="{{ asset('images/Top/equation1.png') }}" class="equation1">
        <img src="{{ asset('images/Top/vecter3d.png') }}" class="vector3d">
        <img src="{{ asset('images/Top/EDTA.png') }}" class="EDTA">
    </div>
    <div class="top_tabcontents" id="clearnotes">
        <a class="CategoryLink" href="https://www.clearnotebooks.com/ja/authors/2541851" target="_blank" ref="noopener noreferrer">
            <div>Account</div>
            <img src="{{ asset('images/tomixy.jpg') }}">
        </a>
        @foreach ($subjects as $subject)
        <a class="CategoryLink" href="/clearnotes/{{ $subject->slug }}">
            <div>{{ $subject->name }}</div>
            <img src="{{ $subject->logo }}">
        </a>
        @endforeach
    </div>
    <div class="top_tabcontents" id="latexbooks">
        @foreach ($books as $book)
        <a class="CategoryLink" href="{{ url('/LaTeXbooks/' . $book->slug . '/index.html') }}" target="_blank" rel="noopener noreferrer">
            <div>{!! $book->title !!}</div>
            <img src="{{ $book->thumbnail }}">
        </a>
        @endforeach
    </div>
    <div class="top_tabcontents" id="blog">
        <a class="CategoryLink" href="/blog">
            <div>All</div>
            <img src="{{ $archive->logo }}">
        </a>
        @foreach ($tags as $tag)
        <a class="CategoryLink" href="/tags/{{ $tag->slug }}">
            <div>{!! $tag->name !!}</div>
            <img src="{{ $tag->logo }}">
        </a>
        @endforeach
    </div>
    <div class="top_tabcontents" id="site">
        <a class="SiteLink" href="https://try-playing-usg.kuron.jp" target="_blank" rel="noopener noreferrer">
            <div>Try Playing USG</div>
            <img src="{{ asset('images/Top/tpUSGlogo_white.jpg')}}">
        </a>
    </div>
</article>
<div class="toTopButton"><i class="fas fa-chevron-up fa-2x"></i></div>
@endsection

@extends('front.layouts.base')
@section('meta')
<meta property="og:title" content="{{ $article->title }}" />
<meta property="og:image" content="{{ $article->metaimage }}" />
<meta property="og:type" content="article" />
<meta property="og:description" content="{{ $article->metadesc }}" />
@endsection
@section('title', $article->title)

@section('main')
<article class="blogContainer" id="particles_blog">
    <div class="categoryList">
        <div class="categoryBack fluid"></div>
        <div class="categoryListText">
            <div class="categoryListTitle">Category</div>
            <ul>
            @foreach($tags as $name => $slug)
                <li>
                    <a href="/tags/{{ $slug }}">
                        {{ str_replace("<wbr>", "", $name) }}
                    </a>
                </li>
            @endforeach
            </ul>
        </div>
    </div><!-- END categoryList -->
    <div class="tocWrapper">
        <div class="tocContent">
            <div class="tocTitle"></div>
            <ul class="toc"></ul>
        </div>
    </div><!-- END tocWrapper -->
    <div class="articleTitle">
        {!! $article->title !!}
    </div><!-- END articleTitle -->
    <time class="articleDate">
        <div>公開日==&#39;{{ $article->created_at }}&#39;;</div>
    @if ($article->created_at != $article->updated_at)
        <div>最終更新日==&#39;{{ $article->updated_at }}&#39;;</div>
    @endif
    </time>
    <div class="blogContents" id="app">
        {!! $article->content !!}
    </div><!-- END blogContents -->
    <div class="toTopButton"><i class="fas fa-chevron-up fa-2x"></i></div>
</article>
@endsection

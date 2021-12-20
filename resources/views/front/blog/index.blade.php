@extends('front.layouts.base')
@section('meta')
<meta property="og:title" content="「VScode住民の探検記」ブログ記事一覧" />
<meta property="og:image" content="{{ $meta->metaimage }}" />
<meta property="og:type" content="article" />
<meta property="og:description" content="{{ $meta->metadesc }}" />
<mata name="description" content="{{ $meta->metadesc }}" />
@endsection
@section('title', 'ブログ記事一覧 <- TetraCalibers')

@section('main')
<article class="archiveContainer">
    <section>
        <h1 class="shell">
            <span class="shellMark">$&gt;</span>
            <span class="command">ls</span>
            All_Articles
        </h1>
        @if (count($articlesNotBelongSeries) > 0)
        <ul class="articleList">
            @foreach ($articlesNotBelongSeries as $articleNBS)
            <li>
                <a href="{{ route('front.blog.show', $articleNBS['id']) }}">
                    {{ $articleNBS['title'] }}
                </a>
            </li>
            @endforeach
        </ul>
        @endif
        @foreach ($articlesBySeries as $idx => $value)
        @if (count($value) > 0)
        <div class="seriesTitle"><i class="far fa-folder-open"></i>{{ $series[$idx + 1] }}</div>
        <ul class="articleList">
            @foreach ($value as $article)
            <li>
                <a href="{{ route('front.blog.show', $article['id']) }}">
                    {{ $article['title'] }}
                </a>
            </li>
            @endforeach
        </ul>
        @endif
        @endforeach
    </section>
    <x-front.affiliate />
    <div class="toTopButton"><i class="fas fa-chevron-up fa-2x"></i></div>
</article>
@endsection

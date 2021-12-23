@extends('front.layouts.base')
@section('meta')
<meta property="og:title" content="{{ $tag->name . 'の記事一覧' }}" />
<meta property="og:image" content="{{ $tag->metaimage }}" />
<meta property="og:type" content="article" />
<meta property="og:description" content="{{ $tag->metadesc }}" />
<mata name="description" content="{{ $tag->metadesc }}" />
@endsection
@section('title', $tag->name . 'の記事一覧 <- TetraCalibers')

@section('main')
<article class="archiveContainer">
    <section>
        <h1 class="shell">
            <span class="shellMark">$&gt;</span>
            <span class="command">ls</span>
            {{ str_replace('<wbr>', '', $tag->name) }}
        </h1>
        @if (count($articlesNotBelongSeries) > 0)
        <ul class="articleList">
        @foreach ($articlesNotBelongSeries as $articleNBS)
            <li>
                <a href="{{ route('front.blog.show', $articleNBS['id']) }}">
                    {{ $articleNBS['title'] . ($articleNBS['subtitle'] ? "〜" . $articleNBS['subtitle'] . "〜" : "") }}
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
                    {{ $article['title'] . ($article['subtitle'] ? "〜" . $article['subtitle'] . "〜" : "") }}
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

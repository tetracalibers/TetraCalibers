@extends('front.layouts.base')
@section('meta')
<meta property="og:title" content="「VScode住民の探検記」ブログ記事一覧" />
<meta property="og:image" content="{{ $meta->metaimage }}" />
<meta property="og:type" content="article" />
<meta property="og:description" content="{{ $meta->metadesc }}" />
@endsection
@section('title', 'ブログ記事一覧')

@section('main')
<article class="archiveContainer">
    <section>
        <h1 class="shell">
            <span class="shellMark">$&gt;</span>
            <span class="command">ls</span>
            All_Articles
        </h1>
        <ul class="articleList">
        @foreach ($articles as $id => $title)
            <li>
                <a href="/blog/{{ $id }}">
                    {{ $title }}
                </a>
            </li>
        @endforeach
        </ul>
    </section>
    <div class="toTopButton"><i class="fas fa-chevron-up fa-2x"></i></div>
</article>
@endsection

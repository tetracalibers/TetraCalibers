@extends('front.layouts.base')
@section('meta')
<meta property="og:title" content="{{ $tag->name . 'の記事一覧' }}" />
<meta property="og:image" content="{{ $tag->metaimage }}" />
<meta property="og:type" content="article" />
<meta property="og:description" content="{{ $tag->metadesc }}" />
@endsection
@section('title', $tag->name . 'の記事一覧')

@section('main')
<article class="archiveContainer">
    <section>
        <h1 class="shell">
            <span class="shellMark">$&gt;</span>
            <span class="command">ls</span>
            {{ str_replace('<wbr>', '', $tag->name) }}
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

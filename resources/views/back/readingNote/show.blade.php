@extends('front.layouts.base')
@section('title', $note->title)

@section('main')
<article class="blogContainer" id="particles_blog">
    <div class="categoryList">
        <div class="categoryBack fluid"></div>
        <div class="categoryListText">
            <div class="categoryListTitle">Category</div>
            <ul>
            @foreach($tags as $tag)
                <li>
                    <a href="">
                        {{ $tag }}
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
        {!! $note->title !!}
    </div><!-- END articleTitle -->
    <time class="articleDate">
        　　公開日==&#39;{{ $note->created_at }}&#39;;<br>
    @if ($note->created_at != $note->updated_at)
        最終更新日==&#39;{{ $note->updated_at }}&#39;;
    @endif
    </time>
    <div class="blogContents">
        {!! $note->note !!}
    </div><!-- END blogContents -->
</article>
@endsection

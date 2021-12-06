@extends('front.layouts.base')
@section('meta')
<meta property="og:title" content="{{ $subject->name . 'のノート一覧' }}" />
<meta property="og:image" content="{{ asset('images/Subjects/' . $subject->logo) }}" />
<meta property="og:type" content="article" />
<meta property="og:description" content="{{ $subject->metadesc }}" />
@endsection
@section('title', $subject->name . 'のノート一覧')

@section('main')
<article class="notesContainer">
    <img src="{{ asset('images/Clearnotes/water.jpg') }}" class="skyBack">
    <div class="tocWrapper">
        <div class="tocContent">
            <div class="tocTitle">{{ $subject->name }}の単元目次</div>
            <ul class="toc"></ul>
        </div>
    </div><!-- END tocWrapper -->
    @foreach ($units as $unit)
    <div class="notesCategory">{{ $unit->name }}</div>
    <div class="cardGroup">
        @foreach ($unit->findOrFail($unit->id)->clearnotes()->get()->sortBy('position') as $note)
        <a href="{{ $note->link }}" class="item">
            <img src="{{ $note->thumbnail }}">
            <div>{{ $note->title }}</div>
        </a>
        @endforeach
    </div>
    @endforeach
    <div class="toTopButton"><i class="fas fa-chevron-up fa-2x"></i></div>
</article>
@endsection

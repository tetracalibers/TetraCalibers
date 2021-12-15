@extends('front.layouts.buildvu')
@section('meta')
<meta property="og:title" content="{{ $book->title }}" />
<meta property="og:image" content="{{ $book->thumbnail }}" />
<meta property="og:type" content="article" />
<meta property="og:description" content="" />
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.1/css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="{{ url('/LaTeXbooks/' . $book->slug . '/assets/idrviewer.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('/css/buildVu.css') }}">
<script src="{{ url('/LaTeXbooks/' . $book->slug . '/assets/idrviewer.js')}}" type="text/javascript"></script>
<script src="{{ url('/LaTeXbooks/' . $book->slug . '/assets/idrviewer.querystring-navigation.js') }}"></script>
<script src="{{ url('/LaTeXbooks/' . $book->slug . '/assets/idrviewer.fullscreen.js') }}"></script>
<script src="{{ url('/LaTeXbooks/' . $book->slug . '/assets/idrviewer.search.js') }}"></script>
<script src="{{ url('/LaTeXbooks/' . $book->slug . '/assets/idrviewer.annotations.js') }}"></script>
<script src="{{ asset('js/buildVu.js') }}"></script>
@endsection
@section('title', $book->title)

@section('body')
<body class="light-theme">
    <nav id="sidebar">
        <div id="sidebar-controls" class="controls">
            <button id="btnThumbnails" data-lang-title="control.thumbnails" title="Thumbnails" class="btn"><i class="fa fa-picture-o fa-lg" aria-hidden="true"></i></button>
            <button id="btnBookmarks" data-lang-title="control.bookmarks" title="Bookmarks" class="btn"><i class="fa fa-list-ul fa-lg" aria-hidden="true"></i></button>
            <button id="btnSearch" data-lang-title="control.search" title="Search" class="btn"><i class="fa fa-search fa-lg" aria-hidden="true"></i></button>
        </div>
        <div id="sidebar-content">
            <div id="thumbnails-panel"></div>
            <div id="bookmarks-panel"></div>
            <div id="search-panel">
                <input id="searchInput" data-lang-title="search.search" title="Search" type="text">
                <label class="searchOption"><input type="checkbox" id="cbMatchCase"><span data-lang-text="search.match-case"> Match case</span></label>
                <label class="searchOption"><input type="checkbox" id="cbLimitResults"><span data-lang-text="search.limit-results-1"> Limit results 1 per page</span></label>
                <hr>
                <span id="searchResultsCount"></span>
                <div id="searchResults"></div>
            </div>
        </div>
    </nav>

    <div id="main">
        <nav id="controls" class="controls">
            <div id="controls-left">
                <button id="btnSideToggle" data-lang-title="control.sidebar" title="Sidebar" class="btn"><i class="fa fa-th fa-lg" aria-hidden="true"></i></button>
                <button id="btnThemeToggle" data-lang-title="control.theme-toggle" title="Theme Toggle" class="btn"><i class="fa fa-lightbulb-o fa-lg" aria-hidden="true"></i></button>
            </div>

            <div id="controls-center">
                <button id="btnPrev" data-lang-title="control.prev" title="Previous Page" class="btn"><i class="fa fa-caret-left fa-2x" aria-hidden="true"></i></button>
                <select id="btnGo">

                </select>
                <span id="pgCount"></span>
                <button id="btnNext" data-lang-title="control.next" title="Next Page" class="btn"><i class="fa fa-caret-right fa-2x" aria-hidden="true"></i></button>

                <button id="btnSelect" data-lang-title="control.select" title="Select" class="btn mobile-hidden"><i class="fa fa-i-cursor fa-lg" aria-hidden="true"></i></button>
                <button id="btnMove" title="Pan" data-lang-title="control.move" class="btn mobile-hidden"><i class="fa fa-arrows fa-lg" aria-hidden="true"></i></button>

                <button id="btnZoomOut" data-lang-title="control.zoom-out" title="Zoom Out" class="btn mobile-hidden"><i class="fa fa-minus fa-lg" aria-hidden="true"></i></button>
                <select id="btnZoom" class="mobile-hidden">
                    <option value="specific">100%</option>
                    <option data-lang-text="control.actual-size" value="actualsize">Actual Size</option>
                    <option data-lang-text="control.fit-width" value="fitwidth">Fit Width</option>
                    <option data-lang-text="control.fit-height" value="fitheight">Fit Height</option>
                    <option data-lang-text="control.fit-page" value="fitpage">Fit Page</option>
                    <option data-lang-text="control.auto" value="auto">Automatic</option>
                </select>
                <button id="btnZoomIn" data-lang-title="control.zoom-in" title="Zoom In" class="btn mobile-hidden"><i class="fa fa-plus fa-lg" aria-hidden="true"></i></button>
                <select id="btnView" class="mobile-hidden">

                </select>
            </div>
            <div id="controls-right">
                <button id="btnFullScreen" data-lang-title="control.fullscreen" title="Fullscreen" class="btn"><i class="fa fa-arrows-alt fa-lg" aria-hidden="true"></i></button>
            </div>
        </nav>

        <div id="idrviewer">

        </div>
    </div>
    <script src="{{ url('/LaTeXbooks/' . $book->slug . '/config.js')}}" type="text/javascript"></script>
    <script type="text/javascript">IDRViewer.setup();</script>
</body>
@endsection

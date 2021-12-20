<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="robots" content="noindex,nofollow" />
    <x-favicon />
    <title>@yield('title')</title>
    <x-loadPlugin />
    @yield('head')
</head>
<body class="my_adminContainer" id="particles_blog">
    <nav class="my_adminNav">
        <ul class="listnav _transparent">
            @auth
            <li>
                <form method="post" action="{{ route('logout') }}" class="row _noMargin">
                @csrf
                    <button type="submit" class="_danger _width100">ログアウト</button>
                </form>
            </li>
            @endif
            <li><a href="/" target="_blank" rel="noopener noreferrer">サイトを表示</a></li>
            <li><a href="{{ route('back.top.edit', 1) }}" class="row">Top</a></li>
            <li><a href="{{ route('back.profile.edit', 1) }}" class="row">Profile</a></li>
            <li><a href="{{ route('back.archive.edit', 1) }}" class="row">Blog - All</a></li>
            <li><a href="{{ route('back.blog.index')}}" class="row">ブログ</a></li>
            <li><a href="{{ route('back.series.index') }}" class="row">シリーズ</a></li>
            <li><a href="{{ route('back.tags.index') }}" class="row">タグ</a></li>
            <li><a href="{{ route('back.subjects.index') }}" class="row">Clearnote</a></li>
            <li><a href="{{ route('back.latexbooks.index') }}" class="row">LaTeX教科書</a></li>
            <li><a href="{{ route('back.readingNote.index') }}" class="row">読書ノート</a></li>
        </ul>
    </nav>
    <main class="my_adminMain">
        @yield('main')
    </main>
    <script src="https://rawgit.com/outboxcraft/beauter/master/beauter.min.js" defer="defer"></script>
</body>
</html>

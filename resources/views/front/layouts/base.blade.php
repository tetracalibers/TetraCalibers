<!DOCTYPE html>
<html lang="ja">
<head prefix="og: http://ogp.me/ns#">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:site" content="@tetracalibers" />
    <meta property="og:site_name" content="TetraCalibers" />
    <meta property="og:url" content="{{ url()->current() }}" />
    @yield('meta')
    <x-favicon />
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-7D6WJVHS4D"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());
        gtag('config', 'G-7D6WJVHS4D');
    </script>
    <title>@yield('title')</title>
    <x-loadPlugin />
</head>
<body class="my_frontContainer">
    @yield('main')
</body>
<x-front.footer />
</html>

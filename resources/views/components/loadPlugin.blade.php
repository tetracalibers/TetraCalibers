<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome-animation/0.3.0/font-awesome-animation.min.css" integrity="sha512-Po8rrCwchD03Wo+2ibHFielZ8luDAVoCyE9i6iFMPyn9+V1tIhGk5wl8iKC9/JfDah5Oe9nV8QzE8HHgjgzp3g==" crossorigin="anonymous" referrerpolicy="no-referrer" />

{{-- フロントCSS --}}
@if (Route::is('front.*') || Route::is('back.readingNote.show'))
<link rel="stylesheet" href=" {{ asset('css/reset.css') }}">
@endif

{{-- 管理画面CSS --}}
@if (Route::is('back.*') && !Route::is('back.readingNote.show'))
<link rel="stylesheet" type="text/css" href="https://rawgit.com/outboxcraft/beauter/master/beauter.min.css"/>
@endif

{{-- ブログ・読書ノートCSS --}}
@if (Route::is('front.blog.show') || Route::is('back.readingNote.show'))
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/prism/1.25.0/themes/prism-funky.min.css" integrity="sha512-q59Usnbm/Dz3MeqoMEATHqIwozatJmXr/bFurDR7hpB5e2KxU+j2mp89Am9wq9jwZRaikpnKGHw4LP/Kr9soZQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/prism/1.24.1/plugins/line-numbers/prism-line-numbers.min.css"
        integrity="sha512-cbQXwDFK7lj2Fqfkuxbo5iD1dSbLlJGXGpfTDqbggqjHJeyzx88I3rfwjS38WJag/ihH7lzuGlGHpDBymLirZQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/prismjs@1.23.0/plugins/toolbar/prism-toolbar.min.css">
<link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/prism/1.24.1/plugins/match-braces/prism-match-braces.min.css"
        integrity="sha512-SwPHdIEEQ3lKazpLV9+r1UH4HnpNVlYVdKYgBwD/8QuougtQj6xm5x2xladh3mC/bz+jVWkvYTpKCI1KWD1MWQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/prism/1.25.0/plugins/previewers/prism-previewers.min.css" integrity="sha512-A9RNXUtaJI3dQGaPZUpU4rXyVjVnrini2mPgZXK9LN7npkZodrZPuK5VXBi68PN5WlCgc5OU6BY/Nqh+MU3U/g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/prism/1.25.0/plugins/treeview/prism-treeview.min.css" integrity="sha512-T2070kymkL/92LGEdTHzxTu6cHJjQI66uq8uJ768/iOs6M7yTceI2YcHFh2BHUcqbsDUFn4t9iaXNYAbmUKp8A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/prism/1.25.0/plugins/command-line/prism-command-line.min.css" integrity="sha512-4Y1uID1tEWeqDdbb7452znwjRVwseCy9kK9BNA7Sv4PlMroQzYRznkoWTfRURSADM/SbfZSbv/iW5sNpzSbsYg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
@endif

{{-- 共通CSS --}}
<link rel="stylesheet" href=" {{ mix('css/app.css') }}">



<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/velocity/1.5.2/velocity.min.js" integrity="sha512-cWbIzX5dm6Uyc6jg+DmJTWherzF5usoVXN/3MYggEQhsgfOJdfIPAvz5Ktprf4Gx2HoxVUqMIVDuyBp5PQ1Hwg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

{{-- 管理画面 --}}
@if (Route::is('back.*'))
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js" integrity="sha512-uto9mlQzrs59VwILcLiRYeLKPPbS/bT71da/OEBYEwcdNUk8jYIy+D176RYoop1Da+f9mvkYrmj5MCLZWEtQuA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/particles.js/2.0.0/particles.min.js" integrity="sha512-Kef5sc7gfTacR7TZKelcrRs15ipf7+t+n7Zh6mKNJbmW+/RRdCW9nwfLn4YX0s2nO6Kv5Y2ChqgIakaC6PW09A==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="{{ asset('/js/setParticles.js') }}"></script>
<script src="{{ asset('/js/setSortable.js') }}"></script>
@endif

{{-- ブログor読書ノート作成・編集画面 --}}
@if (Route::is('back.blog.create') || Route::is('back.blog.edit') || Route::is('back.readingNote.create') || Route::is('back.readingNote.edit'))
<script src="https://cdnjs.cloudflare.com/ajax/libs/mathjax/2.7.2/MathJax.js?config=TeX-AMS-MML_SVG"></script>
<script src="{{ asset('/js/checkTag.js') }}"></script>
<script src="{{ asset('/js/webpack/validateBlockEditor.js') }}" defer="defer"></script>
@elseif (Route::is('back.*'))
<script src="{{ asset('/js/webpack/imageSelector.js') }}" defer="defer"></script>
@endif

{{-- フロント --}}
@if (Route::is('front.*'))
<script src="{{ asset('/js/toTopButton.js') }}"></script>
@endif

{{-- トップページ --}}
@if (Request::is('/'))
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.imagesloaded/4.1.4/imagesloaded.pkgd.min.js" integrity="sha512-S5PZ9GxJZO16tT9r3WJp/Safn31eu8uWrzglMahDT4dsmgqWonRY9grk3j+3tfuPr9WJNsfooOR7Gi7HL5W2jw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/typed.js/2.0.12/typed.min.js" integrity="sha512-3J8teBiHrSyaaRBajZyIEtpDsXdPq1gsznKWIVb5CnorQuFhjWGhWe54z8YNnHHr7MZuExb9m5kvf964HiT1Sw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="{{ asset('/js/setTyped.js') }}"></script>
<script src="{{ asset('/js/randomFlipRightTop.js') }}"></script>
<script src="{{ asset('/js/top_tab.js') }}"></script>
@endif

{{-- Clearnotes一覧 --}}
@if (Request::is('clearnotes/*'))
<script src="{{ asset('/js/makeToc_forSubjects.js') }}"></script>
@endif

{{-- ブログ --}}
@if (Route::is('front.blog.show'))
<script src="https://cdnjs.cloudflare.com/ajax/libs/particles.js/2.0.0/particles.min.js" integrity="sha512-Kef5sc7gfTacR7TZKelcrRs15ipf7+t+n7Zh6mKNJbmW+/RRdCW9nwfLn4YX0s2nO6Kv5Y2ChqgIakaC6PW09A==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
@endif

{{-- ブログ・読書ノート --}}
@if (Route::is('front.blog.show') || Route::is('back.readingNote.show'))
<script id="MathJax-script" async src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/prism/1.24.1/components/prism-core.min.js" integrity="sha512-hM0R3pW9UdoNG9T+oIW5pG9ndvy3OKChFfVTKzjyxNW9xrt6vAbD3OeFWdSLQ8mjKSgd9dSO3RXn3tojQtiA8Q==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/prism/1.24.1/plugins/line-numbers/prism-line-numbers.min.js" integrity="sha512-dubtf8xMHSQlExGRQ5R7toxHLgSDZ0K7AunqPWHXmJQ8XyVIG19S1T95gBxlAeGOK02P4Da2RTnQz0Za0H0ebQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdn.jsdelivr.net/npm/prismjs@1.23.0/plugins/toolbar/prism-toolbar.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/prism/1.24.1/plugins/match-braces/prism-match-braces.min.js" integrity="sha512-J7bWI/nCFpAOtZutQV7Gi55C/PmjQueTRXlGZMB0alvHvjGAVTLWtijPMnMfTOhNTUiJsdnIFIkGdnoK+jnmeA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdn.jsdelivr.net/npm/prismjs@1.23.0/plugins/copy-to-clipboard/prism-copy-to-clipboard.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/prism/1.24.1/plugins/autoloader/prism-autoloader.min.js" integrity="sha512-xCfKr8zIONbip3Q1XG/u5x40hoJ0/DtP1bxyMEi0GWzUFoUffE+Dfw1Br8j55RRt9qG7bGKsh+4tSb1CvFHPSA==" crossorigin="anonymous" referrerpolicy="no-referrer" defer="defer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/prism/1.25.0/components/prism-css.min.js" integrity="sha512-Jv/EO8zjSyqIDa2S0YjCGFY+mEROxud6g7AhfA0KcggjdzhPBhoRyetxV7G7/dnfBdZBzcOvpRn1K+J6sn3jyw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/prism/1.25.0/components/prism-css-extras.min.js" integrity="sha512-4+noLxW8LigA+cEn17M025p1xs61w/vCjz0RaWhUwoRZZO2Esdtk1OgvzwykJU4lNgg0GhnLC76lfqhrSFOqeQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/prism/1.25.0/components/prism-scss.min.js" integrity="sha512-lQbJbXcaOvte/zzg18pf9ybI3iKZ2taOu9jE9c2z00Pdt8WiWAi3nFENtn+2aqlWaWkM+g683Wgj0ka/TOLvCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/prism/1.25.0/components/prism-markup.min.js" integrity="sha512-+ELqhG7rn9xgybNJa3VI05AczCW2IaKwpKdDC5lD8RMAGc6t+OEV0Cta1QyKCrsncgaRHiN80atxfVo72+M8xg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/prism/1.25.0/plugins/previewers/prism-previewers.js" integrity="sha512-+SwavZJ/xCcBKBzwpwMdCTdHVNfGb8M3/tgLVjenzlmd/haD7R6pi3DlSADliQgaRsV2vtViA11BDZVdF8zgRA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/prism/1.25.0/plugins/normalize-whitespace/prism-normalize-whitespace.min.js" integrity="sha512-jkelqcQ/rwCw36MumZ5fWlgs+aZEMLrgGt51ParMK7Tyam7kB5ZG+mB5R0NSeoGVr/4N+q3oGpLaFR/vXgzjTA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/prism/1.25.0/plugins/show-language/prism-show-language.min.js" integrity="sha512-teI3HjGzxHZz40l8V9ViL7ga18moIgswEgojE/Zl8jhAPhwkZI5/Y+RcIi8yMfA0TW0XHnfOpcmdm9+xj8atow==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/prism/1.25.0/plugins/data-uri-highlight/prism-data-uri-highlight.min.js" integrity="sha512-OV652xT199oSYUEwFbgqx0BB9HYnv/1FbGairrsqcGqtjFZkylCARmHV+TpOV8GgtUMLn6T6BSAcdsTh7NTw2g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/prism/1.25.0/plugins/treeview/prism-treeview.js" integrity="sha512-2TGnlW5QL/Esp1U/glgQDgUUuqwWqFWNXR87l6kZQmWCKiVvZeWWzhYJwC2N5gnZCW+5h2QjewmOUiQ4CbYgHA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/prism/1.25.0/plugins/command-line/prism-command-line.min.js" integrity="sha512-me+qtZLHv+CwTjJ9cihDxHl5JXcQAFkPy8GenPwm+21VF9QU0tY8C4d13wgeLheKSmbYGfRSQnITLSYA6Snr2w==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="{{ asset('/js/setMathJax.js') }}"></script>
<script src="{{ asset('/js/setParticles.js') }}"></script>
<script src="{{ asset('/js/makeToc.js') }}"></script>
<script src="{{ asset('/js/svgSizing.js') }}"></script>
@endif

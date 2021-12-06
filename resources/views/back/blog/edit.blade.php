@extends('back.layouts.base')
@section('title', 'ブログ記事を編集')

@section('main')
    <div class="row">
        <h1 class="col m10">「{{ $blog->title }}」を編集</h1>
        <a href="/blog/{{ $blog->id }}" target="_blank" rel="noopener noreferrer" class="col m2">
            <button class="_info _round _width100">記事を表示</button>
        </a>
    </div>
    <x-back.formResult />

    <script id="tagsJSON" type="application/json">
        <?php echo $tagsJSON; ?>
    </script>
    <script id="checkedTagsJSON" type="application/json">
        <?php echo $checkedTagsJSON; ?>
    </script>
    <div id="app">
        <form method="post" action="/admin/blog/{{ $blog->id }}" id="validateform" enctype="multipart/form-data">
        @csrf
        @method('PATCH')
            <label for="title">タイトル</label>
            <input type="text" name="title" class="_width100" v-model="need_title" v-init:need_title="'{{ $blog->title }}'">
            <need-errors :errors="errors.title"></need-errors>

            <label for="content">本文</label>
            <multi-image-uploader></multi-image-uploader>
            <xml-file-parser @tomixy_updatecontent="updateContent" init-content="{{ $blog->content }}"></xml-file-parser>
            <need-errors :errors="errors.content"></need-errors>

            <label for="metaimage">og:image</label>
            <div class="selectImageArea">
                <image-url-previewer input-name="metaimageURL" init-value="{{ $blog->metaimage }}"></image-url-previewer>
                <image-uploader input-name="metaimageFile"></image-uploader>
            </div>

            <label for="metadesc">og:description</label>
            <input type="text" name="metadesc" class="_width100" value="{{ $blog->metadesc }}">

            <rich-checkbox @tomixy_updatetagcount="updateTagCount"></rich-checkbox>
            <need-errors :errors="errors.tags"></need-errors>

            <button type="submit" class="_primary" @click="validate">更新</button>
            <a href="{{ route('back.blog.index') }}">
                <button type="button">一覧へ戻る</button>
            </a>
        </form>
    </div>
@endsection

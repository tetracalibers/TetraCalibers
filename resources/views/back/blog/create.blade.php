@extends('back.layouts.base')
@section('title', 'ブログ記事を新規作成')

@section('main')
    <h1>ブログ記事を新規作成</h1>

    <x-back.formResult />

    <script id="tagsJSON" type="application/json">
        <?php echo $tagsJSON; ?>
    </script>
    <div id="app">
        <form method="post" action="{{ route('back.blog.store') }}" id="validateform" enctype="multipart/form-data">
        @csrf
            <label for="series">シリーズ</label>
            <select name="series" class="_width100">
                <option value="0">該当なし</option>
                @foreach ($series as $s)
                <option value="{{ $s->id }}">{{ $s->title }}</option>
                @endforeach
            </select>

            <label for="title">タイトル</label>
            <input type="text" name="title" class="_width100" v-model="need_title">
            <need-errors :errors="errors.title"></need-errors>

            <label for="content">本文</label>
            <multi-image-uploader></multi-image-uploader>
            <xml-file-parser @tomixy_updatecontent="updateContent"></xml-file-parser>
            <need-errors :errors="errors.content"></need-errors>

            <label for="metaimage">og:image</label>
            <div class="selectImageArea">
                <image-url-previewer input-name="metaimageURL" init-value="{{ old('metaimageURL') }}"></image-url-previewer>
                <image-uploader input-name="metaimageFile"></image-uploader>
            </div>

            <label for="metadesc">og:description</label>
            <input type="text" name="metadesc" class="_width100" value="{{ old('metadesc') }}">

            <rich-checkbox @tomixy_updatetagcount="updateTagCount"></rich-checkbox>
            <need-errors :errors="errors.tags"></need-errors>

            <button type="submit" class="_primary" @click="validate">作成</button>
            <a href="{{ route('back.blog.index') }}">
                <button type="button">一覧へ戻る</button>
            </a>
        </form>
    </div>
@endsection

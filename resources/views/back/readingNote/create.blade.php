@extends('back.layouts.base')
@section('title', '読書ノートを新規作成')

@section('main')
    <h1>読書ノートを新規作成</h1>

    <x-back.formResult />

    <script id="tagsJSON" type="application/json">
        <?php echo $tagsJSON; ?>
    </script>
    <div id="app">
        <form method="post" action="{{ route('back.readingNote.store') }}" id="validateform">
        @csrf
            <label for="title">タイトル</label>
            <input type="text" name="title" class="_width100" v-model="need_title">
            <need-errors :errors="errors.title"></need-errors>

            <label for="note">内容</label>
            <block-editor @tomixy_updatecontent="updateContent"></block-editor>
            <need-errors :errors="errors.content"></need-errors>

            <rich-checkbox @tomixy_updatetagcount="updateTagCount"></rich-checkbox>
            <need-errors :errors="errors.tags"></need-errors>

            <button type="submit" class="_primary" @click="validate">作成</button>
            <a href="{{ route('back.readingNote.index') }}">
                <button type="button">一覧へ戻る</button>
            </a>
        </form>
    </div>
@endsection

@extends('back.layouts.base')
@section('title', '読書ノートを編集')
@section('head')
<script id="data" type="application/json">
    <?php echo $structures; ?>
</script>
<script id="tagsJSON" type="application/json">
    <?php echo $tagsJSON; ?>
</script>
<script id="checkedTagsJSON" type="application/json">
    <?php echo $checkedTagsJSON; ?>
</script>
@endsection

@section('main')
    <div class="row">
        <h1 class="col m10">「{{ $note->title }}」の読書ノートを編集</h1>
        <a href="/admin/readingNote/{{ $note->id }}" target="_blank" rel="noopener noreferrer" class="col m2">
            <button class="_info _round _width100">読書ノートを表示</button>
        </a>
    </div>

    <x-back.formResult />
    <div id="app">
        <form method="post" action="/admin/readingNote/{{ $note->id }}" id="validateform">
        @csrf
        @method('PATCH')
            <label for="title">タイトル</label>
            <input type="text" name="title" class="_width100" v-model="need_title" v-init:need_title="'{{ $note->title }}'">
            <need-errors :errors="errors.title"></need-errors>

            <label for="note">内容</label>
            <block-editor @tomixy_updatecontent="updateContent"></block-editor>
            <need-errors :errors="errors.content"></need-errors>

            <rich-checkbox @tomixy_updatetagcount="updateTagCount"></rich-checkbox>
            <need-errors :errors="errors.tags"></need-errors>

            <button type="submit" class="_primary" @click="validate">更新</button>
            <a href="{{ route('back.readingNote.index') }}">
                <button type="button">一覧へ戻る</button>
            </a>
        </form>
    </div>
@endsection

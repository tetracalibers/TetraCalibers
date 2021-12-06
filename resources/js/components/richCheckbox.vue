<template>
    <label>選択済みのタグ</label>
    <template v-for="id of checkedTags" :key="id">
        <input type="hidden" name="tags[]" :value="id">
        <span class="selectTag">{{ tagName(id) }}<i class="fas fa-times" @click="removeTag(id)"></i></span>
    </template>
    <label>タグ一覧</label>
    <div class="row">
        <template v-for="tag of tags" :key="tag.id">
            <div class="col m2">
                <label class="checkTag" :id="'label' + tag.id">
                    <input type="checkbox" v-model="checkedTags" :value="tag.id" @change="updateTagCount">
                    <div class="tagName" v-text="tag.name.replaceAll(/<wbr>/g, '')"></div>
                    <img class="tagLogo" :src="tag.logo">
                </label>
            </div>
        </template>
    </div>
</template>

<script>
var tags = JSON.parse(document.getElementById("tagsJSON").text);
if (document.getElementById("checkedTagsJSON")) {
    var checkedTags = JSON.parse(document.getElementById("checkedTagsJSON").text);
} else {
    var checkedTags = [];
}

export default {
    data() {
        return {
            tags: tags,
            checkedTags: checkedTags,
        };
    },
    emits: ["tomixy_updatetagcount"],
    mounted() {
        this.updateTagCount();
    },
    methods: {
        tagName(id) {
            for (var tag of this.tags) {
                if (tag.id == id) {
                    return tag.name;
                }
            }
        },
        updateTagCount() {
            this.$emit('tomixy_updatetagcount', this.checkedTags.length);
        },
        removeTag(id) {
            this.checkedTags.splice(this.checkedTags.indexOf(id), 1);
            document.getElementById('label' + id).classList.remove('checkedTag');
            this.updateTagCount();
        }
    }
}
</script>

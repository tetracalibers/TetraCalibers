<template>
    <input type="url" v-model="url" :name="inputName" class="urlInput" placeholder="URLを入力" />
    <div v-if="url" class="urlPreview">
        <img :src="url" class="-thumb">
        <div class="image_name">
            <i class="far fa-trash-alt" @click="deleteImage"></i>
        </div>
    </div>
</template>

<script>
export default {
    props: [
        'inputName',
        'initValue'
    ],
    data() {
        return {
            url: this.$props.initValue
        };
    },
    methods: {
        deleteImage() {
            this.url = "";
        }
    }
};
</script>

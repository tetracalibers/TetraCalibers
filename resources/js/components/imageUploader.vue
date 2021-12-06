<template>
    <label class="fileInput _f-indigo _round _cream">
        <i class="far fa-2x fa-image"></i>
        <span>画像を選択</span>
        <input
            type="file"
            :name="inputName"
            @change="onFileChange"
            :accept="accept"
            ref="file"
        />
    </label>
    <div v-if="image" class="filePreview">
        <img :src="image.thumnail" class="-thumb" />
        <div class="image_name">
            {{ image.name }}
            <i class="far fa-trash-alt" @click="deleteImage"></i>
        </div>
    </div>
</template>

<script>
export default {
    props: [
        'inputName'
    ],
    data() {
        return {
            image: null,
            accept: this.inputName == 'metaimageFile' ? 'image/png,image/jpg,image/webp,image/gif' : 'image/png,image/jpg,image/jpeg,image/gif,image/svg+xml'
        };
    },
    methods: {
        onFileChange(e) {
            var files = e.target.files || e.dataTransfer.files;
            this.createImage(files[0]);
        },
        createImage(file) {
            var reader = new FileReader();
            var vm = this;
            var obj = {};
            reader.onload = function (e) {
                obj.thumnail = e.target.result;
                obj.uploadFile = file;
                obj.name = file.name;
                vm.image = obj;
            };
            reader.readAsDataURL(file);
        },
        deleteImage() {
            this.image = null;
            this.$refs.file.value = null;
        },
    },
};
</script>

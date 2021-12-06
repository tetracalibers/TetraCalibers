<template>
    <div class="uploadContainer">
        <label class="_cream _f-indigo _round">
            <i class="far fa-file-image fa-2x"></i>
            <span>添付画像を選択</span>
            <input
                type="file"
                name="attachedImage[]"
                id="attachedImage"
                ref="preview"
                @change="onFileChange"
                accept="image/png,image/jpg,image/jpeg,image/gif,image/svg+xml"
                multiple
            />
        </label>
        <div v-if="images">
            <ol>
                <li
                    v-for="(image, index) in images"
                    :key="index"
                    class="card _info"
                >
                    <img :src="image.thumnail" class="-thumb" />
                    <div class="image_name">
                        {{ image.name }}
                        <i
                            class="far fa-trash-alt"
                            @click="deleteImage(index)"
                        ></i>
                    </div>
                </li>
            </ol>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            images: [],
        };
    },
    methods: {
        onFileChange: function (e) {
            var files = e.target.files || e.dataTransfer.files;
            this.createImage(files[0]);
        },
        createImage(file) {
            var image = new Image();
            var reader = new FileReader();
            var vm = this;
            var obj = {};
            reader.onload = function (e) {
                obj.thumnail = e.target.result;
                obj.uploadFile = file;
                obj.name = file.name;
                vm.images.push(obj);
                vm.refillForm();
            };
            reader.readAsDataURL(file);
        },
        deleteImage(index) {
            this.images.splice(index, 1);
            this.refillForm();
        },
        refillForm() {
            const fileForm = document.getElementById("attachedImage");
            const dt = new DataTransfer();
            this.images.forEach(function (image) {
                dt.items.add(image.uploadFile);
            });
            fileForm.files = dt.files;
            console.log(fileForm.files.length);
        }
    },
};
</script>

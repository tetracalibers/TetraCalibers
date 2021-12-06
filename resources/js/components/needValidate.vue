<script>
import blockEditor from './blockEditor.vue'
import needErrors from './needErrors.vue'
import richCheckbox from './richCheckbox.vue'
import xmlFileParser from './xmlFileParser.vue'
import multiImageUploader from './multiImageUploader.vue'
import imageUploader from './imageUploader.vue'
import imageURLpreviewer from './imageURLpreviewer.vue'

export default {
    components: {
        "block-editor": blockEditor,
        "rich-checkbox": richCheckbox,
        "need-errors": needErrors,
        "xml-file-parser": xmlFileParser,
        "multi-image-uploader": multiImageUploader,
        "image-uploader": imageUploader,
        "image-url-previewer": imageURLpreviewer
    },
    data() {
        return {
            need_title: '',
            need_content: '',
            need_tags: 0,
            errors: {}
        }
    },
    methods: {
        updateContent(content) {
            this.need_content = content;
        },
        updateTagCount(tagCount) {
            this.need_tags = tagCount;
        },
        validate: function(e) {
            e.preventDefault();
            var errors = {};

            if (!this.need_title) {
                errors.title = 'タイトルを入力してください';
            }
            if (!this.need_content) {
                errors.content = '本文のHTMLが生成されていません';
            }
            if (this.need_tags < 1) {
                errors.tags = 'タグを一つ以上選択してください';
            }

            if (Object.keys(errors).length < 1) {
                document.getElementById('validateform').submit();
            } else {
                this.errors = errors;
                window.scroll({
                    top: 0,
                    behavior: 'smooth'
                });
            }
        }
    }
}
</script>

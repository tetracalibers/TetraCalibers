<template>
    <div class="blockEditor">
        <div class="row">
            <div class="col m6">
                <button type="button" @click="addInput('heading')" class="_round _cream">
                    <i class="fas fa-heading fa-2x"></i>
                </button>
                <button type="button" @click="addInput('paragraph')" class="_round _cream">
                    <i class="fas fa-paragraph fa-2x"></i>
                </button>
                <button type="button" @click="addInput('mathBlock')" class="_round _cream">
                    <i class="fas fa-square-root-alt fa-2x"></i>
                </button>

                <button type="button" class="accordion _round _cream">
                    <i class="fas fa-code fa-2x"></i>
                </button>
                <div class="-panel">
                    <input type="text" v-model="language" placeholder="language">
                    <input type="text" v-model="fileName" placeholder="file name">
                    <button type="button" @click="addInput('codeBlock')" class="_round _cream">
                        <i class="far fa-plus-square fa-2x"></i>
                    </button>
                </div>

                <div class="note">
                    <ul>
                        <li>インライン数式は<i class="fas fa-paragraph"></i>の中に<code>$TeX$</code></li>
                        <li>別行立て数式は<i class="fas fa-square-root-alt"></i>の中に<code>$$TeX$$</code></li>
                        <li>textareaでは<code>Tab</code>キーでタブを挿入できます</li>
                        <li>インラインコードは<code>言語名:コード</code>と入力＆選択して<code>option</code>+<code>command</code>+<code>left</code></li>
                    </ul>
                </div>

                <div v-for="(text, index) in structures" :key="index">
                    <template v-if="structures[index]['mode'] === 'heading'">
                        <input type="text" v-model="structures[index]['content']" class="_width75" />
                    </template>
                    <template v-if="structures[index]['mode'] === 'paragraph'">
                        <textarea v-model="structures[index]['content']" class="_width75" @keydown.tab="insertTab(index, 'content', $event)" @keydown.alt.shift.left="inlineCode(index, 'content', $event)"></textarea>
                    </template>
                    <template v-if="structures[index]['mode'] === 'mathBlock'">
                        <input type="text" v-model="structures[index]['formula']" class="_width75 _teal _f-white _box" />
                    </template>
                    <template v-if="structures[index]['mode'] === 'codeBlock'">
                        <textarea v-model="structures[index]['code']" class="codeArea _width75" @keydown.tab="insertTab(index, 'code', $event)"></textarea>
                    </template>
                    <button type="button" @click="removeInput(index)" class="_round _cream">
                        <i class="fas fa-trash-alt fa-2x"></i>
                    </button>
                </div>
                <div class="toTopButton" @click="toTop" id="editorEnd"><i class="fas fa-chevron-up fa-2x"></i></div>
            </div>

            <div class="col m6">
                <div>Preview</div>
                <div class="card">
                    <div ref="preview" class="-content preview">
                        <template v-for="(text, index) in structures" :key="index">
                            <template v-if="structures[index]['mode'] === 'heading'">
                                <div v-html="heading(structures[index]['content'])"></div>
                            </template>
                            <template v-if="structures[index]['mode'] === 'paragraph'">
                                <div v-html="paragraph(structures[index]['content'])"></div>
                            </template>
                            <template v-if="structures[index]['mode'] === 'mathBlock'">
                                <vue-mathjax :formula="structures[index]['formula']"></vue-mathjax>
                            </template>
                            <template v-if="structures[index]['mode'] === 'codeBlock'">
                                <div v-html="codeBlock(structures[index])"></div>
                            </template>
                        </template>
                    </div>
                </div>
            </div>
        </div>

        <textarea v-text="saveHTML" class="confirm confirmHTML _width100" :name="textareaName" placeholder="ブロックから生成されたHTML" readonly></textarea>
        <input type="text" name="structures" class="confirm" :value="saveStructures" placeholder="ブロックの構造" readonly>
        <button type="button" @click="save" class="_warning">HTMLに変換して保存</button>
    </div>
</template>

<script>
var currentPath = location.pathname;
var pathParts = currentPath.split("/");

var structures;
var textareaName;

if (pathParts[3] === 'create') {
    var structures = [];
} else if (pathParts[4] === 'edit' && pathParts[2] === 'readingNote') {
    var s = document.getElementById("data").text;
    var structures = JSON.parse(s);
}

switch (pathParts[2]) {
    case 'blog':
        var textareaName = 'content';
        break;

    case 'readingNote':
        var textareaName = 'note';
        break;
}

import VueMathjax from '../../../node_modules/vue-mathjax-next/src/index.vue'

export default {
    components: {
        "vue-mathjax": VueMathjax
    },
    data() {
        return {
            structures: structures,
            language: '',
            fileName: '',
            saveHTML: '',
            saveStructures: '',
            textareaName: textareaName
        };
    },
    emits: ["tomixy_updatecontent"],
    methods: {
        removeInput(index) {
            this.structures.splice('index', 1);
        },
        addInput(mode) {
            if (mode === 'heading') {
                this.structures.push({
                    'mode' : 'heading',
                    'content' : ''
                });
            } else if (mode === 'paragraph') {
                this.structures.push({
                    'mode' : 'paragraph',
                    'content' : ''
                });
            } else if (mode === 'mathBlock') {
                this.structures.push({
                    'mode' : 'mathBlock',
                    'formula' : ''
                });
            } else if (mode === 'codeBlock') {
                this.structures.push({
                    'mode' : 'codeBlock',
                    'language' : this.language,
                    'fileName' : this.fileName,
                    'code': ''
                });
            }

            var editor = document.getElementById('editorEnd');
            editor.scrollIntoView({
                behavior: 'smooth',
                block: 'center'
            });
        },
        toTop() {
            window.scroll({
                top: 0,
                behavior: 'smooth'
            });
        },
        insertTab(index, type, e) {
            e.preventDefault();
            let textarea = e.target;
            let val = textarea.value;
            let pos = textarea.selectionStart;
            this.structures[index][type] = val.substr(0, pos) + '\t' + val.substr(pos, val.length);
            textarea = setSelectionRange(pos + 1, pos + 1);
        },
        inlineCode(index, type, e) {
            e.preventDefault();
            let select = window.getSelection();
            if (!select.rangeCount) {
                return;
            }
            let textarea = e.target;
            let allText = textarea.value;

            let selectedText = select.toString();
            let language = selectedText.split(':', 1)[0];
            let code = selectedText.split(':', 2)[1];
            let markedCode = '<code class="language-' + language + ' match-braces rainbow-braces">'+ code + '</code>';

            let selectStart = textarea.selectionStart;
            let selectEnd = textarea.selectionEnd;

            this.structures[index][type] = allText.substr(0, selectStart).replace(selectedText, '') + markedCode + allText.substr(selectEnd, allText.length);
        },
        heading(content) {
            return '<h1>' + content + '</h1>';
        },
        paragraph(content) {
            return '<p>' + content + '</p>';
        },
        mathBlock(formula) {
            return '$$' + formula + '$$';
        },
        escapeHTML(string){
            return string.replace(/&/g, '&amp;')
            .replace(/</g, '&lt;')
            .replace(/>/g, '&gt;')
            .replace(/"/g, '&quot;')
            .replace(/'/g, "&#x27;");
        },
        decodeHTML(string){
            return string.replace(/&amp;/g, '&')
            .replace(/&lt;/g, '<')
            .replace(/&gt;/g, '>')
            .replace(/&quot;/g, '"')
            .replace(/&#x27;/g, "'");
        },
        codeBlock(codeObj) {
            let HTML = '<p class="code-tag">' + codeObj['fileName'] + '</p>';
            HTML += '<pre><code class="language-' + codeObj['language'] + ' line-numbers match-braces rainbow-braces">';
            HTML += this.escapeHTML(this.decodeHTML(codeObj['code']));
            HTML += '</code></pre>';

            return HTML;
        },
        save() {
            this.saveStructures = JSON.stringify(this.structures);
            var tmpHTML = this.$refs.preview.innerHTML.replace(/<!--v-if-->/g, '');
            this.saveHTML = tmpHTML;
            this.$emit('tomixy_updatecontent', this.saveHTML);
        }
    }
}
</script>

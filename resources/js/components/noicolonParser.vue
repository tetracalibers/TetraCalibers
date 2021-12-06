<template>
    <div class="xmlparseContainer">
        <label class="_f-indigo _pink _round">
            <i class="far fa-file-word fa-2x"></i>
            <span>noicolon原稿ファイルを選択</span>
            <input type="file" @change="readfile" accept=".md, .txt" />
        </label>
        <textarea
            :value="data"
            class="confirm confirmHTML _width100"
            :name="textareaName"
            placeholder="原稿ファイルから生成されたHTML"
            readonly
        ></textarea>
    </div>
</template>

<script>
var currentPath = location.pathname;
var pathParts = currentPath.split("/");

var textareaName;

switch (pathParts[2]) {
    case "blog":
        var textareaName = "content";
        break;

    case "readingNote":
        var textareaName = "note";
        break;
}

export default {
    props: ["initContent"],
    data() {
        return {
            data: this.$props.initContent,
            textareaName: textareaName,
        };
    },
    emits: ["tomixy_updatecontent"],
    mounted() {
        this.$emit("tomixy_updatecontent", this.data);
    },
    methods: {
        escapeHTML(string) {
            return string
                .replace(/&/g, "&amp;")
                .replace(/</g, "&lt;")
                .replace(/>/g, "&gt;")
                .replace(/"/g, "&quot;")
                .replace(/'/g, "&#x27;");
        },
        decodeHTML(string) {
            return string
                .replace(/&amp;/g, "&")
                .replace(/&lt;/g, "<")
                .replace(/&gt;/g, ">")
                .replace(/&quot;/g, '"')
                .replace(/&#x27;/g, "'");
        },
        readfile: function (e) {
            const vm = this;
            const file = e.target.files[0];

            const reader = new FileReader();

            reader.onload = () => {
                var mylang = reader.result;
                /** 準備 */
                mylang = mylang
                        .replace(/\$/gm, "\$")
                        .replace(/\./gm, "\.")
                        .replace(/\^/gm, "\^")
                        .replace(/\+/gm, "\+")
                        .replace(/\\/, "\\");

                /** 見出し */
                mylang = mylang.replace(/^h:\s*(.*?)$/gms, "<h1>$1</h1>");

                /** ファイル名 */
                mylang = mylang.replace(
                    /fname:\s*(.*?)$/gms,
                    '<p class="code-tag">$1</p>'
                );

                /** インラインコード */
                let incodeReg = /incode-(?<lang>\w+):\s*(?<incode>.*?)$/gmsu;
                let incodeRegResult = incodeReg.exec(mylang);
                if (incodeRegResult !== null) {
                    // TODO BEGIN 本番環境ではコメントを外す
                    let plainIncode = incodeRegResult.groups.incode;
                    mylang = mylang.replaceAll(
                        plainIncode,
                        vm.escapeHTML(plainIncode)
                    );
                    // TODO END
                    mylang = mylang.replace(
                        incodeReg,
                        '<code class="language-$1 match-braces rainbow-braces">$2</code>'
                    );
                }

                /** 箇条書きリスト */
                let lReg = /begin:\s*(?<lMood>[uo])l[^\w](?<lItems>.*?)end:\s*[uo]l/mgsu;
                let lists = mylang.match(lReg);
                lists.forEach(function (list) {
                    let lRegResult = lReg.exec(mylang);
                    let lItems = lRegResult.groups.lItems;
                    let lMood = lRegResult.groups.lMood;
                    let lItemsArr = lItems.split(/\n/).slice(0, -1);
                    for (var i = 0; i < lItemsArr.length; i++) {
                        lItemsArr[i] = '<li>' + lItemsArr[i] + '</li>';
                    }
                    lItems = lItemsArr.join('\n');
                    mylang = mylang.replace(list, "<" + lMood + "l>" + lItems + "</" + lMood + "l>");
                });

                /** 定義リスト */
                let dlReg = /begin:\s*dl[^\w](?<dlItems>.*?)end:\s*dl/msgu;
                let dlMatch = mylang.match(dlReg);
                dlMatch.forEach(function (dlist) {
                    let dlRegResult = dlReg.exec(mylang);
                    let dlItems = dlRegResult.groups.dlItems;
                    let dlItemsArr = dlItems.split(/\n/).slice(0, -1);
                    for (let i = 0; i < dlItemsArr.length; i++) {
                        if (dlItemsArr[i].match(/dt:.*?/mus)) {
                            dlItemsArr[i] = '<dt>' + dlItemsArr[i].replace('dt:', '') + '</dt>';
                        } else {
                            dlItemsArr[i] = '<dd>' + dlItemsArr[i] + '</dd>';
                        }
                    }
                    dlItems = dlItemsArr.join('\n');
                    mylang = mylang.replace(dlist, '<dl>' + dlItems + '</dl>');
                });

                /** テーブル */
                let trReg = /begin:\s*tr[^\w](?<trItems>.*?)end:\s*tr/msgu;
                let trMatch = mylang.match(trReg);
                trMatch.forEach(function(row) {
                    let trRegResult = trReg.exec(mylang);
                    let trItems = trRegResult.groups.trItems;
                    let trItemsArr = trItems.split(/\n/).slice(0, -1);
                    for (let i = 0; i < trItemsArr.length; i++) {
                        if (trItemsArr[i].match(/th:.*?/mus)) {
                            trItemsArr[i] = '<th>' + trItemsArr[i].replace('th:', '') + '</th>';
                        } else {
                            trItemsArr[i] = '<td>' + trItemsArr[i] + '</td>';
                        }
                    }
                    trItems = trItemsArr.join('\n');
                    mylang = mylang.replace(row, '<tr>' + trItems + '</tr>');
                });
                mylang = mylang.replace(/begin:\s*table[^\w](.*?)end:\s*table/msgu, '<table>$1</table>');

                /** ディレクトリツリー */
                mylang = mylang.replace(/begin:\s*tree(.*?)end:\s*tree/msug, '<pre><code class="language-treeview">$1</code></pre>');

                /** 画像 */
                mylang = mylang.replace(/image:\s*(.*?)$/msug, '<div class="imageWrap"><img src="../images/Articles/$1"></div>');

                /** コードブロック */
                let codeReg =
                    /begin:\s*code-(\w+)[^\w](?<code>.*?)end:\s*code-(\w+)/gmsu;
                let codeRegResult = codeReg.exec(mylang);
                if (codeRegResult !== null) {
                    // TODO BEGIN 本番環境ではコメントを外す
                    let plainCode = codeRegResult.groups.code;
                    mylang.replaceAll(plainCode, vm.escapeHTML(plainCode));
                    // TODO END
                    mylang = mylang.replace(
                        codeReg,
                        '<pre><code class="language-$1 line-numbers match-braces rainbow-braces">$2</code></pre>'
                    );
                }

                vm.data = mylang;
                this.$emit("tomixy_updatecontent", mylang);
            };

            reader.readAsText(file);
        },
    },
};
</script>

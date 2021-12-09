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
                .replace(/'/g, "&#x27;")
                .replace(/\{\{(.*?)\}\}/gmsu, "<code v-pre>{{$1}}</code>");
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
                var mylangArr = mylang.split("\n");
                var currentAddBr = true;
                var nextAddBr = true;
                var isBetween = false;

                /** 正規表現を使う準備 */
                mylang = mylang
                    .replace(/\$/gm, "\$")
                    .replace(/\./gm, "\.")
                    .replace(/\^/gm, "\^")
                    .replace(/\+/gm, "\+")
                    .replace(/\\/, "\\");

                /** 改行の付加 */
                for (var i = 0; i < mylangArr.length; i++) {
                    var current = mylangArr[i];
                    currentAddBr = nextAddBr ? true : false;
                    if (current.match(/^(begin):.*?$/gmsu)) {
                        currentAddBr = false;
                        nextAddBr = false;
                        isBetween = true;
                    } else if (current.match(/^(end):.*?$/gmsu)) {
                        currentAddBr = false;
                        nextAddBr = true;
                        isBetween = false;
                    } else if (
                        current.match(/^(image)|(h)|(a)|(fname):.*?$/gmsu)
                    ) {
                        currentAddBr = false;
                        nextAddBr = false;
                    } else if (
                        current.match(
                            /^(incode-\w+)|(image)|(h)|(a)|(fname):.*?$/gmsu
                        )
                    ) {
                        currentAddBr = false;
                        nextAddBr = true;
                    } else {
                        currentAddBr = true;
                        nextAddBr = true;
                    }
                    if (current.match(/^(?:)$/gmsu)) {
                        mylangArr[i] = current + "<p>&nbsp;</p>\n";
                    } else if (currentAddBr && !isBetween) {
                        mylangArr[i] = current + "<br>\n";
                    } else {
                        mylangArr[i] = current + "\n";
                    }
                }
                mylang = mylangArr.join("");

                /** 見出し */
                mylang = mylang.replace(/^h:\s*(.*?)$/gms, "<h1>$1</h1>");

                /** リンク */
                mylang = mylang.replace(
                    /^a:\s*(.*?)$/gms,
                    '<link-prevue url="$1"></link-prevue>'
                );

                /** ファイル名 */
                mylang = mylang.replace(
                    /fname:\s*(.*?)$/gms,
                    '<p class="code-tag">$1</p>'
                );

                /** 箇条書きリスト */
                let lReg =
                    /begin:\s*(?<lMood>[uo])l[^\w](?<lItems>.*?)end:\s*[uo]l/gmsu;
                let lists = mylang.match(lReg);
                if (lists !== null) {
                    lists.forEach(function (list) {
                        let lRegResult = lReg.exec(mylang);
                        let lItems = lRegResult.groups.lItems;
                        let lMood = lRegResult.groups.lMood;
                        let lItemsArr = lItems.split(/\n/).slice(0, -1);
                        for (var i = 0; i < lItemsArr.length; i++) {
                            lItemsArr[i] = "<li>" + lItemsArr[i] + "</li>";
                        }
                        lItems = lItemsArr.join("\n");
                        mylang = mylang.replace(
                            list,
                            "<" + lMood + "l>" + lItems + "</" + lMood + "l>"
                        );
                    });
                }

                /** 定義リスト */
                let dlReg = /begin:\s*dl[^\w](?<dlItems>.*?)end:\s*dl/gmsu;
                let dlMatch = mylang.match(dlReg);
                if (dlMatch !== null) {
                    dlMatch.forEach(function (dlist) {
                        let dlRegResult = dlReg.exec(mylang);
                        let dlItems = dlRegResult.groups.dlItems;
                        let dlItemsArr = dlItems.split(/\n/).slice(0, -1);
                        for (let i = 0; i < dlItemsArr.length; i++) {
                            if (dlItemsArr[i].match(/dt:.*?/msu)) {
                                dlItemsArr[i] =
                                    "<dt>" +
                                    dlItemsArr[i].replace("dt:", "") +
                                    "</dt>";
                            } else {
                                dlItemsArr[i] =
                                    "<dd>" + dlItemsArr[i] + "</dd>";
                            }
                        }
                        dlItems = dlItemsArr.join("\n");
                        mylang = mylang.replace(
                            dlist,
                            "<dl>" + dlItems + "</dl>"
                        );
                    });
                }

                /** テーブル */
                let trReg = /begin:\s*tr[^\w](?<trItems>.*?)end:\s*tr/gmsu;
                let trMatch = mylang.match(trReg);
                if (trMatch !== null) {
                    trMatch.forEach(function (row) {
                        let trRegResult = trReg.exec(mylang);
                        let trItems = trRegResult.groups.trItems;
                        let trItemsArr = trItems.split(/\n/).slice(0, -1);
                        for (let i = 0; i < trItemsArr.length; i++) {
                            if (trItemsArr[i].match(/th:.*?/msu)) {
                                trItemsArr[i] =
                                    "<th>" +
                                    trItemsArr[i].replace("th:", "") +
                                    "</th>";
                            } else {
                                trItemsArr[i] =
                                    "<td>" + trItemsArr[i] + "</td>";
                            }
                        }
                        trItems = trItemsArr.join("\n");
                        mylang = mylang.replace(
                            row,
                            "<tr>" + trItems + "</tr>"
                        );
                    });
                    mylang = mylang.replace(
                        /begin:\s*table[^\w](.*?)end:\s*table/gmsu,
                        "<table>$1</table>"
                    );
                }

                /** ディレクトリツリー */
                mylang = mylang.replace(
                    /begin:\s*tree(.*?)end:\s*tree/gmsu,
                    '<pre><code class="language-treeview">$1</code></pre>'
                );

                /** 数式ブロック */
                mylang = mylang.replace(
                    /begin:\s*math(.*?)end:\s*math/gmsu,
                    "$$$$$1$$$$"
                );

                /** 画像 */
                mylang = mylang.replace(
                    /image:\s*(.*?)$/gmsu,
                    '<div class="imageWrap"><img src="../images/Articles/$1"></div>'
                );

                /** インラインコード */
                let incodeReg =
                    /[<\/brp>\n]*^incode-(?<lang>\w+):\s*(?<incode>.*?)$/gmsu;
                let incodes = mylang.match(incodeReg);
                if (incodes !== null) {
                    incodes.forEach(function (incode) {
                        let incodeRegResult = incodeReg.exec(mylang);
                        let lang = incodeRegResult.groups.lang;
                        let plainIncode = vm.escapeHTML(
                            incodeRegResult.groups.incode
                        );
                        mylang = mylang.replace(
                            incode,
                            '<span class="switchDark"><code class="language-' +
                                lang +
                                ' match-braces rainbow-braces">' +
                                plainIncode +
                                "</code></span>"
                        );
                    });
                }

                /** コードブロック */
                let codeReg =
                    /begin:\s*code-(?<lang>\w+)[^\w](?<code>.*?)end:\s*code-(\w+)/gmsu;
                let codeMatch = mylang.match(codeReg);
                if (codeMatch !== null) {
                    codeMatch.forEach(function (code) {
                        let codeRegResult = codeReg.exec(mylang);
                        let lang = codeRegResult.groups.lang;
                        let plainCode = vm.escapeHTML(
                            codeRegResult.groups.code
                        );
                        mylang = mylang.replace(
                            code,
                            '<pre><code class="language-' +
                                lang +
                                ' line-numbers match-braces rainbow-braces">' +
                                plainCode +
                                "</code></pre>"
                        );
                    });
                }

                /** vim */
                let vimReg = /begin:\s*vim[^\w](?<code>.*?)end:\s*vim/gmsu;
                let vimMatch = mylang.match(vimReg);
                if (vimMatch !== null) {
                    vimMatch.forEach(function (vim) {
                        let vimRegResult = vimReg.exec(mylang);
                        let code = vm.escapeHTML(vimRegResult.groups.code);
                        mylang = mylang.replace(
                            vim,
                            '<div class="switchDark"><pre><code class="language-vim match-braces rainbow-braces">' +
                                code +
                                "</code></pre></div>"
                        );
                    });
                }

                /** ターミナル */
                let terminalReg =
                    /begin:\s*terminal\s*(?<user>[\w\d]*)@?(?<host>[\w\d]*)[^\w](?<command>.*?)end:\s*terminal/gmsu;
                let terminalMatch = mylang.match(terminalReg);
                if (terminalMatch !== null) {
                    terminalMatch.forEach(function (terminal) {
                        let terminalRegResult = terminalReg.exec(mylang);
                        if (terminalRegResult !== null) {
                            let user = terminalRegResult.groups.user;
                            let host = terminalRegResult.groups.host;
                            let command = terminalRegResult.groups.command;
                            let rows = command.split("\n");
                            let outputIdxArr = [];
                            for (let i = 0; i < rows.length; i++) {
                                if (rows[i].match(/^out:\s*(.*?)$/gmsu)) {
                                    outputIdxArr.push(i + 1);
                                    rows[i] = rows[i].replace(
                                        /^out:\s*/gmsu,
                                        ""
                                    );
                                }
                            }
                            let outputIdxStr = outputIdxArr.join();
                            command = vm.escapeHTML(rows.join("\n"));
                            mylang = mylang.replace(
                                terminal,
                                '<div class="switchDark"><pre class="command-line" data-user="' +
                                    user +
                                    '" data-host="' +
                                    host +
                                    '" data-output="' +
                                    outputIdxStr +
                                    '"><code class="language-bash">' +
                                    command +
                                    "</code></pre></div>"
                            );
                        }
                    });
                }

                vm.data = mylang;
                this.$emit("tomixy_updatecontent", mylang);
            };

            reader.readAsText(file);
        },
    },
};
</script>

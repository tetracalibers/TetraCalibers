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
                            /^(incode-\w+)|(key)|(dir)|(file)|(link)|(button)|(pre):.*?$/gmsu
                        )
                    ) {
                        currentAddBr = false;
                        nextAddBr = true;
                    } else {
                        currentAddBr = true;
                        nextAddBr = true;
                    }
                    if (current.match(/^(?:)$/gmsu) && !isBetween) {
                        mylangArr[i] = current + "<p>&nbsp;</p>\n";
                    } else if (currentAddBr && !isBetween) {
                        mylangArr[i] = current + "<br>\n";
                    } else {
                        mylangArr[i] = current + "\n";
                    }
                }
                mylang = mylangArr.join("");

                /** ショートコード */
                mylang = mylang.replace(/[^:]::抽象/gmsu, '<span class="i-tyusho"><i class="fas fa-spinner"></i><span class="i-tyusho-text">抽象</span></span>');
                mylang = mylang.replace(/[^:]::具体/gmsu, '<span class="i-gutai"><i class="fas fa-circle-notch"></i><span class="i-gutai-text">具体</span></span>');
                mylang = mylang.replace(/::マル/gmsu, '<i class="far fa-circle"></i>')
                mylang = mylang.replace(/::バツ/gmsu, '<i class="fas fa-times"></i>')
                mylang = mylang.replace(/担当者::/gmsu, '<span class="i-tantosha"><i class="fas fa-user"></i><span class="i-tantosha-text">担当者：</span></span>');
                mylang = mylang.replace(/:参考文献:/gmsu, '<div class="i-sankobunken"><i class="fas fa-book"></i><span class="i-sankobunken-text">参考文献</span></div>');
                mylang = mylang.replace(/:最新のコードはこちら:/gmsu, '<div class="i-github"><i class="fas fa-code"></i><span class="i-github-text">最新のコードはこちら</span><i class="fas fa-code"></i></div>');

                /** 見出し */
                mylang = mylang.replace(/^h:\s*(.*?)$/gms, "<h1>$1</h1>");

                /** ブロックURL（非推奨） */
                mylang = mylang.replace(
                    /^a:\s*(.*?)$/gms,
                    '<a href="$1" class="url" target="_blank" rel="noopener noreferrer"><div class="omit">$1</div></a>'
                );

                /** インラインURL */
                mylang = mylang.replace(
                    /(?:<br>|<\/p>)?[\n\t\s]*link:\s*(.*?)\[(.*?)\]/gms,
                    '<a href="$2" class="i-link" target="_blank rel="noopener noreferrer><i class="fas fa-link"></i>$2</a>'
                );

                /** ブロックURL */
                mylang = mylang.replace(
                    /(?:<br>|<\/p>)?[\n\t\s]*link\s*-b:\s*(.*?)\[(.*?)\]/gms,
                    '<a href="$2" class="i-link i-block" target="_blank rel="noopener noreferrer><i class="fas fa-link"></i>$2</a>'
                );

                /** タイトル付きインラインURL */
                mylang = mylang.replace(
                    /(?:<br>|<\/p>)?[\n\t\s]*linkt:\s*(.*?)\[(.*?)\]/gms,
                    '<a href="$2" class="i-link" target="_blank rel="noopener noreferrer><i class="fas fa-link"></i>$1</a>'
                );

                /** タイトル付きブロックURL */
                mylang = mylang.replace(
                    /(?:<br>|<\/p>)?[\n\t\s]*linkt\s*-b:\s*(.*?)\[(.*?)\]/gms,
                    '<a href="$2" class="i-link i-block" target="_blank rel="noopener noreferrer><i class="fas fa-link"></i>$1</a>'
                )

                /** ファイル名 */
                mylang = mylang.replace(
                    /^fname:\s*(.*?)$/gms,
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
                    /^image:\s*(.*?)$/gmsu,
                    '<div class="imageWrap"><img src="../images/Articles/$1"></div>'
                );

                /** キー */
                mylang = mylang.replace(
                    /(?:<br>|<\/p>)?[\n\t\s]*key:\s*(.*?)(?:$|::::)/gmsu,
                    '<span class="key">$1</span>'
                );

                /** 暗記したい単語 */
                mylang = mylang.replace(
                    /(?:<br>|<\/p>)?[\n\t\s]*annki:\s*(.*?)(?:$|::::)/gmsu,
                    '<span class="annkiWord">$1</span>'
                );

                /** ディレクトリ */
                mylang = mylang.replace(/(?:<br>|<\/p>)?[\n\t\s]*dir:\s*(.*?)(?:$|::::)/gmsu, '<span class="i-dirPath"><i class="far fa-folder-open"></i>$1</span>');

                /** ファイル */
                mylang = mylang.replace(/(?:<br>|<\/p>)?[\n\t\s]*file:\s*(.*?)(?:$|::::)/gmsu, '<span class="i-filePath"><i class="far fa-file-alt"></i>$1</span>');

                /** ボタン */
                mylang = mylang.replace(
                    /(?:<br>|<\/p>)?[\n\t\s]*(?:button|pre):\s*(.*?)(?:$|::::)/gmsu,
                    '<span class="i-button"><span class="i-button-text">$1</span></span>'
                );

                /** デザインパターン用 - 抽象役 */
                mylang = mylang.replace(
                    /(?:<br>|<\/p>)?[\n\t\s]*role-abst:\s*(.*?)(?:$|::::)/gmsu,
                    '<span class="i-role -abstract"><i class="far fa-user"></i>$1</span>'
                );

                /** デザインパターン用 - 具象役 */
                mylang = mylang.replace(
                    /(?:<br>|<\/p>)?[\n\t\s]*(?:role-conc|role):\s*(.*?)(?:$|::::)/gmsu,
                    '<span class="i-role -concreate"><i class="fas fa-user"></i>$1</span>'
                );

                /** インラインコード */
                let incodeReg =
                    /(?:<br>|<\/p>)?[\n\t\s]*incode-(?<lang>\w+):\s*(?<incode>.*?)(?:$|::::)/gmsu;
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

                /** プログラムのソースではないデータファイル */
                let dataReg = /begin:\s*data-(?<type>\w+)[^\w](?<data>.*?)end:\s*data-(\w+)/gmsu;
                let dataMatch = mylang.match(dataReg);
                if (dataMatch !== null) {
                    dataMatch.forEach(function (data) {
                        let dataRegResult = dataReg.exec(mylang);
                        let type = dataRegResult.groups.type;
                        let plaindata = vm.escapeHTML(dataRegResult.groups.data);
                        mylang = mylang.replace(data, '<div class="switchSolaLight"><pre><code class="language-' + type + ' match-braces rainbow-braces">' + plaindata + '</code></pre></div>');
                    });
                }

                /** vimエディタ */
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
                                if (rows[i].match(/^out:\s*(.*?)$/gmsu) || rows[i].match(/^(?:)$/gmsu)) {
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

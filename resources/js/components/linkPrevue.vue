<template>
    <div class="linkPrevue">
        <div
            id="loader-container"
            v-if="!response && validUrl"
            :style="{ width: cardWidth }"
        >
            <slot name="loading">
                <div class="spinner"></div>
            </slot>
        </div>
        <a :href="url" @click="viewMore" class="url" target="_blank" rel="noopener noreferrer">
            外部記事へ
        </a>
        <div v-if="response" class="gridroot">
            <slot
                :img="response.image"
                :title="response.title"
                :description="response.description"
                :url="url"
            >
                <div class="wrapper">
                    <div class="card-img" v-if="response.image">
                        <img :src="response.image" />
                    </div>
                    <div class="card-info" v-if="response.title">
                        <div class="card-text">
                            <p class="title">{{ response.title }}</p>
                            <p class="description" v-is="response.description">
                                {{ response.description }}
                            </p>
                        </div>
                        <div class="card-btn">
                            <a
                                href="javascript:;"
                                v-if="showButton"
                                @click="viewMore"
                                >View More</a
                            >
                        </div>
                    </div>
                </div>
            </slot>
        </div>
    </div>
</template>

<script>
export default {
    name: "link-prevue",
    props: {
        url: {
            type: String,
            default: "",
        },
        cardWidth: {
            type: String,
            default: "400px",
        },
        onButtonClick: {
            type: Function,
            default: undefined,
        },
        showButton: {
            type: Boolean,
            default: true,
        },
        apiUrl: {
            type: String,
            default: "https://link-prevue-api-v2.herokuapp.com/preview/",
        },
    },
    watch: {
        url: function () {
            this.response = null;
            this.getLinkPreview();
        },
    },
    created() {
        this.getLinkPreview();
    },
    data: function () {
        return {
            response: null,
            validUrl: false,
        };
    },
    methods: {
        viewMore: function () {
            if (this.onButtonClick !== undefined) {
                this.onButtonClick(this.response);
            } else {
                const win = window.open(this.url, "_blank");
                win.focus();
            }
        },
        isValidUrl: function (url) {
            const regex =
                /https?:\/\/(www\.)?[-a-zA-Z0-9@:%._+~#=]{2,256}\.[a-z]{2,6}\b([-a-zA-Z0-9@:%_+.~#?&//=]*)/;
            this.validUrl = regex.test(url);
            return this.validUrl;
        },
        getLinkPreview: function () {
            if (this.isValidUrl(this.url)) {
                this.httpRequest(
                    (response) => {
                        this.response = JSON.parse(response);
                    },
                    () => {
                        this.response = null;
                        this.validUrl = false;
                    }
                );
            }
        },
        httpRequest: function (success, error) {
            const http = new XMLHttpRequest();
            const params = "url=" + this.url;
            http.open("POST", this.apiUrl, true);
            http.setRequestHeader(
                "Content-type",
                "application/x-www-form-urlencoded"
            );
            http.onreadystatechange = function () {
                if (http.readyState === 4 && http.status === 200) {
                    success(http.responseText);
                }
                if (http.readyState === 4 && http.status === 500) {
                    error();
                }
            };
            http.send(params);
        },
    },
};
</script>

<template>
    <div>
        <b-field label="タイトル">
            <b-input v-model="title"></b-input>
        </b-field>
        <b-field label="タグ">
            <b-taginput
                v-model="tags"
                ellipsis
                icon="label"
                placeholder="タグは1個以上必要です。"
                aria-close-label="タグを削除する"
            >
            </b-taginput>
        </b-field>
        <b-field label="文章">
            <quill-editor v-model="body" :options="editorOption"></quill-editor>
        </b-field>

        <div class="buttons mt-b">
            <b-button
                type="is-primary"
                expanded
                @click="post"
                v-bind:disabled="check"
                >投稿する</b-button
            >
        </div>
    </div>
</template>

<script>
export default {
    metaInfo: {
        title: "新規スレッド作成",
    },
    data() {
        return {
            title: "",
            tags: [],
            body: "",
            editorOption: {
                theme: "snow",
            },
        };
    },
    computed: {
        check: function () {
            if (
                this.title &&
                this.tags &&
                this.body &&
                this.title.length < 50 &&
                this.tags.length < 20 &&
                this.body.length < 100000
            ) {
                return false;
            } else {
                return true;
            }
        },
    },
    methods: {
        post: function () {
            let formData = new FormData();
            formData.append("title", this.title);
            formData.append("tags", this.tags);
            formData.append("body", this.body);

            axios
                .post("/api/board/create", formData)
                .then((res) => {
                    this.$router.push("/board/" + res.data);
                })
                .catch(function (error) {
                    // error 処理
                });
        },
    },
};
</script>

<style lang="scss">
.mt-b {
    margin-top: 50px;
}
</style>

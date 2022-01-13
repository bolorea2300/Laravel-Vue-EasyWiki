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

        <div class="buttons">
            <b-button type="is-primary" expanded>投稿する</b-button>
        </div>
    </div>
</template>

<script>
export default {
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
    methods: {},
};
</script>

<template>
    <div>
        <b-field label="タイトル">
            <b-input v-model="title"></b-input>
        </b-field>

        <b-field label="データ">
            <editor
                v-model="body"
                apiKey="w03d5wxkz7dklbo39jemag5iiobz8ogakz6sopj5zxrnvv4g"
                :initialValue="initialValue"
                :init="init"
            >
            </editor>
        </b-field>

        <div class="buttons">
            <b-button
                type="is-primary"
                expanded
                v-bind:disabled="check"
                @click="post"
                >投稿</b-button
            >
        </div>
    </div>
</template>

<script>
import Editor from "@tinymce/tinymce-vue";

export default {
    metaInfo: {
        title: "新規ページを作成",
    },
    components: {
        editor: Editor,
    },
    data() {
        return {
            apikey: "w03d5wxkz7dklbo39jemag5iiobz8ogakz6sopj5zxrnvv4g",
            initialValue: "",
            init: {
                height: 500,
                menubar: "insert",
                table_toolbar: [
                    "tableprops tabledelete | tableinsertrowbefore tableinsertrowafter tabledeleterow | tableinsertcolbefore tableinsertcolafter tabledeletecol",
                ],
                plugins: [
                    "print preview fullpage importcss searchreplace autolink \
        autosave save directionality visualblocks visualchars fullscreen image link media template codesample \
        table charmap hr pagebreak nonbreaking anchor toc insertdatetime advlist lists wordcount \
        imagetools textpattern noneditable help charmap quickbars  emoticons image",
                ],
                toolbar: [
                    "undo redo | formatselect | bold italic backcolor | \
        alignleft aligncenter alignright alignjustify | \
        bullist numlist outdent indent | removeformat | help table | image",
                ],
            },
            title: "",
            body: "",
            error: [],
        };
    },
    computed: {
        check: function () {
            if (!this.title && !this.body) {
                return true;
            } else {
                return false;
            }
        },
    },
    methods: {
        post: function () {
            let formData = new FormData();
            formData.append("title", this.title);
            formData.append("body", this.body);

            axios
                .post("/api/create", formData)
                .then((res) => {
                    this.$router.push("/" + res.data);
                })
                .catch((error) => {
                    this.error = Object.values(
                        error.response.data.errors
                    ).flat();
                });
        },
    },
};
</script>

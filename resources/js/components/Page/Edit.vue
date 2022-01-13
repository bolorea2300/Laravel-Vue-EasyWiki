<template>
    <div>
        <b-field label="タイトル">
            <b-input v-model="data.title"></b-input>
        </b-field>

        <b-field label="データ">
            <editor
                v-model="data.body"
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
    metaInfo() {
        const data = this.$route.params.id;
        return {
            title: data + "の編集",
        };
    },
    components: {
        editor: Editor,
    },
    data() {
        return {
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
            data: null,
        };
    },
    computed: {
        check: function () {
            if (!this.data.title && !this.data.body) {
                return true;
            } else {
                return false;
            }
        },
    },
    mounted() {
        axios.get("/api/view?id=" + this.$route.params.id).then((res) => {
            this.data = res.data;
        });
    },
    methods: {
        post: function () {
            let formData = new FormData();
            formData.append("id", this.data.id);
            formData.append("title", this.data.title);
            formData.append("body", this.data.body);

            axios
                .post("/api/update", formData)
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

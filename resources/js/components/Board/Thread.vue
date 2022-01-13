<template>
    <div>
        <div class="page mt-5" v-if="page">
            <h1 class="title">{{ page.title }}</h1>

            <div>
                <b-taglist>
                    <b-tag type="is-info" v-for="(list, id) in tags" :key="id"
                        ><router-link :to="'/tag/' + list" class="tagwhite">{{
                            list
                        }}</router-link></b-tag
                    >
                </b-taglist>
            </div>

            <div class="mt-2 ql-editor" v-html="page.body"></div>
        </div>
        <b-pagination :total="total" v-model="paginate" :per-page="100">
        </b-pagination>

        <div>
            <b-field label="コメント">
                <quill-editor
                    v-model="body"
                    :options="editorOption"
                ></quill-editor>
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
    </div>
</template>

<script>
export default {
    metaInfo: {
        title: "タイトル",
    },
    data() {
        return {
            page: null,
            tags: null,
            comment: "",
            comments: [],
            errors: [],
            file: [],
            paginate: 1,
            total: 0,

            body: "",
            editorOption: {
                theme: "snow",
            },
        };
    },
    created() {
        this.info();
    },
    methods: {
        info: function () {
            axios
                .get("/api/board/" + this.$route.params.id)
                .then((res) => {
                    this.page = res.data;
                    var tags = res.data.tags;
                    this.tags = tags.split(",");
                })
                .catch((error) => {
                    alert("エラーが発生しました。");
                    this.$router.push("/");
                });
        },
        post: function () {
            console.log("asa");
        },
    },
    computed: {
        check: function () {
            if (this.body && this.body.length < 100000) {
                return false;
            } else {
                return true;
            }
        },
    },
    watch: {},
};
</script>

<style lang="scss">
.page {
    .title {
        font-size: 32px;
    }
}

.mt-5 {
    margin-top: 50px;
}

.tagwhite {
    color: white;
}

.mt-b {
    margin-top: 50px;
}
</style>

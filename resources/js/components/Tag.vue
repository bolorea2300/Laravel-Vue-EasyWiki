<template>
    <div class="content">
        <h2>タグ:{{ $route.params.id }}を持つページ一覧</h2>
        <ul>
            <li v-for="(list, pageid) in data" :key="pageid">
                <router-link :to="'/board/' + list.title">{{
                    list.title
                }}</router-link>
            </li>
        </ul>
        <b-pagination :total="total" v-model="page" :per-page="20">
        </b-pagination>
    </div>
</template>

<script>
export default {
    data: () => ({
        data: [],
        total: 0,
        page: 1,
    }),
    created() {
        axios
            .get("/api/tag/" + this.$route.params.id)
            .then((res) => {
                this.data = res.data.list.data;
                this.total = res.data.count;
            })
            .catch((error) => {});
    },
    watch: {
        page: function (newVal) {
            axios
                .get("/api/tag/" + this.$route.params.id + "&page=" + newVal)
                .then((res) => {
                    this.data = res.data.list.data;
                    this.total = res.data.count;
                })
                .catch((error) => {
                    this.error = "ページを取得できませんでした";
                });
        },
    },
};
</script>

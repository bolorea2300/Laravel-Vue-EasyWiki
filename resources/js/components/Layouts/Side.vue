<template>
    <div>
        <div>
            <h1>新規ページ</h1>
            <ul>
                <li v-for="(list, id) in newdata" :key="id">
                    <router-link :to="'/' + list.title">{{
                        list.title
                    }}</router-link>
                </li>
            </ul>
        </div>
        <div>
            <h1>更新ページ</h1>
            <ul>
                <li v-for="(list, id) in up" :key="id">
                    <router-link :to="'/' + list.title">{{
                        list.title
                    }}</router-link>
                </li>
            </ul>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            newdata: [],
            up: [],
        };
    },
    mounted() {
        axios.get("/api/new").then((res) => {
            this.newdata = res.data;
        });
        axios.get("/api/up").then((res) => {
            this.up = res.data;
        });
    },
};
</script>

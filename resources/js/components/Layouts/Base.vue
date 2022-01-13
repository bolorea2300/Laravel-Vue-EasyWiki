<template>
    <div class="container">
        <pageheader></pageheader>

        <div class="columns is-mobile">
            <div class="column is-8"><router-view></router-view></div>
            <div class="column is-4">
                <side></side>
            </div>
        </div>
    </div>
</template>

<script>
import pageheader from "./Header";
import side from "./side";
export default {
    metaInfo: {
        titleTemplate: "%s | TJAwiki",
    },
    components: {
        pageheader,
        side,
    },
    mounted() {
        console.log("Component mounted.");
    },
};
</script>

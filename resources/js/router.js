import Vue from "vue";
import VueRouter from "vue-router";

Vue.use(VueRouter);

import index from "./components/index.vue";
import Create from "./components/Page/Create.vue";
import Edit from "./components/Page/Edit.vue";
import View from "./components/Page/View.vue";

const router = new VueRouter({
    mode: "history",
    routes: [
        {
            path: "/",
            name: "index",
            component: index,
        },
        {
            path: "/create",
            name: "Create",
            component: Create,
        },
        {
            path: "/edit/:id(.*)",
            name: "Edit",
            component: Edit,
        },
        {
            path: "/:id(.*)",
            name: "View",
            component: View,
        },
    ],
});

export default router;

require("./bootstrap");

window.Vue = require("vue");

import Vue from "vue";
import router from "./router";
import Buefy from "buefy";
import "buefy/dist/buefy.css";
import axios from "axios";
import VueMeta from "vue-meta";

Vue.component(
    "base-component",
    require("./components/Layouts/Base.vue").default
);

Vue.use(VueMeta);
Vue.use(Buefy);
window.axios = require("axios");

const app = new Vue({
    el: "#app",
    router: router,
});

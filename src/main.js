import { createApp } from "vue";
import App from "./App.vue";
import router from "./router";
import store from "./store";
import { register } from "swiper/element/bundle";

import "@/assets/scss/style.scss";

// swiper
import { register } from "swiper/element/bundle";

const app = createApp(App);
app.use(store);
app.use(router);
app.use(register);
app.mount("#app");

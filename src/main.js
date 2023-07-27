import { createApp } from "vue";
import App from "./App.vue";
import router from "./router";
import store from "./store";
// swiper
// import { register } from "swiper/element/bundle";
// 外部函式庫 view-ui-plus
import ViewUIPlus from "view-ui-plus";
import "view-ui-plus/dist/styles/viewuiplus.css";
// 全域的scss
import "@/assets/scss/style.scss";

const app = createApp(App);
app.use(store);
app.use(router);
app.use(ViewUIPlus);
// app.use(register);
app.mount("#app");

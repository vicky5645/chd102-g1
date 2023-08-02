import { createApp } from "vue";
import App from "./App.vue";
import router from "./router";
import store from "./store";
// swiper
// import { register } from "swiper/element/bundle";
// 外部函式庫
import ViewUIPlus from "view-ui-plus";
import firebase from './assets/config/firebase'
import "view-ui-plus/dist/styles/viewuiplus.css";
// 全域的scss
import "@/assets/scss/style.scss";

// 字體檔案
import "@/assets/font/custom-fonts.scss";

// 註冊全域組件
import Images from "@/components/Images.vue";

const app = createApp(App);
app.use(store);
app.use(router);
// 註冊第三方函式庫 
app.use(ViewUIPlus);
app.use(firebase)
// app.use(register)
app.component("Images", Images);
app.mount("#app");

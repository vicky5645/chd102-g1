import { createApp } from 'vue'
import App from './App.vue'
import router from './router'
import store from './store'

// 引入 scss資料夾所有樣式
import '@/assets/scss/style.scss';

// swiper
import { register } from 'swiper/element/bundle'

const app = createApp(App)
app.use(store)
app.use(router)
app.use(register)
app.mount('#app')

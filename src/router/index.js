import { createRouter, createWebHistory } from "vue-router";
import HomeView from "@/views/StartView.vue";
// import AboutView from '@/views/AboutView.vue'

const routesUser = [
  {
    path: "/",
    name: "home",
    component: HomeView,
    meta: {
      title: "前台首頁",
    },
  },
  {
    path: "/roaming-orbit",
    name: "roaming-orbit",
    // component: AboutView
    component: () =>
      import(/* webpackChunkName: "about" */ "@/views/HomeView.vue"),
    meta: {
      title: "home",
    },
  },
  {
    path: "/backend",
    name: "backend",
    // component: AboutView
    component: () =>
      import(/* webpackChunkName: "about" */ "@/views/BackEnd/BackIndex.vue"),
    meta: {
      title: "後台首頁",
    },
  },
  {
    path: "/about",
    name: "about",
    // component: AboutView
    component: () =>
      import(/* webpackChunkName: "about" */ "@/views/AboutView.vue"),
    meta: {
      title: "小火車介紹",
    },
  },
  {
    path: "/announcements",
    name: "announcements",
    // component: Announcements
    component: () =>
      import(/* webpackChunkName: "about" */ "@/views/Announcements.vue"),
    meta: {
      title: "公告",
    },
  },
  {
    path: "/Announcement-details",
    name: "Announcement-details",
    // component: Announcement-details
    component: () =>
      import(
        /* webpackChunkName: "about" */ "@/views/Announcement-details.vue"
      ),
    meta: {
      title: "公告內頁",
    },
  },
  {
    path: "/forum",
    name: "forum",
    // component: Forum
    component: () =>
      import(/* webpackChunkName: "forum" */ "@/views/Forum.vue"),
    meta: {
      title: "論壇",
    },
  },
  {
    path: "/online-mall",
    name: "online-mall",
    component: () => import(/* webpackChunkName: "online-mall" */ "@/views/Product/ProductView.vue"),
    meta: { title: '所有商品' }
  },
  {
    path: '/productDetail/:id',
    name: 'productDetail/:id',
    component: () => import(/* webpackChunkName: "about" */ '@/views/Product/ProductDetailView.vue'),
    meta: { title: '物品' }
  },
  {
    path: "/online-booking",
    name: "online-booking",
    component: () =>
      import(/* webpackChunkName: "online-booking" */ "@/views/Package.vue"),
    meta: {
      title: "線上訂票",
    },
  },
  {
    path: "/booking-info",
    name: "booking-info",
    component: () =>
      import(/* webpackChunkName: "online-booking" */ "@/views/DetailInfo.vue"),
    meta: {
      title: "訂票資訊",
    },
  },
  {
    path: "/cart",
    name: "cart",
    component: () => import(/* webpackChunkName: "cart" */ "@/views/Cart.vue"),
    meta: {
      title: "購物車",
    },
  },
  {
    path: "/login",
    name: "login",
    component: () =>
      import(/* webpackChunkName: "login" */ "@/views/LoginView.vue"),
  }
];

const router = createRouter({
  history: createWebHistory(process.env.BASE_URL),
  routes: routesUser,
});

export default router;

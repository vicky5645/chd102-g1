import { createRouter, createWebHistory } from "vue-router";
import HomeView from "@/views/HomeView.vue";
// import AboutView from '@/views/AboutView.vue'

const routesUser = [
  {
    path: "/",
    name: "home",
    component: HomeView,
    meta: {
<<<<<<< HEAD
      title: "首頁",
=======
      title: "home",
>>>>>>> ShengYu
    },
  },
  {
    path: "/about",
    name: "about",
    // component: AboutView
    component: () =>
      import(/* webpackChunkName: "about" */ "@/views/AboutView.vue"),
<<<<<<< HEAD
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
=======
  },
  {
>>>>>>> ShengYu
    path: "/product-details",
    name: "product-details",
    // component: ProductDetails
    component: () =>
      import(
        /* webpackChunkName: "product-details" */ "@/views/ProductDetails.vue"
      ),
<<<<<<< HEAD
    meta: { title: " " },
=======
>>>>>>> ShengYu
  },
  {
    path: "/online-mall",
    name: "online-mall",
    // component: OnlineMall
    component: () =>
      import(/* webpackChunkName: "online-mal" */ "@/views/OnlineMall.vue"),
  },
  {
<<<<<<< HEAD
    path: "/css",
    name: "css",
    component: () => import(/* webpackChunkName: "css" */ "@/views/css.vue"),
  },
  {
    path: "/cart",
    name: "cart",
    component: () => import(/* webpackChunkName: "login" */ "@/views/Cart.vue"),
    meta: {
      title: "購物車",
    },
  },
  {
=======
>>>>>>> ShengYu
    path: "/login",
    name: "login",
    component: () =>
      import(/* webpackChunkName: "login" */ "@/views/LoginView.vue"),
  },
<<<<<<< HEAD
=======

  {
    path: "/package",
    name: "package",
    component: () =>
      import(/* webpackChunkName: "login" */ "@/views/Package.vue"),
  },
>>>>>>> ShengYu
];

const router = createRouter({
  history: createWebHistory(process.env.BASE_URL),
  routes: routesUser,
});

export default router;

import { createRouter, createWebHistory } from "vue-router";
import HomeView from "@/views/HomeView.vue";
// import AboutView from '@/views/AboutView.vue'

const routesUser = [
  {
    path: "/",
    name: "home",
    component: HomeView,
    meta: {
      title: "home",
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
  },
  {
    path: '/user',
    component: () => import(/* webpackChunkName: "" */ '@/views/User/UserIndex.vue'),
    children: [
      {
        path: '',
        component: () => import(/* webpackChunkName: "" */ '@/views/User/UserLink.vue'),
      },
      {
        path: '/user/info',
        component: () => import(/* webpackChunkName: "" */ '@/views/User/UserInfo.vue'),
      },
      {
        path: '/user/order',
        component: () => import(/* webpackChunkName: "" */ '@/views/User/UserOrder.vue'),
      }
    ]
  },
];

const router = createRouter({
  history: createWebHistory(process.env.BASE_URL),
  routes: routesUser,
});

export default router;

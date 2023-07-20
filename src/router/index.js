import { createRouter, createWebHistory } from "vue-router";
import HomeView from "@/views/HomeView.vue";
import SpecialPage from '@/views/StartView.vue';

const routesUser = [
  {
    path: "/roaming-orbit",
    name: "roaming-orbit",
    component: HomeView,
    meta: {
      title: "home",
    },
  },
  {
    path: "/",
    name: "start",
    component: SpecialPage,
    meta: {
      title: "登入頁面",
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
    path: "/announcements2",
    name: "announcements2",
    // component: Announcements
    component: () =>
      import(/* webpackChunkName: "about" */ "@/views/Announcement/Announcements2.vue"),
    meta: {
      title: "公告2",
    },
  },
  // {
  //   path: '/announcement-details2/:id',
  //   name: 'announcement-details2/:id',
  //   component: () => import(/* webpackChunkName: "" */ '@/views/Announcement/Announcement-details.vue'),
  //   meta: { title: '公告內頁2' }
  // },
  {
    path: "/announcements",
    name: "announcements",
    // component: Announcements
    component: () =>
      import(/* webpackChunkName: "" */ "@/views/Announcements.vue"),
    meta: {
      title: "公告",
    },
  },
  {
    path: "/announcement-details",
    name: "announcement-details",
    // component: Announcement-details
    component: () =>
      import(
        /* webpackChunkName: "" */ "@/views/Announcement-details.vue"
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
    component: () => import(/* webpackChunkName: "" */ '@/views/Product/ProductDetailView.vue'),
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
      },
      {
        path: '/user/forum',
        component: () => import(/* webpackChunkName: "" */ '@/views/User/UserForum.vue'),
      },
      {
        path: '/user/like',
        component: () => import(/* webpackChunkName: "" */ '@/views/User/UserLike.vue'),
      }
    ]
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
    children: [
      {
        path: '/backend/package',
        component: () => import(/* webpackChunkName: "" */ '@/views/BackEnd/BackPackage.vue'),
        meta: { title: '行程' }
      },
      {
        path: '/backend/organize',
        component: () => import(/* webpackChunkName: "" */ '@/views/BackEnd/BackOrganize.vue'),
        meta: { title: '開團' }
      },
    ]
  },
];

const router = createRouter({
  history: createWebHistory(process.env.BASE_URL),
  routes: routesUser,
});

export default router;
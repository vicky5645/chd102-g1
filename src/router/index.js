import { createRouter, createWebHistory } from "vue-router";
import HomeView from "@/views/HomeView.vue";
import SpecialPage from "@/views/StartView.vue";

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
    path: "/Attractions",
    name: "Attractions",
    // component: Attractions
    component: () =>
      import(/* webpackChunkName: "Attractions" */ "@/views/Attractions.vue"),
    meta: {
      title: "景點介紹",
    },
  },
  {
    path: "/announcements",
    name: "announcements",
    // component: Announcements
    component: () =>
      import(
        /* webpackChunkName: "about" */ "@/views/Announcement/Announcements.vue"
      ),
    meta: {
      title: "公告2",
    },
  },
  {
    path: "/announcement-details/:id",
    name: "announcement-details",
    component: () =>
      import(
        /* webpackChunkName: "" */ "@/views/Announcement/Announcement-details.vue"
      ),
    meta: { title: "公告內頁2" },
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
    component: () =>
      import(
        /* webpackChunkName: "online-mall" */ "@/views/Product/ProductView.vue"
      ),
    meta: { title: "所有商品" },
  },
  {
    path: "/productDetail/:id",
    name: "productDetail",
    component: () =>
      import(
        /* webpackChunkName: "about" */ "@/views/Product/ProductDetailView.vue"
      ),
    meta: { title: "物品" },
  },
  {
    path: "/online-booking",
    name: "online-booking",
    component: () =>
      import(/* webpackChunkName: "online-booking" */ "@/views/Booking/Package.vue"),
    meta: {
      title: "線上訂票",
    },
  },
  {
    path: "/booking-info/:id",
    name: "booking-info",
    component: () =>
      import(/* webpackChunkName: "online-booking" */ "@/views/Booking/DetailInfo.vue"),
    meta: {
      title: "訂票資訊",
    },
  },
  {
    path: "/select-info",
    name: "select-info",
    component: () =>
      import(/* webpackChunkName: "online-booking" */ "@/views/SelectSeat.vue"),
    meta: {
      title: "一般訂票",
    },
  },
  {
    path: "/custom-tickets",
    name: "custom-tickets",
    component: () =>
      import(/* webpackChunkName: "online-booking" */ "@/views/CustomTickets.vue"),
    meta: {
      title: "客制車票",
    },
  },
  {
    path: "/cart",
    name: "cart",
    component: () =>
      import(/* webpackChunkName: "cart" */ "@/views/Cart/Cart.vue"),
    meta: {
      title: "購物車",
    },
  },
  {
    path: "/checkout",
    name: "checkout",
    component: () =>
      import(/* webpackChunkName: "CheckOut" */ "@/views/Cart/CheckOut.vue"),
      meta: {
        title: "結帳資訊",
      },
  },
  {
    path: "/login",
    name: "login",
    component: () =>
      import(/* webpackChunkName: "" */ "@/views/LogIn/Index.vue"),
    children: [
      {
        path: "/login/LoginView",
        component: () =>
          import(/* webpackChunkName: "" */ "@/views/LogIn/LoginView.vue"),
      },
      {
        path: "/login",
        component: () =>
          import(/* webpackChunkName: "" */ "@/views/LogIn/Log.vue"),
      },
    

    ],
  },
  {
    path: "/user",
    component: () =>
      import(/* webpackChunkName: "" */ "@/views/User/UserIndex.vue"),
    children: [
      {
        path: "",
        name: "userinfo",
        component: () =>
          import(/* webpackChunkName: "" */ "@/views/User/UserInfo.vue"),
      },
      {
        path: "/user/order",
        name: "userorder",
        component: () =>
          import(/* webpackChunkName: "" */ "@/views/User/UserOrder.vue"),
      },
      {
        path: "/user/forum",
        name: "userforum",
        component: () =>
          import(/* webpackChunkName: "" */ "@/views/User/UserForum.vue"),
      },
      {
        path: "/user/like",
        name: "userlike",
        component: () =>
          import(/* webpackChunkName: "" */ "@/views/User/UserLike.vue"),
      },
    ],
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
        path: "/backend/package",
        name: "package",
        component: () =>
          import(/* webpackChunkName: "" */ "@/views/BackEnd/BackPackage.vue"),
        meta: { title: "行程管理" },
      },
      {
        path: "/backend/organize",
        name: "organize",
        component: () =>
          import(/* webpackChunkName: "" */ "@/views/BackEnd/BackOrganize.vue"),
        meta: { title: "開團管理" },
      },
      {
        path: "/backend/bootstrap",
        component: () =>
          import(
            /* webpackChunkName: "cart" */ "@/views/BackEnd/Bootstrap.vue"
          ),
        meta: {
          title: "bootstrap test",
        },
      },
      {
        path: "/backend/BackForum",
        component: () =>
          import(
            /* webpackChunkName: "cart" */ "@/views/BackEnd/BackForum.vue"
          ),
        name: "BackForum",
        meta: {
          title: "論壇文章管理",
        },
      },
      {
        path: "/backend/BackForumMessage",
        component: () =>
          import(
            /* webpackChunkName: "cart" */ "@/views/BackEnd/BackForumMessage.vue"
          ),
        name: "BackForumMessage",
        meta: {
          title: "論壇文章留言管理",
        },
      },
      {
        path: "/backend/BackForumReport",
        component: () =>
          import(
            /* webpackChunkName: "cart" */ "@/views/BackEnd/BackForumReport.vue"
          ),
        name: "BackForumReport",
        meta: {
          title: "論壇文章檢舉管理",
        },
      },
      {
        path: "/backend/BackAnnouncements",
        component: () =>
          import(
            /* webpackChunkName: "cart" */ "@/views/BackEnd/BackAnnouncements.vue"
          ),
        name: "BackAnnouncements",
        meta: {
          title: "公告",
        },
      },
    ],
  },
];

const router = createRouter({
  history: createWebHistory(process.env.BASE_URL),
  routes: routesUser,
});

export default router;

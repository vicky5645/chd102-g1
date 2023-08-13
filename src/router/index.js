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
      title: "介紹",
    },
  },
  {
    path: "/train-intro",
    name: "train-intro",
    // component: AboutView
    component: () =>
      import(/* webpackChunkName: "" */ "@/views/TrainIntro.vue"),
    meta: {
      title: "小火車介紹",
    },
  },
  {
    path: "/itinerary-intro",
    name: "itinerary-intro",
    // component: AboutView
    component: () =>
      import(/* webpackChunkName: "" */ "@/views/ItineraryIntro.vue"),
    meta: {
      title: "行程介紹",
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
      import(
        /* webpackChunkName: "online-booking" */ "@/views/Booking/Package.vue"
      ),
    meta: {
      title: "線上訂票",
    },
  },
  {
    path: "/booking-info/:id",
    name: "booking-info",
    component: () =>
      import(
        /* webpackChunkName: "online-booking" */ "@/views/Booking/DetailInfo.vue"
      ),
    meta: {
      title: "訂票資訊",
    },
  },
  {
    path: "/select-info/:id",
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
      import(
        /* webpackChunkName: "online-booking" */ "@/views/CustomTickets.vue"
      ),
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
    path: "/payment",
    name: "payment",
    component: () =>
      import(/* webpackChunkName: "CheckOut" */ "@/views/Cart/Payment.vue"),
    meta: {
      title: "信用卡付款畫面",
    },
  },
  {
    path: "/payment2",
    name: "payment2",
    component: () =>
      import(/* webpackChunkName: "CheckOut" */ "@/views/Cart/Payment2.vue"),
    meta: {
      title: "信用卡付款畫面",
    },
  },
  {
    path: "/login",
    name: "login",
    component: () =>
      import(/* webpackChunkName: "" */ "@/views/LogIn/Index.vue"),
    children: [
      {
        path: "/login",
        component: () =>
          import(/* webpackChunkName: "" */ "@/views/LogIn/Log.vue"),
        meta: {
          title: "會員登入",
        },
      },
    ],
  },
  {
    path: "/user",
    name: "user",
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
        path: "order",
        name: "userorder",
        component: () =>
          import(/* webpackChunkName: "" */ "@/views/User/UserOrder.vue"),
      },
      {
        path: "forum",
        name: "userforum",
        component: () =>
          import(/* webpackChunkName: "" */ "@/views/User/UserForum.vue"),
      },
      {
        path: "like",
        name: "userlike",
        component: () =>
          import(/* webpackChunkName: "" */ "@/views/User/UserLike.vue"),
      },
    ],
  },
  {
    path: "/backend/login",
    name: "backendlogin",
    component: () =>
      import(/* webpackChunkName: "cart" */ "@/views/BackEnd/BackLogin.vue"),
    meta: {
      title: "後臺登入",
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
    children: [
      {
        path: "package",
        name: "package",
        component: () =>
          import(/* webpackChunkName: "" */ "@/views/BackEnd/BackPackage.vue"),
        meta: { title: "行程管理" },
      },
      {
        path: "organize",
        name: "organize",
        component: () =>
          import(/* webpackChunkName: "" */ "@/views/BackEnd/BackOrganize.vue"),
        meta: { title: "開團管理" },
      },
      {
        path: "BackForum",
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
        path: "BackForumMessage",
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
        path: "BackForumReport",
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
        path: "BackAnnouncements",
        component: () =>
          import(
            /* webpackChunkName: "cart" */ "@/views/BackEnd/BackAnnouncements.vue"
          ),
        name: "BackAnnouncements",
        meta: {
          title: "公告",
        },
      },
      {
        path: "BackCmsStaff",
        component: () =>
          import(
            /* webpackChunkName: "cart" */ "@/views/BackEnd/BackCmsStaff.vue"
          ),
        name: "BackCmsStaff",
        meta: {
          title: "管理員帳號",
        },
      },
      {
        path: "BackMember",
        component: () =>
          import(
            /* webpackChunkName: "cart" */ "@/views/BackEnd/BackMember.vue"
          ),
        name: "BackMember",
        meta: {
          title: "會員",
        },
      },
      {
        path: "BackPackageOrder",
        component: () =>
          import(
            /* webpackChunkName: "cart" */ "@/views/BackEnd/BackPackageOrder.vue"
          ),
        name: "BackPackageOrder",
        meta: {
          title: "開團訂單",
        },
      },
      {
        path: "BackPattern",
        component: () =>
          import(
            /* webpackChunkName: "cart" */ "@/views/BackEnd/BackPattern.vue"
          ),
        name: "BackPattern",
        meta: {
          title: "客製車票圖案",
        },
      },
      {
        path: "BackPackageTrace",
        component: () =>
          import(
            /* webpackChunkName: "cart" */ "@/views/BackEnd/BackPackageTrace.vue"
          ),
        name: "BackPackageTrace",
        meta: {
          title: "行程收藏",
        },
      },
      {
        path: "BackSpot",
        component: () =>
          import(/* webpackChunkName: "cart" */ "@/views/BackEnd/BackSpot.vue"),
        name: "BackSpot",
        meta: {
          title: "景點",
        },
      },
      {
        path: "BackPackagePass",
        component: () =>
          import(
            /* webpackChunkName: "cart" */ "@/views/BackEnd/BackPackagePass.vue"
          ),
        name: "BackPackagePass",
        meta: {
          title: "行程景點",
        },
      },
      {
        path: "BackSeat",
        component: () =>
          import(/* webpackChunkName: "cart" */ "@/views/BackEnd/BackSeat.vue"),
        name: "BackSeat",
        meta: {
          title: "開團座位",
        },
      },
      {
        path: "BackTrain",
        component: () =>
          import(
            /* webpackChunkName: "cart" */ "@/views/BackEnd/BackTrain.vue"
          ),
        name: "BackTrain",
        meta: {
          title: "列車",
        },
      },
      {
        path: "BackProduct",
        component: () =>
          import(
            /* webpackChunkName: "cart" */ "@/views/BackEnd/BackProduct.vue"
          ),
        name: "BackProduct",
        meta: {
          title: "商品",
        },
      },
      {
        path: "BackOrder",
        component: () =>
          import(
            /* webpackChunkName: "cart" */ "@/views/BackEnd/BackOrder.vue"
          ),
        name: "BackOrder",
        meta: {
          title: "商品訂單",
        },
      },
      {
        path: "BackOrderItem",
        component: () =>
          import(
            /* webpackChunkName: "cart" */ "@/views/BackEnd/BackOrderItem.vue"
          ),
        name: "BackOrderItem",
        meta: {
          title: "商品訂單項目",
        },
      },
      {
        path: "BackProdTrace",
        component: () =>
          import(
            /* webpackChunkName: "cart" */ "@/views/BackEnd/BackProdTrace.vue"
          ),
        name: "BackProdTrace",
        meta: {
          title: "商品收藏",
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

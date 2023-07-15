import { createRouter, createWebHistory } from 'vue-router'
import HomeView from '@/views/HomeView.vue'
// import AboutView from '@/views/AboutView.vue'

const routesUser = [
  {
    path: '/',
    name: 'home',
    component: HomeView,
    meta: {
      title: '首頁'
    }
  },
  {
    path: '/about',
    name: 'about',
    // component: AboutView
    component: () => import(/* webpackChunkName: "about" */ '@/views/AboutView.vue'),
    meta: {
      title: '小火車介紹'
    }
  },
  {
    path: '/announcements',
    name: 'announcements',
    // component: Announcements
    component: () => import(/* webpackChunkName: "about" */ '@/views/Announcements.vue'),
    meta: {
      title: '公告'
    }
  },
  {
    path: '/forum',
    name: 'forum',
    // component: Forum
    component: () => import(/* webpackChunkName: "forum" */ '@/views/Forum.vue'),
    meta: {
      title: '論壇'
    }
  },
  {
    path: '/product-details',
    name: 'product-details',
    // component: ProductDetails
    component: () => import(/* webpackChunkName: "product-details" */ '@/views/ProductDetails.vue'),
    meta: { title: ' ' }
  },
  {
    path: '/online-mall',
    name: 'online-mall',
    // component: OnlineMall
    component: () => import(/* webpackChunkName: "online-mal" */ '@/views/OnlineMall.vue')
  },
  {
    path: '/css',
    name: 'css',
    component: () => import(/* webpackChunkName: "css" */ '@/views/css.vue')
  }, 
  {
    path: '/login',
    name: 'login',
    component: () => import(/* webpackChunkName: "login" */ '@/views/LoginView.vue')
  }
]

const router = createRouter({
  history: createWebHistory(process.env.BASE_URL),
  routes: routesUser
})

export default router

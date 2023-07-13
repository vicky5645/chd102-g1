import { createRouter, createWebHistory } from 'vue-router'
import HomeView from '@/views/HomeView.vue'
// import AboutView from '@/views/AboutView.vue'

const routesUser = [
  {
    path: '/',
    name: 'home',
    component: HomeView,
    meta: {
      title: 'home'
    }
  },
  {
    path: '/about',
    name: 'about',
    // component: AboutView
    component: () => import(/* webpackChunkName: "about" */ '@/views/AboutView.vue')
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

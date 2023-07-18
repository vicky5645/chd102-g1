<template>
  <header>
    <nav>
      <router-link to="/">
        <div class="logo">
          <img src="~@/assets/LOGO.svg" alt="logo" />
        </div>
        <!-- 漫遊列車之旅 -->
      </router-link>
      <div class="nav_item">
        <router-link to="/about">小火車介紹</router-link>
        <router-link to="/announcements">公告</router-link>
        <router-link to="/Announcement-details">公告內頁</router-link>

        <router-link to="/forum">論壇</router-link>
        <router-link to="/online-mall">線上商城</router-link>
        <router-link to="/online-booking">線上訂票</router-link>
        <router-link to="/booking-info">訂票資訊</router-link>
        <router-link to="/user">會員專區
          <!-- <img class="custom-svg" src="@/assets/images/icon/basic/member-login.png" alt="list-icon">
          <img class="custom-svg" src="@/assets/images/icon/menu/close_big.png" alt="list-icon"> -->
        </router-link>
      </div>
      <router-link to="/cart" class="chrt"><i class="fa fa-shopping-cart" aria-hidden="true"></i></router-link>
      <router-link to="/login" class="login">{{ $store.state.name }}</router-link>
      <div class="ham" @click="openSidebar = true">open</div>
    </nav>
  </header>
  <MainSidebar :sidebarOpen="openSidebar" @close="menuclose">
    <template v-slot:slotheader>
      <h1>title1</h1>
    </template>
    <template v-slot:slotfooter>
      <h1>佛祖保佑我</h1>
    </template>
  </MainSidebar>
</template>

<style scoped lang="scss"></style>

<script>
import MainSidebar from '@/components/MainSidebar.vue'
export default {
  components: {
    MainSidebar,
  },
  data() {
    return {
      openSidebar: false
    }
  },
  methods: {
    menuclose() {
      console.log('父層close');
      this.openSidebar = false
    }
  }
}
</script>

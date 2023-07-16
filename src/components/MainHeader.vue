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
        <router-link to="/product-details">商品內頁</router-link>
        <router-link to="/product">商品</router-link>
        <router-link to="/online-booking">線上訂票</router-link>
        <router-link to="/user">會員專區</router-link> 
      </div>
      <router-link to="/cart" class="chrt"
        ><i class="fa fa-shopping-cart" aria-hidden="true"></i
      ></router-link>
      <router-link to="/login" class="login">{{ $store.state.name }}</router-link>
      <!-- <div class="ham" @click="openSidebar = true">open</div> -->
    </nav>
  </header>
</template>

<style scoped lang="scss"></style>

<script>
export default {
  data() {
    return {
    }
  },
}
</script>
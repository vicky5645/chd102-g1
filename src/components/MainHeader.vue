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
        <router-link to="/forum">論壇</router-link>
        <router-link to="/online-mall">線上商城</router-link>
        <router-link to="/online-booking">線上訂票</router-link>
        <!-- <router-link to="/css">元件樣式</router-link> | -->
        <a href="#" class="chrt"><i class="fa fa-shopping-cart" aria-hidden="true"></i></a>
        <router-link to="/login">登入/註冊</router-link>
      </div>
    </nav>
    <!-- <div class="ham"></div> -->
  </header>
</template>

<style scoped lang="scss">
</style>

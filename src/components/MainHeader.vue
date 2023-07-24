<template>
  <CartFloat
    :cartStatus="cartStatus"
    @closeCart="cartStatus = false"
    @goCartInfo="goCartInfo"
  />
  <header>
    <nav>
      <router-link to="/roaming-orbit">
        <div class="logo">
          <img src="~@/assets/logo.svg" alt="logo" />
        </div>
        <!-- 漫遊列車之旅 -->
      </router-link>
      <div class="nav_item">
        <router-link to="/about">小火車介紹</router-link>
        <router-link to="/announcements">公告</router-link>
        <router-link to="/forum">論壇</router-link>
        <router-link to="/online-mall">線上商城</router-link>
        <router-link to="/online-booking">線上訂票</router-link>
        <router-link to="/booking-info">訂票資訊</router-link>
        <router-link to="/online-booking2">線上訂票2</router-link>
        <router-link to="/Attractions">景點介紹</router-link>
        <router-link to="/custom-tickets">客制車票</router-link>
        <router-link to="/select-info">一般訂票</router-link>
        <!-- <router-link to="/user">
          <div class="icon-24">
            <img
              class="custom-svg"
              src="@/assets/images/icon/basic/member-login.svg"
              alt="list-icon"
            />
          </div>
          <span>會員專區</span>
        </router-link> -->
        <router-link to="/">開始</router-link>
        <router-link to="/backend">後台</router-link>
      </div>
      <div class="chrt" @click="toggleCart">
        <i class="fa fa-shopping-cart" aria-hidden="true"></i>
      </div>
      <router-link to="/login" class="login">{{
        $store.state.name
      }}</router-link>
      <div
        id="menu-switch"
        class="ham"
        :class="{ active: openSidebar }"
        @click="toggleSidebar"
      >
        <span></span>
        <span></span>
        <span></span>
      </div>
      <!-- <MainSidebar v-if="openSidebar" :sidebarOpen="openSidebar" @close="menuclose"> -->
      <MainSidebar :sidebarOpen="openSidebar" @close="menuclose">
        <template v-slot:slotheader>
          <div class="link-list">
            <router-link to="/about">
              <li>小火車介紹</li>
            </router-link>
            <router-link to="/announcements">
              <li>公告</li>
            </router-link>
            <router-link to="/forum">
              <li>論壇</li>
            </router-link>
            <router-link to="/online-mall">
              <li>線上商城</li>
            </router-link>
            <router-link to="/online-booking">
              <li>線上訂票</li>
            </router-link>
            <router-link to="/">開始</router-link>
            <router-link to="/backend">後台</router-link>
          </div>
        </template>
        <template v-slot:slotfooter>
          <!-- <div class="link-list">
            <router-link to="/user/info">
              <li>
                <div class="icon-24">
                  <img class="custom-svg" src="@/assets/images/icon/basic/member-login.svg" alt="list-icon">
                </div>
                <span>麥大名</span>
                <img class="custom-svg" src="@/assets/images/icon/basic/settings.svg" alt="settings-icon">
              </li>
            </router-link>
            <router-link to="/user/order">
              <li>
                <img class="custom-svg" src="@/assets/images/icon/basic/list.svg" alt="list-icon">
                <span>訂單管理</span>
              </li>
            </router-link>
            <router-link to="/user/forum">
              <li>
                <img class="custom-svg" src="@/assets/images/icon/basic/message_writing.svg" alt="message_writing">
                <span>論壇訊息</span>
              </li>
            </router-link>
            <router-link to="/user/like">
              <li>
                <div class="icon-24">
                  <i class="fa-solid fa-heart"></i>
                </div>
                <span>我的收藏</span>
              </li>
            </router-link>
            <router-link to="/cart" class="chrt">
              <li>
                <div class="icon-24">
                  <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                </div>
                <span>購物車</span>
              </li>
            </router-link>
            <router-link to="/login" class="login">
              <li>
                {{ $store.state.name }}
              </li>
            </router-link>
          </div> -->
        </template>
      </MainSidebar>
    </nav>
  </header>
</template>

<style scoped lang="scss"></style>

<script>
import MainSidebar from "@/components/MainSidebar.vue";
import CartFloat from "@/components/CartFloat.vue";
export default {
  components: {
    MainSidebar,
    CartFloat,
  },
  data() {
    return {
      openSidebar: false,
      cartStatus: false,
    };
  },
  methods: {
    toggleSidebar() {
      this.openSidebar = !this.openSidebar;
    },
    menuclose() {
      console.log("父層close");
      this.openSidebar = false;
    },
    toggleCart() {
      this.cartStatus = !this.cartStatus;
    },
    goCartInfo() {
      this.cartStatus = false;
      this.$router.push({ path: "/cart" });
    },
  },
};
</script>

<style lang="scss" scoped></style>

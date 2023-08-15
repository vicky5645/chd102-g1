<template>
  <CartFloat
    :cartStatus="cartStatus"
    @closeCart="cartStatus = false"
    @goCartInfo="goCartInfo"
    @goShoppingMall="goShoppingMall"
  />
  <UserFloat
    :userStatus="userStatus"
    @closeUser="userStatus = false"
    @goLoginUser="goLoginUser"
  />
  <header>
    <nav>
      <router-link to="/roaming-orbit">
        <div class="logo">
          <img src="~@/assets/logo.svg" alt="logo" />
        </div>
        <!-- 漫遊列車之旅 -->
      </router-link>
      <div class="nav_item h4">
        <router-link to="/about">介紹</router-link>
        <router-link to="/announcements">公告</router-link>
        <router-link to="/forum">論壇</router-link>
        <router-link to="/online-mall">線上商城</router-link>
        <router-link to="/online-booking">線上訂票</router-link>
        <!-- <router-link to="/Attractions">景點介紹</router-link> -->
      </div>
      <!-- 檢查使用者的登錄狀態 -->
      <!-- <div
        style="
          position: fixed;
          top: 0;
          left: 0;
          background-color: gold;
          width: 800px;
          z-index: 999;
        "
      >
        <p>{{ `this.existUser::${this.existUser}` }}</p>
        <p>
          {{ `isRegistered:${isRegistered}` }}
        </p>
        {{ this.existUser }}
      </div> -->
      <!-- 購物車 -->
      <div class="chrt h4" @click="toggleCart">
        <i class="fa fa-shopping-cart" aria-hidden="true"></i>
      </div>
      <!-- 登入 -->
      <template v-if="isLogin">
        <div class="login h4" @click="toggleUser">
          <div class="icon-24">
            <i class="fa-solid fa-user"></i>
          </div>
        </div>
      </template>
      <!-- 未登入 -->
      <template v-else>
        <router-link to="/login" class="login h4">
          登入/註冊
          <!-- {{this.$store.state.name}} -->
          <!-- <div class="icon-24">
            <i class="fa-solid fa-user"></i>
          </div> -->
        </router-link>
      </template>
      <!-- 自適應側邊攔區塊 -->
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
      <MainSidebar :sidebarOpen="openSidebar">
        <template v-slot:slotheader>
          <div class="link-list h4">
            <router-link to="/about">
              <li>介紹</li>
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
          </div>
        </template>
        <template v-slot:slotfooter>
          <div class="link-list"></div>
        </template>
      </MainSidebar>
      <div
        class="pageMask"
        @click="menuclose"
        :class="{ active: openSidebar }"
      ></div>
    </nav>
  </header>
</template>

<style scoped lang="scss">
.login .icon-24 {
  width: 40px;
  height: 40px;
}
</style>

<script>
import MainSidebar from "@/components/MainSidebar.vue";
import CartFloat from "@/components/CartFloat.vue";
import UserFloat from "@/components/UserFloat.vue";
// 檢查使用者的登錄狀態
import authMixin from "@/assets/js/authMixin.js";
export default {
  mixins: [authMixin], // 引入 mixin 登錄狀態
  components: {
    MainSidebar,
    CartFloat,
    UserFloat,
  },
  data() {
    return {
      openSidebar: false,
      cartStatus: false,
      userStatus: false,
    };
  },
  computed: {
    isLogin() {
      return this.$store.state.isLogin;
    },
  },
  methods: {
    toggleSidebar() {
      this.openSidebar = !this.openSidebar;
    },
    menuclose() {
      console.log("父層close");
      this.openSidebar = false;
    },
    // 購物車選單
    toggleCart() {
      this.cartStatus = !this.cartStatus;
    },
    goCartInfo() {
      this.cartStatus = false;
      this.$router.push({ path: "/cart" });
    },
    goShoppingMall() {
      this.cartStatus = false;
      this.$router.push({ path: "/online-mall" });
    },
    // 會員專區選單
    toggleUser() {
      this.userStatus = !this.userStatus;
    },
    goLoginUser() {
      this.userStatus = false;
      this.$router.push({ path: "/user" });
    },
  },
};
</script>

<style lang="scss" scoped>
.pageMask {
  position: absolute;
  left: 0;
  top: 0;
  transition: background-color 0.5s;
  background-color: rgba(black, 0);
  &.active {
    width: 100vw;
    height: 100vh;
    background-color: rgba(black, 0.5);
  }
}
</style>

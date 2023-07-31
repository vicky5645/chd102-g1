<template>
  <CartFloat :cartStatus="cartStatus" @closeCart="cartStatus = false" @goCartInfo="goCartInfo" />
  <UserFloat :userStatus="userStatus" @closeUser="userStatus = false" @goLoginUser="goLoginUser" />
  <header>
    <nav>
      <h1>kkkk</h1>
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
      <!-- 購物車 -->
      <div class="chrt h4" @click="toggleCart">
        <i class="fa fa-shopping-cart" aria-hidden="true"></i>
      </div>
      <!-- 登入後顯示 -->
      <template v-if="isLogin">
        <div class="login h4" @click="toggleUser">
          <div class="icon-24">
            <i class="fa-solid fa-user"></i>
          </div>
        </div>
      </template>
      <!-- 登出後顯示 -->
      <template v-else>
        <router-link to="/login" class="login h4">
          <div class="icon-24">
            <i class="fa-solid fa-user"></i>
          </div>
        </router-link>
      </template>
      <!-- 自適應側邊攔區塊 -->
      <div id="menu-switch" class="ham" :class="{ active: openSidebar }" @click="toggleSidebar">
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
          <div class="link-list">
          </div>
        </template>
      </MainSidebar>
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
export default {
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
    // menuclose() {
    //   console.log("父層close");
    //   this.openSidebar = false;
    // },
    // 購物車選單
    toggleCart() {
      this.cartStatus = !this.cartStatus;
    },
    goCartInfo() {
      this.cartStatus = false;
      this.$router.push({ path: "/cart" });
    },
    // 會員專區選單
    toggleUser() {
      this.userStatus = !this.userStatus;
    },
    goLoginUser() {
      this.userStatus = false;
      this.$router.push({ path: "/user" });
    },
    signOut() {
      // 登出
      this.$store.commit("setName", "登入/註冊");
      this.$store.commit("setIsLogin", false); // 使用 commit 來改變狀態
      this.$router.push("/roaming-orbit");
    },
  },
  mounted() {
    svg_icon(".custom-svg", "currentColor");
  },
};
</script>

<style lang="scss" scoped></style>

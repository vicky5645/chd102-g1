<template>
  <CartFloat :cartStatus="cartStatus" @closeCart="cartStatus = false" @goCartInfo="goCartInfo" />
  <UserFloat :userStatus="userStatus" @closeUser="userStatus = false" @goLoginUser="goLoginUser" />
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
        <!-- <router-link to="/Attractions">景點介紹</router-link> -->
        <!-- <router-link to="/custom-tickets">客制車票</router-link> -->
        <!-- <router-link to="/select-info">一般訂票</router-link> -->
      </div>
      <!-- 購物車 -->
      <div class="chrt" @click="toggleCart">
        <i class="fa fa-shopping-cart" aria-hidden="true"></i>
      </div>
      <!-- 登入後顯示 -->
      <template v-if="isLogin">
        <div class="login" @click="toggleUser">
          <div class="icon-24">
            <i class="fa-solid fa-user"></i>
          </div>
        </div>
      </template>
      <!-- 登出後顯示 -->
      <template v-else>
        <router-link to="/login" class="login">
          {{ $store.state.name }}
        </router-link>
      </template>
      <!-- 自適應側邊攔區塊 -->
      <div id="menu-switch" class="ham" :class="{ active: openSidebar }" @click="toggleSidebar">
        <span></span>
        <span></span>
        <span></span>
      </div>
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
          </div>
        </template>
        <template v-slot:slotfooter>
          <template v-if="isLogin">
            <div class="link-list">
              <router-link to="/user/info">
                <li>
                  <div class="icon-24">
                    <img class="custom-svg" src="@/assets/images/icon/basic/member-login.svg" alt="list-icon">
                  </div>
                  <span>Hello, {{ $store.state.name }}</span>
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
              <router-link to="/login" class="login" @click="signOut">
                <li>
                  登出
                </li>
              </router-link>
            </div>
          </template>
          <template v-else>
            <!-- 還沒有登入 -->
          </template>
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
    UserFloat
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
      return this.$store.state.isLogin
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
      this.$store.commit('setName', '登入/註冊');
      this.$store.commit('setIsLogin', false); // 使用 commit 來改變狀態
      this.$router.push('/roaming-orbit');
    },
  },
  mounted() {
    svg_icon('.custom-svg', 'currentColor');
  },
};
</script>

<style lang="scss" scoped></style>

<template>
  <div class="userPage cartFloat" v-show="userStatus">
    <div class="link-list">
      <router-link to="/user">
        <li style="width: 100%">
          <div class="icon-24">
            <img
              class="custom-svg"
              src="@/assets/images/icon/basic/member-login.svg"
              alt="list-icon"
            />
          </div>
          <span
            style="
              overflow: hidden;
              text-overflow: ellipsis;
              white-space: nowrap;
            "
            >Hello, {{ $store.state.name }}</span
          >
          <img
            class="custom-svg"
            src="@/assets/images/icon/basic/settings.svg"
            alt="settings-icon"
          />
        </li>
      </router-link>
      <router-link to="/user/order">
        <li>
          <img
            class="custom-svg"
            src="@/assets/images/icon/basic/list.svg"
            alt="list-icon"
          />
          <span>訂單管理</span>
        </li>
      </router-link>
      <router-link to="/user/forum">
        <li>
          <img
            class="custom-svg"
            src="@/assets/images/icon/basic/message_writing.svg"
            alt="message_writing"
          />
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
      <router-link to="/login" class="login" @click="handleLogout">
        <li>登出</li>
      </router-link>
    </div>
  </div>
  <div class="pageMask" v-show="userStatus" @click="closeUser"></div>
</template>

<script setup>
import { defineProps, defineEmits } from "vue";
import { useStore } from "vuex";
import { useRouter } from "vue-router";
import { firebaseAuth } from "@/assets/config/firebase.js";
import { signOut } from "firebase/auth";

//data
const props = defineProps(["userStatus"]);
const emit = defineEmits(["closeUser", "goLoginUser"]);

const store = useStore();
const router = useRouter();

const usersignOut = function () {
  // 登出
  store.commit("setName", "登入/註冊");
  store.commit("setIsLogin", false); // 使用 commit 來改變狀態
  router.push("/about");
};

// 關閉視窗按鈕
const closeUser = () => {
  emit("closeUser");
};

// 登出並且隱藏選單
const handleLogout = () => {
  usersignOut(); // 執行 signOut 方法
  closeUser(); // 關閉會員選單
};
</script>

<style lang="scss" scoped>
.pageMask {
  background-color: transparent;
  width: 100vw;
  height: 100vh;
  position: fixed;
  top: 0;
  left: 0;
  z-index: 9;
}
</style>

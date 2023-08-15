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
          <template v-if="$store.state.userInfo">
            <span
              style="
                overflow: hidden;
                text-overflow: ellipsis;
                white-space: nowrap;
              "
              >Hello, {{ $store.state.userInfo.mem_name }}</span
            >
          </template>
          <template v-else>
            <span
              style="
                overflow: hidden;
                text-overflow: ellipsis;
                white-space: nowrap;
              "
              >Hello, Guest</span
            >
          </template>
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
import { defineProps, defineEmits, onMounted  } from "vue";
import { useStore } from "vuex";
import { useRouter } from "vue-router";
import { firebaseAuth } from "@/assets/config/firebase.js";
import { signOut } from "firebase/auth";

//data
const props = defineProps(["userStatus"]);
const emit = defineEmits(["closeUser", "goLoginUser"]);

const store = useStore();
const router = useRouter();

onMounted(() => {
  svg_icon(".custom-svg", "currentColor");
});

const logoutUser = function () {
  // 登出
  signOut(firebaseAuth)
    .then(() => {
      // Sign-out successful.
      store.commit("setIsLogin", false);
      // store.commit("setName", "");
      store.commit("deleteUser"); // 使用 VueX mutations -> 清除使用者資料
      location.reload(); //刷新頁面
      if ($route.name === "login") {
        return
      } else {
        // router.push({ name: "login" }); //跳轉
        this.$router.push("/about");
      }
      
    })
    .catch((error) => {
      // An error happened.
      console.log(`登出錯誤訊息:${error}`);
    });
};

// 關閉視窗按鈕
const closeUser = () => {
  emit("closeUser");
};

// 登出並且隱藏選單
const handleLogout = () => {
  logoutUser(); // 執行 signOut 方法
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

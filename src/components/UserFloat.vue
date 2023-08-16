<template>
  <div class="userPage cartFloat" v-if="userStatus">
    <div class="link-list">
      <router-link to="/user" class="setting">
        <li>
          <template v-if="getUserInfo !== null && getUserInfo[0].pattern_file">
            <div class="icon-24 avatar">
              <Images
                :imgURL="`${getUserInfo[0].pattern_file}`"
                :alt="`avatar`"
              />
            </div>
          </template>
          <template v-else>
            <div class="icon-24">
              <i class="fa-solid fa-user"></i>
            </div>
          </template>

          <template v-if="getUserInfo[0]">
            <span
              style="
                overflow: hidden;
                text-overflow: ellipsis;
                white-space: nowrap;
              "
              >Hello, {{ getUserInfo[0].mem_name }}</span
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
          <div class="icon-24">
            <i class="fa-solid fa-gear"></i>
          </div>
        </li>
      </router-link>
      <router-link to="/user/order">
        <li>
          <div class="icon-24">
            <i class="fa-solid fa-list-ul"></i>
          </div>
          <span>訂單管理</span>
        </li>
      </router-link>
      <router-link to="/user/forum">
        <li>
          <div class="icon-24">
            <i class="fa-regular fa-comments"></i>
          </div>
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
        <li>
          <span> 登出 </span>
        </li>
      </router-link>
    </div>
  </div>
  <div class="pageMask" v-show="userStatus" @click="closeUser"></div>
</template>

<script setup>
import { defineProps, defineEmits, onMounted, ref } from "vue";
import { useStore } from "vuex";
import { useRouter } from "vue-router";
import { firebaseAuth } from "@/assets/config/firebase.js";
import { signOut } from "firebase/auth";
//data
const props = defineProps(["userStatus", "getUserInfo"]);
const emit = defineEmits(["closeUser", "goLoginUser"]);

const store = useStore();
const router = useRouter();

const logoutUser = function () {
  // 登出
  signOut(firebaseAuth)
    .then(() => {
      // Sign-out successful.
      store.commit("setIsLogin", false);
      // store.commit("setName", "");
      store.commit("deleteUser"); // 使用 VueX mutations -> 清除使用者資料
      // location.reload(); //刷新頁面
      this.$router.push("/login");
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
.avatar {
  border: 1px solid #7aacbf;
  border-radius: 50%;
  width: 40px;
  height: 40px;
  overflow: hidden;
  img {
    object-fit: cover;
  }
}
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

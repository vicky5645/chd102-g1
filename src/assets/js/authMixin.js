import { firebaseAuth } from "@/assets/config/firebase.js";

import {
  signOut,
  onAuthStateChanged,
} from "firebase/auth";

export default {
  data() {
    return {
      existUser: null, // Initialize existUser in data
    }
  },
  created() {
    // 檢查使用者的登錄狀態
    this.checkAuthState();
    //調用 Vuex 的 initStorageLogin 操作
    this.$store.dispatch("initStorageLogin");
  },
  methods: {
    checkAuthState() {
      //可以使用currentUser屬性獲取當前登錄的用戶。如果用戶未登錄，則currentUser為null：測了一下這個方法有可能失效
      // existUser = auth.currentUser;
      //用onAuthStateChanged獲取當前登錄的用戶。如果用戶未登錄，則existUser為null：
      onAuthStateChanged(firebaseAuth, (user) => {
        this.existUser = user;
        if (this.existUser) {
          // User is signed in, see docs for a list of available properties
          // https://firebase.google.com/docs/reference/js/firebase.User
          this.updateUserInfo(this.existUser);
          // const uid = existUser.uid;
        } else {
          // User is signed out
          this.cleanUserInfo();
          // alert("未登入帳號");
        }
      });
    },
    updateUserInfo(user) {
      // Your update user info logic here
      this.$store.commit("updateUser", user);
      this.getUserName(user.email);
    },
    cleanUserInfo() {
      // Your clean user info logic here
    },
    // logoutUser() {//登入頁的登出按鈕檢查被註解 用於測試
    //   signOut(firebaseAuth)
    //   .then(() => {
    //     // Sign-out successful.
    //     // this.modifySuccess; //返回登入介面
    //     this.$store.commit("setIsLogin", false);
    //     this.$store.commit("setName", "");
    //     this.$store.commit('deleteUser');// 使用 VueX mutations -> 清除使用者資料 
        
    //       location.reload(); //刷新頁面
    //       // this.$router.push({ name: "login" });//跳轉
    //     })
    //     .catch((error) => {
    //       // An error happened.
    //       alert(`登出錯誤訊息:${error}`);
    //     });
    // },
    getUserName(userEmail) {
      const userName = userEmail.split("@")[0];
      this.$store.commit("setName", userName);
    },
  },
};
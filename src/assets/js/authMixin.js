import { firebaseAuth } from "@/assets/config/firebase.js";

import { signOut, onAuthStateChanged } from "firebase/auth";

import axios from "axios";
import { BASE_URL } from "@/assets/js/common.js";

export default {
  data() {
    return {
      existUser: null,
      getMemberData: [],
    };
  },
  created() {
    // 檢查使用者的登錄狀態
    this.checkAuthState();
    //調用 Vuex 的 initStorageLogin 操作
    this.$store.dispatch("initStorageLogin");
  },
  methods: {
    checkAuthState() {
      // existUser = auth.currentUser;
      //用onAuthStateChanged獲取當前登錄的用戶。如果用戶未登錄，則existUser為null：
      onAuthStateChanged(firebaseAuth, (user) => {
        this.existUser = user;
        if (this.existUser) {
          // 回傳資料庫的會員資料
          this.getMember(this.existUser.email, (MemberData) => {
            const getData = MemberData[0];
            // console.log("getData::", getData);

            // 已接收到資料庫內的會員資料
            if (getData) {
              console.log("getData::mem_name", getData["mem_name"]);
              // 將資料紀錄在 sessionStorage 中
              this.updateUserInfo(this.existUser, getData);
            }
            console.log("已登入帳號");
          });
          // const uid = this.existUser.uid;
        } else {
          // User is signed out
          console.log("未登入帳號");
        }
      });
    },
    updateUserInfo(existUser, getData) {
      // Your update user info logic here
      const userInfo = {
        // uid: existUser.uid,
        mem_no: getData["mem_no"],
        mem_name: getData["mem_name"],
        mem_salutation: getData["mem_salutation"],
        mem_email: existUser.email,
        mem_mobile: getData["mem_mobile"],
        mem_addr: getData["mem_addr"],
        mem_acc: getData["mem_acc"],
        mem_pwd: getData["mem_pwd"],
        pattern_file: getData["pattern_file"],
      };
      // this.$store.commit("updateUser", getData);
      this.$store.commit("updateUser", userInfo);
    },
    // 傳送登入信箱取得資料庫會員資料
    getMember(userEmail, callback) {
      const data = new FormData(); // POST 表單資料
      data.append("type", "authMixin");
      data.append("mem_email", userEmail);

      if (this.existUser !== null && this.getMemberData.length === 0) {
        // 使用 Axios 發送 POST 請求
        axios
          .post(`${BASE_URL}getMember.php`, data)
          .then((response) => {
            // 請求成功後的處理
            this.getMemberData = response.data;
            console.log("取得資料庫會員資料！");
            // 調用回調函數處理data
            if (callback) {
              callback(this.getMemberData);
            }
          })
          .catch((error) => {
            // 請求失敗後的處理
            console.error(error);
            console.log("接收失敗！");
          });
      }
    },
  },
};

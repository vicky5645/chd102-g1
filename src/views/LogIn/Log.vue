<template>
  <div class="login-wrap">
    <!-- 檢查使用者的登錄狀態 -->
    <!-- <div
      style="
        position: fixed;
        top: 0;
        left: 0;
        background-color: gold;
        width: 200px;
        z-index: 999;
      "
    >
    <p>{{ `this.existUser::${this.existUser}` }}</p>
      <p>{{ this.step }}</p>
      <p>
        {{ `isRegistered:${isRegistered}` }}
      </p>
      <p>userInfo::{{ this.$store.state.userInfo }}</p>
      <button
        type="button"
        v-for="btn in btns"
        class="login-connect"
        @click="logoutUser"
      >
        登出
      </button>
    </div> -->
    <section
      class="login"
      v-if="!isRegistered && !loginStatus && !forgetPsw && step === 0"
    >
      <div class="loin-form-wrap">
        <div class="loin-form-img"></div>

        <div class="login-form">
          <div class="login-test">
            <!-- <img src="~@/assets/logo.svg" alt="logo" /> -->

            <p>登入</p>

            <span>隨時收到獨家優惠</span>
          </div>

          <form>
            <button
              type="button"
              v-for="btn in btns"
              class="login-connect"
              @click="signInGoogle"
            >
              <i :class="btn.iconClass"></i> {{ btn.text }}
            </button>

            <span>或</span>

            <div class="input-wrap login">
              <input v-model="username" type="text" placeholder="" required />
              <label>帳號</label>
            </div>
            <div class="input-wrap login">
              <input v-model="password" type="text" placeholder="" required />
              <label>密碼</label>
            </div>

            <div class="error-message">{{ errorMsg }}</div>

            <div class="forget-password" @click="forgetPassword">忘記密碼?</div>

            <div class="actions">
              <span>還未加入LOGO嗎？</span>

              <button
                type="button"
                @click.prevent="changeRegister"
                class="login-form-register"
              >
                立即註冊！
              </button>

              <button
                type="button"
                class="login-form-confirm btn2"
                @click.prevent="checkLogin"
              >
                確定
              </button>
            </div>
          </form>
        </div>
        <div class="login-wrap-pic">
          <Images :imgURL="'images/logo/logoBig.png'" :alt="'Logo'" />
        </div>
      </div>
    </section>

    <section class="login" v-if="isRegistered">
      <div>
        <!-- form??? -->
        <div class="loin-form-wrap">
          <div class="login-form">
            <div class="login-test">
              <p>註冊會員</p>

              <span>立即登入，隨時找到獨家優惠</span>
            </div>
            <form action="">
              <!-- google 登入按鈕 -->
              <button
                type="button"
                v-for="btn in btnsRegister"
                class="login-connect"
                @click="signInGoogle"
              >
                <i :class="btn.iconClass"></i> {{ btn.text }}
              </button>

              <div class="row register-label">
                <div class="col">
                  <div class="inputBox">
                    <span>名字</span>
                    <input
                      type="text"
                      class="payment-name-input"
                      required="required"
                      v-model="register.nameReg"
                      placeholder=""
                    />
                    <div class="payment-name"></div>
                  </div>
                  <div class="inputBox">
                    <span>信箱</span>
                    <input
                      type="email"
                      class="payment-email-input"
                      v-model="register.emailReg"
                      required="required"
                    />
                    <div class="payment-email"></div>
                  </div>
                  <div class="inputBox">
                    <span>密碼</span>
                    <input
                      type="text"
                      class="payment-address-input"
                      v-model="register.pswReg"
                      required="required"
                    />
                    <div class="payment-address"></div>
                  </div>
                  <div class="inputBox">
                    <span>再次輸入密碼</span>
                    <input
                      type="text"
                      class="payment-nation-input"
                      required="required"
                      v-model="register.pswConfirmReg"
                    />
                    <div class="payment-nation"></div>
                  </div>
                </div>
              </div>

              <div class="register-form-bottom">
                <div class="register-form-bottom-agree">
                  <input
                    type="checkbox"
                    name="membership"
                    id="membership"
                    required="required"
                  />
                  <label for="membership">
                    我已詳閱並同意<a href="" target="_blank">會員條款</a>與
                    <a href="" target="_blank">隱私權規定</a>
                  </label>
                </div>

                <input
                  type="button"
                  class="register-submit"
                  @click="columnCheck"
                  value="註冊會員"
                />
              </div>
              <span @click="isRegistered = false">返回會員登入</span>
            </form>
          </div>
          <div class="login-wrap-pic">
            <img src="/images/logo/logoBig.png" alt="Logo" />
          </div>
        </div>
      </div>
    </section>

    <section class="forget_password" v-if="forgetPsw && step === 1">
      <div class="forget_password_from">
        <h2>忘記密碼</h2>

        <p>輸入註冊信箱，傳送驗證碼</p>
        <div class="forget-password-enter">
          <input
            type="email"
            placeholder=" 電子郵件地址 "
            v-model="memEmail"
            required="required"
          />
        </div>
        <button
          type="button"
          @click="checkEmail()"
          class="forget-password-submit"
        >
          傳送
        </button>
      </div>
    </section>

    <section class="enter-modify-success" v-if="forgetPsw && step === 4">
      <p>請至信箱驗證並修改密碼🚀</p>
      <p>請返回重新登入↩️</p>
      <button type="button" @click="modifySuccess">返回會員登入</button>
    </section>

    <section class="enter-modify-success" v-if="step === 5">
      <p>🚀 註冊完成 🎉</p>
      <p>🚂 請重新登入 ↩️</p>
      <button type="button" @click="modifySuccess">返回會員登入</button>
    </section>
  </div>
</template>

<script>
import { firebaseAuth } from "@/assets/config/firebase.js";
import {
  createUserWithEmailAndPassword,
  signInWithEmailAndPassword,
  signOut,
  sendPasswordResetEmail,
  sendEmailVerification,
} from "firebase/auth";
//google 守門人
import { signInWithPopup, GoogleAuthProvider } from "firebase/auth";
const provider = new GoogleAuthProvider();
import axios from "axios";
import { BASE_URL } from "@/assets/js/common.js";
export default {
  name: "login",
  data() {
    return {
      username: "",
      password: "",
      loginStatus: false,
      isRegistered: false,
      forgetPsw: false,
      step: 0,
      errorMsg: "",
      register: {
        nameReg: "",
        emailReg: "",
        pswReg: "",
        pswConfirmReg: "",
        sexReg: "",
        birthReg: "",
        telReg: "",
      },
      verification: {
        number1: "",
        number2: "",
        number3: "",
        number4: "",
      },
      memEmail: "",
      modify: {
        psw: "",
        newPsw: "",
      },
      btns: [
        {
          text: "使用Google帳戶繼續操作",
          // pic: require('@/assets/images/login/google.svg')
          iconClass: "fab fa-google",
        },
      ],

      btnsRegister: [
        {
          text: "使用Google帳戶註冊",
          // pic: require('@/assets/images/login/google.svg')
          iconClass: "fab fa-google",
        },
      ],
    };
  },
  methods: {
    closeModal() {
      this.$emit("emit-status");
    },
    // getUserName(userEmail) {
    //   const userName = userEmail.split("@")[0];
    //   this.$store.commit("setName", userName);
    // },
    checkLogin() {
      if (this.username === "" || this.password === "") return;
      signInWithEmailAndPassword(firebaseAuth, this.username, this.password)
        .then((userCredential) => {
          // firebase 的資料
          // const userInfo = userCredential.user;
          // this.signInUser = userInfo;
          // this.$store.commit("updateUser", userInfo);
          // this.getUserName(userInfo.email);
          this.$store.commit("setIsLogin", true); // 使用 commit 來改變狀態
          window.alert("登入成功");
          this.$router.push("/about");
        })
        .catch((error) => {
          const errorCode = error.code;
          console.log(errorCode);
          if (errorCode === "auth/wrong-password") {
            // window.alert("密碼錯誤");
            this.errorMsg = "密碼錯誤";
          } else if (errorCode === "auth/user-not-found") {
            // window.alert("請前往註冊");
            this.errorMsg = "請前往註冊";
          } else {
            window.alert(`error::${error}`);
            this.errorMsg = `${error}帳號或密碼輸入錯誤${errorCode}`;
          }
        });
    },

    forgetPassword() {
      this.forgetPsw = true;
      this.step = 1;
    },

    reset() {
      this.register.errorMsg = "";
    },

    changeRegister() {
      this.isRegistered = true;
    },
    modifySuccess() {
      // 返回登入介面
      this.isRegistered = false; // 註冊返回登入
      this.step = 0;
      this.forgetPsw = false; // 忘記密碼返回登入
      console.log("返回登入");
    },
    columnCheck() {
      if (this.register.pswReg === this.register.pswConfirmReg) {
        //存輸入的信箱與密碼
        const name = this.register.nameReg;
        const email = this.register.emailReg;
        const password = this.register.pswReg;
        // console.log(`email:${email},password:${password}`);

        // 使用 Firebase 的 createUserWithEmailAndPassword 方法進行註冊
        createUserWithEmailAndPassword(firebaseAuth, email, password)
          .then((userCredential) => {
            // 註冊成功，您可以在這裡處理相應的動作
            const returnUserInfo = userCredential.user;
            console.log("註冊成功userInfo", returnUserInfo);
            // this.$store.commit("updateUser", returnUserInfo);
            this.postBackMember(returnUserInfo,name,email,password);
            // 在註冊成功後跳轉到其他介面
            // this.isRegistered = false;
            // this.step = 5;
          })
          .catch((error) => {
            // 註冊失敗，處理錯誤訊息
            const errorCode = error.code;
            if (errorCode === "auth/email-already-in-use") {
              alert(`您的信箱可能已被註冊過了${errorCode}`);
            } else if (errorCode === "auth/weak-password") {
              alert(`此密碼強度太弱，至少包含六個字符${errorCode}`);
            } else if (errorCode === "auth/invalid-email") {
              alert(`信箱格式錯誤${errorCode}`);
            } else {
              console.log("註冊失敗", error.message);
              alert(`註冊失敗${error.message}`);
            }
          });
      } else {
        // 密碼不一致的處理
        console.log("密碼不一致");
        alert(`密碼不一致`);
      }
    },
    // 傳送資料到後台會員資料庫
    postBackMember(userObj,name,email,password) {
      let mem = {};
      mem["mem_no"] = userObj.uid
      mem["mem_email"] = userObj.email
      mem["mem_name"] = userObj.displayName? userObj.displayName: name
      mem["mem_acc"] = email
      mem["mem_pwd"] = password

      const data = new FormData(); // POST 表單資料
      // for (const key in mem) {
        // data.append(key, mem[key]);
      // }
      data.append("mem_no", mem["mem_no"]);
      data.append("mem_email", mem["mem_email"]);
      data.append("mem_name", mem["mem_name"]);
      data.append("mem_acc", mem["mem_acc"]);
      data.append("mem_pwd", mem["mem_pwd"]);
      console.log("postBackMember::", data);

      // 使用 Axios 發送 POST 請求
      axios
        .post(`${BASE_URL}postMember.php`, data)
        .then((response) => {
          // 請求成功後的處理
          console.log(response.data);
          // location.reload(); //刷新頁面
          alert("已新增帳號！");
        })
        .catch((error) => {
          // 請求失敗後的處理
          console.error(error);
          alert("新增帳號失敗！");
        });
    },
    signInGoogle() {
      signInWithPopup(firebaseAuth, provider)
        .then((result) => {
          // const credential = GoogleAuthProvider.credentialFromResulsignInGoogleedential.accessToken;
          this.$store.commit("setIsLogin", true); // 使用 commit 來改變狀態
          window.alert("google 登入成功");
          // const userInfo = result.user;
          // this.$store.commit("updateUser", userInfo);
        })
        .catch((error) => {
          const errorCode = error.code;
          console.log("google註冊失敗", errorCode);
          alert(`google註冊失敗${error}`);
        });
    },
    checkEmail() {
      if (!this.memEmail) {
        window.alert("輸入錯誤或無輸入");
      } else {
        alert("重設密碼");
        // this.step = 2;
        this.resetPsw();
        // this.memEmail = "";
      }
    },
    resetPsw() {
      sendPasswordResetEmail(firebaseAuth, this.memEmail)
        .then(() => {
          window.alert("已發送信件至信箱，請按照信件說明重設密碼");
          this.step = 4;
        })
        .catch((error) => {
          const errorCode = error.code;
          if (errorCode === "auth/invalid-email") {
            alert(`信箱格式錯誤${errorCode}`);
          } else {
            console.log("重置密碼失敗", error.message);
            alert(`重置密碼失敗${error}`);
          }
        });
    },
    // logoutUser() {//登入頁的登出按鈕檢查被註解 用於測試
    //   signOut(firebaseAuth)
    //   .then(() => {
    //     // Sign-out successful.
    //     this.modifySuccess; //返回登入介面
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
  },
};
</script>

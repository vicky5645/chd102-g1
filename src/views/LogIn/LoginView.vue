<template>
  <div class="login-wrap">
    <div class="login-wrap-text">
      <img src="~@/assets/logo.svg" alt="logo" />
      <p>隨時收到獨家優惠</p>

      <button class="google-btn" @click="loginWithGoogle">
        使用Google帳戶繼續操作
      </button>
      <div class="input-wrap login">
        <input v-model="username" type="text" placeholder="" required />
        <label>帳號</label>
      </div>
      <div class="input-wrap login">
        <input v-model="password" type="text" placeholder="" required />
        <label>密碼</label>
      </div>
      <router-link to="/forgotPassword">忘記密碼</router-link>

      <div class="actions">
        <span>還未加入LOGO嗎？</span>
        <router-link to="/register">立即註冊</router-link>
        <button class="login-btn" @click="login">確定</button>
      </div>
    </div>
    <div class="login-wrap-pic"></div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      username: "",
      password: "",
    };
  },
  methods: {
    loginWithGoogle() {
      // 使用 Google 帳號 API 登入
    },
    login() {
      // 登入驗證邏輯
      // 如果驗證成功，導航到登入成功頁面
      if (this.username === "test" && this.password === "test") {
        this.$store.commit("setName", this.username);
        this.$router.push("/member");
      } else {
        this.username = "";
        this.password = "";
        alert("用戶名或密碼不正確");
      }
    },
    goToRegister() {
      // 導航到註冊頁面
      this.$router.push("/register");
    },
  },
};
</script>

<style lang="scss" scoped></style>
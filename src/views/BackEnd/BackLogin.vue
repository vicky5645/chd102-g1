<template>
  <div class="login-wrap">
    <div class="login-wrap-text">
      <img src="~@/assets/logo.svg" alt="logo" />

      <div class="input-wrap login">
        <input v-model="username" type="text" placeholder="" required />
        <label>帳號</label>
      </div>
      <div class="input-wrap login">
        <input v-model="password" type="text" placeholder="" required />
        <label>密碼</label>
      </div>
      <div class="actions">
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
      if (this.username === 'test' && this.password === 'test') {
        this.$router.push('/backend');
      } else {
        this.username = "";
        this.password = "";
        alert("用戶名或密碼不正確");
      }
    },
  },
};
</script>

<style lang="scss" scoped></style>
<template>
  <div class="login-wrap">
    <div class="login-wrap-text">
      <img src="https://picsum.photos/100/100/?random=10">
      <p>隨時收到獨家優惠</p>
    </div>
    <button class="google-btn" @click=" loginWithGoogle">使用Google帳戶繼續操作</button>
    <input v-model="username" type="text" placeholder="帳號">
    <input v-model="password" type="text" placeholder="密碼">
    <a href="#" class="forgot-password">忘記密碼</a>

    <div class="actions">
      <span>還未加入LOGO嗎？</span>
      <a href="#" class="register-link" @click="goToRegister">立即註冊</a>
      <button class="login-btn" @click="login">確定</button>

    </div>
  </div>
</template>

<script>
export default {
  data(){
    return {
      username: '',
      password: ''
    }
  },
  methods: {
    loginWithGoogle() {
      // 使用 Google 帳號 API 登入
    },
    login() {
      // 登入驗證邏輯
      // 如果驗證成功，導航到登入成功頁面
      this.$router.push('/login-success');
    },
    goToRegister() {
      // 導航到註冊頁面
      this.$router.push('/register');
    }
  },
}
</script>

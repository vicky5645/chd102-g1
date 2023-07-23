<template>
  <div>
    <h2>會員註冊</h2>
    <form @submit.prevent="register">
      <label>用戶名：</label>
      <input type="text" v-model="username" required>
      <br>
      <label>密碼：</label>
      <input type="password" v-model="password" required>
      <br>
      <label>確認密碼：</label>
      <input type="password" v-model="confirmPassword" required>
      <br>
      <button type="submit">註冊</button>
    </form>
  </div>
</template>

<script>
export default {
  data() {
    return {
      username: '',
      password: '',
      confirmPassword: '',
    };
  },
  methods: {
    register() {
      // 在這裡實現會員註冊邏輯
      // 比較密碼和確認密碼是否相符，然後進行註冊

      // 這裡只是一個示例，通常您需要將用戶名和密碼提交到伺服器進行註冊
      if (this.password === this.confirmPassword) {
        // 完成註冊後，導航到登入頁面
        this.$router.push('/login');
      } else {
        alert('密碼不相符');
      }
    },
  },
};
</script>
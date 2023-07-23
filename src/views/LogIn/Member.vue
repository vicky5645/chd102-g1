<template>
  <div>
    <h2>歡迎回來，會員 {{ username }}!</h2>
    <!-- 這裡可以顯示會員相關資訊 -->
    <p>會員等級：{{ membershipLevel }}</p>
    <p>Email:{{ email }}</p>
    <button @click="logout">登出</button>
  </div>
</template>

<script>
export default {
  data() {
    return {
      username: 'JohnDoe', // 替換為實際的會員名稱
      membershipLevel: 'Gold', // 替換為實際的會員等級
      email: 'john@example.com', // 替換為實際的會員Email
    };
  },
  methods: {
    logout() {
      // 在這裡處理登出邏輯
      // 通常會將用戶從伺服器登出，然後導航到登入頁面
      this.$router.push('/login');
    },
  },
};
</script>
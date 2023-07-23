<template>
  <div>
    <h2>忘記密碼</h2>
    <form @submit.prevent="resetPassword">
      <label>Email：</label>
      <input type="email" v-model="email" required>
      <br>
      <button type="submit">重設密碼</button>
    </form>
  </div>
</template>

<script>
export default {
  data() {
    return {
      email: '',
    };
  },
  methods: {
    resetPassword() {
      // 在這裡實現重設密碼邏輯
      // 將重設密碼的請求提交到伺服器，然後顯示成功訊息或錯誤訊息

      // 這裡只是一個示例，通常您需要將email提交到伺服器進行重設密碼的處理
      alert('重設密碼的請求已發送到您的Email');
    },
  },
};
</script>
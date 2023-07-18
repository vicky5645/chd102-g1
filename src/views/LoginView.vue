<template>
  <div class="login-wrap">
    <div class="login-wrap-text">
      <img src="https://picsum.photos/100/100/?random=10">
      <p>隨時收到獨家優惠</p>
    </div>
    <button class="google-btn" @click=" loginWithGoogle">使用Google帳戶繼續操作</button>
    <div class="login">
      <input v-model="username" type="text" placeholder="" required>
      <label>帳號</label>
    </div>
    <div class="login">
      <input v-model="password" type="text" placeholder="" required>
      <label>密碼</label>
    </div>
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
      if(this.username === 'test' && this.password === 'test'){
        this.$store.commit('setName', this.username )
        this.$router.push('/login-success');
      }else{
        this.username = ''
        this.password = ''
      }
    },
    goToRegister() {
      // 導航到註冊頁面
      this.$router.push('/register');
    }
  },
}
</script>


<style lang="scss" scoped>
.login{ 
  // width: 500px;
  position: relative;
  // margin-top: 50px;
  & input{
    /* outline: none; */
    /* border: none; */
    width: 100%;
    // padding: 10px 0;
    // color: #000;
    font-size: 16px;
    /* border-bottom: 1px solid red; */
    background: none;
    &:focus + label,
    &:valid + label {
      font-size: 12px;
      transform: translateY(-75%);
      color: red;
    }
  }
  & label {
    position: absolute;
    top: 25%;
    left: 0;
    transform: translateY(-25%);
    color: #000;
    font-size: 16px;
    pointer-events: none;
    transition: all 0.5s;
    background-color: gold;
  }
}

</style>

<template>
    <!-- (這裡放的是連結的範本) -->
    <div>
      <router-link to="/login/login">
        <li>
          <span>登入頁</span>
        </li>
      </router-link>
      <router-link to="/login/register">
        <li>
          <span>註冊頁</span>
        </li>
      </router-link>
      <router-link to="/login/forgot">
        <li>
          <span>忘記密碼</span>
        </li>
      </router-link>
      <router-link to="/login/mem">
        <li>
          <span>會員</span>
        </li>
      </router-link>
      <router-link to="/user">
        <li>
          <span>會員專區</span>
        </li>
      </router-link>
    </div>
</template>

<script>
export default {
};
</script>

<style lang="scss" scoped>
</style>
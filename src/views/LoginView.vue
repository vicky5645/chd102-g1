<template>
  <div>
    Login
    <label for="email">email</label>
    <br>
    <input type="email" v-model="email">
    <br>
    <button @click="login">登入</button>
  </div>
</template>

<script>
export default {
  data(){
    return {
      title: 'test',
      email: ''
    }
  },
  methods: {
    login(){
      console.log('login:'+ this.email);
      
    }
  },
}
</script>

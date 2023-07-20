<template>
  <div class="start-view">
    <h1>{{ $route.meta.title }}</h1>
    起始頁面
    <div>
      <router-link to="/roaming-orbit">前台</router-link>
    </div>
    <div>
      <router-link to="/backend">後台</router-link>
    </div>
  </div>
</template>

<script>
// @ is an alias to /src

export default {
  components: {
  },
  data() {
    return {
    }
  }
}
</script>

<style lang="scss">
</style>
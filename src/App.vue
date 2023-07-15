<template>
  <MainHeader></MainHeader>

  <main>
    <router-view/>
  </main>

  <MainFooter></MainFooter>
</template>

<script>
import MainHeader from '@/components/MainHeader.vue'
import MainFooter from '@/components/MainFooter.vue'
export default {
  components: {
    MainHeader,
    MainFooter,
  }
}
</script>

<style lang="scss">
// @import '@/assets/scss/style.scss';
</style>

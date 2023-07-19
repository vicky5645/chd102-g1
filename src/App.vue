<template>
  <MainHeader></MainHeader>

  <router-view/>

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
</style>

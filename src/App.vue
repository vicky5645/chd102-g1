<template>
  <MainHeader v-if="!hasStartView"></MainHeader>

  <router-view />

  <MainFooter v-if="!hasStartView"></MainFooter>
</template>

<script>
import MainHeader from '@/components/MainHeader.vue'
import MainFooter from '@/components/MainFooter.vue'
export default {
  components: {
    MainHeader,
    MainFooter,
  },
  computed: {
    hasStartView() {
      const isStart = this.$route.matched.some(route => route.name === 'start');
      const isBackEnd = this.$route.matched.some(route => route.name === 'backend');
      const isBackLogin = this.$route.matched.some(route => route.name === 'backendlogin');
      return isStart || isBackEnd || isBackLogin;
    },
  },
  // mounted() {
  //   svg_icon('.custom-svg', 'currentColor');
  // },
}
</script>

<style lang="scss">
</style>

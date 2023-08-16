<template>
  <LoadingAni v-if="$store.state.Loading" />
  <MainHeader v-if="!hasStartView"></MainHeader>

  <router-view />

  <MainFooter v-if="!hasStartView"></MainFooter>
</template>

<script>
import MainHeader from "@/components/MainHeader.vue";
import MainFooter from "@/components/MainFooter.vue";
import LoadingAni from '@/components/Loading.vue';
export default {
  components: {
    MainHeader,
    MainFooter,
    LoadingAni
  },
  computed: {
    hasStartView() {
      const isStart = this.$route.matched.some(
        (route) => route.name === "start"
      );
      const isBackEnd = this.$route.matched.some(
        (route) => route.name === "backend"
      );
      const isBackLogin = this.$route.matched.some(
        (route) => route.name === "backendlogin"
      );
      return isStart || isBackEnd || isBackLogin;
    },
  },
};
</script>

<style lang="scss"></style>

<script setup>
import { ref } from "vue";
const name = ref("銀月山脈");
const main = ref("@/assets/images/spot/02.jpg");
</script>
<template>
  <h1>{{ name }}</h1>
  <section class="Scenery">
    <div class="main">{{}}</div>
    <div class="content">
      <div class="pic"></div>
      <div class="desc"></div>
    </div>
  </section>
  <swiper></swiper>
</template>
<section class="carousel"></section>
<style lang="scss" scoped>
@import "@/assets/scss/style.scss";

* {
  box-sizing: border-box;
}
.container {
  @include layout(1200);
}
</style>

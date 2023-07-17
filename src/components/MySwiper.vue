<template>
  <div>
    <swiper-container ref="swiperRef" :init="false">
      <swiper-slide class="blue-slide">Slide 1</swiper-slide>
      <swiper-slide class="yellow-slide">Slide 2</swiper-slide>
      <swiper-slide class="green-slide">Slide 3</swiper-slide>
    </swiper-container>
  </div>
</template>

<script>
import { ref, onMounted } from "vue";
import { register } from "swiper/element/bundle";
import SwiperCore, { Navigation, Pagination } from "swiper";

// 注册所需的 Swiper 组件模块
SwiperCore.use([Navigation, Pagination]);

export default {
  name: "MySwiper",
  mounted() {
    register();

    const swiperContainer = this.$refs.swiperRef.$el;
    const params = {
      navigation: true,
      pagination: true,
    };

    Object.assign(swiperContainer, params);
    swiperContainer.initialize();
  },
};
</script>

<style>
/* 可在这里添加样式 */
</style>

<!-- ItineraryIntro.vue -->
<template></template>

<script>
export default {
  data() {
    return {
      value: "1",
    };
  },
  methods: {
    changeBackground(url) {
      const attractions = document.querySelector(".attractions");
      attractions.style.backgroundImage = `url(${url})`;
    },
  },
};
</script>

<style lang="scss" scoped></style>

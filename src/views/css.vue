<template>
  CCCSS{{ title }}
  <img src="~@/assets/logo.png" alt="">

  <div class="box_default"></div>
  <button class="btn primary"></button>

  <h2>Icon sets</h2>
  <p>Outlined icons</p>
  <div class="row">
    <img src="~@/assets/images/icon/basic/trash_full.png" alt="">
  </div>
  <p>Filled icons</p>
</template>

<script>
export default {
  data() {
    return {
    }
  },
  methods: {
  },
}
</script>

<style lang="scss" scoped>
* {
  border: 1px solid #000;
}

.row img {
  width: 24px;
}
</style>

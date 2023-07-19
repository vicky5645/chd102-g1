<template>
  <h1>{{ $route.meta.title }}</h1>
  <img src="~@/assets/LOGO.svg" alt="">
</template>
<script>
export default {
  data() {
    return {
      productData: [],
    }
  },
  created() {
    // 取得API
    fetch('/data/productData.json')
      .then(res => res.json())
      .then(json => {
        this.productData = json
      })
  }
}
</script>
<template>
  <!-- {{ $route.params.id }} -->
  <div v-if="productData">
    <img :src="productData.image" alt="">
    <p>{{ productData.title }}</p>
    <p>{{ productData.description }}</p>
    <p>{{ productData.category }}</p>
    <p>${{ productData.price }}</p>
    <span v-for="item in Math.round(productData.rating.rate)">
      🌟
    </span>
    <span>{{ productData.rating.count }}</span>
  </div>
  <div v-else>
    Loading...
  </div>
</template>

<script>
export default {
  data(){
    return {
      productData: null,
    }
  },
  created() {
    // console.log(this.$route.params);
    // https://fakestoreapi.com/
    fetch(`https://fakestoreapi.com/products/${this.$route.params.id}`)
    .then(res=>res.json())
    .then(json=>{
      this.productData = json
    })
  },
}
</script>

<style lang="scss">
img{
  width: 10rem;
}
</style>

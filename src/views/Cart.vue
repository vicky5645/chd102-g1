<template>
  <!-- <h1>{{ $route.meta.title }}</h1> -->
  <!-- <img src="~@/assets/LOGO.svg" alt=""> --> 
  <main>
    <div class="back_button">
      <router-link to="/online-mall">
        <i class="fa fa-angle-left" aria-hidden="true"></i> 返回商城
      </router-link>
    </div>
    <div class="container cartPage">
      <h2>購物車清單</h2>
      <hr>
      <div class="cartList">
        <div class="cart-card card-block" v-if="productData.length > 0">
          <div class="cart-cardPic">
            <img :src="productData[0].image" alt="">
          </div>
          <div class="item-info">
            <a class="item-name" href="#">
              {{ productData[0].title }}
            </a>
            <div class="item-price">
              {{ productData[0].price }}
            </div>
          </div>
          <div class="btn-group">
            <button><i class="fa-solid fa-minus"></i></button>
            <div class="item-qty">
              <span id="qty">5</span>
            </div>
            <button><i class="fa-solid fa-plus"></i></button>
          </div>
        </div>
      </div>
    </div>
  </main>
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
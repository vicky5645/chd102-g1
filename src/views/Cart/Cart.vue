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
      <hr class="hrTop">
      <div class="cartList">
        <div class="cart-card card-block" v-if="productData.length > 0">
          <div class="cart-cardPic-group">
            <div class="drop">
              <button class="item-drop">
                <i class="fa-regular fa-trash-can"></i>
              </button>
            </div>
            <div class="item-pic">
              <img :src="productData[0].image" alt="">
            </div>
          </div>
          <div class="item-info">
            <a class="item-name" href="#">
              {{ productData[0].title }}
            </a>
            <div class="item-price">
              <span>{{ productData[0].price }}</span>
            </div>
          </div>
          <div class="btn-group">
            <button @click="decrement"><i class="fa-solid fa-minus"></i></button>
            <div class="item-qty">
              <span id="qty">{{ this.quantity }}</span>
            </div>
            <button @click="increment"><i class="fa-solid fa-plus"></i></button>
          </div>
        </div>
        <div class="cart-card card-block" v-if="productData.length > 0">
          <div class="cart-cardPic-group">
            <div class="drop">
              <button class="item-drop">
                <i class="fa-regular fa-trash-can"></i>
              </button>
            </div>
            <div class="item-pic">
              <img :src="productData[0].image" alt="">
            </div>
          </div>
          <div class="item-info">
            <a class="item-name" href="#">
              {{ productData[0].title }}
            </a>
            <div class="item-price">
              <span>{{ productData[0].price }}</span>
            </div>
          </div>
          <div class="btn-group">
            <button @click="decrement"><i class="fa-solid fa-minus"></i></button>
            <div class="item-qty">
              <span id="qty">{{ this.quantity }}</span>
            </div>
            <button @click="increment"><i class="fa-solid fa-plus"></i></button>
          </div>
        </div>
      </div>
      <hr class="hrBot">
      <div class="totalPrice item-price">
        總計:
        <span class="h3">123</span>
      </div>
      <div class="checkOut">
        <button class="btn-back" @click="goBack">返回</button>
        <router-link to="/checkout">
        <button class="btn-checkOut">前往結帳</button>
        </router-link>
      </div>
    </div>
  </main>
</template>
<script>
export default {
  data() {
    return {
      productData: [],
      quantity: 1,
    }
  },
  created() {
    // 取得API
    fetch('/data/productData.json')
      .then(res => res.json())
      .then(json => {
        this.productData = json
      })
  },
  methods: {
    // 規格按鈕
    increment() {
      if (this.quantity < 10) {
        this.quantity++;
      }
    },
    decrement() {
      if (this.quantity > 1) {
        this.quantity--;
      }
    },
    goBack() {
      // 使用 router.go() 方法導向上一頁
      this.$router.go(-1);
    }
  }
}
</script>
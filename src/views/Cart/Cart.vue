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
      <CartList/>
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
import CartList from "@/components/CartList.vue";
import { useStore, mapGetters } from 'vuex';
export default {
  data() {
    return {
      productData: [],
      quantity: 1,
    }
  },
  components: {
    CartList
  },
  computed: {
    ...mapGetters(['cartList']),
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
    
    //增加數量
    increment(e) {
      const clickTitle = e.target.parentNode.parentNode.parentNode.dataset.item;
      console.log(clickTitle);
      this.$store.commit("addAmount", clickTitle);
    },
    //減少數量
    decrement(e) {
      const clickTitle = e.target.parentNode.parentNode.parentNode.dataset.item;
      console.log(clickTitle);
      this.$store.commit("minusAmount", clickTitle);
    },
    //刪除商品
    removeFromCart(e) {
      this.$store.commit("removeFromCart", e.target.dataset.title);
    },
    //規格按鈕
    // increment() {
    //   if (this.quantity < 10) {
    //     this.quantity++;
    //   }
    // },
    // decrement() {
    //   if (this.quantity > 1) {
    //     this.quantity--;
    //   }
    // },
    goBack() {
      // 使用 router.go() 方法導向上一頁
      this.$router.go(-1);
    }
  },
}
</script>
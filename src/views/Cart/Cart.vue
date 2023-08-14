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
        <span class="h3">{{ totalPrice }}</span>
      </div>
      <div class="checkOut">
        <button class="btn-back" @click="goBackMall">返回商城</button>
        <!-- <router-link to="/checkout"> -->
        <button class="btn-checkOut default-btn" @click="checkPrice">前往結帳</button>
        <!-- </router-link> -->
      </div>
    </div>
  </main>
</template>
<script>
import CartList from "@/components/CartList.vue";
import { mapGetters } from 'vuex';
export default {
  components: {
    CartList
  },
  computed: {
    ...mapGetters(['cartList', 'totalPrice']),
  },
  created() {
      this.$store.commit("calculateSum");
  },
  methods: {
    updateTotalPrice() {
      this.$store.commit("calculateSum");
    },
    goBackMall() {
      this.$router.push({ path: "/online-mall" });
    },
    checkPrice() {
      if (this.totalPrice <= 0 ) {
        return alert("您尚未選購任何商品！");
      } else {
      if (this.$store.state.isLogin === true) {
        this.$router.push({ path: "/checkout" });
      } else {
      window.alert("請先登入會員");
      this.$router.push({ path: "/login" });
      }
    }
  }
  },
}
</script>
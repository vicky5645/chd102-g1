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
        <button class="btn-back" @click="goBack">返回</button>
        <!-- <router-link to="/checkout"> -->
        <button class="btn-checkOut" @click="checkPrice">前往結帳</button>
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
    goBack() {
      // 使用 router.go() 方法導向上一頁
      this.$router.go(-1);
    },
    checkPrice() {
      if (this.totalPrice <= 0 ) {
        return alert("您尚未選購任何商品！");
      }
      this.$router.push('/checkout');
    }
  },
}
</script>
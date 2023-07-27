<template>
    <div class="cartList">
        <div class="cart-card card-block" v-for="item in cartList" :key="item.id" :data-item="item.title">
            <div class="cart-cardPic-group">
                <div class="drop">
                    <button class="item-drop" @click="removeFromCart">
                        <i class="fa-regular fa-trash-can"></i>
                    </button>
                </div>
                <div class="item-pic">
                  <Images :imgURL="`${item.image}`" :alt="`${item.title}`" />
                  <!-- <img :src="item.image" :alt="item.title"> -->
                </div>
            </div>
            <div class="item-info">
                <a class="item-name" href="#">
                    {{ item.title }}
                </a>
                <div class="item-price">
                    <span>{{ item.totalPrice }}</span>
                </div>
            </div>
            <div class="btn-group">
                <button @click="decrement"><i class="fa-solid fa-minus"></i></button>
                <div class="item-qty">
                    <span id="qty">{{ item.amount }}</span>
                </div>
                <button @click="increment"><i class="fa-solid fa-plus"></i></button>
            </div>
        </div>
    </div>
</template>
<script>
import { mapGetters } from 'vuex';
export default {
  data() {
    return {
      productData: [],
    }
  },
  computed: {
    ...mapGetters(['cartList']),
  },
  created() {
    this.$store.dispatch("initStorage");
  },
  methods: {
    //增加數量
    increment(e) {
      const clickTitle = e.target.parentNode.parentNode.parentNode.dataset.item;
      // console.log(clickTitle);
      this.$store.commit("addAmount", clickTitle);
    },
    //減少數量
    decrement(e) {
      const clickTitle = e.target.parentNode.parentNode.parentNode.dataset.item;
      // console.log(clickTitle);
      this.$store.commit("minusAmount", clickTitle);
    },
    //刪除商品
    removeFromCart(e) {
      const clickTitle = e.target.parentNode.parentNode.parentNode.parentNode.dataset.item;
      this.$store.commit("removeFromCart", clickTitle);
      console.log(clickTitle);
    },
    
  },
}
</script>
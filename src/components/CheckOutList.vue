<template>
  <div class="orderDetails" >
    <div class="orderItem" v-for="item in cartList" :key="item.id">
      <div class="orderPic">
        <img :src="item.image" alt="">
      </div>
      <div class="orderInfo">
        <div>{{ item.title }}</div>
        <div class="orderQty">
          數量: <span class="qty">{{ item.amount }}</span>
        </div>
        <div class="orderPrice">
          總計: <span class="item-price">{{ item.totalPrice }}</span>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
import { mapGetters } from 'vuex';
export default {
  data(){
    return{
      CheckOutListStatus: true,
    }
  },
  computed: {
    ...mapGetters(['cartList']),
  },
}
</script>
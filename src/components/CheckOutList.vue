<template>
  <table class="orderDetails" >
    <tr class="orderItem" v-for="item in cartList" :key="item.id">
      <td class="orderPic">
        <img :src="item.image" alt="">
      </td>
      <tr class="orderInfo">
        <td style=" width:200px;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;"
        :title="item.title"
        >{{ item.title }}</td>
        <tr class="orderGroup">
          <td class="orderQty" style="width: 80px">
            數量: <span class="qty">{{ item.amount }}</span>
          </td>
          <td class="orderPrice" style="width: 160px">
            總計: <span class="item-price">{{ item.totalPrice }}</span>
          </td>
        </tr>
      </tr>
    </tr>
  </table>
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
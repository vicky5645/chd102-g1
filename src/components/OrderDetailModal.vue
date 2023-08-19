<!-- OrderDetailModal.vue -->
<template>
  <div v-if="isModalVisible" class="modal">
    <div class="modal-content row">
      <!-- 顯示訂單詳情 -->
      <div class="col col-md-6">
        <template v-if="orderDetail.prod_file">
          <Images
            :imgURL="`images/online-mall/${orderDetail.prod_file}`"
            :alt="`${orderDetail.prod_name}`"
          />
        </template>
        <template v-else>
          <Images
            :imgURL="`${orderDetail.image}`"
            :alt="`${orderDetail.title}`"
          />
        </template>
      </div>
      <div class="col col-md-6">
        <!-- <h3>訂單詳情</h3> -->
        <p>訂單編號：{{ orderDetail.order_no }}</p>
        <p>訂單日期：{{ orderDetail.order_date }}</p>
        <!-- 其他訂單詳細內容... -->
        <p v-for="item in orderDetail.description">{{ item }}</p>
        <!-- 關閉按鈕 -->
        <!-- <button @click="closeModal">關閉</button> -->
      </div>
    </div>
  </div>
  <div class="pageMask" v-show="isModalVisible" @click="closeModal"></div>
</template>

<script>
export default {
  props: {
    orderDetail: {
      type: Object,
      required: true,
    },
    isModalVisible: {
      type: Boolean,
      required: true,
    },
  },
  methods: {
    closeModal() {
      this.$emit("close-modal");
    },
  },
};
</script>

<style lang="scss" scoped>
/* 定義彈出視窗 */
.modal {
  // background-color: #fff;
  position: fixed;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  z-index: 100;
}

.pageMask {
  background-color: rgba(black, 0.3);
  width: 100vw;
  height: 100vh;
  position: fixed;
  top: 0;
  left: 0;
  z-index: 99;
}
</style>

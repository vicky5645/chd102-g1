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

<template>
  <!-- 顯示更換頭貼modal -->
  <div v-if="isModalVisible" class="modal">
    <div class="modal-content row">
      <div class="preview">
        <p>圖片預覽</p>
        <Images imgURL="images/tmp/cat.png" alt="" />
      </div>
      <!-- 選圖片上傳-->
      <div class="upload-file">
        <p>新增/變更圖片</p>
        <input type="file" name="memImage" />

        <!-- 更換按鈕 -->
        <div class="wrap">
          <button class="btn small cancel" @click="closeModal">取消</button>
          <button class="btn small save" @click="">儲存</button>
        </div>
      </div>
    </div>
  </div>
  <div class="pageMask" v-show="isModalVisible" @click="closeModal"></div>
</template>

<style lang="scss" scoped>
.modal-content {
  .preview {
    margin: auto;
  }
  .upload-file {
    margin: auto;

    input {
      margin: 1rem 0;
      display: block;
      border: 1px solid black;
    }

    .wrap {
      display: flex;
      justify-content: space-around;
      button {
        color: white;
        border-radius: 10px;
        &.cancel {
          background-color: #d1d5db;
          &:hover {
            background-color: darken(#d1d5db, 20);
          }
        }

        &.save {
          background-color: #302af2;
          &:hover {
            background-color: darken(#302af2, 20);
          }
        }
      }
    }
  }
}

/* 定義彈出視窗 */
.modal {
  //   background-color: ;
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

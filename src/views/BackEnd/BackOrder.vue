<!-- 後台商品訂單 -->

<template>
  <!-- select bar -->
  <div class="search_new">
    <div class="input-group">
      <input
        v-model="searchText"
        type="text"
        class="form-control"
        placeholder="輸入文字查詢"
        aria-label="Search"
      />
    </div>
  </div>

  <table class="table">
    <thead>
      <tr>
        <th scope="col">商品訂單編號</th>
        <th scope="col">商品訂購日期</th>
        <th scope="col">會員編號</th>
        <th scope="col">商品訂單金額</th>
        <th scope="col">訂單出貨狀態</th>
        <th scope="col">收件人</th>
        <th scope="col">收件人電話</th>
        <th scope="col">收件地址</th>
        <th scope="col">付款方式</th>
        <th scope="col"></th>
      </tr>
    </thead>
    <tbody>
      <tr v-for="(item, index) in filteredItems" :key="item.order_no">
        <th scope="col">{{ item.order_no }}</th>
        <td scope="col">{{ item.order_date }}</td>
        <td scope="col">{{ item.mem_no }}</td>
        <td scope="col">{{ item.order_total }}</td>
        <td scope="col">{{ OrderStatus(item) }}</td>
        <td scope="col">{{ item.recipient }}</td>
        <td scope="col">{{ item.recipient_tele }}</td>
        <td scope="col">{{ item.recipient_address }}</td>
        <td scope="col">{{ OrderPayType(item) }}</td>
        <td style="text-align: right">
          <button
            type="button"
            class="btn btn-outline-primary"
            style="margin-left: auto"
            @click="openModal(item)"
          >
            查看
          </button>
        </td>
      </tr>
      
    </tbody>
    <!-- <tbody>
      <tr v-for="(item, index) in filteredItems" :key="index">
        <th scope="row">{{ item.id }}</th>
        <td class="ellipsis">{{ item.name }}</td>
        <td class="ellipsis">{{ item.qty }}</td>
        <td style="text-align: right">
          <button
            type="button"
            class="btn btn-outline-primary"
            style="margin-left: auto"
            @click="openModal(item)"
          >
            查看
          </button>
        </td>
      </tr>
    </tbody> -->

    <p v-if="filteredItems.length === 0" class="text-danger">
      * 沒有找到符合搜尋條件的結果
    </p>
  </table>
  <!-- footer page-->
  <nav aria-label="Page navigation example">
  <ul class="pagination justify-content-center">
    <li class="page-item" v-for="index in newPage" :key="index">
      <button class="page-link" @click="page = index"> {{ index }} </button>
    </li>
  </ul>
</nav>

<!-- edit modal -->
<div
    v-show="showModal"
    class="modal fade"
    id="itemModal"
    tabindex="-1"
    aria-labelledby="itemModalLabel"
    aria-hidden="true"
  >
    <div class="modal-dialog" style="max-width: 80%">
      <div class="modal-content" style="margin: auto">
        <div class="modal-header">
          <h5 class="modal-title" id="itemModalLabel">訂單詳細資訊</h5>
          <button
            type="button"
            class="btn-close"
            data-bs-dismiss="modal"
            aria-label="Close"
            @click="cancelChanges"
          ></button>
        </div>

        <!-- modal body -->
        <div
          style="display: flex; flex-direction: column"
          class="modal-body gap-2"
        >
          <div class="input-group input-group-lg">
            <span class="input-group-text" id="inputGroup-sizing-lg"
              >商品編號</span
            >
            <input
              disabled
              v-model="currentItem.order_no"
              type="text"
              class="form-control"
              aria-label="Sizing example input"
              aria-describedby="inputGroup-sizing-lg"
            />
          </div>
          <div class="input-group input-group-lg">
            <span class="input-group-text" id="inputGroup-sizing-lg"
              >商品訂購日期</span
            >
            <input
              disabled
              v-model="currentItem.order_date"
              name="order_order_date"
              type="text"
              class="form-control"
              aria-label="Sizing example input"
              aria-describedby="inputGroup-sizing-lg"
            />
          </div>
          <div class="input-group input-group-lg">
            <span class="input-group-text" id="inputGroup-sizing-lg"
              >會員編號
            </span>
            <input
                  disabled
                  v-model="currentItem.mem_no"
                  name="order_mem_no"
                  type="text"
                  class="form-control"
                  aria-label="Sizing example input"
                  aria-describedby="inputGroup-sizing-lg"
                />
          </div>
          <div class="input-group input-group-lg">
            <span class="input-group-text" id="inputGroup-sizing-lg"
              >商品訂單金額</span
            >
            <input
            disabled
              v-model="currentItem.order_total"
              name="order_order_total"
              type="text"
              class="form-control"
              aria-label="Sizing example input"
              aria-describedby="inputGroup-sizing-lg"
            />
          </div>

          <div class="input-group input-group-lg">
            <span class="input-group-text" id="inputGroup-sizing-lg"
              >訂單出貨狀態</span
            >
            <select class="form-select" v-model="currentItem.order_status">
              <option value="0">準備中</option>
              <option value="1">配送中</option>
            </select>
          </div>
          <div class="input-group input-group-lg">
            <span class="input-group-text" id="inputGroup-sizing-lg"
              >收件人</span
            >
                <input
                  v-model="currentItem.recipient"
                  name="order_recipient"
                  type="text"
                  class="form-control"
                  aria-label="Sizing example input"
                  aria-describedby="inputGroup-sizing-lg"
                />
          </div>

          <div class="input-group input-group-lg">
                <span class="input-group-text" id="inputGroup-sizing-lg"
                  >收件人電話</span
                >
                <input
                  v-model="currentItem.recipient_tele"
                  name="order_recipient_tele"
                  type="number"
                  class="form-control"
                  aria-label="Sizing example input"
                  aria-describedby="inputGroup-sizing-lg"
                />
              </div>

          <div class="input-group input-group-lg">
            <span class="input-group-text" id="inputGroup-sizing-lg"
              >收件地址</span
            >
            <input
              v-model="currentItem.recipient_address"
              name="order_recipient_address"
              type="text"
              class="form-control"
              aria-label="Sizing example input"
              aria-describedby="inputGroup-sizing-lg"
            />
          </div>
          <div class="input-group input-group-lg">
                <span class="input-group-text" id="inputGroup-sizing-lg"
                  >付款方式</span
                >
                <input
                  disabled
                  v-model="currentItemPayType"
                  type="text"
                  class="form-control"
                  aria-label="Sizing example input"
                  aria-describedby="inputGroup-sizing-lg"
                />
              </div>
        </div>

        <div class="modal-footer">
          <button
            type="button"
            class="btn btn-danger"
            data-bs-dismiss="modal"
            @click="deleteOrder"
          >
            刪除訂單
          </button>
          <button
            type="button"
            class="btn btn-primary"
            data-bs-dismiss="modal"
            @click="saveChanges"
          >
            儲存變更
          </button>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import axios from "axios";
import { BASE_URL } from "@/assets/js/common.js";
import { Modal } from "bootstrap";

export default {
  data() {
    return {
      dataFromMySQL: [],
      productOrderData: [],
      page: 1,
      // search
      searchText: "",
      // model
      currentItem: {
        order_no: "", //商品訂單編號 PK
        order_date: "", //商品訂購日期
        mem_no: "", //會員編號 FK
        order_total: "", //商品訂單金額
        order_status: "", //訂單出貨狀態
        recipient: "", //收件人
        recipient_tele: "", //收件人電話
        recipient_address: "", //收件地址
        pay: "" //付款方式 0:信用卡 1:取貨付款
      },
      backupItem: {},
      showModal: false,
      selectedFile: null,
    };
  },

  computed: {
    //search
    filteredItems() {
      if (this.searchText === "") {
        return this.productOrderData;
      }

      return this.productOrderData.filter((item) =>
        Object.values(item).some((val) => String(val).includes(this.searchText))
      );
    },
    newPage() {
      return Math.ceil(this.filteredItems.length / 10);
    },
    newFilteredItems() {
      const begin = (this.page - 1) * 10
      const end = this.page * 10
      return this.filteredItems.slice(begin, end);
    },
    currentItemPayType() {
      return this.currentItem.pay === 0 ? '信用卡' : '取貨付款';
    },
    currentItemStatus() {
      return this.currentItem.order_status === 0 ? '準備中' : '配送中';
    },
  },

  created () {
    this.getData();
  },

  methods: {
    // model
    saveChanges() {
      // 在這裡更新資料
      // 如有需要，你也可以將 currentItem 傳到後端
      this.currentItem = { ...this.backupItem };
      this.showModal = false;
    },
    OrderPayType(item) {
      return item.pay === 0 ? '信用卡' : '取貨付款';
    },
    OrderStatus(item) {
      return item.order_status === 0 ? '準備中' : '配送中';
    },
    //抓資料
      getData() {
      this.$store.state.Loading = true
      axios
      .get(`${BASE_URL}getProductOrder.php`)
      .then((response) => {
        this.dataFromMySQL = response.data;
        this.productOrderData = this.dataFromMySQL.map((item) =>{
          item.order_no = parseInt(item.order_no),
          item.order_date = item.order_date.split(" ")[0];
          item.mem_no = parseInt(item.mem_no),
          item.order_total = parseInt(item.order_total),
          item.order_status = parseInt(item.order_status);
          item.pay = parseInt(item.pay);
          return item;
      })
      console.log('success')
      console.log(this.productOrderData);
      })
      .catch((error) => {
        console.error("There was an error fetching the data:", error);
      });
      setTimeout(() => {
        this.$store.commit('closeLoading')
      }, 300)
    },
    cancelChanges() {
      this.showModal = false;
    },
    // openModal(item) {
    //   this.currentItem = item;
    //   this.showModal = true;

    //   this.$nextTick(() => {
    //     const modalElement = document.getElementById("itemModal");
    //     const modalInstance = new Modal(modalElement);
    //     modalInstance.show();

    //     modalElement.addEventListener("hide.bs.modal", () => {
    //       this.showModal = false;
    //     });
    //   });
    // },
    openModal(item) {
      this.currentItem = { ...item }; //一層深拷貝
      this.showModal = true;

      this.$nextTick(() => {
        const modalElement = document.getElementById("itemModal");
        const modalInstance = new Modal(modalElement);
        modalInstance.show();

        modalElement.addEventListener("hide.bs.modal", () => {
          this.showModal = false;
        });
      });
    },
    handleFileUpload(event) {
      const files = event.target.files;
      if (files.length === 0) {
        return;
      }

      const file = files[0];
      const reader = new FileReader();

      reader.onload = (e) => {
        this.currentItem.image = e.target.result;
      };
      reader.readAsDataURL(file);
    },

    // new model
    submitAnnouncement() {
      if (
        !this.newAnnouncement.id ||
        !this.newAnnouncement.name ||
        !this.newAnnouncement.qty
      ) {
        alert("所有欄位都必須填寫！");
        return;
      }

      console.log(this.newAnnouncement);
      this.clearAnnouncement();
      this.newAnnouncement = {
        id: "",
        name: "",
        qty: "",
      };
      const modalEl = document.getElementById("itemNewModal");
      const modalInstance = Modal.getInstance(modalEl);
      modalInstance.hide();
    },

    clearAnnouncement() {
      this.newAnnouncement = {
        id: "",
        name: "",
        qty: "",
      };
    },

    // delete announcement
    deleteAnnouncement() {
      const index = this.items.findIndex(
        (item) => item.id === this.currentItem.id
      );
      if (index !== -1) {
        this.items.splice(index, 1);
        this.showModal = false;
      }
    },
        // 刪除訂單
        async deleteOrder() {
      this.$store.state.Loading = true
      try {
        const index = this.productOrderData.findIndex((item) => item.order_no === this.currentItem.order_no);
        if (index !== -1) {
          const res = await axios({
            method: 'post',
            url: `${BASE_URL}deleteBackendOrder.php`,
            data: {
              order_no: this.currentItem.order_no,
              },
          });
          alert(`${res.data.msg}`)
        }
      } catch (error) {
        console.error("An error occurred:", error);
        alert("刪除失敗請重新操作")
      }
      this.getData();
      this.showModal = false;
    },
        //儲存變更
        async saveChanges() {
      this.$store.state.Loading = true
      try {
        // const index = this.productData.findIndex((item) => item.order_no === this.currentItem.order_no);
        // if (index !== -1) {
          const res = await axios({
            method: 'post',
            url: `${BASE_URL}updateBackendOrder.php`,
            data: {
              order_no: this.currentItem.order_no, //商品訂單編號 PK
              order_status: this.currentItem.order_status, //訂單出貨狀態
              recipient: this.currentItem.recipient, //收件人
              recipient_tele: this.currentItem.recipient_tele, //收件人電話
              recipient_address: this.currentItem.recipient_address, //收件地址
            }
          });
          alert(`${res.data.msg}`)
        // }

      } catch (error) {
        console.error("An error occurred:", error);
        alert("修改失敗請重新操作")
      }

      this.getData();
      this.showModal = false;
    },
  },
};
</script>

<style lang="scss" scoped>

thead{
    th {
    font-weight: 700;
  }
}
tbody{
    th {
    font-weight: 400;
  }
}

.search_new {
  display: flex;
  gap: 12px;
  margin-bottom: 12px;

  .b_new {
    white-space: nowrap;
  }
}
.ellipsis {
  overflow: hidden;
  text-overflow: ellipsis;
  white-space: nowrap;
  max-width: 80px; // 設定你希望的寬度
}
.model_body_pic {
  width: 100%;
  img {
    width: 100%;
    height: 100%;
    object-fit: cover;
  }
}

h5 {
  margin-bottom: 0;
}

.modal-footer {
  justify-content: center;
}

input[type="number"]::-webkit-outer-spin-button,
input[type="number"]::-webkit-inner-spin-button {
    -webkit-appearance: none;
    margin: 0;
}

</style>

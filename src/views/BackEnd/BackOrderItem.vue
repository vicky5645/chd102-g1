<!-- 後台商品訂單項目 -->

<template>
  <!-- {{ dataFromMySQL }} -->
  <!-- select bar -->
  <div class="search_new">
    <div class="input-group">
      <input v-model="searchText" type="text" class="form-control" placeholder="輸入文字查詢" aria-label="Search" />
    </div>
  </div>

  <table class="table">
    <thead>
      <tr>
        <th scope="col">訂單編號</th>
        <th scope="col">商品類型</th>
        <th scope="col">訂單總價</th>
        <th scope="col">商品數量</th>
        <th scope="col">訂單日期</th>
      </tr>
    </thead>
    <tbody>
      <tr v-for="(item, index) in filteredItems" :key="item.productOrderNumber">
        <td scope="row">{{ item.order_no }}</td>
        <td class="ellipsis">{{ item.prod_name }}</td>
        <td class="ellipsis">{{ item.price * item.quantity}}</td>
        <td class="ellipsis">{{ item.quantity }}</td>
        <td class="ellipsis">{{ item.order_date }}</td>
        <!-- <td style="text-align: right">
          <button
            type="button"
            class="btn btn-outline-primary"
            style="margin-left: auto"
            @click="openModal(item)"
          >
            查看
          </button>
        </td> -->
      </tr>
      <!-- <tr v-for="(item, index) in filteredItems" :key="item.productOrderNumber">
        <th scope="row">{{ item.productOrderNumber }}</th>
        <td class="ellipsis">{{ item.productItem }}</td>
        <td class="ellipsis">{{ item.price }}</td>
        <td class="ellipsis">{{ item.quantity }}</td>
        <td class="ellipsis">{{ item.date }}</td> -->
        <!-- <td style="text-align: right">
          <button
            type="button"
            class="btn btn-outline-primary"
            style="margin-left: auto"
            @click="openModal(item)"
          >
            查看
          </button>
        </td> -->
      <!-- </tr> -->
    </tbody>

    <p v-if="filteredItems.length === 0" class="text-danger">
      * 沒有找到符合搜尋條件的結果
    </p>
  </table>
</template>

<script>
import { Modal } from "bootstrap";
import axios from "axios";
import { BASE_URL } from "@/assets/js/common.js";

export default {
  data() {
    return {
      dataFromMySQL: [],
      // dataFromMySQL: [
      //   {
      //     order_date: '2024-02-11',
      //     order_no: 202402231,
      //     price: ,
      //     productItem: '列車模型',
      //     prod_no: ,
      //     prod_price: 1000,
      //     quantity: 3,
      //   },
      //   {
      //     order_date: '2024-02-13',
      //     order_no: 202402351,
      //     price: ,
      //     productItem: "火車懷錶",
      //     prod_no: ,
      //     prod_price: 2000,
      //     quantity: 2,
      //   },
      //   {
      //     order_date: '2024-02-13',
      //     order_no: 202402683,
      //     price: ,
      //     productItem: "超讚大獎章",
      //     prod_no: ,
      //     prod_price: 3000,
      //     quantity: 6,
      //   },
      // ],
      items: [
        {
          productOrderNumber: 202402231,
          productItem: '列車模型',
          price: 1000,
          quantity: 3,
          date: '2024-02-11'
        },
        {
          productOrderNumber: 202402351,
          productItem: "火車懷錶",
          price: 2000,
          quantity: 2,
          date: '2024-02-13'
        },
        {
          productOrderNumber: 202402683,
          productItem: "超讚大獎章",
          price: 3000,
          quantity: 6,
          date: '2024-02-13'
        },
      ],
      // search
      searchText: "",
      // model
      currentItem: {},
      backupItem: {},
      showModal: false,
      selectedFile: null,
      // new model
      newAnnouncement: {
        id: "", // 確保 id 屬性存在
        name: "",
        qty: "",
      },
    };
  },

  computed: {
    // search
    filteredItems() {
      if (this.searchText === "") {
        return this.dataFromMySQL;
      }

      return this.dataFromMySQL.filter((item) =>
        Object.values(item).some((val) => String(val).includes(this.searchText))
      );
    },
    // filteredItems() {
    //   if (this.searchText === "") {
    //     return this.items;
    //   }

    //   return this.items.filter((item) =>
    //     Object.values(item).some((val) => String(val).includes(this.searchText))
    //   );
    // },
  },

  methods: {
    // model
    saveChanges() {
      // 在這裡更新資料
      // 如有需要，你也可以將 currentItem 傳到後端
      this.currentItem = { ...this.backupItem };
      this.showModal = false;
    },

    cancelChanges() {
      this.currentItem = { ...this.backupItem };
      this.showModal = false;
    },
    openModal(item) {
      this.currentItem = item;
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
    //取資料
    async getdataFromMySQL() {
      await axios
        .get(`${BASE_URL}getOrderItem.php`)
        .then((response) => {
          this.dataFromMySQL = response.data;

          // 確認是否成功
          // console.log("Data retrieved from MySQL:", "dataFromMySQL");
        })
        .catch((error) => {
          console.error("There was an error fetching the data:", error);
        });
    },
  },
  created() {
    this.getdataFromMySQL();
  },
};
</script>

<style lang="scss" scoped>
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
</style>

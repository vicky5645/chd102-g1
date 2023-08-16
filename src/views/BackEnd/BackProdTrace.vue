<!-- 商品收藏管理 -->
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
        <th scope="col">會員編號</th>
        <th scope="col">商品編號</th>
        <th scope="col"></th>
      </tr>
    </thead>
    <tbody>
      <tr v-for="(item, index) in paginatedItems" :key="index">
        <th scope="row">{{ item.mem_no }}</th>
        <td class="ellipsis">{{ item.prod_no }}</td>
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

    <!-- page -->

    <p v-if="filteredItems.length === 0" class="text-danger">
      * 沒有找到符合搜尋條件的結果
    </p>
  </table>

  <nav aria-label="Page navigation example">
    <ul class="pagination justify-content-center gap-2">
      <li class="page-item">
        <a class="page-link" @click="prevPage">&laquo;</a>
      </li>
      <li class="page-item">
        <a class="page-link disabled" style="border: none; background: #fff"
          >第{{ currentPage }}頁</a
        >
      </li>
      <!-- <li class="page-item"><a class="page-link" href="#">2</a></li>
        <li class="page-item"><a class="page-link" href="#">3</a></li> -->
      <li class="page-item">
        <a class="page-link" @click="nextPage">&raquo;</a>
      </li>
    </ul>
  </nav>

  <!-- modal -->
  <div
    v-if="showModal"
    class="modal fade"
    id="itemModal"
    tabindex="-1"
    aria-labelledby="itemModalLabel"
    aria-hidden="true"
  >
    <div class="modal-dialog" style="max-width: auto">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="itemModalLabel">查看商品收藏</h5>
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
              >會員編號</span
            >
            <input
              v-model="currentItem.mem_no"
              type="text"
              class="form-control"
              aria-label="Sizing example input"
              aria-describedby="inputGroup-sizing-lg"
            />
          </div>
          <div class="input-group input-group-lg">
            <span class="input-group-text" id="inputGroup-sizing-lg"
              >商品編號</span
            >
            <input
              v-model="currentItem.prod_no"
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
            class="btn btn-primary"
            data-bs-dismiss="modal"
            @click="saveChanges"
          >
            儲存變更
          </button>
          <button
            type="button"
            class="btn btn-danger"
            data-bs-dismiss="modal"
            @click="deleteMessage"
          >
            刪除
          </button>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { Modal } from "bootstrap";
import axios from "axios";
import { BASE_URL } from "@/assets/js/common.js";

export default {
  data() {
    return {
      dataFromMySQL: [],
      // items: [
      //   {
      //     memNo: 1,
      //     prodNo: 3,
      //   },
      //   {
      //     memNo: 1,
      //     prodNo: 2,
      //   },
      //   {
      //     memNo: 1,
      //     prodNo: 1,
      //   },
      //   {
      //     memNo: 3,
      //     prodNo: 3,
      //   },
      //   {
      //     memNo: 7,
      //     prodNo: 3,
      //   },
      //   {
      //     memNo: 12,
      //     prodNo: 2,
      //   },
      //   {
      //     memNo: 15,
      //     prodNo: 3,
      //   },
      //   {
      //     memNo: 16,
      //     prodNo: 3,
      //   },
      //   {
      //     memNo: 19,
      //     prodNo: 3,
      //   },
      //   {
      //     memNo: 22,
      //     prodNo: 2,
      //   },
      //   {
      //     memNo: 26,
      //     prodNo: 1,
      //   },
      // ],
      // search
      searchText: "",
      // model
      currentItem: {},
      backupItem: {},
      showModal: false,
      selectedFile: null,

      // page
      currentPage: 1,
      itemsPerPage: 10,
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
    paginatedItems() {
      const start = (this.currentPage - 1) * this.itemsPerPage;
      const end = start + this.itemsPerPage;
      return this.filteredItems.slice(start, end);
    },
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
    // delete message
    deleteMessage() {
      const index = this.items.findIndex(
        (item) => item.id === this.currentItem.id
      );
      if (index !== -1) {
        this.items.splice(index, 1);
        this.showModal = false;
      }
    },

    // page
    prevPage() {
      if (this.currentPage > 1) this.currentPage--;
    },
    nextPage() {
      if (
        this.currentPage <
        Math.ceil(this.filteredItems.length / this.itemsPerPage)
      )
        this.currentPage++;
    },
    //取資料
    async getdataFromMySQL() {
      await axios
        .get(`${BASE_URL}getProdTrace.php`)
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

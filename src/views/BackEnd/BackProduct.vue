<!-- 後台商品 -->

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
    <button
      class="btn btn-outline-primary b_new"
      type="button"
      id="button-addon2"
      data-bs-toggle="modal"
      data-bs-target="#itemNewModal"
    >
      新增商品
    </button>
  </div>

  <table class="table">
    <thead>
      <tr>
        <th scope="col">商品編號</th>
        <th scope="col">商品名稱</th>
        <th scope="col">商品介紹</th>
        <th scope="col">商品價格</th>
        <th scope="col">商品狀態</th>
        <th scope="col">商品圖片</th>

        <th scope="col"></th>
      </tr>
    </thead>
    <tbody>
      <tr v-for="(item, index) in productData" :key="index">
        <th scope="row">{{ item.prod_no }}</th>
        <td class="ellipsis">{{ item.prod_name }}</td>
        <td class="ellipsis">{{ item.prod_summary }}</td>
        <td class="ellipsis">{{ item.prod_price }}</td>
        <td class="ellipsis">{{ item.prod_status }}</td>
        <td class="ellipsis">{{ item.prod_file }}</td>
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

    <p v-if="filteredItems.length === 0" class="text-danger">
      * 沒有找到符合搜尋條件的結果
    </p>
  </table>

<!-- edit modal -->
  <form
    action="http://localhost:80/phps/editProduct.php"
    method="post"
    enctype="multipart/form-data"
    v-if="showModal"
    class="modal fade"
    id="itemModal"
    tabindex="-1"
    aria-labelledby="itemModalLabel"
    aria-hidden="true"
  >
    <div class="modal-dialog" style="max-width: 80%">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="itemModalLabel">修改客製車票圖案</h5>
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
              v-model="currentItem.pattern_no"
              type="text"
              class="form-control"
              aria-label="Sizing example input"
              aria-describedby="inputGroup-sizing-lg"
            />
          </div>
          <div class="input-group input-group-lg">
            <span class="input-group-text" id="inputGroup-sizing-lg"
              >圖案名稱</span
            >
            <input
              v-model="currentItem.pattern_name"
              name="pattern_name"
              type="text"
              class="form-control"
              aria-label="Sizing example input"
              aria-describedby="inputGroup-sizing-lg"
            />
          </div>
          <div class="input-group input-group-lg">
            <span class="input-group-text" id="inputGroup-sizing-lg"
              >圖案描述</span
            >
            <input
              v-model="currentItem.pattern_desc"
              name="pattern_desc"
              type="text"
              class="form-control"
              aria-label="Sizing example input"
              aria-describedby="inputGroup-sizing-lg"
            />
          </div>

          <div class="input-group input-group-lg">
            <span class="input-group-text" id="inputGroup-sizing-lg"
              >創建日期</span
            >
            <input
              disabled
              v-model="currentItem.creation_date"
              type="text"
              class="form-control"
              aria-label="Sizing example input"
              aria-describedby="inputGroup-sizing-lg"
            />
          </div>
          <div class="input-group input-group-lg">
            <span class="input-group-text" id="inputGroup-sizing-lg"
              >圖案檔案</span
            >
            <input
              disabled
              v-model="currentItem.pattern_file"
              name="pattern_file"
              type="text"
              class="form-control"
              aria-label="Sizing example input"
              aria-describedby="inputGroup-sizing-lg"
            />
          </div>
          <div class="input-group input-group-lg">
            <span class="input-group-text" id="inputGroup-sizing-lg"
              >上傳檔案</span
            >
            <input
              type="file"
              class="form-control"
              id="inputGroupFile02"
              @change="handleFileUpload"
            />
          </div>
          <div class="model_body_pic">
            <Images
              v-if="currentItem.pattern_file"
              :imgURL="`${currentItem.pattern_file}`"
              :alt="`Image preview`"
            />
          </div>
        </div>

        <div class="modal-footer">
          <button
            type="button"
            class="btn btn-danger"
            data-bs-dismiss="modal"
            @click="deleteAnnouncement"
          >
            刪除圖案
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
  </form>

  <!-- new modal -->
  <div
    class="modal fade"
    id="itemNewModal"
    tabindex="-1"
    aria-labelledby="itemModalLabel"
    aria-hidden="true"
  >
  <form
    action="http://localhost:80/phps/postProduct.php"
    method="post"
    enctype="multipart/form-data"
    class="modal fade"
    id="itemNewModal"
    tabindex="-1"
    aria-labelledby="itemModalLabel"
    aria-hidden="true"
  >
    <div class="modal-dialog" style="max-width: 80%">
      <div class="modal-content">
        <div class="modal-header">
          <h5 name="header">新增商品</h5>
        </div>

        <div class="modal-body">
          <slot name="body">
            <div
              class="modal-body gap-2"
              style="display: flex; flex-direction: column"
            >
              <div class="input-group input-group-lg">
                <span class="input-group-text" id="inputGroup-sizing-lg"
                  >商品編號</span
                >
                <input
                  v-model="newProduct.prod_no"
                  type="text"
                  class="form-control"
                  aria-label="Sizing example input"
                  aria-describedby="inputGroup-sizing-lg"
                />
              </div>

              <div class="input-group input-group-lg">
                <span class="input-group-text" id="inputGroup-sizing-lg"
                  >商品名稱</span
                >
                <input
                  v-model="newProduct.prod_name"
                  type="text"
                  class="form-control"
                  aria-label="Sizing example input"
                  aria-describedby="inputGroup-sizing-lg"
                />
              </div>

              <div class="input-group input-group-lg">
                <span class="input-group-text" id="inputGroup-sizing-lg"
                  >商品介紹</span
                >
                <input
                  v-model="newProduct.prod_summary"
                  type="text"
                  class="form-control"
                  aria-label="Sizing example input"
                  aria-describedby="inputGroup-sizing-lg"
                />
              </div>

              <div class="input-group input-group-lg">
                <span class="input-group-text" id="inputGroup-sizing-lg"
                  >商品價格</span
                >
                <input
                  v-model="newProduct.prod_price"
                  type="text"
                  class="form-control"
                  aria-label="Sizing example input"
                  aria-describedby="inputGroup-sizing-lg"
                />
              </div>

              <div class="input-group input-group-lg">
                <span class="input-group-text" id="inputGroup-sizing-lg"
                  >商品狀態</span
                >
                <input
                  v-model="newProduct.prod_status"
                  type="text"
                  class="form-control"
                  aria-label="Sizing example input"
                  aria-describedby="inputGroup-sizing-lg"
                />
              </div>

              <div class="input-group input-group-lg">
                <span class="input-group-text" id="inputGroup-sizing-lg"
                  >商品圖片</span
                >
                <input
                  type="file"
                  class="form-control"
                  aria-label="Sizing example input"
                  aria-describedby="inputGroup-sizing-lg"
                  @change="handleFileUpload"
                />
              </div>
            </div>
          </slot>
        </div>

        <div class="modal-footer">
          <slot name="footer">
            <button
              class="btn btn-secondary"
              data-bs-dismiss="modal"
              @click="clearProduct()"
            >
              取消
            </button>
            <button class="btn btn-primary" @click="submitProduct()">
              確定新增
            </button>
          </slot>
        </div>
      </div>
    </div>
    </form>
  </div>
  <div>{{ productData }}</div>
</template>

<script>
import axios from "axios";
import { Modal } from "bootstrap";
import { BASE_URL } from "@/assets/js/common.js";

export default {
  data() {
    return {
      productData: [],
      items: [
        {
          // id: 1,
          // name: "綠野號",
          // qty: 40,
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
      newProduct: {
        prod_no: "", // 確保 id 屬性存在
        prod_name: "",
        prod_summary: "",
        prod_price: "",
        prod_status: "",
        prod_file: "",
      },
    };
  },

  computed: {
    // search
    filteredItems() {
      if (this.searchText === "") {
        return this.items;
      }

      return this.items.filter((item) =>
        Object.values(item).some((val) => String(val).includes(this.searchText))
      );
    },
  },

  methods: {
    // model

    //儲存變更
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
      console.log(file.name);

      reader.onload = (e) => {
        this.currentItem.image = e.target.result;
      };
      reader.readAsDataURL(file);
    },

    // new model
    submitProduct() {
      if (
        !this.newProduct.prod_no ||
        !this.newProduct.prod_name ||
        !this.newProduct.prod_summary ||
        !this.newProduct.prod_price ||
        !this.newProduct.prod_status ||
        !this.newProduct.prod_file
      ) {
        alert("所有欄位都必須填寫！");
        return;
      }

      console.log(this.newProduct);
      this.clearProduct();
      const modalEl = document.getElementById("itemNewModal");
      const modalInstance = Modal.getInstance(modalEl);
      modalInstance.hide();
    },

    clearProduct() {
      this.newProduct = {
        prod_no: "",
        prod_name: "",
        prod_summary: "",
        prod_price: "",
        prod_status: "",
        prod_file: "",
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
  },
  mounted() {
    axios
      .get(`${BASE_URL}/getProduct.php`)
      .then((response) => {
        this.productData = response.data;
      })
      .catch((error) => {
        console.error("There was an error fetching the data:", error);
      });
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

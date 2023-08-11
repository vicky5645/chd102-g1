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
      @click="getNewProductId"
    >
      新增商品
    </button>
  </div>

  <table class="table">
    <thead>
      <tr>
        <th scope="col">商品編號</th>
        <th scope="col">商品名稱</th>
        <th scope="col">商品類型</th>
        <th scope="col">商品介紹</th>
        <th scope="col">商品價格</th>
        <th scope="col">商品狀態</th>
        <th scope="col">熱銷商品</th>
        <th scope="col">商品圖片</th>

        <th scope="col"></th>
      </tr>
    </thead>
    <tbody>
      <tr v-for="(item, index) in filteredItems" :key="index">
        <th scope="row">{{ item.prod_no }}</th>
        <td class="ellipsis" :title="item.prod_name">{{ item.prod_name }}</td>
        <td class="ellipsis" :title="item.prod_name">{{ item.prod_type }}</td>
        <td class="ellipsis" :title="item.prod_summary">{{ item.prod_summary }}</td>
        <td class="ellipsis">{{ item.prod_price }}</td>
        <!-- <td class="ellipsis">{{ item.prod_status }}</td> -->
        <td class="ellipsis" 
        :style="{color: productStatusColor(item)}"
        >{{ productStatus(item) }}</td>
        <td class="ellipsis">{{ item.prod_hot === 1 ? "是" : "否"}}</td>
        <td class="ellipsis" :title="item.prod_file">{{ item.prod_file }}</td>
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
      <div class="modal-content" style="margin: auto">
        <div class="modal-header">
          <h5 class="modal-title" id="itemModalLabel">修改商品資訊</h5>
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
              v-model="currentItem.prod_no"
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
              v-model="currentItem.prod_name"
              name="pattern_name"
              type="text"
              class="form-control"
              aria-label="Sizing example input"
              aria-describedby="inputGroup-sizing-lg"
            />
          </div>
          <div class="input-group input-group-lg">
            <span class="input-group-text" id="inputGroup-sizing-lg"
              >商品類型</span
            >
            <select class="form-select" v-model="currentItem.prod_type">
              <option value="周邊">周邊</option>
              <option value="玩具">玩具</option>
              <option value="食品">食品</option>
              <option value="圖書">圖書</option>
            </select>
          </div>
          <div class="input-group input-group-lg">
            <span class="input-group-text" id="inputGroup-sizing-lg"
              >商品介紹</span
            >
            <input
              v-model="currentItem.prod_summary"
              name="pattern_desc"
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
              v-model="currentItem.prod_price"
              type="number"
              class="form-control"
              aria-label="Sizing example input"
              aria-describedby="inputGroup-sizing-lg"
            />
          </div>
          <div class="input-group input-group-lg">
            <span class="input-group-text" id="inputGroup-sizing-lg"
              >商品狀態</span
            >
            <select class="form-select">
              <option value="1">上架</option>
              <option value="0">下架</option>
            </select>
          </div>

          <div class="input-group input-group-lg">
                <span class="input-group-text" id="inputGroup-sizing-lg"
                  >熱銷商品</span
                >
                <select class="form-select" v-model="currentItem.prod_hot">
                  <option value="1">是</option>
                  <option value="0">否</option>
                </select>
              </div>

          <div class="input-group input-group-lg">
            <span class="input-group-text" id="inputGroup-sizing-lg"
              >商品圖片</span
            >
            <input
              disabled
              v-model="currentItem.prod_file"
              name="pattern_file"
              type="text"
              class="form-control"
              aria-label="Sizing example input"
              aria-describedby="inputGroup-sizing-lg"
            />
          </div>
          <div class="input-group input-group-lg">
            <span class="input-group-text" id="inputGroup-sizing-lg"
              >更改圖檔</span
            >
            <input
              type="file"
              class="form-control"
              @change="handleFileUpload"
            />
          </div>
          <div class="model_body_pic">
            <Images
              v-if="currentItem.prod_file"
              :imgURL="`images/online-mall/${currentItem.prod_file}`"
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

  <form
    class="modal fade"
    id="itemNewModal"
    tabindex="-1"
    aria-labelledby="itemModalLabel"
    aria-hidden="true"
  >
    <div class="modal-dialog" style="max-width: 80%">
      <div class="modal-content" style="margin: auto">
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
                  disabled
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
              >商品類型</span
            >
            <select class="form-select" 
            v-model="newProduct.prod_type"
            name
            >
              <option value="周邊">周邊</option>
              <option value="玩具">玩具</option>
              <option value="食品">食品</option>
              <option value="圖書">圖書</option>
            </select>
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
                <select class="form-select" v-model="newProduct.prod_status">
              <!-- <option selected>未設定</option> -->
                  <option value="1">上架</option>
                  <option value="0">下架</option>
                </select>
              </div>

              <div class="input-group input-group-lg">
                <span class="input-group-text" id="inputGroup-sizing-lg"
                  >熱銷商品</span
                >
                <select class="form-select" v-model="newProduct.prod_hot">
                  <option value="1">是</option>
                  <option value="0">否</option>
                </select>
              </div>

              <div class="input-group input-group-lg">
                <span class="input-group-text" id="inputGroup-sizing-lg"
                  >商品圖片</span
                >
                <input
                  type="file"
                  class="form-control"
                  name="new_img"
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
    {{ newProduct }}
    <!-- <hr> -->
    <!-- <div v-if="dataFromMySQL.length > 0"> -->
      <!-- {{ dataFromMySQL[dataFromMySQL.length - 1].prod_no }} -->
      <!-- {{ getNewProductId }}
    </div> -->
</template>
<script>
import axios from "axios";
import { Modal } from "bootstrap";
import { BASE_URL } from "@/assets/js/common.js";

export default {
  data() {
    return {
      //後台抓取的商品資料
      dataFromMySQL: [],
      // search
      searchText: "",
      // model
      currentItem: {},
      showModal: false,
      selectedFile: null,
      // new model
      newProduct: {
        prod_no: "", // 確保 id 屬性存在
        prod_name: "",
        prod_summary: "",
        prod_price: "",
        prod_status: "",
        prod_file: "test.png",
        prod_type: "",
        prod_hot: "",
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
    //新增商品時的新ID
    getNewProductId() {
      this.newProduct.prod_no = parseInt(this.dataFromMySQL[this.dataFromMySQL.length - 1].prod_no) + 1;
    }
  },

  methods: {
    // ------------edit model-----------

    //點選查看，將此物品賦值給currentItem
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

    //按x的時候取消變更
    cancelChanges() {
      this.showModal = false;
    },

    //儲存變更
    saveChanges() {
      this.showModal = false;
    },

    //變更圖檔(共用)
    handleFileUpload(event) {
      const files = event.target.files;
      if (files.length === 0) {
        return;
      }

      const file = files[0];
      const reader = new FileReader();
      console.log(file.name);

      reader.onload = (e) => {
        this.currentItem.image = e.target.result; //圖檔
        this.currentItem.prod_file = file.name; //檔案名稱
        console.log(this.currentItem)
      };
      reader.readAsDataURL(file);
    },

    // ------------new model------------
    submitProduct() {
      if (
        !this.newProduct.prod_no ||
        !this.newProduct.prod_name ||
        !this.newProduct.prod_summary ||
        !this.newProduct.prod_price ||
        !this.newProduct.prod_status ||
        !this.newProduct.prod_file ||
        !this.newProduct.prod_type ||
        !this.newProduct.prod_hot
      ) {
        alert("所有欄位都必須填寫！");
        return;
      }
      this.addProduct();
      // axios.post('test2.php', this.newProduct)
      //       .then(response => {
      //           console.log(response.data);
      //       })
      //       .catch(error => {
      //           console.error(error);
      //       });

      console.log(this.newProduct);
      // this.clearProduct();
      const modalEl = document.getElementById("itemNewModal");
      const modalInstance = Modal.getInstance(modalEl);
      modalInstance.hide();

    },
    async addProduct() {
      await axios({
        method: 'post',
        url: "http://localhost/phps/test.php",
        data: this.newProduct,
      })
    },

    //清空新增商品欄位
    clearProduct() {
      this.newProduct = {
        prod_no: "",
        prod_name: "",
        prod_summary: "",
        prod_price: "",
        prod_status: "",
        prod_file: "",
        prod_type: "",
      };
    },

    // 刪除圖案
    deleteAnnouncement() {
      const index = this.items.findIndex(
        (item) => item.id === this.currentItem.id
      );
      if (index !== -1) {
        this.items.splice(index, 1);
        this.showModal = false;
      }
    },

    //判定顯示上下架及顏色
    productStatus(item) {
      return item.prod_status === 0 ? '下架' : '上架';
    },
    productStatusColor(item) {
      return item.prod_status === 0 ? 'red' : 'blue';
    }
  },

  created () {
    const type = "get"; // 設定要執行的操作，這裡是取得資料
    axios
      .get(`${BASE_URL}/getProduct.php?type=${type}`)
      .then((response) => {
        this.dataFromMySQL = response.data;
      })
      .catch((error) => {
        console.error("There was an error fetching the data:", error);
      });
  },
  // mounted() {
  //   const type = "get"; // 設定要執行的操作，這裡是取得資料
  //   axios
  //     .get(`${BASE_URL}/getProduct.php?type=${type}`)
  //     .then((response) => {
  //       this.dataFromMySQL = response.data;
  //     })
  //     .catch((error) => {
  //       console.error("There was an error fetching the data:", error);
  //     });
  // },
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

input[type="number"]::-webkit-outer-spin-button,
input[type="number"]::-webkit-inner-spin-button {
    -webkit-appearance: none;
    margin: 0;
}

</style>

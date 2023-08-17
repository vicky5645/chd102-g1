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
      <tr v-for="(item, index) in newFilteredItems" :key="item.prod_no">
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
            <select class="form-select" v-model="currentItem.prod_status">
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
              name="org_img"
              id="edit_img"
              ref="change_img"
              aria-label="Sizing example input"
              aria-describedby="inputGroup-sizing-lg"
              @change="handleFileUpload"
            />
          </div>
          <div class="model_body_pic">
            <Images
              v-if="currentItem.prod_file && label_toggle"
              :imgURL="`images/online-mall/${currentItem.prod_file}`"
              :alt="`Image preview`"
            />
            <img v-else :src="currentItem.image" alt="Image preview" />
          </div>
        </div>

        <div class="modal-footer">
          <button
            type="button"
            class="btn btn-danger"
            data-bs-dismiss="modal"
            @click="deleteProduct"
          >
            刪除商品
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

  <!-- new modal -->

  <div
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
                  id="add_new_img"
                  ref="plus_img"
                  accept="image/*"
                  aria-label="Sizing example input"
                  aria-describedby="inputGroup-sizing-lg"
                  @change="handleFileUpload"
                />
              </div>
              <div class="model_body_pic">
                <img
                  v-if="newProduct.prod_file"
                  :src="`${newProduct.image}`"
                  :alt="`Image preview`"
                  :id="`imgPreview`"
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
    </div>

    <!-- footer page-->
    <nav aria-label="Page navigation example">
  <ul class="pagination justify-content-center">
    <li class="page-item" v-for="index in newPage" :key="index">
      <button class="page-link" @click="page = index"> {{ index }} </button>
    </li>
  </ul>
</nav>
</template>
<script>
import axios from "axios";
import { Modal } from "bootstrap";
import { BASE_URL } from "@/assets/js/common.js";
import LoadingAni from '@/components/Loading.vue';

export default {
  components: {
    LoadingAni
  },
  data() {
    return {
      //後台抓取的商品資料
      dataFromMySQL: [],
      // search
      searchText: "",
      // modal
      currentItem: {
        prod_no: "", // 確保 id 屬性存在
        prod_name: "",
        prod_summary: "",
        prod_price: "",
        prod_status: "",
        prod_file: "",
        prod_type: "",
        prod_hot: "",
        image: null,
      },
      showModal: false,
      selectedFile: null,
      label_toggle: true,
      page: 1,
      // new modal
      newProduct: {
        prod_no: "", // 確保 id 屬性存在
        prod_name: "",
        prod_summary: "",
        prod_price: "",
        prod_status: "",
        prod_file: "",
        prod_type: "",
        prod_hot: "",
        image: null,
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
    },
    newPage() {
      return Math.ceil(this.filteredItems.length / 10);
    },
    newFilteredItems() {
      const begin = (this.page - 1) * 10
      const end = this.page * 10
      return this.filteredItems.slice(begin, end);
    }
  },

  methods: {

    //點選查看，將此物品賦值給currentItem
    openModal(item) {
      this.$refs.change_img.value = ''
      this.label_toggle = true;
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

    // ------------edit modal-----------

    //按x的時候取消變更
    cancelChanges() {
      this.showModal = false;
    },

    //儲存變更
    async saveChanges() {
      this.$store.state.Loading = true
      try {
        const index = this.dataFromMySQL.findIndex((item) => item.prod_no === this.currentItem.prod_no);
        if (index !== -1) {
          const formData = new FormData();
          Object.keys(this.currentItem).forEach((key) => {
            formData.append(`${key}`, this.currentItem[key])
          })
          if (this.$refs.change_img.files[0]) {
            formData.set('image', this.$refs.change_img.files[0]);
            formData.set('old_file', this.dataFromMySQL[index].prod_file)
          }
          const res = await axios.post(`${BASE_URL}updateBackendProduct.php`, formData,
            {
              headers: {
                'Content-Type': 'multipart/form-data',
              },
            })
          alert(`${res.data.msg}`);
          this.showModal = false;
        }

      } catch (error) {
        console.error("An error occurred:", error);
        alert("修改失敗請重新操作")
      }

      this.getData();
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

      const inputId = event.target.id; // 獲取觸發事件的 input 的 id
      // const inputTarget = event.target;
      // const fileExtension = file.name.split('.').pop().toLowerCase(); // 取得副檔名
      
      reader.onload = (e) => {
        if (inputId === 'add_new_img') {
          // if (inputTarget.$refs.add_new_img) {
        this.newProduct.image = e.target.result; //圖檔
        this.newProduct.prod_file = file.name; //檔案名稱
        console.log(this.newProduct);

      }else if (inputId === 'edit_img') {
      // }else if (inputTarget.$refs.edit_img) {
        this.currentItem.image = e.target.result; //圖檔
        this.currentItem.prod_file = file.name; //檔案名稱
        console.log(this.currentItem);
        this.label_toggle = false;
        }
      };
      reader.readAsDataURL(file);
    },

    // ------------new modal------------
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
      } else {
        this.addProduct();
      }

      this.clearProduct();
      console.log(this.newProduct);

      const modalEl = document.getElementById("itemNewModal");
      const modalInstance = Modal.getInstance(modalEl);
      modalInstance.hide();

    },

    async addProduct() {
      try {
        const formData = new FormData();
        Object.keys(this.newProduct).forEach((key) => {
          formData.append(`${key}`, this.newProduct[key])
        })
        formData.set('image', this.$refs.plus_img.files[0]);
        const res = await axios.post(`${BASE_URL}postProduct.php`, formData,
        {
            headers: {
              'Content-Type': 'multipart/form-data',
            },
          })
          alert(`${res.data.msg}`)
      } catch (error) {
        console.error("An error occurred:", error);
        alert("新增失敗,請重新操作")
      }
      this.getData();
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
        prod_hot: "",
      };
      this.$refs.plus_img.value = ''
    },

    // 刪除商品
    async deleteProduct() {
      this.$store.state.Loading = true
      try {
        const index = this.dataFromMySQL.findIndex((item) => item.prod_no === this.currentItem.prod_no);
        if (index !== -1) {
          const res = await axios({
            method: 'post',
            url: `${BASE_URL}deleteBackendProduct.php`,
            data: {
               prod_no: this.currentItem.prod_no,
               old_file: this.dataFromMySQL[index].prod_file
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

    //判定顯示上下架及顏色
    productStatus(item) {
      return item.prod_status === 0 ? '下架' : '上架';
    },
    productStatusColor(item) {
      return item.prod_status === 0 ? 'red' : 'blue';
    },

      //抓資料
    getData() {
      this.$store.state.Loading = true
      const type = "get"; // 設定要執行的操作，這裡是取得資料
    axios
      .get(`${BASE_URL}getProduct.php?type=${type}`)
      .then((response) => {
        this.dataFromMySQL = response.data;
      })
      .catch((error) => {
        console.error("There was an error fetching the data:", error);
      });
      setTimeout(() => {
        this.$store.commit('closeLoading')
      }, 300)
    },
    testBug() {
      console.log(formData)
    }
  },



  created () {
    this.getData();
  },
  // mounted() {
  //   const type = "get"; // 設定要執行的操作，這裡是取得資料
  //   axios
  //     .get(`${BASE_URL}getProduct.php?type=${type}`)
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

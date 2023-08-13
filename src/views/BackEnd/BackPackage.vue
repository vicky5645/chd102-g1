<!-- 後台行程 -->
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
      新增行程
    </button>
  </div>

  <table class="table">
    <thead>
      <tr>
        <th scope="col">行程編號</th>
        <th scope="col">行程價格</th>
        <th scope="col">行程狀態</th>
        <th scope="col">行程名稱</th>
        <th scope="col">行程說明</th>
        <!-- <th scope="col">班次編號</th> -->
        <th scope="col">列車編號</th>
        <th scope="col">車長</th>
        <!-- <th scope="col">備註</th> -->
        <th scope="col"></th>
      </tr>
    </thead>

    <tbody>
      <tr v-for="(item, index) in filteredItems" :key="index">
        <th scope="row">{{ item.pkg_no }}</th>
        <td class="ellipsis">{{ item.pkg_price }}</td>
        <td class="ellipsis">{{ pkgStatus(item.pkg_status) }}</td>
        <td class="ellipsis">{{ item.pkg_name }}</td>
        <td class="ellipsis">{{ item.pkg_desc }}</td>
        <td class="ellipsis">{{ item.train_no }}</td>
        <td class="ellipsis">{{ item.conductor }}</td>
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
    action=""
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
          <h5 class="modal-title" id="itemModalLabel">修改行程</h5>
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
              >行程價格</span
            >
            <input
              v-model="currentItem.pkg_price"
              name="pkg_price"
              type="text"
              class="form-control"
              aria-label="Sizing example input"
              aria-describedby="inputGroup-sizing-lg"
            />
          </div>
          <div class="input-group input-group-lg">
            <span class="input-group-text" id="inputGroup-sizing-lg"
              >行程狀態</span
            >
            <input
              v-model="currentItem.pkg_status"
              name="pkg_status"
              type="number"
              class="form-control"
              aria-label="Sizing example input"
              aria-describedby="inputGroup-sizing-lg"
              min="0"
              max="1"
              @input="checkInput"
            />
          </div>
          <div class="input-group input-group-lg">
            <span class="input-group-text" id="inputGroup-sizing-lg"
              >行程名稱</span
            >
            <input
              v-model="currentItem.pkg_name"
              name="pkg_name"
              type="text"
              class="form-control"
              aria-label="Sizing example input"
              aria-describedby="inputGroup-sizing-lg"
            />
          </div>

          <div class="input-group input-group-lg">
            <span class="input-group-text" id="inputGroup-sizing-lg"
              >行程說明</span
            >
            <input
              v-model="currentItem.pkg_desc"
              name="pkg_desc"
              type="text"
              class="form-control"
              aria-label="Sizing example input"
              aria-describedby="inputGroup-sizing-lg"
            />
          </div>
          <div class="input-group input-group-lg">
            <span class="input-group-text" id="inputGroup-sizing-lg"
              >列車編號</span
            >
            <input
              v-model="currentItem.train_no"
              name="train_no"
              type="number"
              class="form-control"
              aria-label="Sizing example input"
              aria-describedby="inputGroup-sizing-lg"
              min="1"
              max="3"
              @input="checkInput"
            />
          </div>
          <div class="input-group input-group-lg">
            <span class="input-group-text" id="inputGroup-sizing-lg">車長</span>
            <input
              v-model="currentItem.conductor"
              name="conductor"
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
            @click="deleteAnnouncement"
          >
            刪除
          </button>
          <button
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
    action=""
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
          <h5 name="header">新增行程</h5>
        </div>

        <div class="modal-body">
          <slot name="body">
            <div
              class="modal-body gap-2"
              style="display: flex; flex-direction: column"
            >
              <div class="input-group input-group-lg">
                <span class="input-group-text" id="inputGroup-sizing-lg"
                  >行程價格</span
                >
                <input
                  v-model="newAnnouncement.pkg_price"
                  name="pkg_price"
                  type="number"
                  class="form-control"
                  aria-label="Sizing example input"
                  aria-describedby="inputGroup-sizing-lg"
                />
              </div>

              <div class="input-group input-group-lg">
                <span class="input-group-text" id="inputGroup-sizing-lg"
                  >行程狀態</span
                >
                <input
                  v-model="newAnnouncement.pkg_status"
                  name="pkg_status"
                  type="number"
                  class="form-control"
                  aria-label="Sizing example input"
                  aria-describedby="inputGroup-sizing-lg"
                  min="0"
                  max="1"
                  @input="checkInput"
                />
              </div>

              <div class="input-group input-group-lg">
                <span class="input-group-text" id="inputGroup-sizing-lg"
                  >行程名稱</span
                >
                <input
                  v-model="newAnnouncement.pkg_name"
                  name="pkg_name"
                  type="text"
                  class="form-control"
                  aria-label="Sizing example input"
                  aria-describedby="inputGroup-sizing-lg"
                />
              </div>

              <div class="input-group input-group-lg">
                <span class="input-group-text" id="inputGroup-sizing-lg"
                  >行程說明</span
                >
                <input
                  v-model="newAnnouncement.pkg_desc"
                  name="pkg_desc"
                  type="text"
                  class="form-control"
                  aria-label="Sizing example input"
                  aria-describedby="inputGroup-sizing-lg"
                />
              </div>

              <div class="input-group input-group-lg">
                <span class="input-group-text" id="inputGroup-sizing-lg"
                  >列車編號</span
                >
                <input
                  v-model="newAnnouncement.train_no"
                  name="train_no"
                  type="number"
                  class="form-control"
                  aria-label="Sizing example input"
                  aria-describedby="inputGroup-sizing-lg"
                  min="1"
                  max="3"
                  @input="checkInput"
                />
              </div>

              <div class="input-group input-group-lg">
                <span class="input-group-text" id="inputGroup-sizing-lg"
                  >車長</span
                >
                <input
                  v-model="newAnnouncement.conductor"
                  name="conductor"
                  type="text"
                  class="form-control"
                  aria-label="Sizing example input"
                  aria-describedby="inputGroup-sizing-lg"
                />
              </div>

              <!-- <div class="input-group input-group-lg">
                <span class="input-group-text" id="inputGroup-sizing-lg"
                  >備註</span
                >
                <input
                  type="text"
                  class="form-control"
                  aria-label="Sizing example input"
                  aria-describedby="inputGroup-sizing-lg"
                />
              </div> -->
            </div>
          </slot>
        </div>

        <div class="modal-footer">
          <slot name="footer">
            <button
              type="button"
              class="btn btn-secondary"
              data-bs-dismiss="modal"
              @click="clearAnnouncement()"
            >
              取消
            </button>
            <button class="btn btn-primary" @click="submitAnnouncement()">
              確定新增
            </button>
          </slot>
        </div>
      </div>
    </div>
  </form>
</template>

<script>
import axios from "axios";
import { Modal } from "bootstrap";
import { BASE_URL } from "@/assets/js/common.js";

export default {
  data() {
    return {
      packageData: [],

      // search
      searchText: "",
      // model
      currentItem: {},
      backupItem: {},
      showModal: false,
      selectedFile: null,
      // new model
      newAnnouncement: {
        pkg_price: "",
        pkg_status: 0,
        pkg_name: "",
        pkg_desc: "",
        train_no: "",
        conductor: "",
      },
    };
  },

  computed: {
    // search
    filteredItems() {
      if (this.searchText === "") {
        return this.packageData;
      }

      return this.packageData.filter((item) =>
        Object.values(item).some((val) => String(val).includes(this.searchText))
      );
    },
  },

  methods: {
    //顯示上下架
    pkgStatus(pkg_status) {
      return pkg_status == 1 ? "上架" : "下架";
    },
    //讓使用者只能輸入介於min到max
    checkInput(event) {
      let value = parseInt(event.target.value);
      let min = parseInt(event.target.min);
      let max = parseInt(event.target.max);
      if (value < min) {
        event.target.value = min;
      } else if (value > max) {
        event.target.value = max;
      }
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

    //edit model
    saveChanges() {
      // 在這裡更新資料
      // 如有需要，你也可以將 currentItem 傳到後端
      // this.currentItem = { ...this.backupItem };
      this.showModal = false;
      const index = this.packageData.findIndex(
        (item) => item.pkg_no === this.currentItem.pkg_no
      );
      if (index !== -1) {
        // 這裡刪除的是vue this.data
        this.packageData.splice(index, 1);
        this.showModal = false;
      }
      //傳送資料庫的資料
      // 修改圖檔時，接收變數
      // let imgFile = this.newAnnouncement.spot_fpkg

      const data = new URLSearchParams(); //這不需要?
      data.append("pkg_no", this.currentItem.pkg_no);
      data.append("pkg_price", this.currentItem.pkg_price);
      data.append("pkg_status", this.currentItem.pkg_status);
      data.append("pkg_name", this.currentItem.pkg_name);
      data.append("pkg_desc", this.currentItem.pkg_desc);
      data.append("train_no", this.currentItem.train_no);
      data.append("conductor", this.currentItem.conductor);

      axios
        .post(`${BASE_URL}editPackage.php`, data)
        .then((response) => {
          // 請求成功後的處理
          // console.log(response.data);
          location.reload(); //刷新頁面
          alert("修改成功！");
        })
        .catch((error) => {
          // 請求失敗後的處理
          console.error(error);
          alert("修改失敗！");
        });
    },

    // new model
    submitAnnouncement() {
      if (
        !this.newAnnouncement.pkg_price ||
        !this.newAnnouncement.pkg_name ||
        !this.newAnnouncement.pkg_desc ||
        !this.newAnnouncement.train_no ||
        !this.newAnnouncement.conductor
      ) {
        alert("所有欄位都必須填寫！");
        return;
      }

      //傳送資料庫要新增的項目
      const data = new FormData();
      data.append("pkg_price", this.newAnnouncement.pkg_price);
      data.append("pkg_status", this.newAnnouncement.pkg_status);
      data.append("pkg_name", this.newAnnouncement.pkg_name);
      data.append("pkg_desc", this.newAnnouncement.pkg_desc);
      data.append("train_no", this.newAnnouncement.train_no);
      data.append("conductor", this.newAnnouncement.conductor);
      // 使用 Axios 發送 POST 請求
      axios
        .post(`${BASE_URL}postPackage.php`, data)
        .then((response) => {
          // 請求成功後的處理
          console.log(response.data);
          location.reload(); //刷新頁面
          alert("新增成功！");
        })
        .catch((error) => {
          // 請求失敗後的處理
          // console.error(error);
          console.log(error);
          alert("新增失敗！", error);
        });

      const modalEl = document.getElementById("itemNewModal");
      const modalInstance = Modal.getInstance(modalEl);
      modalInstance.hide();
    },

    clearAnnouncement() {
      this.newAnnouncement = {
        pkg_price: "",
        pkg_status: 0,
        pkg_name: "",
        pkg_desc: "",
        train_no: "",
        conductor: "",
      };
    },

    // delete announcement
    deleteAnnouncement() {
      const index = this.packageData.findIndex(
        (item) => item.pkg_no === this.currentItem.pkg_no
      );
      if (index !== -1) {
        this.packageData.splice(index, 1);
        this.showModal = false;
      }

      //傳送資料庫要刪除的項目
      const data = new URLSearchParams();
      data.append("pkg_no", this.currentItem.pkg_no);

      // 使用 Axios 發送 POST 請求
      axios
        .post(`${BASE_URL}deletePackage.php`, data)
        .then((response) => {
          // 請求成功後的處理
          // console.log(response.data);
          location.reload();
          alert("刪除成功！");
        })
        .catch((error) => {
          // 請求失敗後的處理
          console.error(error);
          alert("刪除失敗！");
        });
    },
  },

  mounted() {
    axios
      .get(`${BASE_URL}/getPackage.php`)
      .then((response) => {
        this.packageData = response.data;
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

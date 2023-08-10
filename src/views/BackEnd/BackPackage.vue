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
        <td class="ellipsis">{{ item.pkg_status }}</td>
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
  <div
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
              name="pattern_name"
              type="num"
              class="form-control"
              aria-label="Sizing example input"
              aria-describedby="inputGroup-sizing-lg"
              min="0"
              max="1"
            />
          </div>
          <div class="input-group input-group-lg">
            <span class="input-group-text" id="inputGroup-sizing-lg"
              >行程名稱</span
            >
            <input
              v-model="currentItem.pkg_name"
              name="pattern_desc"
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
              type="num"
              class="form-control"
              aria-label="Sizing example input"
              aria-describedby="inputGroup-sizing-lg"
              min="1"
              max="3"
            />
          </div>
          <div class="input-group input-group-lg">
            <span class="input-group-text" id="inputGroup-sizing-lg">車長</span>
            <input
              v-model="currentItem.conductor"
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
  <!-- http://localhost:80/phps/postPackage.php -->
  <!-- new modal -->
  <div
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
                  type="num"
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
                  type="num"
                  class="form-control"
                  aria-label="Sizing example input"
                  aria-describedby="inputGroup-sizing-lg"
                  min="0"
                  max="1"
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
                  type="num"
                  class="form-control"
                  aria-label="Sizing example input"
                  aria-describedby="inputGroup-sizing-lg"
                  min="0"
                  max="3"
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
            <button
              type="button"
              class="btn btn-primary"
              @click.prevent="submitAnnouncement()"
            >
              確定新增
            </button>
          </slot>
        </div>
      </div>
    </div>
  </div>
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
        pkg_status: "",
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
        !this.newAnnouncement.pkg_price ||
        !this.newAnnouncement.pkg_status ||
        !this.newAnnouncement.pkg_name ||
        !this.newAnnouncement.pkg_desc ||
        !this.newAnnouncement.train_no ||
        !this.newAnnouncement.conductor
      ) {
        alert("所有欄位都必須填寫！");
        return;
      }

      //傳送資料庫要新增的項目
      const data = new URLSearchParams();
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
          console.error(error);
          alert("新增失敗！");
        });

      const modalEl = document.getElementById("itemNewModal");
      const modalInstance = Modal.getInstance(modalEl);
      modalInstance.hide();
    },

    clearAnnouncement() {
      this.newAnnouncement = {
        pkg_price: "",
        pkg_status: "",
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
        .post(`${BASE_URL}.deletePackage.php`, data)
        .then((response) => {
          // 請求成功後的處理
          console.log(response.data);
          // location.reload();
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

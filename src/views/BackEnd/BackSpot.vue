<!-- 後台景點 -->
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
      新增景點
    </button>
  </div>

  <table class="table">
    <thead>
      <tr>
        <th scope="col">景點編號</th>
        <th scope="col">景點名稱</th>
        <th scope="col">景點資訊</th>
        <th scope="col">景點狀態</th>
        <th scope="col">景點圖片</th>

        <th scope="col"></th>
      </tr>
    </thead>
    <tbody>
      <tr v-for="(item, index) in filteredItems" :key="index">
        <th scope="row">{{ item.spot_no }}</th>
        <td class="ellipsis">{{ item.spot_name }}</td>
        <td class="ellipsis">{{ item.spot_info }}</td>
        <td class="ellipsis">{{ item.spot_status }}</td>
        <td class="ellipsis">{{ item.spot_file }}</td>
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
          <h5 class="modal-title" id="itemModalLabel">修改景點</h5>
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
              >景點名稱</span
            >
            <input
              v-model="currentItem.spot_name"
              type="text"
              class="form-control"
              aria-label="Sizing example input"
              aria-describedby="inputGroup-sizing-lg"
            />
          </div>
          <div class="input-group input-group-lg">
            <span class="input-group-text" id="inputGroup-sizing-lg"
              >景點資訊</span
            >
            <input
              v-model="currentItem.spot_info"
              name="pattern_name"
              type="text"
              class="form-control"
              aria-label="Sizing example input"
              aria-describedby="inputGroup-sizing-lg"
            />
          </div>
          <div class="input-group input-group-lg">
            <span class="input-group-text" id="inputGroup-sizing-lg"
              >景點狀態</span
            >
            <input
              v-model="currentItem.spot_status"
              name="pattern_desc"
              type="num"
              class="form-control"
              aria-label="Sizing example input"
              aria-describedby="inputGroup-sizing-lg"
            />
          </div>

          <div class="input-group input-group-lg">
            <span class="input-group-text" id="inputGroup-sizing-lg"
              >圖片路徑</span
            >
            <input
              disabled
              v-model="currentItem.spot_file"
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
              type="file"
              class="form-control"
              id="inputGroupFile02"
              @change="handleFileUpload"
            />
          </div>
          <div class="model_body_pic">
            <Images
              v-if="currentItem.spot_file"
              :imgURL="`${currentItem.spot_file}`"
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

  <!-- new modal -->
  <form
    action="http://localhost:80/phps/postSpot.php"
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
          <h5 name="header">新增景點</h5>
        </div>

        <div class="modal-body">
          <slot name="body">
            <div
              class="modal-body gap-2"
              style="display: flex; flex-direction: column"
            >
              <div class="input-group input-group-lg">
                <span class="input-group-text" id="inputGroup-sizing-lg"
                  >景點編號</span
                >
                <input
                  disabled
                  v-model="newAnnouncement.spot_no"
                  name="spot_no"
                  type="num"
                  class="form-control"
                  aria-label="Sizing example input"
                  aria-describedby="inputGroup-sizing-lg"
                />
              </div>

              <div class="input-group input-group-lg">
                <span class="input-group-text" id="inputGroup-sizing-lg"
                  >景點名稱</span
                >
                <input
                  v-model="newAnnouncement.spot_name"
                  name="spot_name"
                  type="text"
                  class="form-control"
                  aria-label="Sizing example input"
                  aria-describedby="inputGroup-sizing-lg"
                />
              </div>

              <div class="input-group input-group-lg">
                <span class="input-group-text" id="inputGroup-sizing-lg"
                  >景點資訊</span
                >
                <input
                  v-model="newAnnouncement.spot_info"
                  name="spot_info"
                  type="text"
                  class="form-control"
                  aria-label="Sizing example input"
                  aria-describedby="inputGroup-sizing-lg"
                />
              </div>

              <div class="input-group input-group-lg">
                <span class="input-group-text" id="inputGroup-sizing-lg"
                  >景點狀態</span
                >
                <input
                  v-model="newAnnouncement.spot_status"
                  name="spot_status"
                  type="num"
                  class="form-control"
                  aria-label="Sizing example input"
                  aria-describedby="inputGroup-sizing-lg"
                />
              </div>

              <div class="input-group input-group-lg">
                <span class="input-group-text" id="inputGroup-sizing-lg"
                  >圖片檔案</span
                >
                <input
                  type="file"
                  class="form-control"
                  name="image"
                  id="image"
                  @change="handleFileUpload"
                />
              </div>
              <div class="model_body_pic">
                <img
                  v-if="newAnnouncement.spot_file"
                  :src="`${newAnnouncement.spot_file}`"
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
import { Modal } from "bootstrap";
import axios from "axios";
import { BASE_URL } from "@/assets/js/common.js";

export default {
  data() {
    return {
      dataFromMySQL: [],
      // items: [
      //   {
      //     id: 1,
      //     name: "綠野號",
      //     qty: 40,
      //   },
      // ],
      // search
      searchText: "",
      // model
      currentItem: {},
      backupItem: {},
      showModal: false,
      selectedFile: null,
      // new model
      newAnnouncement: {
        spot_no: "", // 確保 id 屬性存在
        spot_name: "",
        spot_info: "",
        spot_file: null,
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
        this.newAnnouncement.spot_file = e.target.result;
      };
      reader.readAsDataURL(file);
    },

    // new model
    submitAnnouncement() {
      if (
        !this.newAnnouncement.spot_name ||
        !this.newAnnouncement.spot_info ||
        !this.newAnnouncement.spot_status
      ) {
        alert("所有欄位都必須填寫！");
        return;
      }

      // console.log(this.newAnnouncement);
      // this.clearAnnouncement();
      // this.newAnnouncement = {
      //   id: "",
      //   name: "",
      //   qty: "",
      // };
      const modalEl = document.getElementById("itemNewModal");
      const modalInstance = Modal.getInstance(modalEl);
      modalInstance.hide();
    },

    clearAnnouncement() {
      this.newAnnouncement = {
        spot_no: "", // 確保 id 屬性存在
        spot_name: "",
        spot_info: "",
        spot_file: null,
      };
    },

    // delete announcement
    deleteAnnouncement() {
      const index = this.dataFromMySQL.findIndex(
        (item) => item.spot_no === this.currentItem.spot_no
      );
      if (index !== -1) {
        this.dataFromMySQL.splice(index, 1);
        this.showModal = false;
      }

      //傳送資料庫要刪除的項目
      const data = new URLSearchParams();
      data.append("spot_no", this.currentItem.spot_no);
      data.append("spot_file", this.currentItem.spot_file);
      // 使用 Axios 發送 POST 請求
      axios
        .post(`${BASE_URL}deletePattern.php`, data)
        .then((response) => {
          // 請求成功後的處理
          console.log(response.data);
          location.reload(); //刷新頁面
          alert("刪除圖案成功！");
        })
        .catch((error) => {
          // 請求失敗後的處理
          console.error(error);
          alert("刪除失敗！");
        });
    },

    getdataFromMySQL() {},
  },
  // 抓 php 資料
  mounted() {
    // 設定要執行的操作，這裡是取得資料
    axios
      .get(`${BASE_URL}/getSpot.php`)
      .then((response) => {
        this.dataFromMySQL = response.data;

        // 打印取得的資料以確認是否成功
        // console.log("Data retrieved from MySQL:", this.dataFromMySQL);
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

<!-- 客製車票圖案管理 -->

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
      新增車票圖案
    </button>
  </div>

  <table class="table">
    <thead>
      <tr>
        <th scope="col">客製車票圖案編號</th>
        <th scope="col">圖案名稱</th>
        <th scope="col">圖案描述</th>
        <th scope="col">創建日期</th>
        <th scope="col">圖案檔案</th>
        <th scope="col"></th>
      </tr>
    </thead>
    <tbody>
      <tr v-for="(item, index) in filteredItems" :key="index">
        <th scope="row">{{ item.pattern_no }}</th>
        <td class="ellipsis">{{ item.pattern_name }}</td>
        <td class="ellipsis">{{ item.pattern_desc }}</td>
        <td class="ellipsis">{{ item.creation_date }}</td>
        <td class="ellipsis">{{ item.pattern_file }}</td>
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
              >客製車票圖案編號</span
            >
            <input
              disabled
              v-model="currentItem.pattern_no"
              name="pattern_no"
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
              accept="image/svg+xml"
              class="form-control"
              name="news_img"
              id="inputGroupFile02"
              @change="handleFileUpload"
            />
          </div>
          <div class="model_body_pic">
            <Images
              v-if="currentItem.pattern_file && !newAnnouncement.pattern_file && !encodedSVG"
              :imgURL="`${currentItem.pattern_file}`"
              :alt="`Image preview`"
            />
            <img
              v-if="newAnnouncement.pattern_file && !encodedSVG"
              :src="`${newAnnouncement.pattern_file}`"
              :alt="`Image preview`"
              :id="`imgPreview`"
            />
            <img
              v-if="encodedSVG"
              :src="`${encodedSVG}`"
              :alt="`Image preview`"
              :id="`imgPreview`"
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
            @click.prevent="saveChanges"
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
      <div class="modal-content">
        <div class="modal-header">
          <h5 name="header">新增客製車票圖案</h5>
        </div>
        <div class="modal-body">
          <slot name="body">
            <div
              class="modal-body gap-2"
              style="display: flex; flex-direction: column"
            >
              <!-- <div class="input-group input-group-lg">
                <span class="input-group-text" id="inputGroup-sizing-lg"
                  >客製車票圖案編號</span
                >
                <input
                  disabled
                  v-model="newAnnouncement.pattern_no"
                  name="pattern_no"
                  type="text"
                  class="form-control"
                  aria-label="Sizing example input"
                  aria-describedby="inputGroup-sizing-lg"
                />
              </div> -->
              <div class="input-group input-group-lg">
                <span class="input-group-text" id="inputGroup-sizing-lg"
                  >圖案名稱</span
                >
                <input
                  v-model="newAnnouncement.pattern_name"
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
                  v-model="newAnnouncement.pattern_desc"
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
                  v-model="newAnnouncement.creation_date"
                  name="creation_date"
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
                  accept="image/svg+xml"
                  class="form-control"
                  name="news_img"
                  id="inputGroupFile01"
                  @change="handleFileUpload"
                />
              </div>
              <div class="model_body_pic">
                <img
                  v-if="newAnnouncement.pattern_file && !encodedSVG"
                  :src="`${newAnnouncement.pattern_file}`"
                  :alt="`Image preview`"
                  :id="`imgPreview`"
                />
                <img
                  v-if="encodedSVG"
                  :src="`${encodedSVG}`"
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
              @click="submitAnnouncement()"
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
      // 抓 php 資料
      dataFromMySQL: [],
      backupItem: {},
      // items: [
      //   {
      //     id: 1,
      //     name: "1",
      //     desc: "楓葉",
      //     date: "2023/7/5",
      //     image: require("../../assets/images/pattern/1.svg"),
      //   },
      // ],
      // search
      searchText: "",
      // model
      currentItem: {},
      showModal: false,
      selectedFile: null,
      // new modal
      newAnnouncement: {
        pattern_no: "", // 確保 id 屬性存在
        pattern_name: "",
        pattern_desc: "",
        creation_date: "",
        pattern_file: null,
        pattern_file_name: null,
      },
      encodedSVG: null,
    };
  },

  computed: {
    // search
    filteredItems() {
      if (!this.dataFromMySQL) {
        alert("沒有資料");
      } else {
        if (this.searchText === "") {
          return this.dataFromMySQL;
        }

        return this.dataFromMySQL.filter((item) =>
          Object.values(item).some((val) =>
            String(val).includes(this.searchText)
          )
        );
      }
    },
  },

  methods: {
    cancelChanges() {
      this.currentItem = {};
      this.showModal = false;
      this.clearAnnouncement();
      this.encodedSVG = null;
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
      const maxSize = 2 * 1024 * 1024; // 2MB
      if (file.size > maxSize) {
        alert("檔案大小超過 2MB");
        event.target.value = ""; // 清空
        return;
      }
      // console.log("file", file);
      const reader = new FileReader();

      reader.onload = (e) => {
        // console.log(e.target.result);
        this.newAnnouncement.pattern_file_name = file.name;
        if (file.name.toLowerCase().endsWith(".svg")) {
          const encodedSVG = e.target.result.split(",")[1];
          this.newAnnouncement.pattern_file = encodedSVG;
          this.encodedSVG = e.target.result;
        } else {
          this.newAnnouncement.pattern_file = e.target.result;
        }
      };
      reader.readAsDataURL(file);
    },
    // edit model
    saveChanges() {
      // 在這裡更新資料
      // 如有需要，你也可以將 currentItem 傳到後端
      // this.currentItem = { ...this.backupItem };
      this.showModal = false;
      const index = this.dataFromMySQL.findIndex(
        (item) => item.pattern_no === this.currentItem.pattern_no
      );
      if (index !== -1) {
        // 這裡刪除的是vue this.data
        this.dataFromMySQL.splice(index, 1);
        this.showModal = false;
      }
      //傳送資料庫的資料
      // 修改圖檔時，接收變數
      let imgFile = this.newAnnouncement.pattern_file;
      const data = new FormData(); // POST 表單資料
      data.append("pattern_no", this.currentItem.pattern_no);
      data.append("pattern_name", this.currentItem.pattern_name);
      data.append("pattern_desc", this.currentItem.pattern_desc);
      if (imgFile) {
        data.append("type", "editImg");
        data.append("pattern_file", this.currentItem.pattern_file);
        data.append("news_filename", this.newAnnouncement.pattern_file_name);
        data.append("news_img", imgFile); // imgFile 是新圖片data
      }
      // 使用 Axios 發送 POST 請求
      axios
        .post(`${BASE_URL}editPattern.php`, data)
        .then((response) => {
          // 請求成功後的處理
          console.log(response.data);
          // 重新取得資料
          alert("已修改圖案成功！");
          this.getdataFromMySQL();
        })
        .catch((error) => {
          // 請求失敗後的處理
          console.error(error);
          alert("修改失敗！");
        });
      // this.clearAnnouncement();
    },
    // new modal
    submitAnnouncement() {
      const newModel = this.newAnnouncement;
      const imgFile = this.newAnnouncement.pattern_file;
      if (
        !newModel.pattern_name ||
        !newModel.pattern_desc ||
        !newModel.pattern_file
      ) {
        alert("所有欄位都必須填寫！");
        return;
      }

      // 準備要傳送的資料
      const data = new FormData(); // POST 表單資料
      data.append("pattern_name", newModel.pattern_name);
      data.append("pattern_desc", newModel.pattern_desc);
      data.append("news_filename", newModel.pattern_file_name);

      if (newModel.pattern_file) {
        data.append("type", "addImg");
        data.append("news_img", imgFile);
      }

      // 使用 Axios 發送 POST 請求
      axios
        .post(`${BASE_URL}postPattern.php`, data)
        .then((response) => {
          // 請求成功後的處理
          console.log(response.data);
          // 重新取得資料
          alert("新增成功！");
          this.getdataFromMySQL();
        })
        .catch((error) => {
          // 請求失敗後的處理
          console.error(error);
          alert("新增失敗！");
        });

      this.clearAnnouncement();

      const modalEl = document.getElementById("itemNewModal");
      const modalInstance = Modal.getInstance(modalEl);
      modalInstance.hide();
    },

    clearAnnouncement() {
      this.newAnnouncement = {
        pattern_no: "", // 確保 id 屬性存在
        pattern_name: "",
        pattern_desc: "",
        creation_date: "",
        pattern_file: null,
        pattern_file_name: null,
      };
    },

    // 刪除
    deleteAnnouncement() {
      const index = this.dataFromMySQL.findIndex(
        (item) => item.pattern_no === this.currentItem.pattern_no
      );
      if (index !== -1) {
        // 這裡刪除的是vue this.data
        this.dataFromMySQL.splice(index, 1);
        this.showModal = false;
      }

      //傳送資料庫要刪除的項目
      const data = new FormData(); // POST 表單資料
      data.append("pattern_no", this.currentItem.pattern_no);
      data.append("pattern_file", this.currentItem.pattern_file);
      // 使用 Axios 發送 POST 請求
      axios
        .post(`${BASE_URL}deletePattern.php`, data)
        .then((response) => {
          // 請求成功後的處理
          console.log(response.data);
          // 重新取得資料
          alert("已刪除圖案成功！");
          this.getdataFromMySQL();
        })
        .catch((error) => {
          // 請求失敗後的處理
          console.error(error);
          alert("刪除失敗！");
        });
    },
    //取資料
    async getdataFromMySQL() {
      await axios
        .get(`${BASE_URL}getPattern.php`)
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

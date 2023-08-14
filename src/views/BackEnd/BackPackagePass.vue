<!-- 後台行程景點 -->
<template>
selectFieldKey {{ selectFieldKey }}
  <!-- select bar -->
  <div class="search_new">
    <div class="col-md-2"><select ref="selected" class="form-select" @change="selectOption">
        <option ref="select" value="0">全部查詢</option>
        <option ref="select" value="1">公告編號</option>
        <option ref="select" value="2">公告標題</option>
        <option ref="select" value="3">公告類型</option>
        <option ref="select" value="4">公告內容</option>
        <option ref="select" value="5">公告時間</option>
      </select></div>
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
      新增行程景點
    </button>
  </div>

  <table class="table">
    <thead>
      <tr>
        <th scope="col">行程編號</th>
        <th scope="col">景點編號</th>
        <th scope="col">景點排序</th>
        <th scope="col">第幾天</th>

        <th scope="col"></th>
      </tr>
    </thead>
    <tbody>
      <tr v-for="(item, index) in filteredItems" :key="index">
        <th scope="row">{{ item.pkg_no }}</th>
        <td class="ellipsis">{{ item.spot_no }}</td>
        <td class="ellipsis">{{ item.spot_sort }}</td>
        <td class="ellipsis">{{ `第${item.pkg_howday}天` }}</td>
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
          <h5 class="modal-title" id="itemModalLabel">修改行程景點</h5>
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
              >行程編號</span
            >
            <input
              disabled
              v-model="currentItem.pkg_no"
              name="pkg_no"
              type="text"
              class="form-control"
              aria-label="Sizing example input"
              aria-describedby="inputGroup-sizing-lg"
            />
          </div>
          <div class="input-group input-group-lg">
            <span class="input-group-text" id="inputGroup-sizing-lg"
              >景點編號</span
            >
            <input
              disabled
              v-model="currentItem.pkg_no"
              name="pkg_no"
              type="text"
              class="form-control"
              aria-label="Sizing example input"
              aria-describedby="inputGroup-sizing-lg"
            />
          </div>
          <div class="input-group input-group-lg">
            <span class="input-group-text" id="inputGroup-sizing-lg"
              >景點排序</span
            >
            <input
              v-model="currentItem.spot_sort"
              name="spot_sort"
              type="text"
              class="form-control"
              aria-label="Sizing example input"
              aria-describedby="inputGroup-sizing-lg"
            />
          </div>

          <div class="input-group input-group-lg">
            <span class="input-group-text" id="inputGroup-sizing-lg"
              >第幾天</span
            >
            <input
              v-model="currentItem.pkg_howday"
              name="pkg_howday"
              type="text"
              class="form-control"
              aria-label="Sizing example input"
              aria-describedby="inputGroup-sizing-lg"
            />
          </div>
          <!-- <div class="input-group input-group-lg">
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
          </div> -->
          <!-- <div class="input-group input-group-lg">
            <span class="input-group-text" id="inputGroup-sizing-lg"
              >上傳檔案</span
            >
            <input
              type="file"
              class="form-control"
              accept="image"
              name="news_img"
              id="inputGroupFile02"
              @change="handleFileUpload"
            />
          </div> -->
          <div class="model_body_pic">
            <Images
              v-if="currentItem.pattern_file && !newAnnouncement.pattern_file"
              :imgURL="`${currentItem.pattern_file}`"
              :alt="`Image preview`"
            />
            <img
              v-if="newAnnouncement.pattern_file"
              :src="`${newAnnouncement.pattern_file}`"
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
          <h5 name="header">新增行程景點</h5>
        </div>

        <div class="modal-body">
          <slot name="body">
            <div
              class="modal-body gap-2"
              style="display: flex; flex-direction: column"
            >
              <div class="input-group input-group-lg">
                <span class="input-group-text" id="inputGroup-sizing-lg"
                  >行程編號</span
                >
                <input
                  v-model="newAnnouncement.pkg_no"
                  name="pkg_no"
                  type="text"
                  class="form-control"
                  aria-label="Sizing example input"
                  aria-describedby="inputGroup-sizing-lg"
                />
              </div>

              <div class="input-group input-group-lg">
                <span class="input-group-text" id="inputGroup-sizing-lg"
                  >景點編號</span
                >
                <input
                  v-model="newAnnouncement.spot_no"
                  name="spot_no"
                  type="text"
                  class="form-control"
                  aria-label="Sizing example input"
                  aria-describedby="inputGroup-sizing-lg"
                />
              </div>

              <div class="input-group input-group-lg">
                <span class="input-group-text" id="inputGroup-sizing-lg"
                  >景點排序</span
                >
                <input
                  v-model="newAnnouncement.spot_sort"
                  name="spot_sort"
                  type="text"
                  class="form-control"
                  aria-label="Sizing example input"
                  aria-describedby="inputGroup-sizing-lg"
                />
              </div>

              <div class="input-group input-group-lg">
                <span class="input-group-text" id="inputGroup-sizing-lg"
                  >第幾天</span
                >
                <input
                  v-model="newAnnouncement.pkg_howday"
                  name="pkg_howday"
                  type="text"
                  class="form-control"
                  aria-label="Sizing example input"
                  aria-describedby="inputGroup-sizing-lg"
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
  </div>
</template>

<script>
import axios from "axios";
import { Modal } from "bootstrap";
import { BASE_URL } from "@/assets/js/common.js";

export default {
  data() {
    return {
      dataFromMySQL: [],
      // items: [
      //   {
      //     pkg_no: 1,
      //     spot_no: "",
      //     spot_sort: 40,
      //     pkg_howday: 1
      //   },
      // ],
      // search
      searchText: "",
      selectFieldKey: 0,
      // model
      currentItem: {},
      backupItem: {},
      showModal: false,
      selectedFile: null,
      // new model
      newAnnouncement: {
        // pkg_no: "", // 確保 id 屬性存在
        // spot_no: "",
        // spot_sort: "",
        // pkg_howday: "",
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
    //選擇篩選欄位
    selectOption() {
      this.selectFieldKey = parseInt(this.$refs.selected.value)
    },
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
        .get(`${BASE_URL}getPackagePass.php`)
        .then((response) => {
          this.dataFromMySQL = response.data;

          // 確認是否成功
          console.log("Data retrieved from MySQL:", "dataFromMySQL");
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

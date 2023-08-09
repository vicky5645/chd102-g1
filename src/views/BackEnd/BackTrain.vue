<!-- 列車管理 -->
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
      新增列車
    </button>
  </div>

  <table class="table">
    <thead>
      <tr>
        <th scope="col">列車編號</th>
        <th scope="col">列車名稱</th>
        <th scope="col">座位</th>
        <th scope="col"></th>
      </tr>
    </thead>
    <tbody>
      <tr v-for="(item, index) in filteredItems" :key="index">
        <th scope="row">{{ item.train_no }}</th>
        <td class="ellipsis">{{ item.train_name }}</td>
        <td class="ellipsis">{{ item.train_qty }}</td>
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

  <!-- modal -->
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
          <h5 class="modal-title" id="itemModalLabel">修改列車</h5>
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
              >列車編號</span
            >
            <input
              v-model="currentItem.id"
              type="text"
              class="form-control"
              aria-label="Sizing example input"
              aria-describedby="inputGroup-sizing-lg"
            />
          </div>
          <div class="input-group input-group-lg">
            <span class="input-group-text" id="inputGroup-sizing-lg"
              >列車名稱</span
            >
            <input
              v-model="currentItem.name"
              type="text"
              class="form-control"
              aria-label="Sizing example input"
              aria-describedby="inputGroup-sizing-lg"
            />
          </div>
          <div class="input-group input-group-lg">
            <span class="input-group-text" id="inputGroup-sizing-lg">座位</span>
            <input
              v-model="currentItem.qty"
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
          <h5 name="header">新增列車</h5>
        </div>

        <div class="modal-body">
          <slot name="body">
            <div
              class="modal-body gap-2"
              style="display: flex; flex-direction: column"
            >
              <div class="input-group input-group-lg">
                <span class="input-group-text" id="inputGroup-sizing-lg"
                  >列車編號</span
                >
                <input
                  v-model="newAnnouncement.id"
                  type="text"
                  class="form-control"
                  aria-label="Sizing example input"
                  aria-describedby="inputGroup-sizing-lg"
                />
              </div>
              <div class="input-group input-group-lg">
                <span class="input-group-text" id="inputGroup-sizing-lg"
                  >列車名稱</span
                >
                <input
                  v-model="newAnnouncement.name"
                  type="text"
                  class="form-control"
                  aria-label="Sizing example input"
                  aria-describedby="inputGroup-sizing-lg"
                />
              </div>
              <div class="input-group input-group-lg">
                <span class="input-group-text" id="inputGroup-sizing-lg"
                  >座位</span
                >
                <input
                  v-model="newAnnouncement.qty"
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
      trainData: [],
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
        return this.trainData;
      }

      return this.trainData.filter((item) =>
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
      const index = this.trainData.findIndex(
        (item) => item.id === this.currentItem.id
      );
      if (index !== -1) {
        this.trainData.splice(index, 1);
        this.showModal = false;
      }
    },
  },

  mounted() {
    axios
      .get(`${BASE_URL}/getTrain.php`)
      .then((response) => {
        this.trainData = response.data;
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

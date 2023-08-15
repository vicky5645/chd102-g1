<!-- 後台開團 -->
<!-- 後台框架 / 有新增 -->
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
      新增開團
    </button>
  </div>

  <table class="table">
    <thead>
      <tr>
        <th scope="col">開團編號</th>
        <th scope="col">行程編號</th>
        <th scope="col">人數上限</th>
        <th scope="col">優惠折扣</th>
        <th scope="col">出發日期</th>
        <th scope="col">已報名人數</th>
        <th scope="col">報名開始日期</th>
        <th scope="col">報名截止日期</th>
        <th scope="col"></th>
      </tr>
    </thead>
    <tbody>
      <tr v-for="(item, index) in filteredItems" :key="index">
        <th scope="row">{{ item.org_no }}</th>
        <td class="ellipsis">{{ item.pkg_no }}</td>
        <td class="ellipsis">{{ item.pkg_limit }}</td>
        <td class="ellipsis">{{ item.pkg_sale }}</td>
        <td class="ellipsis">{{ item.dept_date }}</td>
        <td class="ellipsis">{{ item.enrolled }}</td>
        <td class="ellipsis">{{ item.reg_start }}</td>
        <td class="ellipsis">{{ item.reg_end }}</td>
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
          <h5 class="modal-title" id="itemModalLabel">修改開團</h5>
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
              v-model="currentItem.pkg_no"
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
              >優惠折扣</span
            >
            <input
              v-model="currentItem.pkg_sale"
              name="pattern_name"
              type="number"
              class="form-control"
              aria-label="Sizing example input"
              aria-describedby="inputGroup-sizing-lg"
              min="0"
              @input="checkInput"
            />
          </div>
          <div class="input-group input-group-lg">
            <span class="input-group-text" id="inputGroup-sizing-lg"
              >出發日期</span
            >
            <input
              v-model="currentItem.dept_date"
              name="pattern_desc"
              type="date"
              class="form-control"
              aria-label="Sizing example input"
              aria-describedby="inputGroup-sizing-lg"
            />
          </div>

          <div class="input-group input-group-lg">
            <span class="input-group-text" id="inputGroup-sizing-lg"
              >已報名人數</span
            >
            <input
              v-model="currentItem.enrolled"
              type="number"
              class="form-control"
              aria-label="Sizing example input"
              aria-describedby="inputGroup-sizing-lg"
              min="0"
              max="40"
              @input="checkInput"
            />
          </div>
          <div class="input-group input-group-lg">
            <span class="input-group-text" id="inputGroup-sizing-lg"
              >報名開始日期</span
            >
            <input
              v-model="currentItem.reg_start"
              type="date"
              class="form-control"
              aria-label="Sizing example input"
              aria-describedby="inputGroup-sizing-lg"
            />
          </div>
          <div class="input-group input-group-lg">
            <span class="input-group-text" id="inputGroup-sizing-lg"
              >報名截止日期</span
            >
            <input
              v-model="currentItem.reg_end"
              type="date"
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
          <h5 name="header">新增開團</h5>
        </div>

        <div class="modal-body">
          <slot name="body">
            <div
              class="modal-body gap-2"
              style="display: flex; flex-direction: column"
            >
              <!-- <div class="input-group input-group-lg">
                <span class="input-group-text" id="inputGroup-sizing-lg"
                  >開團編號</span
                >
                <input
                  v-model="newAnnouncement.id"
                  type="number"
                  class="form-control"
                  aria-label="Sizing example input"
                  aria-describedby="inputGroup-sizing-lg"
                />
              </div> -->

              <div class="input-group input-group-lg">
                <span class="input-group-text" id="inputGroup-sizing-lg"
                  >行程編號</span
                >
                <input
                  v-model="newAnnouncement.pkg_no"
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
                  >人數上限</span
                >
                <input
                  v-model="newAnnouncement.pkg_limit"
                  type="number"
                  class="form-control"
                  aria-label="Sizing example input"
                  aria-describedby="inputGroup-sizing-lg"
                  min="0"
                  max="40"
                  @input="checkInput"
                />
              </div>

              <div class="input-group input-group-lg">
                <span class="input-group-text" id="inputGroup-sizing-lg"
                  >優惠折扣</span
                >
                <input
                  v-model="newAnnouncement.pkg_sale"
                  type="number"
                  class="form-control"
                  aria-label="Sizing example input"
                  aria-describedby="inputGroup-sizing-lg"
                  min="0"
                  @input="checkInput"
                />
              </div>

              <div class="input-group input-group-lg">
                <span class="input-group-text" id="inputGroup-sizing-lg"
                  >出發日期</span
                >
                <input
                  v-model="newAnnouncement.dept_date"
                  type="date"
                  class="form-control"
                  aria-label="Sizing example input"
                  aria-describedby="inputGroup-sizing-lg"
                />
              </div>

              <div class="input-group input-group-lg">
                <span class="input-group-text" id="inputGroup-sizing-lg"
                  >已報名人數</span
                >
                <input
                  v-model="newAnnouncement.enrolled"
                  type="number"
                  class="form-control"
                  aria-label="Sizing example input"
                  aria-describedby="inputGroup-sizing-lg"
                  min="0"
                  max="40"
                  @input="checkInput"
                />
              </div>

              <div class="input-group input-group-lg">
                <span class="input-group-text" id="inputGroup-sizing-lg"
                  >報名開始日期</span
                >
                <input
                  v-model="newAnnouncement.reg_start"
                  type="date"
                  class="form-control"
                  aria-label="Sizing example input"
                  aria-describedby="inputGroup-sizing-lg"
                />
              </div>

              <div class="input-group input-group-lg">
                <span class="input-group-text" id="inputGroup-sizing-lg"
                  >報名截止日期</span
                >
                <input
                  v-model="newAnnouncement.reg_end"
                  type="date"
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
      organizeData: [],
      // search
      searchText: "",
      // model
      currentItem: {},
      backupItem: {},
      showModal: false,
      selectedFile: null,
      // new model
      newAnnouncement: {
        org_no: "", // 確保 id 屬性存在
        pkg_no: "",
        pkg_limit: "",
        pkg_sale: "",
        dept_date: "",
        enrolled: "",
        reg_start: "",
        reg_end: "",
      },
    };
  },

  computed: {
    // search
    filteredItems() {
      if (this.searchText === "") {
        return this.organizeData;
      }

      return this.organizeData.filter((item) =>
        Object.values(item).some((val) => String(val).includes(this.searchText))
      );
    },
  },

  methods: {
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
    // model
    async saveChanges() {
      // 在這裡更新資料
      // 如有需要，你也可以將 currentItem 傳到後端
      // this.currentItem = { ...this.backupItem };
      try {
        const index = this.organizeData.findIndex(
          (item) => item.org_no === this.currentItem.org_no
        );
        if (index !== -1) {
          const formData = new FormData();
          Object.keys(this.currentItem).forEach((key) => {
            formData.append(`${key}`, this.currentItem[key]);
          });
          // if (this.$refs.change_img.files[0]) {
          //   formData.set('image', this.$refs.change_img.files[0]);
          // }
          const res = await axios.post(
            `${BASE_URL}/editOrganize.php`,
            formData,
            {
              headers: {
                "Content-Type": "multipart/form-data",
              },
            }
          );
          alert("修改成功");
          this.showModal = false;
        }
      } catch (error) {
        console.error("An error occurred:", error);
        alert("修改失敗請重新操作");
      }

      this.getOrganizeData();
      this.showModal = false;
    },

    cancelChanges() {
      // this.currentItem = { ...this.backupItem };
      this.showModal = false;
    },
    //打開燈箱
    openModal(item) {
      this.currentItem = { ...item };
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

    // handleFileUpload(event) {
    //   const files = event.target.files;
    //   if (files.length === 0) {
    //     return;
    //   }

    //   const file = files[0];
    //   const reader = new FileReader();

    //   reader.onload = (e) => {
    //     this.currentItem.image = e.target.result;
    //   };
    //   reader.readAsDataURL(file);
    // },

    // new model
    //pkg_sale和enrolled我拿掉了
    submitAnnouncement() {
      if (
        !this.newAnnouncement.pkg_no ||
        !this.newAnnouncement.pkg_limit ||
        !this.newAnnouncement.dept_date ||
        !this.newAnnouncement.reg_start ||
        !this.newAnnouncement.reg_end
      ) {
        alert("所有欄位都必須填寫！");
        return;
      } else {
        this.addOrganize();
      }

      this.clearAnnouncement();

      const modalEl = document.getElementById("itemNewModal");
      const modalInstance = Modal.getInstance(modalEl);
      modalInstance.hide();
    },

    clearAnnouncement() {
      this.newAnnouncement = {
        pkg_no: "",
        pkg_limit: "",
        pkg_sale: "",
        dept_date: "",
        enrolled: "",
        reg_start: "",
        reg_end: "",
      };
    },

    // delete
    deleteAnnouncement() {
      const index = this.organizeData.findIndex(
        (item) => item.org_no === this.org_no
      );
      if (index !== -1) {
        this.organizeData.splice(index, 1);
        this.showModal = false;
      }

      //傳送資料庫要刪除的項目
      const data = new URLSearchParams();
      data.append("org_no", this.currentItem.org_no);

      // 使用 Axios 發送 POST 請求
      axios
        .post(`${BASE_URL}deleteOrganize.php`, data)
        .then((response) => {
          // 請求成功後的處理
          console.log(response.data);
          location.reload();
          alert("刪除成功！");
        })
        .catch((error) => {
          // 請求失敗後的處理
          console.error(error);
          alert("刪除失敗！");
        });
    },

    //新增
    async addOrganize() {
      try {
        const formData = new FormData();
        Object.keys(this.newAnnouncement).forEach((key) => {
          formData.append(`${key}`, this.newAnnouncement[key]);
        });
        // formData.set('image', this.$refs.plus_img.files[0]);
        const res = await axios.post(`${BASE_URL}/postOrganize.php`, formData, {
          headers: {
            "Content-Type": "multipart/form-data",
          },
        });
        alert("新增成功!");
      } catch (error) {
        console.error("An error occurred:", error);
        alert("新增失敗,請重新操作");
      }
      this.getOrganizeData();
    },

    //撈資料
    async getOrganizeData() {
      try {
        const res = await axios.get(`${BASE_URL}/getOrganize.php`);
        if (!res) throw new Error("沒撈到資料");
        this.organizeData = res.data;
      } catch (err) {
        console.error(err);
      }
    },
  },

  //一開始取資料
  created() {
    this.getOrganizeData();
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

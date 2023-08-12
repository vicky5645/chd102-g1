<!-- 論壇文章檢舉管理 -->
<template>
  <!-- select bar -->
  <div class="search_new">
    <div
      class="btn-group"
      role="group"
      aria-label="Basic radio toggle button group"
    >
      <input
        type="radio"
        class="btn-check"
        name="btnradio"
        id="btnradio1"
        autocomplete="off"
        v-model="radio1Checked"
        @change="
          radio1Checked = true;
          radio2Checked = false;
        "
      />
      <label
        class="btn btn-outline-primary"
        :class="{ active: radio1Checked }"
        for="btnradio1"
        style="white-space: nowrap"
        >未處理</label
      >

      <input
        type="radio"
        class="btn-check"
        name="btnradio"
        id="btnradio2"
        autocomplete="off"
        v-model="radio2Checked"
        @change="
          radio1Checked = false;
          radio2Checked = true;
        "
      />
      <label
        class="btn btn-outline-primary"
        :class="{ active: radio2Checked }"
        for="btnradio2"
        style="white-space: nowrap"
        >已處理</label
      >
    </div>
    <div class="input-group">
      <input
        v-model="searchText"
        type="text"
        class="form-control"
        placeholder="輸入文字查詢"
        aria-label="Search"
      />
    </div>
  </div>

  <table class="table">
    <thead>
      <tr>
        <th scope="col">檢舉編號</th>
        <th scope="col">文章編號</th>
        <th scope="col">檢舉人會員編號</th>
        <th scope="col">檢舉內容</th>
        <th scope="col">處理狀態</th>
        <th scope="col"></th>
      </tr>
    </thead>
    <tbody>
      <tr v-for="(item, index) in filteredItems" :key="index">
        <th scope="row">{{ item.report_no }}</th>
        <td class="ellipsis">{{ item.article_no }}</td>
        <td class="ellipsis">{{ item.mem_no }}</td>
        <td class="ellipsis">{{ item.report_content }}</td>
        <td class="ellipsis">{{ item.report_type }}</td>
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
    <div class="modal-dialog" style="max-width: 80%; width: 100%">
      <div class="modal-content" style="max-width: 100%">
        <div class="modal-header">
          <h5 class="modal-title" id="itemModalLabel">查看論壇文章檢舉</h5>
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
              >檢舉編號</span
            >
            <input
              v-model="currentItem.report_no"
              type="text"
              class="form-control"
              aria-label="Sizing example input"
              aria-describedby="inputGroup-sizing-lg"
              disabled
            />
          </div>
          <div class="input-group input-group-lg">
            <span class="input-group-text" id="inputGroup-sizing-lg"
              >文章編號</span
            >
            <input
              v-model="currentItem.article_no"
              type="text"
              class="form-control"
              aria-label="Sizing example input"
              aria-describedby="inputGroup-sizing-lg"
              disabled
            />
          </div>

          <div class="input-group input-group-lg">
            <span class="input-group-text" id="inputGroup-sizing-lg"
              >檢舉人會員編號</span
            >
            <input
              v-model="currentItem.mem_no"
              type="text"
              class="form-control"
              aria-label="Sizing example input"
              aria-describedby="inputGroup-sizing-lg"
              disabled
            />
          </div>
          <div class="input-group input-group-lg">
            <span class="input-group-text" id="inputGroup-sizing-lg"
              >檢舉內容</span
            >
            <input
              v-model="currentItem.report_content"
              type="text"
              class="form-control"
              aria-label="Sizing example input"
              aria-describedby="inputGroup-sizing-lg"
              disabled
            />
          </div>
          <div class="input-group input-group-lg">
            <span class="input-group-text" id="inputGroup-sizing-lg"
              >處理狀態</span
            >
            <input
              v-model="currentItem.report_type"
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
            @click="deleteReport(currentItem.report_no)"
          >
            刪除檢舉
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
</template>

<script>
import { Modal } from "bootstrap";
// 抓 php 資料
import axios from "axios";
// URL
import { MAC_URL } from "@/assets/js/common.js";

export default {
  data() {
    return {
      // 分類篩選
      radio1Checked: true, // 代表 radio1 是被選中的
      radio2Checked: false, // 代表 radio2 是未被選中的

      // items: [
      //   {
      //     id: 1,
      //     articleNo: 6,
      //     memNo: 24,
      //     content: "圖片裸露",
      //     type: 0,
      //   },
      //   {
      //     id: 2,
      //     articleNo: 6,
      //     memNo: 21,
      //     content: "文字粗俗",
      //     type: 1,
      //   },
      //   {
      //     id: 3,
      //     articleNo: 3,
      //     memNo: 55,
      //     content: "抄襲",
      //     type: 1,
      //   },
      // ],
      // search

      searchText: "",
      // model
      currentItem: {},
      backupItem: {},
      showModal: false,
      selectedFile: null,

      // 抓 php 資料
      dataForumReport: [],
    };
  },

  computed: {
    // search
    filteredItems() {
      let filtered = this.dataForumReport; // 使用從資料庫取得的資料

      if (this.radio1Checked) {
        filtered = filtered.filter((item) => item.report_type === 0); // 根據需要修改條件
      } else if (this.radio2Checked) {
        filtered = filtered.filter((item) => item.report_type === 1); // 根據需要修改條件
      }

      if (this.searchText) {
        const searchTerm = this.searchText.toLowerCase();
        filtered = filtered.filter((item) => {
          const { report_no, article_no, mem_no, report_content, report_type } =
            item;
          return (
            report_no.toString().includes(searchTerm) ||
            article_no.toString().includes(searchTerm) ||
            mem_no.toString().includes(searchTerm) ||
            report_content.toLowerCase().includes(searchTerm) ||
            report_type.toString().includes(searchTerm)
          );
        });
      }

      return filtered;
    },
  },

  methods: {
    // model
    // saveChanges() {
    //   // 在這裡更新資料
    //   // 如有需要，你也可以將 currentItem 傳到後端
    //   this.currentItem = { ...this.backupItem };
    //   this.showModal = false;
    // },

    saveChanges() {
      const formData = new FormData();
      formData.append("report_no", this.currentItem.report_no);
      formData.append("report_type", this.currentItem.report_type);

      axios
        .post(`${MAC_URL}/editForumReport.php`, formData)
        .then((response) => {
          if (response.data.msg) {
            // Handle success message
            alert(response.data.msg);
          }
          this.showModal = false;
          location.reload(); //刷新頁面
        })
        .catch((error) => {
          console.error("There was an error updating the article:", error);
        });
    },

    cancelChanges() {
      // this.currentItem = { ...this.backupItem };
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

    // delete message

    // deleteMessage() {
    //   const index = this.items.findIndex(
    //     (item) => item.id === this.currentItem.id
    //   );
    //   if (index !== -1) {
    //     this.items.splice(index, 1);
    //     this.showModal = false;
    //   }
    // },

    deleteReport(report_no) {
      // 再次確認彈窗
      if (!confirm("您確定要刪除此檢舉嗎？")) {
        return; // 如果用戶選擇“取消”，則退出函數
      }

      const formData = new FormData();
      formData.append("report_no", report_no);

      axios
        .post(`${MAC_URL}/deleteForumReport.php`, formData)
        .then((response) => {
          this.currentItem = {}; // 清除當前選定的檢舉
          location.reload(); //刷新頁面
          alert("已刪除檢舉成功！");
        })
        .catch((error) => {
          console.error("There was an error deleting the article:", error);
          alert("刪除失敗！");
        });
    },

    getReport() {
      const type = "get"; // 設定要執行的操作，這裡是取得資料
      axios
        .get(`${MAC_URL}/getForumReport.php?type=${type}`)
        .then((response) => {
          this.dataForumReport = response.data; // 確保這個屬性與您的組件中用於顯示文章的屬性相匹配
          console.log("Data retrieved from MySQL:", this.dataForumReport);
        })
        .catch((error) => {
          console.error("There was an error fetching the data:", error);
        });
    },
  },

  // 抓 php 資料
  mounted() {
    this.getReport();
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
.active {
  background-color: #007bff; /* 使用您想要的顏色 */
  color: white; /* 使用您想要的顏色 */
}
</style>

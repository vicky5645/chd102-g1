<!-- 論壇文章管理 -->
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
  </div>

  <table class="table">
    <thead>
      <tr>
        <th scope="col">文章編號</th>
        <th scope="col">文章標題</th>
        <th scope="col">文章內容</th>
        <th scope="col">會員編號</th>
        <th scope="col">文章編輯時間</th>
        <th scope="col">文章瀏覽數</th>
        <th scope="col">文章按讚數</th>
        <th scope="col">文章上線狀態</th>
        <th scope="col">文章圖片</th>
        <th scope="col"></th>
      </tr>
    </thead>
    <tbody>
      <tr v-for="(item, index) in filteredItems" :key="index">
        <th scope="row">{{ item.article_no }}</th>
        <td class="ellipsis">{{ item.article_title }}</td>
        <td class="ellipsis">{{ item.article_content }}</td>
        <td class="ellipsis">{{ item.mem_no }}</td>
        <td class="ellipsis">{{ item.article_date }}</td>
        <td class="ellipsis">{{ item.article_views }}</td>
        <td class="ellipsis">{{ item.article_likes }}</td>
        <td class="ellipsis">{{ item.platform_online }}</td>
        <td class="ellipsis">{{ item.article_image }}</td>
        <td style="text-align: right">
          <button
            type="button"
            class="btn btn-outline-primary"
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
          <h5 class="modal-title" id="itemModalLabel">查看論壇文章</h5>
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
              >文章標題</span
            >
            <input
              v-model="currentItem.article_title"
              type="text"
              class="form-control"
              aria-label="Sizing example input"
              aria-describedby="inputGroup-sizing-lg"
              disabled
            />
          </div>

          <div class="input-group input-group-lg">
            <span class="input-group-text" id="inputGroup-sizing-lg"
              >文章內容</span
            >
            <textarea
              v-model="currentItem.article_content"
              class="form-control"
              aria-label="Sizing example input"
              aria-describedby="inputGroup-sizing-lg"
              disabled
            ></textarea>
          </div>
          <div class="input-group input-group-lg">
            <span class="input-group-text" id="inputGroup-sizing-lg"
              >會員編號</span
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
              >編輯時間</span
            >
            <input
              v-model="currentItem.article_date"
              type="text"
              class="form-control"
              aria-label="Sizing example input"
              aria-describedby="inputGroup-sizing-lg"
              disabled
            />
          </div>
          <div class="input-group input-group-lg">
            <span class="input-group-text" id="inputGroup-sizing-lg"
              >文章瀏覽數</span
            >
            <input
              v-model="currentItem.article_views"
              type="text"
              class="form-control"
              aria-label="Sizing example input"
              aria-describedby="inputGroup-sizing-lg"
              disabled
            />
          </div>
          <div class="input-group input-group-lg">
            <span class="input-group-text" id="inputGroup-sizing-lg"
              >文章按讚數</span
            >
            <input
              v-model="currentItem.article_likes"
              type="text"
              class="form-control"
              aria-label="Sizing example input"
              aria-describedby="inputGroup-sizing-lg"
              disabled
            />
          </div>
          <div class="input-group input-group-lg">
            <span class="input-group-text" id="inputGroup-sizing-lg"
              >文章上線狀態</span
            >
            <input
              v-model="currentItem.platform_online"
              type="text"
              class="form-control"
              aria-label="Sizing example input"
              aria-describedby="inputGroup-sizing-lg"
            />
          </div>
          <div class="input-group input-group-lg">
            <span class="input-group-text" id="inputGroup-sizing-lg"
              >文章圖片</span
            >
            <!-- <input
              type="file"
              class="form-control"
              id="inputGroupFile02"
              @change="handleFileUpload"
            /> -->
          </div>
          <div class="model_body_pic">
            <!-- <img
              v-if="currentItem.article_image"
              :src="'/' + currentItem.article_image"
              alt="Image preview"
            /> -->
            <!-- NOTE 上線換這個 -->
            <img
              v-if="currentItem.article_image"
              :src="'/chd102/g1/' + currentItem.article_image"
              alt="Image preview"
            />
          </div>
        </div>

        <div class="modal-footer">
          <button
            type="button"
            class="btn btn-danger"
            data-bs-dismiss="modal"
            @click="
              deleteArticle(
                currentItem.article_no,
                currentItem.article_image_file
              )
            "
          >
            刪除文章
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
      // search
      searchText: "",
      // model
      currentItem: {},
      backupItem: {},
      showModal: false,
      selectedFile: null,

      // 抓 php 資料
      dataForum: [],
    };
  },

  computed: {
    // search
    filteredItems() {
      if (this.searchText === "") {
        return this.dataForum;
      }

      return this.dataForum.filter((item) =>
        Object.values(item).some((val) => String(val).includes(this.searchText))
      );
    },
  },

  methods: {
    // model
    // edit php
    saveChanges() {
      const formData = new FormData();
      formData.append("article_no", this.currentItem.article_no);
      formData.append("platform_online", this.currentItem.platform_online);

      axios
        .post(`${MAC_URL}/editForum.php`, formData)
        .then((response) => {
          if (response.data.msg) {
            // Handle success message
            alert(response.data.msg);
          }
          this.showModal = false;
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

    deleteArticle(article_no, article_image_file) {
      // 再次確認彈窗
      if (!confirm("您確定要刪除此文章嗎？")) {
        return; // 如果用戶選擇“取消”，則退出函數
      }

      const formData = new FormData();
      formData.append("article_no", article_no);
      formData.append("article_image_file", article_image_file);

      axios
        .post(`${MAC_URL}/deleteForum.php`, formData)
        .then((response) => {
          this.currentItem = {}; // 清除當前選定的文章
          location.reload(); //刷新頁面
          alert("已刪除文章成功！");
        })
        .catch((error) => {
          console.error("There was an error deleting the article:", error);
          alert("刪除失敗！");
        });
    },

    getArticles() {
      const type = "get"; // 設定要執行的操作，這裡是取得資料
      axios
        .get(`${MAC_URL}/getForum.php?type=${type}`)
        .then((response) => {
          this.dataForum = response.data; // 確保這個屬性與您的組件中用於顯示文章的屬性相匹配
          console.log("Data retrieved from MySQL:", this.dataForum);
        })
        .catch((error) => {
          console.error("There was an error fetching the data:", error);
        });
    },
  },

  // 抓 php 資料
  mounted() {
    this.getArticles();
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

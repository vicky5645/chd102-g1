<!-- 論壇文章留言管理 -->
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
        <th scope="col">留言ID</th>
        <th scope="col">文章ID</th>
        <th scope="col">會員編號</th>
        <th scope="col">留言內容</th>
        <th scope="col"></th>
      </tr>
    </thead>
    <tbody>
      <tr v-for="(item, index) in filteredItems" :key="index">
        <th scope="row">{{ item.comment_no }}</th>
        <td class="ellipsis">{{ item.article_no }}</td>
        <td class="ellipsis">{{ item.mem_no }}</td>
        <td class="ellipsis">{{ item.commen_content }}</td>
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
          <h5 class="modal-title" id="itemModalLabel">查看論壇文章留言</h5>
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
              >留言ID</span
            >
            <input
              v-model="currentItem.comment_no"
              type="text"
              class="form-control"
              aria-label="Sizing example input"
              aria-describedby="inputGroup-sizing-lg"
              disabled
            />
          </div>
          <div class="input-group input-group-lg">
            <span class="input-group-text" id="inputGroup-sizing-lg"
              >文章ID</span
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
              >留言內容</span
            >
            <textarea
              v-model="currentItem.commen_content"
              type="text"
              class="form-control"
              aria-label="Sizing example input"
              aria-describedby="inputGroup-sizing-lg"
              disabled
            >
            </textarea>
          </div>
        </div>

        <div class="modal-footer">
          <!-- <button
            type="button"
            class="btn btn-primary"
            data-bs-dismiss="modal"
            @click="saveChanges"
          >
            儲存變更
          </button> -->
          <button
            type="button"
            class="btn btn-danger"
            data-bs-dismiss="modal"
            @click="deleteComment(currentItem.comment_no)"
          >
            刪除留言
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
      // items: [
      //   {
      //     id: 1,
      //     articleNo: 1,
      //     memNo: 24,
      //     content:
      //       "我完全同意你的感受！我上個月也參加了這個旅程，從湖泊到草原的風景真的令人難以忘懷。導遊的專業解說也增添了旅程的樂趣。",
      //   },
      //   {
      //     id: 2,
      //     articleNo: 1,
      //     memNo: 26,
      //     content:
      //       "看了你的分享，我也很期待自己的蒸汽火車之旅！已經在計劃中了，希望能和你一樣有個美好的體驗。",
      //   },
      //   {
      //     id: 3,
      //     articleNo: 1,
      //     memNo: 29,
      //     content:
      //       "我非常同意你的看法！我也是第一次體驗蒸汽火車旅行，感覺就像被帶回了過去。那種獨特的懷舊風情讓人難以忘懷。",
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
      getForumMessage: [],
    };
  },

  computed: {
    // search
    filteredItems() {
      if (this.searchText === "") {
        return this.getForumMessage;
      }

      return this.getForumMessage.filter((item) =>
        Object.values(item).some((val) => String(val).includes(this.searchText))
      );
    },
  },

  methods: {
    // model

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

    deleteComment(comment_no) {
      // 再次確認彈窗
      if (!confirm("您確定要刪除此留言嗎？")) {
        return; // 如果用戶選擇“取消”，則退出函數
      }

      const formData = new FormData();
      formData.append("comment_no", comment_no);

      this.$store.state.Loading = true
      axios
        .post(`${MAC_URL}/deleteForumMessage.php`, formData)
        .then((response) => {
          this.currentItem = {}; // 清除當前選定的留言
          location.reload(); //刷新頁面
          alert("已刪除留言成功！");
        })
        .catch((error) => {
          console.error("There was an error deleting the article:", error);
          alert("刪除失敗！");
        });
        setTimeout(() => {
        this.$store.commit('closeLoading')
      }, 300)
    },

    getComment() {
      this.$store.state.Loading = true
      const type = "get";
      axios
        .get(`${MAC_URL}/getForumMessage.php?type=${type}`)
        .then((response) => {
          this.getForumMessage = response.data;
          console.log("Data retrieved from MySQL:", this.getForumMessage);
        })
        .catch((error) => {
          console.error("There was an error fetching the data:", error);
        });
        setTimeout(() => {
        this.$store.commit('closeLoading')
      }, 300)
    },
  },

  // 抓 php 資料
  mounted() {
    this.getComment();
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

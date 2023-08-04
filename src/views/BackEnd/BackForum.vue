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
    <!-- <button
      class="btn btn-outline-primary b_new"
      type="button"
      id="button-addon2"
      data-bs-toggle="modal"
      data-bs-target="#itemNewModal"
    >
      新增公告
    </button> -->
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
        <th scope="row">{{ item.id }}</th>
        <td class="ellipsis">{{ item.title }}</td>
        <td class="ellipsis">{{ item.content }}</td>
        <td class="ellipsis">{{ item.memNo }}</td>
        <td class="ellipsis">{{ item.date }}</td>
        <td class="ellipsis">{{ item.views }}</td>
        <td class="ellipsis">{{ item.likes }}</td>
        <td class="ellipsis">{{ item.online }}</td>
        <td class="ellipsis">{{ item.image }}</td>
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
      <div v-if="dataFromMySQL">
        {{ dataFromMySQL }}
      </div>
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
              v-model="currentItem.id"
              type="text"
              class="form-control"
              aria-label="Sizing example input"
              aria-describedby="inputGroup-sizing-lg"
            />
          </div>
          <div class="input-group input-group-lg">
            <span class="input-group-text" id="inputGroup-sizing-lg"
              >文章標題</span
            >
            <input
              v-model="currentItem.title"
              type="text"
              class="form-control"
              aria-label="Sizing example input"
              aria-describedby="inputGroup-sizing-lg"
            />
          </div>

          <div class="input-group input-group-lg">
            <span class="input-group-text" id="inputGroup-sizing-lg"
              >文章內容</span
            >
            <textarea
              v-model="currentItem.content"
              class="form-control"
              aria-label="Sizing example input"
              aria-describedby="inputGroup-sizing-lg"
            ></textarea>
          </div>
          <div class="input-group input-group-lg">
            <span class="input-group-text" id="inputGroup-sizing-lg"
              >會員編號</span
            >
            <input
              v-model="currentItem.memNo"
              type="text"
              class="form-control"
              aria-label="Sizing example input"
              aria-describedby="inputGroup-sizing-lg"
            />
          </div>
          <div class="input-group input-group-lg">
            <span class="input-group-text" id="inputGroup-sizing-lg"
              >編輯時間</span
            >
            <input
              v-model="currentItem.date"
              type="text"
              class="form-control"
              aria-label="Sizing example input"
              aria-describedby="inputGroup-sizing-lg"
            />
          </div>
          <div class="input-group input-group-lg">
            <span class="input-group-text" id="inputGroup-sizing-lg"
              >文章瀏覽數</span
            >
            <input
              v-model="currentItem.views"
              type="text"
              class="form-control"
              aria-label="Sizing example input"
              aria-describedby="inputGroup-sizing-lg"
            />
          </div>
          <div class="input-group input-group-lg">
            <span class="input-group-text" id="inputGroup-sizing-lg"
              >文章按讚數</span
            >
            <input
              v-model="currentItem.likes"
              type="text"
              class="form-control"
              aria-label="Sizing example input"
              aria-describedby="inputGroup-sizing-lg"
            />
          </div>
          <div class="input-group input-group-lg">
            <span class="input-group-text" id="inputGroup-sizing-lg"
              >文章上線狀態</span
            >
            <input
              v-model="currentItem.online"
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
            <input
              type="file"
              class="form-control"
              id="inputGroupFile02"
              @change="handleFileUpload"
            />
          </div>
          <div class="model_body_pic">
            <img
              v-if="currentItem.image"
              :src="currentItem.image"
              alt="Image preview"
            />
          </div>
        </div>

        <div class="modal-footer">
          <button
            type="button"
            class="btn btn-danger"
            data-bs-dismiss="modal"
            @click="deleteArticle"
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

export default {
  data() {
    return {
      items: [
        {
          id: 1,
          title: "首次的蒸汽火車體驗",
          content:
            "這是我第一次參加蒸汽火車之旅，體驗真是太棒了！從車窗外看著湖光山色，我感受到了旅行的悠閒與寧靜。整個行程由專業的導遊詳細解說，使我對這段旅程有更深的理解。我會向所有人推薦『漫遊列車之旅』。",
          memNo: 77,
          date: "2023/7/5",
          views: 0,
          likes: 0,
          online: 1, // 1: online, 0: offline
          image: require("../../assets/images/img/Forum/f1.png"),
        },
        {
          id: 2,
          title: "蒸汽火車與手工藝品的完美結合",
          content:
            "這次的旅程不僅讓我體驗了蒸汽火車的迷人魅力，還有機會參與當地的手工藝品製作。這種獨特的體驗讓我深深感受到當地的文化和傳統。",
          memNo: 12,
          date: "2023/7/5",
          views: 0,
          likes: 0,
          online: 1, // 1: online, 0: offline
          image: require("../../assets/images/img/Forum/f2.jpg"),
        },
      ],
      // search
      searchText: "",
      // model
      currentItem: {},
      backupItem: {},
      showModal: false,
      selectedFile: null,

      // 抓 php 資料
      dataFromMySQL: null,
    };
  },

  computed: {
    // search
    filteredItems() {
      if (this.searchText === "") {
        return this.items;
      }

      return this.items.filter((item) =>
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

    // delete article
    deleteArticle() {
      const index = this.items.findIndex(
        (item) => item.id === this.currentItem.id
      );
      if (index !== -1) {
        this.items.splice(index, 1);
        this.showModal = false;
      }
    },
  },

  // 抓 php 資料
  mounted() {
    axios
      .get("http://localhost:8886/phps/getData.php")
      .then((response) => {
        this.dataFromMySQL = response.data[0];

        // 打印取得的資料以確認是否成功
        console.log("Data retrieved from MySQL:", this.dataFromMySQL);
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

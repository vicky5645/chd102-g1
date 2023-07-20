<template>
  <!-- select bar -->
  <div class="search_new">
    <div class="input-group">
      <input
        v-model="searchText"
        type="text"
        class="form-control"
        placeholder="Search"
        aria-label="Search"
      />
      <button class="btn btn-outline-primary" type="button" id="button-addon2">
        搜尋
      </button>
    </div>
    <button
      class="btn btn-outline-primary b_new"
      type="button"
      id="button-addon2"
      data-bs-toggle="modal"
      data-bs-target="#itemNewModal"
    >
      新增公告
    </button>
  </div>

  <table class="table">
    <thead>
      <tr>
        <th scope="col">公告編號</th>
        <th scope="col">公告標題</th>
        <th scope="col">公告類型</th>
        <th scope="col">公告內容</th>
        <th scope="col">公告時間</th>
        <th scope="col">公告圖片</th>
        <th scope="col"></th>
      </tr>
    </thead>
    <tbody>
      <tr v-for="(item, index) in filteredItems" :key="index">
        <th scope="row">{{ item.id }}</th>
        <td class="ellipsis">{{ item.title }}</td>
        <td class="ellipsis">{{ item.type }}</td>
        <td class="ellipsis">{{ item.content }}</td>
        <td class="ellipsis">{{ item.date }}</td>
        <td class="ellipsis">{{ item.image }}</td>
        <td>
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
          <h5 class="modal-title" id="itemModalLabel">修改公告</h5>
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
              >公告編號</span
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
              >公告標題</span
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
              >公告類型</span
            >
            <input
              v-model="currentItem.type"
              type="text"
              class="form-control"
              aria-label="Sizing example input"
              aria-describedby="inputGroup-sizing-lg"
            />
          </div>
          <div class="input-group input-group-lg">
            <span class="input-group-text" id="inputGroup-sizing-lg"
              >公告內容</span
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
              >公告時間</span
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
              >公告圖片</span
            >
            <input
              type="file"
              class="form-control"
              id="inputGroupFile02"
              @change="handleFileUpload"
            />
          </div>
          <div class="modeel_body_pic">
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
            class="btn btn-primary"
            data-bs-dismiss="modal"
            @click="saveChanges"
          >
            儲存變更
          </button>
          <!-- <button
            type="button"
            class="btn btn-secondary"
            @click="cancelChanges"
          >
            取消
          </button> -->
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
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <slot name="header"> 新增公告 </slot>
        </div>

        <div class="modal-body">
          <slot name="body">
            <div
              class="modal-body gap-2"
              style="display: flex; flex-direction: column"
            >
              <div class="input-group input-group-lg">
                <span class="input-group-text" id="inputGroup-sizing-lg"
                  >公告編號</span
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
                  >公告標題</span
                >
                <input
                  v-model="newAnnouncement.title"
                  type="text"
                  class="form-control"
                  aria-label="Sizing example input"
                  aria-describedby="inputGroup-sizing-lg"
                />
              </div>
              <div class="input-group input-group-lg">
                <span class="input-group-text" id="inputGroup-sizing-lg"
                  >公告類型</span
                >
                <input
                  v-model="newAnnouncement.type"
                  type="text"
                  class="form-control"
                  aria-label="Sizing example input"
                  aria-describedby="inputGroup-sizing-lg"
                />
              </div>
              <div class="input-group input-group-lg">
                <span class="input-group-text" id="inputGroup-sizing-lg"
                  >公告內容</span
                >
                <textarea
                  v-model="newAnnouncement.content"
                  class="form-control"
                  aria-label="Sizing example input"
                  aria-describedby="inputGroup-sizing-lg"
                ></textarea>
              </div>
              <div class="input-group input-group-lg">
                <span class="input-group-text" id="inputGroup-sizing-lg"
                  >公告時間</span
                >
                <input
                  v-model="newAnnouncement.date"
                  type="text"
                  class="form-control"
                  aria-label="Sizing example input"
                  aria-describedby="inputGroup-sizing-lg"
                />
              </div>
              <div class="input-group input-group-lg">
                <span class="input-group-text" id="inputGroup-sizing-lg"
                  >公告圖片</span
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
                  v-if="newAnnouncement.image"
                  :src="newAnnouncement.image"
                  alt="Image preview"
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
import { Modal } from "bootstrap";

export default {
  data() {
    return {
      items: [
        {
          id: 1,
          title: "全新的蒸汽火車旅程上線",
          type: "重要",
          content:
            "我們非常榮幸地宣布，“湖光山色”全新蒸汽火車之旅現已開放預訂！這個行程將帶領您從城市的喧囂中抽身，進入壯麗的大自然，穿越秀美的山脈，欣賞湖光山色的美景。在這次旅程中，您將有機會體驗古老的蒸汽火車，聆聽其叮叮噹噹的旋律，感受時光倒流的魔力。不要錯過這次與大自然親近的絕佳機會，現在就開始預訂吧！",
          date: "2023/7/5",
          image: require("../../assets/images/img/Announcements/a1.png"),
        },
        {
          id: 2,
          title: "特別節日優惠",
          type: "活動",
          content:
            "中秋節即將來臨，為慶祝這個重要的節日，我們決定提供特別優惠！從今日起至下月15日，只要預訂任何一個我們提供的行程，都將可以享受10%的折扣。這是我們首次提供如此大幅度的折扣，希望您能把握住這個難得的機會。讓我們在中秋月圓人團圓的美好時刻，一起享受迷人的蒸汽火車旅行吧！",
          date: "2023/7/5",
          image: require("../../assets/images/img/Announcements/a2.png"),
        },
        {
          id: 3,
          title: "全新合作夥伴-當地手工藝品體驗",
          type: "活動",
          content:
            "當地手工藝品體驗：我們相信旅行不只是眼睛的饗宴，也應該是深入當地文化的體驗。為此，我們很高興地宣布，我們與當地的手工藝品製作師傅達成了合作關係！在我們的蒸汽火車之旅中，您將有機會直接參與製作當地獨特的手工藝品，如陶瓷、編織或是木雕等。這不僅可以讓您帶回家一份富有當地特色的紀念品，更是讓您更深入體驗當地的文化與工藝。別錯過這個獨一無二的機會，現在就開始預訂您的蒸汽火車之旅！",
          date: "2023/7/5",
          image: require("../../assets/images/img/Announcements/a3.png"),
        },
        {
          id: 4,
          title: "永續旅遊的承諾",
          type: "重要",
          content:
            "在『漫遊列車之旅』，我們深知旅遊活動對環境的影響，因此我們決心致力於永續旅遊。我們很高興地宣布，我們已經開始進行一項新的計劃，這個計劃旨在降低我們的碳足跡，並支持當地的環保工作。每預訂一個行程，我們將捐出一部分的收益用於植樹活動，以抵消我們的碳排放。同時，我們也正在積極與當地的環保組織合作，提供更多的支援和幫助。我們期待您的參與，一起為了更美好的地球做出努力！",
          date: "2023/7/5",
          image: require("../../assets/images/img/Announcements/a4.png"),
        },
      ],
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
        title: "",
        type: "",
        content: "",
        date: "",
        image: null,
      },
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

    // new model
    submitAnnouncement() {
      if (
        !this.newAnnouncement.id ||
        !this.newAnnouncement.title ||
        !this.newAnnouncement.type ||
        !this.newAnnouncement.content ||
        !this.newAnnouncement.date
      ) {
        alert("所有欄位都必須填寫！");
        return;
      }

      console.log(this.newAnnouncement);
      this.clearAnnouncement();
      this.newAnnouncement = {
        id: "",
        title: "",
        type: "",
        content: "",
        date: "",
        image: null,
      };
      const modalEl = document.getElementById("itemNewModal");
      const modalInstance = Modal.getInstance(modalEl);
      modalInstance.hide();
    },

    clearAnnouncement() {
      this.newAnnouncement = {
        id: "",
        title: "",
        type: "",
        content: "",
        date: "",
        image: null,
      };
    },
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
.modeel_body_pic {
  width: 100%;
  img {
    width: 100%;
    height: 100%;
    object-fit: cover;
  }
}
</style>

<!-- 公告管理 -->
<template>
  <!-- select bar -->

  <div class="search_new">
    <div class="col-md-2"><select ref="selected" class="form-select" @change="selectOption">
        <option ref="select" value="0">全部查詢</option>
        <option ref="select" value="1">公告編號</option>
        <option ref="select" value="2">公告標題</option>
        <option ref="select" value="3">公告類型</option>
        <option ref="select" value="4">公告內容</option>
        <option ref="select" value="5"> 公告時間</option>
      </select></div>
    <div class="input-group">
      <input v-model="searchText" type="text" class="form-control col" placeholder="輸入文字查詢" aria-label="Search" />
      <!-- <button class="btn btn-outline-primary" type="button" id="button-addon2">
        搜尋
      </button> -->
    </div>
    <button class="btn btn-outline-primary b_new col" type="button" id="button-addon2" data-bs-toggle="modal"
      data-bs-target="#itemNewModal">
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
      <tr v-for="(item, index) in filteredItems" :key="item.id">
        <th scope="row">{{ item.id }}</th>
        <td class="ellipsis">{{ item.title }}</td>
        <td class="ellipsis">{{ item.type }}</td>
        <td class="ellipsis">{{ item.content }}</td>
        <td class="ellipsis">{{ item.date }}</td>
        <td class="ellipsis">
          <Images :imgURL="`${getImgPath(index)}`" :alt="`Image preview`" />
        </td>
        <td style="text-align: right">
          <button type="button" class="btn btn-outline-primary" style="margin-left: auto" @click="openModal(item)">
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
  <div  class="modal fade" id="itemModal" tabindex="-1" aria-labelledby="itemModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" style="max-width: 80%">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="itemModalLabel">修改公告</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
            @click="cancelChanges"></button>
        </div>

        <!-- modal body -->
        <div style="display: flex; flex-direction: column" class="modal-body gap-2">
          <div class="input-group input-group-lg">
            <span class="input-group-text" id="inputGroup-sizing-lg">公告編號</span>
            <input v-model="currentItem.id" type="text" class="form-control" aria-label="Sizing example input"
              aria-describedby="inputGroup-sizing-lg" disabled="true" />
          </div>
          <div class="input-group input-group-lg">
            <span class="input-group-text" id="inputGroup-sizing-lg">公告標題</span>
            <input v-model="currentItem.title" type="text" class="form-control" aria-label="Sizing example input"
              aria-describedby="inputGroup-sizing-lg" />
          </div>
          <div class="input-group input-group-lg">
            <span class="input-group-text" id="inputGroup-sizing-lg">公告類型</span>
            <input v-model="currentItem.type" type="text" class="form-control" aria-label="Sizing example input"
              aria-describedby="inputGroup-sizing-lg" />
          </div>
          <div class="input-group input-group-lg">
            <span class="input-group-text" id="inputGroup-sizing-lg">公告內容</span>
            <textarea v-model="currentItem.content" class="form-control" aria-label="Sizing example input"
              aria-describedby="inputGroup-sizing-lg"></textarea>
          </div>
          <div class="input-group input-group-lg">
            <span class="input-group-text" id="inputGroup-sizing-lg">公告時間</span>
            <input v-model="currentItem.date" type="text" class="form-control" aria-label="Sizing example input"
              aria-describedby="inputGroup-sizing-lg" disabled="true" />
          </div>
          <div class="input-group input-group-lg">
            <span class="input-group-text" id="inputGroup-sizing-lg">公告圖片</span>
            <input type="file"  ref="change_img" class="form-control" id="inputGroupFile01" @change="handleFileUpload" />
          </div>
          <div class="model_body_pic">
            <Images v-if="currentItem.image && label_toggle" :imgURL="currentItem.image" alt="Image preview" />
            <img v-else :src="currentItem.image" alt="Image preview" />
          </div>
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-bs-dismiss="modal" @click="deleteAnnouncement">
            刪除公告
          </button>
          <button type="button" class="btn btn-primary" data-bs-dismiss="modal" @click="saveChanges">
            儲存變更
          </button>
        </div>
      </div>
    </div>
  </div>

  <!-- new modal -->
  <div class="modal fade" id="itemNewModal" tabindex="-1" aria-labelledby="itemModalLabel" aria-hidden="true">
    <div class="modal-dialog" style="max-width: 80%">
      <div class="modal-content">
        <div class="modal-header">
          <h5 name="header">新增公告</h5>
        </div>

        <div class="modal-body">
          <slot name="body">
            <div class="modal-body gap-2" style="display: flex; flex-direction: column">
              <!-- <div class="input-group input-group-lg">
                <span class="input-group-text" id="inputGroup-sizing-lg">公告編號</span>
                <input v-model="newAnnouncement.id" type="text" class="form-control" aria-label="Sizing example input"
                  aria-describedby="inputGroup-sizing-lg" />
              </div> -->
              <div class="input-group input-group-lg">
                <span class="input-group-text" id="inputGroup-sizing-lg">公告標題</span>
                <input v-model="newAnnouncement.title" type="text" class="form-control" aria-label="Sizing example input"
                  aria-describedby="inputGroup-sizing-lg" />
              </div>
              <div class="input-group input-group-lg">
                <span class="input-group-text" id="inputGroup-sizing-lg">公告類型</span>
                <input v-model="newAnnouncement.type" type="text" class="form-control" aria-label="Sizing example input"
                  aria-describedby="inputGroup-sizing-lg" />
              </div>
              <div class="input-group input-group-lg">
                <span class="input-group-text" id="inputGroup-sizing-lg">公告內容</span>
                <textarea v-model="newAnnouncement.content" class="form-control" aria-label="Sizing example input"
                  aria-describedby="inputGroup-sizing-lg"></textarea>
              </div>
              <!-- <div class="input-group input-group-lg">
                <span class="input-group-text" id="inputGroup-sizing-lg">公告時間</span>
                <input v-model="newAnnouncement.date" type="text" class="form-control" aria-label="Sizing example input"
                  aria-describedby="inputGroup-sizing-lg" />
              </div> -->
              <div class="input-group input-group-lg">
                <span class="input-group-text" id="inputGroup-sizing-lg">公告圖片</span>
                <input  type="file" ref="plus_img" class="form-control" id="inputGroupFile02" name="image"
                  @change="handleFileUpload" />
              </div>
              <div class="model_body_pic">
                <img v-if="newAnnouncement.image" :src="newAnnouncement.image" />
              </div>
            </div>
          </slot>
        </div>
        <div class="modal-footer">
          <slot name="footer">
            <button class="btn btn-secondary" data-bs-dismiss="modal" @click="clearAnnouncement()">
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
import { BASE_URL} from "@/assets/js/common.js";
import { Modal } from "bootstrap";
import axios from 'axios'
import { left } from "@popperjs/core";
export default {
  data() {
    return {
      AnnouncementArr: [],
      label_toggle: true,
      selectFieldKey: 0,
      // search
      searchText: "",
      // model
      currentItem: {
        id: "", // 確保 id 屬性存在
        title: "",
        type: "",
        content: "",
        date: "",
        image: null,
      },
      backupItem: {},
      showModal: false,
      showInput: true,
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
    //選欄位加搜尋
    filteredItems() {
      if (this.searchText === "") {
        return this.AnnouncementArr
      }

      return this.AnnouncementArr.filter((item) =>
        (this.selectFieldKey ? [Object.values(item)[this.selectFieldKey - 1]]
          : Object.values(item).filter((element, index, arr) => index < arr.length - 1))
          .some((val) => String(val)
            .includes(this.searchText))
      );
    },
  },


  methods: {
    // model
    //修改
    async saveChanges() {
      // 在這裡更新資料
      // 如有需要，你也可以將 currentItem 傳到後端
      // this.currentItem = { ...this.backupItem };
      try {
        const index = this.AnnouncementArr.findIndex((item) => item.id === this.currentItem.id);
        if (index !== -1) {
          const formData = new FormData();
          Object.keys(this.currentItem).forEach((key) => {
            formData.append(`${key}`, this.currentItem[key])
          })
          if (this.$refs.change_img.files[0]) {
            formData.set('image', this.$refs.change_img.files[0]);
          }
          const res = await axios.post(`${BASE_URL}updateBackendAnnouncements.php`, formData,
            {
              headers: {
                'Content-Type': 'multipart/form-data',
              },
            })
          alert(`${res.data.msg}`);
          this.showModal = false;
        }

      } catch (error) {
        console.error("An error occurred:", error);
        alert("修改失敗請重新操作")
      }

      this.backgetAnnouncementData();
      this.showModal = false;
    },

    cancelChanges() {
      // this.currentItem = { ...this.backupItem };
      this.showModal = false;
    },
    openModal(item) {
      this.label_toggle = true;
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
    handleFileUpload(event) {
      const files = event.target.files;
      if (files.length === 0) {
        return;
      }
      const file = files[0];

      const reader = new FileReader();
      reader.onload = (e) => {
        this.currentItem.image = e.target.result;
        this.newAnnouncement.image = e.target.result;
        this.label_toggle = false;
      };
      reader.readAsDataURL(file);
    },



    // new model
    submitAnnouncement() {
      if (
        // !this.newAnnouncement.id ||
        !this.newAnnouncement.title ||
        !this.newAnnouncement.type ||
        !this.newAnnouncement.content
        // ||!this.newAnnouncement.date
      ) {
        alert("所有欄位都必須填寫！");
        return;
      } else {
        this.addAnnouncements()
      }

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

    //刪除
    async deleteAnnouncement() {
      try {
        const index = this.AnnouncementArr.findIndex((item) => item.id === this.currentItem.id);
        if (index !== -1) {
          const res = await axios({
            method: 'post',
            url: `${BASE_URL}deleteBackendAnnouncements.php`,
            data: { id: this.currentItem.id },
          });
          alert(`${res.data.msg}`)
        }
      } catch (error) {
        console.error("An error occurred:", error);
        alert("刪除失敗請重新操作")
      }
      this.backgetAnnouncementData();
      this.showModal = false;
    },


    //新增
    async addAnnouncements() {
      try {
        const formData = new FormData();
        Object.keys(this.newAnnouncement).forEach((key) => {
          formData.append(`${key}`, this.newAnnouncement[key])
        })
        formData.set('image', this.$refs.plus_img.files[0]);
        const res = await axios.post(`${BASE_URL}addBackendAnnouncements.php`, formData,
          {
            headers: {
              'Content-Type': 'multipart/form-data',
            },
          })
        alert(`${res.data.msg}`)
      } catch (error) {
        console.error("An error occurred:", error);
        alert("新增失敗,請重新操作")
      }
      this.backgetAnnouncementData();
    },

    getImgPath(index) {
      return this.AnnouncementArr[index].image;
      // return require(`../../assets/images/img/Announcements/${this.$store.state.AnnouncementData[index].anno_file}`)
    },
    //取資料
    async backgetAnnouncementData() {
      await this.$store.dispatch("getAnnouncementData")
      this.AnnouncementArr = []
      this.$store.state.AnnouncementData.forEach(element => {
        const { anno_no: id, anno_title: title, anno_type: type, anno_content: content, anno_date: date, anno_file: image } = element
        this.AnnouncementArr.push({
          id,
          title,
          type,
          content,
          date,
          image
        })
      });
    },
    //選擇篩選欄位
    selectOption() {
      this.selectFieldKey = parseInt(this.$refs.selected.value)
    }
  },
  created() {
    this.backgetAnnouncementData();
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

  img {
    width: 100%;
    height: 100%;
  }
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

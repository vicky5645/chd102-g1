<template>
  <div class="user">
    <aside class="col-md-3">
      <div class="profile-top">
        <div class="avatar" @click="isModalVisible = true">
          <template v-if="userInfo !== null && userInfo.pattern_file !== null">
            <Images :imgURL="`${userInfo.pattern_file}`" :alt="`avatar`" />
          </template>
          <template v-else>
            <Images :imgURL="`images/logo/logoBlack.png`" :alt="`avatar`" />
          </template>
        </div>
        <div v-if="userInfo !== null">
          {{ userInfo.mem_name }}
        </div>
        <div v-else>Guest</div>
      </div>
      <div class="link-list">
        <router-link
          to="/user/"
          :class="{ active: $route.name === 'userinfo' }"
        >
          <li>
            <div class="icon-24">
              <i class="fa-solid fa-gear"></i>
            </div>
            <span class="label">帳號設定</span>
          </li>
        </router-link>
        <router-link
          to="/user/order"
          :class="{ active: $route.name === 'userorder' }"
        >
          <li>
            <div class="icon-24">
              <i class="fa-solid fa-list-ul"></i>
            </div>
            <span class="label">訂單管理</span>
          </li>
        </router-link>
        <router-link
          to="/user/forum"
          :class="{ active: $route.name === 'userforum' }"
        >
          <li>
            <div class="icon-24">
              <i class="fa-regular fa-comments"></i>
            </div>
            <span class="label">論壇訊息</span>
          </li>
        </router-link>
        <router-link
          to="/user/like"
          :class="{ active: $route.name === 'userlike' }"
        >
          <li>
            <div class="icon-24">
              <i class="fa-solid fa-heart"></i>
            </div>
            <span class="label">我的收藏</span>
          </li>
        </router-link>
      </div>
    </aside>
    <main class="col-12 user-control-content">
      <router-view></router-view>
    </main>
  </div>
  <!-- 顯示更換頭貼modal -->
  <div v-if="isModalVisible" class="modal">
    <div class="modal-content row">
      <div class="preview">
        <p>圖片預覽</p>
        <Images
          v-if="this.userInfo.pattern_file && !this.newImage.member_file"
          :imgURL="`${this.userInfo.pattern_file}`"
          alt=""
        />
        <img
          v-if="this.newImage.member_file"
          :src="`${this.newImage.member_file}`"
          :alt="`Image preview`"
          :id="`imgPreview`"
        />
      </div>
      <!-- 選圖片上傳-->
      <div class="upload-file">
        <p>新增/變更圖片</p>
        <input
          type="file"
          name="memImage"
          accept="image/*"
          @change="fileUpload"
        />

        <!-- 取消/儲存 -->
        <div class="wrap">
          <button class="btn small cancel" @click="closeModal">取消</button>
          <button class="btn small save" @click="saveChange">儲存</button>
        </div>
      </div>
    </div>
  </div>
  <div class="pageMask" v-show="isModalVisible" @click="closeModal"></div>
</template>

<script>
import { toHandlers } from "vue";
import axios from "axios";
import { BASE_URL } from "@/assets/js/common.js";

export default {
  data() {
    return {
      userInfo: null,

      isModalVisible: false,

      newImage: {
        member_file: null,
      },

      // userInfo: {
      //   mem_no: 1,
      //   mem_name: "",
      //   mem_salutation: "先生",
      //   mem_email: "",
      //   mem_mobile: "0912345678",
      //   mem_addr: "台北市中正區",
      //   mem_acc: "wangxm",
      //   mem_pwd: "password1",
      //   pattern_file: "https://picsum.photos/100/100/?random=22",
      // },
    };
  },

  methods: {
    closeModal() {
      this.newImage["member_file"] = null;

      this.isModalVisible = !this.isModalVisible;
    },

    fileUpload(event) {
      const files = event.target.files;
      if (files.length === 0) {
        return;
      }

      const file = files[0];
      const reader = new FileReader();

      reader.onload = (e) => {
        this.newImage.member_file = e.target.result;
        this.newImage.member_file_name = file.name;
      };
      reader.readAsDataURL(file);
    },

    async saveChange() {
      this.isModalVisible = !this.isModalVisible;
      // const index = this.dataFromMySQL.findIndex(
      //   (item) => item.spot_no === this.currentItem.spot_no
      // );
      // if (index !== -1) {
      // 這裡刪除的是vue this.data
      //   this.dataFromMySQL.splice(index, 1);
      //   this.showModal = false;
      // }
      //傳送資料庫的資料
      // 修改圖檔時，接收變數
      let imgFile = this.newImage.member_file;

      const data = new URLSearchParams(); //這不需要?
      // data.append("spot_no", this.currentItem.spot_no);
      // data.append("spot_name", this.currentItem.spot_name);
      // data.append("spot_info", this.currentItem.spot_info);
      // data.append("spot_status", this.currentItem.spot_status);

      if (imgFile) {
        if (!this.userInfo.pattern_file) {
          data.append("type", "newImg");
        } else {
          data.append("type", "editImg");
          data.append("pattern_file", this.userInfo.pattern_file);
        }
        data.append("mem_no", this.userInfo.mem_no);
        data.append("new_filename", this.newImage.member_file_name); // imgFile 是文件对象
        data.append("new_img", imgFile);
        // console.log("new_img", imgFile);
      }
      // 使用 Axios 發送 POST 請求
      try {
        const response = await axios.post(
          `${BASE_URL}editMemberImage.php`,
          data
        );

        // 請求成功後的處理
        // location.reload(); //刷新頁面

        alert("修改成功！");
      } catch (error) {
        // 請求失敗後的處理
        console.error(error);
        alert("修改失敗！");
      }

      // location.reload();
      this.getdataFromMySQL();
    },
    //取資料
    async getdataFromMySQL() {
      // this.userInfo = null;
      // const data = new FormData();  POST 表單資料
      // data.append("type", "authMixin");
      // data.append("mem_email", this.$store.state.userInfo.mem_email);
      try {
        const response = await axios.post(`${BASE_URL}getMember.php`);
        this.userInfo = response.data.find((element) => {
          return element.mem_no === this.userInfo.mem_no
        })

        // 確認是否成功
        console.log("Data retrieved from MySQL:", "dataFromMySQL");
      } catch (error) {
        console.error("There was an error fetching the data:", error);
      }
    },
  },
  created() {
    this.userInfo = this.$store.state.userInfo;
    this.getdataFromMySQL();
  },
};
</script>

<style lang="scss" scoped>
.avatar {
  cursor: pointer;
}

.modal-content {
  .preview {
    // margin: auto;
    width: 100%;
    img {
      width: 100%;
      height: 100%;
      object-fit: cover;
    }
  }
  .upload-file {
    margin: auto;

    input {
      margin: 1rem 0;
      display: block;
      border: 1px solid black;
    }

    .wrap {
      display: flex;
      justify-content: space-around;
      button {
        color: white;
        border-radius: 10px;
        &.cancel {
          background-color: #d1d5db;
          &:hover {
            background-color: darken(#d1d5db, 20);
          }
        }

        &.save {
          background-color: #302af2;
          &:hover {
            background-color: darken(#302af2, 20);
          }
        }
      }
    }
  }
}

/* 定義彈出視窗 */
.modal {
  //   background-color: ;
  position: fixed;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  z-index: 100;
}

.pageMask {
  background-color: rgba(black, 0.3);
  width: 100vw;
  height: 100vh;
  position: fixed;
  top: 0;
  left: 0;
  z-index: 99;
}
</style>

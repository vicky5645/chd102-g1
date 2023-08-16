<template>
  <div class="settings">
    <h1 class="h4">帳號設定</h1>
    <hr />
    <div class="user-control-content">
      <!-- {{ userInfo }}
      {{ $store.state.userInfo }} -->
      <div class="input-wrap">
        <label for="name" class="caption">姓名</label>
        <input
          type="text"
          name="name"
          v-if="userInfo"
          v-model="userInfo.mem_name"
        />
      </div>
      <div class="input-wrap">
        <label for="gender" class="caption">性別</label>
        <select id="gender-options" v-model="userInfo.mem_salutation">
          <option disabled checked>-請選擇-</option>
          <option v-for="item in gender" :value="item.value">
            {{ item.value }}
          </option>
        </select>
      </div>
      <div class="input-wrap">
        <label for="birthdate" class="caption">出生日期</label>
        <input type="date" id="birthdate" />
      </div>
      <div class="input-wrap">
        <label for="phone" class="caption">電話號碼</label>
        <input
          type="tel"
          id="phone"
          v-if="userInfo"
          v-model="userInfo.mem_mobile"
        />
      </div>
      <div class="input-wrap long">
        <label for="email" class="caption" required>聯絡 E-mail(必填)</label>
        <input
          disabled
          type="email"
          id="email"
          v-if="userInfo"
          v-model="userInfo.mem_email"
        />
      </div>
    </div>
    <div class="right">
      <template v-if="isUserInfoChanged">
        <button
          type="button"
          class="btn radius primary"
          @click="saveChanges(userInfo)"
        >
          儲存
        </button>
      </template>
      <template v-else>
        <button type="button" class="btn radius disable">儲存</button>
      </template>
    </div>
    <hr />
    <h4>帳號安全</h4>
    <div class="left">
      <button class="btn error radius" @click="showDetail('deleteUser')">
        刪除帳號
      </button>
    </div>
  </div>
  <div class="detail-modal" v-show="isVisible['deleteUser']">
    <div class="content">
      <h4 class="text">確定刪除帳號</h4>
      <div class="subtext text_14">
        <p>
          請注意，這個操作是不可逆的，一旦刪除帳號，所有相關資料將被永久刪除且無法恢復。請確認您的決定，這將導致您無法再使用該帳號登入並享受我們的服務。
        </p>
        <p>
          如果您確定要刪除帳號，請按下確認按鈕以繼續。如有任何疑問或需要協助，請聯繫我們的客服團隊，我們將樂意協助您。
        </p>
        <p>
          如果您確定刪除，請點擊確認按鈕。如有任何疑問或需要協助，請隨時與我們聯繫。謝謝您的配合！
        </p>
        <p>謝謝您曾經使用我們的服務，希望能再次為您提供卓越的體驗。</p>
      </div>
      <div class="icon-24 error" @click="hideDetail('deleteUser')">
        <img
          class="custom-svg"
          src="@/assets/images/icon/menu/close_big.svg"
          alt="close_big-icon"
        />
      </div>
      <div class="btn-space">
        <button
          type="submit"
          class="btn other radius"
          @click="hideDetail('deleteUser')"
        >
          取消
        </button>
        <button
          type="submit"
          class="btn error radius"
          @click="hideDetail('deleteUser')"
        >
          確認刪除
        </button>
      </div>
    </div>
    <div
      class="pageMask"
      v-show="isVisible['deleteUser']"
      @click="hideDetail('deleteUser')"
    ></div>
  </div>
</template>

<script>
import axios from "axios";
import { BASE_URL } from "@/assets/js/common.js";
export default {
  data() {
    return {
      isUserInfoChanged: false,
      start: false,
      userInfo: null,
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
      isVisible: {
        deleteUser: false,
      },
      model: "-請選擇-",
      gender: [
        {
          value: "男性",
        },
        {
          value: "女性",
        },
      ],
    };
  },
  methods: {
    showDetail(itemOrder) {
      this.isVisible[itemOrder] = true;
    },
    hideDetail(itemOrder) {
      this.isVisible[itemOrder] = false;
    },
    showOrderDetail(itemOrder) {
      this.isModalVisible = true;
      this.orderDetail = itemOrder;
    },
    // edit model
    async saveChanges(item) {
      //傳送資料庫的資料
      const data = new FormData(); // POST 表單資料
      data.append("mem_no", item.mem_no);
      data.append("mem_name", item.mem_name);
      data.append("mem_salutation", item.mem_salutation);
      data.append("mem_email", item.mem_email);
      data.append("mem_mobile", item.mem_mobile);
      // 使用 Axios 發送 POST 請求
      await axios
        .post(`${BASE_URL}editMember.php`, data)
        .then((response) => {
          // 請求成功後的處理
          console.log(response.data);
          // 重新取得資料
          alert("已修改會員成功！");
          // this.getdataFromMySQL();
          this.getMember(item.mem_email, (MemberData) => {
            const getData = MemberData[0];
            // console.log("getData::", getData);

            // 已接收到資料庫內的會員資料
            if (getData) {
              console.log("getData::mem_name", getData["mem_name"]);
              // 將資料紀錄在 sessionStorage 中
              this.updateUserInfo(getData);
            }
            location.reload();
          });
        })
        .catch((error) => {
          // 請求失敗後的處理
          console.error(error);
          console.log("修改失敗！");
        });
    },
    updateUserInfo(getData) {
      // Your update user info logic here
      const userInfo = {
        // uid: getData["uid"],
        mem_no: getData["mem_no"],
        mem_name: getData["mem_name"],
        mem_salutation: getData["mem_salutation"],
        mem_email: getData["mem_email"],
        mem_mobile: getData["mem_mobile"],
        mem_addr: getData["mem_addr"],
        mem_acc: getData["mem_acc"],
        mem_pwd: getData["mem_pwd"],
        pattern_file: getData["pattern_file"],
      };
      this.$store.commit("updateUser", userInfo);
    },
    getMember(userEmail, callback) {
      const data = new FormData(); // POST 表單資料
      data.append("type", "authMixin");
      data.append("mem_email", userEmail);

      // if (this.existUser !== null && this.getMemberData.length === 0) {
      // 使用 Axios 發送 POST 請求
      axios
        .post(`${BASE_URL}getMember.php`, data)
        .then((response) => {
          // 請求成功後的處理
          this.userInfo = response.data;
          console.log("取得資料庫會員資料！");
          // 調用回調函數處理data
          if (callback) {
            callback(this.userInfo);
          }
        })
        .catch((error) => {
          // 請求失敗後的處理
          console.error(error);
          console.log("接收失敗！");
        });
      // }
    },
  },
  watch: {
    userInfo: {
      handler(newVal, oldVal) {
        if (
          JSON.stringify(newVal) !== JSON.stringify(this.$store.state.userInfo)
        ) {
          this.isUserInfoChanged = true;
        } else {
          this.isUserInfoChanged = false;
        }
      },
      deep: true,
    },
  },
  created() {
    this.userInfo = this.$store.state.userInfo;
  },
};
</script>

<style lang="scss" scoped>
/* 定義彈出視窗 */
.detail-modal > .content {
  // background-color: #fff;
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

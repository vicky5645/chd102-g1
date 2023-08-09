<template>
  <div class="settings">
    <h1 class="h4">帳號設定</h1>
    <hr>
    <div class="user-control-content">
      {{ $store.state.userInfo }}
      <div class="input-wrap">
        <label for="name" class="caption">姓名</label>
        <input type="text" id="name">
      </div>
      <div class="input-wrap">
        <label for="gender" class="caption">性別</label>
        <select id="gender-options" v-model="model">
          <option disabled checked>-請選擇-</option>
          <option v-for="item in gender" :value="item.value">{{ item.value }}</option>
        </select>
      </div>
      <div class="input-wrap">
        <label for="birthdate" class="caption">出生日期</label>
        <input type="date" id="birthdate">
      </div>
      <div class="input-wrap">
        <label for="phone" class="caption">電話號碼</label>
        <input type="tel" id="phone">
      </div>
      <div class="input-wrap long">
        <label for="email" class="caption" required>聯絡 E-mail(必填)</label>
        <input type="email" id="email" :value="$store.state.userInfo.email">
      </div>
    </div>
    <div class="right">
      <button type="submit" class="btn disable radius">儲存</button>
    </div>
    <hr>
    <h4>帳號安全</h4>
    <div class="left">
      <button class="btn error radius" @click="showDetail('deleteUser')">刪除帳號</button>
    </div>
  </div>
  <div class="detail-modal" v-show="isVisible['deleteUser']">
    <div class="content">
      <h4 class="text">確定刪除論壇文章</h4>
      <div class="subtext text_14">
        <p>請注意，這個操作是不可逆的，一旦刪除帳號，所有相關資料將被永久刪除且無法恢復。請確認您的決定，這將導致您無法再使用該帳號登入並享受我們的服務。</p>
        <p>如果您確定要刪除帳號，請按下確認按鈕以繼續。如有任何疑問或需要協助，請聯繫我們的客服團隊，我們將樂意協助您。</p>
        <p>如果您確定刪除，請點擊確認按鈕。如有任何疑問或需要協助，請隨時與我們聯繫。謝謝您的配合！</p>
        <p>謝謝您曾經使用我們的服務，希望能再次為您提供卓越的體驗。</p>
      </div>
      <div class="icon-24 error" @click="hideDetail('deleteUser')">
        <img class="custom-svg" src="@/assets/images/icon/menu/close_big.svg" alt="close_big-icon">
      </div>
      <div class="btn-space">
        <button type="submit" class="btn other radius" @click="hideDetail('deleteUser')">取消</button>
        <button type="submit" class="btn error radius" @click="hideDetail('deleteUser')">確認刪除</button>
      </div>
    </div>
    <div class="pageMask" v-show="isVisible['deleteUser']" @click="hideDetail('deleteUser')"></div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      isVisible: {
        deleteUser: false
      },
      model: '-請選擇-',
      gender: [
        {
          value: '男性',
          label: '男性'
        },
        {
          value: '女性',
          label: '女性'
        },
      ],
    }
  },
  methods: {
    showDetail(itemOrder) {
      this.isVisible[itemOrder] = true;
    },
    hideDetail(itemOrder) {
      this.isVisible[itemOrder] = false;
    }
  },
}
</script>

<style lang="scss" scoped>
/* 定義彈出視窗 */
.detail-modal>.content {
  // background-color: #fff;
  position: fixed;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  z-index: 100;
}

.pageMask {
  background-color: rgba(black, .3);
  width: 100vw;
  height: 100vh;
  position: fixed;
  top: 0;
  left: 0;
  z-index: 99;
}
</style>

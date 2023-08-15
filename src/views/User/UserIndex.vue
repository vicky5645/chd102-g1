<template>
  <div class="user">
    <aside class="col-md-3">
      <div class="profile-top">
        <div class="avatar">
          <template v-if="userInfo !== null && userInfo.pattern_file !== null">
            <Images :imgURL="`${userInfo.pattern_file}`" :alt="`avatar`" />
          </template>
          <template v-else>
            <Images :imgURL="`images/logo/logoBlack.png`" :alt="`avatar`" style="border: 2px solid #7AACBF"/>
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
              <img
                class="custom-svg"
                src="@/assets/images/icon/basic/settings.svg"
                alt="settings-icon"
              />
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
              <img
                class="custom-svg"
                src="@/assets/images/icon/basic/list.svg"
                alt="list-icon"
              />
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
              <img
                class="custom-svg"
                src="@/assets/images/icon/basic/message_writing.svg"
                alt="message_writing"
              />
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
</template>

<script>
export default {
  data() {
    return {
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
    };
  },
  mounted() {
    svg_icon(".custom-svg", "currentColor");
  },
  created() {
    this.userInfo = this.$store.state.userInfo;
  },
};
</script>

<style lang="scss" scoped></style>

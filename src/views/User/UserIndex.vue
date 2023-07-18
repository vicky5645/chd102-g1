<template>
  <div class="user">
    <aside class="col-md-3">
      <div class="profile-top">
        <div class="avatar">
          <img src="https://picsum.photos/100/100/?random=22" alt="avatar"/>
        </div>
        <div>麥 大明</div>
      </div>
      <div class="link-list">
        <router-link to="/user/info">
          <li>
            <img class="custom-svg" src="@/assets/images/icon/basic/settings.svg" alt="settings-icon">
            <span>帳號設定</span>
          </li>
        </router-link>
        <router-link to="/user/order">
          <li>
            <img class="custom-svg" src="@/assets/images/icon/basic/list.svg" alt="list-icon">
            <span>訂單管理</span>
          </li>
        </router-link>
        <router-link to="/user/forum">
          <li>
            <img class="custom-svg" src="@/assets/images/icon/basic/message_writing.svg" alt="message_writing">
            <span>論壇訊息</span>
          </li>
        </router-link>
        <router-link to="/user/like">
          <li>
            <div class="icon-12">
              <i class="fa-solid fa-heart"></i>
            </div>
            <span>我的收藏</span>
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
  name: 'YourComponent',
  mounted() {
    const script = document.createElement('script');
    script.src = '/js/svgcolor.js';
    script.onload = () => {
      svg_icon('.custom-svg', 'currentColor');
    };
    document.body.appendChild(script);
  },
};
</script>

<style lang="scss" scoped>
</style>
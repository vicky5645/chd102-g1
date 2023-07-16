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
        <li>
          <router-link to="/user/info">
            <img class="icon" src="@/assets/images/icon/basic/settings_filled.png" alt="settings-icon">
            <span>帳號設定</span>
          </router-link>
        </li>
        <li>
          <router-link to="/user/order">
            <img class="icon" src="@/assets/images/icon/basic/settings_filled.png" alt="settings-icon">
            <span>訂單管理</span>
          </router-link>
        </li>
        <li>
          <router-link to="/">
            <img class="icon" src="@/assets/images/icon/basic/message_writing.png" alt="message-icon">
            <span>論壇訊息</span>
          </router-link>
        </li>
        
        <li>
          <router-link to="/">
            <img class="icon" src="@/assets/images/icon/basic/settings_filled.png" alt="settings-icon">
            <span>我的收藏</span>
          </router-link>
        </li>
      </div>
    </aside>
    <main class="col-12 user-control-content">
      <router-view></router-view>
    </main>
  </div>
</template>

<style lang="scss" scoped>
* {
  border: 1px solid #000;
}

</style>
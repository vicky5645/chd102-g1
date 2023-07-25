<template>
  <div class="logo_title">
    <div><img src="../../assets/logo.svg" alt="" /></div>
    <h1>&nbsp;&nbsp;後台管理頁面</h1>
  </div>
  <!-- <div class="home">home</div> -->
  <div class="content" style="display: flex">
    <aside class="col-2" style="display: inline-block">
      <div class="list-group">
        <div class="list-group">
          <router-link to="/backend" exact>
            <button
              type="button"
              class="list-group-item list-group-item-action"
              :class="{ active: $route.name === 'backend' }"
            >
              後台首頁
            </button>
          </router-link>
          <router-link to="/backend/package" exact>
            <button
              type="button"
              class="list-group-item list-group-item-action"
              :class="{ active: $route.name === 'package' }"
            >
              行程
            </button>
          </router-link>
          <router-link to="/backend/organize" exact>
            <button
              type="button"
              class="list-group-item list-group-item-action"
              :class="{ active: $route.name === 'organize' }"
            >
              開團
            </button>
          </router-link>

          <router-link to="/backend/BackForum" exact>
            <button
              type="button"
              class="list-group-item list-group-item-action"
              :class="{ active: $route.name === 'BackForum' }"
            >
              論壇文章
            </button>
          </router-link>
          <router-link to="/backend/BackForumMessage" exact>
            <button
              type="button"
              class="list-group-item list-group-item-action"
              :class="{ active: $route.name === 'BackForumMessage' }"
            >
              論壇文章留言
            </button>
          </router-link>
          <router-link to="/backend/BackForumReport" exact>
            <button
              type="button"
              class="list-group-item list-group-item-action"
              :class="{ active: $route.name === 'BackForumReport' }"
            >
              論壇文章檢舉
            </button>
          </router-link>
          <router-link to="/backend/BackAnnouncements" exact>
            <button
              type="button"
              class="list-group-item list-group-item-action"
              :class="{ active: $route.name === 'BackAnnouncements' }"
            >
              公告
            </button>
          </router-link>

          <router-link to="/backend/bootstrap" exact>
            <button
              type="button"
              class="list-group-item list-group-item-action"
              :class="{ active: $route.name === 'bootstrap' }"
            >
              test bootstrap
            </button>
          </router-link>
        </div>
      </div>
    </aside>
    <main class="col-10 user-control-content">
      <router-view></router-view>
    </main>
  </div>
</template>

<script>
// @ is an alias to /src
// bootstrap
import "bootstrap/dist/css/bootstrap.min.css";
import "bootstrap";

export default {
  components: {},
  data() {
    return {};
  },
};
</script>

<style lang="scss" scoped>
.logo_title {
  display: flex;
  align-items: center;

  div {
    img {
      width: 100%;
      height: 100%;
      object-fit: cover;
    }
  }

  h1 {
    font-size: 24px;
    line-height: 60px;
    color: #7AACBF;
  }
}

a {
  text-decoration: none;
}
</style>

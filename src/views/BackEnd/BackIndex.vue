<template>
  <h1>後台頁面</h1>
  <div class="home">
    home
  </div>
  <aside class="col-md-3">
    <div class="link-list">
      <router-link to="/backend">
        <li>
          <span>後台首頁</span>
        </li>
      </router-link>
      <router-link to="/backend/package">
        <li>
          <span>行程</span>
        </li>
      </router-link>
      <router-link to="/backend/organize">
        <li>
          <span>開團</span>
        </li>
      </router-link>
    </div>
  </aside>
  <main class="col-12 user-control-content">
    <router-view></router-view>
  </main>
</template>

<script>
// @ is an alias to /src

export default {
  components: {
  },
  data() {
    return {
    }
  }
}
</script>

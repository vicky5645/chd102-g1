<template>
  <div class="logo_title">
    <div><img src="../../assets/logo.svg" alt="" /></div>
    <h1>&nbsp;&nbsp;後台管理頁面</h1>
  </div>
  <!-- <div class="home">home</div> -->
  <div class="content" style="display: flex">
    <aside class="col-2" style="display: inline-block">
      <div
        class="list-group rounded-1 border border-secondary-subtle"
        style="overflow: hidden"
      >
        <!-- <router-link to="/backend" exact>
          <button
            type="button"
            class="list-group-item list-group-item-action"
            :class="{ active: $route.name === 'backend' }"
          >
            後台首頁
          </button>
        </router-link> -->

        <div class="accordion accordion-flush" id="accordionFlushExample">
          <router-link to="/backend/BackCmsStaff" exact>
            <button
              type="button"
              class="list-group-item list-group-item-action"
              :class="{ active: $route.name === 'BackCmsStaff' }"
            >
              管理員帳號
            </button>
          </router-link>

          <router-link to="/backend/BackMember" exact>
            <button
              type="button"
              class="list-group-item list-group-item-action"
              :class="{ active: $route.name === 'BackMember' }"
            >
              會員
            </button>
          </router-link>

          <router-link to="/backend/BackTrain" exact>
            <button
              type="button"
              class="list-group-item list-group-item-action"
              :class="{ active: $route.name === 'BackTrain' }"
            >
              列車
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

          <!-- 行程管理 -->
          <div class="accordion-item">
            <h2 class="accordion-header" id="flush-headingOne">
              <button
                class="accordion-button collapsed"
                type="button"
                data-bs-toggle="collapse"
                data-bs-target="#flush-collapseOne"
                aria-expanded="false"
                aria-controls="flush-collapseOne"
              >
                行程管理
              </button>
            </h2>
            <div
              id="flush-collapseOne"
              class="accordion-collapse collapse"
              aria-labelledby="flush-headingOne"
              data-bs-parent="#accordionFlushExample"
            >
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

              <router-link to="/backend/BackPackageOrder" exact>
                <button
                  type="button"
                  class="list-group-item list-group-item-action"
                  :class="{ active: $route.name === 'BackPackageOrder' }"
                >
                  開團訂單
                </button>
              </router-link>

              <router-link to="/backend/BackPattern" exact>
                <button
                  type="button"
                  class="list-group-item list-group-item-action"
                  :class="{ active: $route.name === 'BackPattern' }"
                >
                  車票客製圖案
                </button>
              </router-link>

              <router-link to="/backend/BackPackageTrace" exact>
                <button
                  type="button"
                  class="list-group-item list-group-item-action"
                  :class="{ active: $route.name === 'BackPackageTrace' }"
                >
                  行程收藏
                </button>
              </router-link>

              <router-link to="/backend/BackSpot" exact>
                <button
                  type="button"
                  class="list-group-item list-group-item-action"
                  :class="{ active: $route.name === 'BackSpot' }"
                >
                  景點
                </button>
              </router-link>

              <router-link to="/backend/BackPackagePass" exact>
                <button
                  type="button"
                  class="list-group-item list-group-item-action"
                  :class="{ active: $route.name === 'BackPackagePass' }"
                >
                  行程景點
                </button>
              </router-link>

              <router-link to="/backend/BackSeat" exact>
                <button
                  type="button"
                  class="list-group-item list-group-item-action"
                  :class="{ active: $route.name === 'BackSeat' }"
                >
                  開團座位
                </button>
              </router-link>
            </div>
          </div>

          <!-- 商品管理 -->
          <div class="accordion-item">
            <h2 class="accordion-header" id="flush-headingTwo">
              <button
                class="accordion-button collapsed"
                type="button"
                data-bs-toggle="collapse"
                data-bs-target="#flush-collapseTwo"
                aria-expanded="false"
                aria-controls="flush-collapseTwo"
              >
                商品管理
              </button>
            </h2>
            <div
              id="flush-collapseTwo"
              class="accordion-collapse collapse"
              aria-labelledby="flush-headingTwo"
              data-bs-parent="#accordionFlushExample"
            >
              <router-link to="/backend/BackProduct" exact>
                <button
                  type="button"
                  class="list-group-item list-group-item-action"
                  :class="{ active: $route.name === 'BackProduct' }"
                >
                  商品
                </button>
              </router-link>

              <router-link to="/backend/BackOrder" exact>
                <button
                  type="button"
                  class="list-group-item list-group-item-action"
                  :class="{ active: $route.name === 'BackOrder' }"
                >
                  商品訂單
                </button>
              </router-link>

              <router-link to="/backend/BackOrderItem" exact>
                <button
                  type="button"
                  class="list-group-item list-group-item-action"
                  :class="{ active: $route.name === 'BackOrderItem' }"
                >
                  商品訂單項目
                </button>
              </router-link>

              <router-link to="/backend/BackProdTrace" exact>
                <button
                  type="button"
                  class="list-group-item list-group-item-action"
                  :class="{ active: $route.name === 'BackProdTrace' }"
                >
                  商品收藏
                </button>
              </router-link>
            </div>
          </div>

          <!-- 論壇管理 -->
          <div class="accordion-item">
            <h2 class="accordion-header" id="flush-headingThree">
              <button
                class="accordion-button collapsed"
                type="button"
                data-bs-toggle="collapse"
                data-bs-target="#flush-collapseThree"
                aria-expanded="false"
                aria-controls="flush-collapseThree"
              >
                論壇管理
              </button>
            </h2>
            <div
              id="flush-collapseThree"
              class="accordion-collapse collapse"
              aria-labelledby="flush-headingThree"
              data-bs-parent="#accordionFlushExample"
            >
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
            </div>
          </div>
        </div>
        <!-- test -->
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
    color: #7aacbf;
  }
}

a {
  text-decoration: none;
}
</style>

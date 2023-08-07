<template>
  <div class="settings">
    <h1 class="h4">論壇訊息</h1>
    <hr>
    <div class="user-control-content">
        <div class="table-wrapper hidden-mobile">
          <div class="thead">
            <span>文章圖片</span>
            <span>文章標題</span>
            <span>發布日期</span>
            <span>按讚數</span>
            <span>留言數</span>
            <span>編輯</span>
          </div>
          <div class="tbody" v-for="item, index in userData.forum" :key="item.id">
            <router-link :to="`/forum`">
              <div class="cradPic">
                <Images :imgURL="`${item.image}`" :alt="`${item.title}`" />
              </div>
            </router-link>
            <div class="des">
              <h3 class="des-title">{{ item.title }}</h3>
              <span class="clamp-2 label">{{ item.content }}</span>
            </div>
            <span>{{ item.date }}</span>
            <span>{{ item.likes }}</span>
            <span>{{ item.mes }}</span>
            <div class="btn-space">
              <button type="submit" class="btn error radius" @click="showDetail('deleteArticle')">刪除文章</button>
            </div>
          </div>
        </div>
        <div class="card-out show-mobile" v-for="item, index in userData.forum" :key="item.id">
          <template v-if="checkedItem == ''">
            <div class="card">
              <div class="cradPic">
                <router-link :to="`/forum`">
                  <Images :imgURL="`${item.image}`" :alt="`${item.title}`" />
                </router-link>
              </div>
              <div class="content">
                <div class="card-top">
                  <div class="des">
                    <h3 class="h3">{{ item.title }}</h3>
                    {{ item.content }}
                  </div>
                  <div class="table-wrapper">
                    <div class="thead">
                      <span>發布日期</span>
                      <span>按讚數</span>
                      <span>留言數</span>
                    </div>
                    <div class="tbody">
                      <span>{{ item.date }}</span>
                      <span>{{ item.likes }}</span>
                      <span>{{ item.mes }}</span>
                    </div>
                  </div>
                </div>
                <div class="card-bottom">
                  <hr>
                  <div class="btn-space">
                    <button type="submit" class="btn error radius" @click="showDetail('deleteArticle')">刪除文章</button>
                  </div>
                </div>
              </div>
            </div>
          </template>
        </div>
    </div>
  </div>
  <div class="detail-modal" v-show="isVisible['deleteArticle']">
    <div class="content">
      <h4 class="h4">確定刪除論壇文章</h4>
      <div class="subtext text_14">
        <p>您已選擇刪除論壇文章，此操作將永久刪除該文章並無法恢復。請確保您的決定是確定的，並謹慎考慮是否刪除該文章。</p>
        <p>如果您確定刪除，請點擊確認按鈕。如有任何疑問或需要協助，請隨時與我們聯繫。謝謝您的配合！</p>
        <p class="caption error">注意：一旦刪除，文章將從論壇中移除且無法恢復，請謹慎操作。</p>
      </div>
      <div class="icon-24 error" @click="hideDetail('deleteArticle')">
        <img class="custom-svg" src="@/assets/images/icon/menu/close_big.svg" alt="close_big-icon">
      </div>
      <div class="btn-space">
        <button type="submit" class="btn other radius"
          @click="hideDetail('deleteArticle')">取消</button>
        <button type="submit" class="btn error radius" @click="hideDetail('deleteArticle')">確認刪除</button>
      </div>
    </div>
    <div class="pageMask" v-show="isVisible['deleteArticle']" @click="hideDetail('deleteArticle')"></div>
  </div>
</template>

<script>
import {GET} from '@/plugin/axios'
export default {
  data() {
    return {
      // 會員的資料(僅在進入畫面時去取一次資料)
      userData: [],
      checkedItem: '',
      isVisible: {
        deleteArticle: false
      }
    }
  },
  created() {
      // 取得API
    GET('/data/userData.json').then(res => {
      this.userData = res
    })
  },
  mounted() {
    svg_icon('.custom-svg', 'currentColor');
  },
  computed: {

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
.detail-modal > .content {
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

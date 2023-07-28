<template>
  <div class="settings">
    <h1 class="h4">論壇訊息</h1>
    <hr>
    <div class="user-control-content">
      <template v-if="isShow">
        <div class="table-wrapper">
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
              <button type="submit" class="btn error radius">刪除文章</button>
            </div>
          </div>
        </div>
      </template>
      <template v-else>
        <div class="card-out" v-for="item, index in userData.forum" :key="item.id">
          <template v-if="checkedItem == '商品'">
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
                    <button type="submit" class="btn error radius">刪除文章</button>
                  </div>
                </div>
              </div>
            </div>
          </template>
        </div>
      </template>
    </div>
  </div>
</template>

<script>
import {GET} from '@/plugin/axios'
export default {
  data() {
    return {
      //顯示未有相關商品上架的提示
      empty: false,
      //判斷視窗寬度是否大於768px用
      isLargeScreen: false,
      //商品分類列是否顯示
      isShow: true,
      searchText: '',
      // 會員的資料(僅在進入畫面時去取一次資料)
      userData: [],
      // 呈現的商品資料(針對userData來搜尋篩選)
      productDisplay: [],
      tabActive: 1,
      checkedItem: '商品',
      categoryItem: [
        { type: "商品" },
        { type: "行程" }
      ]
    }
  },
  created() {
      // 取得API
    GET('/data/userData.json').then(res => {
      this.userData = res
      this.updateDisplay()
    })
  },
  mounted() {
    // 監聽視窗大小改變事件
    window.addEventListener('resize', this.handleResize);
    // 初始判定視窗大小
    this.handleResize();
  },
  computed: {

  },
  methods: {
    updateDisplay() {
      this.empty = false;
      if (this.searchText === '') {
        this.productDisplay = this.userData.favorite_products
      } else {
        this.productDisplay = this.userData.filter(item => item.title.includes(this.searchText));
        this.isEmpty()
      }
    },
    updateTab(index) {
      this.empty = false;
      if (this.categoryItem[index].type === '商品') {
        this.productDisplay = this.userData.favorite_products;
        // console.log(typeof this.productDisplay)
        return this.productDisplay;
      } else if (this.categoryItem[index].type === '行程') {
        this.productDisplay = this.userData.favorite_orders;
        // this.productDisplay = this.userData.filter(item => item.hot === true)
        return this.productDisplay;
      }
      this.productDisplay = this.userData.filter(item => item.type === this.categoryItem[index].type);
      this.isEmpty();
    },
    isEmpty() {
      if (this.productDisplay.length === 0) {
        this.empty = true;
        return this.empty;
      }
      return this.productDisplay;
    },
    handleResize() {
      // 判定視窗寬度是否大於等於 768px
      this.isLargeScreen = window.innerWidth >= 768;
      // 根據視窗寬度判定是否顯示 .categoryItem
      if (this.isLargeScreen) {
        this.isShow = true;
      } else {
        this.isShow = false;
      }
    }
  },
  beforeUnmount() {
    // 移除事件聆聽器
    window.removeEventListener('resize', this.handleResize);
  }
}
</script>
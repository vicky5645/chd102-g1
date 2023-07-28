<template>
  <div class="settings">
    <h1 class="h4">我的收藏</h1>
    <button class="categoryBtn btn radius label" @click="isShow = !isShow">
      <span>{{ checkedItem }}</span>
      <div class=".icon-24">
        <i class="fa-solid fa-angle-right" :style="{ transform: isShow ? 'rotate(90deg)' : 'rotate(0deg)' }"></i>
      </div>
    </button>
    <transition name="accordion" mode="out-in">
      <ul class="categoryItem label" v-show="isShow">
        <li v-for="(item, key) in [...categoryItem]" @click="updateTab(key), checkedItem = item.type">
          {{ item.type }}
          <div class=".icon-24">
            <i class="fa-solid fa-chevron-right"></i>
          </div>
        </li>
      </ul>
    </transition>
    <hr>
    <div class="user-control-content">
      <div class="card-out" v-for="item, index in productDisplay" :key="item.id">
        <template v-if="checkedItem == '商品'">
          <div class="card">
            <router-link :to="`/productDetail/${item.id}`">
              <div class="cradPic">
                <Images :imgURL="`${item.image}`" :alt="`${item.title}`" />
                <!-- <img :src="item.image" :alt="item.title"> -->
              </div>
            </router-link>
            <div class="content">
              <div class="card-top">
                <div class="des">
                  <h3 class="h3">{{ item.title }}</h3>
                  <div class="des-right">
                    <div class="price h2">
                      $ {{ item.price }}
                    </div>
                  </div>
                </div>

              </div>
              <div class="card-bottom">
                <hr>
                <div class="btn-space">
                  <button type="submit" class="btn primary radius">
                    <span>立即訂購</span>
                    <div class="icon-24">
                      <img class="custom-svg" src="@/assets/images/icon/user/cart-plus.svg" alt="cart-plus">
                    </div>
                  </button>
                  <button type="submit" class="btn error radius">刪除收藏</button>
                </div>
              </div>
            </div>
          </div>
        </template>
        <template v-else-if="checkedItem == '行程'">
          <div class="card">
            <router-link :to="`/booking-info/${item.id}`">
              <div class="cradPic">
                <Images :imgURL="`${item.image}`" :alt="`${item.title}`" />
                <!-- <img :src="item.image" :alt="item.title"> -->
              </div>
            </router-link>
            <div class="content">
              <div class="card-top">
                <div class="des">
                  <div class="des-text">
                    <h3 class="h3 clamp-2">{{ item.title }}{{ item.title2 }}</h3>
                    <div class="more">
                      <p class="bold">剩餘座位 {{ item.seat }} </p>
                      <p class="label"><i class="fa-solid fa-train"></i> {{ item.train }}</p>
                      <p class="label"><i class="fa-solid fa-calendar-days"></i> 行程日期: {{ item.order_date }}</p>
                    </div>
                  </div>
                  <div class="des-right">
                    <div class="price h2">
                      $ {{ item.price }}
                    </div>
                  </div>
                </div>

              </div>
              <div class="card-bottom">
                <hr>
                <div class="btn-space">
                  <button type="submit" class="btn primary radius">
                    <span>立即訂購</span>
                    <div class="icon-24">
                      <img class="custom-svg" src="@/assets/images/icon/user/cart-plus.svg" alt="cart-plus">
                    </div>
                  </button>
                  <button type="submit" class="btn error radius">刪除收藏</button>
                </div>
              </div>
            </div>
          </div>
        </template>
      </div>
    </div>
  </div>
</template>
<script>
import { GET } from '@/plugin/axios'
export default {
  data() {
    return {
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
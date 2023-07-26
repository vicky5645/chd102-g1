<template>
  <main>
    <BreadCrumbs detailName="商城" />
    <!-- <ol class="breadCrumbs">
        <i class="fa-solid fa-house"></i> -->
    <!-- <li v-for="item in [...breadCrumbs]" :key="item.index">
            <a :href="item.link" :style="item.color">
                {{item.index}}</a>
        </li> -->
    <!-- </ol> -->
    <div class="container productIndex">
      <div class="category">
        <h3>商品分類</h3>
        <button class="categoryBtn" @click="isShow = !isShow">
          <span>商品分類</span>
          <i class="fa-solid fa-angle-right" :style="{ transform: isShow ? 'rotate(90deg)' : 'rotate(0deg)' }"></i>
        </button>
        <transition name="accordion" mode="out-in">
          <ul class="categoryItem" v-show="isShow">
            <li v-for="(item, key) in [...categoryItem]" @click="updateTab(key)">
              {{ item.type }}<i class="fa-solid fa-chevron-right"></i>
            </li>
          </ul>
        </transition>
      </div>
      <div class="product">
        <div class="topBar">
          <h2>所有商品</h2>
          <div class="searchBar">
            <input type="search" placeholder="輸入關鍵字查詢" v-model="searchText">
            <button @click="updateDisplay"><i class="fa-solid fa-magnifying-glass"></i>search</button>
          </div>
        </div>
        <!-- <div v-if="productData.length > 0 && tabActive == 1" class="productList row row-cols-lg-3 row-cols-2"> -->
        <div class="productList row row-cols-lg-3 row-cols-2">
          <div class="empty" v-show="empty">目前未上架相關商品或已售完</div>
          <div v-for="item, index in productDisplay" :key="item.id" class="col">
            <div class="card">
              <button class="cardFavorite" @click="toggleFavorite(index)">
                <i :class="favoriteIcon(index)"></i>
              </button>
              <button class="cardCart" @click="addToCart(index)">
                <i :class="goodsBtn.cart.i"></i>
              </button>
              <router-link :to="`/productDetail/${item.id}`">
                <div class="cradPic">
                  <img :src="item.image" :alt="item.title">
                </div>
              </router-link>
              <router-link :to="`/productDetail/${item.id}`">
                <h3>{{ item.title }}</h3>
              </router-link>
              <div class="price">
                <span>{{ item.price }}</span>
              </div>
            </div>
          </div>
        </div>

      </div>
    </div>
  </main>
</template>

<script>
import BreadCrumbs from '@/components/BreadCrumbs.vue'
export default {
  components: {
    BreadCrumbs
  },
  data() {
    return {
      //顯示未有相關商品上架的提示
      empty: false,
      //判斷視窗寬度是否大於768px用
      isLargeScreen: false,
      //商品分類列是否顯示
      isShow: true,
      searchText: '',
      // 商品資料(僅在進入畫面時去取一次資料)
      productData: [],
      // 呈現的商品資料(針對productData來搜尋篩選)
      productDisplay: [],
      goodsBtn: {
        fillHeart: {
          i: "fa-solid fa-heart"
        },
        hollowHeart: {
          i: "fa-regular fa-heart"
        },
        cart: {
          i: "fa-solid fa-cart-shopping"
        }
      },
      breadCrumbs: [
        {
          index: "Goods",
          link: "index.html",
          color: "color:#9CA3AF;"
        },
        {
          index: "Detail",
          link: "detail.html",
          color: "color:#9CA3AF;"
        },
        {
          index: "Pricing",
          link: "pricing.html",
          color: "color:#F29C50;"
        }
      ],
      tabActive: 1,
      // categoryItem: {
      //   1: "所有商品",
      //   2: "熱銷商品",
      //   3: "食品",
      //   4: "玩具"
      // },
      categoryItem: [
        { type: "所有商品" },
        { type: "熱銷商品" },
        { type: "食品" },
        { type: "玩具" }
      ]
    }
  },
  created() {
    // 取得API
    fetch('/data/productData.json')
      .then(res => res.json())
      .then(json => {
        this.productData = json
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
        this.productDisplay = this.productData
      } else {
        this.productDisplay = this.productData.filter(item => item.title.includes(this.searchText));
        this.isEmpty()
      }
    },
    updateTab(index) {
      this.empty = false;
      if (this.categoryItem[index].type === '所有商品') {
        this.productDisplay = this.productData;
        console.log(typeof this.productDisplay)
        return this.productDisplay;
      } else if (this.categoryItem[index].type === '熱銷商品') {
        this.productDisplay = this.productData.filter(item => item.hot === true)
        return this.productDisplay;
      }
      this.productDisplay = this.productData.filter(item => item.type === this.categoryItem[index].type);
      this.isEmpty();
    },
    isEmpty() {
      if (this.productDisplay.length === 0) {
        this.empty = true;
        return this.empty;
      }
      return this.productDisplay;
    },
    toggleFavorite(index) {
      this.productData[index].isFavorite = !this.productData[index].isFavorite;
    },
    favoriteIcon(index) {
      return this.productData[index].isFavorite ? this.goodsBtn.fillHeart.i : this.goodsBtn.hollowHeart.i;
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
    },
    addToCart(index) {
      this.$store.commit("addToCart",this.productData[index]);
      console.log(this.productData[index])
    },
  },
  beforeUnmount() {
    // 移除事件聆聽器
    window.removeEventListener('resize', this.handleResize);
  }
}
</script>

<style lang="scss" scoped></style>
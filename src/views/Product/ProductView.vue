<template>
  <main class="product">
    <BreadCrumbs detailName="商城" />
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
              <div class="icon-container" :class="{ showing: addSuccess && index === currentIndex }">
                <svg class="icon" viewBox="0 0 100 100" width="80" height="80">
                        <circle class="circle" cx="50" cy="50" r="48"></circle>
                        <polyline class="check" points="28,53 42,66 74,34"></polyline>
                    </svg>
                    <p>成功加入購物車</p>
              </div>
              <button class="cardFavorite" @click="toggleFavorite(index)">
                <i :class="favoriteIcon(index)"></i>
              </button>
              <button class="cardCart" @click="addToCart(index)">
                <i :class="goodsBtn.cart.i"></i>
              </button>
              <div class="hot-tag" v-if="item.hot">
                <span>HOT</span>
              </div>
              <router-link :to="`/productDetail/${item.id}`">
                <div class="cradPic">
                  <Images :imgURL="`${item.image}`" :alt="`${item.title}`" />
                  <!-- <img :src="item.image" :alt="item.title"> -->
                </div>
              </router-link>
              <router-link :to="`/productDetail/${item.id}`">
                <h3 :title="item.title">{{ item.title }}</h3>
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
import {GET} from '@/plugin/axios'
import axios from "axios";
import { BASE_URL } from "@/assets/js/common.js";
import BreadCrumbs from '@/components/BreadCrumbs.vue'
export default {
  components: {
    BreadCrumbs
  },
  data() {
    return {
      addSuccess: false,
      currentIndex: null,
      //顯示未有相關商品上架的提示
      empty: false,
      //判斷視窗寬度是否大於768px用
      isLargeScreen: false,
      //商品分類列是否顯示
      isShow: true,
      searchText: '',
      // MySQL原始商品資料(僅在進入畫面時去取一次資料)
      dataFromMySQL: [777],
      // 替換新key值的商品資料
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
      categoryItem: [
        { type: "所有商品" },
        { type: "熱銷商品" },
        { type: "周邊" },
        { type: "食品" },
        { type: "玩具" },
        { type: "圖書" }
      ]
    }
  },
  created () {
    //取得API
    // GET('/data/productData.json').then(res => {
    //   this.productData = res;
    //   this.updateDisplay();
    // })

    this.getData();
    // console.log('執行created',this.dataFromMySQL);
    // console.log('執行created',typeof this.dataFromMySQL);
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
        this.productDisplay = this.productData.filter(item => item.hot).concat(this.productData.filter(item => !item.hot));
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
      console.log(this.productData[index]);
      this.currentIndex = index;
      this.addSuccess = true;
      setTimeout(() => {
                this.addSuccess = false;
            }, 800);
    },
    //抓資料
    async getData() {
      const type = "get"; // 設定要執行的操作，這裡是取得資料
        try {
          const res = await axios.get(`${BASE_URL}getProduct.php?type=${type}`)
          this.dataFromMySQL = res.data;
        }catch(error) {
          console.error("There was an error fetching the data:", error);
        };
      this.getNewData();
      this.productDisplay = this.productData;
    },
    //解析資料庫key值
    getNewData() {
      this.productData = [];
      this.dataFromMySQL.forEach((item) => {
      const newData = {
        id: item.prod_no,
        title: item.prod_name,
        type: item.prod_type,
        price: item.prod_price,
        description: item.prod_summary,
        status: item.prod_status,
        image: `images/online-mall/${item.prod_file}`,
        hot: item.prod_hot,
        isFavorite: false,
        amount: 1,
        totalPrice: 0,
      };
        this.productData.push(newData);
      });
    },
  },
  beforeUnmount() {
    // 移除事件聆聽器
    window.removeEventListener('resize', this.handleResize);
  }
}
</script>

<style lang="scss" scoped></style>
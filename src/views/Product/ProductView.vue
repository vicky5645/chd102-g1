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
        <ul class="categoryItem">
            <li v-for="(item, key) in categoryItem"
            @click="updateTab(key)">
                {{item}}<i class="fa-solid fa-chevron-right"></i>
            </li>
        </ul>
      </div>
      <div class="product">
        <div class="topBar">
          <h2>所有商品</h2>
          <div class="searchBar">
            <input type="search" placeholder="輸入關鍵字查詢" v-model="searchText">
            <button @click="updateDisplay"><i class="fa-solid fa-magnifying-glass"></i>search</button>
          </div>
        </div>
        <div v-if="productData.length > 0 && tabActive == 1" class="productList row row-cols-lg-3 row-cols-2">
          <div v-for="item,index in productDisplay" 
            :key="item.id"
            class="col">
            <router-link :to="`/productDetail/${item.id}`">
              <div class="card">
                <div class="cradPic">
                  <img :src="item.image" :alt="item.title">
                  <button class="cardFavorite" @click="toggleFavorite(index)">
                    <i :class="favoriteIcon(index)"></i>
                  </button>
                  <button class="cardCart">
                    <i :class="goodsBtn.cart.i"></i>
                  </button>
                </div>
                <h3>{{ item.title }}</h3>
                <div class="price">
                  <span>{{ item.price }}</span>
                </div>
              </div>
            </router-link>
          </div>
        </div>
        <div v-else-if="tabActive == 2" class="productList row row-cols-lg-3 row-cols-2">
          <div v-for="item,index in productDisplay" 
            :key="item.id"
            class="col">
            <div class="card">
              <div class="cradPic">
                <img :src="item.image" :alt="item.title">
                <button class="cardFavorite" @click="toggleFavorite(index)">
                  <i :class="favoriteIcon(index)"></i>
                </button>
                <button class="cardCart">
                  <i :class="goodsBtn.cart.i"></i>
                </button>
              </div>
              <router-link :to="`/productDetail/${item.id}`">
              <h3>{{ item.title }}</h3>
              </router-link>
              <div class="price">
                <span>{{ item.price }}</span>
              </div>
            </div>
          </div>
        </div>
        <div v-else-if="tabActive == 3" class="productList row row-cols-lg-3 row-cols-2">
          <div v-for="item,index in productDisplay" 
            :key="item.id"
            class="col" v-show="item.type === '食品'">
            <div class="card">
              <div class="cradPic">
                <img :src="item.image" :alt="item.title">
                <button class="cardFavorite" @click="toggleFavorite(index)">
                  <i :class="favoriteIcon(index)"></i>
                </button>
                <button class="cardCart">
                  <i :class="goodsBtn.cart.i"></i>
                </button>
              </div>
              <router-link :to="`/productDetail/${item.id}`">
              <h3>{{ item.title }}</h3>
              </router-link>
              <div class="price">
                <span>{{ item.price }}</span>
              </div>
            </div>
          </div>
        </div>
        <div v-else-if="tabActive == 4" class="productList row row-cols-lg-3 row-cols-2">
          <div v-for="item,index in productDisplay" 
            :key="item.id"
            class="col">
            <div class="card">
              <div class="cradPic">
                <img :src="item.image" :alt="item.title">
                <button class="cardFavorite" @click="toggleFavorite(index)">
                  <i :class="favoriteIcon(index)"></i>
                </button>
                <button class="cardCart">
                  <i :class="goodsBtn.cart.i"></i>
                </button>
              </div>
              <router-link :to="`/productDetail/${item.id}`">
              <h3>{{ item.title }}</h3>
              </router-link>
              <div class="price">
                <span>{{ item.price }}</span>
              </div>
            </div>
          </div>
        </div>
        <div v-else>
          Loading...
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
  data(){
    return {
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
      categoryItem: {
          1: "所有商品",
          2: "熱銷商品",
          3: "食品",
          4: "玩具"
      },
    }
  },
  created() {
    // 取得API
    fetch('/data/productData.json')
    .then(res=>res.json())
    .then(json=>{
      this.productData = json
      this.updateDisplay()
    })
  },
  methods: {
    updateDisplay(){
      if(this.searchText === ''){
        this.productDisplay = this.productData
      }else{
        this.productDisplay = this.productData.filter(item => item.title.includes(this.searchText))
      }
    },
    updateTab (index) {
      this.tabActive = index
    },
    toggleFavorite(index) {
      this.productData[index].isFavorite = !this.productData[index].isFavorite;
    },
    favoriteIcon(index) {
      return this.productData[index].isFavorite ? this.goodsBtn.fillHeart.i : this.goodsBtn.hollowHeart.i;
    }
  },
}
</script>

<style lang="scss" scoped>
</style>
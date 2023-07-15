<template>
  <main>
    <BreadCrumbs detailName="所有商品" />
    <ol class="breadCrumbs">
        <i class="fa-solid fa-house"></i>
        <!-- <li v-for="item in [...breadCrumbs]" :key="item.index">
            <a :href="item.link" :style="item.color">
                {{item.index}}</a>
        </li> -->
    </ol>
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
            <input type="text" placeholder="輸入關鍵字查詢" v-model="searchText">
            <button @click="updateDisplay"><i class="fa-solid fa-magnifying-glass"></i>search</button>
          </div>
        </div>
        <div v-if="productData.length > 0 && tabActive == 1" class="productList row row-cols-lg-3">
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
        <div v-else-if="tabActive == 2" class="productList row row-cols-lg-3">
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
        <div v-else-if="tabActive == 3" class="productList row row-cols-lg-3">
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
        <div v-else-if="tabActive == 4" class="productList row row-cols-lg-3">
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
          3: "分類1",
          4: "分類2"
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

main{
    max-width: 1200px;
    margin: auto;
}
.breadCrumbs {
    margin: 10px 0;

    i {
        color: #F29C50;
        margin-right: 10px;
    }

    li {
        &+li::before {
            content: " > ";
            color: #9CA3AF;
        }

        list-style: none;
        display: inline;

        a {
            text-decoration: none;
        }
    }
}
.container{
    display: flex;
    justify-content: space-between;
    // max-width: 1200px;
}
.category {
    width: 30%;
    h3 {
        color: #7AACBF;
        margin-bottom: 10px;
        height: 44px;
    }

    .categoryItem {
        background-color: #fff;
        border: 1px solid #D1D5DB;
        border-radius: 7px;
        box-sizing: border-box;

        li {
            padding: 10px;
            display: flex;
            justify-content: space-between;
            cursor: pointer;

            &:hover {
                background-color: #b1cde233;
            }
        }
    }
}

.product {
    width: 68.333333%;
    .topBar {
        display: flex;
        justify-content: space-between;
        align-items: center;
        height: 44px;
        margin-bottom: 10px;
        h2 {
            color: #012840;
            font-size: 32px;
            line-height: 36px;
        }
        .searchBar {
            width: 300px;
            height: 44px;
            display: flex;
            border-radius: 7px;
            border: 1px solid #D1D5DB;
            box-sizing: border-box;
            background-color: #fff;

            input[type="search"] {
                background-color: unset;
                width: 100%;
                font-size: 20px;
                padding: 12px;
                border: none;

                &::-webkit-search-cancel-button,
                &::-webkit-search-decoration {
                    display: none;
                }

                &:focus {
                    outline: none;
                }
            }

            button {
                padding: 10px;
                background-color: unset;
                border: none;
                font-size: 0;
                cursor: pointer;

                &:hover i {
                    color: #F29C50;
                    transform: scale(1.1);
                }

                i {
                    font-size: 24px;
                }
            }
        }
    }
}

.card{
    width: 260px;
    padding: 10px;
    border: 1px solid #D1D5DB;
    box-sizing: border-box;
    border-radius: 7px;
    background-color: #fff;
    box-shadow: 10px #00000033;
    &:hover{
        transform: scale(1.02);
        transition: .2s;
        box-shadow: 2px 2px 10px #00000033;
    }
    .cradPic{
        border-radius: 7px;
        border: 1px solid #D1D5DB;
        box-sizing: border-box;
        overflow: hidden;
        margin-bottom: 30px;
        aspect-ratio: 1/1;
        position: relative;
        $btnSize: 45px;
        //收藏及購物車的長寬
        img{
            display: block;
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        .cardFavorite,
        .cardCart{
            font-size: 24px;
            position: absolute;
            width: $btnSize;
            height: $btnSize;
            background-color: #fff;
            color: #F29C50;
            border: 1px solid #F29C50;;
            border-radius: 7px;
            left: 5px;
            top: 5px;
            display: flex;
            justify-content: center;
            align-items: center;
            svg{
                fill: #F29C50;
            }
        }
        .cardCart{
            top: calc($btnSize + 10px);

        }
    }
    h3{
        margin-bottom: 30px;
    }
    .price{
        span{
            &::before {
                content: " $ ";
            }
        }
    }
}
</style>
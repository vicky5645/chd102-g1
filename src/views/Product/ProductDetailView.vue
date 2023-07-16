<template>
  <!-- {{ $route.params.id }} -->
  <main class="product_page">
    <BreadCrumbs v-if="productDataItem" :detailName="productDataItem.title" />
    <div v-if="productData">
      <!-- <ol class="bread_crumbs">
        <i class="fa-solid fa-house"></i>
        <li v-for="item in [...breadCrumbs]" :key="item.index">
          <a :href="item.link" :style="item.color"> {{item.index}}</a>
        </li>
      </ol> -->
      <div class="back_button">
          <router-link to="/product">
            <i class="fa fa-angle-left" aria-hidden="true"></i> 返回商城
          </router-link>
      </div>
      <section class="product_data">
        <!-- 點擊小圖換大圖 -->
        <div class="product_data_left">

        <div class="big_pic">
          <img :src="bigPic" :alt="productDataItem.title">
        </div>
        <div class="small_pic_list">
          <div
            v-for="(pic, index) in smallPics"
            :key="index"
            class="small_pic"
            @click="changeBigPic(pic)"
          >
            <img :src="pic" alt="clock" />
          </div>
        </div>

        </div>
        <div class="product_data_right">
          <div class="information">
            <div class="name">{{ productDataItem.title }}</div>
            <div class="price">售價 NT$ {{ productDataItem.price }}</div>
          </div>
          <div class="type_and_like">
            <div class="type">選擇商品規格</div>
            <button class="like">加入收藏</button>
          </div>

          <div class="type_button_list">
            <button
              v-for="button in buttons"
              :key="button"
              class="type_button_item"
              :class="{ selected: selectedButton === button }"
              @click="selectButton(button)"
            >
              {{ button }}
            </button>
          </div>

        <div class="quantity_txt">購買數量</div>

          <!-- 加減按鈕 -->
          <div class="quantity_button">
            <button @click="increment">
              <i class="fa fa-plus" aria-hidden="true"></i>
            </button>
            <div class="quantity">{{ quantity }}</div>
            <button @click="decrement">
              <i class="fa fa-minus" aria-hidden="true"></i>
            </button>
          </div>

          <div class="add_and_buy">
            <button class="add">加入購物車</button>
            <button class="buy">立即購買</button>
          </div>
        </div>
      </section>

      <section class="product_txt">
        <button
          class="tab1"
          @click="selectedTab = 'Tab1'"
          :class="{ unselected: selectedTab !== 'Tab1' }"
        >
          商品詳情
        </button>
        <button
          class="tab2"
          @click="selectedTab = 'Tab2'"
          :class="{ unselected: selectedTab !== 'Tab2' }"
        >
          配送規範
        </button>

        <div class="txt_block" v-show="selectedTab === 'Tab1'">
          <p v-for="text in productDataItem.description" :key="text">{{ text }}</p>
        </div>

        <div class="txt_block" v-show="selectedTab === 'Tab2'">
          <p v-for="text in tab2_content" :key="text">{{ text }}</p>
        </div>
      </section>
      <!-- 推薦商品 -->
      <!-- <img src="/images/img/project/2.jpg" alt=""> -->
      <h3>推薦商品</h3>
      <section class="recommended_product">
        <button class="left" @click="previousProducts">
          <i class="fa fa-chevron-left" aria-hidden="true"></i>
        </button>
        <button class="right" @click="nextProducts">
          <i class="fa fa-chevron-right" aria-hidden="true"></i>
        </button>
        <transition
          mode="out-in"
          enter-active-class="slide-enter-active"
          leave-active-class="slide-leave-active"
          enter-from-class="slide-enter-from"
          leave-to-class="slide-leave-to"
        >
          <div :class="['product_list', slideDirection]" :key="productsKey">
            <a
            v-for="product in currentProducts"
              :key="product.name"
              href="#"
            >
            <div class="product">
              <div class="product_pic">
                <img :src="product.image" :alt="product.name" />
              </div>
              <p>{{ product.name }}</p>
            </div>
            </a>
          </div>
        </transition>
      </section>

    </div>
    <div v-else>
      Loading...
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
      productData: null,
      productDataItem: [],
      // 麵包屑
      breadCrumbs: [
        {
          index: "商城",
          link: "index.html",
          color: "color:#9CA3AF;",
        },
        {
          index: "物品",
          link: "detail.html",
          color: "color:#9CA3AF;",
        },
        {
          index: "火車懷錶",
          link: "#",
          color: "color:#F29C50;",
        },
      ],
      // 數量初始值
      quantity: 1,

      // 規格按鈕
      selectedButton: null,
      buttons: ["規格1", "規格2"],

      // 點擊小圖換大圖
      bigPic: "",
      smallPics: ["/images/img/ProductDetails/p2.png", "/images/img/ProductDetails/p3.png", "/images/img/ProductDetails/p4.png"],

      // content 區塊切換
      selectedTab: "Tab1", 
      tab1_content: [
        "懷錶，這個由過去走進現在的獨特鐘錶，與火車之間有著深厚的歷史聯繫。在鐵路早期，火車司機們都需要一個準確的時間工具來確保列車的準時運行，而懷錶就是這個工具的最佳選擇。",
        "我們的火車懷錶就是這種歷史情懷的象徵，它巧妙地將古典風格與現代功能結合在一起。錶殼由堅固的不銹鋼製成，既耐用又具有視覺吸引力。白色的錶面上，有著樸實的黑色羅馬數字時間標記，體現出簡約而古典的美感。懷錶內部裝有精密的機械運作系統，保證時間的準確無誤。",
        "這款火車懷錶不僅是一種時尚配件，也是一種實用的時間工具，更是一種記錄歷史，表達對火車文化熱愛的獨特方式。它將為你的生活增添一份別樣的風情，並在你的火車之旅中扮演著一個不可或缺的角色。",
      ],
      tab2_content: [
        "配送方式：們僅提供宅配服務，將商品直接送到您的指定地址。您可以在結帳時選擇您的配送地址，並確認配送信息。",
        "配送時間：我們的配送時間為工作日的9:00至18:00。一旦您的訂單被確認和處理，我們將在2-3個工作日內將商品送達您的地址。假日和特定的公眾假期可能會影響配送時間。",
        "配送費用：配送費用將根據配送地址和訂單金額計算。訂單金額超過特定數量，可享受免費配送。具體的配送費用將在結帳時顯示。",
        "訂單追蹤：一旦您的訂單出貨，我們將通過電子郵件發送包裹追蹤號碼給您。您可以使用此號碼在我們的網站上追蹤您的訂單狀態。",
        "退貨和換貨：我們承諾提供高品質的商品和服務。如果您對我們的商品不滿意，請在收到商品後的7天內聯繫我們，我們將為您安排退貨或換貨。商品必須保持原狀，未經使用或損壞，並且包裝完整。退貨運費由顧客承擔。",
      ],
      // 推薦商品
      allProducts: [
        {
          name: "小黃復古拍立得",
          image: "/images/img/project/1.jpg",
        },
        {
          name: "泥漿去角質霜",
          image: "/images/img/project/2.jpg",
        },
        {
          name: "真的皮的復古皮鞋",
          image: "/images/img/project/3.jpg",
        },
        {
          name: "大地色包包",
          image: "/images/img/project/4.jpg",
        },
        {
          name: "可站立復古拍立得(黑)",
          image: "/images/img/project/5.jpg",
        },
        {
          name: "森林系後背包",
          image: "/images/img/project/6.jpg",
        },
        {
          name: "可站立復古拍立得(白)",
          image: "/images/img/project/7.jpg",
        },
        {
          name: "青春活力勾勾籃球鞋",
          image: "/images/img/project/8.jpg",
        },
      ],
      currentProducts: [],
      productsKey: 0,
      slideDirection: "slide-right",
    }
  },
  created() {
    fetch(`/data/productData.json`)
    .then(res=>res.json())
    .then(json=>{
      this.productData = json;
      this.productDataItem = this.productData[`${parseFloat(this.$route.params.id)-1}`];
      this.bigPic = this.productDataItem.image;
    });
    this.currentProducts = this.allProducts.slice(0, 4); // 初始化 currentProducts
  },
  methods: {
    // 規格按鈕
    increment() {
      this.quantity++;
    },
    increment() {
      // only increment if quantity is less than 10
      if (this.quantity < 10) {
        this.quantity++;
      }
    },
    decrement() {
      // only decrement if quantity is greater than 1
      if (this.quantity > 1) {
        this.quantity--;
      }
    },

    // 點擊小圖換大圖
    selectButton(button) {
      this.selectedButton = button;
    },
    changeBigPic(pic) {
      this.bigPic = pic;
    },

    // 推薦商品
    nextProducts() {
      if (this.productsKey < Math.ceil(this.allProducts.length / 4) - 1) {
        this.productsKey++;
        this.slideDirection = "slide-right";
        this.currentProducts = this.allProducts.slice(
          this.productsKey * 4,
          this.productsKey * 4 + 4
        );
      }
    },
    previousProducts() {
      if (this.productsKey > 0) {
        this.productsKey--;
        this.slideDirection = "slide-left";
        this.currentProducts = this.allProducts.slice(
          this.productsKey * 4,
          this.productsKey * 4 + 4
        );
      }
    }
  },
};
</script>

<style lang="scss" scoped>

</style>

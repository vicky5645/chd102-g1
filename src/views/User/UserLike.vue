<template>
  <div class="settings">
    <h1 class="h4">我的收藏</h1>
    <button class="categoryBtn btn radius label" @click="isShow = !isShow">
      <span>{{ checkedItem }}</span>
      <div class=".icon-24">
        <i
          class="fa-solid fa-angle-right"
          :style="{ transform: isShow ? 'rotate(90deg)' : 'rotate(0deg)' }"
        ></i>
      </div>
    </button>
    <transition name="accordion" mode="out-in">
      <ul class="categoryItem label" v-show="isShow">
        <li
          v-for="(item, key) in [...categoryItem]"
          @click="updateTab(key), (checkedItem = item.type)"
        >
          {{ item.type }}
          <div class=".icon-24">
            <i class="fa-solid fa-chevron-right"></i>
          </div>
        </li>
      </ul>
    </transition>
    <hr />
    <div class="user-control-content">
      <div class="card-out" >
        <template v-if="checkedItem == '商品'">
          <div class="card" v-for="item in products">
            <router-link :to="`/productDetail/${item.prod_no}`">
              <div class="cradPic">
                <Images
                  :imgURL="`images/online-mall/${item.prod_file}`"
                  :alt="`${item.prod_name}`"
                />
                <!-- <img :src="item.image" :alt="item.title"> -->
              </div>
            </router-link>
            <div class="content">
              <div class="card-top">
                <div class="des">
                  <h3 class="h3">{{ item.prod_name }}</h3>
                  <div class="des-right">
                    <div class="price h2">$ {{ item.prod_price }}</div>
                  </div>
                </div>
              </div>
              <div class="card-bottom">
                <div class="btn-space">
                  <button type="submit" class="btn primary radius">
                    <span>立即訂購</span>
                    <div class="icon-24">
                      <img
                        class="custom-svg"
                        src="@/assets/images/icon/user/cart-plus.svg"
                        alt="cart-plus"
                      />
                    </div>
                  </button>
                  <button
                    type="submit"
                    class="btn error radius"
                    @click="showDetail('deleteLike')"
                  >
                    刪除收藏
                  </button>
                </div>
              </div>
            </div>
          </div>
        </template>
        <template v-else-if="checkedItem == '行程'">
          <div class="card" v-for="item in packages">
            <router-link :to="`/booking-info/${item.pkg_no}`">
              <div class="cradPic">
                <Images
                  :imgURL="`${item.cover_file}`"
                  :alt="`${item.pkg_name}`"
                />
              </div>
            </router-link>
            <div class="content">
              <div class="card-top">
                <div class="des">
                  <div class="des-text">
                    <h3 class="h3 clamp-2">
                      {{ item.pkg_name }}
                      <!-- {{ item.title2 }} -->
                    </h3>
                    <div class="more">
                      <p class="bold">剩餘座位 {{ item.seat }}</p>
                      <p class="label">
                        <i class="fa-solid fa-train"></i> {{ item.train_no }}
                      </p>
                      <p class="label">
                        <i class="fa-solid fa-calendar-days"></i> 行程日期:
                        {{ item.order_date }}
                      </p>
                    </div>
                  </div>
                  <div class="des-right">
                    <div class="price h2">$ {{ item.pkg_price }}</div>
                  </div>
                </div>
              </div>
              <div class="card-bottom">
                <div class="btn-space">
                  <button type="submit" class="btn primary radius">
                    <span>立即訂購</span>
                    <div class="icon-24">
                      <img
                        class="custom-svg"
                        src="@/assets/images/icon/user/cart-plus.svg"
                        alt="cart-plus"
                      />
                    </div>
                  </button>
                  <button
                    type="submit"
                    class="btn error radius"
                    @click="showDetail('deleteLike')"
                  >
                    刪除收藏
                  </button>
                </div>
              </div>
            </div>
          </div>
        </template>
        <template v-else> 目前沒有心儀的商品~ </template>
      </div>
    </div>
  </div>
  <div class="detail-modal" v-show="isVisible['deleteLike']">
    <div class="content">
      <h4 class="h4">確定刪除收藏商品</h4>
      <div class="subtext text_14">
        <p>
          您已選擇刪除商品收藏，此操作將永久刪除該商品收藏並無法恢復。請確保您的決定是確定的，並謹慎考慮是否刪除該商品收藏。
        </p>
        <p>
          如果您確定刪除，請點擊確認按鈕。如有任何疑問或需要協助，請隨時與我們聯繫。謝謝您的配合！
        </p>
        <p class="caption error">
          注意：一旦刪除，商品收藏將從您的收藏清單中移除且無法恢復，請謹慎操作。
        </p>
      </div>
      <div class="icon-24 error" @click="hideDetail('deleteLike')">
        <img
          class="custom-svg"
          src="@/assets/images/icon/menu/close_big.svg"
          alt="close_big-icon"
        />
      </div>
      <div class="btn-space">
        <button
          type="submit"
          class="btn other radius"
          @click="hideDetail('deleteLike')"
        >
          取消
        </button>
        <button
          type="submit"
          class="btn error radius"
          @click="hideDetail('deleteLike')"
        >
          確認刪除
        </button>
      </div>
    </div>
    <div
      class="pageMask"
      v-show="isVisible['deleteLike']"
      @click="hideDetail('deleteLike')"
    ></div>
  </div>
</template>
<script>
import { GET } from "@/plugin/axios";
import axios from "axios";
import { BASE_URL } from "@/assets/js/common.js";

export default {
  data() {
    return {
      //判斷視窗寬度是否大於768px用
      isLargeScreen: false,
      //商品分類列是否顯示
      isShow: true,
      searchText: "",
      // 會員的資料(僅在進入畫面時去取一次資料)
      userData: [],
      // 呈現的商品資料(針對userData來搜尋篩選)
      productDisplay: [],
      tabActive: 1,
      checkedItem: "商品",
      categoryItem: [{ type: "商品" }, { type: "行程" }],
      isVisible: {
        deleteLike: false,
      },
      userInfo: "",
      PackageTrace: [],
      userPackage: [],
      ProdTrace: [],
      userProdTrace: [],
      ProductData: [],
      products: [],
      packageData: [],
      packages: [],
      favoriteOrders: {
        ["products"]: [],
        ["packages"]: [],
      },
    };
  },
  created() {
    // 取得API
    // GET("/data/userData.json").then((res) => {
    //   this.userData = res;
    // });
    this.updateDisplay();
    this.userInfo = this.$store.state.userInfo;
    this.getPackageTrace();
    this.getProdTrace();
    this.getData();
    this.getDataPgk();
  },
  mounted() {
    // 監聽視窗大小改變事件
    window.addEventListener("resize", this.handleResize);
    // 初始判定視窗大小
    this.handleResize();
  },
  computed: {},
  methods: {
    updateDisplay() {
      this.empty = false;
      this.productDisplay = this.favoriteOrders.products;
      this.isEmpty();
    },
    updateTab(index) {
      this.empty = false;
      if (this.categoryItem[index].type === "商品") {
        this.productDisplay = this.favoriteOrders.products;
        // console.log(typeof this.productDisplay)
        return this.productDisplay;
      } else if (this.categoryItem[index].type === "行程") {
        this.productDisplay = this.favoriteOrders.packages;
        return this.productDisplay;
      }
      this.productDisplay = this.favoriteOrders.products;
      // this.productDisplay = this.favoriteOrders.filter(
      //   (item) => item.type === this.categoryItem[index].type
      // );
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
    },
    showDetail(itemOrder) {
      this.isVisible[itemOrder] = true;
    },
    hideDetail(itemOrder) {
      this.isVisible[itemOrder] = false;
    },
    //取資料
    async getPackageTrace() {
      await axios
        .get(`${BASE_URL}getPackageTrace.php`)
        .then((response) => {
          this.PackageTrace = response.data;

          // 出現指定會員的行程收藏資料
          this.userProdTrace = response.data.filter((element) => {
            return element.mem_no === this.userInfo.mem_no;
          });

          // 確認是否成功
          console.log("Data getPackageTrace");
        })
        .catch((error) => {
          console.error("There was an error fetching the data:", error);
        });
    },
    //取資料
    async getProdTrace() {
      await axios
        .get(`${BASE_URL}getProdTrace.php`)
        .then((response) => {
          this.ProdTrace = response.data;

          // 出現指定會員的商品收藏資料
          this.favoriteOrders["packages"] = response.data.filter((element) => {
            return element.mem_no === this.userInfo.mem_no;
          });

          // 確認是否成功
          console.log("Data getProdTrace");
        })
        .catch((error) => {
          console.error("There was an error fetching the data:", error);
        });
    },

    //抓資料
    getData() {
      const type = "get"; // 設定要執行的操作，這裡是取得資料
      axios
        .get(`${BASE_URL}getProduct.php?type=${type}`)
        .then((response) => {
          this.productData = response.data;
          // 出現指定會員的商品收藏資料
          // this.Products = response.data.filter((element) => {
          //   return element.prod_no === this.ProdTrace.prod_no;
          // });
          // this.Products = this.ProductData.filter((product) => {
          //   return this.ProdTrace.some(
          //     (trace) => trace.prod_no === product.prod_no
          //   );
          // });
          this.products = this.ProdTrace.map((trace) => {
            const matchedProduct = this.productData.find(
              (product) => product.prod_no === trace.prod_no
            );
            this.favoriteOrders["products"] = this.products
            // this.favoriteOrders["products"]["type"] = "商品";
            return matchedProduct;
          });
        })
        .catch((error) => {
          console.error("There was an error fetching the data:", error);
        });
    },
    getDataPgk() {
      axios
        .get(`${BASE_URL}/getPackage.php`)
        .then((response) => {
          this.packageData = response.data;

          this.packages = this.PackageTrace.map((trace) => {
            const matchedProduct = this.packageData.find(
              (pgk) => pgk.pkg_no === trace.pkg_no
            );
            this.favoriteOrders["packages"] = this.packages
            // this.favoriteOrders["packages"]["type"] = "行程";
            return matchedProduct;
          });
        })
        .catch((error) => {
          console.error("There was an error fetching the data:", error);
        });
    },
  },
  beforeUnmount() {
    // 移除事件聆聽器
    window.removeEventListener("resize", this.handleResize);
  },
};
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
  background-color: rgba(black, 0.3);
  width: 100vw;
  height: 100vh;
  position: fixed;
  top: 0;
  left: 0;
  z-index: 99;
}
</style>

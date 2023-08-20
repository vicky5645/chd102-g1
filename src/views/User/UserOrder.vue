<template>
  <div class="settings">
    <h1 class="h4">訂單管理</h1>
    <div class="top-space">
      <div>
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
      </div>
      <div class="input-wrap login">
        <input v-model="searchText" type="text" placeholder="" required />
        <label>搜尋</label>
        <button class="btn" @click="updateDisplay">
          <i class="fa-solid fa-magnifying-glass"></i>
        </button>
      </div>
    </div>
    <hr />
    <div class="user-control-content">
      <template v-if="checkedItem === '購票訂單'">
        <div class="tab-btn-out">
          <button
            v-for="(item, key) in nowStatus"
            :class="{ active: key === tabActive }"
            class="text tab-btn-package btn"
            @click="packageTab(key)"
          >
            {{ item }}
          </button>
        </div>
      </template>
      <template v-if="products.length === 0"> 還沒有買過東西喔~ </template>
      <template v-else>
        <template v-if="checkedItem == '商品訂單'">
          <div
            class="card-out"
            v-for="(item, index) in userOrders"
            :key="item.order_no"
          >
            <div class="card">
              <!-- 手機版卡片，訂單編號顯示位置 -->
              <!-- <template v-if="!isShow"> -->
                <div class="show-mobile bold">
                  訂單編號:
                  <span>{{ item.order_no }}</span>
                </div>
                <div class="show-mobile bold">
                  訂購日期:
                  <span>{{ item.order_date }}</span>
                </div>
              <!-- </template> -->
              <!-- <router-link :to="`/productDetail/${item.order_no}`"> -->
              <div @click="showOrderDetail(item)">
                <div class="cradPic">
                  <Images
                    :imgURL="`images/online-mall/${item.order_item[0].prod_file}`"
                    :alt="`${item.prod_name}`"
                  />
                </div>
              </div>
              <!-- </router-link> -->
              <div class="content">
                <div class="card-top">
                  <div class="des">
                    <div class="des-text">
                      <!-- 桌機版卡片，訂單編號顯示位置 -->
                      <!-- <template v-if="isShow"> -->
                        <div class="hidden-mobile bold">
                          訂單編號:
                          <span>{{ item.order_no }}</span>
                        </div>
                        <div class="hidden-mobile bold">
                          訂購日期:
                          <span>{{ item.order_date }}</span>
                        </div>
                      <!-- </template> -->
                      <p v-for="oi in item.order_item">
                        {{
                          `${oi.prod_name} × ${oi.quantity} = ${oi.price * oi.quantity}`
                        }}
                      </p>
                      <h3 class="h3">{{ item.prod_name }}</h3>
                    </div>
                    <div class="des-right">
                      <div class="price h2">$ {{ item.order_total }}</div>
                    </div>
                  </div>
                </div>
                <div class="card-bottom">
                  <div class="btn-space">
                    <button
                      type="submit"
                      class="btn other radius"
                      @click="showOrderDetail(item)"
                    >
                      詳細
                    </button>
                    <button type="submit" class="btn primary radius">
                      聯絡客服
                    </button>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </template>
        <template v-else>
          <template v-for="(item, index) in listDisplay">
            <div
              v-if="checkedItem == '購票訂單' && item.order_status == tabActive"
              class="card-out"
              :key="item.id"
            >
              <div class="card">
                <router-link :to="`/booking-info/${item.id}`">
                  <div class="cradPic">
                    <Images :imgURL="`${item.image}`" :alt="`${item.title}`" />
                  </div>
                </router-link>
                <div class="content">
                  <div class="card-top">
                    <div class="des">
                      <div class="des-text">
                        <div class="label">
                          訂單編號:
                          <span>{{ item.order_no }}</span>
                        </div>
                        <div class="label">
                          訂購日期:
                          <span>{{ item.order_date }}</span>
                        </div>
                        <h3 class="h3 clamp-2">
                          {{ item.title }}{{ item.prod_summary }}
                        </h3>
                        <div class="more">
                          <p class="bold">剩餘座位 {{ item.seat }}</p>
                          <p class="label">
                            <i class="fa-solid fa-train"></i> {{ item.train }}
                          </p>
                          <p class="label">
                            <i class="fa-solid fa-calendar-days"></i> 行程日期:
                            {{ item.order_date }}
                          </p>
                        </div>
                      </div>
                      <div class="des-right">
                        <div class="price h2">$ {{ item.price }}</div>
                      </div>
                    </div>
                  </div>
                  <div class="card-bottom">
                    <div class="btn-space">
                      <button
                        v-if="tabActive !== 2"
                        type="submit"
                        class="btn secondary2 radius"
                        @click="showDetail('certificate')"
                      >
                        查看憑證
                      </button>
                      <button
                        v-if="tabActive === 1"
                        type="submit"
                        class="btn other radius"
                        @click="showDetail('evaluate')"
                      >
                        評價
                      </button>
                      <button
                        type="submit"
                        class="btn other radius"
                        @click="showOrderDetail(item)"
                      >
                        詳細
                      </button>
                      <button type="submit" class="btn primary radius">
                        聯絡客服
                      </button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </template>
        </template>
      </template>
    </div>
  </div>

  <!-- 彈出視窗 -->
  <OrderDetailModal
    :orderDetail="orderDetail"
    :isModalVisible="isModalVisible"
    @close-modal="isModalVisible = false"
  />
  <div class="detail-modal" v-show="isVisible['certificate']">
    <div class="content">
      <h4 class="h4">購票憑證</h4>
      <div class="subtext text_14">
        <p>購票方案: 昂坪360纜車票(單程/來)</p>
        <p>出發時間: 2023/7/5</p>
        <p>序號: WY00255774</p>
      </div>
      <button
        type="submit"
        class="btn primary radius"
        @click="hideDetail('certificate')"
      >
        確認
      </button>
    </div>
    <div
      class="pageMask"
      v-show="isVisible['certificate']"
      @click="hideDetail('certificate')"
    ></div>
  </div>
  <div class="detail-modal" v-show="isVisible['evaluate']">
    <div class="content">
      <p class="h4">請填寫本次購票評價</p>
      <UserEvaluateStars />
      <button
        type="submit"
        class="btn primary radius"
        @click="hideDetail('evaluate')"
      >
        送出評價
      </button>
    </div>
    <div
      class="pageMask"
      v-show="isVisible['evaluate']"
      @click="hideDetail('evaluate')"
    ></div>
  </div>
</template>

<script>
import { GET } from "@/plugin/axios";
import OrderDetailModal from "@/components/OrderDetailModal.vue";
import UserEvaluateStars from "@/components/UserEvaluateStars.vue";
import axios from "axios";
import { BASE_URL } from "@/assets/js/common.js";
export default {
  components: {
    OrderDetailModal,
    UserEvaluateStars,
  },
  data() {
    return {
      isModalVisible: false,
      isVisible: {
        certificate: false,
        evaluate: false,
      },
      orderDetail: {
        order_no: 0,
        order_date: 0,
        item: "",
      },
      //顯示未有相關商品上架的提示
      empty: false,
      //判斷視窗寬度是否大於768px用
      isLargeScreen: false,
      //商品分類列是否顯示
      isShow: true,
      searchText: "",
      // 會員的資料(僅在進入畫面時去取一次資料)
      userData: [],
      // 呈現的商品資料(針對userData來搜尋篩選)
      listDisplay: [],
      checkedItem: "商品訂單",
      categoryItem: [{ type: "商品訂單" }, { type: "購票訂單" }],
      tabActive: 0,
      nowStatus: ["即將出發", "已出發", "已取消"],
      userInfo: {},
      proOrderData: [],
      products: [],
      userOrders: {},
    };
  },
  created() {
    this.userInfo = this.$store.state.userInfo;
    // 取得API
    GET("/data/userData.json").then((res) => {
      this.userData = res;
    });
    this.getMemberOrder();
    // this.getData();
    // this.updateDisplay();
  },
  mounted() {
    // 監聽視窗大小改變事件
    window.addEventListener("resize", this.handleResize);
    // 初始判定視窗大小
    // this.handleResize();
  },
  computed: {},
  methods: {
    updateDisplay() {
      this.empty = false;
      if (this.searchText === "") {
        this.listDisplay = this.products;
      } else {
        let nowData;
        this.checkedItem == "商品訂單"
          ? (nowData = this.products)
          : (nowData = this.userData.package_orders);
        this.listDisplay = nowData.filter((item) =>
          item.title.includes(this.searchText)
        );
        this.isEmpty();
      }
    },
    // 分類按鈕
    packageTab(index) {
      this.tabActive = index;
    },
    updateTab(index) {
      this.empty = false;
      if (this.categoryItem[index].type === "商品訂單") {
        this.listDisplay = this.products;
        return this.listDisplay;
      } else if (this.categoryItem[index].type === "購票訂單") {
        this.listDisplay = this.userData.package_orders;
        return this.listDisplay;
      }
      this.isEmpty();
    },
    isEmpty() {
      if (this.listDisplay.length === 0) {
        this.empty = true;
        return this.empty;
      }
      return this.listDisplay;
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
    showOrderDetail(itemOrder) {
      this.isModalVisible = true;
      this.orderDetail = itemOrder;
    },
    showDetail(itemOrder) {
      this.isVisible[itemOrder] = true;
    },
    hideDetail(itemOrder) {
      this.isVisible[itemOrder] = false;
    },
    // 處理訂單項目
    makeOrderItems(yourData) {
      const userOrders = yourData.reduce((result, currentItem) => {
        // 在結果陣列中找尋是否已經有相同 order_no 的項目
        const existingOrder = result.find(
          (item) => item.order_no === currentItem.order_no
        );

        if (existingOrder) {
          // 如果已經有相同 order_no 的項目，將當前項目的產品資訊添加到 order_item 中
          existingOrder.order_item.push({
            price: currentItem.price,
            quantity: currentItem.quantity,
            prod_name: currentItem.prod_name,
            prod_price: currentItem.prod_price,
            prod_file: currentItem.prod_file,
          });
        } else {
          // 如果結果陣列中還沒有相同 order_no 的項目，創建一個新的項目
          result.push({
            order_no: currentItem.order_no,
            order_date: currentItem.order_date,
            mem_no: currentItem.mem_no,
            order_total: currentItem.order_total,
            order_status: currentItem.order_status,
            recipient: currentItem.recipient,
            recipient_tele: currentItem.recipient_tele,
            recipient_address: currentItem.recipient_address,
            pay: currentItem.pay,
            order_item: [
              {
                price: currentItem.price,
                quantity: currentItem.quantity,
                prod_name: currentItem.prod_name,
                prod_price: currentItem.prod_price,
                prod_file: currentItem.prod_file,
              },
            ],
          });
        }

        return result;
      }, []);
      this.userOrders = userOrders;
    },
    // 取資料
    async getMemberOrder() {
      //傳送資料庫要對應回傳的內容
      // const data = new URLSearchParams(); // GET 表單資料
      // data.append("mem_no", this.userInfo.mem_no);
      // data.append("type", "getOrder");
      await axios
        .get(`${BASE_URL}getOrderItem.php`, {
          params: {
            mem_no: this.userInfo.mem_no,
            type: "getOrder",
          },
        })
        .then((response) => {
          this.proOrderData = response.data;
          // this.products = this.productOrder
          this.makeOrderItems(this.proOrderData);

          this.products = this.proOrderData.filter(
            (product) => product !== null
          );

          // 抓取訂單編號對應的商品資料
          // this.products = this.userProdTrace.map((trace) => {
          //   const matchedProduct = this.proOrderData.find(
          //     (product) => product.order_no === trace.order_no
          //   );
          //   this.favoriteOrders["products"] = this.products;
          //   return matchedProduct;
          // });
          // 使用 reduce 方法合併相同 order_no 的項目
          // 未成功
          // this.mergedData = proOrderData.reduce((result, currentItem) => {
          //   // 在結果陣列中找尋是否已經有相同 order_no 的項目
          //   const existingItem = result.find(
          //     (item) => item.order_no === currentItem.order_no
          //   );

          //   if (existingItem) {
          //     // 如果已經有相同 order_no 的項目，將當前項目的相關屬性合併進去
          //     existingItem.prod_name.push(currentItem.prod_name);
          //     existingItem.prod_price.push(currentItem.prod_price);
          //     existingItem.prod_file.push(currentItem.prod_file);
          //   } else {
          //     // 如果結果陣列中還沒有相同 order_no 的項目，創建一個新的項目
          //     result.push({
          //       order_no: currentItem.order_no,
          //       order_date: currentItem.order_date,
          //       // ... 其他屬性
          //       prod_name: [currentItem.prod_name],
          //       prod_price: [currentItem.prod_price],
          //       prod_file: [currentItem.prod_file],
          //     });
          //   }
          //   console.log(result);
          //   return result;
          // }, []);

          // 確認是否成功
          console.log("Data retrieved from MySQL:", "dataFromMySQL");
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

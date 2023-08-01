<style lang="scss" scoped>
@import "@/assets/scss/style.scss";

$secondary2: #b3cee2;

* {
  box-sizing: border-box;
}
.container {
  @include layout(1200);
}

section.title {
  text-align: center;
  background-color: white;
  h1 {
    font-size: 2rem;
    padding: 1.25rem;
  }
}

section.spot-filter {
  background-color: white;
  box-shadow: 0 3px 10px rgb(0 0 0 / 0.2);
  // box-shadow: 0px 1px 6px 0px rgba(122, 172, 191, 0.2);
  border-radius: 15px;
  padding: 0.5rem 0;
  margin-top: 1rem;
  .spot-tag {
    margin: 1rem 0;
    position: relative;
    left: -8px;
    span {
      font-size: 1.5rem;
      font-weight: bold;
      color: #012840;
      background-color: $secondary2;
      border-radius: 0 5px 5px 0;
      padding: 0.5rem 0.75rem;
    }

    .triangle {
      position: absolute;
      top: 105%;
      left: 0;
      width: 0;
      height: 0;
      border-style: solid;
      border-width: 0 8px 8px 0;
      border-color: transparent #7aacbf transparent transparent;
    }
  }
  .spot-list {
    display: flex;
    .spot-item {
      text-align: center;
      p {
        font-size: 1.25rem;
        font-weight: bold;
      }
      .spot-img {
        cursor: pointer;
        aspect-ratio: 1/1;
        border-radius: 50%;
        transition: all 0.3s ease-in-out;
        overflow: hidden;
        img {
          border-radius: 50%;
          width: 100%;
          aspect-ratio: 1/1;
          object-fit: cover;
          transition: all 0.3s ease-in-out;
          &:hover {
            transform: scale(1.1);
          }
        }

        &:hover {
          box-shadow: 0 0 22.5px #f29c50;
        }
      }
    }
  }

  .filter {
    display: flex;
    align-items: center;
    border-top: 1px solid #333;
    padding: 0.5rem 0 0.25rem 0;
    .inner {
      font-size: 1.25rem;
      line-height: 42px;
      margin: 0 1.5rem 0 3rem;
      font-weight: bold;
    }

    .btn-wrap {
      margin-right: auto;
      button {
        display: inline-block;
        font-size: 1.25rem;
        font-weight: bold;
        background-color: transparent;
        border: none;
        margin: 0 3rem;
        i {
          margin-left: 0.25rem;
        }
      }
    }
  }
}

section.package-list {
  .package-item {
    display: flex;
    background-color: white;
    border-radius: 15px;
    position: relative;
    margin: 1.25rem 0;
    box-shadow: 0 3px 10px rgb(0 0 0 / 0.2);
    // box-shadow: 0px 1px 6px 0px rgba(122, 172, 191, 0.2);
    .img {
      width: 42.5%;
      img {
        display: block;
        width: 100%;
        border-radius: 15px 0 0 15px;
      }
    }

    .info {
      width: 42.5%;
      padding: 0 1rem;
      display: flex;
      flex-direction: column;
      flex-grow: 1;

      h3 {
        // font-size: 1.5rem;
        padding: 1rem 0;
      }

      .wrap {
        display: flex;
        flex-direction: column;
        margin: auto 0;
        .spec {
          .seat,
          .date,
          .train {
            padding: 0.1rem 0;
            font-size: 1.25rem;
          }
        }
      }
    }

    .price {
      text-align: center;
      padding: 0.75rem 0.5rem;
      // flex-grow: 1;
      display: flex;
      flex-direction: column;
      del {
        color: rgb(146, 137, 137);
        font-size: 1.25rem;
        margin: auto 0 1rem 0;
      }
      .purchase {
        span {
          display: block;
          width: 144px;
          margin: 0 auto;
          background-color: #fbc756;
          padding: 0.5rem 0.75rem;
          font-size: 1.5rem;
          font-weight: bold;
          color: #012840;
          border-radius: 10px;
          border: 1px solid #012840;
        }
      }
    }

    i.heart {
      cursor: pointer;
      position: absolute;
      top: 0;
      right: 1.5rem;
      font-size: 2.5rem;
      color: red;
    }
    .sale {
      position: absolute;
      background-color: #fbc756;
      top: 1rem;
      left: -0.5rem;
      padding: 0.5rem;
      border-radius: 0 5px 5px 0;
      font-weight: bold;
      .triangle {
        position: absolute;
        top: 100%;
        left: 0;
        width: 0;
        height: 0;
        border-style: solid;
        border-width: 0 8px 8px 0;
        border-color: transparent #d4a133 transparent transparent;
      }
    }
  }
}

@media screen and (max-width: 768px) {
  section.package-list {
    .package-item {
      flex-wrap: wrap;
      .img {
        width: 100%;
        img {
          object-fit: cover;
          border-radius: 15px;
        }
      }
      .info {
        width: 100%;
        padding: 0.75rem 0.5rem;
        display: flex;
        flex-direction: column;
        flex-grow: 0;
        h3 {
          text-align: center;
          width: 100%;
          font-size: 1.5rem;
        }
        .wrap {
          .spec {
            padding: 0.5rem 0;
          }

          p {
            width: 100%;
          }
        }
      }

      .price {
        // width: 100%;
        display: flex;
        flex-direction: row;
        flex-grow: 1;

        del {
          display: block;
          margin: 0 1rem 0 auto;
        }

        .purchase {
          margin-left: auto;
        }
      }

      i.heart {
        top: 0.5rem;
        right: 0.25rem;
      }
    }
  }
}

@media screen and (max-width: 415px) {
  .container {
    padding: 0 1rem;
  }

  section.spot-filter {
    .spot-list {
      display: flex;
      flex-wrap: wrap;
      .spot-item {
        &.col-2 {
          width: 50%;
        }
      }
    }

    .filter {
      display: flex;
      flex-wrap: wrap;

      .inner {
        display: none;
        font-size: 1.25rem;
      }

      .btn-wrap {
        display: flex;
        margin: auto;
        button {
          margin: 0 0.5rem;
        }
      }
    }
  }
}
</style>

<template>
  <section class="title">
    <h1 class="h1">行程選擇</h1>
  </section>
  <div class="container">
    <section class="spot-filter">
      <div class="spot-tag">
        <span>景點</span>
        <div class="triangle"></div>
      </div>
      <div class="spot-list">
        <div
          class="spot-item col-2"
          v-for="(item, index) in spotList"
          :key="index"
          @click="spot(index)"
        >
          <div class="spot-img">
            <img :src="item.link" alt="" />
          </div>
          <p>{{ item.name }}</p>
        </div>
      </div>
      <div class="filter">
        <div class="inner">排序</div>
        <div class="btn-wrap">
          <button
            class="filter"
            @click="
              sortPrice();
              toggleArrowPrice();
            "
          >
            行程價格<i :class="arrowTypePrice"></i>
          </button>
          <button
            class="filter"
            @click="
              sortTime();
              toggleArrowTime();
            "
          >
            出發日期<i :class="arrowTypeTime"></i>
          </button>
          <button
            class="filter"
            @click="
              sortRemain();
              toggleArrowRemain();
            "
          >
            剩餘名額<i :class="arrowTypeRemain"></i>
          </button>
        </div>
      </div>
    </section>

    <section class="package-list">
      <div
        class="package-item"
        v-for="(item, index) in packageList"
        :key="index"
      >
        <div class="img">
          <Images :imgURL="`${item.link}`" :alt="``" />
          <!-- <img :src="item.link" alt="" /> -->
        </div>
        <div class="info">
          <h3 class="h3" v-html="item.title"></h3>
          <div class="wrap">
            <div class="spec">
              <div class="seat">
                <Icon type="md-contact" />剩餘<b>{{ item.seat }}</b
                >個名額
              </div>
              <div class="date"><Icon type="md-calendar" />{{ item.date }}</div>
              <div class="train"><Icon type="md-train" />{{ item.train }}</div>
            </div>
            <p class="clamp-2">{{ item.info }}</p>
          </div>
        </div>
        <div class="price">
          <del v-if="item.sale">NT${{ item.origin }}</del>
          <div
            class="purchase"
            :style="{ 'margin-top': !item.sale ? 'auto' : 'initial' }"
          >
            <router-link :to="`/booking-info/${item.id}`">
              <span
                class="btn primary"
                @mouseover="change(index)"
                @mouseleave="reset(index)"
                >{{ item.inner }}</span
              >
            </router-link>
          </div>
        </div>
        <Icon
          :type="item.heartType"
          class="heart"
          @click="toggleHeart(index)"
        />

        <div class="sale" v-show="item.sale == true">
          早鳥優惠中
          <div class="triangle"></div>
        </div>
      </div>
    </section>
  </div>
</template>

<script>
import { GET } from "@/plugin/axios";
export default {
  data() {
    return {
      ascending: true,
      filterResult: [],
      arrowTypePrice: "fa-solid fa-caret-up",
      arrowTypeTime: "fa-solid fa-caret-up",
      arrowTypeRemain: "fa-solid fa-caret-up",
      spotList: [
        {
          name: "高原遺跡",
          link: require("@/assets/images/spot/01.jpg"),
        },

        {
          name: "銀月山脈",
          link: require("@/assets/images/spot/02.jpg"),
        },

        {
          name: "綠野牧場",
          link: require("@/assets/images/spot/03.jpg"),
        },

        {
          name: "海底餐廳",
          link: require("@/assets/images/spot/04.png"),
        },

        {
          name: "忘卻之湖",
          link: require("@/assets/images/spot/05.jpg"),
        },

        {
          name: "景觀公園",
          link: require("@/assets/images/spot/08.webp"),
        },
      ],

      filterList: [
        {
          name: "行程價格",
        },

        {
          name: "出發日期",
        },

        {
          name: "剩餘名額",
        },

        {
          name: "早鳥優惠",
        },
      ],
      packageList: [],
      // packageList: [
      //   {
      //     title: "探尋島嶼之美，搭乘耀眼的七星豪華列車",
      //     title2: "—————「SEVEN STARS ROAMING」",
      //     link: require("@/assets/images/spot/07.jpg"),
      //     seat: 20,
      //     date: "2025-03-18",
      //     train: "seven stars",
      //     sale: false,
      //     origin: 36888,
      //     price: "NT$36888",
      //     inner: "NT$36888",

      //     hover: "立即購票",
      //     iconType: "md-heart-outline",
      //     info: "體驗一趟令人難以忘懷的列車旅程！從綠野牧場到壯麗的景觀公園，再到絢爛極光的銀月山脈，此趟旅行將帶您穿越自然奇觀和歷史遺跡，而旅程的最後則是建於海底的獨特餐廳，讓您同時品味美食和...",
      //     pass: [
      //       { name: "高原遺跡" },
      //       { name: "銀月山脈" },
      //       { name: "綠野牧場" },
      //       { name: "海底餐廳" },
      //       { name: "景觀公園" },
      //     ],
      //   },
      //   {
      //     title: "探尋島嶼之美，搭乘尊爵的ROYAL豪華列車",
      //     title2: "——————————「ROYAL EXPRESS」",
      //     link: require("@/assets/images/spot/09.jpg"),
      //     seat: 20,
      //     date: "2025-04-18",
      //     train: "royal",
      //     sale: false,
      //     origin: 41888,
      //     price: "NT$36888",
      //     inner: "NT$36888",

      //     hover: "立即購票",
      //     iconType: "md-heart-outline",
      //     info: "體驗一趟令人難以忘懷的列車旅程！從綠野牧場到壯麗的景觀公園，再到絢爛極光的銀月山脈，此趟旅行將帶您穿越自然奇觀和歷史遺跡，而旅程的最後則是建於海底的獨特餐廳，讓您同時品味美食和...",
      //     pass: [
      //       { name: "忘卻之湖" },
      //       { name: "銀月山脈" },
      //       { name: "綠野牧場" },
      //       { name: "海底餐廳" },
      //       { name: "景觀公園" },
      //     ],
      //   },
      //   {
      //     title: "探尋島嶼之美，搭乘閃耀的GOLDEN豪華列車",
      //     title2: "—————————「GOLDEN EXPRESS」",
      //     link: require("@/assets/images/spot/10.webp"),
      //     seat: 20,
      //     date: "2025-05-18",
      //     train: "golden",
      //     sale: true,
      //     origin: 31888,
      //     price: "NT$26888",
      //     inner: "NT$26888",

      //     hover: "立即購票",
      //     iconType: "md-heart-outline",
      //     info: "體驗一趟令人難以忘懷的列車旅程！從綠野牧場到壯麗的景觀公園，再到絢爛極光的銀月山脈，此趟旅行將帶您穿越自然奇觀和歷史遺跡，而旅程的最後則是建於海底的獨特餐廳，讓您同時品味美食和...",
      //     pass: [
      //       { name: "海底餐廳" },
      //       { name: "忘卻之湖" },
      //       { name: "景觀公園" },
      //     ],
      //   },
      //   {
      //     title: "探尋島嶼之美，搭乘閃耀的GOLDEN豪華列車",
      //     title2: "—————————「GOLDEN EXPRESS」",
      //     link: require("@/assets/images/spot/06.webp"),
      //     seat: 20,
      //     date: "2025-06-08",
      //     train: "golden",
      //     sale: true,
      //     origin: 31888,
      //     price: "NT$26888",
      //     inner: "NT$26888",

      //     hover: "立即購票",
      //     iconType: "md-heart-outline",
      //     info: "體驗一趟令人難以忘懷的列車旅程！從綠野牧場到壯麗的景觀公園，再到絢爛極光的銀月山脈，此趟旅行將帶您穿越自然奇觀和歷史遺跡，而旅程的最後則是建於海底的獨特餐廳，讓您同時品味美食和...",
      //     pass: [
      //       { name: "綠野牧場" },
      //       { name: "忘卻之湖" },
      //       { name: "景觀公園" },
      //     ],
      //   },
      //   {
      //     title: "探尋島嶼之美，搭乘耀眼的七星豪華列車",
      //     title2: "—————「SEVEN STARS ROAMING」",
      //     link: require("@/assets/images/spot/07.jpg"),
      //     seat: 20,
      //     date: "2025-06-18",
      //     train: "seven stars",
      //     sale: true,
      //     origin: 36888,
      //     price: "NT$31888",
      //     inner: "NT$31888",

      //     hover: "立即購票",
      //     iconType: "md-heart-outline",
      //     info: "體驗一趟令人難以忘懷的列車旅程！從綠野牧場到壯麗的景觀公園，再到絢爛極光的銀月山脈，此趟旅行將帶您穿越自然奇觀和歷史遺跡，而旅程的最後則是建於海底的獨特餐廳，讓您同時品味美食和...",
      //     pass: [
      //       { name: "高原遺跡" },
      //       { name: "銀月山脈" },
      //       { name: "綠野牧場" },
      //       { name: "海底餐廳" },
      //       { name: "景觀公園" },
      //     ],
      //   },
      //   {
      //     title: "探尋島嶼之美，搭乘尊爵的ROYAL豪華列車",
      //     title2: "——————————「ROYAL EXPRESS」",
      //     link: require("@/assets/images/spot/09.jpg"),
      //     seat: 20,
      //     date: "2025-07-18",
      //     train: "royal",
      //     sale: true,
      //     origin: 36888,
      //     price: "NT$31888",
      //     inner: "NT$31888",

      //     hover: "立即購票",
      //     iconType: "md-heart-outline",
      //     info: "體驗一趟令人難以忘懷的列車旅程！從綠野牧場到壯麗的景觀公園，再到絢爛極光的銀月山脈，此趟旅行將帶您穿越自然奇觀和歷史遺跡，而旅程的最後則是建於海底的獨特餐廳，讓您同時品味美食和...",
      //     pass: [
      //       { name: "忘卻之湖" },
      //       { name: "銀月山脈" },
      //       { name: "綠野牧場" },
      //       { name: "海底餐廳" },
      //       { name: "景觀公園" },
      //     ],
      //   },
      // ],
    };
  },

  methods: {
    //價錢切換成立即購買
    change(index) {
      this.packageList[index].inner = this.packageList[index].hover;
    },

    reset(index) {
      this.packageList[index].inner = this.packageList[index].price;
    },
    // ---------------------------
    //愛心切換
    toggleHeart(index) {
      this.packageList[index].heartType =
        this.packageList[index].heartType === "md-heart-outline"
          ? "md-heart"
          : "md-heart-outline";
    },
    //升降冪切換arrow
    toggleArrowPrice() {
      this.arrowTypePrice =
        this.arrowTypePrice === "fa-solid fa-caret-up"
          ? "fa-solid fa-caret-down"
          : "fa-solid fa-caret-up";
    },
    toggleArrowTime() {
      this.arrowTypeTime =
        this.arrowTypeTime === "fa-solid fa-caret-up"
          ? "fa-solid fa-caret-down"
          : "fa-solid fa-caret-up";
    },
    toggleArrowRemain() {
      this.arrowTypeRemain =
        this.arrowTypeRemain === "fa-solid fa-caret-up"
          ? "fa-solid fa-caret-down"
          : "fa-solid fa-caret-up";
    },
    // 出發時間排序
    sortTime() {
      this.packageList.sort((a, b) => {
        if (this.ascending) {
          return new Date(a.date) - new Date(b.date);
        } else {
          return new Date(b.date) - new Date(a.date);
        }
      });
      // 將ascending的值取反，以便下一次調用時改變排序順序
      this.ascending = !this.ascending;
      if (this.ascending) {
        this.arrowTypeTime = "fa-solid fa-caret-up";
      } else {
        this.arrowTypeTime = "fa-solid fa-caret-down";
      }
    },
    //原始價格排序
    sortPrice() {
      this.packageList.sort((a, b) => {
        if (this.ascending) {
          return a.origin - b.origin;
        } else {
          return b.origin - a.origin;
        }
      });
      //將ascending的值取反，以便下一次調用時改變排序順序
      this.ascending = !this.ascending;
      if (this.ascending) {
        this.arrowTypePrice = "fa-solid fa-caret-up";
      } else {
        this.arrowTypePrice = "fa-solid fa-caret-down";
      }
    },
    //剩餘名額排序
    sortRemain() {
      this.packageList.sort((a, b) => {
        if (this.ascending) {
          return a.seat - b.seat;
        } else {
          return b.seat - a.seat;
        }
      });
      //將ascending的值取反，以便下一次調用時改變排序順序
      this.ascending = !this.ascending;
      if (this.ascending) {
        this.arrowTypeRemain = "fa-solid fa-caret-up";
      } else {
        this.arrowTypeRemain = "fa-solid fa-caret-down";
      }
    },
    // 還無法作用
    // spot(index) {
    //   if (index === 0) {
    //     // do something for the first button
    //     this.filterResult = this.packageList.map((item,index) =>
    //       item.stageList.filter((item,index) => item.name.includes("高原"))
    //     );
    //   } else if (index === 1) {
    //     // do something for the second button
    //   } else if (index === 2) {
    //     // do something for the third button
    //   } else if (index === 3) {
    //     // do something for the fourth button
    //   } else if (index === 4) {
    //     // do something for the fifth button
    //   } else if (index === 5) {
    //     // do something for the sixth button
    //   }
    // },
  },
  created() {
    // 取得API
    GET("/data/packageData.json").then((res) => {
      this.packageList = res;
    });
  },
};
</script>

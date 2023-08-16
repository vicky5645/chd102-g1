<style lang="scss" scoped>
@import "@/assets/scss/style.scss";

* {
  box-sizing: border-box;
}
.container {
  @include layout(1200);
}

section.title {
  text-align: center;
  padding: 1.5rem 0;
  margin-bottom: 1rem;
  background-color: white;
  h1 {
    font-size: 2rem;
  }
  p {
    padding-top: 1rem;
    font-size: 1.25rem;
    font-weight: bold;
  }
}
.swiper {
  width: 100%;
  margin: auto;

  aspect-ratio: 16/9;
  z-index: 0;
  border-radius: 15px;
  .swiper-slide {
    img {
      width: 100%;
      height: 100%;
      object-fit: cover;
    }
  }
}

button.swiper-button-prev,
button.swiper-button-next {
  background-color: transparent;
  border: none;
  img {
    width: 50px;
    height: 50px;
  }
  &::after {
    content: "";
  }
}

button.swiper-button-next {
  transform: rotate(180deg);
}

.dash {
  width: 100%;
  height: 3px;
  background-color: rgb(146, 137, 137);
  margin: 1.5rem auto;
}

section.notice {
  h2 {
    font-size: 2rem;
    padding: 1rem 0;
  }

  ul {
    width: 94%;
    margin: auto;
    padding: 1.25rem 0 2.25rem 0;

    li {
      font-size: 1.25rem;
      margin: 1.25rem 0;
      list-style-type: decimal;
    }
  }
}

section.itinerary {
  h2 {
    font-size: 2rem;
  }

  .stage {
    display: flex;
    align-items: first baseline;
    .stage-left {
      display: flex;
      flex-direction: column;
      font-size: 1.5rem;
      margin-right: 1rem;

      .day2 {
        position: relative;
        top: 175px;
        transition: all 0.3s ease-in-out;
      }
    }

    .icon {
      display: flex;
      flex-direction: column;
      justify-content: space-between;
      transition: all 0.3s ease-in-out;
      i {
        font-size: 1.5rem;
        text-align: center;
        line-height: 40px;
        width: 40px;
        height: 40px;
        background-color: rgb(122, 172, 191);
        border-radius: 50%;
      }
    }

    .stage-list {
      width: 100%;
      .stage-item {
        position: relative;
        border-bottom: 1px solid rgba(146, 137, 137, 0.5);

        margin: 1rem 0;
        padding: 0.5rem 1rem;
        cursor: pointer;
        .item {
          font-size: 1.75rem;
          display: flex;
          align-items: center;
          .symbol {
            display: flex;
            justify-content: center;
            position: relative;
            width: 30px;
            height: 30px;
            margin-left: auto;
            flex-shrink: 0;
            background-color: rgb(122, 172, 191);
            border-radius: 50%;
            span {
              position: absolute;
              display: block;
              width: 60%;
              height: 4px;

              background-color: #fff;
              transition: all 0.3s cubic-bezier(0.68, -0.55, 0.265, 1.55);
              &:nth-child(1) {
                top: 13px;
              }
              &:nth-child(2) {
                top: 13px;
                transform: rotate(90deg);
              }
            }

            &.minus {
              span {
                &:nth-child(2) {
                  transform: rotate(180deg);
                }
              }
            }
          }
        }

        .desc {
          height: 0;
          margin-top: 0.5rem;
          font-size: 1.5rem;

          overflow: hidden;
          transition: all 0.3s ease-in-out;

          &.slide-down {
            height: 150px;
            padding: 0.25rem 0;
          }
        }
      }
    }
  }
}

section.next-step {
  display: flex;
  justify-content: center;
  margin: 6rem 0 3rem 0;

  .btn {
    // display: inline-block;
    width: 200px;
    border-radius: $space;
    margin: 0 2rem;
    cursor: pointer;

    span {
      line-height: 50px;
      height: 50px;
      font-size: 1.5rem;
      color: #fff;
    }
  }
}

@media screen and (max-width: 768px) {
  .container {
    padding: 0 1rem;
  }

  button.swiper-button-prev,
  button.swiper-button-next {
    img {
      width: 40px;
      height: 40px;
    }
  }

  section.notice {
    ul {
      padding: 0.5rem 0;

      li {
        font-size: 1.1rem;
      }
    }
  }

  section.next-step {
    margin: 3rem 0;
  }
}
@media screen and (max-width: 415px) {
  .container {
    padding: 0 1rem;
  }

  .swiper {
    aspect-ratio: 4/3;
  }

  button.swiper-button-prev,
  button.swiper-button-next {
    img {
      width: 30px;
      height: 30px;
    }
  }

  section.notice {
    ul {
      padding: 0.5rem 0;

      li {
        font-size: 1.1rem;
      }
    }
  }

  section.itinerary {
    h2 {
      font-size: 2rem;
    }

    .stage {
      display: flex;
      align-items: first baseline;
      .stage-left {
        display: none;
      }

      .stage-list {
        width: 100%;
        .stage-item {
          position: relative;
          border-bottom: 1px solid rgba(146, 137, 137, 0.5);

          margin: 1rem 0;
          padding: 0.5rem 1rem;
          cursor: pointer;
          .item {
            font-size: 1.5rem;
            display: flex;
            align-items: center;
          }

          .desc {
            font-size: 1.25rem;
          }
        }
      }
    }
  }
  section.next-step {
    margin: 3rem 0;
    .btn {
      span {
        font-size: $sm-font;
        line-height: 20px; /* 142.857% */
        letter-spacing: -0.14px;
        color: #fff;
      }
    }
  }
}
</style>

<template>
  <section class="title">
    <h1 class="h1" v-html="packageDataItem.title"></h1>
  </section>

  <div class="container">
    <swiper
      :navigation="{
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
      }"
      :loop="true"
      :freeMode="false"
      :centeredSlides="true"
      :spaceBetween="30"
      :modules="modules"
      class="mySwiper"
    >
      <template v-if="!stageList"> 沒有資料喔~ </template>
      <template v-else>
        <swiper-slide v-for="(item, index) in swiperImg" :key="index">
          <Images
              :imgURL="`${item.link}`"
              :alt="``"
            />
          <!-- <img :src="item.link" alt="" /> -->

          <!-- <Images :imgURL="`${item.spotImage}`" :alt="``" /> -->
          <!-- <img :src="item.spotImage" alt="" /> -->
        </swiper-slide>
      </template>

      <button class="swiper-button-prev">
        <img :src="prev" alt="" />
      </button>
      <button class="swiper-button-next">
        <img :src="next" alt="" />
      </button>
    </swiper>

    <div class="dash"></div>

    <section class="notice">
      <h2 class="h2">注意事項</h2>
      <ul>
        <li v-for="(item, index) in notice" :key="index">{{ item.text }}</li>
      </ul>
    </section>

    <div class="dash"></div>

    <section class="itinerary">
      <h2 class="h2">行程列表</h2>
      <div class="stage">
        <div class="stage-left">
          <div class="day1">DAY1</div>
          <div class="day2" :style="{ marginTop: marginTop + 'px' }">DAY2</div>
        </div>
        <div class="icon" :style="{ height: 370 + iconMove + 'px' }">
          <i class="fa-solid fa-location-dot"></i>
          <i class="fa-solid fa-flag"></i>
        </div>
        <template v-if="!stageList"> 沒有資料喔~ </template>
        <template v-else>
          <div class="stage-list">
            <div
              class="stage-item"
              @click="toggleClass(index)"
              v-for="(item, index) in stageList"
              :key="index"
            >
              <div class="item">
                {{ `第${item.sort}站：${item.name}` }}
                <div class="symbol" :class="{ minus: item.isActive }">
                  <span></span>
                  <span></span>
                </div>
              </div>
              <div class="desc" :class="{ 'slide-down': item.isActive }">
                {{ item.desc }}
              </div>
            </div>
          </div>
        </template>
      </div>
    </section>

    <section class="next-step">
      <div class="btn secondary">
        <router-link to="/online-booking">
          <span>返回</span>
        </router-link>
      </div>
      <div class="btn primary">
        <router-link :to="`/select-info/${packageDataItem.id}`">
          <span>下一步</span>
        </router-link>
      </div>
    </section>
  </div>
</template>

<script>
import { GET } from "@/plugin/axios";
import { Navigation, FreeMode } from "swiper/modules";

// Import Swiper Vue.js components
import { Swiper, SwiperSlide } from "swiper/vue";

// Import Swiper styles
import "swiper/scss";
import "swiper/scss/navigation";
import "swiper/scss/free-mode";

export default {
  components: {
    Swiper,
    SwiperSlide,
  },

  data() {
    return {
      modules: [Navigation, FreeMode],

      prev: require("@/assets/images/icon/blue-arrow.svg"),
      next: require("@/assets/images/icon/blue-arrow.svg"),

      packageList: [],
      packageDataItem: [],
      stageList: [],

      swiperImg: [
        {
          link: "images/spot/09.jpg",
        },
        {
          link: "images/spot/01.jpg",
        },
        {
          link: "images/spot/03.jpg",
        },
        {
          link: "images/spot/13.jpg",
        },
        {
          link: "images/spot/12.png",
        },
      ],

      notice: [
        {
          text: "請在購票前確認您的旅行日期和目的地，並選擇合適的車次和座位。提前計劃您的行程，以確保您能按時到達車站",
        },
        {
          text: "購票時請提供正確的個人資訊，包括姓名、身份證件號碼等。這些信息將用於核對乘客身份，請確保所提供的信息真實有效",
        },
        {
          text: "請注意車票的有效期限，確保在有效期內使用。過期的車票將無法登車",
        },
        {
          text: "登車前請務必攜帶有效的身份證件，以備查驗。如身份證件遺失或過期，可能會影響您的登車和乘車權益",
        },
        {
          text: "確保在預定的登車時間前到達車站，以免錯過列車。建議提前到達車站30分鐘以上，以完成安全檢查和手續辦理",
        },
        {
          text: "請遵守車站和列車上的秩序規定，尊重工作人員的指示。禁止攜帶易燃、易爆、有毒、危險物品上車，以確保車內的安全",
        },
        {
          text: "在列車上，請勿隨意拋棄垃圾，將垃圾放入指定的垃圾桶內。保持車廂整潔，共同維護良好的環境",
        },
        {
          text: "禁止吸煙或在列車上點燃火源。請尊重他人，注意保持空氣清新",
        },
        {
          text: "請保管好個人財物，隨身攜帶重要物品。如發現任何可疑人物或物品，請立即向列車工作人員報告",
        },
        {
          text: "在列車行駛期間，請保持座位整潔，避免大聲喧嘩或打擾其他乘客",
        },
      ],
    };
  },

  computed: {
    //Day2隨著前三站的isActive狀態改變，marginTop的值也會跟著改變
    marginTop() {
      let count = 0;
      if (this.stageList && this.stageList.length >= 3) {
        //先確定資料有接到
        for (let i = 0; i < 3; i++) {
          if (this.stageList[i].isActive) {
            count++;
          }
        }
        return count * 150;
      }
    },
    //旗子icon隨著前四站的isActive狀態改變，height值也會跟著改變
    iconMove() {
      let count = 0;
      if (this.stageList && this.stageList.length >= 3) {
        //先確定資料有接到
        for (let i = 0; i < 4; i++) {
          if (this.stageList[i].isActive) {
            count++;
          }
        }
        return count * 150;
      }
    },
  },
  methods: {
    toggleClass(index) {
      this.stageList[index].isActive = !this.stageList[index].isActive;
    },
  },
  created() {
    // 取得API
    GET("/data/packageData.json").then((res) => {
      this.packageList = res;
      this.packageDataItem =
        this.packageList[`${parseFloat(this.$route.params.id) - 1}`];
      this.stageList = this.packageDataItem.stageList;
    });
  },
};
</script>

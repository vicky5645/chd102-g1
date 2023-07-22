<style lang="scss" scoped>
* {
  box-sizing: border-box;
}
.container {
  width: 1200px;
  margin: auto;
}

section.title {
  text-align: center;
  padding: 1.5rem 0;
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

swiper-container.mySwiper {
  max-width: 1200px;
  margin: auto;
  swiper-slide {
    img {
      margin: 0 auto;
      display: block;
      width: 992px;
      aspect-ratio: 992/740;
      object-fit: cover;
    }
  }
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
    padding: 1.25rem 0 2.5rem 0;

    li {
      font-size: 1.25rem;
      margin: 1rem 0;
      list-style-type: decimal;
      position: relative;
      left: 1.75rem;
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

    .stage-list {
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
    display: inline-block;
    width: 200px;
    border-radius: 7.5px;
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
</style>

<template>
  <section class="title">
    <h1>星空探索</h1>
    <p>在星光的指引下，踏上光芒閃耀的旅程，展開無垠的探索之旅</p>
  </section>

  <div class="container">
    <swiper-container
      class="mySwiper"
      navigation="{
      true
    }"
      loop="true"
      css-mode="true"
    >
      <swiper-slide v-for="(item, index) in swiperImg" :key="index">
        <img :src="item.link" alt="" />
      </swiper-slide>
      <!-- 
    <button class="swiper-button-prev"></button>
    <button class="swiper-button-next"></button> -->
    </swiper-container>

    <div class="dash"></div>

    <section class="notice">
      <h2>注意事項</h2>
      <ul>
        <li v-for="(item, index) in notice" :key="index">{{ item.text }}</li>
      </ul>
    </section>

    <div class="dash"></div>

    <section class="itinerary">
      <h2>行程列表</h2>
      <div class="stage">
        <div class="stage-left">
          <div class="day1">DAY1</div>
          <div class="day2" :style="{ marginTop: marginTop + 'px' }">DAY2</div>
        </div>
        <div class="stage-list">
          <div
            class="stage-item"
            @click="toggleClass(index)"
            v-for="(item, index) in stageList"
            :key="index"
          >
            <div class="item">
              {{ item.name }}
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
      </div>
    </section>

    <section class="next-step">
      <div class="btn secondary">
        <router-link to="/online-booking">
          <span>返回</span>
        </router-link>
      </div>

      <div class="btn primary">
        <router-link to="/">
          <span>確認購票</span>
        </router-link>
      </div>
    </section>
  </div>
</template>

<script>
export default {
  data() {
    return {
      swiperImg: [
        {
          link: require("@/assets/images/spot/03.jpg"),
        },
        {
          link: require("@/assets/images/spot/13.jpg"),
        },
        {
          link: require("@/assets/images/spot/09.jpg"),
        },
        {
          link: require("@/assets/images/spot/11.jpg"),
        },
        {
          link: require("@/assets/images/spot/12.png"),
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

      stageList: [
        {
          name: "第一站：綠野牧場",
          desc: "綠野牧場是一個讓您放鬆心靈、與自然和諧共處的絕佳地點。來到這裡,您將找到內心的寧靜和平靜,與家人和朋友創造美好的回憶。綠野牧場期待著與您分享這個特別的農場體驗,讓您在這片綠意盎然的土地上感受到原野自然的美好。",
          isActive: false,
        },
        {
          name: "第二站：景觀公園",
          desc: "景觀公園是一個令人著迷的地方，充滿著幻想與神奇。這裡的樹林擁有著美麗的秋天景色，萬紅橙黃的楓葉在微風中輕輕飄落。漫步在景觀公園彷彿置身於一個夢幻般的童話故事中。這裡的寧靜與宁靜讓您的心靈得到放鬆和平靜，同時享受著大自然所賦予的美妙。",
          isActive: false,
        },
        {
          name: "第三站：銀月山脈",
          desc: "在銀月山脈的脈動中，您將發現一個神秘而令人著迷的地方。這座山脈綿延起伏，山巒疊翠，彷彿置身於一幅宏偉的山水畫中。銀月山脈以其壯麗的景色和原始的自然美景而聞名，而當夜幕降臨時，更有極光的奇景為您帶來驚喜。",
          isActive: false,
        },
        {
          name: "第四站：歷史遺跡",
          desc: "高原遺跡，是一個充滿歷史色彩的神秘之地。隱藏在高山脊梁上的古老遺址，它見證了遠古時代的文明興衰和人類智慧的薪火相傳。這片遺跡位於雄偉壯麗的高原地帶，被廣闊的草原和壯麗的山脈所環繞。當您踏足在這片土地上時，仿佛回到了古代文明的繁華時期。遺跡中的古建築、石碑、雕像和壁畫，展現出當時人們的智慧和藝術才華。您可以仔細觀察著古老的建築結構，感受著歷史的洪流在這裡流轉。",
          isActive: false,
        },
        {
          name: "第五站：海底餐廳",
          desc: "這個根基位於海底的餐廳猶如一座透明的水晶殿堂,四周被璀璨的海底生物和色彩繽紛的珊瑚所環繞。當您坐在餐桌旁,透過透明的落地窗欣賞著游動的熱帶魚群和優雅的海龜,仿佛置身於一個夢幻般的海底世界。來到海底餐廳,讓我們引領您進入一個夢幻般的海洋世界。在這裡,美食與自然交融,讓您的味蕾和心靈同時沉浸在無盡的驚奇和美好中。",
          isActive: false,
        },
      ],
    };
  },

  computed: {
    marginTop() {
      let count = 0;
      for (let i = 0; i < 3; i++) {
        if (this.stageList[i].isActive) {
          count++;
        }
      }
      return count * 150;
    },
  },

  methods: {
    toggleClass(index) {
      this.stageList[index].isActive = !this.stageList[index].isActive;
    },
  },
};
</script>

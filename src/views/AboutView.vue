<template>
  <div class="intorBanner">
    <div class="introTag">
      <h2 class="h2">行程介紹</h2>
      <p>漫遊列車之旅，讓您在旅行中找回純真的快樂_</p>
    </div>
    <div class="introWrapper">
      <div class="container">
        <div class="introTxt">
          <div class="introCard">
            <h3 class="h3">銀月山脈的浪漫之旅</h3>
            <p>
              在銀光閃爍的月夜中，我們將帶您從綠野牧場出發，經過景觀公園，最終到達神秘的銀月山脈，讓您在浪漫之旅中享受自然的獨特魅力。
            </p>
            <div class="moreInfo">
              <router-link to="/itinerary-intro">查看更多</router-link>
              <router-link to="/itinerary-intro">
                <img src="#" alt="" />
              </router-link>
            </div>
          </div>
          <div class="introCard">
            <h3 class="h3">湖光山色的奇幻之旅</h3>
            <p>
              從幽谷湖泊出發，穿越壯觀的亞瑟山口，最後抵達紅葉村，我們將帶您體驗湖光山色中的奇幻之旅，感受大自然的絢爛多彩。
            </p>
            <div class="moreInfo">
              <router-link to="/itinerary-intro">查看更多</router-link>
              <router-link to="/itinerary-intro">
                <img src="#" alt="" />
              </router-link>
            </div>
          </div>
          <div class="introCard">
            <h3 class="h3">海底餐廳的冒險之旅</h3>
            <p>
              從生機勃勃的景觀公園出發，經過翠嶺溫泉鄉，到達神秘的海底餐廳，帶您進行一場驚險刺激的冒險之旅，讓您深入探索自然之美。
            </p>
            <div class="moreInfo">
              <router-link to="/itinerary-intro">查看更多</router-link>
              <router-link to="/itinerary-intro">
                <img src="#" alt="" />
              </router-link>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="attractions">
    <div class="introTag">
      <h2 class="h2">熱門景點</h2>
      <p>在湖光山色中， 讓蒸汽火車帶你進入另一個世界_</p>
    </div>
    <div class="container">
      <div class="introWrapper">
        <div class="attractionsSwitch">
          <div
            class="attractionsTag"
            @click="changeBackground(require('@/assets/images/about/ac01.png'))"
          >
            <h3 class="h3">銀月山脈</h3>
            <p>
              「在銀色的月光下，銀月山脈的山峰如同夢境一般美麗，帶您走進如詩如畫的世界。」
            </p>
          </div>
          <div
            class="attractionsTag"
            @click="changeBackground(require('@/assets/images/about/ac02.png'))"
          >
            <h3 class="h3">幽谷湖泊</h3>
            <p>
              「幽谷湖泊的寧靜美麗如同鏡子般反映著天空，讓您在其中找到心靈的寧靜與安慰。」
            </p>
          </div>
          <div
            class="attractionsTag"
            @click="changeBackground(require('@/assets/images/about/ac03.png'))"
          >
            <h3 class="h3">綠野牧場</h3>
            <p>
              「在綠野牧場上，感受自然的和諧與寧靜，享受陽光下的悠閒時光。」
            </p>
          </div>
          <div
            class="attractionsTag"
            @click="changeBackground(require('@/assets/images/about/ac04.png'))"
          >
            <h3 class="h3">翠嶺溫泉鄉</h3>
            <p>
              「翠嶺溫泉鄉的熱泉如同大自然的禮物，帶給您身心的舒適與放鬆。」
            </p>
          </div>
          <div class="moreAttractioins">
            <router-link to="/Attractions"> 查看更多景點 </router-link>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="trainIntro">
    <div class="introTag">
      <h2 class="h2">列車介紹</h2>
      <p>沿著鐵軌旅行，與蒸汽火車共度時光__</p>
    </div>
    <div class="container">
      <div class="trainTag">
        <h3 class="h3">湖泊號</h3>
        <p>
          湖泊號的設計靈感來自幽谷湖泊的寧靜與美麗。其外觀以天藍色為主，象徵湖泊的清澈，並配有白色的裝飾線條，象徵湖泊周邊的雪山。車廂內部，每個單人座位均為藍色革質，並配有白色的桌板和閱讀燈，確保您在長途旅行中也能享受到舒適。車窗特別使用反射膜，不僅可以防止太陽直射，也能讓您清晰看見窗外美麗的風景。
        </p>
        <router-link to="/train-intro">查看更多</router-link>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      value: "1",
    };
  },
  methods: {
    changeBackground(url) {
      const attractions = document.querySelector(".attractions");
      attractions.style.backgroundImage = `url(${url})`;
    },
  },
};
</script>

<style lang="scss" scoped>
* {
  margin: 0;
  padding: 0;
}

.container {
  max-width: 1200px;
  margin-right: auto;
  margin-left: auto;
  position: relative;

  &:has(.trainTag) {
    height: 100%;
  }
}

/* intro */

.intorBanner {
  background-image: url(../assets/images/about/3913622_m.jpg);
  background-repeat: no-repeat;
  background-attachment: fixed;
  background-position: center;
  background-size: cover;
  position: relative;

  .introTag {
    background-color: white;
    opacity: 0.8;
    display: flex;
    flex-direction: column;
    align-items: flex-end;
    position: absolute;
    right: 0;
    top: 40px;

    h2 {
      // font-size: 48px;
      padding: 8px 16px;
    }

    p {
      font-size: 24px;
      padding: 8px 16px;
    }
  }

  .introTxt {
    height: 100vh;
    display: flex;
    justify-content: space-between;
    color: white;
    font-weight: bold;

    .introCard {
      background-color: rgba($color: #898989, $alpha: 0.6);
      margin-top: auto;
      width: 33.333333%;
      padding-bottom: 40px;

      h3 {
        // font-size: 28px;
        padding: 8px 16px;
        opacity: 1;
      }

      p {
        font-size: 18px;
        padding: 8px 16px;
        line-height: 2rem;
      }

      .moreInfo {
        a {
          display: block;
          text-align: right;
          padding: 0px 16px;
          font-size: 20px;
          color: #7aacbf;
          text-decoration: none;
          &:hover {
            color: white;
          }
        }
      }
    }
  }
}

.attractions {
  background-image: url(../assets/images/about/ac01.png);
  background-repeat: no-repeat;
  background-attachment: fixed;
  background-position: center;
  background-size: cover;
  position: relative;
  height: 1200px;

  .introTag {
    background-color: white;
    opacity: 0.8;
    display: flex;
    flex-direction: column;
    align-items: flex-end;
    position: absolute;
    right: 0;
    top: 40px;
    display: flex;
    flex-direction: column;
    align-items: flex-end;
    position: absolute;
    right: 0;
    top: 40px;

    h2 {
      // font-size: 48px;
      padding: 8px 16px;
    }

    p {
      font-size: 24px;
      padding: 8px 16px;
    }
  }

  .attractionsSwitch {
    position: absolute;
    top: 320px;
    right: 0;

    .attractionsTag {
      background-color: white;
      opacity: 0.8;
      padding: 40px 0px;
      border-bottom: 1px solid;
      cursor: pointer;

      h3 {
        // font-size: 28px;
        padding: 8px 16px;
      }

      p {
        font-size: 18px;
        padding: 8px 16px;
        line-height: 2rem;
      }
    }

    .moreAttractioins {
      a {
        display: block;
        text-align: right;
        padding: 16px;
        font-size: 28px;
        color: white;
        text-decoration: none;
        &:hover {
          color: #7aacbf;
        }
      }
    }
  }
}

.trainIntro {
  background-image: url(../assets/images/about/1243439_m.jpg);
  background-repeat: no-repeat;
  background-attachment: fixed;
  background-position: center;
  background-size: cover;
  position: relative;
  height: 100vh;

  .introTag {
    background-color: white;
    opacity: 0.8;
    display: flex;
    flex-direction: column;
    align-items: flex-end;
    position: absolute;
    right: 0;
    top: 40px;
    display: flex;
    flex-direction: column;
    align-items: flex-end;
    position: absolute;
    right: 0;
    top: 40px;

    h2 {
      // font-size: 48px;
      padding: 8px 16px;
    }

    p {
      font-size: 24px;
      padding: 8px 16px;
    }
  }

  .trainTag {
    position: absolute;
    left: 0;
    bottom: 80px;
    background-color: #fff;
    opacity: 0.8;
    width: 65%;

    h3 {
      margin-top: 8px;
      // font-size: 28px;
      padding: 8px 16px;
    }

    p {
      font-size: 18px;
      padding: 8px 16px;
      line-height: 2rem;
    }

    a {
      display: block;
      text-align: right;
      padding: 0px 32px;
      font-size: 20px;
      color: #7aacbf;
      text-decoration: none;
      font-size: 28px;
      font-weight: bold;
      margin-bottom: 8px;
      &:hover {
        color: rgb(78, 78, 78);
      }
    }
  }
}

@media (max-width: 768px) {
  .introTxt {
    .introCard {
      padding-bottom: 0px;
      width: 100%;
    }
  }
}
</style>

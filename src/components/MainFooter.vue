<template>
  <footer id="mainFooter">
    <div class="mainFooter-top-wrap">
      <router-link
        to="/Attractions"
        class="pic"
        @mouseover="showTooltip"
        @mouseout="hideTooltip"
      >
        <div class="map">
          <img src="../../public/images/footer/footer_map.png" alt="網站地圖" />
        </div>
        <div v-if="tooltipVisible" class="tooltip-modal">網站地圖</div>
      </router-link>
      <div class="txt">
        名稱｜軌道漫遊股份有限公司・地址｜桃園市陽明山鐵路932號・電話｜03-314-8763
      </div>
    </div>
    <div class="mainFooter-under-wrap">
      <p>
        本網站為緯育TibaMe_前端設計工程師班第83期學員專題成果作品,本平台僅供學
        習、展示之用。若有抵觸有關著作權,或有第三人主張侵害智慧財產權等情事,均
        由學員負法律上責任,緯育公司概不負責。 若有侵權疑慮,您可以私訊<a
          href="https://www.facebook.com/TibaMe"
        >
          ☎ 緯育 TibaMe ☎ </a
        >,後續會由專人協助處理。
      </p>
    </div>
  </footer>
</template>

<script>
export default {
  data() {
    return {
      tooltipVisible: false,
    };
  },
  methods: {
    showTooltip() {
      this.tooltipVisible = true;
    },
    hideTooltip() {
      this.tooltipVisible = false;
    },
  },
};
</script>

<style lang="scss" scoped>
footer {
  .mainFooter-top-wrap {
    text-align: center;

    .pic {
      margin: 20px auto;
      display: inline-block;
      animation: bounce 2s ease infinite, pause 5s infinite;
      position: relative;

      .map {
        width: 80px;
        height: 80px;
        img {
          width: 100%;
          height: 100%;
          object-fit: cover;
        }
      }
    }
    .tooltip-modal {
      // display: none;
      position: absolute;
      right: 100%; /* 定位到 .pic 的頂部 */
      top: 50%; /* 從 .pic 的左側中央開始 */
      transform: translateY(-50%); /* 中心對齊 */
      padding: 8px;
      color: #012840;
      background-color: rgba(255, 255, 255, 0.8);
      border: 1px solid rgba(156, 163, 175, 0.5607843137);
      border-radius: 8px;
      box-shadow: 0px 1px 6px 0px rgba(122, 172, 191, 0.2);
      white-space: nowrap; /* 防止文字換行 */
      margin-right: 8px; /* 為彈窗下方提供一些間距 */
      z-index: 999;
    }
    .txt {
      color: #ffffffcb;
      font: 14px;
      margin-bottom: 20px;
      font-weight: 300;
      padding: 0 20px;
    }
  }

  // .mainFooter-under-wrap {
  //   p {
  //     a {
  //     }
  //   }
  // }
}
@keyframes bounce {
  0%,
  20%,
  50%,
  100% {
    transform: translateY(0);
  }

  10% {
    transform: translateY(-14px);
  }

  40% {
    transform: translateY(-8px);
  }
}

@keyframes pause {
  0%,
  40% {
    opacity: 1;
  }
  41%,
  100% {
    opacity: 1;
  }
}
</style>

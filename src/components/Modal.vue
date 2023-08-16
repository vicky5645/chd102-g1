<style lang="scss" scoped>
@import "@/assets/scss/style.scss";

* {
  box-sizing: border-box;
}

.modal {
  position: fixed;
  top: 0;
  left: 0;
  width: 100vw;
  height: 100vh;

  z-index: 111;

  .background_close {
    background-color: rgba(0, 0, 0, 0.6);
    position: absolute;
    width: 100vw;
    height: 100vh;
    top: 0;
    left: 0;
    z-index: 20;

    .close_x {
      display: flex;
      justify-content: center;
      align-items: center;
      position: fixed;
      right: 5%;
      top: 6%;
      border: none;
      color: white;
      font-size: 70px;
      background-color: transparent;
      width: 100px;
      height: 100px;
      z-index: 120;
    }
  }

  .scenery {
    width: 62.5vw;
    height: 90vh;
    // margin: auto;
    position: fixed;
    top: calc(50% + 30px);
    left: 50%;
    transform: translate(-50%, -50%);
    overflow: auto;
    background-color: map-get($GrayColors, Gray6);
    z-index: 50;

    h1 {
      font-size: $h1;
      text-align: center;
    }

    section.wrap {
      width: 85%;
      margin: auto;

      .mySwiper {
        height: 45vh;
        margin: auto;

        .swiper-slide {
          width: 100%;

          // height: 45vh;
          img {
            object-fit: cover;
            width: 100%;
            height: 100%;
          }
        }
      }

      button.swiper-button-prev,
      button.swiper-button-next {
        background-color: transparent;
        border: none;
        img {
          width: 36px;
          height: 36px;
        }

        &::after {
          content: "";
        }
      }

      button.swiper-button-next {
        transform: rotate(180deg);
      }

      .content {
        display: flex;
        width: 100%;
        align-items: center;
        margin: 1.5rem 0;

        .pic {
          width: 50%;
          height: 16.4895vw;
          margin-right: auto;
          padding-right: 1rem;
          overflow: hidden;

          img {
            width: 100%;
            height: 100%;
            object-fit: cover;
          }
        }

        .desc {
          text-indent: 1.5rem;
          width: 45%;
          font-size: $fontSize;
          font-weight: bold;
        }

        &:nth-child(3) {
          flex-direction: row-reverse;

          .pic {
            margin: 0 0 0 auto;
            padding-left: 1rem;
          }
        }
      }
    }
  }
}

@media screen and (max-width: 1081px) {
  .modal .scenery section.wrap .content .pic {
    height: 25.4895vw;
  }
}

@media screen and (max-width: 768px) {
  .content {
    .desc {
      font-size: 16px !important;
    }
  }

  .close_x {
    top: 55px !important;
    right: 0px !important;
    font-size: 60px !important;
    z-index: 50;
  }

  .modal .scenery section.wrap .mySwiper {
    height: auto;
  }

  .modal .scenery section.wrap .content {
    display: block;
  }

  .modal .scenery section.wrap .content .pic {
    width: 100%;
    height: 35.4895vw;
  }

  .modal .scenery section.wrap .content .desc {
    width: 100%;
  }
}
</style>

<template>
  <div class="modal">
    <div class="background_close">
      <button class="close_x">X</button>
    </div>
    <div class="scenery" v-if="attr_all_data[attraction.attr_id]">
      <h1>{{ attr_all_data[attraction.attr_id].name }}</h1>
      <section class="wrap">
        <swiper
          :navigation="{
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
          }"
          :loop="true"
          :modules="modules"
          class="mySwiper"
        >
          <swiper-slide
            ><img
              :src="attr_all_data[attraction.attr_id].slide1"
              alt="" /></swiper-slide
          ><swiper-slide
            ><img :src="attr_all_data[attraction.attr_id].slide2" alt=""
          /></swiper-slide>
          <swiper-slide
            ><img :src="attr_all_data[attraction.attr_id].slide3" alt=""
          /></swiper-slide>
          <button class="swiper-button-prev">
            <img :src="prev" alt="" />
          </button>
          <button class="swiper-button-next">
            <img :src="next" alt="" />
          </button>
        </swiper>
        <div class="content">
          <div class="pic">
            <img :src="attr_all_data[attraction.attr_id].pic1" alt="" />
          </div>
          <div class="desc">{{ attr_all_data[attraction.attr_id].desc1 }}</div>
        </div>
        <div class="content">
          <div class="pic">
            <img :src="attr_all_data[attraction.attr_id].pic2" alt="" />
          </div>
          <div class="desc">{{ attr_all_data[attraction.attr_id].desc2 }}</div>
        </div>
      </section>
    </div>
  </div>
</template>

<script>
import { Navigation } from "swiper/modules";

// Import Swiper Vue.js components
import { Swiper, SwiperSlide } from "swiper/vue";

// Import Swiper styles
import "swiper/css";
import "swiper/css/navigation";
import { GET } from "@/plugin/axios";
import { mapGetters, mapActions, mapMutations, mapState } from "vuex";

export default {
  components: {
    Swiper,
    SwiperSlide,
  },

  data() {
    return {
      modules: [Navigation],
      prev: require("@/assets/images/icon/blue-arrow.svg"),
      next: require("@/assets/images/icon/blue-arrow.svg"),
      attr_all_data: [],
    };
  },

  methods: {},
  computed: {
    ...mapState(["attraction"]),
  },
  mounted() {},
  created() {
    GET("data/attr_detail_data.json").then((res) => {
      this.attr_all_data = res;
      // this.airticlesItem = this.airticles[`${parseFloat(this.$route.params.id) - 1}`];
    });
  },
};
</script>

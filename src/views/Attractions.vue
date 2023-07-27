<!-- 景點介紹 -->
<template>
  <main class="Attractions">
    <div class="Attr_wrap">
      <div class="map">
        <img :src="main_pic.map" alt="map" />
        <div class="train">
          <svg width="51" height="21" viewBox="0 0 51 21" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path
              d="M31 10.0005C31 15.5233 35.4772 20.0005 41 20.0005C46.5228 20.0005 51 15.5233 51 10.0005C51 4.47764 46.5228 0.000488281 41 0.000488281C35.4772 0.000488281 31 4.47764 31 10.0005Z"
              fill="#744C3B" />
            <path
              d="M3 16.5005L3 3.50049C3 3.22435 2.77614 3.00049 2.5 3.00049H0.5C0.223858 3.00049 0 3.22435 0 3.50049L0 16.5005C0 16.7766 0.223858 17.0005 0.5 17.0005H2.5C2.77614 17.0005 3 16.7766 3 16.5005Z"
              fill="#744C3B" />
            <path
              d="M3.1028 20.1626L34 20.1626C34.5523 20.1626 35 19.7149 35 19.1626V0.999798C35 0.447514 34.5523 -0.000202179 34 -0.000202179L3.1028 -0.000202179C2.55051 -0.000202179 2.1028 0.447514 2.1028 0.999798V19.1626C2.1028 19.7149 2.55051 20.1626 3.1028 20.1626Z"
              fill="#CF501F" />
            <path
              d="M32 16.0005V4.00049C32 3.44821 31.5523 3.00049 31 3.00049L6 3.00049C5.4477 3.00049 5 3.44821 5 4.00049V16.0005C5 16.5528 5.4477 17.0005 6 17.0005H31C31.5523 17.0005 32 16.5528 32 16.0005Z"
              stroke="#744C3B" stroke-width="1.5" />
            <path
              d="M38 10.0005C38 12.2096 39.7909 14.0005 42 14.0005C44.2091 14.0005 46 12.2096 46 10.0005C46 7.79135 44.2091 6.00049 42 6.00049C39.7909 6.00049 38 7.79135 38 10.0005Z"
              fill="#CF501F" />
            <path
              d="M40 10.0005C40 11.1051 40.8954 12.0005 42 12.0005C43.1046 12.0005 44 11.1051 44 10.0005C44 8.89592 43.1046 8.00049 42 8.00049C40.8954 8.00049 40 8.89592 40 10.0005Z"
              fill="#744C3B" />
          </svg>
        </div>
        <div class="train_line">
          <svg width="701" height="455" viewBox="0 0 701 455" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path id="tran_line_path"
              d="M0.999023 226.5C0.999023 80.5 221.999 1 352.499 1C492.999 1 700.498 62 700.498 227.5C700.498 384.5 474.5 454.5 352.499 454.5C230.498 454.5 0.999023 416 0.999023 226.5Z"
              stroke="black" />
          </svg>
        </div>
        <div :class="key_name" v-for="(item, key_name, index) in pic" :key="index">
          <img :src="item" :alt="key_name">
        </div>



      </div>

      <!-- <button :class='item.name' v-for="(item, index) in view_button" :key="index">
        <img :src="item.icon" alt="">
      </button> -->
    </div>

  </main>
</template>

<script>
import { gsap } from "gsap";
import { MotionPathPlugin } from "gsap/MotionPathPlugin";


export default {
  components: {},
  data() {
    return {
      main_pic: {
        map: require("../assets/images/img/Attractions/map.png"),
        train: require("../assets/images/img/Attractions/train.svg"),
        trainLine: require("../assets/images/img/Attractions/trainLine.svg"),
      },
      pic: {
        lake: require("../assets/images/img/Attractions/lake.png"),
        mapleleaf: require("../assets/images/img/Attractions/mapleleaf.png"),
        mountain: require("../assets/images/img/Attractions/mountain.png"),
        pasture: require("../assets/images/img/Attractions/pasture.png"),
        remains: require("../assets/images/img/Attractions/remains.png"),
        restaurant: require("../assets/images/img/Attractions/restaurant.png"),
      },
      view_button:
        [
          {
            name: 'right_button'
            , icon: require('@/assets/images/img/Attractions/attr_right_icon.png')
          },
          {
            name: 'left_button',
            icon: require('@/assets/images/img/Attractions/attr_left_icon.png')
          },
        ]
    };
  },
  methods: {
    train_move_ani() {
      gsap.to(".train", {
        duration: 25,
        repeat: -1,
        repeatDelay: 0,
        ease: "Power1.easeOut",
        motionPath: {
          start: 1.6,
          end: 0.6,
          path: "#tran_line_path",
          align: "#tran_line_path",
          autoRotate: true,
          alignOrigin: [0.5, 0.5]
        }
      });
    },


  },
  mounted() {
    gsap.registerPlugin(MotionPathPlugin);
    this.train_move_ani();

  }
}
</script>

<template>  
  <div class="login-bg">



      <main class="user-control-content">
        <router-view></router-view>
      </main>
      <div class="box">
        <svg
          version="1.1"
          id="bg"
          xmlns="http://www.w3.org/2000/svg"
          x="0px"
          y="0px"
          viewBox="0 0 750 500"
          style="enable-background: new 0 0 750 500"
          xml:space="preserve"
        >
          <linearGradient
            id="SVGID_1_"
            gradientUnits="userSpaceOnUse"
            x1="749.8101"
            y1="3.6109"
            x2="-3.3902"
            y2="498.7425"
          >
            <stop
              offset="0.3227"
              :style="{ 'stop-color': gradientColors[0] }"
            />
            <stop
              offset="0.4171"
              :style="{ 'stop-color': gradientColors[1] }"
            />
            <stop
              offset="0.5707"
              :style="{ 'stop-color': gradientColors[2] }"
            />
            <stop
              offset="0.7643"
              :style="{ 'stop-color': gradientColors[3] }"
            />
            <stop
              offset="0.9587"
              :style="{ 'stop-color': gradientColors[4] }"
            />
          </linearGradient>
          <rect
            y="0"
            class="st0"
            width="750"
            height="500"
            fill="url(#SVGID_1_)"
          />
          <template v-for="star in stars" :key="star.id">
            <polygon :class="'star' + star.id" :points="star.points" />
          </template>
        </svg>
      </div>
  </div>
</template>

<script>
export default {
  name: "Login",
  data() {
    return {
      gradientColors: ["#000000", "#000000", "#000000", "#000000", "#000000"],
      stars: [
        {
          id: 1,
          points:
            "698.7,57.6 697,57.3 696.3,55.8 695.5,57.3 693.8,57.6 695.1,58.8 694.8,60.5 696.3,59.7 697.8,60.5 697.5,58.8",
        },
        {
          id: 2,
          points:
            "177.2,70.3 175.5,70.1 174.7,68.5 174,70.1 172.3,70.3 173.5,71.5 173.2,73.2 174.7,72.4 176.2,73.2 175.9,71.5",
        },
        {
          id: 3,
          points:
            "440.5,31.9 438.8,31.7 438.1,30.2 437.3,31.7 435.6,31.9 436.8,33.1 436.6,34.8 438.1,34 439.6,34.8 439.3,33.1",
        },
        {
          id: 4,
          points:
            "299.3,34.3 297.6,34 296.9,32.5 296.1,34 294.4,34.3 295.6,35.5 295.4,37.1 296.9,36.3 298.4,37.1 298.1,35.5",
        },
        {
          id: 5,
          points:
            "86.3,59.9 84.6,59.7 83.9,58.1 83.1,59.7 81.4,59.9 82.6,61.1 82.3,62.8 83.9,62 85.4,62.8 85.1,61.1",
        },
        {
          id: 6,
          points:
            "45.6,20.5 43.9,20.2 43.2,18.7 42.4,20.2 40.7,20.5 41.9,21.7 41.6,23.3 43.2,22.5 44.7,23.3 44.4,21.7",
        },
        {
          id: 7,
          points:
            "586.6,49.8 584.9,49.5 584.2,48 583.4,49.5 581.7,49.8 582.9,50.9 582.7,52.6 584.2,51.8 585.7,52.6 585.4,50.9",
        },
        {
          id: 8,
          points:
            "157.4,132 155.8,131.8 155,130.3 154.2,131.8 152.6,132 153.8,133.2 153.5,134.9 155,134.1 156.5,134.9 156.2,133.2",
        },
        {
          id: 9,
          points:
            "45.6,115.5 43.9,115.3 43.2,113.8 42.4,115.3 40.7,115.5 41.9,116.7 41.6,118.4 43.2,117.6 44.7,118.4 44.4,116.7",
        },
        {
          id: 10,
          points:
            "629.5,142 627.8,141.7 627.1,140.2 626.3,141.7 624.6,142 625.8,143.2 625.5,144.9 627.1,144.1 628.6,144.9 628.3,143.2",
        },
        {
          id: 11,
          points:
            "683.1,152.4 681.4,152.1 680.7,150.6 679.9,152.1 678.2,152.4 679.4,153.5 679.2,155.2 680.7,154.4 682.2,155.2 681.9,153.5",
        },
        {
          id: 12,
          points:
            "563.7,182.7 562,182.5 561.3,181 560.5,182.5 558.8,182.7 560,183.9 559.8,185.6 561.3,184.8 562.8,185.6 562.5,183.9",
        },
      ],
    };
  },
  mounted() {},
};
</script>

<style lang="scss" scoped>
polygon {
  fill: #fff;
}
@for $i from 1 through 12 {
  .star#{$i} {
    -webkit-animation: blink-1 #{$i * 0.2 + 0.4}s infinite both;
    animation: blink-1 #{$i * 0.2 + 0.4}s infinite both;
  }
}
// 登入背景----------------------------------
.login-bg {
  margin: 0;
  // padding: 0;
  padding-top: 50px;
  background-size: 100%;
  background-position: center;
  position: relative;
  background-image: url('/public/images/travel/loginBgCut.png');
  background-position:  center 40px;
  background-repeat: no-repeat;
  background-size: cover;
  

    main {
      z-index: 99;
    }
    .box {
      #bg {
        z-index: -1;
      }
      svg {
        width: 100%;
        object-fit: cover;
        position: absolute;
        top: 0;
        left: 0;
      }
   }
}

@-webkit-keyframes blink-1 {
  0%,
  50%,
  100% {
    opacity: 1;
  }

  25%,
  75% {
    opacity: 0;
  }
}

@keyframes blink-1 {
  0%,
  50%,
  100% {
    opacity: 1;
  }

  25%,
  75% {
    opacity: 0;
  }
}

@media (max-width: 1024px) {
  .login-contianer {
    top: 1px;
  }

  .bg_top {
    height: 75px;
    background-repeat: no-repeat;
  }

  .form-cc {
    padding: 5px;
  }

  .form-control {
    font-size: 13px;
    padding-top: 10px;
    padding-bottom: 10px;
    height: 16px;
    margin-top: 4px;
  }

  .form-group {
    margin-bottom: 5px;
  }

  .submitbtn {
    font-size: 9px;
    padding: 5px;
    margin-bottom: 0px;
    margin-top: 2px;
  }

  .mt40 {
    margin-top: 0px;
  }

  .anchr {
    font-size: 11px;
    margin-top: 10px;
  }

  .userloginheading {
    padding: 0px;
    margin-bottom: 10px;
    font-size: 10px;
  }

  .welcome {
    font-size: 12px;
  }

  .subtext {
    font-size: 13px;
  }
}

@media (max-width: 600px) {
  .login-contianer {
    top: 1px;
    width: 60%;
  }

  .bg_top {
    height: 245px;
    background-repeat: no-repeat;
  }

  .form-cc {
    padding: 5px;
  }

  .form-control {
    font-size: 8px;
    padding-top: 6px;
    padding-bottom: 7px;
    height: 16px;
    margin-top: 0px;
  }

  .form-group {
    margin-bottom: 5px;
  }

  .submitbtn {
    font-size: 5px;
    padding: 3px;
    margin-bottom: 0px;
    margin-top: -10px;
  }

  .mt40 {
    margin-top: 0px;
  }

  .anchr {
    font-size: 6px;
    margin-top: -5px;
  }

  .userloginheading {
    padding: 0px;
    margin-bottom: 10px;
    font-size: 5px;
  }

  .welcome {
    font-size: 4px;
  }

  .subtext {
    font-size: 5px;
  }
}

@media (max-width: 320px) {
  .login-contianer {
    top: 1px;
  }

  .bg_top {
    height: 95px;
    background-repeat: no-repeat;
  }

  .form-cc {
    padding: 5px;
  }

  .form-control {
    font-size: 8px;
    padding-top: 6px;
    padding-bottom: 7px;
    height: 16px;
    margin-top: 0px;
  }

  .form-group {
    margin-bottom: 5px;
  }

  .submitbtn {
    font-size: 5px;
    padding: 3px;
    margin-bottom: 0px;
    margin-top: -10px;
  }

  .mt40 {
    margin-top: 0px;
  }

  .anchr {
    font-size: 6px;
    margin-top: -5px;
  }

  .userloginheading {
    padding: 0px;
    margin-bottom: 10px;
    font-size: 5px;
  }

  .welcome {
    font-size: 4px;
  }

  .subtext {
    font-size: 5px;
  }
}

@media (max-width: 480px) {
  .login-contianer {
    top: 1px;
    width: 55%;
  }

  .bg_top {
    height: 245px;
    background-repeat: no-repeat;
  }

  .form-cc {
    padding: 5px;
  }

  .form-control {
    font-size: 8px;
    padding-top: 6px;
    padding-bottom: 7px;
    height: 16px;
    margin-top: 0px;
  }

  .form-group {
    margin-bottom: 5px;
  }

  .submitbtn {
    font-size: 5px;
    padding: 3px;
    margin-bottom: 0px;
    margin-top: -10px;
  }

  .mt40 {
    margin-top: 0px;
  }

  .anchr {
    font-size: 6px;
    margin-top: -5px;
  }

  .userloginheading {
    padding: 0px;
    margin-bottom: 10px;
    font-size: 5px;
  }

  .welcome {
    font-size: 4px;
  }

  .subtext {
    font-size: 5px;
  }
}
</style>

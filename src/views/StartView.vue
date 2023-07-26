<template>
  <main class="start_view">
    <!-- <h1>{{ $route.meta.title }}</h1> -->
    <!-- 起始頁面 -->
    <div class="logo">
      <img :src="pic.logo" alt="logo" />
    </div>
    <div class="item item_pink">
      <img :src="pic.pink" alt="pink" />
      <router-link to="/roaming-orbit" class="txt">前台</router-link>
    </div>
    <div class="item item_blue">
      <img :src="pic.blue" alt="blue" />
      <router-link to="/backend/login" class="txt">後台</router-link>
    </div>
    <div class="starttrain">
      <img :src="pic.train" alt="train" />
    </div>
  </main>
</template>

<script>
// @ is an alias to /src

export default {
  components: {},
  data() {
    return {
      pic: {
        logo: require("../assets/logo.svg"),
        pink: require("../assets/images/img/StartView/spotpink.svg"),
        blue: require("../assets/images/img/StartView/spotblue.svg"),
        train: require("../assets/images/img/StartView/starttrain.png"),
      },
    };
  },
};
</script>

<style lang="scss" scoped>
main.start_view {
  background-color: #ededed;
  position: relative;
  height: 100vh;
  width: 100%;
  display: flex;
  flex-direction: column;
  overflow: hidden;

  .logo {
    position: absolute;
    left: 20px;
    top: 20px;
  }

  .item {
    // position: absolute;
    position: relative;
    width: 250px;
    // width: 50%;
    z-index: 1;
    margin: 0 auto;
    .txt {
      position: absolute;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      color: #000;
      font-size: 36px;
      font-weight: 500;
      line-height: 56px;
      transition: all 0.3s ease-in-out;
      text-decoration: none;

      &:hover {
        color: #f29c50;
      }
    }
  }
  .item_pink {
    top: 60px;
  }
  .item_blue {
    top: 80px;
  }

  .starttrain {
    position: absolute;
    right: 0;

    // top: 100%;
    bottom: -10px;
    width: 70%;
    height: 250px;
  }

  img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    overflow: visible;
  }
}

@media screen and (min-width: 768px) {
  main.start_view {
    position: relative;

    .item {
      width: 300px;
      // width: 30%;
      position: absolute;

      .txt {
        font-size: 48px;
      }
    }
    .item_pink {
      top: 40px;
      left: 100px;
    }
    .item_blue {
      top: 270px;
      left: 350px;
      // right: 100px;
    }

    .starttrain {
      bottom: -30px;
      height: 400px;
    }
  }
}

@media screen and (min-width: 1024px) {
  main.start_view {
    .starttrain {
      height: 500px;
    }
  }
}
</style>

<!-- 景點介紹 -->
<template>
  <main class="Attractions">
    <div class="map">
      <img :src="pic.map" alt="map" />
    </div>
  </main>
</template>

<script>
export default {
  components: {},
  data() {
    return {
      pic: {
        map: require("../assets/images/img/Attractions/map.png"),
        train: require("../assets/images/img/Attractions/train.svg"),
        trainLine: require("../assets/images/img/Attractions/trainLine.svg"),
        lake: require("../assets/images/img/Attractions/lake.png"),
        mapleleaf: require("../assets/images/img/Attractions/mapleleaf.png"),
        mountain: require("../assets/images/img/Attractions/mountain.png"),
        pasture: require("../assets/images/img/Attractions/pasture.png"),
        remains: require("../assets/images/img/Attractions/remains.png"),
        restaurant: require("../assets/images/img/Attractions/restaurant.png"),
      },
    };
  },
};
</script>

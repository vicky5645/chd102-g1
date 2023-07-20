<!-- 公告內頁 -->

<template>
  <main class="Announcement-details">
    
    <div class="back_button">
      <router-link to="/announcements"
        ><i class="fa fa-angle-left" aria-hidden="true"></i>
        返回公告</router-link
      >
    </div>

    <div
      class="article_card"
      v-for="(article, index) in airticles"
      :key="index"
    >
      <p class="type" :class="article.type === '重要' ? 'important' : 'normal'">
        {{ article.type }} <span>{{ article.date }}</span>
      </p>
      <h3>{{ article.title }}</h3>

      <div class="pic"><img :src="article.image" alt="Article Image" /></div>
      <p>{{ article.content }}</p>
    </div>
  </main>
</template>

<script>
export default {
  data() {
    return {
      // 圖片
      airticles: [],
      // airticles: [
      //   {
      //     image: "~@/assets/images/Announcements/a1.png",
      //     type: "重要",
      //     date: "｜6/23 20:38",
      //     title: "全新的蒸汽火車旅程上線",
      //     content:
      //       "我們非常榮幸地宣布，“湖光山色”全新蒸汽火車之旅現已開放預訂！這個行程將帶領您從城市的喧囂中抽身，進入壯麗的大自然，穿越秀美的山脈，欣賞湖光山色的美景。在這次旅程中，您將有機會體驗古老的蒸汽火車，聆聽其叮叮噹噹的旋律，感受時光倒流的魔力。不要錯過這次與大自然親近的絕佳機會，現在就開始預訂吧！",
      //   },
      //   // {
      //   //   image: require("../assets/images/img/Announcements/a1.png"),
      //   //   type: "重要",
      //   //   date: "｜6/23 20:38",
      //   //   title: "全新的蒸汽火車旅程上線",
      //   //   content:
      //   //     "我們非常榮幸地宣布，“湖光山色”全新蒸汽火車之旅現已開放預訂！這個行程將帶領您從城市的喧囂中抽身，進入壯麗的大自然，穿越秀美的山脈，欣賞湖光山色的美景。在這次旅程中，您將有機會體驗古老的蒸汽火車，聆聽其叮叮噹噹的旋律，感受時光倒流的魔力。不要錯過這次與大自然親近的絕佳機會，現在就開始預訂吧！",
      //   // },
      // ],
    };
  },
  props: {
    article: {
      type: Object,
      required: true,
    },
  },
};
</script>

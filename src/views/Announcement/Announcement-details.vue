<!-- 公告內頁 -->

<template>
  <main class="Announcement-details">

    <div class="back_button">
      <router-link to="/announcements"><i class="fa fa-angle-left" aria-hidden="true"></i>
        返回公告</router-link>
    </div>
    <div class="article_card" v-if="airticlesItem" :key="airticlesItem.id">
      <p class="type" :class="airticlesItem.type === '重要' ? 'important' : 'normal'">
        {{ airticlesItem.type }} <span>{{ airticlesItem.date }}</span>
      </p>
      <h3>{{ airticlesItem.title }}</h3>

      <div class="pic"><img :src="airticlesItem.image" alt="Article Image" /></div>
      <p>{{ airticlesItem.content }}</p>
    </div>
  </main>
</template>

<script>
import {GET} from '@/plugin/axios'
export default {
  data() {
    return {
      // 圖片
      airticles: [],
      airticlesItem: [],
      // airticles: [
      //   {
      //     image: "~@/assets/images/Announcements/a1.png",
      //     type: "重要",
      //     date: "｜6/23 20:38",
      //     title: "全新的蒸汽火車旅程上線",
      //     content:
      //       "我們非常榮幸地宣布，“湖光山色”全新蒸汽火車之旅現已開放預訂！這個行程將帶領您從城市的喧囂中抽身，進入壯麗的大自然，穿越秀美的山脈，欣賞湖光山色的美景。在這次旅程中，您將有機會體驗古老的蒸汽火車，聆聽其叮叮噹噹的旋律，感受時光倒流的魔力。不要錯過這次與大自然親近的絕佳機會，現在就開始預訂吧！",
      //   },
      //   {
      //     image: "/images/img/Announcements/a1.png",
      //     type: "重要",
      //     date: "｜6/23 20:38",
      //     title: "全新的蒸汽火車旅程上線",
      //     content:
      //       "我們非常榮幸地宣布，“湖光山色”全新蒸汽火車之旅現已開放預訂！這個行程將帶領您從城市的喧囂中抽身，進入壯麗的大自然，穿越秀美的山脈，欣賞湖光山色的美景。在這次旅程中，您將有機會體驗古老的蒸汽火車，聆聽其叮叮噹噹的旋律，感受時光倒流的魔力。不要錯過這次與大自然親近的絕佳機會，現在就開始預訂吧！",
      //   },
      // ],
    };
  },
  props: {
    article: {
      type: Object,
      required: true,
    },
  },
  created() {
      // 取得API
    GET('/data/airticlesData.json').then(res => {
      this.airticles = res;
      this.airticlesItem = this.airticles[`${parseFloat(this.$route.params.id) - 1}`];
    })
  },
};
</script>

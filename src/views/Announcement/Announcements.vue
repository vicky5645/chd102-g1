<!-- 公告 -->

<!-- 公告內頁 -->

<template>
  <main class="Announcements">
    <div class="button_and_search">
      <div class="button_list">
        <button @click="selectType('所有')" :class="{ 'selected-button': selectedType === '所有' }" :key="'所有'">
          所有
        </button>

        <button @click="selectType('重要')" :class="{ 'selected-button': selectedType === '重要' }" :key="'重要'">
          重要
        </button>

        <button @click="selectType('活動')" :class="{ 'selected-button': selectedType === '活動' }" :key="'活動'">
          活動
        </button>
      </div>
      <div class="search_bar">
        <input v-model="searchText" type="search" placeholder="輸入關鍵字查詢" />
        <button @click="searchArticles">搜尋</button>
      </div>
    </div>

    <template v-if="filteredArticles.length">
      <div v-for="article in filteredArticles" :key="article.id" class="article_card">
        <div class="pic"><img :src="article.image" alt="Article Image" /></div>
        <div class="article_card_txt">
          <p class="type" :class="article.type === '重要' ? 'important' : 'normal'">
            {{ article.type }} <span>{{ article.date }}</span>
          </p>
          <h3>{{ article.title }}</h3>
          <p class="card_txt_content">{{ article.content }}</p>
          <router-link :to="`/announcement-details/${article.id}`" class="more">查看更多</router-link>
        </div>
      </div>
    </template>
    <template v-else>
      <p class="article_card_no">暫時沒有相關公告，換個關鍵字查查吧😣</p>
    </template>
  </main>
</template>

<script>
import {GET} from '@/plugin/axios'
export default {
  data() {
    return {
      // 圖片
      airticles: [],
      // airticles: [
      //   {
      //     image: "~@/assets/images/img/Announcements/a1.png",
      //     type: "重要",
      //     date: "｜6/23 20:38",
      //     title: "全新的蒸汽火車旅程上線",
      //     content:
      //       "我們非常榮幸地宣布，“湖光山色”全新蒸汽火車之旅現已開放預訂！這個行程將帶領您從城市的喧囂中抽身，進入壯麗的大自然，穿越秀美的山脈，欣賞湖光山色的美景。在這次旅程中，您將有機會體驗古老的蒸汽火車，聆聽其叮叮噹噹的旋律，感受時光倒流的魔力。不要錯過這次與大自然親近的絕佳機會，現在就開始預訂吧！",
      //   },
      //   {
      //     image: "~@/assets/images/img/Announcements/a2.png",
      //     type: "活動",
      //     date: "｜6/20 21:22",
      //     title: "特別節日優惠",
      //     content:
      //       "中秋節即將來臨，為慶祝這個重要的節日，我們決定提供特別優惠！從今日起至下月15日，只要預訂任何一個我們提供的行程，都將可以享受10%的折扣。這是我們首次提供如此大幅度的折扣，希望您能把握住這個難得的機會。讓我們在中秋月圓人團圓的美好時刻，一起享受迷人的蒸汽火車旅行吧！",
      //   },
      //   {
      //     image: "~@/assets/images/img/Announcements/a3.png",
      //     type: "活動",
      //     date: "｜5/21 09:11",
      //     title: "全新合作夥伴-當地手工藝品體驗",
      //     content:
      //       "當地手工藝品體驗：我們相信旅行不只是眼睛的饗宴，也應該是深入當地文化的體驗。為此，我們很高興地宣布，我們與當地的手工藝品製作師傅達成了合作關係！在我們的蒸汽火車之旅中，您將有機會直接參與製作當地獨特的手工藝品，如陶瓷、編織或是木雕等。這不僅可以讓您帶回家一份富有當地特色的紀念品，更是讓您更深入體驗當地的文化與工藝。別錯過這個獨一無二的機會，現在就開始預訂您的蒸汽火車之旅！",
      //   },
      //   {
      //     image: "~@/assets/images/img/Announcements/a4.png",
      //     type: "重要",
      //     date: "｜4/23 15:48",
      //     title: "永續旅遊的承諾 ",
      //     content:
      //       "在『漫遊列車之旅』，我們深知旅遊活動對環境的影響，因此我們決心致力於永續旅遊。我們很高興地宣布，我們已經開始進行一項新的計劃，這個計劃旨在降低我們的碳足跡，並支持當地的環保工作。每預訂一個行程，我們將捐出一部分的收益用於植樹活動，以抵消我們的碳排放。同時，我們也正在積極與當地的環保組織合作，提供更多的支援和幫助。我們期待您的參與，一起為了更美好的地球做出努力！",
      //   },
      // ],
      // 分類按鈕
      selectedType: "所有",
      // 搜尋
      searchText: "",
      filteredArticles: [],
      isSearching: false,
    };
  },
  methods: {
    // 分類按鈕
    selectType(type) {
      this.selectedType = type;
      this.searchArticles();
    },
    // 搜尋
    searchArticles() {
      this.isSearching = true;
      this.filteredArticles = this.airticles.filter(
        (article) =>
          (article.title.includes(this.searchText) ||
            article.content.includes(this.searchText)) &&
          (this.selectedType === "所有" || this.selectedType === article.type)
      );
    },
  },
  created() {
      // 取得API
    GET('/data/airticlesData.json').then(res => {
      this.airticles = res;
      this.filteredArticles = this.airticles;
    })
  },
};
</script>

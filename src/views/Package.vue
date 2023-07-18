<style lang="scss" scoped>
@import "@/assets/scss/style.scss";

$secondary2: #b3cee2;

* {
  box-sizing: border-box;
}

section.title {
  width: 1200px;
  margin: auto;
  text-align: center;

  h1 {
    font-size: 2rem;
    padding: 1.25rem;
  }
}

section.spot-filter {
  width: 1200px;
  margin: auto;
  background-color: white;
  box-shadow: 0 3px 10px rgb(0 0 0 / 0.2);
  border-radius: 15px;
  padding: 0.5rem 0;
  .spot-tag {
    margin: 1rem 0;
    span {
      font-size: 1.5rem;
      font-weight: bold;
      color: $color;
      background-color: $secondary2;
      border-radius: 5px;
      padding: 0.5rem 0.75rem;
    }
  }
  .spot-list {
    display: flex;
    .spot-item {
      text-align: center;
      p {
        font-weight: bold;
      }
      .spot-img {
        img {
          border-radius: 50%;
          width: 100%;
          aspect-ratio: 1/1;
          object-fit: cover;
        }
      }
    }
  }

  .filter {
    display: flex;
    align-items: center;
    border-top: 1px solid $bg;
    padding: 0.5rem 0 0.25rem 0;
    .inner {
      margin: 0 1.5rem 0 3rem;
      font-weight: bold;
    }

    .btn-wrap {
      margin-right: auto;
      button {
        display: inline-block;
        font-weight: bold;
        background-color: transparent;
        border: none;
        margin: 0 3rem;
      }
    }
  }
}

section.package-list {
  width: 1200px;
  margin: 1rem auto;
  .package-item {
    display: flex;
    background-color: white;
    border-radius: 15px;
    position: relative;
    margin: 1.25rem 0;
    box-shadow: 0 3px 10px rgb(0 0 0 / 0.2);

    .img {
      width: 42.5%;
      img {
        width: 100%;
        border-radius: 15px 0 0 15px;
      }
    }

    .info {
      width: 42.5%;
      padding: 0.25rem;
      display: flex;
      flex-direction: column;

      h3 {
        font-size: 1.5rem;
      }
      .seat {
        margin-top: auto;
      }
      .seat,
      .date,
      .train {
        padding: 0.25rem 0;
      }

      p {
        padding: 0.25rem 0;
      }
    }

    .price {
      text-align: center;
      flex-grow: 1;
      display: flex;
      flex-direction: column;
      del {
        color: rgb(146, 137, 137);
        font-size: 1.25rem;
        margin: auto 0 1rem 0;
      }

      span {
        color: #fff;
        border-radius: 10px;
      }
    }

    .sale {
      position: absolute;
      background-color: #fbc756;
      top: 1rem;
      padding: 0.5rem;
      border-radius: 5px;
      font-weight: bold;
    }
  }
}
</style>

<template>
  <section class="title">
    <h1>行程選擇</h1>
  </section>
  <section class="spot-filter">
    <div class="spot-tag"><span>景點篩選</span></div>
    <div class="spot-list">
      <div
        class="spot-item col-2"
        v-for="(item, index) in spotList"
        :key="index"
      >
        <div class="spot-img">
          <img :src="item.link" alt="" />
        </div>
        <p>{{ item.name }}</p>
      </div>
    </div>
    <div class="filter">
      <div class="inner">排序</div>
      <div class="btn-wrap">
        <button class="filter" v-for="(item, index) in filterList" :key="index">
          {{ item.name }}
        </button>
      </div>
    </div>
  </section>

  <section class="package-list">
    <div class="package-item" v-for="(item, index) in packageList" :key="index">
      <div class="img">
        <img :src="item.link" alt="" />
      </div>
      <div class="info">
        <h3>{{ item.title }}<br />{{ item.title2 }}</h3>
        <div class="seat">剩餘{{ item.seat }}個名額</div>
        <div class="date">{{ item.date }}</div>
        <div class="train">{{ item.train }}</div>
        <p>{{ item.info }}</p>
      </div>
      <div class="price">
        <del>NT${{ item.origin }}</del>
        <p>
          <span class="btn primary">NT${{ item.price }}</span>
        </p>
      </div>
      <div class="sale" v-show="item.sale == true">早鳥優惠中</div>
    </div>
  </section>
</template>

<script>
export default {
  data() {
    return {
      spotList: [
        {
          name: "高原遺跡",
          link: require("@/assets/images/spot/01.jpg"),
        },

        {
          name: "銀月山脈",
          link: require("@/assets/images/spot/02.jpg"),
        },

        {
          name: "綠野牧場",
          link: require("@/assets/images/spot/03.jpg"),
        },

        {
          name: "海底餐廳",
          link: require("@/assets/images/spot/04.png"),
        },

        {
          name: "忘卻之湖",
          link: require("@/assets/images/spot/05.jpg"),
        },

        {
          name: "景觀公園",
          link: require("@/assets/images/spot/08.webp"),
        },
      ],

      filterList: [
        {
          name: "行程價格",
        },

        {
          name: "出發日期",
        },

        {
          name: "剩餘名額",
        },

        {
          name: "早鳥優惠",
        },
      ],

      packageList: [
        {
          title: "探尋島嶼之美，搭乘耀眼的七星豪華列車",
          title2: "—————「SEVEN STARS ROAMING」",
          link: require("@/assets/images/spot/07.jpg"),
          seat: 20,
          date: "2025-03-18",
          train: "seven stars",
          sale: false,
          origin: 36888,
          price: 31888,
          info: "體驗一趟令人難以忘懷的列車旅程！從綠野牧場到壯麗的景觀公園，再到絢爛極光的銀月山脈，此趟旅行將帶您穿越自然奇觀和歷史遺跡，而旅程的最後則是建於海底的獨特餐廳，讓您同時品味美食和...",
        },
        {
          title: "探尋島嶼之美，搭乘尊爵的ROYAL豪華列車",
          title2: "——————————「ROYAL EXPRESS」",
          link: require("@/assets/images/spot/09.jpg"),
          seat: 20,
          date: "2025-04-18",
          train: "royal",
          sale: false,
          origin: 41888,
          price: 36888,
          info: "體驗一趟令人難以忘懷的列車旅程！從綠野牧場到壯麗的景觀公園，再到絢爛極光的銀月山脈，此趟旅行將帶您穿越自然奇觀和歷史遺跡，而旅程的最後則是建於海底的獨特餐廳，讓您同時品味美食和...",
        },
        {
          title: "探尋島嶼之美，搭乘閃耀的GOLDEN豪華列車",
          title2: "—————————「GOLDEN EXPRESS」",
          link: require("@/assets/images/spot/10.webp"),
          seat: 20,
          date: "2025-05-18",
          train: "seven stars",
          sale: true,
          origin: 36888,
          price: 31888,
          info: "體驗一趟令人難以忘懷的列車旅程！從綠野牧場到壯麗的景觀公園，再到絢爛極光的銀月山脈，此趟旅行將帶您穿越自然奇觀和歷史遺跡，而旅程的最後則是建於海底的獨特餐廳，讓您同時品味美食和...",
        },
        {
          title: "探尋島嶼之美，搭乘耀眼的七星豪華列車",
          title2: "—————「SEVEN STARS ROAMING」",
          link: require("@/assets/images/spot/07.jpg"),
          seat: 20,
          date: "2025-06-18",
          train: "seven stars",
          sale: true,
          origin: 36888,
          price: 31888,
          info: "體驗一趟令人難以忘懷的列車旅程！從綠野牧場到壯麗的景觀公園，再到絢爛極光的銀月山脈，此趟旅行將帶您穿越自然奇觀和歷史遺跡，而旅程的最後則是建於海底的獨特餐廳，讓您同時品味美食和...",
        },
        {
          title: "探尋島嶼之美，搭乘尊爵的ROYAL豪華列車",
          title2: "——————————「ROYAL EXPRESS」",
          link: require("@/assets/images/spot/09.jpg"),
          seat: 20,
          date: "2025-07-18",
          train: "seven stars",
          sale: true,
          origin: 36888,
          price: 31888,
          info: "體驗一趟令人難以忘懷的列車旅程！從綠野牧場到壯麗的景觀公園，再到絢爛極光的銀月山脈，此趟旅行將帶您穿越自然奇觀和歷史遺跡，而旅程的最後則是建於海底的獨特餐廳，讓您同時品味美食和...",
        },
      ],
    };
  },
};
</script>

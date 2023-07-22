<script>
export default {
  data() {
    return {
      name: "星空探索",
      departure: "2025/03/18 9:00",
      back: "2025/03/19 21:00",
      departureSite: "有夠站",
      backSite: "SUPER站",
      startSale: "2025-01-18 12:00",
      price: 36888,
      pass: [
        {
          name: "綠野牧場",
        },
        {
          name: "景觀公園",
        },
        {
          name: "銀月山脈",
        },
        {
          name: "高原遺跡",
        },
        {
          name: "海底餐廳",
        },
      ],

      portion1: [
        {
          seat: [
            {
              number: "1",
              id: "A1",
              status: "available",
            },
            {
              number: "2",
              id: "A2",
              status: "available",
            },
          ],
        },
        {
          seat: [
            {
              number: "3",
              id: "A3",
              status: "available",
            },
            {
              number: "4",
              id: "A4",
              status: "available",
            },
          ],
        },
        {
          seat: [
            {
              number: "5",
              id: "A5",
              status: "available",
            },
            {
              number: "6",
              id: "A6",
              status: "available",
            },
          ],
        },
        {
          seat: [
            {
              number: "7",
              id: "A7",
              status: "available",
            },
            {
              number: "8",
              id: "A8",
              status: "available",
            },
          ],
        },
        {
          seat: [
            {
              number: "9",
              id: "A9",
              status: "available",
            },
            {
              number: "10",
              id: "A10",
              status: "available",
            },
          ],
        },
      ],

      portion2: [
        {
          seat: [
            {
              id: "B1",
              status: "available",
            },
            {
              id: "B2",
              status: "available",
            },
          ],
        },
        {
          seat: [
            {
              id: "A3",
              status: "available",
            },
            {
              id: "A4",
              status: "available",
            },
          ],
        },
        {
          seat: [
            {
              id: "A5",
              status: "available",
            },
            {
              id: "A6",
              status: "available",
            },
          ],
        },
        {
          seat: [
            {
              id: "A7",
              status: "available",
            },
            {
              id: "A8",
              status: "available",
            },
          ],
        },
        {
          seat: [
            {
              id: "B9",
              status: "available",
            },
            {
              id: "B10",
              status: "available",
            },
          ],
        },
      ],
    };
  },
};
</script>
<template>
  <section class="title">
    <h1>一般訂票</h1>
  </section>
  <div class="container">
    <section class="info">
      <h2>行程資訊</h2>

      <div class="info-list">
        <p>出發時間：{{ departure }}</p>
        <p>回程時間：{{ back }}</p>
        <p>起程站：{{ departureSite }}</p>
        <p>終點站：{{ backSite }}</p>
        <div class="pass">
          <h3>途經景點:</h3>
          <div class="wrap">
            <p v-for="(item, index) in pass" :key="index">
              {{ item.name }}<Icon type="ios-arrow-round-forward" />
            </p>
          </div>
        </div>
        <p>※本列車行程為包含來回</p>
        <p>販售時間：{{ startSale }}，售完為止</p>
        <p>取票方式：現場取票</p>
        <p>票價：{{ price }}</p>
      </div>
    </section>

    <section class="choose">
      <h2>座位選擇</h2>

      <div class="choose-option">
        <div class="select-car">
          <label for="">車廂選擇：</label>
          <select class="select" name="car">
            <option value="">--請選擇車廂--</option>
            <option value="car1">第一車廂</option>
            <option value="car2">第二車廂</option>
          </select>
        </div>
        <div class="count">
          <div>人數選擇：</div>
          <button class="minus"><i class="fa-solid fa-minus"></i></button>
          <input type="tel" />
          <button class="plus"><i class="fa-solid fa-plus"></i></button>
        </div>
      </div>
    </section>

    <section class="seat-pic">
      <div class="whole">
        <div class="seat-area">
          <div class="portion1" v-for="(group, index) in portion1" :key="group">
            <div
              class="seat"
              v-for="(item, seatIndex) in group.seat"
              :key="seatIndex"
            >
              <div class="num">{{ item.number }}</div>
            </div>
          </div>

          <div class="portion2" v-for="(item, index) in portion2" :key="item">
            <div class="seat"></div>
            <div class="seat"></div>
          </div>

          <div class="A">A</div>
          <div class="B">B</div>
        </div>
      </div>

      <div class="seat-color">
        <div class="item">
          <span>已售出</span>
          <div class="booked"></div>
        </div>
        <div class="item">
          <span>可選擇</span>
          <div class="empty"></div>
        </div>
      </div>
    </section>
  </div>
</template>

<style lang="scss" scoped>
* {
  box-sizing: border-box;
}
.container {
  width: 1200px;
  margin: auto;
}

section.title {
  text-align: center;
  background-color: white;
  h1 {
    font-size: 2rem;
    padding: 1.25rem;
  }
}

section.info {
  h2 {
    font-size: 1.5rem;
    padding: 1.25rem 0;
    border-bottom: 2px dotted #333;
  }

  p {
    font-size: 1.25rem;
    padding: 0.25rem 0;
  }

  .info-list {
    .pass {
      h3 {
        font-size: 1.25rem;
      }
      .wrap {
        display: flex;
      }
    }
  }
}

section.choose {
  h2 {
    font-size: 1.5rem;
    padding: 1.25rem 0;
    border-bottom: 2px dotted #333;
  }

  .choose-option {
    padding: 1.5rem;
    display: flex;
    justify-content: center;
    // align-items: center;
    .select-car {
      margin-right: 2rem;
      label {
        font-size: 1.25rem;
        margin-right: 0.25rem;
      }

      select {
        width: 160px;
        height: 40px;
        line-height: 40px;
        border-radius: 5px;
        outline-style: none;
        font-size: 1.25rem;
      }
    }
    .count {
      display: flex;
      font-size: 1.25rem;

      .minus,
      .plus {
        width: 30px;
        height: 30px;
        line-height: 30px;
        text-align: center;
        border-radius: 5px;
        background-color: #f29c50;
      }

      input {
        width: 100px;
        height: 30px;
        text-align: center;
        outline-style: none;
      }
    }
  }
}

section.seat-pic {
  margin: 2.5rem 0;
  .whole {
    width: 100%;
    height: 300px;
    border-radius: 125px;
    background-color: #9ca3af;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    .seat-area {
      width: 80%;
      height: 300px;
      display: grid;
      margin: auto;
      grid-template-columns: repeat(5, 1fr);
      // background-color: aquamarine;
      row-gap: 75px;
      column-gap: 50px;
      position: relative;
      .portion1 {
        // background-color: yellowgreen;
        display: flex;
        justify-content: center;
        .seat {
          position: relative;
          background-color: #fff;
          width: 50px;
          height: 65px;

          // border-radius: 50%;
          margin: 0.25rem;

          .num {
            font-size: 1.25rem;
            font-weight: bold;
            position: absolute;
            bottom: 100%;
            left: 40%;
          }
        }
      }
      .portion2 {
        // background-color: yellowgreen;
        display: flex;
        justify-content: center;
        align-items: flex-end;
        .seat {
          background-color: #fff;
          width: 50px;
          height: 65px;

          // border-radius: 50%;
          margin: 0.25rem;
        }
      }

      .A {
        font-size: 1.25rem;
        font-weight: bold;
        position: absolute;
        top: 5%;
        right: 101%;
      }

      .B {
        font-size: 1.25rem;
        font-weight: bold;
        position: absolute;
        bottom: 5%;
        right: 101%;
      }
    }
  }

  .seat-color {
    margin-top: 1.5rem;
    display: flex;

    .item {
      .booked {
        width: 50px;
        height: 50px;
        background-color: #4b5563;
        margin: 0 2rem;
      }
      .empty {
        width: 50px;
        height: 50px;
        background-color: #fff;
        border: 1px solid #333;
        margin: 0 2rem;
      }
    }
  }
}
</style>
